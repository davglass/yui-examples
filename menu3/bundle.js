// prototype.js
/*  Prototype JavaScript framework, version 1.5.0
 *  (c) 2005-2007 Sam Stephenson
 *
 *  Prototype is freely distributable under the terms of an MIT-style license.
 *  For details, see the Prototype web site: http://prototype.conio.net/
 *
/*--------------------------------------------------------------------------*/

var Prototype = {
  Version: '1.5.0',
  BrowserFeatures: {
    XPath: !!document.evaluate
  },

  ScriptFragment: '(?:<script.*?>)((\n|\r|.)*?)(?:<\/script>)',
  emptyFunction: function() {},
  K: function(x) { return x }
}

var Class = {
  create: function() {
    return function() {
      this.initialize.apply(this, arguments);
    }
  }
}

var Abstract = new Object();

Object.extend = function(destination, source) {
  for (var property in source) {
    destination[property] = source[property];
  }
  return destination;
}

Object.extend(Object, {
  inspect: function(object) {
    try {
      if (object === undefined) return 'undefined';
      if (object === null) return 'null';
      return object.inspect ? object.inspect() : object.toString();
    } catch (e) {
      if (e instanceof RangeError) return '...';
      throw e;
    }
  },

  keys: function(object) {
    var keys = [];
    for (var property in object)
      keys.push(property);
    return keys;
  },

  values: function(object) {
    var values = [];
    for (var property in object)
      values.push(object[property]);
    return values;
  },

  clone: function(object) {
    return Object.extend({}, object);
  }
});

Function.prototype.bind = function() {
  var __method = this, args = $A(arguments), object = args.shift();
  return function() {
    return __method.apply(object, args.concat($A(arguments)));
  }
}

Function.prototype.bindAsEventListener = function(object) {
  var __method = this, args = $A(arguments), object = args.shift();
  return function(event) {
    return __method.apply(object, [( event || window.event)].concat(args).concat($A(arguments)));
  }
}

Object.extend(Number.prototype, {
  toColorPart: function() {
    var digits = this.toString(16);
    if (this < 16) return '0' + digits;
    return digits;
  },

  succ: function() {
    return this + 1;
  },

  times: function(iterator) {
    $R(0, this, true).each(iterator);
    return this;
  }
});

var Try = {
  these: function() {
    var returnValue;

    for (var i = 0, length = arguments.length; i < length; i++) {
      var lambda = arguments[i];
      try {
        returnValue = lambda();
        break;
      } catch (e) {}
    }

    return returnValue;
  }
}

/*--------------------------------------------------------------------------*/

var PeriodicalExecuter = Class.create();
PeriodicalExecuter.prototype = {
  initialize: function(callback, frequency) {
    this.callback = callback;
    this.frequency = frequency;
    this.currentlyExecuting = false;

    this.registerCallback();
  },

  registerCallback: function() {
    this.timer = setInterval(this.onTimerEvent.bind(this), this.frequency * 1000);
  },

  stop: function() {
    if (!this.timer) return;
    clearInterval(this.timer);
    this.timer = null;
  },

  onTimerEvent: function() {
    if (!this.currentlyExecuting) {
      try {
        this.currentlyExecuting = true;
        this.callback(this);
      } finally {
        this.currentlyExecuting = false;
      }
    }
  }
}
String.interpret = function(value){
  return value == null ? '' : String(value);
}

Object.extend(String.prototype, {
  gsub: function(pattern, replacement) {
    var result = '', source = this, match;
    replacement = arguments.callee.prepareReplacement(replacement);

    while (source.length > 0) {
      if (match = source.match(pattern)) {
        result += source.slice(0, match.index);
        result += String.interpret(replacement(match));
        source  = source.slice(match.index + match[0].length);
      } else {
        result += source, source = '';
      }
    }
    return result;
  },

  sub: function(pattern, replacement, count) {
    replacement = this.gsub.prepareReplacement(replacement);
    count = count === undefined ? 1 : count;

    return this.gsub(pattern, function(match) {
      if (--count < 0) return match[0];
      return replacement(match);
    });
  },

  scan: function(pattern, iterator) {
    this.gsub(pattern, iterator);
    return this;
  },

  truncate: function(length, truncation) {
    length = length || 30;
    truncation = truncation === undefined ? '...' : truncation;
    return this.length > length ?
      this.slice(0, length - truncation.length) + truncation : this;
  },

  strip: function() {
    return this.replace(/^\s+/, '').replace(/\s+$/, '');
  },

  stripTags: function() {
    return this.replace(/<\/?[^>]+>/gi, '');
  },

  stripScripts: function() {
    return this.replace(new RegExp(Prototype.ScriptFragment, 'img'), '');
  },

  extractScripts: function() {
    var matchAll = new RegExp(Prototype.ScriptFragment, 'img');
    var matchOne = new RegExp(Prototype.ScriptFragment, 'im');
    return (this.match(matchAll) || []).map(function(scriptTag) {
      return (scriptTag.match(matchOne) || ['', ''])[1];
    });
  },

  evalScripts: function() {
    return this.extractScripts().map(function(script) { return eval(script) });
  },

  escapeHTML: function() {
    var div = document.createElement('div');
    var text = document.createTextNode(this);
    div.appendChild(text);
    return div.innerHTML;
  },

  unescapeHTML: function() {
    var div = document.createElement('div');
    div.innerHTML = this.stripTags();
    return div.childNodes[0] ? (div.childNodes.length > 1 ?
      $A(div.childNodes).inject('',function(memo,node){ return memo+node.nodeValue }) :
      div.childNodes[0].nodeValue) : '';
  },

  toQueryParams: function(separator) {
    var match = this.strip().match(/([^?#]*)(#.*)?$/);
    if (!match) return {};

    return match[1].split(separator || '&').inject({}, function(hash, pair) {
      if ((pair = pair.split('='))[0]) {
        var name = decodeURIComponent(pair[0]);
        var value = pair[1] ? decodeURIComponent(pair[1]) : undefined;

        if (hash[name] !== undefined) {
          if (hash[name].constructor != Array)
            hash[name] = [hash[name]];
          if (value) hash[name].push(value);
        }
        else hash[name] = value;
      }
      return hash;
    });
  },

  toArray: function() {
    return this.split('');
  },

  succ: function() {
    return this.slice(0, this.length - 1) +
      String.fromCharCode(this.charCodeAt(this.length - 1) + 1);
  },

  camelize: function() {
    var parts = this.split('-'), len = parts.length;
    if (len == 1) return parts[0];

    var camelized = this.charAt(0) == '-'
      ? parts[0].charAt(0).toUpperCase() + parts[0].substring(1)
      : parts[0];

    for (var i = 1; i < len; i++)
      camelized += parts[i].charAt(0).toUpperCase() + parts[i].substring(1);

    return camelized;
  },

  capitalize: function(){
    return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
  },

  underscore: function() {
    return this.gsub(/::/, '/').gsub(/([A-Z]+)([A-Z][a-z])/,'#{1}_#{2}').gsub(/([a-z\d])([A-Z])/,'#{1}_#{2}').gsub(/-/,'_').toLowerCase();
  },

  dasherize: function() {
    return this.gsub(/_/,'-');
  },

  inspect: function(useDoubleQuotes) {
    var escapedString = this.replace(/\\/g, '\\\\');
    if (useDoubleQuotes)
      return '"' + escapedString.replace(/"/g, '\\"') + '"';
    else
      return "'" + escapedString.replace(/'/g, '\\\'') + "'";
  }
});

String.prototype.gsub.prepareReplacement = function(replacement) {
  if (typeof replacement == 'function') return replacement;
  var template = new Template(replacement);
  return function(match) { return template.evaluate(match) };
}

String.prototype.parseQuery = String.prototype.toQueryParams;

var Template = Class.create();
Template.Pattern = /(^|.|\r|\n)(#\{(.*?)\})/;
Template.prototype = {
  initialize: function(template, pattern) {
    this.template = template.toString();
    this.pattern  = pattern || Template.Pattern;
  },

  evaluate: function(object) {
    return this.template.gsub(this.pattern, function(match) {
      var before = match[1];
      if (before == '\\') return match[2];
      return before + String.interpret(object[match[3]]);
    });
  }
}

var $break    = new Object();
var $continue = new Object();

var Enumerable = {
  each: function(iterator) {
    var index = 0;
    try {
      this._each(function(value) {
        try {
          iterator(value, index++);
        } catch (e) {
          if (e != $continue) throw e;
        }
      });
    } catch (e) {
      if (e != $break) throw e;
    }
    return this;
  },

  eachSlice: function(number, iterator) {
    var index = -number, slices = [], array = this.toArray();
    while ((index += number) < array.length)
      slices.push(array.slice(index, index+number));
    return slices.map(iterator);
  },

  all: function(iterator) {
    var result = true;
    this.each(function(value, index) {
      result = result && !!(iterator || Prototype.K)(value, index);
      if (!result) throw $break;
    });
    return result;
  },

  any: function(iterator) {
    var result = false;
    this.each(function(value, index) {
      if (result = !!(iterator || Prototype.K)(value, index))
        throw $break;
    });
    return result;
  },

  collect: function(iterator) {
    var results = [];
    this.each(function(value, index) {
      results.push((iterator || Prototype.K)(value, index));
    });
    return results;
  },

  detect: function(iterator) {
    var result;
    this.each(function(value, index) {
      if (iterator(value, index)) {
        result = value;
        throw $break;
      }
    });
    return result;
  },

  findAll: function(iterator) {
    var results = [];
    this.each(function(value, index) {
      if (iterator(value, index))
        results.push(value);
    });
    return results;
  },

  grep: function(pattern, iterator) {
    var results = [];
    this.each(function(value, index) {
      var stringValue = value.toString();
      if (stringValue.match(pattern))
        results.push((iterator || Prototype.K)(value, index));
    })
    return results;
  },

  include: function(object) {
    var found = false;
    this.each(function(value) {
      if (value == object) {
        found = true;
        throw $break;
      }
    });
    return found;
  },

  inGroupsOf: function(number, fillWith) {
    fillWith = fillWith === undefined ? null : fillWith;
    return this.eachSlice(number, function(slice) {
      while(slice.length < number) slice.push(fillWith);
      return slice;
    });
  },

  inject: function(memo, iterator) {
    this.each(function(value, index) {
      memo = iterator(memo, value, index);
    });
    return memo;
  },

  invoke: function(method) {
    var args = $A(arguments).slice(1);
    return this.map(function(value) {
      return value[method].apply(value, args);
    });
  },

  max: function(iterator) {
    var result;
    this.each(function(value, index) {
      value = (iterator || Prototype.K)(value, index);
      if (result == undefined || value >= result)
        result = value;
    });
    return result;
  },

  min: function(iterator) {
    var result;
    this.each(function(value, index) {
      value = (iterator || Prototype.K)(value, index);
      if (result == undefined || value < result)
        result = value;
    });
    return result;
  },

  partition: function(iterator) {
    var trues = [], falses = [];
    this.each(function(value, index) {
      ((iterator || Prototype.K)(value, index) ?
        trues : falses).push(value);
    });
    return [trues, falses];
  },

  pluck: function(property) {
    var results = [];
    this.each(function(value, index) {
      results.push(value[property]);
    });
    return results;
  },

  reject: function(iterator) {
    var results = [];
    this.each(function(value, index) {
      if (!iterator(value, index))
        results.push(value);
    });
    return results;
  },

  sortBy: function(iterator) {
    return this.map(function(value, index) {
      return {value: value, criteria: iterator(value, index)};
    }).sort(function(left, right) {
      var a = left.criteria, b = right.criteria;
      return a < b ? -1 : a > b ? 1 : 0;
    }).pluck('value');
  },

  toArray: function() {
    return this.map();
  },

  zip: function() {
    var iterator = Prototype.K, args = $A(arguments);
    if (typeof args.last() == 'function')
      iterator = args.pop();

    var collections = [this].concat(args).map($A);
    return this.map(function(value, index) {
      return iterator(collections.pluck(index));
    });
  },

  size: function() {
    return this.toArray().length;
  },

  inspect: function() {
    return '#<Enumerable:' + this.toArray().inspect() + '>';
  }
}

Object.extend(Enumerable, {
  map:     Enumerable.collect,
  find:    Enumerable.detect,
  select:  Enumerable.findAll,
  member:  Enumerable.include,
  entries: Enumerable.toArray
});
var $A = Array.from = function(iterable) {
  if (!iterable) return [];
  if (iterable.toArray) {
    return iterable.toArray();
  } else {
    var results = [];
    for (var i = 0, length = iterable.length; i < length; i++)
      results.push(iterable[i]);
    return results;
  }
}

Object.extend(Array.prototype, Enumerable);

if (!Array.prototype._reverse)
  Array.prototype._reverse = Array.prototype.reverse;

Object.extend(Array.prototype, {
  _each: function(iterator) {
    for (var i = 0, length = this.length; i < length; i++)
      iterator(this[i]);
  },

  clear: function() {
    this.length = 0;
    return this;
  },

  first: function() {
    return this[0];
  },

  last: function() {
    return this[this.length - 1];
  },

  compact: function() {
    return this.select(function(value) {
      return value != null;
    });
  },

  flatten: function() {
    return this.inject([], function(array, value) {
      return array.concat(value && value.constructor == Array ?
        value.flatten() : [value]);
    });
  },

  without: function() {
    var values = $A(arguments);
    return this.select(function(value) {
      return !values.include(value);
    });
  },

  indexOf: function(object) {
    for (var i = 0, length = this.length; i < length; i++)
      if (this[i] == object) return i;
    return -1;
  },

  reverse: function(inline) {
    return (inline !== false ? this : this.toArray())._reverse();
  },

  reduce: function() {
    return this.length > 1 ? this : this[0];
  },

  uniq: function() {
    return this.inject([], function(array, value) {
      return array.include(value) ? array : array.concat([value]);
    });
  },

  clone: function() {
    return [].concat(this);
  },

  size: function() {
    return this.length;
  },

  inspect: function() {
    return '[' + this.map(Object.inspect).join(', ') + ']';
  }
});

Array.prototype.toArray = Array.prototype.clone;

function $w(string){
  string = string.strip();
  return string ? string.split(/\s+/) : [];
}

if(window.opera){
  Array.prototype.concat = function(){
    var array = [];
    for(var i = 0, length = this.length; i < length; i++) array.push(this[i]);
    for(var i = 0, length = arguments.length; i < length; i++) {
      if(arguments[i].constructor == Array) {
        for(var j = 0, arrayLength = arguments[i].length; j < arrayLength; j++)
          array.push(arguments[i][j]);
      } else {
        array.push(arguments[i]);
      }
    }
    return array;
  }
}
var Hash = function(obj) {
  Object.extend(this, obj || {});
};

Object.extend(Hash, {
  toQueryString: function(obj) {
    var parts = [];

	  this.prototype._each.call(obj, function(pair) {
      if (!pair.key) return;

      if (pair.value && pair.value.constructor == Array) {
        var values = pair.value.compact();
        if (values.length < 2) pair.value = values.reduce();
        else {
        	key = encodeURIComponent(pair.key);
          values.each(function(value) {
            value = value != undefined ? encodeURIComponent(value) : '';
//            parts.push(key + '=' + encodeURIComponent(value));
            parts.push(key + '=' + value);
          });
          return;
        }
      }
      if (pair.value == undefined) pair[1] = '';
      parts.push(pair.map(encodeURIComponent).join('='));
	  });

    return parts.join('&');
  }
});

Object.extend(Hash.prototype, Enumerable);
Object.extend(Hash.prototype, {
  _each: function(iterator) {
    for (var key in this) {
      var value = this[key];
      if (value && value == Hash.prototype[key]) continue;

      var pair = [key, value];
      pair.key = key;
      pair.value = value;
      iterator(pair);
    }
  },

  keys: function() {
    return this.pluck('key');
  },

  values: function() {
    return this.pluck('value');
  },

  merge: function(hash) {
    return $H(hash).inject(this, function(mergedHash, pair) {
      mergedHash[pair.key] = pair.value;
      return mergedHash;
    });
  },

  remove: function() {
    var result;
    for(var i = 0, length = arguments.length; i < length; i++) {
      var value = this[arguments[i]];
      if (value !== undefined){
        if (result === undefined) result = value;
        else {
          if (result.constructor != Array) result = [result];
          result.push(value)
        }
      }
      delete this[arguments[i]];
    }
    return result;
  },

  toQueryString: function() {
    return Hash.toQueryString(this);
  },

  inspect: function() {
    return '#<Hash:{' + this.map(function(pair) {
      return pair.map(Object.inspect).join(': ');
    }).join(', ') + '}>';
  }
});

function $H(object) {
  if (object && object.constructor == Hash) return object;
  return new Hash(object);
};
ObjectRange = Class.create();
Object.extend(ObjectRange.prototype, Enumerable);
Object.extend(ObjectRange.prototype, {
  initialize: function(start, end, exclusive) {
    this.start = start;
    this.end = end;
    this.exclusive = exclusive;
  },

  _each: function(iterator) {
    var value = this.start;
    while (this.include(value)) {
      iterator(value);
      value = value.succ();
    }
  },

  include: function(value) {
    if (value < this.start)
      return false;
    if (this.exclusive)
      return value < this.end;
    return value <= this.end;
  }
});

var $R = function(start, end, exclusive) {
  return new ObjectRange(start, end, exclusive);
}

var Ajax = {
  getTransport: function() {
    return Try.these(
      function() {return new XMLHttpRequest()},
      function() {return new ActiveXObject('Msxml2.XMLHTTP')},
      function() {return new ActiveXObject('Microsoft.XMLHTTP')}
    ) || false;
  },

  activeRequestCount: 0
}

Ajax.Responders = {
  responders: [],

  _each: function(iterator) {
    this.responders._each(iterator);
  },

  register: function(responder) {
    if (!this.include(responder))
      this.responders.push(responder);
  },

  unregister: function(responder) {
    this.responders = this.responders.without(responder);
  },

  dispatch: function(callback, request, transport, json) {
    this.each(function(responder) {
      if (typeof responder[callback] == 'function') {
        try {
          responder[callback].apply(responder, [request, transport, json]);
        } catch (e) {}
      }
    });
  }
};

Object.extend(Ajax.Responders, Enumerable);

Ajax.Responders.register({
  onCreate: function() {
    Ajax.activeRequestCount++;
  },
  onComplete: function() {
    Ajax.activeRequestCount--;
  }
});

Ajax.Base = function() {};
Ajax.Base.prototype = {
  setOptions: function(options) {
    this.options = {
      method:       'post',
      asynchronous: true,
      contentType:  'application/x-www-form-urlencoded',
      encoding:     'UTF-8',
      parameters:   ''
    }
    Object.extend(this.options, options || {});

    this.options.method = this.options.method.toLowerCase();
    if (typeof this.options.parameters == 'string')
      this.options.parameters = this.options.parameters.toQueryParams();
  }
}

Ajax.Request = Class.create();
Ajax.Request.Events =
  ['Uninitialized', 'Loading', 'Loaded', 'Interactive', 'Complete'];

Ajax.Request.prototype = Object.extend(new Ajax.Base(), {
  _complete: false,

  initialize: function(url, options) {
    this.transport = Ajax.getTransport();
    this.setOptions(options);
    this.request(url);
  },

  request: function(url) {
    this.url = url;
    this.method = this.options.method;
    var params = this.options.parameters;

    if (!['get', 'post'].include(this.method)) {
      // simulate other verbs over post
      params['_method'] = this.method;
      this.method = 'post';
    }

    params = Hash.toQueryString(params);
    if (params && /Konqueror|Safari|KHTML/.test(navigator.userAgent)) params += '&_='

    // when GET, append parameters to URL
    if (this.method == 'get' && params)
      this.url += (this.url.indexOf('?') > -1 ? '&' : '?') + params;

    try {
      Ajax.Responders.dispatch('onCreate', this, this.transport);

      this.transport.open(this.method.toUpperCase(), this.url,
        this.options.asynchronous);

      if (this.options.asynchronous)
        setTimeout(function() { this.respondToReadyState(1) }.bind(this), 10);

      this.transport.onreadystatechange = this.onStateChange.bind(this);
      this.setRequestHeaders();

      var body = this.method == 'post' ? (this.options.postBody || params) : null;

      this.transport.send(body);

      /* Force Firefox to handle ready state 4 for synchronous requests */
      if (!this.options.asynchronous && this.transport.overrideMimeType)
        this.onStateChange();

    }
    catch (e) {
      this.dispatchException(e);
    }
  },

  onStateChange: function() {
    var readyState = this.transport.readyState;
    if (readyState > 1 && !((readyState == 4) && this._complete))
      this.respondToReadyState(this.transport.readyState);
  },

  setRequestHeaders: function() {
    var headers = {
      'X-Requested-With': 'XMLHttpRequest',
      'X-Prototype-Version': Prototype.Version,
      'Accept': 'text/javascript, text/html, application/xml, text/xml, */*'
    };

    if (this.method == 'post') {
      headers['Content-type'] = this.options.contentType +
        (this.options.encoding ? '; charset=' + this.options.encoding : '');

      /* Force "Connection: close" for older Mozilla browsers to work
       * around a bug where XMLHttpRequest sends an incorrect
       * Content-length header. See Mozilla Bugzilla #246651.
       */
      if (this.transport.overrideMimeType &&
          (navigator.userAgent.match(/Gecko\/(\d{4})/) || [0,2005])[1] < 2005)
            headers['Connection'] = 'close';
    }

    // user-defined headers
    if (typeof this.options.requestHeaders == 'object') {
      var extras = this.options.requestHeaders;

      if (typeof extras.push == 'function')
        for (var i = 0, length = extras.length; i < length; i += 2)
          headers[extras[i]] = extras[i+1];
      else
        $H(extras).each(function(pair) { headers[pair.key] = pair.value });
    }

    for (var name in headers)
      this.transport.setRequestHeader(name, headers[name]);
  },

  success: function() {
    return !this.transport.status
        || (this.transport.status >= 200 && this.transport.status < 300);
  },

  respondToReadyState: function(readyState) {
    var state = Ajax.Request.Events[readyState];
    var transport = this.transport, json = this.evalJSON();

    if (state == 'Complete') {
      try {
        this._complete = true;
        (this.options['on' + this.transport.status]
         || this.options['on' + (this.success() ? 'Success' : 'Failure')]
         || Prototype.emptyFunction)(transport, json);
      } catch (e) {
        this.dispatchException(e);
      }

      if ((this.getHeader('Content-type') || 'text/javascript').strip().
        match(/^(text|application)\/(x-)?(java|ecma)script(;.*)?$/i))
          this.evalResponse();
    }

    try {
      (this.options['on' + state] || Prototype.emptyFunction)(transport, json);
      Ajax.Responders.dispatch('on' + state, this, transport, json);
    } catch (e) {
      this.dispatchException(e);
    }

    if (state == 'Complete') {
      // avoid memory leak in MSIE: clean up
      this.transport.onreadystatechange = Prototype.emptyFunction;
    }
  },

  getHeader: function(name) {
    try {
      return this.transport.getResponseHeader(name);
    } catch (e) { return null }
  },

  evalJSON: function() {
    try {
      var json = this.getHeader('X-JSON');
      return json ? eval('(' + json + ')') : null;
    } catch (e) { return null }
  },

  evalResponse: function() {
    try {
      return eval(this.transport.responseText);
    } catch (e) {
      this.dispatchException(e);
    }
  },

  dispatchException: function(exception) {
    (this.options.onException || Prototype.emptyFunction)(this, exception);
    Ajax.Responders.dispatch('onException', this, exception);
  }
});

Ajax.Updater = Class.create();

Object.extend(Object.extend(Ajax.Updater.prototype, Ajax.Request.prototype), {
  initialize: function(container, url, options) {
    this.container = {
      success: (container.success || container),
      failure: (container.failure || (container.success ? null : container))
    }

    this.transport = Ajax.getTransport();
    this.setOptions(options);

    var onComplete = this.options.onComplete || Prototype.emptyFunction;
    this.options.onComplete = (function(transport, param) {
      this.updateContent();
      onComplete(transport, param);
    }).bind(this);

    this.request(url);
  },

  updateContent: function() {
    var receiver = this.container[this.success() ? 'success' : 'failure'];
    var response = this.transport.responseText;

    if (!this.options.evalScripts) response = response.stripScripts();

    if (receiver = $(receiver)) {
      if (this.options.insertion)
        new this.options.insertion(receiver, response);
      else
        receiver.update(response);
    }

    if (this.success()) {
      if (this.onComplete)
        setTimeout(this.onComplete.bind(this), 10);
    }
  }
});

Ajax.PeriodicalUpdater = Class.create();
Ajax.PeriodicalUpdater.prototype = Object.extend(new Ajax.Base(), {
  initialize: function(container, url, options) {
    this.setOptions(options);
    this.onComplete = this.options.onComplete;

    this.frequency = (this.options.frequency || 2);
    this.decay = (this.options.decay || 1);

    this.updater = {};
    this.container = container;
    this.url = url;

    this.start();
  },

  start: function() {
    this.options.onComplete = this.updateComplete.bind(this);
    this.onTimerEvent();
  },

  stop: function() {
    this.updater.options.onComplete = undefined;
    clearTimeout(this.timer);
    (this.onComplete || Prototype.emptyFunction).apply(this, arguments);
  },

  updateComplete: function(request) {
    if (this.options.decay) {
      this.decay = (request.responseText == this.lastText ?
        this.decay * this.options.decay : 1);

      this.lastText = request.responseText;
    }
    this.timer = setTimeout(this.onTimerEvent.bind(this),
      this.decay * this.frequency * 1000);
  },

  onTimerEvent: function() {
    this.updater = new Ajax.Updater(this.container, this.url, this.options);
  }
});
function $(element) {
  if (arguments.length > 1) {
    for (var i = 0, elements = [], length = arguments.length; i < length; i++)
      elements.push($(arguments[i]));
    return elements;
  }
  if (typeof element == 'string')
    element = document.getElementById(element);
  return Element.extend(element);
}

if (Prototype.BrowserFeatures.XPath) {
  document._getElementsByXPath = function(expression, parentElement) {
    var results = [];
    var query = document.evaluate(expression, $(parentElement) || document,
      null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE, null);
    for (var i = 0, length = query.snapshotLength; i < length; i++)
      results.push(query.snapshotItem(i));
    return results;
  };
}

document.getElementsByClassName = function(className, parentElement) {
  if (Prototype.BrowserFeatures.XPath) {
    var q = ".//*[contains(concat(' ', @class, ' '), ' " + className + " ')]";
    return document._getElementsByXPath(q, parentElement);
  } else {
    var children = ($(parentElement) || document.body).getElementsByTagName('*');
    var elements = [], child;
    for (var i = 0, length = children.length; i < length; i++) {
      child = children[i];
      if (Element.hasClassName(child, className))
        elements.push(Element.extend(child));
    }
    return elements;
  }
};

/*--------------------------------------------------------------------------*/

if (!window.Element)
  var Element = new Object();

Element.extend = function(element) {
  if (!element || _nativeExtensions || element.nodeType == 3) return element;

  if (!element._extended && element.tagName && element != window) {
    var methods = Object.clone(Element.Methods), cache = Element.extend.cache;

    if (element.tagName == 'FORM')
      Object.extend(methods, Form.Methods);
    if (['INPUT', 'TEXTAREA', 'SELECT'].include(element.tagName))
      Object.extend(methods, Form.Element.Methods);

    Object.extend(methods, Element.Methods.Simulated);

    for (var property in methods) {
      var value = methods[property];
      if (typeof value == 'function' && !(property in element))
        element[property] = cache.findOrStore(value);
    }
  }

  element._extended = true;
  return element;
};

Element.extend.cache = {
  findOrStore: function(value) {
    return this[value] = this[value] || function() {
      return value.apply(null, [this].concat($A(arguments)));
    }
  }
};

Element.Methods = {
  visible: function(element) {
    return $(element).style.display != 'none';
  },

  toggle: function(element) {
    element = $(element);
    Element[Element.visible(element) ? 'hide' : 'show'](element);
    return element;
  },

  hide: function(element) {
    $(element).style.display = 'none';
    return element;
  },

  show: function(element) {
    $(element).style.display = '';
    return element;
  },

  remove: function(element) {
    element = $(element);
    element.parentNode.removeChild(element);
    return element;
  },

  update: function(element, html) {
    html = typeof html == 'undefined' ? '' : html.toString();
    $(element).innerHTML = html.stripScripts();
    setTimeout(function() {html.evalScripts()}, 10);
    return element;
  },

  replace: function(element, html) {
    element = $(element);
    html = typeof html == 'undefined' ? '' : html.toString();
    if (element.outerHTML) {
      element.outerHTML = html.stripScripts();
    } else {
      var range = element.ownerDocument.createRange();
      range.selectNodeContents(element);
      element.parentNode.replaceChild(
        range.createContextualFragment(html.stripScripts()), element);
    }
    setTimeout(function() {html.evalScripts()}, 10);
    return element;
  },

  inspect: function(element) {
    element = $(element);
    var result = '<' + element.tagName.toLowerCase();
    $H({'id': 'id', 'className': 'class'}).each(function(pair) {
      var property = pair.first(), attribute = pair.last();
      var value = (element[property] || '').toString();
      if (value) result += ' ' + attribute + '=' + value.inspect(true);
    });
    return result + '>';
  },

  recursivelyCollect: function(element, property) {
    element = $(element);
    var elements = [];
    while (element = element[property])
      if (element.nodeType == 1)
        elements.push(Element.extend(element));
    return elements;
  },

  ancestors: function(element) {
    return $(element).recursivelyCollect('parentNode');
  },

  descendants: function(element) {
    return $A($(element).getElementsByTagName('*'));
  },

  immediateDescendants: function(element) {
    if (!(element = $(element).firstChild)) return [];
    while (element && element.nodeType != 1) element = element.nextSibling;
    if (element) return [element].concat($(element).nextSiblings());
    return [];
  },

  previousSiblings: function(element) {
    return $(element).recursivelyCollect('previousSibling');
  },

  nextSiblings: function(element) {
    return $(element).recursivelyCollect('nextSibling');
  },

  siblings: function(element) {
    element = $(element);
    return element.previousSiblings().reverse().concat(element.nextSiblings());
  },

  match: function(element, selector) {
    if (typeof selector == 'string')
      selector = new Selector(selector);
    return selector.match($(element));
  },

  up: function(element, expression, index) {
    return Selector.findElement($(element).ancestors(), expression, index);
  },

  down: function(element, expression, index) {
    return Selector.findElement($(element).descendants(), expression, index);
  },

  previous: function(element, expression, index) {
    return Selector.findElement($(element).previousSiblings(), expression, index);
  },

  next: function(element, expression, index) {
    return Selector.findElement($(element).nextSiblings(), expression, index);
  },

  getElementsBySelector: function() {
    var args = $A(arguments), element = $(args.shift());
    return Selector.findChildElements(element, args);
  },

  getElementsByClassName: function(element, className) {
    return document.getElementsByClassName(className, element);
  },

  readAttribute: function(element, name) {
    element = $(element);
    if (document.all && !window.opera) {
      var t = Element._attributeTranslations;
      if (t.values[name]) return t.values[name](element, name);
      if (t.names[name])  name = t.names[name];
      var attribute = element.attributes[name];
      if(attribute) return attribute.nodeValue;
    }
    return element.getAttribute(name);
  },

  getHeight: function(element) {
    return $(element).getDimensions().height;
  },

  getWidth: function(element) {
    return $(element).getDimensions().width;
  },

  classNames: function(element) {
    return new Element.ClassNames(element);
  },

  hasClassName: function(element, className) {
    if (!(element = $(element))) return;
    var elementClassName = element.className;
    if (elementClassName.length == 0) return false;
    if (elementClassName == className ||
        elementClassName.match(new RegExp("(^|\\s)" + className + "(\\s|$)")))
      return true;
    return false;
  },

  addClassName: function(element, className) {
    if (!(element = $(element))) return;
    Element.classNames(element).add(className);
    return element;
  },

  removeClassName: function(element, className) {
    if (!(element = $(element))) return;
    Element.classNames(element).remove(className);
    return element;
  },

  toggleClassName: function(element, className) {
    if (!(element = $(element))) return;
    Element.classNames(element)[element.hasClassName(className) ? 'remove' : 'add'](className);
    return element;
  },

  observe: function() {
    Event.observe.apply(Event, arguments);
    return $A(arguments).first();
  },

  stopObserving: function() {
    Event.stopObserving.apply(Event, arguments);
    return $A(arguments).first();
  },

  // removes whitespace-only text node children
  cleanWhitespace: function(element) {
    element = $(element);
    var node = element.firstChild;
    while (node) {
      var nextNode = node.nextSibling;
      if (node.nodeType == 3 && !/\S/.test(node.nodeValue))
        element.removeChild(node);
      node = nextNode;
    }
    return element;
  },

  empty: function(element) {
    return $(element).innerHTML.match(/^\s*$/);
  },

  descendantOf: function(element, ancestor) {
    element = $(element), ancestor = $(ancestor);
    while (element = element.parentNode)
      if (element == ancestor) return true;
    return false;
  },

  scrollTo: function(element) {
    element = $(element);
    var pos = Position.cumulativeOffset(element);
    window.scrollTo(pos[0], pos[1]);
    return element;
  },

  getStyle: function(element, style) {
    element = $(element);
    if (['float','cssFloat'].include(style))
      style = (typeof element.style.styleFloat != 'undefined' ? 'styleFloat' : 'cssFloat');
    style = style.camelize();
    var value = element.style[style];
    if (!value) {
      if (document.defaultView && document.defaultView.getComputedStyle) {
        var css = document.defaultView.getComputedStyle(element, null);
        value = css ? css[style] : null;
      } else if (element.currentStyle) {
        value = element.currentStyle[style];
      }
    }

    if((value == 'auto') && ['width','height'].include(style) && (element.getStyle('display') != 'none'))
      value = element['offset'+style.capitalize()] + 'px';

    if (window.opera && ['left', 'top', 'right', 'bottom'].include(style))
      if (Element.getStyle(element, 'position') == 'static') value = 'auto';
    if(style == 'opacity') {
      if(value) return parseFloat(value);
      if(value = (element.getStyle('filter') || '').match(/alpha\(opacity=(.*)\)/))
        if(value[1]) return parseFloat(value[1]) / 100;
      return 1.0;
    }
    return value == 'auto' ? null : value;
  },

  setStyle: function(element, style) {
    element = $(element);
    for (var name in style) {
      var value = style[name];
      if(name == 'opacity') {
        if (value == 1) {
          value = (/Gecko/.test(navigator.userAgent) &&
            !/Konqueror|Safari|KHTML/.test(navigator.userAgent)) ? 0.999999 : 1.0;
          if(/MSIE/.test(navigator.userAgent) && !window.opera)
            element.style.filter = element.getStyle('filter').replace(/alpha\([^\)]*\)/gi,'');
        } else if(value == '') {
          if(/MSIE/.test(navigator.userAgent) && !window.opera)
            element.style.filter = element.getStyle('filter').replace(/alpha\([^\)]*\)/gi,'');
        } else {
          if(value < 0.00001) value = 0;
          if(/MSIE/.test(navigator.userAgent) && !window.opera)
            element.style.filter = element.getStyle('filter').replace(/alpha\([^\)]*\)/gi,'') +
              'alpha(opacity='+value*100+')';
        }
      } else if(['float','cssFloat'].include(name)) name = (typeof element.style.styleFloat != 'undefined') ? 'styleFloat' : 'cssFloat';
      element.style[name.camelize()] = value;
    }
    return element;
  },

  getDimensions: function(element) {
    element = $(element);
    var display = $(element).getStyle('display');
    if (display != 'none' && display != null) // Safari bug
      return {width: element.offsetWidth, height: element.offsetHeight};

    // All *Width and *Height properties give 0 on elements with display none,
    // so enable the element temporarily
    var els = element.style;
    var originalVisibility = els.visibility;
    var originalPosition = els.position;
    var originalDisplay = els.display;
    els.visibility = 'hidden';
    els.position = 'absolute';
    els.display = 'block';
    var originalWidth = element.clientWidth;
    var originalHeight = element.clientHeight;
    els.display = originalDisplay;
    els.position = originalPosition;
    els.visibility = originalVisibility;
    return {width: originalWidth, height: originalHeight};
  },

  makePositioned: function(element) {
    element = $(element);
    var pos = Element.getStyle(element, 'position');
    if (pos == 'static' || !pos) {
      element._madePositioned = true;
      element.style.position = 'relative';
      // Opera returns the offset relative to the positioning context, when an
      // element is position relative but top and left have not been defined
      if (window.opera) {
        element.style.top = 0;
        element.style.left = 0;
      }
    }
    return element;
  },

  undoPositioned: function(element) {
    element = $(element);
    if (element._madePositioned) {
      element._madePositioned = undefined;
      element.style.position =
        element.style.top =
        element.style.left =
        element.style.bottom =
        element.style.right = '';
    }
    return element;
  },

  makeClipping: function(element) {
    element = $(element);
    if (element._overflow) return element;
    element._overflow = element.style.overflow || 'auto';
    if ((Element.getStyle(element, 'overflow') || 'visible') != 'hidden')
      element.style.overflow = 'hidden';
    return element;
  },

  undoClipping: function(element) {
    element = $(element);
    if (!element._overflow) return element;
    element.style.overflow = element._overflow == 'auto' ? '' : element._overflow;
    element._overflow = null;
    return element;
  }
};

Object.extend(Element.Methods, {childOf: Element.Methods.descendantOf});

Element._attributeTranslations = {};

Element._attributeTranslations.names = {
  colspan:   "colSpan",
  rowspan:   "rowSpan",
  valign:    "vAlign",
  datetime:  "dateTime",
  accesskey: "accessKey",
  tabindex:  "tabIndex",
  enctype:   "encType",
  maxlength: "maxLength",
  readonly:  "readOnly",
  longdesc:  "longDesc"
};

Element._attributeTranslations.values = {
  _getAttr: function(element, attribute) {
    return element.getAttribute(attribute, 2);
  },

  _flag: function(element, attribute) {
    return $(element).hasAttribute(attribute) ? attribute : null;
  },

  style: function(element) {
    return element.style.cssText.toLowerCase();
  },

  title: function(element) {
    var node = element.getAttributeNode('title');
    return node.specified ? node.nodeValue : null;
  }
};

Object.extend(Element._attributeTranslations.values, {
  href: Element._attributeTranslations.values._getAttr,
  src:  Element._attributeTranslations.values._getAttr,
  disabled: Element._attributeTranslations.values._flag,
  checked:  Element._attributeTranslations.values._flag,
  readonly: Element._attributeTranslations.values._flag,
  multiple: Element._attributeTranslations.values._flag
});

Element.Methods.Simulated = {
  hasAttribute: function(element, attribute) {
    var t = Element._attributeTranslations;
    attribute = t.names[attribute] || attribute;
    return $(element).getAttributeNode(attribute).specified;
  }
};

// IE is missing .innerHTML support for TABLE-related elements
if (document.all && !window.opera){
  Element.Methods.update = function(element, html) {
    element = $(element);
    html = typeof html == 'undefined' ? '' : html.toString();
    var tagName = element.tagName.toUpperCase();
    if (['THEAD','TBODY','TR','TD'].include(tagName)) {
      var div = document.createElement('div');
      switch (tagName) {
        case 'THEAD':
        case 'TBODY':
          div.innerHTML = '<table><tbody>' +  html.stripScripts() + '</tbody></table>';
          depth = 2;
          break;
        case 'TR':
          div.innerHTML = '<table><tbody><tr>' +  html.stripScripts() + '</tr></tbody></table>';
          depth = 3;
          break;
        case 'TD':
          div.innerHTML = '<table><tbody><tr><td>' +  html.stripScripts() + '</td></tr></tbody></table>';
          depth = 4;
      }
      $A(element.childNodes).each(function(node){
        element.removeChild(node)
      });
      depth.times(function(){ div = div.firstChild });

      $A(div.childNodes).each(
        function(node){ element.appendChild(node) });
    } else {
      element.innerHTML = html.stripScripts();
    }
    setTimeout(function() {html.evalScripts()}, 10);
    return element;
  }
};

Object.extend(Element, Element.Methods);

var _nativeExtensions = false;

if(/Konqueror|Safari|KHTML/.test(navigator.userAgent))
  ['', 'Form', 'Input', 'TextArea', 'Select'].each(function(tag) {
    var className = 'HTML' + tag + 'Element';
    if(window[className]) return;
    var klass = window[className] = {};
    klass.prototype = document.createElement(tag ? tag.toLowerCase() : 'div').__proto__;
  });

Element.addMethods = function(methods) {
  Object.extend(Element.Methods, methods || {});

  function copy(methods, destination, onlyIfAbsent) {
    onlyIfAbsent = onlyIfAbsent || false;
    var cache = Element.extend.cache;
    for (var property in methods) {
      var value = methods[property];
      if (!onlyIfAbsent || !(property in destination))
        destination[property] = cache.findOrStore(value);
    }
  }

  if (typeof HTMLElement != 'undefined') {
    copy(Element.Methods, HTMLElement.prototype);
    copy(Element.Methods.Simulated, HTMLElement.prototype, true);
    copy(Form.Methods, HTMLFormElement.prototype);
    [HTMLInputElement, HTMLTextAreaElement, HTMLSelectElement].each(function(klass) {
      copy(Form.Element.Methods, klass.prototype);
    });
    _nativeExtensions = true;
  }
}

var Toggle = new Object();
Toggle.display = Element.toggle;

/*--------------------------------------------------------------------------*/

Abstract.Insertion = function(adjacency) {
  this.adjacency = adjacency;
}

Abstract.Insertion.prototype = {
  initialize: function(element, content) {
    this.element = $(element);
    this.content = content.stripScripts();

    if (this.adjacency && this.element.insertAdjacentHTML) {
      try {
        this.element.insertAdjacentHTML(this.adjacency, this.content);
      } catch (e) {
        var tagName = this.element.tagName.toUpperCase();
        if (['TBODY', 'TR'].include(tagName)) {
          this.insertContent(this.contentFromAnonymousTable());
        } else {
          throw e;
        }
      }
    } else {
      this.range = this.element.ownerDocument.createRange();
      if (this.initializeRange) this.initializeRange();
      this.insertContent([this.range.createContextualFragment(this.content)]);
    }

    setTimeout(function() {content.evalScripts()}, 10);
  },

  contentFromAnonymousTable: function() {
    var div = document.createElement('div');
    div.innerHTML = '<table><tbody>' + this.content + '</tbody></table>';
    return $A(div.childNodes[0].childNodes[0].childNodes);
  }
}

var Insertion = new Object();

Insertion.Before = Class.create();
Insertion.Before.prototype = Object.extend(new Abstract.Insertion('beforeBegin'), {
  initializeRange: function() {
    this.range.setStartBefore(this.element);
  },

  insertContent: function(fragments) {
    fragments.each((function(fragment) {
      this.element.parentNode.insertBefore(fragment, this.element);
    }).bind(this));
  }
});

Insertion.Top = Class.create();
Insertion.Top.prototype = Object.extend(new Abstract.Insertion('afterBegin'), {
  initializeRange: function() {
    this.range.selectNodeContents(this.element);
    this.range.collapse(true);
  },

  insertContent: function(fragments) {
    fragments.reverse(false).each((function(fragment) {
      this.element.insertBefore(fragment, this.element.firstChild);
    }).bind(this));
  }
});

Insertion.Bottom = Class.create();
Insertion.Bottom.prototype = Object.extend(new Abstract.Insertion('beforeEnd'), {
  initializeRange: function() {
    this.range.selectNodeContents(this.element);
    this.range.collapse(this.element);
  },

  insertContent: function(fragments) {
    fragments.each((function(fragment) {
      this.element.appendChild(fragment);
    }).bind(this));
  }
});

Insertion.After = Class.create();
Insertion.After.prototype = Object.extend(new Abstract.Insertion('afterEnd'), {
  initializeRange: function() {
    this.range.setStartAfter(this.element);
  },

  insertContent: function(fragments) {
    fragments.each((function(fragment) {
      this.element.parentNode.insertBefore(fragment,
        this.element.nextSibling);
    }).bind(this));
  }
});

/*--------------------------------------------------------------------------*/

Element.ClassNames = Class.create();
Element.ClassNames.prototype = {
  initialize: function(element) {
    this.element = $(element);
  },

  _each: function(iterator) {
    this.element.className.split(/\s+/).select(function(name) {
      return name.length > 0;
    })._each(iterator);
  },

  set: function(className) {
    this.element.className = className;
  },

  add: function(classNameToAdd) {
    if (this.include(classNameToAdd)) return;
    this.set($A(this).concat(classNameToAdd).join(' '));
  },

  remove: function(classNameToRemove) {
    if (!this.include(classNameToRemove)) return;
    this.set($A(this).without(classNameToRemove).join(' '));
  },

  toString: function() {
    return $A(this).join(' ');
  }
};

Object.extend(Element.ClassNames.prototype, Enumerable);
var Selector = Class.create();
Selector.prototype = {
  initialize: function(expression) {
    this.params = {classNames: []};
    this.expression = expression.toString().strip();
    this.parseExpression();
    this.compileMatcher();
  },

  parseExpression: function() {
    function abort(message) { throw 'Parse error in selector: ' + message; }

    if (this.expression == '')  abort('empty expression');

    var params = this.params, expr = this.expression, match, modifier, clause, rest;
    while (match = expr.match(/^(.*)\[([a-z0-9_:-]+?)(?:([~\|!]?=)(?:"([^"]*)"|([^\]\s]*)))?\]$/i)) {
      params.attributes = params.attributes || [];
      params.attributes.push({name: match[2], operator: match[3], value: match[4] || match[5] || ''});
      expr = match[1];
    }

    if (expr == '*') return this.params.wildcard = true;

    while (match = expr.match(/^([^a-z0-9_-])?([a-z0-9_-]+)(.*)/i)) {
      modifier = match[1], clause = match[2], rest = match[3];
      switch (modifier) {
        case '#':       params.id = clause; break;
        case '.':       params.classNames.push(clause); break;
        case '':
        case undefined: params.tagName = clause.toUpperCase(); break;
        default:        abort(expr.inspect());
      }
      expr = rest;
    }

    if (expr.length > 0) abort(expr.inspect());
  },

  buildMatchExpression: function() {
    var params = this.params, conditions = [], clause;

    if (params.wildcard)
      conditions.push('true');
    if (clause = params.id)
      conditions.push('element.readAttribute("id") == ' + clause.inspect());
    if (clause = params.tagName)
      conditions.push('element.tagName.toUpperCase() == ' + clause.inspect());
    if ((clause = params.classNames).length > 0)
      for (var i = 0, length = clause.length; i < length; i++)
        conditions.push('element.hasClassName(' + clause[i].inspect() + ')');
    if (clause = params.attributes) {
      clause.each(function(attribute) {
        var value = 'element.readAttribute(' + attribute.name.inspect() + ')';
        var splitValueBy = function(delimiter) {
          return value + ' && ' + value + '.split(' + delimiter.inspect() + ')';
        }

        switch (attribute.operator) {
          case '=':       conditions.push(value + ' == ' + attribute.value.inspect()); break;
          case '~=':      conditions.push(splitValueBy(' ') + '.include(' + attribute.value.inspect() + ')'); break;
          case '|=':      conditions.push(
                            splitValueBy('-') + '.first().toUpperCase() == ' + attribute.value.toUpperCase().inspect()
                          ); break;
          case '!=':      conditions.push(value + ' != ' + attribute.value.inspect()); break;
          case '':
          case undefined: conditions.push('element.hasAttribute(' + attribute.name.inspect() + ')'); break;
          default:        throw 'Unknown operator ' + attribute.operator + ' in selector';
        }
      });
    }

    return conditions.join(' && ');
  },

  compileMatcher: function() {
    this.match = new Function('element', 'if (!element.tagName) return false; \
      element = $(element); \
      return ' + this.buildMatchExpression());
  },

  findElements: function(scope) {
    var element;

    if (element = $(this.params.id))
      if (this.match(element))
        if (!scope || Element.childOf(element, scope))
          return [element];

    scope = (scope || document).getElementsByTagName(this.params.tagName || '*');

    var results = [];
    for (var i = 0, length = scope.length; i < length; i++)
      if (this.match(element = scope[i]))
        results.push(Element.extend(element));

    return results;
  },

  toString: function() {
    return this.expression;
  }
}

Object.extend(Selector, {
  matchElements: function(elements, expression) {
    var selector = new Selector(expression);
    return elements.select(selector.match.bind(selector)).map(Element.extend);
  },

  findElement: function(elements, expression, index) {
    if (typeof expression == 'number') index = expression, expression = false;
    return Selector.matchElements(elements, expression || '*')[index || 0];
  },

  findChildElements: function(element, expressions) {
    return expressions.map(function(expression) {
      return expression.match(/[^\s"]+(?:"[^"]*"[^\s"]+)*/g).inject([null], function(results, expr) {
        var selector = new Selector(expr);
        return results.inject([], function(elements, result) {
          return elements.concat(selector.findElements(result || element));
        });
      });
    }).flatten();
  }
});

function $$() {
  return Selector.findChildElements(document, $A(arguments));
}
var Form = {
  reset: function(form) {
    $(form).reset();
    return form;
  },

  serializeElements: function(elements, getHash) {
    var data = elements.inject({}, function(result, element) {
      if (!element.disabled && element.name) {
        var key = element.name, value = $(element).getValue();
        if (value != undefined) {
          if (result[key]) {
            if (result[key].constructor != Array) result[key] = [result[key]];
            result[key].push(value);
          }
          else result[key] = value;
        }
      }
      return result;
    });

    return getHash ? data : Hash.toQueryString(data);
  }
};

Form.Methods = {
  serialize: function(form, getHash) {
    return Form.serializeElements(Form.getElements(form), getHash);
  },

  getElements: function(form) {
    return $A($(form).getElementsByTagName('*')).inject([],
      function(elements, child) {
        if (Form.Element.Serializers[child.tagName.toLowerCase()])
          elements.push(Element.extend(child));
        return elements;
      }
    );
  },

  getInputs: function(form, typeName, name) {
    form = $(form);
    var inputs = form.getElementsByTagName('input');

    if (!typeName && !name) return $A(inputs).map(Element.extend);

    for (var i = 0, matchingInputs = [], length = inputs.length; i < length; i++) {
      var input = inputs[i];
      if ((typeName && input.type != typeName) || (name && input.name != name))
        continue;
      matchingInputs.push(Element.extend(input));
    }

    return matchingInputs;
  },

  disable: function(form) {
    form = $(form);
    form.getElements().each(function(element) {
      element.blur();
      element.disabled = 'true';
    });
    return form;
  },

  enable: function(form) {
    form = $(form);
    form.getElements().each(function(element) {
      element.disabled = '';
    });
    return form;
  },

  findFirstElement: function(form) {
    return $(form).getElements().find(function(element) {
      return element.type != 'hidden' && !element.disabled &&
        ['input', 'select', 'textarea'].include(element.tagName.toLowerCase());
    });
  },

  focusFirstElement: function(form) {
    form = $(form);
    form.findFirstElement().activate();
    return form;
  }
}

Object.extend(Form, Form.Methods);

/*--------------------------------------------------------------------------*/

Form.Element = {
  focus: function(element) {
    $(element).focus();
    return element;
  },

  select: function(element) {
    $(element).select();
    return element;
  }
}

Form.Element.Methods = {
  serialize: function(element) {
    element = $(element);
    if (!element.disabled && element.name) {
      var value = element.getValue();
      if (value != undefined) {
        var pair = {};
        pair[element.name] = value;
        return Hash.toQueryString(pair);
      }
    }
    return '';
  },

  getValue: function(element) {
    element = $(element);
    var method = element.tagName.toLowerCase();
    return Form.Element.Serializers[method](element);
  },

  clear: function(element) {
    $(element).value = '';
    return element;
  },

  present: function(element) {
    return $(element).value != '';
  },

  activate: function(element) {
    element = $(element);
    element.focus();
    if (element.select && ( element.tagName.toLowerCase() != 'input' ||
      !['button', 'reset', 'submit'].include(element.type) ) )
      element.select();
    return element;
  },

  disable: function(element) {
    element = $(element);
    element.disabled = true;
    return element;
  },

  enable: function(element) {
    element = $(element);
    element.blur();
    element.disabled = false;
    return element;
  }
}

Object.extend(Form.Element, Form.Element.Methods);
var Field = Form.Element;
var $F = Form.Element.getValue;

/*--------------------------------------------------------------------------*/

Form.Element.Serializers = {
  input: function(element) {
    switch (element.type.toLowerCase()) {
      case 'checkbox':
      case 'radio':
        return Form.Element.Serializers.inputSelector(element);
      default:
        return Form.Element.Serializers.textarea(element);
    }
  },

  inputSelector: function(element) {
    return element.checked ? element.value : null;
  },

  textarea: function(element) {
    return element.value;
  },

  select: function(element) {
    return this[element.type == 'select-one' ?
      'selectOne' : 'selectMany'](element);
  },

  selectOne: function(element) {
    var index = element.selectedIndex;
    return index >= 0 ? this.optionValue(element.options[index]) : null;
  },

  selectMany: function(element) {
    var values, length = element.length;
    if (!length) return null;

    for (var i = 0, values = []; i < length; i++) {
      var opt = element.options[i];
      if (opt.selected) values.push(this.optionValue(opt));
    }
    return values;
  },

  optionValue: function(opt) {
    // extend element because hasAttribute may not be native
    return Element.extend(opt).hasAttribute('value') ? opt.value : opt.text;
  }
}

/*--------------------------------------------------------------------------*/

Abstract.TimedObserver = function() {}
Abstract.TimedObserver.prototype = {
  initialize: function(element, frequency, callback) {
    this.frequency = frequency;
    this.element   = $(element);
    this.callback  = callback;

    this.lastValue = this.getValue();
    this.registerCallback();
  },

  registerCallback: function() {
    setInterval(this.onTimerEvent.bind(this), this.frequency * 1000);
  },

  onTimerEvent: function() {
    var value = this.getValue();
    var changed = ('string' == typeof this.lastValue && 'string' == typeof value
      ? this.lastValue != value : String(this.lastValue) != String(value));
    if (changed) {
      this.callback(this.element, value);
      this.lastValue = value;
    }
  }
}

Form.Element.Observer = Class.create();
Form.Element.Observer.prototype = Object.extend(new Abstract.TimedObserver(), {
  getValue: function() {
    return Form.Element.getValue(this.element);
  }
});

Form.Observer = Class.create();
Form.Observer.prototype = Object.extend(new Abstract.TimedObserver(), {
  getValue: function() {
    return Form.serialize(this.element);
  }
});

/*--------------------------------------------------------------------------*/

Abstract.EventObserver = function() {}
Abstract.EventObserver.prototype = {
  initialize: function(element, callback) {
    this.element  = $(element);
    this.callback = callback;

    this.lastValue = this.getValue();
    if (this.element.tagName.toLowerCase() == 'form')
      this.registerFormCallbacks();
    else
      this.registerCallback(this.element);
  },

  onElementEvent: function() {
    var value = this.getValue();
    if (this.lastValue != value) {
      this.callback(this.element, value);
      this.lastValue = value;
    }
  },

  registerFormCallbacks: function() {
    Form.getElements(this.element).each(this.registerCallback.bind(this));
  },

  registerCallback: function(element) {
    if (element.type) {
      switch (element.type.toLowerCase()) {
        case 'checkbox':
        case 'radio':
          Event.observe(element, 'click', this.onElementEvent.bind(this));
          break;
        default:
          Event.observe(element, 'change', this.onElementEvent.bind(this));
          break;
      }
    }
  }
}

Form.Element.EventObserver = Class.create();
Form.Element.EventObserver.prototype = Object.extend(new Abstract.EventObserver(), {
  getValue: function() {
    return Form.Element.getValue(this.element);
  }
});

Form.EventObserver = Class.create();
Form.EventObserver.prototype = Object.extend(new Abstract.EventObserver(), {
  getValue: function() {
    return Form.serialize(this.element);
  }
});
if (!window.Event) {
  var Event = new Object();
}

Object.extend(Event, {
  KEY_BACKSPACE: 8,
  KEY_TAB:       9,
  KEY_RETURN:   13,
  KEY_ESC:      27,
  KEY_LEFT:     37,
  KEY_UP:       38,
  KEY_RIGHT:    39,
  KEY_DOWN:     40,
  KEY_DELETE:   46,
  KEY_HOME:     36,
  KEY_END:      35,
  KEY_PAGEUP:   33,
  KEY_PAGEDOWN: 34,

  element: function(event) {
    return event.target || event.srcElement;
  },

  isLeftClick: function(event) {
    return (((event.which) && (event.which == 1)) ||
            ((event.button) && (event.button == 1)));
  },

  pointerX: function(event) {
    return event.pageX || (event.clientX +
      (document.documentElement.scrollLeft || document.body.scrollLeft));
  },

  pointerY: function(event) {
    return event.pageY || (event.clientY +
      (document.documentElement.scrollTop || document.body.scrollTop));
  },

  stop: function(event) {
    if (event.preventDefault) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.returnValue = false;
      event.cancelBubble = true;
    }
  },

  // find the first node with the given tagName, starting from the
  // node the event was triggered on; traverses the DOM upwards
  findElement: function(event, tagName) {
    var element = Event.element(event);
    while (element.parentNode && (!element.tagName ||
        (element.tagName.toUpperCase() != tagName.toUpperCase())))
      element = element.parentNode;
    return element;
  },

  observers: false,

  _observeAndCache: function(element, name, observer, useCapture) {
    if (!this.observers) this.observers = [];
    if (element.addEventListener) {
      this.observers.push([element, name, observer, useCapture]);
      element.addEventListener(name, observer, useCapture);
    } else if (element.attachEvent) {
      this.observers.push([element, name, observer, useCapture]);
      element.attachEvent('on' + name, observer);
    }
  },

  unloadCache: function() {
    if (!Event.observers) return;
    for (var i = 0, length = Event.observers.length; i < length; i++) {
      Event.stopObserving.apply(this, Event.observers[i]);
      Event.observers[i][0] = null;
    }
    Event.observers = false;
  },

  observe: function(element, name, observer, useCapture) {
    element = $(element);
    useCapture = useCapture || false;

    if (name == 'keypress' &&
        (navigator.appVersion.match(/Konqueror|Safari|KHTML/)
        || element.attachEvent))
      name = 'keydown';

    Event._observeAndCache(element, name, observer, useCapture);
  },

  stopObserving: function(element, name, observer, useCapture) {
    element = $(element);
    useCapture = useCapture || false;

    if (name == 'keypress' &&
        (navigator.appVersion.match(/Konqueror|Safari|KHTML/)
        || element.detachEvent))
      name = 'keydown';

    if (element.removeEventListener) {
      element.removeEventListener(name, observer, useCapture);
    } else if (element.detachEvent) {
      try {
        element.detachEvent('on' + name, observer);
      } catch (e) {}
    }
  }
});

/* prevent memory leaks in IE */
if (navigator.appVersion.match(/\bMSIE\b/))
  Event.observe(window, 'unload', Event.unloadCache, false);
var Position = {
  // set to true if needed, warning: firefox performance problems
  // NOT neeeded for page scrolling, only if draggable contained in
  // scrollable elements
  includeScrollOffsets: false,

  // must be called before calling withinIncludingScrolloffset, every time the
  // page is scrolled
  prepare: function() {
    this.deltaX =  window.pageXOffset
                || document.documentElement.scrollLeft
                || document.body.scrollLeft
                || 0;
    this.deltaY =  window.pageYOffset
                || document.documentElement.scrollTop
                || document.body.scrollTop
                || 0;
  },

  realOffset: function(element) {
    var valueT = 0, valueL = 0;
    do {
      valueT += element.scrollTop  || 0;
      valueL += element.scrollLeft || 0;
      element = element.parentNode;
    } while (element);
    return [valueL, valueT];
  },

  cumulativeOffset: function(element) {
    var valueT = 0, valueL = 0;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;
      element = element.offsetParent;
    } while (element);
    return [valueL, valueT];
  },

  positionedOffset: function(element) {
    var valueT = 0, valueL = 0;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;
      element = element.offsetParent;
      if (element) {
        if(element.tagName=='BODY') break;
        var p = Element.getStyle(element, 'position');
        if (p == 'relative' || p == 'absolute') break;
      }
    } while (element);
    return [valueL, valueT];
  },

  offsetParent: function(element) {
    if (element.offsetParent) return element.offsetParent;
    if (element == document.body) return element;

    while ((element = element.parentNode) && element != document.body)
      if (Element.getStyle(element, 'position') != 'static')
        return element;

    return document.body;
  },

  // caches x/y coordinate pair to use with overlap
  within: function(element, x, y) {
    if (this.includeScrollOffsets)
      return this.withinIncludingScrolloffsets(element, x, y);
    this.xcomp = x;
    this.ycomp = y;
    this.offset = this.cumulativeOffset(element);

    return (y >= this.offset[1] &&
            y <  this.offset[1] + element.offsetHeight &&
            x >= this.offset[0] &&
            x <  this.offset[0] + element.offsetWidth);
  },

  withinIncludingScrolloffsets: function(element, x, y) {
    var offsetcache = this.realOffset(element);

    this.xcomp = x + offsetcache[0] - this.deltaX;
    this.ycomp = y + offsetcache[1] - this.deltaY;
    this.offset = this.cumulativeOffset(element);

    return (this.ycomp >= this.offset[1] &&
            this.ycomp <  this.offset[1] + element.offsetHeight &&
            this.xcomp >= this.offset[0] &&
            this.xcomp <  this.offset[0] + element.offsetWidth);
  },

  // within must be called directly before
  overlap: function(mode, element) {
    if (!mode) return 0;
    if (mode == 'vertical')
      return ((this.offset[1] + element.offsetHeight) - this.ycomp) /
        element.offsetHeight;
    if (mode == 'horizontal')
      return ((this.offset[0] + element.offsetWidth) - this.xcomp) /
        element.offsetWidth;
  },

  page: function(forElement) {
    var valueT = 0, valueL = 0;

    var element = forElement;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;

      // Safari fix
      if (element.offsetParent==document.body)
        if (Element.getStyle(element,'position')=='absolute') break;

    } while (element = element.offsetParent);

    element = forElement;
    do {
      if (!window.opera || element.tagName=='BODY') {
        valueT -= element.scrollTop  || 0;
        valueL -= element.scrollLeft || 0;
      }
    } while (element = element.parentNode);

    return [valueL, valueT];
  },

  clone: function(source, target) {
    var options = Object.extend({
      setLeft:    true,
      setTop:     true,
      setWidth:   true,
      setHeight:  true,
      offsetTop:  0,
      offsetLeft: 0
    }, arguments[2] || {})

    // find page position of source
    source = $(source);
    var p = Position.page(source);

    // find coordinate system to use
    target = $(target);
    var delta = [0, 0];
    var parent = null;
    // delta [0,0] will do fine with position: fixed elements,
    // position:absolute needs offsetParent deltas
    if (Element.getStyle(target,'position') == 'absolute') {
      parent = Position.offsetParent(target);
      delta = Position.page(parent);
    }

    // correct by body offsets (fixes Safari)
    if (parent == document.body) {
      delta[0] -= document.body.offsetLeft;
      delta[1] -= document.body.offsetTop;
    }

    // set position
    if(options.setLeft)   target.style.left  = (p[0] - delta[0] + options.offsetLeft) + 'px';
    if(options.setTop)    target.style.top   = (p[1] - delta[1] + options.offsetTop) + 'px';
    if(options.setWidth)  target.style.width = source.offsetWidth + 'px';
    if(options.setHeight) target.style.height = source.offsetHeight + 'px';
  },

  absolutize: function(element) {
    element = $(element);
    if (element.style.position == 'absolute') return;
    Position.prepare();

    var offsets = Position.positionedOffset(element);
    var top     = offsets[1];
    var left    = offsets[0];
    var width   = element.clientWidth;
    var height  = element.clientHeight;

    element._originalLeft   = left - parseFloat(element.style.left  || 0);
    element._originalTop    = top  - parseFloat(element.style.top || 0);
    element._originalWidth  = element.style.width;
    element._originalHeight = element.style.height;

    element.style.position = 'absolute';
    element.style.top    = top + 'px';
    element.style.left   = left + 'px';
    element.style.width  = width + 'px';
    element.style.height = height + 'px';
  },

  relativize: function(element) {
    element = $(element);
    if (element.style.position == 'relative') return;
    Position.prepare();

    element.style.position = 'relative';
    var top  = parseFloat(element.style.top  || 0) - (element._originalTop || 0);
    var left = parseFloat(element.style.left || 0) - (element._originalLeft || 0);

    element.style.top    = top + 'px';
    element.style.left   = left + 'px';
    element.style.height = element._originalHeight;
    element.style.width  = element._originalWidth;
  }
}

// Safari returns margins on body which is incorrect if the child is absolutely
// positioned.  For performance reasons, redefine Position.cumulativeOffset for
// KHTML/WebKit only.
if (/Konqueror|Safari|KHTML/.test(navigator.userAgent)) {
  Position.cumulativeOffset = function(element) {
    var valueT = 0, valueL = 0;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;
      if (element.offsetParent == document.body)
        if (Element.getStyle(element, 'position') == 'absolute') break;

      element = element.offsetParent;
    } while (element);

    return [valueL, valueT];
  }
}

Element.addMethods();
// yahoo-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

if(typeof YAHOO=="undefined"){var YAHOO={};}
YAHOO.namespace=function(){var a=arguments,o=null,i,j,d;for(i=0;i<a.length;i=i+1){d=a[i].split(".");o=YAHOO;for(j=(d[0]=="YAHOO")?1:0;j<d.length;j=j+1){o[d[j]]=o[d[j]]||{};o=o[d[j]];}}
return o;};YAHOO.log=function(msg,cat,src){var l=YAHOO.widget.Logger;if(l&&l.log){return l.log(msg,cat,src);}else{return false;}};YAHOO.init=function(){this.namespace("util","widget","example");if(typeof YAHOO_config!="undefined"){var l=YAHOO_config.listener,ls=YAHOO.env.listeners,unique=true,i;if(l){for(i=0;i<ls.length;i=i+1){if(ls[i]==l){unique=false;break;}}
if(unique){ls.push(l);}}}};YAHOO.register=function(name,mainClass,data){var mods=YAHOO.env.modules;if(!mods[name]){mods[name]={versions:[],builds:[]};}
var m=mods[name],v=data.version,b=data.build,ls=YAHOO.env.listeners;m.name=name;m.version=v;m.build=b;m.versions.push(v);m.builds.push(b);m.mainClass=mainClass;for(var i=0;i<ls.length;i=i+1){ls[i](m);}
if(mainClass){mainClass.VERSION=v;mainClass.BUILD=b;}else{YAHOO.log("mainClass is undefined for module "+name,"warn");}};YAHOO.env=YAHOO.env||{modules:[],listeners:[],getVersion:function(name){return YAHOO.env.modules[name]||null;}};YAHOO.lang={isArray:function(obj){if(obj&&obj.constructor&&obj.constructor.toString().indexOf('Array')>-1){return true;}else{return YAHOO.lang.isObject(obj)&&obj.constructor==Array;}},isBoolean:function(obj){return typeof obj=='boolean';},isFunction:function(obj){return typeof obj=='function';},isNull:function(obj){return obj===null;},isNumber:function(obj){return typeof obj=='number'&&isFinite(obj);},isObject:function(obj){return obj&&(typeof obj=='object'||YAHOO.lang.isFunction(obj));},isString:function(obj){return typeof obj=='string';},isUndefined:function(obj){return typeof obj=='undefined';},hasOwnProperty:function(obj,prop){if(Object.prototype.hasOwnProperty){return obj.hasOwnProperty(prop);}
return!YAHOO.lang.isUndefined(obj[prop])&&obj.constructor.prototype[prop]!==obj[prop];},extend:function(subc,superc,overrides){if(!superc||!subc){throw new Error("YAHOO.lang.extend failed, please check that "+"all dependencies are included.");}
var F=function(){};F.prototype=superc.prototype;subc.prototype=new F();subc.prototype.constructor=subc;subc.superclass=superc.prototype;if(superc.prototype.constructor==Object.prototype.constructor){superc.prototype.constructor=superc;}
if(overrides){for(var i in overrides){subc.prototype[i]=overrides[i];}}},augment:function(r,s){if(!s||!r){throw new Error("YAHOO.lang.augment failed, please check that "+"all dependencies are included.");}
var rp=r.prototype,sp=s.prototype,a=arguments,i,p;if(a[2]){for(i=2;i<a.length;i=i+1){rp[a[i]]=sp[a[i]];}}else{for(p in sp){if(!rp[p]){rp[p]=sp[p];}}}}};YAHOO.init();YAHOO.util.Lang=YAHOO.lang;YAHOO.augment=YAHOO.lang.augment;YAHOO.extend=YAHOO.lang.extend;YAHOO.register("yahoo",YAHOO,{version:"2.2.2",build:"204"});
// connection-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

YAHOO.util.Connect={_msxml_progid:['MSXML2.XMLHTTP.3.0','MSXML2.XMLHTTP','Microsoft.XMLHTTP'],_http_headers:{},_has_http_headers:false,_use_default_post_header:true,_default_post_header:'application/x-www-form-urlencoded; charset=UTF-8',_use_default_xhr_header:true,_default_xhr_header:'XMLHttpRequest',_has_default_headers:true,_default_headers:{},_isFormSubmit:false,_isFileUpload:false,_formNode:null,_sFormData:null,_poll:{},_timeOut:{},_polling_interval:50,_transaction_id:0,_submitElementValue:null,_hasSubmitListener:(function()
{if(YAHOO.util.Event){YAHOO.util.Event.addListener(document,'click',function(e){var obj=YAHOO.util.Event.getTarget(e);if(obj.type=='submit'){YAHOO.util.Connect._submitElementValue=encodeURIComponent(obj.name)+"="+encodeURIComponent(obj.value);}})
return true;}
return false;})(),setProgId:function(id)
{this._msxml_progid.unshift(id);},setDefaultPostHeader:function(b)
{this._use_default_post_header=b;},setDefaultXhrHeader:function(b)
{this._use_default_xhr_header=b;},setPollingInterval:function(i)
{if(typeof i=='number'&&isFinite(i)){this._polling_interval=i;}},createXhrObject:function(transactionId)
{var obj,http;try
{http=new XMLHttpRequest();obj={conn:http,tId:transactionId};}
catch(e)
{for(var i=0;i<this._msxml_progid.length;++i){try
{http=new ActiveXObject(this._msxml_progid[i]);obj={conn:http,tId:transactionId};break;}
catch(e){}}}
finally
{return obj;}},getConnectionObject:function()
{var o;var tId=this._transaction_id;try
{o=this.createXhrObject(tId);if(o){this._transaction_id++;}}
catch(e){}
finally
{return o;}},asyncRequest:function(method,uri,callback,postData)
{var o=this.getConnectionObject();if(!o){return null;}
else{if(this._isFormSubmit){if(this._isFileUpload){this.uploadFile(o.tId,callback,uri,postData);this.releaseObject(o);return;}
if(method.toUpperCase()=='GET'){if(this._sFormData.length!=0){uri+=((uri.indexOf('?')==-1)?'?':'&')+this._sFormData;}
else{uri+="?"+this._sFormData;}}
else if(method.toUpperCase()=='POST'){postData=postData?this._sFormData+"&"+postData:this._sFormData;}}
o.conn.open(method,uri,true);if(this._use_default_xhr_header){if(!this._default_headers['X-Requested-With']){this.initHeader('X-Requested-With',this._default_xhr_header,true);}}
if(this._isFormSubmit||(postData&&this._use_default_post_header)){this.initHeader('Content-Type',this._default_post_header);if(this._isFormSubmit){this.resetFormState();}}
if(this._has_default_headers||this._has_http_headers){this.setHeader(o);}
this.handleReadyState(o,callback);o.conn.send(postData||null);return o;}},handleReadyState:function(o,callback)
{var oConn=this;if(callback&&callback.timeout){this._timeOut[o.tId]=window.setTimeout(function(){oConn.abort(o,callback,true);},callback.timeout);}
this._poll[o.tId]=window.setInterval(function(){if(o.conn&&o.conn.readyState===4){window.clearInterval(oConn._poll[o.tId]);delete oConn._poll[o.tId];if(callback&&callback.timeout){delete oConn._timeOut[o.tId];}
oConn.handleTransactionResponse(o,callback);}},this._polling_interval);},handleTransactionResponse:function(o,callback,isAbort)
{if(!callback){this.releaseObject(o);return;}
var httpStatus,responseObject;try
{if(o.conn.status!==undefined&&o.conn.status!==0){httpStatus=o.conn.status;}
else{httpStatus=13030;}}
catch(e){httpStatus=13030;}
if(httpStatus>=200&&httpStatus<300||httpStatus===1223){responseObject=this.createResponseObject(o,callback.argument);if(callback.success){if(!callback.scope){callback.success(responseObject);}
else{callback.success.apply(callback.scope,[responseObject]);}}}
else{switch(httpStatus){case 12002:case 12029:case 12030:case 12031:case 12152:case 13030:responseObject=this.createExceptionObject(o.tId,callback.argument,(isAbort?isAbort:false));if(callback.failure){if(!callback.scope){callback.failure(responseObject);}
else{callback.failure.apply(callback.scope,[responseObject]);}}
break;default:responseObject=this.createResponseObject(o,callback.argument);if(callback.failure){if(!callback.scope){callback.failure(responseObject);}
else{callback.failure.apply(callback.scope,[responseObject]);}}}}
this.releaseObject(o);responseObject=null;},createResponseObject:function(o,callbackArg)
{var obj={};var headerObj={};try
{var headerStr=o.conn.getAllResponseHeaders();var header=headerStr.split('\n');for(var i=0;i<header.length;i++){var delimitPos=header[i].indexOf(':');if(delimitPos!=-1){headerObj[header[i].substring(0,delimitPos)]=header[i].substring(delimitPos+2);}}}
catch(e){}
obj.tId=o.tId;obj.status=(o.conn.status==1223)?204:o.conn.status;obj.statusText=(o.conn.status==1223)?"No Content":o.conn.statusText;obj.getResponseHeader=headerObj;obj.getAllResponseHeaders=headerStr;obj.responseText=o.conn.responseText;obj.responseXML=o.conn.responseXML;if(typeof callbackArg!==undefined){obj.argument=callbackArg;}
return obj;},createExceptionObject:function(tId,callbackArg,isAbort)
{var COMM_CODE=0;var COMM_ERROR='communication failure';var ABORT_CODE=-1;var ABORT_ERROR='transaction aborted';var obj={};obj.tId=tId;if(isAbort){obj.status=ABORT_CODE;obj.statusText=ABORT_ERROR;}
else{obj.status=COMM_CODE;obj.statusText=COMM_ERROR;}
if(callbackArg){obj.argument=callbackArg;}
return obj;},initHeader:function(label,value,isDefault)
{var headerObj=(isDefault)?this._default_headers:this._http_headers;if(headerObj[label]===undefined){headerObj[label]=value;}
else{headerObj[label]=value+","+headerObj[label];}
if(isDefault){this._has_default_headers=true;}
else{this._has_http_headers=true;}},setHeader:function(o)
{if(this._has_default_headers){for(var prop in this._default_headers){if(YAHOO.lang.hasOwnProperty(this._default_headers,prop)){o.conn.setRequestHeader(prop,this._default_headers[prop]);}}}
if(this._has_http_headers){for(var prop in this._http_headers){if(YAHOO.lang.hasOwnProperty(this._http_headers,prop)){o.conn.setRequestHeader(prop,this._http_headers[prop]);}}
delete this._http_headers;this._http_headers={};this._has_http_headers=false;}},resetDefaultHeaders:function(){delete this._default_headers
this._default_headers={};this._has_default_headers=false;},setForm:function(formId,isUpload,secureUri)
{this.resetFormState();var oForm;if(typeof formId=='string'){oForm=(document.getElementById(formId)||document.forms[formId]);}
else if(typeof formId=='object'){oForm=formId;}
else{return;}
if(isUpload){this.createFrame(secureUri?secureUri:null);this._isFormSubmit=true;this._isFileUpload=true;this._formNode=oForm;return;}
var oElement,oName,oValue,oDisabled;var hasSubmit=false;for(var i=0;i<oForm.elements.length;i++){oElement=oForm.elements[i];oDisabled=oForm.elements[i].disabled;oName=oForm.elements[i].name;oValue=oForm.elements[i].value;if(!oDisabled&&oName)
{switch(oElement.type)
{case'select-one':case'select-multiple':for(var j=0;j<oElement.options.length;j++){if(oElement.options[j].selected){if(window.ActiveXObject){this._sFormData+=encodeURIComponent(oName)+'='+encodeURIComponent(oElement.options[j].attributes['value'].specified?oElement.options[j].value:oElement.options[j].text)+'&';}
else{this._sFormData+=encodeURIComponent(oName)+'='+encodeURIComponent(oElement.options[j].hasAttribute('value')?oElement.options[j].value:oElement.options[j].text)+'&';}}}
break;case'radio':case'checkbox':if(oElement.checked){this._sFormData+=encodeURIComponent(oName)+'='+encodeURIComponent(oValue)+'&';}
break;case'file':case undefined:case'reset':case'button':break;case'submit':if(hasSubmit===false){if(this._hasSubmitListener){this._sFormData+=this._submitElementValue+'&';}
else{this._sFormData+=encodeURIComponent(oName)+'='+encodeURIComponent(oValue)+'&';}
hasSubmit=true;}
break;default:this._sFormData+=encodeURIComponent(oName)+'='+encodeURIComponent(oValue)+'&';break;}}}
this._isFormSubmit=true;this._sFormData=this._sFormData.substr(0,this._sFormData.length-1);return this._sFormData;},resetFormState:function(){this._isFormSubmit=false;this._isFileUpload=false;this._formNode=null;this._sFormData="";},createFrame:function(secureUri){var frameId='yuiIO'+this._transaction_id;if(window.ActiveXObject){var io=document.createElement('<iframe id="'+frameId+'" name="'+frameId+'" />');if(typeof secureUri=='boolean'){io.src='javascript:false';}
else if(typeof secureURI=='string'){io.src=secureUri;}}
else{var io=document.createElement('iframe');io.id=frameId;io.name=frameId;}
io.style.position='absolute';io.style.top='-1000px';io.style.left='-1000px';document.body.appendChild(io);},appendPostData:function(postData)
{var formElements=[];var postMessage=postData.split('&');for(var i=0;i<postMessage.length;i++){var delimitPos=postMessage[i].indexOf('=');if(delimitPos!=-1){formElements[i]=document.createElement('input');formElements[i].type='hidden';formElements[i].name=postMessage[i].substring(0,delimitPos);formElements[i].value=postMessage[i].substring(delimitPos+1);this._formNode.appendChild(formElements[i]);}}
return formElements;},uploadFile:function(id,callback,uri,postData){var frameId='yuiIO'+id;var uploadEncoding='multipart/form-data';var io=document.getElementById(frameId);this._formNode.setAttribute('action',uri);this._formNode.setAttribute('method','POST');this._formNode.setAttribute("target",frameId);if(this._formNode.encoding){this._formNode.encoding=uploadEncoding;}
else{this._formNode.enctype=uploadEncoding;}
if(postData){var oElements=this.appendPostData(postData);}
this._formNode.submit();if(oElements&&oElements.length>0){for(var i=0;i<oElements.length;i++){this._formNode.removeChild(oElements[i]);}}
this.resetFormState();var uploadCallback=function()
{var obj={};obj.tId=id;obj.argument=callback.argument;try
{obj.responseText=io.contentWindow.document.body?io.contentWindow.document.body.innerHTML:null;obj.responseXML=io.contentWindow.document.XMLDocument?io.contentWindow.document.XMLDocument:io.contentWindow.document;}
catch(e){}
if(callback&&callback.upload){if(!callback.scope){callback.upload(obj);}
else{callback.upload.apply(callback.scope,[obj]);}}
if(YAHOO.util.Event){YAHOO.util.Event.removeListener(io,"load",uploadCallback);}
else if(window.detachEvent){io.detachEvent('onload',uploadCallback);}
else{io.removeEventListener('load',uploadCallback,false);}
setTimeout(function(){document.body.removeChild(io);},100);};if(YAHOO.util.Event){YAHOO.util.Event.addListener(io,"load",uploadCallback);}
else if(window.attachEvent){io.attachEvent('onload',uploadCallback);}
else{io.addEventListener('load',uploadCallback,false);}},abort:function(o,callback,isTimeout)
{if(this.isCallInProgress(o)){o.conn.abort();window.clearInterval(this._poll[o.tId]);delete this._poll[o.tId];if(isTimeout){delete this._timeOut[o.tId];}
this.handleTransactionResponse(o,callback,true);return true;}
else{return false;}},isCallInProgress:function(o)
{if(o.conn){return o.conn.readyState!==4&&o.conn.readyState!==0;}
else{return false;}},releaseObject:function(o)
{o.conn=null;o=null;}};YAHOO.register("connection",YAHOO.util.Connect,{version:"2.2.2",build:"204"});
// event-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

YAHOO.util.CustomEvent=function(type,oScope,silent,signature){this.type=type;this.scope=oScope||window;this.silent=silent;this.signature=signature||YAHOO.util.CustomEvent.LIST;this.subscribers=[];if(!this.silent){}
var onsubscribeType="_YUICEOnSubscribe";if(type!==onsubscribeType){this.subscribeEvent=new YAHOO.util.CustomEvent(onsubscribeType,this,true);}};YAHOO.util.CustomEvent.LIST=0;YAHOO.util.CustomEvent.FLAT=1;YAHOO.util.CustomEvent.prototype={subscribe:function(fn,obj,override){if(!fn){throw new Error("Invalid callback for subscriber to '"+this.type+"'");}
if(this.subscribeEvent){this.subscribeEvent.fire(fn,obj,override);}
this.subscribers.push(new YAHOO.util.Subscriber(fn,obj,override));},unsubscribe:function(fn,obj){if(!fn){return this.unsubscribeAll();}
var found=false;for(var i=0,len=this.subscribers.length;i<len;++i){var s=this.subscribers[i];if(s&&s.contains(fn,obj)){this._delete(i);found=true;}}
return found;},fire:function(){var len=this.subscribers.length;if(!len&&this.silent){return true;}
var args=[],ret=true,i;for(i=0;i<arguments.length;++i){args.push(arguments[i]);}
var argslength=args.length;if(!this.silent){}
for(i=0;i<len;++i){var s=this.subscribers[i];if(s){if(!this.silent){}
var scope=s.getScope(this.scope);if(this.signature==YAHOO.util.CustomEvent.FLAT){var param=null;if(args.length>0){param=args[0];}
ret=s.fn.call(scope,param,s.obj);}else{ret=s.fn.call(scope,this.type,args,s.obj);}
if(false===ret){if(!this.silent){}
return false;}}}
return true;},unsubscribeAll:function(){for(var i=0,len=this.subscribers.length;i<len;++i){this._delete(len-1-i);}
return i;},_delete:function(index){var s=this.subscribers[index];if(s){delete s.fn;delete s.obj;}
this.subscribers.splice(index,1);},toString:function(){return"CustomEvent: "+"'"+this.type+"', "+"scope: "+this.scope;}};YAHOO.util.Subscriber=function(fn,obj,override){this.fn=fn;this.obj=obj||null;this.override=override;};YAHOO.util.Subscriber.prototype.getScope=function(defaultScope){if(this.override){if(this.override===true){return this.obj;}else{return this.override;}}
return defaultScope;};YAHOO.util.Subscriber.prototype.contains=function(fn,obj){if(obj){return(this.fn==fn&&this.obj==obj);}else{return(this.fn==fn);}};YAHOO.util.Subscriber.prototype.toString=function(){return"Subscriber { obj: "+(this.obj||"")+", override: "+(this.override||"no")+" }";};if(!YAHOO.util.Event){YAHOO.util.Event=function(){var loadComplete=false;var DOMReady=false;var listeners=[];var unloadListeners=[];var legacyEvents=[];var legacyHandlers=[];var retryCount=0;var onAvailStack=[];var legacyMap=[];var counter=0;var lastError=null;return{POLL_RETRYS:200,POLL_INTERVAL:10,EL:0,TYPE:1,FN:2,WFN:3,OBJ:3,ADJ_SCOPE:4,isSafari:(/KHTML/gi).test(navigator.userAgent),webkit:function(){var v=navigator.userAgent.match(/AppleWebKit\/([^ ]*)/);if(v&&v[1]){return v[1];}
return null;}(),isIE:(!this.webkit&&!navigator.userAgent.match(/opera/gi)&&navigator.userAgent.match(/msie/gi)),_interval:null,startInterval:function(){if(!this._interval){var self=this;var callback=function(){self._tryPreloadAttach();};this._interval=setInterval(callback,this.POLL_INTERVAL);}},onAvailable:function(p_id,p_fn,p_obj,p_override){onAvailStack.push({id:p_id,fn:p_fn,obj:p_obj,override:p_override,checkReady:false});retryCount=this.POLL_RETRYS;this.startInterval();},onDOMReady:function(p_fn,p_obj,p_override){this.DOMReadyEvent.subscribe(p_fn,p_obj,p_override);},onContentReady:function(p_id,p_fn,p_obj,p_override){onAvailStack.push({id:p_id,fn:p_fn,obj:p_obj,override:p_override,checkReady:true});retryCount=this.POLL_RETRYS;this.startInterval();},addListener:function(el,sType,fn,obj,override){if(!fn||!fn.call){return false;}
if(this._isValidCollection(el)){var ok=true;for(var i=0,len=el.length;i<len;++i){ok=this.on(el[i],sType,fn,obj,override)&&ok;}
return ok;}else if(typeof el=="string"){var oEl=this.getEl(el);if(oEl){el=oEl;}else{this.onAvailable(el,function(){YAHOO.util.Event.on(el,sType,fn,obj,override);});return true;}}
if(!el){return false;}
if("unload"==sType&&obj!==this){unloadListeners[unloadListeners.length]=[el,sType,fn,obj,override];return true;}
var scope=el;if(override){if(override===true){scope=obj;}else{scope=override;}}
var wrappedFn=function(e){return fn.call(scope,YAHOO.util.Event.getEvent(e),obj);};var li=[el,sType,fn,wrappedFn,scope];var index=listeners.length;listeners[index]=li;if(this.useLegacyEvent(el,sType)){var legacyIndex=this.getLegacyIndex(el,sType);if(legacyIndex==-1||el!=legacyEvents[legacyIndex][0]){legacyIndex=legacyEvents.length;legacyMap[el.id+sType]=legacyIndex;legacyEvents[legacyIndex]=[el,sType,el["on"+sType]];legacyHandlers[legacyIndex]=[];el["on"+sType]=function(e){YAHOO.util.Event.fireLegacyEvent(YAHOO.util.Event.getEvent(e),legacyIndex);};}
legacyHandlers[legacyIndex].push(li);}else{try{this._simpleAdd(el,sType,wrappedFn,false);}catch(ex){this.lastError=ex;this.removeListener(el,sType,fn);return false;}}
return true;},fireLegacyEvent:function(e,legacyIndex){var ok=true,le,lh,li,scope,ret;lh=legacyHandlers[legacyIndex];for(var i=0,len=lh.length;i<len;++i){li=lh[i];if(li&&li[this.WFN]){scope=li[this.ADJ_SCOPE];ret=li[this.WFN].call(scope,e);ok=(ok&&ret);}}
le=legacyEvents[legacyIndex];if(le&&le[2]){le[2](e);}
return ok;},getLegacyIndex:function(el,sType){var key=this.generateId(el)+sType;if(typeof legacyMap[key]=="undefined"){return-1;}else{return legacyMap[key];}},useLegacyEvent:function(el,sType){if(this.webkit&&("click"==sType||"dblclick"==sType)){var v=parseInt(this.webkit,10);if(!isNaN(v)&&v<418){return true;}}
return false;},removeListener:function(el,sType,fn){var i,len;if(typeof el=="string"){el=this.getEl(el);}else if(this._isValidCollection(el)){var ok=true;for(i=0,len=el.length;i<len;++i){ok=(this.removeListener(el[i],sType,fn)&&ok);}
return ok;}
if(!fn||!fn.call){return this.purgeElement(el,false,sType);}
if("unload"==sType){for(i=0,len=unloadListeners.length;i<len;i++){var li=unloadListeners[i];if(li&&li[0]==el&&li[1]==sType&&li[2]==fn){unloadListeners.splice(i,1);return true;}}
return false;}
var cacheItem=null;var index=arguments[3];if("undefined"==typeof index){index=this._getCacheIndex(el,sType,fn);}
if(index>=0){cacheItem=listeners[index];}
if(!el||!cacheItem){return false;}
if(this.useLegacyEvent(el,sType)){var legacyIndex=this.getLegacyIndex(el,sType);var llist=legacyHandlers[legacyIndex];if(llist){for(i=0,len=llist.length;i<len;++i){li=llist[i];if(li&&li[this.EL]==el&&li[this.TYPE]==sType&&li[this.FN]==fn){llist.splice(i,1);break;}}}}else{try{this._simpleRemove(el,sType,cacheItem[this.WFN],false);}catch(ex){this.lastError=ex;return false;}}
delete listeners[index][this.WFN];delete listeners[index][this.FN];listeners.splice(index,1);return true;},getTarget:function(ev,resolveTextNode){var t=ev.target||ev.srcElement;return this.resolveTextNode(t);},resolveTextNode:function(node){if(node&&3==node.nodeType){return node.parentNode;}else{return node;}},getPageX:function(ev){var x=ev.pageX;if(!x&&0!==x){x=ev.clientX||0;if(this.isIE){x+=this._getScrollLeft();}}
return x;},getPageY:function(ev){var y=ev.pageY;if(!y&&0!==y){y=ev.clientY||0;if(this.isIE){y+=this._getScrollTop();}}
return y;},getXY:function(ev){return[this.getPageX(ev),this.getPageY(ev)];},getRelatedTarget:function(ev){var t=ev.relatedTarget;if(!t){if(ev.type=="mouseout"){t=ev.toElement;}else if(ev.type=="mouseover"){t=ev.fromElement;}}
return this.resolveTextNode(t);},getTime:function(ev){if(!ev.time){var t=new Date().getTime();try{ev.time=t;}catch(ex){this.lastError=ex;return t;}}
return ev.time;},stopEvent:function(ev){this.stopPropagation(ev);this.preventDefault(ev);},stopPropagation:function(ev){if(ev.stopPropagation){ev.stopPropagation();}else{ev.cancelBubble=true;}},preventDefault:function(ev){if(ev.preventDefault){ev.preventDefault();}else{ev.returnValue=false;}},getEvent:function(e){var ev=e||window.event;if(!ev){var c=this.getEvent.caller;while(c){ev=c.arguments[0];if(ev&&Event==ev.constructor){break;}
c=c.caller;}}
return ev;},getCharCode:function(ev){return ev.charCode||ev.keyCode||0;},_getCacheIndex:function(el,sType,fn){for(var i=0,len=listeners.length;i<len;++i){var li=listeners[i];if(li&&li[this.FN]==fn&&li[this.EL]==el&&li[this.TYPE]==sType){return i;}}
return-1;},generateId:function(el){var id=el.id;if(!id){id="yuievtautoid-"+counter;++counter;el.id=id;}
return id;},_isValidCollection:function(o){return(o&&o.length&&typeof o!="string"&&!o.tagName&&!o.alert&&typeof o[0]!="undefined");},elCache:{},getEl:function(id){return document.getElementById(id);},clearCache:function(){},DOMReadyEvent:new YAHOO.util.CustomEvent("DOMReady",this),_load:function(e){if(!loadComplete){loadComplete=true;var EU=YAHOO.util.Event;EU._ready();if(this.isIE){EU._simpleRemove(window,"load",EU._load);}}},_ready:function(e){if(!DOMReady){DOMReady=true;var EU=YAHOO.util.Event;EU.DOMReadyEvent.fire();EU._simpleRemove(document,"DOMContentLoaded",EU._ready);}},_tryPreloadAttach:function(){if(this.locked){return false;}
if(this.isIE&&!DOMReady){return false;}
this.locked=true;var tryAgain=!loadComplete;if(!tryAgain){tryAgain=(retryCount>0);}
var notAvail=[];var executeItem=function(el,item){var scope=el;if(item.override){if(item.override===true){scope=item.obj;}else{scope=item.override;}}
item.fn.call(scope,item.obj);};var i,len,item,el;for(i=0,len=onAvailStack.length;i<len;++i){item=onAvailStack[i];if(item&&!item.checkReady){el=this.getEl(item.id);if(el){executeItem(el,item);onAvailStack[i]=null;}else{notAvail.push(item);}}}
for(i=0,len=onAvailStack.length;i<len;++i){item=onAvailStack[i];if(item&&item.checkReady){el=this.getEl(item.id);if(el){if(loadComplete||el.nextSibling){executeItem(el,item);onAvailStack[i]=null;}}else{notAvail.push(item);}}}
retryCount=(notAvail.length===0)?0:retryCount-1;if(tryAgain){this.startInterval();}else{clearInterval(this._interval);this._interval=null;}
this.locked=false;return true;},purgeElement:function(el,recurse,sType){var elListeners=this.getListeners(el,sType);if(elListeners){for(var i=0,len=elListeners.length;i<len;++i){var l=elListeners[i];this.removeListener(el,l.type,l.fn);}}
if(recurse&&el&&el.childNodes){for(i=0,len=el.childNodes.length;i<len;++i){this.purgeElement(el.childNodes[i],recurse,sType);}}},getListeners:function(el,sType){var results=[],searchLists;if(!sType){searchLists=[listeners,unloadListeners];}else if(sType=="unload"){searchLists=[unloadListeners];}else{searchLists=[listeners];}
for(var j=0;j<searchLists.length;++j){var searchList=searchLists[j];if(searchList&&searchList.length>0){for(var i=0,len=searchList.length;i<len;++i){var l=searchList[i];if(l&&l[this.EL]===el&&(!sType||sType===l[this.TYPE])){results.push({type:l[this.TYPE],fn:l[this.FN],obj:l[this.OBJ],adjust:l[this.ADJ_SCOPE],index:i});}}}}
return(results.length)?results:null;},_unload:function(e){var EU=YAHOO.util.Event,i,j,l,len,index;for(i=0,len=unloadListeners.length;i<len;++i){l=unloadListeners[i];if(l){var scope=window;if(l[EU.ADJ_SCOPE]){if(l[EU.ADJ_SCOPE]===true){scope=l[EU.OBJ];}else{scope=l[EU.ADJ_SCOPE];}}
l[EU.FN].call(scope,EU.getEvent(e),l[EU.OBJ]);unloadListeners[i]=null;l=null;scope=null;}}
unloadListeners=null;if(listeners&&listeners.length>0){j=listeners.length;while(j){index=j-1;l=listeners[index];if(l){EU.removeListener(l[EU.EL],l[EU.TYPE],l[EU.FN],index);}
j=j-1;}
l=null;EU.clearCache();}
for(i=0,len=legacyEvents.length;i<len;++i){legacyEvents[i][0]=null;legacyEvents[i]=null;}
legacyEvents=null;EU._simpleRemove(window,"unload",EU._unload);},_getScrollLeft:function(){return this._getScroll()[1];},_getScrollTop:function(){return this._getScroll()[0];},_getScroll:function(){var dd=document.documentElement,db=document.body;if(dd&&(dd.scrollTop||dd.scrollLeft)){return[dd.scrollTop,dd.scrollLeft];}else if(db){return[db.scrollTop,db.scrollLeft];}else{return[0,0];}},regCE:function(){},_simpleAdd:function(){if(window.addEventListener){return function(el,sType,fn,capture){el.addEventListener(sType,fn,(capture));};}else if(window.attachEvent){return function(el,sType,fn,capture){el.attachEvent("on"+sType,fn);};}else{return function(){};}}(),_simpleRemove:function(){if(window.removeEventListener){return function(el,sType,fn,capture){el.removeEventListener(sType,fn,(capture));};}else if(window.detachEvent){return function(el,sType,fn){el.detachEvent("on"+sType,fn);};}else{return function(){};}}()};}();(function(){var EU=YAHOO.util.Event;EU.on=EU.addListener;if(EU.isIE){document.write('<scr'+'ipt id="_yui_eu_dr" defer="true" src="//:"></script>');var el=document.getElementById("_yui_eu_dr");el.onreadystatechange=function(){if("complete"==this.readyState){this.parentNode.removeChild(this);YAHOO.util.Event._ready();}};el=null;YAHOO.util.Event.onDOMReady(YAHOO.util.Event._tryPreloadAttach,YAHOO.util.Event,true);}else if(EU.webkit){EU._drwatch=setInterval(function(){var rs=document.readyState;if("loaded"==rs||"complete"==rs){clearInterval(EU._drwatch);EU._drwatch=null;EU._ready();}},EU.POLL_INTERVAL);}else{EU._simpleAdd(document,"DOMContentLoaded",EU._ready);}
EU._simpleAdd(window,"load",EU._load);EU._simpleAdd(window,"unload",EU._unload);EU._tryPreloadAttach();})();}
YAHOO.util.EventProvider=function(){};YAHOO.util.EventProvider.prototype={__yui_events:null,__yui_subscribers:null,subscribe:function(p_type,p_fn,p_obj,p_override){this.__yui_events=this.__yui_events||{};var ce=this.__yui_events[p_type];if(ce){ce.subscribe(p_fn,p_obj,p_override);}else{this.__yui_subscribers=this.__yui_subscribers||{};var subs=this.__yui_subscribers;if(!subs[p_type]){subs[p_type]=[];}
subs[p_type].push({fn:p_fn,obj:p_obj,override:p_override});}},unsubscribe:function(p_type,p_fn,p_obj){this.__yui_events=this.__yui_events||{};var ce=this.__yui_events[p_type];if(ce){return ce.unsubscribe(p_fn,p_obj);}else{return false;}},unsubscribeAll:function(p_type){return this.unsubscribe(p_type);},createEvent:function(p_type,p_config){this.__yui_events=this.__yui_events||{};var opts=p_config||{};var events=this.__yui_events;if(events[p_type]){}else{var scope=opts.scope||this;var silent=opts.silent||null;var ce=new YAHOO.util.CustomEvent(p_type,scope,silent,YAHOO.util.CustomEvent.FLAT);events[p_type]=ce;if(opts.onSubscribeCallback){ce.subscribeEvent.subscribe(opts.onSubscribeCallback);}
this.__yui_subscribers=this.__yui_subscribers||{};var qs=this.__yui_subscribers[p_type];if(qs){for(var i=0;i<qs.length;++i){ce.subscribe(qs[i].fn,qs[i].obj,qs[i].override);}}}
return events[p_type];},fireEvent:function(p_type,arg1,arg2,etc){this.__yui_events=this.__yui_events||{};var ce=this.__yui_events[p_type];if(ce){var args=[];for(var i=1;i<arguments.length;++i){args.push(arguments[i]);}
return ce.fire.apply(ce,args);}else{return null;}},hasEvent:function(type){if(this.__yui_events){if(this.__yui_events[type]){return true;}}
return false;}};YAHOO.util.KeyListener=function(attachTo,keyData,handler,event){if(!attachTo){}else if(!keyData){}else if(!handler){}
if(!event){event=YAHOO.util.KeyListener.KEYDOWN;}
var keyEvent=new YAHOO.util.CustomEvent("keyPressed");this.enabledEvent=new YAHOO.util.CustomEvent("enabled");this.disabledEvent=new YAHOO.util.CustomEvent("disabled");if(typeof attachTo=='string'){attachTo=document.getElementById(attachTo);}
if(typeof handler=='function'){keyEvent.subscribe(handler);}else{keyEvent.subscribe(handler.fn,handler.scope,handler.correctScope);}
function handleKeyPress(e,obj){if(!keyData.shift){keyData.shift=false;}
if(!keyData.alt){keyData.alt=false;}
if(!keyData.ctrl){keyData.ctrl=false;}
if(e.shiftKey==keyData.shift&&e.altKey==keyData.alt&&e.ctrlKey==keyData.ctrl){var dataItem;var keyPressed;if(keyData.keys instanceof Array){for(var i=0;i<keyData.keys.length;i++){dataItem=keyData.keys[i];if(dataItem==e.charCode){keyEvent.fire(e.charCode,e);break;}else if(dataItem==e.keyCode){keyEvent.fire(e.keyCode,e);break;}}}else{dataItem=keyData.keys;if(dataItem==e.charCode){keyEvent.fire(e.charCode,e);}else if(dataItem==e.keyCode){keyEvent.fire(e.keyCode,e);}}}}
this.enable=function(){if(!this.enabled){YAHOO.util.Event.addListener(attachTo,event,handleKeyPress);this.enabledEvent.fire(keyData);}
this.enabled=true;};this.disable=function(){if(this.enabled){YAHOO.util.Event.removeListener(attachTo,event,handleKeyPress);this.disabledEvent.fire(keyData);}
this.enabled=false;};this.toString=function(){return"KeyListener ["+keyData.keys+"] "+attachTo.tagName+
(attachTo.id?"["+attachTo.id+"]":"");};};YAHOO.util.KeyListener.KEYDOWN="keydown";YAHOO.util.KeyListener.KEYUP="keyup";YAHOO.register("event",YAHOO.util.Event,{version:"2.2.2",build:"204"});
// dom-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

(function(){var Y=YAHOO.util,getStyle,setStyle,id_counter=0,propertyCache={};var ua=navigator.userAgent.toLowerCase(),isOpera=(ua.indexOf('opera')>-1),isSafari=(ua.indexOf('safari')>-1),isGecko=(!isOpera&&!isSafari&&ua.indexOf('gecko')>-1),isIE=(!isOpera&&ua.indexOf('msie')>-1);var patterns={HYPHEN:/(-[a-z])/i,ROOT_TAG:/body|html/i};var toCamel=function(property){if(!patterns.HYPHEN.test(property)){return property;}
if(propertyCache[property]){return propertyCache[property];}
var converted=property;while(patterns.HYPHEN.exec(converted)){converted=converted.replace(RegExp.$1,RegExp.$1.substr(1).toUpperCase());}
propertyCache[property]=converted;return converted;};if(document.defaultView&&document.defaultView.getComputedStyle){getStyle=function(el,property){var value=null;if(property=='float'){property='cssFloat';}
var computed=document.defaultView.getComputedStyle(el,'');if(computed){value=computed[toCamel(property)];}
return el.style[property]||value;};}else if(document.documentElement.currentStyle&&isIE){getStyle=function(el,property){switch(toCamel(property)){case'opacity':var val=100;try{val=el.filters['DXImageTransform.Microsoft.Alpha'].opacity;}catch(e){try{val=el.filters('alpha').opacity;}catch(e){}}
return val/100;break;case'float':property='styleFloat';default:var value=el.currentStyle?el.currentStyle[property]:null;return(el.style[property]||value);}};}else{getStyle=function(el,property){return el.style[property];};}
if(isIE){setStyle=function(el,property,val){switch(property){case'opacity':if(YAHOO.lang.isString(el.style.filter)){el.style.filter='alpha(opacity='+val*100+')';if(!el.currentStyle||!el.currentStyle.hasLayout){el.style.zoom=1;}}
break;case'float':property='styleFloat';default:el.style[property]=val;}};}else{setStyle=function(el,property,val){if(property=='float'){property='cssFloat';}
el.style[property]=val;};}
YAHOO.util.Dom={get:function(el){if(YAHOO.lang.isString(el)){return document.getElementById(el);}
if(YAHOO.lang.isArray(el)){var c=[];for(var i=0,len=el.length;i<len;++i){c[c.length]=Y.Dom.get(el[i]);}
return c;}
if(el){return el;}
return null;},getStyle:function(el,property){property=toCamel(property);var f=function(element){return getStyle(element,property);};return Y.Dom.batch(el,f,Y.Dom,true);},setStyle:function(el,property,val){property=toCamel(property);var f=function(element){setStyle(element,property,val);};Y.Dom.batch(el,f,Y.Dom,true);},getXY:function(el){var f=function(el){if((el.parentNode===null||el.offsetParent===null||this.getStyle(el,'display')=='none')&&el!=document.body){return false;}
var parentNode=null;var pos=[];var box;if(el.getBoundingClientRect){box=el.getBoundingClientRect();var doc=document;if(!this.inDocument(el)&&parent.document!=document){doc=parent.document;if(!this.isAncestor(doc.documentElement,el)){return false;}}
var scrollTop=Math.max(doc.documentElement.scrollTop,doc.body.scrollTop);var scrollLeft=Math.max(doc.documentElement.scrollLeft,doc.body.scrollLeft);return[box.left+scrollLeft,box.top+scrollTop];}
else{pos=[el.offsetLeft,el.offsetTop];parentNode=el.offsetParent;var hasAbs=this.getStyle(el,'position')=='absolute';if(parentNode!=el){while(parentNode){pos[0]+=parentNode.offsetLeft;pos[1]+=parentNode.offsetTop;if(isSafari&&!hasAbs&&this.getStyle(parentNode,'position')=='absolute'){hasAbs=true;}
parentNode=parentNode.offsetParent;}}
if(isSafari&&hasAbs){pos[0]-=document.body.offsetLeft;pos[1]-=document.body.offsetTop;}}
parentNode=el.parentNode;while(parentNode.tagName&&!patterns.ROOT_TAG.test(parentNode.tagName))
{if(Y.Dom.getStyle(parentNode,'display')!='inline'){pos[0]-=parentNode.scrollLeft;pos[1]-=parentNode.scrollTop;}
parentNode=parentNode.parentNode;}
return pos;};return Y.Dom.batch(el,f,Y.Dom,true);},getX:function(el){var f=function(el){return Y.Dom.getXY(el)[0];};return Y.Dom.batch(el,f,Y.Dom,true);},getY:function(el){var f=function(el){return Y.Dom.getXY(el)[1];};return Y.Dom.batch(el,f,Y.Dom,true);},setXY:function(el,pos,noRetry){var f=function(el){var style_pos=this.getStyle(el,'position');if(style_pos=='static'){this.setStyle(el,'position','relative');style_pos='relative';}
var pageXY=this.getXY(el);if(pageXY===false){return false;}
var delta=[parseInt(this.getStyle(el,'left'),10),parseInt(this.getStyle(el,'top'),10)];if(isNaN(delta[0])){delta[0]=(style_pos=='relative')?0:el.offsetLeft;}
if(isNaN(delta[1])){delta[1]=(style_pos=='relative')?0:el.offsetTop;}
if(pos[0]!==null){el.style.left=pos[0]-pageXY[0]+delta[0]+'px';}
if(pos[1]!==null){el.style.top=pos[1]-pageXY[1]+delta[1]+'px';}
if(!noRetry){var newXY=this.getXY(el);if((pos[0]!==null&&newXY[0]!=pos[0])||(pos[1]!==null&&newXY[1]!=pos[1])){this.setXY(el,pos,true);}}};Y.Dom.batch(el,f,Y.Dom,true);},setX:function(el,x){Y.Dom.setXY(el,[x,null]);},setY:function(el,y){Y.Dom.setXY(el,[null,y]);},getRegion:function(el){var f=function(el){var region=new Y.Region.getRegion(el);return region;};return Y.Dom.batch(el,f,Y.Dom,true);},getClientWidth:function(){return Y.Dom.getViewportWidth();},getClientHeight:function(){return Y.Dom.getViewportHeight();},getElementsByClassName:function(className,tag,root){var method=function(el){return Y.Dom.hasClass(el,className);};return Y.Dom.getElementsBy(method,tag,root);},hasClass:function(el,className){var re=new RegExp('(?:^|\\s+)'+className+'(?:\\s+|$)');var f=function(el){return re.test(el.className);};return Y.Dom.batch(el,f,Y.Dom,true);},addClass:function(el,className){var f=function(el){if(this.hasClass(el,className)){return;}
el.className=[el.className,className].join(' ');};Y.Dom.batch(el,f,Y.Dom,true);},removeClass:function(el,className){var re=new RegExp('(?:^|\\s+)'+className+'(?:\\s+|$)','g');var f=function(el){if(!this.hasClass(el,className)){return;}
var c=el.className;el.className=c.replace(re,' ');if(this.hasClass(el,className)){this.removeClass(el,className);}};Y.Dom.batch(el,f,Y.Dom,true);},replaceClass:function(el,oldClassName,newClassName){if(oldClassName===newClassName){return false;}
var re=new RegExp('(?:^|\\s+)'+oldClassName+'(?:\\s+|$)','g');var f=function(el){if(!this.hasClass(el,oldClassName)){this.addClass(el,newClassName);return;}
el.className=el.className.replace(re,' '+newClassName+' ');if(this.hasClass(el,oldClassName)){this.replaceClass(el,oldClassName,newClassName);}};Y.Dom.batch(el,f,Y.Dom,true);},generateId:function(el,prefix){prefix=prefix||'yui-gen';el=el||{};var f=function(el){if(el){el=Y.Dom.get(el);}else{el={};}
if(!el.id){el.id=prefix+id_counter++;}
return el.id;};return Y.Dom.batch(el,f,Y.Dom,true);},isAncestor:function(haystack,needle){haystack=Y.Dom.get(haystack);if(!haystack||!needle){return false;}
var f=function(needle){if(haystack.contains&&!isSafari){return haystack.contains(needle);}
else if(haystack.compareDocumentPosition){return!!(haystack.compareDocumentPosition(needle)&16);}
else{var parent=needle.parentNode;while(parent){if(parent==haystack){return true;}
else if(!parent.tagName||parent.tagName.toUpperCase()=='HTML'){return false;}
parent=parent.parentNode;}
return false;}};return Y.Dom.batch(needle,f,Y.Dom,true);},inDocument:function(el){var f=function(el){return this.isAncestor(document.documentElement,el);};return Y.Dom.batch(el,f,Y.Dom,true);},getElementsBy:function(method,tag,root){tag=tag||'*';var nodes=[];if(root){root=Y.Dom.get(root);if(!root){return nodes;}}else{root=document;}
var elements=root.getElementsByTagName(tag);if(!elements.length&&(tag=='*'&&root.all)){elements=root.all;}
for(var i=0,len=elements.length;i<len;++i){if(method(elements[i])){nodes[nodes.length]=elements[i];}}
return nodes;},batch:function(el,method,o,override){var id=el;el=Y.Dom.get(el);var scope=(override)?o:window;if(!el||el.tagName||!el.length){if(!el){return false;}
return method.call(scope,el,o);}
var collection=[];for(var i=0,len=el.length;i<len;++i){if(!el[i]){id=el[i];}
collection[collection.length]=method.call(scope,el[i],o);}
return collection;},getDocumentHeight:function(){var scrollHeight=(document.compatMode!='CSS1Compat')?document.body.scrollHeight:document.documentElement.scrollHeight;var h=Math.max(scrollHeight,Y.Dom.getViewportHeight());return h;},getDocumentWidth:function(){var scrollWidth=(document.compatMode!='CSS1Compat')?document.body.scrollWidth:document.documentElement.scrollWidth;var w=Math.max(scrollWidth,Y.Dom.getViewportWidth());return w;},getViewportHeight:function(){var height=self.innerHeight;var mode=document.compatMode;if((mode||isIE)&&!isOpera){height=(mode=='CSS1Compat')?document.documentElement.clientHeight:document.body.clientHeight;}
return height;},getViewportWidth:function(){var width=self.innerWidth;var mode=document.compatMode;if(mode||isIE){width=(mode=='CSS1Compat')?document.documentElement.clientWidth:document.body.clientWidth;}
return width;}};})();YAHOO.util.Region=function(t,r,b,l){this.top=t;this[1]=t;this.right=r;this.bottom=b;this.left=l;this[0]=l;};YAHOO.util.Region.prototype.contains=function(region){return(region.left>=this.left&&region.right<=this.right&&region.top>=this.top&&region.bottom<=this.bottom);};YAHOO.util.Region.prototype.getArea=function(){return((this.bottom-this.top)*(this.right-this.left));};YAHOO.util.Region.prototype.intersect=function(region){var t=Math.max(this.top,region.top);var r=Math.min(this.right,region.right);var b=Math.min(this.bottom,region.bottom);var l=Math.max(this.left,region.left);if(b>=t&&r>=l){return new YAHOO.util.Region(t,r,b,l);}else{return null;}};YAHOO.util.Region.prototype.union=function(region){var t=Math.min(this.top,region.top);var r=Math.max(this.right,region.right);var b=Math.max(this.bottom,region.bottom);var l=Math.min(this.left,region.left);return new YAHOO.util.Region(t,r,b,l);};YAHOO.util.Region.prototype.toString=function(){return("Region {"+"top: "+this.top+", right: "+this.right+", bottom: "+this.bottom+", left: "+this.left+"}");};YAHOO.util.Region.getRegion=function(el){var p=YAHOO.util.Dom.getXY(el);var t=p[1];var r=p[0]+el.offsetWidth;var b=p[1]+el.offsetHeight;var l=p[0];return new YAHOO.util.Region(t,r,b,l);};YAHOO.util.Point=function(x,y){if(x instanceof Array){y=x[1];x=x[0];}
this.x=this.right=this.left=this[0]=x;this.y=this.top=this.bottom=this[1]=y;};YAHOO.util.Point.prototype=new YAHOO.util.Region();YAHOO.register("dom",YAHOO.util.Dom,{version:"2.2.2",build:"204"});
// animation-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

YAHOO.util.Anim=function(el,attributes,duration,method){if(el){this.init(el,attributes,duration,method);}};YAHOO.util.Anim.prototype={toString:function(){var el=this.getEl();var id=el.id||el.tagName;return("Anim "+id);},patterns:{noNegatives:/width|height|opacity|padding/i,offsetAttribute:/^((width|height)|(top|left))$/,defaultUnit:/width|height|top$|bottom$|left$|right$/i,offsetUnit:/\d+(em|%|en|ex|pt|in|cm|mm|pc)$/i},doMethod:function(attr,start,end){return this.method(this.currentFrame,start,end-start,this.totalFrames);},setAttribute:function(attr,val,unit){if(this.patterns.noNegatives.test(attr)){val=(val>0)?val:0;}
YAHOO.util.Dom.setStyle(this.getEl(),attr,val+unit);},getAttribute:function(attr){var el=this.getEl();var val=YAHOO.util.Dom.getStyle(el,attr);if(val!=='auto'&&!this.patterns.offsetUnit.test(val)){return parseFloat(val);}
var a=this.patterns.offsetAttribute.exec(attr)||[];var pos=!!(a[3]);var box=!!(a[2]);if(box||(YAHOO.util.Dom.getStyle(el,'position')=='absolute'&&pos)){val=el['offset'+a[0].charAt(0).toUpperCase()+a[0].substr(1)];}else{val=0;}
return val;},getDefaultUnit:function(attr){if(this.patterns.defaultUnit.test(attr)){return'px';}
return'';},setRuntimeAttribute:function(attr){var start;var end;var attributes=this.attributes;this.runtimeAttributes[attr]={};var isset=function(prop){return(typeof prop!=='undefined');};if(!isset(attributes[attr]['to'])&&!isset(attributes[attr]['by'])){return false;}
start=(isset(attributes[attr]['from']))?attributes[attr]['from']:this.getAttribute(attr);if(isset(attributes[attr]['to'])){end=attributes[attr]['to'];}else if(isset(attributes[attr]['by'])){if(start.constructor==Array){end=[];for(var i=0,len=start.length;i<len;++i){end[i]=start[i]+attributes[attr]['by'][i];}}else{end=start+attributes[attr]['by'];}}
this.runtimeAttributes[attr].start=start;this.runtimeAttributes[attr].end=end;this.runtimeAttributes[attr].unit=(isset(attributes[attr].unit))?attributes[attr]['unit']:this.getDefaultUnit(attr);},init:function(el,attributes,duration,method){var isAnimated=false;var startTime=null;var actualFrames=0;el=YAHOO.util.Dom.get(el);this.attributes=attributes||{};this.duration=duration||1;this.method=method||YAHOO.util.Easing.easeNone;this.useSeconds=true;this.currentFrame=0;this.totalFrames=YAHOO.util.AnimMgr.fps;this.getEl=function(){return el;};this.isAnimated=function(){return isAnimated;};this.getStartTime=function(){return startTime;};this.runtimeAttributes={};this.animate=function(){if(this.isAnimated()){return false;}
this.currentFrame=0;this.totalFrames=(this.useSeconds)?Math.ceil(YAHOO.util.AnimMgr.fps*this.duration):this.duration;YAHOO.util.AnimMgr.registerElement(this);};this.stop=function(finish){if(finish){this.currentFrame=this.totalFrames;this._onTween.fire();}
YAHOO.util.AnimMgr.stop(this);};var onStart=function(){this.onStart.fire();this.runtimeAttributes={};for(var attr in this.attributes){this.setRuntimeAttribute(attr);}
isAnimated=true;actualFrames=0;startTime=new Date();};var onTween=function(){var data={duration:new Date()-this.getStartTime(),currentFrame:this.currentFrame};data.toString=function(){return('duration: '+data.duration+', currentFrame: '+data.currentFrame);};this.onTween.fire(data);var runtimeAttributes=this.runtimeAttributes;for(var attr in runtimeAttributes){this.setAttribute(attr,this.doMethod(attr,runtimeAttributes[attr].start,runtimeAttributes[attr].end),runtimeAttributes[attr].unit);}
actualFrames+=1;};var onComplete=function(){var actual_duration=(new Date()-startTime)/1000;var data={duration:actual_duration,frames:actualFrames,fps:actualFrames/actual_duration};data.toString=function(){return('duration: '+data.duration+', frames: '+data.frames+', fps: '+data.fps);};isAnimated=false;actualFrames=0;this.onComplete.fire(data);};this._onStart=new YAHOO.util.CustomEvent('_start',this,true);this.onStart=new YAHOO.util.CustomEvent('start',this);this.onTween=new YAHOO.util.CustomEvent('tween',this);this._onTween=new YAHOO.util.CustomEvent('_tween',this,true);this.onComplete=new YAHOO.util.CustomEvent('complete',this);this._onComplete=new YAHOO.util.CustomEvent('_complete',this,true);this._onStart.subscribe(onStart);this._onTween.subscribe(onTween);this._onComplete.subscribe(onComplete);}};YAHOO.util.AnimMgr=new function(){var thread=null;var queue=[];var tweenCount=0;this.fps=1000;this.delay=1;this.registerElement=function(tween){queue[queue.length]=tween;tweenCount+=1;tween._onStart.fire();this.start();};this.unRegister=function(tween,index){tween._onComplete.fire();index=index||getIndex(tween);if(index!=-1){queue.splice(index,1);}
tweenCount-=1;if(tweenCount<=0){this.stop();}};this.start=function(){if(thread===null){thread=setInterval(this.run,this.delay);}};this.stop=function(tween){if(!tween){clearInterval(thread);for(var i=0,len=queue.length;i<len;++i){if(queue[0].isAnimated()){this.unRegister(queue[0],0);}}
queue=[];thread=null;tweenCount=0;}
else{this.unRegister(tween);}};this.run=function(){for(var i=0,len=queue.length;i<len;++i){var tween=queue[i];if(!tween||!tween.isAnimated()){continue;}
if(tween.currentFrame<tween.totalFrames||tween.totalFrames===null)
{tween.currentFrame+=1;if(tween.useSeconds){correctFrame(tween);}
tween._onTween.fire();}
else{YAHOO.util.AnimMgr.stop(tween,i);}}};var getIndex=function(anim){for(var i=0,len=queue.length;i<len;++i){if(queue[i]==anim){return i;}}
return-1;};var correctFrame=function(tween){var frames=tween.totalFrames;var frame=tween.currentFrame;var expected=(tween.currentFrame*tween.duration*1000/tween.totalFrames);var elapsed=(new Date()-tween.getStartTime());var tweak=0;if(elapsed<tween.duration*1000){tweak=Math.round((elapsed/expected-1)*tween.currentFrame);}else{tweak=frames-(frame+1);}
if(tweak>0&&isFinite(tweak)){if(tween.currentFrame+tweak>=frames){tweak=frames-(frame+1);}
tween.currentFrame+=tweak;}};};YAHOO.util.Bezier=new function(){this.getPosition=function(points,t){var n=points.length;var tmp=[];for(var i=0;i<n;++i){tmp[i]=[points[i][0],points[i][1]];}
for(var j=1;j<n;++j){for(i=0;i<n-j;++i){tmp[i][0]=(1-t)*tmp[i][0]+t*tmp[parseInt(i+1,10)][0];tmp[i][1]=(1-t)*tmp[i][1]+t*tmp[parseInt(i+1,10)][1];}}
return[tmp[0][0],tmp[0][1]];};};(function(){YAHOO.util.ColorAnim=function(el,attributes,duration,method){YAHOO.util.ColorAnim.superclass.constructor.call(this,el,attributes,duration,method);};YAHOO.extend(YAHOO.util.ColorAnim,YAHOO.util.Anim);var Y=YAHOO.util;var superclass=Y.ColorAnim.superclass;var proto=Y.ColorAnim.prototype;proto.toString=function(){var el=this.getEl();var id=el.id||el.tagName;return("ColorAnim "+id);};proto.patterns.color=/color$/i;proto.patterns.rgb=/^rgb\(([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\)$/i;proto.patterns.hex=/^#?([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})$/i;proto.patterns.hex3=/^#?([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})$/i;proto.patterns.transparent=/^transparent|rgba\(0, 0, 0, 0\)$/;proto.parseColor=function(s){if(s.length==3){return s;}
var c=this.patterns.hex.exec(s);if(c&&c.length==4){return[parseInt(c[1],16),parseInt(c[2],16),parseInt(c[3],16)];}
c=this.patterns.rgb.exec(s);if(c&&c.length==4){return[parseInt(c[1],10),parseInt(c[2],10),parseInt(c[3],10)];}
c=this.patterns.hex3.exec(s);if(c&&c.length==4){return[parseInt(c[1]+c[1],16),parseInt(c[2]+c[2],16),parseInt(c[3]+c[3],16)];}
return null;};proto.getAttribute=function(attr){var el=this.getEl();if(this.patterns.color.test(attr)){var val=YAHOO.util.Dom.getStyle(el,attr);if(this.patterns.transparent.test(val)){var parent=el.parentNode;val=Y.Dom.getStyle(parent,attr);while(parent&&this.patterns.transparent.test(val)){parent=parent.parentNode;val=Y.Dom.getStyle(parent,attr);if(parent.tagName.toUpperCase()=='HTML'){val='#fff';}}}}else{val=superclass.getAttribute.call(this,attr);}
return val;};proto.doMethod=function(attr,start,end){var val;if(this.patterns.color.test(attr)){val=[];for(var i=0,len=start.length;i<len;++i){val[i]=superclass.doMethod.call(this,attr,start[i],end[i]);}
val='rgb('+Math.floor(val[0])+','+Math.floor(val[1])+','+Math.floor(val[2])+')';}
else{val=superclass.doMethod.call(this,attr,start,end);}
return val;};proto.setRuntimeAttribute=function(attr){superclass.setRuntimeAttribute.call(this,attr);if(this.patterns.color.test(attr)){var attributes=this.attributes;var start=this.parseColor(this.runtimeAttributes[attr].start);var end=this.parseColor(this.runtimeAttributes[attr].end);if(typeof attributes[attr]['to']==='undefined'&&typeof attributes[attr]['by']!=='undefined'){end=this.parseColor(attributes[attr].by);for(var i=0,len=start.length;i<len;++i){end[i]=start[i]+end[i];}}
this.runtimeAttributes[attr].start=start;this.runtimeAttributes[attr].end=end;}};})();YAHOO.util.Easing={easeNone:function(t,b,c,d){return c*t/d+b;},easeIn:function(t,b,c,d){return c*(t/=d)*t+b;},easeOut:function(t,b,c,d){return-c*(t/=d)*(t-2)+b;},easeBoth:function(t,b,c,d){if((t/=d/2)<1){return c/2*t*t+b;}
return-c/2*((--t)*(t-2)-1)+b;},easeInStrong:function(t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutStrong:function(t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b;},easeBothStrong:function(t,b,c,d){if((t/=d/2)<1){return c/2*t*t*t*t+b;}
return-c/2*((t-=2)*t*t*t-2)+b;},elasticIn:function(t,b,c,d,a,p){if(t==0){return b;}
if((t/=d)==1){return b+c;}
if(!p){p=d*.3;}
if(!a||a<Math.abs(c)){a=c;var s=p/4;}
else{var s=p/(2*Math.PI)*Math.asin(c/a);}
return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},elasticOut:function(t,b,c,d,a,p){if(t==0){return b;}
if((t/=d)==1){return b+c;}
if(!p){p=d*.3;}
if(!a||a<Math.abs(c)){a=c;var s=p/4;}
else{var s=p/(2*Math.PI)*Math.asin(c/a);}
return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},elasticBoth:function(t,b,c,d,a,p){if(t==0){return b;}
if((t/=d/2)==2){return b+c;}
if(!p){p=d*(.3*1.5);}
if(!a||a<Math.abs(c)){a=c;var s=p/4;}
else{var s=p/(2*Math.PI)*Math.asin(c/a);}
if(t<1){return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;}
return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b;},backIn:function(t,b,c,d,s){if(typeof s=='undefined'){s=1.70158;}
return c*(t/=d)*t*((s+1)*t-s)+b;},backOut:function(t,b,c,d,s){if(typeof s=='undefined'){s=1.70158;}
return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},backBoth:function(t,b,c,d,s){if(typeof s=='undefined'){s=1.70158;}
if((t/=d/2)<1){return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;}
return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},bounceIn:function(t,b,c,d){return c-YAHOO.util.Easing.bounceOut(d-t,0,c,d)+b;},bounceOut:function(t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}
return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;},bounceBoth:function(t,b,c,d){if(t<d/2){return YAHOO.util.Easing.bounceIn(t*2,0,c,d)*.5+b;}
return YAHOO.util.Easing.bounceOut(t*2-d,0,c,d)*.5+c*.5+b;}};(function(){YAHOO.util.Motion=function(el,attributes,duration,method){if(el){YAHOO.util.Motion.superclass.constructor.call(this,el,attributes,duration,method);}};YAHOO.extend(YAHOO.util.Motion,YAHOO.util.ColorAnim);var Y=YAHOO.util;var superclass=Y.Motion.superclass;var proto=Y.Motion.prototype;proto.toString=function(){var el=this.getEl();var id=el.id||el.tagName;return("Motion "+id);};proto.patterns.points=/^points$/i;proto.setAttribute=function(attr,val,unit){if(this.patterns.points.test(attr)){unit=unit||'px';superclass.setAttribute.call(this,'left',val[0],unit);superclass.setAttribute.call(this,'top',val[1],unit);}else{superclass.setAttribute.call(this,attr,val,unit);}};proto.getAttribute=function(attr){if(this.patterns.points.test(attr)){var val=[superclass.getAttribute.call(this,'left'),superclass.getAttribute.call(this,'top')];}else{val=superclass.getAttribute.call(this,attr);}
return val;};proto.doMethod=function(attr,start,end){var val=null;if(this.patterns.points.test(attr)){var t=this.method(this.currentFrame,0,100,this.totalFrames)/100;val=Y.Bezier.getPosition(this.runtimeAttributes[attr],t);}else{val=superclass.doMethod.call(this,attr,start,end);}
return val;};proto.setRuntimeAttribute=function(attr){if(this.patterns.points.test(attr)){var el=this.getEl();var attributes=this.attributes;var start;var control=attributes['points']['control']||[];var end;var i,len;if(control.length>0&&!(control[0]instanceof Array)){control=[control];}else{var tmp=[];for(i=0,len=control.length;i<len;++i){tmp[i]=control[i];}
control=tmp;}
if(Y.Dom.getStyle(el,'position')=='static'){Y.Dom.setStyle(el,'position','relative');}
if(isset(attributes['points']['from'])){Y.Dom.setXY(el,attributes['points']['from']);}
else{Y.Dom.setXY(el,Y.Dom.getXY(el));}
start=this.getAttribute('points');if(isset(attributes['points']['to'])){end=translateValues.call(this,attributes['points']['to'],start);var pageXY=Y.Dom.getXY(this.getEl());for(i=0,len=control.length;i<len;++i){control[i]=translateValues.call(this,control[i],start);}}else if(isset(attributes['points']['by'])){end=[start[0]+attributes['points']['by'][0],start[1]+attributes['points']['by'][1]];for(i=0,len=control.length;i<len;++i){control[i]=[start[0]+control[i][0],start[1]+control[i][1]];}}
this.runtimeAttributes[attr]=[start];if(control.length>0){this.runtimeAttributes[attr]=this.runtimeAttributes[attr].concat(control);}
this.runtimeAttributes[attr][this.runtimeAttributes[attr].length]=end;}
else{superclass.setRuntimeAttribute.call(this,attr);}};var translateValues=function(val,start){var pageXY=Y.Dom.getXY(this.getEl());val=[val[0]-pageXY[0]+start[0],val[1]-pageXY[1]+start[1]];return val;};var isset=function(prop){return(typeof prop!=='undefined');};})();(function(){YAHOO.util.Scroll=function(el,attributes,duration,method){if(el){YAHOO.util.Scroll.superclass.constructor.call(this,el,attributes,duration,method);}};YAHOO.extend(YAHOO.util.Scroll,YAHOO.util.ColorAnim);var Y=YAHOO.util;var superclass=Y.Scroll.superclass;var proto=Y.Scroll.prototype;proto.toString=function(){var el=this.getEl();var id=el.id||el.tagName;return("Scroll "+id);};proto.doMethod=function(attr,start,end){var val=null;if(attr=='scroll'){val=[this.method(this.currentFrame,start[0],end[0]-start[0],this.totalFrames),this.method(this.currentFrame,start[1],end[1]-start[1],this.totalFrames)];}else{val=superclass.doMethod.call(this,attr,start,end);}
return val;};proto.getAttribute=function(attr){var val=null;var el=this.getEl();if(attr=='scroll'){val=[el.scrollLeft,el.scrollTop];}else{val=superclass.getAttribute.call(this,attr);}
return val;};proto.setAttribute=function(attr,val,unit){var el=this.getEl();if(attr=='scroll'){el.scrollLeft=val[0];el.scrollTop=val[1];}else{superclass.setAttribute.call(this,attr,val,unit);}};})();YAHOO.register("animation",YAHOO.util.Anim,{version:"2.2.2",build:"204"});
// container-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

YAHOO.util.Config=function(owner){if(owner){this.init(owner);}};YAHOO.util.Config.CONFIG_CHANGED_EVENT="configChanged";YAHOO.util.Config.BOOLEAN_TYPE="boolean";YAHOO.util.Config.prototype={owner:null,queueInProgress:false,config:null,initialConfig:null,eventQueue:null,configChangedEvent:null,checkBoolean:function(val){return(typeof val==YAHOO.util.Config.BOOLEAN_TYPE);},checkNumber:function(val){return(!isNaN(val));},fireEvent:function(key,value){var property=this.config[key];if(property&&property.event){property.event.fire(value);}},addProperty:function(key,propertyObject){key=key.toLowerCase();this.config[key]=propertyObject;propertyObject.event=new YAHOO.util.CustomEvent(key,this.owner);propertyObject.key=key;if(propertyObject.handler){propertyObject.event.subscribe(propertyObject.handler,this.owner);}
this.setProperty(key,propertyObject.value,true);if(!propertyObject.suppressEvent){this.queueProperty(key,propertyObject.value);}},getConfig:function(){var cfg={};for(var prop in this.config){var property=this.config[prop];if(property&&property.event){cfg[prop]=property.value;}}
return cfg;},getProperty:function(key){var property=this.config[key.toLowerCase()];if(property&&property.event){return property.value;}else{return undefined;}},resetProperty:function(key){key=key.toLowerCase();var property=this.config[key];if(property&&property.event){if(this.initialConfig[key]&&!YAHOO.lang.isUndefined(this.initialConfig[key])){this.setProperty(key,this.initialConfig[key]);}
return true;}else{return false;}},setProperty:function(key,value,silent){key=key.toLowerCase();if(this.queueInProgress&&!silent){this.queueProperty(key,value);return true;}else{var property=this.config[key];if(property&&property.event){if(property.validator&&!property.validator(value)){return false;}else{property.value=value;if(!silent){this.fireEvent(key,value);this.configChangedEvent.fire([key,value]);}
return true;}}else{return false;}}},queueProperty:function(key,value){key=key.toLowerCase();var property=this.config[key];if(property&&property.event){if(!YAHOO.lang.isUndefined(value)&&property.validator&&!property.validator(value)){return false;}else{if(!YAHOO.lang.isUndefined(value)){property.value=value;}else{value=property.value;}
var foundDuplicate=false;var iLen=this.eventQueue.length;for(var i=0;i<iLen;i++){var queueItem=this.eventQueue[i];if(queueItem){var queueItemKey=queueItem[0];var queueItemValue=queueItem[1];if(queueItemKey==key){this.eventQueue[i]=null;this.eventQueue.push([key,(!YAHOO.lang.isUndefined(value)?value:queueItemValue)]);foundDuplicate=true;break;}}}
if(!foundDuplicate&&!YAHOO.lang.isUndefined(value)){this.eventQueue.push([key,value]);}}
if(property.supercedes){var sLen=property.supercedes.length;for(var s=0;s<sLen;s++){var supercedesCheck=property.supercedes[s];var qLen=this.eventQueue.length;for(var q=0;q<qLen;q++){var queueItemCheck=this.eventQueue[q];if(queueItemCheck){var queueItemCheckKey=queueItemCheck[0];var queueItemCheckValue=queueItemCheck[1];if(queueItemCheckKey==supercedesCheck.toLowerCase()){this.eventQueue.push([queueItemCheckKey,queueItemCheckValue]);this.eventQueue[q]=null;break;}}}}}
return true;}else{return false;}},refireEvent:function(key){key=key.toLowerCase();var property=this.config[key];if(property&&property.event&&!YAHOO.lang.isUndefined(property.value)){if(this.queueInProgress){this.queueProperty(key);}else{this.fireEvent(key,property.value);}}},applyConfig:function(userConfig,init){if(init){this.initialConfig=userConfig;}
for(var prop in userConfig){this.queueProperty(prop,userConfig[prop]);}},refresh:function(){for(var prop in this.config){this.refireEvent(prop);}},fireQueue:function(){this.queueInProgress=true;for(var i=0;i<this.eventQueue.length;i++){var queueItem=this.eventQueue[i];if(queueItem){var key=queueItem[0];var value=queueItem[1];var property=this.config[key];property.value=value;this.fireEvent(key,value);}}
this.queueInProgress=false;this.eventQueue=[];},subscribeToConfigEvent:function(key,handler,obj,override){var property=this.config[key.toLowerCase()];if(property&&property.event){if(!YAHOO.util.Config.alreadySubscribed(property.event,handler,obj)){property.event.subscribe(handler,obj,override);}
return true;}else{return false;}},unsubscribeFromConfigEvent:function(key,handler,obj){var property=this.config[key.toLowerCase()];if(property&&property.event){return property.event.unsubscribe(handler,obj);}else{return false;}},toString:function(){var output="Config";if(this.owner){output+=" ["+this.owner.toString()+"]";}
return output;},outputEventQueue:function(){var output="";for(var q=0;q<this.eventQueue.length;q++){var queueItem=this.eventQueue[q];if(queueItem){output+=queueItem[0]+"="+queueItem[1]+", ";}}
return output;}};YAHOO.util.Config.prototype.init=function(owner){this.owner=owner;this.configChangedEvent=new YAHOO.util.CustomEvent(YAHOO.util.CONFIG_CHANGED_EVENT,this);this.queueInProgress=false;this.config={};this.initialConfig={};this.eventQueue=[];};YAHOO.util.Config.alreadySubscribed=function(evt,fn,obj){for(var e=0;e<evt.subscribers.length;e++){var subsc=evt.subscribers[e];if(subsc&&subsc.obj==obj&&subsc.fn==fn){return true;}}
return false;};YAHOO.widget.Module=function(el,userConfig){if(el){this.init(el,userConfig);}else{}};YAHOO.widget.Module.IMG_ROOT=null;YAHOO.widget.Module.IMG_ROOT_SSL=null;YAHOO.widget.Module.CSS_MODULE="yui-module";YAHOO.widget.Module.CSS_HEADER="hd";YAHOO.widget.Module.CSS_BODY="bd";YAHOO.widget.Module.CSS_FOOTER="ft";YAHOO.widget.Module.RESIZE_MONITOR_SECURE_URL="javascript:false;";YAHOO.widget.Module.textResizeEvent=new YAHOO.util.CustomEvent("textResize");YAHOO.widget.Module._EVENT_TYPES={"BEFORE_INIT":"beforeInit","INIT":"init","APPEND":"append","BEFORE_RENDER":"beforeRender","RENDER":"render","CHANGE_HEADER":"changeHeader","CHANGE_BODY":"changeBody","CHANGE_FOOTER":"changeFooter","CHANGE_CONTENT":"changeContent","DESTORY":"destroy","BEFORE_SHOW":"beforeShow","SHOW":"show","BEFORE_HIDE":"beforeHide","HIDE":"hide"};YAHOO.widget.Module._DEFAULT_CONFIG={"VISIBLE":{key:"visible",value:true,validator:YAHOO.lang.isBoolean},"EFFECT":{key:"effect",suppressEvent:true,supercedes:["visible"]},"MONITOR_RESIZE":{key:"monitorresize",value:true}};YAHOO.widget.Module.prototype={constructor:YAHOO.widget.Module,element:null,header:null,body:null,footer:null,id:null,imageRoot:YAHOO.widget.Module.IMG_ROOT,initEvents:function(){var EVENT_TYPES=YAHOO.widget.Module._EVENT_TYPES;this.beforeInitEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_INIT,this);this.initEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.INIT,this);this.appendEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.APPEND,this);this.beforeRenderEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_RENDER,this);this.renderEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.RENDER,this);this.changeHeaderEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CHANGE_HEADER,this);this.changeBodyEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CHANGE_BODY,this);this.changeFooterEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CHANGE_FOOTER,this);this.changeContentEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CHANGE_CONTENT,this);this.destroyEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.DESTORY,this);this.beforeShowEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_SHOW,this);this.showEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.SHOW,this);this.beforeHideEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_HIDE,this);this.hideEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.HIDE,this);},platform:function(){var ua=navigator.userAgent.toLowerCase();if(ua.indexOf("windows")!=-1||ua.indexOf("win32")!=-1){return"windows";}else if(ua.indexOf("macintosh")!=-1){return"mac";}else{return false;}}(),browser:function(){var ua=navigator.userAgent.toLowerCase();if(ua.indexOf('opera')!=-1){return'opera';}else if(ua.indexOf('msie 7')!=-1){return'ie7';}else if(ua.indexOf('msie')!=-1){return'ie';}else if(ua.indexOf('safari')!=-1){return'safari';}else if(ua.indexOf('gecko')!=-1){return'gecko';}else{return false;}}(),isSecure:function(){if(window.location.href.toLowerCase().indexOf("https")===0){return true;}else{return false;}}(),initDefaultConfig:function(){var DEFAULT_CONFIG=YAHOO.widget.Module._DEFAULT_CONFIG;this.cfg.addProperty(DEFAULT_CONFIG.VISIBLE.key,{handler:this.configVisible,value:DEFAULT_CONFIG.VISIBLE.value,validator:DEFAULT_CONFIG.VISIBLE.validator});this.cfg.addProperty(DEFAULT_CONFIG.EFFECT.key,{suppressEvent:DEFAULT_CONFIG.EFFECT.suppressEvent,supercedes:DEFAULT_CONFIG.EFFECT.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.MONITOR_RESIZE.key,{handler:this.configMonitorResize,value:DEFAULT_CONFIG.MONITOR_RESIZE.value});},init:function(el,userConfig){this.initEvents();this.beforeInitEvent.fire(YAHOO.widget.Module);this.cfg=new YAHOO.util.Config(this);if(this.isSecure){this.imageRoot=YAHOO.widget.Module.IMG_ROOT_SSL;}
if(typeof el=="string"){var elId=el;el=document.getElementById(el);if(!el){el=document.createElement("div");el.id=elId;}}
this.element=el;if(el.id){this.id=el.id;}
var childNodes=this.element.childNodes;if(childNodes){for(var i=0;i<childNodes.length;i++){var child=childNodes[i];switch(child.className){case YAHOO.widget.Module.CSS_HEADER:this.header=child;break;case YAHOO.widget.Module.CSS_BODY:this.body=child;break;case YAHOO.widget.Module.CSS_FOOTER:this.footer=child;break;}}}
this.initDefaultConfig();YAHOO.util.Dom.addClass(this.element,YAHOO.widget.Module.CSS_MODULE);if(userConfig){this.cfg.applyConfig(userConfig,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.renderEvent,this.cfg.fireQueue,this.cfg)){this.renderEvent.subscribe(this.cfg.fireQueue,this.cfg,true);}
this.initEvent.fire(YAHOO.widget.Module);},initResizeMonitor:function(){if(this.browser!="opera"){var resizeMonitor=document.getElementById("_yuiResizeMonitor");if(!resizeMonitor){resizeMonitor=document.createElement("iframe");var bIE=(this.browser.indexOf("ie")===0);if(this.isSecure&&YAHOO.widget.Module.RESIZE_MONITOR_SECURE_URL&&bIE){resizeMonitor.src=YAHOO.widget.Module.RESIZE_MONITOR_SECURE_URL;}
resizeMonitor.id="_yuiResizeMonitor";resizeMonitor.style.visibility="hidden";document.body.appendChild(resizeMonitor);resizeMonitor.style.width="10em";resizeMonitor.style.height="10em";resizeMonitor.style.position="absolute";var nLeft=-1*resizeMonitor.offsetWidth;var nTop=-1*resizeMonitor.offsetHeight;resizeMonitor.style.top=nTop+"px";resizeMonitor.style.left=nLeft+"px";resizeMonitor.style.borderStyle="none";resizeMonitor.style.borderWidth="0";YAHOO.util.Dom.setStyle(resizeMonitor,"opacity","0");resizeMonitor.style.visibility="visible";if(!bIE){var doc=resizeMonitor.contentWindow.document;doc.open();doc.close();}}
var fireTextResize=function(){YAHOO.widget.Module.textResizeEvent.fire();};if(resizeMonitor&&resizeMonitor.contentWindow){this.resizeMonitor=resizeMonitor;YAHOO.widget.Module.textResizeEvent.subscribe(this.onDomResize,this,true);if(!YAHOO.widget.Module.textResizeInitialized){if(!YAHOO.util.Event.addListener(this.resizeMonitor.contentWindow,"resize",fireTextResize)){YAHOO.util.Event.addListener(this.resizeMonitor,"resize",fireTextResize);}
YAHOO.widget.Module.textResizeInitialized=true;}}}},onDomResize:function(e,obj){var nLeft=-1*this.resizeMonitor.offsetWidth,nTop=-1*this.resizeMonitor.offsetHeight;this.resizeMonitor.style.top=nTop+"px";this.resizeMonitor.style.left=nLeft+"px";},setHeader:function(headerContent){if(!this.header){this.header=document.createElement("div");this.header.className=YAHOO.widget.Module.CSS_HEADER;}
if(typeof headerContent=="string"){this.header.innerHTML=headerContent;}else{this.header.innerHTML="";this.header.appendChild(headerContent);}
this.changeHeaderEvent.fire(headerContent);this.changeContentEvent.fire();},appendToHeader:function(element){if(!this.header){this.header=document.createElement("div");this.header.className=YAHOO.widget.Module.CSS_HEADER;}
this.header.appendChild(element);this.changeHeaderEvent.fire(element);this.changeContentEvent.fire();},setBody:function(bodyContent){if(!this.body){this.body=document.createElement("div");this.body.className=YAHOO.widget.Module.CSS_BODY;}
if(typeof bodyContent=="string")
{this.body.innerHTML=bodyContent;}else{this.body.innerHTML="";this.body.appendChild(bodyContent);}
this.changeBodyEvent.fire(bodyContent);this.changeContentEvent.fire();},appendToBody:function(element){if(!this.body){this.body=document.createElement("div");this.body.className=YAHOO.widget.Module.CSS_BODY;}
this.body.appendChild(element);this.changeBodyEvent.fire(element);this.changeContentEvent.fire();},setFooter:function(footerContent){if(!this.footer){this.footer=document.createElement("div");this.footer.className=YAHOO.widget.Module.CSS_FOOTER;}
if(typeof footerContent=="string"){this.footer.innerHTML=footerContent;}else{this.footer.innerHTML="";this.footer.appendChild(footerContent);}
this.changeFooterEvent.fire(footerContent);this.changeContentEvent.fire();},appendToFooter:function(element){if(!this.footer){this.footer=document.createElement("div");this.footer.className=YAHOO.widget.Module.CSS_FOOTER;}
this.footer.appendChild(element);this.changeFooterEvent.fire(element);this.changeContentEvent.fire();},render:function(appendToNode,moduleElement){this.beforeRenderEvent.fire();if(!moduleElement){moduleElement=this.element;}
var me=this;var appendTo=function(element){if(typeof element=="string"){element=document.getElementById(element);}
if(element){element.appendChild(me.element);me.appendEvent.fire();}};if(appendToNode){appendTo(appendToNode);}else{if(!YAHOO.util.Dom.inDocument(this.element)){return false;}}
if(this.header&&!YAHOO.util.Dom.inDocument(this.header)){var firstChild=moduleElement.firstChild;if(firstChild){moduleElement.insertBefore(this.header,firstChild);}else{moduleElement.appendChild(this.header);}}
if(this.body&&!YAHOO.util.Dom.inDocument(this.body)){if(this.footer&&YAHOO.util.Dom.isAncestor(this.moduleElement,this.footer)){moduleElement.insertBefore(this.body,this.footer);}else{moduleElement.appendChild(this.body);}}
if(this.footer&&!YAHOO.util.Dom.inDocument(this.footer)){moduleElement.appendChild(this.footer);}
this.renderEvent.fire();return true;},destroy:function(){var parent;if(this.element){YAHOO.util.Event.purgeElement(this.element,true);parent=this.element.parentNode;}
if(parent){parent.removeChild(this.element);}
this.element=null;this.header=null;this.body=null;this.footer=null;for(var e in this){if(e instanceof YAHOO.util.CustomEvent){e.unsubscribeAll();}}
YAHOO.widget.Module.textResizeEvent.unsubscribe(this.onDomResize,this);this.destroyEvent.fire();},show:function(){this.cfg.setProperty("visible",true);},hide:function(){this.cfg.setProperty("visible",false);},configVisible:function(type,args,obj){var visible=args[0];if(visible){this.beforeShowEvent.fire();YAHOO.util.Dom.setStyle(this.element,"display","block");this.showEvent.fire();}else{this.beforeHideEvent.fire();YAHOO.util.Dom.setStyle(this.element,"display","none");this.hideEvent.fire();}},configMonitorResize:function(type,args,obj){var monitor=args[0];if(monitor){this.initResizeMonitor();}else{YAHOO.widget.Module.textResizeEvent.unsubscribe(this.onDomResize,this,true);this.resizeMonitor=null;}}};YAHOO.widget.Module.prototype.toString=function(){return"Module "+this.id;};YAHOO.widget.Overlay=function(el,userConfig){YAHOO.widget.Overlay.superclass.constructor.call(this,el,userConfig);};YAHOO.extend(YAHOO.widget.Overlay,YAHOO.widget.Module);YAHOO.widget.Overlay._EVENT_TYPES={"BEFORE_MOVE":"beforeMove","MOVE":"move"};YAHOO.widget.Overlay._DEFAULT_CONFIG={"X":{key:"x",validator:YAHOO.lang.isNumber,suppressEvent:true,supercedes:["iframe"]},"Y":{key:"y",validator:YAHOO.lang.isNumber,suppressEvent:true,supercedes:["iframe"]},"XY":{key:"xy",suppressEvent:true,supercedes:["iframe"]},"CONTEXT":{key:"context",suppressEvent:true,supercedes:["iframe"]},"FIXED_CENTER":{key:"fixedcenter",value:false,validator:YAHOO.lang.isBoolean,supercedes:["iframe","visible"]},"WIDTH":{key:"width",suppressEvent:true,supercedes:["iframe"]},"HEIGHT":{key:"height",suppressEvent:true,supercedes:["iframe"]},"ZINDEX":{key:"zindex",value:null},"CONSTRAIN_TO_VIEWPORT":{key:"constraintoviewport",value:false,validator:YAHOO.lang.isBoolean,supercedes:["iframe","x","y","xy"]},"IFRAME":{key:"iframe",value:(YAHOO.widget.Module.prototype.browser=="ie"?true:false),validator:YAHOO.lang.isBoolean,supercedes:["zIndex"]}};YAHOO.widget.Overlay.IFRAME_SRC="javascript:false;";YAHOO.widget.Overlay.TOP_LEFT="tl";YAHOO.widget.Overlay.TOP_RIGHT="tr";YAHOO.widget.Overlay.BOTTOM_LEFT="bl";YAHOO.widget.Overlay.BOTTOM_RIGHT="br";YAHOO.widget.Overlay.CSS_OVERLAY="yui-overlay";YAHOO.widget.Overlay.prototype.init=function(el,userConfig){YAHOO.widget.Overlay.superclass.init.call(this,el);this.beforeInitEvent.fire(YAHOO.widget.Overlay);YAHOO.util.Dom.addClass(this.element,YAHOO.widget.Overlay.CSS_OVERLAY);if(userConfig){this.cfg.applyConfig(userConfig,true);}
if(this.platform=="mac"&&this.browser=="gecko"){if(!YAHOO.util.Config.alreadySubscribed(this.showEvent,this.showMacGeckoScrollbars,this)){this.showEvent.subscribe(this.showMacGeckoScrollbars,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.hideEvent,this.hideMacGeckoScrollbars,this)){this.hideEvent.subscribe(this.hideMacGeckoScrollbars,this,true);}}
this.initEvent.fire(YAHOO.widget.Overlay);};YAHOO.widget.Overlay.prototype.initEvents=function(){YAHOO.widget.Overlay.superclass.initEvents.call(this);var EVENT_TYPES=YAHOO.widget.Overlay._EVENT_TYPES;this.beforeMoveEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_MOVE,this);this.moveEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.MOVE,this);};YAHOO.widget.Overlay.prototype.initDefaultConfig=function(){YAHOO.widget.Overlay.superclass.initDefaultConfig.call(this);var DEFAULT_CONFIG=YAHOO.widget.Overlay._DEFAULT_CONFIG;this.cfg.addProperty(DEFAULT_CONFIG.X.key,{handler:this.configX,validator:DEFAULT_CONFIG.X.validator,suppressEvent:DEFAULT_CONFIG.X.suppressEvent,supercedes:DEFAULT_CONFIG.X.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.Y.key,{handler:this.configY,validator:DEFAULT_CONFIG.Y.validator,suppressEvent:DEFAULT_CONFIG.Y.suppressEvent,supercedes:DEFAULT_CONFIG.Y.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.XY.key,{handler:this.configXY,suppressEvent:DEFAULT_CONFIG.XY.suppressEvent,supercedes:DEFAULT_CONFIG.XY.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.CONTEXT.key,{handler:this.configContext,suppressEvent:DEFAULT_CONFIG.CONTEXT.suppressEvent,supercedes:DEFAULT_CONFIG.CONTEXT.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.FIXED_CENTER.key,{handler:this.configFixedCenter,value:DEFAULT_CONFIG.FIXED_CENTER.value,validator:DEFAULT_CONFIG.FIXED_CENTER.validator,supercedes:DEFAULT_CONFIG.FIXED_CENTER.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.WIDTH.key,{handler:this.configWidth,suppressEvent:DEFAULT_CONFIG.WIDTH.suppressEvent,supercedes:DEFAULT_CONFIG.WIDTH.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.HEIGHT.key,{handler:this.configHeight,suppressEvent:DEFAULT_CONFIG.HEIGHT.suppressEvent,supercedes:DEFAULT_CONFIG.HEIGHT.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.ZINDEX.key,{handler:this.configzIndex,value:DEFAULT_CONFIG.ZINDEX.value});this.cfg.addProperty(DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.key,{handler:this.configConstrainToViewport,value:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.value,validator:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.validator,supercedes:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.IFRAME.key,{handler:this.configIframe,value:DEFAULT_CONFIG.IFRAME.value,validator:DEFAULT_CONFIG.IFRAME.validator,supercedes:DEFAULT_CONFIG.IFRAME.supercedes});};YAHOO.widget.Overlay.prototype.moveTo=function(x,y){this.cfg.setProperty("xy",[x,y]);};YAHOO.widget.Overlay.prototype.hideMacGeckoScrollbars=function(){YAHOO.util.Dom.removeClass(this.element,"show-scrollbars");YAHOO.util.Dom.addClass(this.element,"hide-scrollbars");};YAHOO.widget.Overlay.prototype.showMacGeckoScrollbars=function(){YAHOO.util.Dom.removeClass(this.element,"hide-scrollbars");YAHOO.util.Dom.addClass(this.element,"show-scrollbars");};YAHOO.widget.Overlay.prototype.configVisible=function(type,args,obj){var visible=args[0];var currentVis=YAHOO.util.Dom.getStyle(this.element,"visibility");if(currentVis=="inherit"){var e=this.element.parentNode;while(e.nodeType!=9&&e.nodeType!=11){currentVis=YAHOO.util.Dom.getStyle(e,"visibility");if(currentVis!="inherit"){break;}
e=e.parentNode;}
if(currentVis=="inherit"){currentVis="visible";}}
var effect=this.cfg.getProperty("effect");var effectInstances=[];if(effect){if(effect instanceof Array){for(var i=0;i<effect.length;i++){var eff=effect[i];effectInstances[effectInstances.length]=eff.effect(this,eff.duration);}}else{effectInstances[effectInstances.length]=effect.effect(this,effect.duration);}}
var isMacGecko=(this.platform=="mac"&&this.browser=="gecko");if(visible){if(isMacGecko){this.showMacGeckoScrollbars();}
if(effect){if(visible){if(currentVis!="visible"||currentVis===""){this.beforeShowEvent.fire();for(var j=0;j<effectInstances.length;j++){var ei=effectInstances[j];if(j===0&&!YAHOO.util.Config.alreadySubscribed(ei.animateInCompleteEvent,this.showEvent.fire,this.showEvent)){ei.animateInCompleteEvent.subscribe(this.showEvent.fire,this.showEvent,true);}
ei.animateIn();}}}}else{if(currentVis!="visible"||currentVis===""){this.beforeShowEvent.fire();YAHOO.util.Dom.setStyle(this.element,"visibility","visible");this.cfg.refireEvent("iframe");this.showEvent.fire();}}}else{if(isMacGecko){this.hideMacGeckoScrollbars();}
if(effect){if(currentVis=="visible"){this.beforeHideEvent.fire();for(var k=0;k<effectInstances.length;k++){var h=effectInstances[k];if(k===0&&!YAHOO.util.Config.alreadySubscribed(h.animateOutCompleteEvent,this.hideEvent.fire,this.hideEvent)){h.animateOutCompleteEvent.subscribe(this.hideEvent.fire,this.hideEvent,true);}
h.animateOut();}}else if(currentVis===""){YAHOO.util.Dom.setStyle(this.element,"visibility","hidden");}}else{if(currentVis=="visible"||currentVis===""){this.beforeHideEvent.fire();YAHOO.util.Dom.setStyle(this.element,"visibility","hidden");this.cfg.refireEvent("iframe");this.hideEvent.fire();}}}};YAHOO.widget.Overlay.prototype.doCenterOnDOMEvent=function(){if(this.cfg.getProperty("visible")){this.center();}};YAHOO.widget.Overlay.prototype.configFixedCenter=function(type,args,obj){var val=args[0];if(val){this.center();if(!YAHOO.util.Config.alreadySubscribed(this.beforeShowEvent,this.center,this)){this.beforeShowEvent.subscribe(this.center,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(YAHOO.widget.Overlay.windowResizeEvent,this.doCenterOnDOMEvent,this)){YAHOO.widget.Overlay.windowResizeEvent.subscribe(this.doCenterOnDOMEvent,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(YAHOO.widget.Overlay.windowScrollEvent,this.doCenterOnDOMEvent,this)){YAHOO.widget.Overlay.windowScrollEvent.subscribe(this.doCenterOnDOMEvent,this,true);}}else{YAHOO.widget.Overlay.windowResizeEvent.unsubscribe(this.doCenterOnDOMEvent,this);YAHOO.widget.Overlay.windowScrollEvent.unsubscribe(this.doCenterOnDOMEvent,this);}};YAHOO.widget.Overlay.prototype.configHeight=function(type,args,obj){var height=args[0];var el=this.element;YAHOO.util.Dom.setStyle(el,"height",height);this.cfg.refireEvent("iframe");};YAHOO.widget.Overlay.prototype.configWidth=function(type,args,obj){var width=args[0];var el=this.element;YAHOO.util.Dom.setStyle(el,"width",width);this.cfg.refireEvent("iframe");};YAHOO.widget.Overlay.prototype.configzIndex=function(type,args,obj){var zIndex=args[0];var el=this.element;if(!zIndex){zIndex=YAHOO.util.Dom.getStyle(el,"zIndex");if(!zIndex||isNaN(zIndex)){zIndex=0;}}
if(this.iframe){if(zIndex<=0){zIndex=1;}
YAHOO.util.Dom.setStyle(this.iframe,"zIndex",(zIndex-1));}
YAHOO.util.Dom.setStyle(el,"zIndex",zIndex);this.cfg.setProperty("zIndex",zIndex,true);};YAHOO.widget.Overlay.prototype.configXY=function(type,args,obj){var pos=args[0];var x=pos[0];var y=pos[1];this.cfg.setProperty("x",x);this.cfg.setProperty("y",y);this.beforeMoveEvent.fire([x,y]);x=this.cfg.getProperty("x");y=this.cfg.getProperty("y");this.cfg.refireEvent("iframe");this.moveEvent.fire([x,y]);};YAHOO.widget.Overlay.prototype.configX=function(type,args,obj){var x=args[0];var y=this.cfg.getProperty("y");this.cfg.setProperty("x",x,true);this.cfg.setProperty("y",y,true);this.beforeMoveEvent.fire([x,y]);x=this.cfg.getProperty("x");y=this.cfg.getProperty("y");YAHOO.util.Dom.setX(this.element,x,true);this.cfg.setProperty("xy",[x,y],true);this.cfg.refireEvent("iframe");this.moveEvent.fire([x,y]);};YAHOO.widget.Overlay.prototype.configY=function(type,args,obj){var x=this.cfg.getProperty("x");var y=args[0];this.cfg.setProperty("x",x,true);this.cfg.setProperty("y",y,true);this.beforeMoveEvent.fire([x,y]);x=this.cfg.getProperty("x");y=this.cfg.getProperty("y");YAHOO.util.Dom.setY(this.element,y,true);this.cfg.setProperty("xy",[x,y],true);this.cfg.refireEvent("iframe");this.moveEvent.fire([x,y]);};YAHOO.widget.Overlay.prototype.showIframe=function(){if(this.iframe){this.iframe.style.display="block";}};YAHOO.widget.Overlay.prototype.hideIframe=function(){if(this.iframe){this.iframe.style.display="none";}};YAHOO.widget.Overlay.prototype.configIframe=function(type,args,obj){var val=args[0];if(val){if(!YAHOO.util.Config.alreadySubscribed(this.showEvent,this.showIframe,this)){this.showEvent.subscribe(this.showIframe,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.hideEvent,this.hideIframe,this)){this.hideEvent.subscribe(this.hideIframe,this,true);}
var x=this.cfg.getProperty("x");var y=this.cfg.getProperty("y");if(!x||!y){this.syncPosition();x=this.cfg.getProperty("x");y=this.cfg.getProperty("y");}
if(!isNaN(x)&&!isNaN(y)){if(!this.iframe){this.iframe=document.createElement("iframe");if(this.isSecure){this.iframe.src=YAHOO.widget.Overlay.IFRAME_SRC;}
var parent=this.element.parentNode;if(parent){parent.appendChild(this.iframe);}else{document.body.appendChild(this.iframe);}
YAHOO.util.Dom.setStyle(this.iframe,"position","absolute");YAHOO.util.Dom.setStyle(this.iframe,"border","none");YAHOO.util.Dom.setStyle(this.iframe,"margin","0");YAHOO.util.Dom.setStyle(this.iframe,"padding","0");YAHOO.util.Dom.setStyle(this.iframe,"opacity","0");if(this.cfg.getProperty("visible")){this.showIframe();}else{this.hideIframe();}}
var iframeDisplay=YAHOO.util.Dom.getStyle(this.iframe,"display");if(iframeDisplay=="none"){this.iframe.style.display="block";}
YAHOO.util.Dom.setXY(this.iframe,[x,y]);var width=this.element.clientWidth;var height=this.element.clientHeight;YAHOO.util.Dom.setStyle(this.iframe,"width",(width+2)+"px");YAHOO.util.Dom.setStyle(this.iframe,"height",(height+2)+"px");if(iframeDisplay=="none"){this.iframe.style.display="none";}}}else{if(this.iframe){this.iframe.style.display="none";}
this.showEvent.unsubscribe(this.showIframe,this);this.hideEvent.unsubscribe(this.hideIframe,this);}};YAHOO.widget.Overlay.prototype.configConstrainToViewport=function(type,args,obj){var val=args[0];if(val){if(!YAHOO.util.Config.alreadySubscribed(this.beforeMoveEvent,this.enforceConstraints,this)){this.beforeMoveEvent.subscribe(this.enforceConstraints,this,true);}}else{this.beforeMoveEvent.unsubscribe(this.enforceConstraints,this);}};YAHOO.widget.Overlay.prototype.configContext=function(type,args,obj){var contextArgs=args[0];if(contextArgs){var contextEl=contextArgs[0];var elementMagnetCorner=contextArgs[1];var contextMagnetCorner=contextArgs[2];if(contextEl){if(typeof contextEl=="string"){this.cfg.setProperty("context",[document.getElementById(contextEl),elementMagnetCorner,contextMagnetCorner],true);}
if(elementMagnetCorner&&contextMagnetCorner){this.align(elementMagnetCorner,contextMagnetCorner);}}}};YAHOO.widget.Overlay.prototype.align=function(elementAlign,contextAlign){var contextArgs=this.cfg.getProperty("context");if(contextArgs){var context=contextArgs[0];var element=this.element;var me=this;if(!elementAlign){elementAlign=contextArgs[1];}
if(!contextAlign){contextAlign=contextArgs[2];}
if(element&&context){var contextRegion=YAHOO.util.Dom.getRegion(context);var doAlign=function(v,h){switch(elementAlign){case YAHOO.widget.Overlay.TOP_LEFT:me.moveTo(h,v);break;case YAHOO.widget.Overlay.TOP_RIGHT:me.moveTo(h-element.offsetWidth,v);break;case YAHOO.widget.Overlay.BOTTOM_LEFT:me.moveTo(h,v-element.offsetHeight);break;case YAHOO.widget.Overlay.BOTTOM_RIGHT:me.moveTo(h-element.offsetWidth,v-element.offsetHeight);break;}};switch(contextAlign){case YAHOO.widget.Overlay.TOP_LEFT:doAlign(contextRegion.top,contextRegion.left);break;case YAHOO.widget.Overlay.TOP_RIGHT:doAlign(contextRegion.top,contextRegion.right);break;case YAHOO.widget.Overlay.BOTTOM_LEFT:doAlign(contextRegion.bottom,contextRegion.left);break;case YAHOO.widget.Overlay.BOTTOM_RIGHT:doAlign(contextRegion.bottom,contextRegion.right);break;}}}};YAHOO.widget.Overlay.prototype.enforceConstraints=function(type,args,obj){var pos=args[0];var x=pos[0];var y=pos[1];var offsetHeight=this.element.offsetHeight;var offsetWidth=this.element.offsetWidth;var viewPortWidth=YAHOO.util.Dom.getViewportWidth();var viewPortHeight=YAHOO.util.Dom.getViewportHeight();var scrollX=document.documentElement.scrollLeft||document.body.scrollLeft;var scrollY=document.documentElement.scrollTop||document.body.scrollTop;var topConstraint=scrollY+10;var leftConstraint=scrollX+10;var bottomConstraint=scrollY+viewPortHeight-offsetHeight-10;var rightConstraint=scrollX+viewPortWidth-offsetWidth-10;if(x<leftConstraint){x=leftConstraint;}else if(x>rightConstraint){x=rightConstraint;}
if(y<topConstraint){y=topConstraint;}else if(y>bottomConstraint){y=bottomConstraint;}
this.cfg.setProperty("x",x,true);this.cfg.setProperty("y",y,true);this.cfg.setProperty("xy",[x,y],true);};YAHOO.widget.Overlay.prototype.center=function(){var scrollX=document.documentElement.scrollLeft||document.body.scrollLeft;var scrollY=document.documentElement.scrollTop||document.body.scrollTop;var viewPortWidth=YAHOO.util.Dom.getClientWidth();var viewPortHeight=YAHOO.util.Dom.getClientHeight();var elementWidth=this.element.offsetWidth;var elementHeight=this.element.offsetHeight;var x=(viewPortWidth/2)-(elementWidth/2)+scrollX;var y=(viewPortHeight/2)-(elementHeight/2)+scrollY;this.cfg.setProperty("xy",[parseInt(x,10),parseInt(y,10)]);this.cfg.refireEvent("iframe");};YAHOO.widget.Overlay.prototype.syncPosition=function(){var pos=YAHOO.util.Dom.getXY(this.element);this.cfg.setProperty("x",pos[0],true);this.cfg.setProperty("y",pos[1],true);this.cfg.setProperty("xy",pos,true);};YAHOO.widget.Overlay.prototype.onDomResize=function(e,obj){YAHOO.widget.Overlay.superclass.onDomResize.call(this,e,obj);var me=this;setTimeout(function(){me.syncPosition();me.cfg.refireEvent("iframe");me.cfg.refireEvent("context");},0);};YAHOO.widget.Overlay.prototype.destroy=function(){if(this.iframe){this.iframe.parentNode.removeChild(this.iframe);}
this.iframe=null;YAHOO.widget.Overlay.windowResizeEvent.unsubscribe(this.doCenterOnDOMEvent,this);YAHOO.widget.Overlay.windowScrollEvent.unsubscribe(this.doCenterOnDOMEvent,this);YAHOO.widget.Overlay.superclass.destroy.call(this);};YAHOO.widget.Overlay.prototype.toString=function(){return"Overlay "+this.id;};YAHOO.widget.Overlay.windowScrollEvent=new YAHOO.util.CustomEvent("windowScroll");YAHOO.widget.Overlay.windowResizeEvent=new YAHOO.util.CustomEvent("windowResize");YAHOO.widget.Overlay.windowScrollHandler=function(e){if(YAHOO.widget.Module.prototype.browser=="ie"||YAHOO.widget.Module.prototype.browser=="ie7"){if(!window.scrollEnd){window.scrollEnd=-1;}
clearTimeout(window.scrollEnd);window.scrollEnd=setTimeout(function(){YAHOO.widget.Overlay.windowScrollEvent.fire();},1);}else{YAHOO.widget.Overlay.windowScrollEvent.fire();}};YAHOO.widget.Overlay.windowResizeHandler=function(e){if(YAHOO.widget.Module.prototype.browser=="ie"||YAHOO.widget.Module.prototype.browser=="ie7"){if(!window.resizeEnd){window.resizeEnd=-1;}
clearTimeout(window.resizeEnd);window.resizeEnd=setTimeout(function(){YAHOO.widget.Overlay.windowResizeEvent.fire();},100);}else{YAHOO.widget.Overlay.windowResizeEvent.fire();}};YAHOO.widget.Overlay._initialized=null;if(YAHOO.widget.Overlay._initialized===null){YAHOO.util.Event.addListener(window,"scroll",YAHOO.widget.Overlay.windowScrollHandler);YAHOO.util.Event.addListener(window,"resize",YAHOO.widget.Overlay.windowResizeHandler);YAHOO.widget.Overlay._initialized=true;}
YAHOO.widget.OverlayManager=function(userConfig){this.init(userConfig);};YAHOO.widget.OverlayManager.CSS_FOCUSED="focused";YAHOO.widget.OverlayManager.prototype={constructor:YAHOO.widget.OverlayManager,overlays:null,initDefaultConfig:function(){this.cfg.addProperty("overlays",{suppressEvent:true});this.cfg.addProperty("focusevent",{value:"mousedown"});},init:function(userConfig){this.cfg=new YAHOO.util.Config(this);this.initDefaultConfig();if(userConfig){this.cfg.applyConfig(userConfig,true);}
this.cfg.fireQueue();var activeOverlay=null;this.getActive=function(){return activeOverlay;};this.focus=function(overlay){var o=this.find(overlay);if(o){if(activeOverlay!=o){if(activeOverlay){activeOverlay.blur();}
activeOverlay=o;YAHOO.util.Dom.addClass(activeOverlay.element,YAHOO.widget.OverlayManager.CSS_FOCUSED);this.overlays.sort(this.compareZIndexDesc);var topZIndex=YAHOO.util.Dom.getStyle(this.overlays[0].element,"zIndex");if(!isNaN(topZIndex)&&this.overlays[0]!=overlay){activeOverlay.cfg.setProperty("zIndex",(parseInt(topZIndex,10)+2));}
this.overlays.sort(this.compareZIndexDesc);o.focusEvent.fire();}}};this.remove=function(overlay){var o=this.find(overlay);if(o){var originalZ=YAHOO.util.Dom.getStyle(o.element,"zIndex");o.cfg.setProperty("zIndex",-1000,true);this.overlays.sort(this.compareZIndexDesc);this.overlays=this.overlays.slice(0,this.overlays.length-1);o.hideEvent.unsubscribe(o.blur);o.destroyEvent.unsubscribe(this._onOverlayDestroy,o);if(o.element){YAHOO.util.Event.removeListener(o.element,this.cfg.getProperty("focusevent"),this._onOverlayElementFocus);}
o.cfg.setProperty("zIndex",originalZ,true);o.cfg.setProperty("manager",null);o.focusEvent.unsubscribeAll();o.blurEvent.unsubscribeAll();o.focusEvent=null;o.blurEvent=null;o.focus=null;o.blur=null;}};this.blurAll=function(){for(var o=0;o<this.overlays.length;o++){this.overlays[o].blur();}};this._onOverlayBlur=function(p_sType,p_aArgs){activeOverlay=null;};var overlays=this.cfg.getProperty("overlays");if(!this.overlays){this.overlays=[];}
if(overlays){this.register(overlays);this.overlays.sort(this.compareZIndexDesc);}},_onOverlayElementFocus:function(p_oEvent){var oTarget=YAHOO.util.Event.getTarget(p_oEvent),oClose=this.close;if(oClose&&(oTarget==oClose||YAHOO.util.Dom.isAncestor(oClose,oTarget))){this.blur();}
else{this.focus();}},_onOverlayDestroy:function(p_sType,p_aArgs,p_oOverlay){this.remove(p_oOverlay);},register:function(overlay){if(overlay instanceof YAHOO.widget.Overlay){overlay.cfg.addProperty("manager",{value:this});overlay.focusEvent=new YAHOO.util.CustomEvent("focus",overlay);overlay.blurEvent=new YAHOO.util.CustomEvent("blur",overlay);var mgr=this;overlay.focus=function(){mgr.focus(this);};overlay.blur=function(){if(mgr.getActive()==this){YAHOO.util.Dom.removeClass(this.element,YAHOO.widget.OverlayManager.CSS_FOCUSED);this.blurEvent.fire();}};overlay.blurEvent.subscribe(mgr._onOverlayBlur);overlay.hideEvent.subscribe(overlay.blur);overlay.destroyEvent.subscribe(this._onOverlayDestroy,overlay,this);YAHOO.util.Event.addListener(overlay.element,this.cfg.getProperty("focusevent"),this._onOverlayElementFocus,null,overlay);var zIndex=YAHOO.util.Dom.getStyle(overlay.element,"zIndex");if(!isNaN(zIndex)){overlay.cfg.setProperty("zIndex",parseInt(zIndex,10));}else{overlay.cfg.setProperty("zIndex",0);}
this.overlays.push(overlay);return true;}else if(overlay instanceof Array){var regcount=0;for(var i=0;i<overlay.length;i++){if(this.register(overlay[i])){regcount++;}}
if(regcount>0){return true;}}else{return false;}},find:function(overlay){if(overlay instanceof YAHOO.widget.Overlay){for(var o=0;o<this.overlays.length;o++){if(this.overlays[o]==overlay){return this.overlays[o];}}}else if(typeof overlay=="string"){for(var p=0;p<this.overlays.length;p++){if(this.overlays[p].id==overlay){return this.overlays[p];}}}
return null;},compareZIndexDesc:function(o1,o2){var zIndex1=o1.cfg.getProperty("zIndex");var zIndex2=o2.cfg.getProperty("zIndex");if(zIndex1>zIndex2){return-1;}else if(zIndex1<zIndex2){return 1;}else{return 0;}},showAll:function(){for(var o=0;o<this.overlays.length;o++){this.overlays[o].show();}},hideAll:function(){for(var o=0;o<this.overlays.length;o++){this.overlays[o].hide();}},toString:function(){return"OverlayManager";}};YAHOO.widget.Tooltip=function(el,userConfig){YAHOO.widget.Tooltip.superclass.constructor.call(this,el,userConfig);};YAHOO.extend(YAHOO.widget.Tooltip,YAHOO.widget.Overlay);YAHOO.widget.Tooltip.CSS_TOOLTIP="yui-tt";YAHOO.widget.Tooltip._DEFAULT_CONFIG={"PREVENT_OVERLAP":{key:"preventoverlap",value:true,validator:YAHOO.lang.isBoolean,supercedes:["x","y","xy"]},"SHOW_DELAY":{key:"showdelay",value:200,validator:YAHOO.lang.isNumber},"AUTO_DISMISS_DELAY":{key:"autodismissdelay",value:5000,validator:YAHOO.lang.isNumber},"HIDE_DELAY":{key:"hidedelay",value:250,validator:YAHOO.lang.isNumber},"TEXT":{key:"text",suppressEvent:true},"CONTAINER":{key:"container"}};YAHOO.widget.Tooltip.prototype.init=function(el,userConfig){if(document.readyState&&document.readyState!="complete"){var deferredInit=function(){this.init(el,userConfig);};YAHOO.util.Event.addListener(window,"load",deferredInit,this,true);}else{YAHOO.widget.Tooltip.superclass.init.call(this,el);this.beforeInitEvent.fire(YAHOO.widget.Tooltip);YAHOO.util.Dom.addClass(this.element,YAHOO.widget.Tooltip.CSS_TOOLTIP);if(userConfig){this.cfg.applyConfig(userConfig,true);}
this.cfg.queueProperty("visible",false);this.cfg.queueProperty("constraintoviewport",true);this.setBody("");this.render(this.cfg.getProperty("container"));this.initEvent.fire(YAHOO.widget.Tooltip);}};YAHOO.widget.Tooltip.prototype.initDefaultConfig=function(){YAHOO.widget.Tooltip.superclass.initDefaultConfig.call(this);var DEFAULT_CONFIG=YAHOO.widget.Tooltip._DEFAULT_CONFIG;this.cfg.addProperty(DEFAULT_CONFIG.PREVENT_OVERLAP.key,{value:DEFAULT_CONFIG.PREVENT_OVERLAP.value,validator:DEFAULT_CONFIG.PREVENT_OVERLAP.validator,supercedes:DEFAULT_CONFIG.PREVENT_OVERLAP.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.SHOW_DELAY.key,{handler:this.configShowDelay,value:200,validator:DEFAULT_CONFIG.SHOW_DELAY.validator});this.cfg.addProperty(DEFAULT_CONFIG.AUTO_DISMISS_DELAY.key,{handler:this.configAutoDismissDelay,value:DEFAULT_CONFIG.AUTO_DISMISS_DELAY.value,validator:DEFAULT_CONFIG.AUTO_DISMISS_DELAY.validator});this.cfg.addProperty(DEFAULT_CONFIG.HIDE_DELAY.key,{handler:this.configHideDelay,value:DEFAULT_CONFIG.HIDE_DELAY.value,validator:DEFAULT_CONFIG.HIDE_DELAY.validator});this.cfg.addProperty(DEFAULT_CONFIG.TEXT.key,{handler:this.configText,suppressEvent:DEFAULT_CONFIG.TEXT.suppressEvent});this.cfg.addProperty(DEFAULT_CONFIG.CONTAINER.key,{handler:this.configContainer,value:document.body});};YAHOO.widget.Tooltip.prototype.configText=function(type,args,obj){var text=args[0];if(text){this.setBody(text);}};YAHOO.widget.Tooltip.prototype.configContainer=function(type,args,obj){var container=args[0];if(typeof container=='string'){this.cfg.setProperty("container",document.getElementById(container),true);}};YAHOO.widget.Tooltip.prototype._removeEventListeners=function(){var aElements=this._context;if(aElements){var nElements=aElements.length;if(nElements>0){var i=nElements-1,oElement;do{oElement=aElements[i];YAHOO.util.Event.removeListener(oElement,"mouseover",this.onContextMouseOver);YAHOO.util.Event.removeListener(oElement,"mousemove",this.onContextMouseMove);YAHOO.util.Event.removeListener(oElement,"mouseout",this.onContextMouseOut);}
while(i--);}}};YAHOO.widget.Tooltip.prototype.configContext=function(type,args,obj){var context=args[0];if(context){if(!(context instanceof Array)){if(typeof context=="string"){this.cfg.setProperty("context",[document.getElementById(context)],true);}else{this.cfg.setProperty("context",[context],true);}
context=this.cfg.getProperty("context");}
this._removeEventListeners();this._context=context;var aElements=this._context;if(aElements){var nElements=aElements.length;if(nElements>0){var i=nElements-1,oElement;do{oElement=aElements[i];YAHOO.util.Event.addListener(oElement,"mouseover",this.onContextMouseOver,this);YAHOO.util.Event.addListener(oElement,"mousemove",this.onContextMouseMove,this);YAHOO.util.Event.addListener(oElement,"mouseout",this.onContextMouseOut,this);}
while(i--);}}}};YAHOO.widget.Tooltip.prototype.onContextMouseMove=function(e,obj){obj.pageX=YAHOO.util.Event.getPageX(e);obj.pageY=YAHOO.util.Event.getPageY(e);};YAHOO.widget.Tooltip.prototype.onContextMouseOver=function(e,obj){if(obj.hideProcId){clearTimeout(obj.hideProcId);obj.hideProcId=null;}
var context=this;YAHOO.util.Event.addListener(context,"mousemove",obj.onContextMouseMove,obj);if(context.title){obj._tempTitle=context.title;context.title="";}
obj.showProcId=obj.doShow(e,context);};YAHOO.widget.Tooltip.prototype.onContextMouseOut=function(e,obj){var el=this;if(obj._tempTitle){el.title=obj._tempTitle;obj._tempTitle=null;}
if(obj.showProcId){clearTimeout(obj.showProcId);obj.showProcId=null;}
if(obj.hideProcId){clearTimeout(obj.hideProcId);obj.hideProcId=null;}
obj.hideProcId=setTimeout(function(){obj.hide();},obj.cfg.getProperty("hidedelay"));};YAHOO.widget.Tooltip.prototype.doShow=function(e,context){var yOffset=25;if(this.browser=="opera"&&context.tagName&&context.tagName.toUpperCase()=="A"){yOffset+=12;}
var me=this;return setTimeout(function(){if(me._tempTitle){me.setBody(me._tempTitle);}else{me.cfg.refireEvent("text");}
me.moveTo(me.pageX,me.pageY+yOffset);if(me.cfg.getProperty("preventoverlap")){me.preventOverlap(me.pageX,me.pageY);}
YAHOO.util.Event.removeListener(context,"mousemove",me.onContextMouseMove);me.show();me.hideProcId=me.doHide();},this.cfg.getProperty("showdelay"));};YAHOO.widget.Tooltip.prototype.doHide=function(){var me=this;return setTimeout(function(){me.hide();},this.cfg.getProperty("autodismissdelay"));};YAHOO.widget.Tooltip.prototype.preventOverlap=function(pageX,pageY){var height=this.element.offsetHeight;var elementRegion=YAHOO.util.Dom.getRegion(this.element);elementRegion.top-=5;elementRegion.left-=5;elementRegion.right+=5;elementRegion.bottom+=5;var mousePoint=new YAHOO.util.Point(pageX,pageY);if(elementRegion.contains(mousePoint)){this.cfg.setProperty("y",(pageY-height-5));}};YAHOO.widget.Tooltip.prototype.destroy=function(){this._removeEventListeners();YAHOO.widget.Tooltip.superclass.destroy.call(this);};YAHOO.widget.Tooltip.prototype.toString=function(){return"Tooltip "+this.id;};YAHOO.widget.Panel=function(el,userConfig){YAHOO.widget.Panel.superclass.constructor.call(this,el,userConfig);};YAHOO.extend(YAHOO.widget.Panel,YAHOO.widget.Overlay);YAHOO.widget.Panel.CSS_PANEL="yui-panel";YAHOO.widget.Panel.CSS_PANEL_CONTAINER="yui-panel-container";YAHOO.widget.Panel._EVENT_TYPES={"SHOW_MASK":"showMask","HIDE_MASK":"hideMask","DRAG":"drag"};YAHOO.widget.Panel._DEFAULT_CONFIG={"CLOSE":{key:"close",value:true,validator:YAHOO.lang.isBoolean,supercedes:["visible"]},"DRAGGABLE":{key:"draggable",value:(YAHOO.util.DD?true:false),validator:YAHOO.lang.isBoolean,supercedes:["visible"]},"UNDERLAY":{key:"underlay",value:"shadow",supercedes:["visible"]},"MODAL":{key:"modal",value:false,validator:YAHOO.lang.isBoolean,supercedes:["visible"]},"KEY_LISTENERS":{key:"keylisteners",suppressEvent:true,supercedes:["visible"]}};YAHOO.widget.Panel.prototype.init=function(el,userConfig){YAHOO.widget.Panel.superclass.init.call(this,el);this.beforeInitEvent.fire(YAHOO.widget.Panel);YAHOO.util.Dom.addClass(this.element,YAHOO.widget.Panel.CSS_PANEL);this.buildWrapper();if(userConfig){this.cfg.applyConfig(userConfig,true);}
this.beforeRenderEvent.subscribe(function(){var draggable=this.cfg.getProperty("draggable");if(draggable){if(!this.header){this.setHeader("&#160;");}}},this,true);this.renderEvent.subscribe(function(){var sWidth=this.cfg.getProperty("width");if(!sWidth){this.cfg.setProperty("width",(this.element.offsetWidth+"px"));}});var me=this;var doBlur=function(){this.blur();};this.showMaskEvent.subscribe(function(){var checkFocusable=function(el){var sTagName=el.tagName.toUpperCase(),bFocusable=false;switch(sTagName){case"A":case"BUTTON":case"SELECT":case"TEXTAREA":if(!YAHOO.util.Dom.isAncestor(me.element,el)){YAHOO.util.Event.addListener(el,"focus",doBlur,el,true);bFocusable=true;}
break;case"INPUT":if(el.type!="hidden"&&!YAHOO.util.Dom.isAncestor(me.element,el)){YAHOO.util.Event.addListener(el,"focus",doBlur,el,true);bFocusable=true;}
break;}
return bFocusable;};this.focusableElements=YAHOO.util.Dom.getElementsBy(checkFocusable);},this,true);this.hideMaskEvent.subscribe(function(){for(var i=0;i<this.focusableElements.length;i++){var el2=this.focusableElements[i];YAHOO.util.Event.removeListener(el2,"focus",doBlur);}},this,true);this.beforeShowEvent.subscribe(function(){this.cfg.refireEvent("underlay");},this,true);this.initEvent.fire(YAHOO.widget.Panel);};YAHOO.widget.Panel.prototype.initEvents=function(){YAHOO.widget.Panel.superclass.initEvents.call(this);var EVENT_TYPES=YAHOO.widget.Panel._EVENT_TYPES;this.showMaskEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.SHOW_MASK,this);this.hideMaskEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.HIDE_MASK,this);this.dragEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.DRAG,this);};YAHOO.widget.Panel.prototype.initDefaultConfig=function(){YAHOO.widget.Panel.superclass.initDefaultConfig.call(this);var DEFAULT_CONFIG=YAHOO.widget.Panel._DEFAULT_CONFIG;this.cfg.addProperty(DEFAULT_CONFIG.CLOSE.key,{handler:this.configClose,value:DEFAULT_CONFIG.CLOSE.value,validator:DEFAULT_CONFIG.CLOSE.validator,supercedes:DEFAULT_CONFIG.CLOSE.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.DRAGGABLE.key,{handler:this.configDraggable,value:DEFAULT_CONFIG.DRAGGABLE.value,validator:DEFAULT_CONFIG.DRAGGABLE.validator,supercedes:DEFAULT_CONFIG.DRAGGABLE.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.UNDERLAY.key,{handler:this.configUnderlay,value:DEFAULT_CONFIG.UNDERLAY.value,supercedes:DEFAULT_CONFIG.UNDERLAY.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.MODAL.key,{handler:this.configModal,value:DEFAULT_CONFIG.MODAL.value,validator:DEFAULT_CONFIG.MODAL.validator,supercedes:DEFAULT_CONFIG.MODAL.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.KEY_LISTENERS.key,{handler:this.configKeyListeners,suppressEvent:DEFAULT_CONFIG.KEY_LISTENERS.suppressEvent,supercedes:DEFAULT_CONFIG.KEY_LISTENERS.supercedes});};YAHOO.widget.Panel.prototype.configClose=function(type,args,obj){var val=args[0];var doHide=function(e,obj){obj.hide();};if(val){if(!this.close){this.close=document.createElement("span");YAHOO.util.Dom.addClass(this.close,"container-close");this.close.innerHTML="&#160;";this.innerElement.appendChild(this.close);YAHOO.util.Event.addListener(this.close,"click",doHide,this);}else{this.close.style.display="block";}}else{if(this.close){this.close.style.display="none";}}};YAHOO.widget.Panel.prototype.configDraggable=function(type,args,obj){var val=args[0];if(val){if(!YAHOO.util.DD){this.cfg.setProperty("draggable",false);return;}
if(this.header){YAHOO.util.Dom.setStyle(this.header,"cursor","move");this.registerDragDrop();}}else{if(this.dd){this.dd.unreg();}
if(this.header){YAHOO.util.Dom.setStyle(this.header,"cursor","auto");}}};YAHOO.widget.Panel.prototype.configUnderlay=function(type,args,obj){var val=args[0];switch(val.toLowerCase()){case"shadow":YAHOO.util.Dom.removeClass(this.element,"matte");YAHOO.util.Dom.addClass(this.element,"shadow");if(!this.underlay){this.underlay=document.createElement("div");this.underlay.className="underlay";this.underlay.innerHTML="&#160;";this.element.appendChild(this.underlay);}
this.sizeUnderlay();break;case"matte":YAHOO.util.Dom.removeClass(this.element,"shadow");YAHOO.util.Dom.addClass(this.element,"matte");break;default:YAHOO.util.Dom.removeClass(this.element,"shadow");YAHOO.util.Dom.removeClass(this.element,"matte");break;}};YAHOO.widget.Panel.prototype.configModal=function(type,args,obj){var modal=args[0];if(modal){this.buildMask();if(!YAHOO.util.Config.alreadySubscribed(this.beforeShowEvent,this.showMask,this)){this.beforeShowEvent.subscribe(this.showMask,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.hideEvent,this.hideMask,this)){this.hideEvent.subscribe(this.hideMask,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(YAHOO.widget.Overlay.windowResizeEvent,this.sizeMask,this)){YAHOO.widget.Overlay.windowResizeEvent.subscribe(this.sizeMask,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.destroyEvent,this.removeMask,this)){this.destroyEvent.subscribe(this.removeMask,this,true);}
this.cfg.refireEvent("zIndex");}else{this.beforeShowEvent.unsubscribe(this.showMask,this);this.hideEvent.unsubscribe(this.hideMask,this);YAHOO.widget.Overlay.windowResizeEvent.unsubscribe(this.sizeMask,this);this.destroyEvent.unsubscribe(this.removeMask,this);}};YAHOO.widget.Panel.prototype.removeMask=function(){var oMask=this.mask;if(oMask){this.hideMask();var oParentNode=oMask.parentNode;if(oParentNode){oParentNode.removeChild(oMask);}
this.mask=null;}};YAHOO.widget.Panel.prototype.configKeyListeners=function(type,args,obj){var listeners=args[0];if(listeners){if(listeners instanceof Array){for(var i=0;i<listeners.length;i++){var listener=listeners[i];if(!YAHOO.util.Config.alreadySubscribed(this.showEvent,listener.enable,listener)){this.showEvent.subscribe(listener.enable,listener,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.hideEvent,listener.disable,listener)){this.hideEvent.subscribe(listener.disable,listener,true);this.destroyEvent.subscribe(listener.disable,listener,true);}}}else{if(!YAHOO.util.Config.alreadySubscribed(this.showEvent,listeners.enable,listeners)){this.showEvent.subscribe(listeners.enable,listeners,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.hideEvent,listeners.disable,listeners)){this.hideEvent.subscribe(listeners.disable,listeners,true);this.destroyEvent.subscribe(listeners.disable,listeners,true);}}}};YAHOO.widget.Panel.prototype.configHeight=function(type,args,obj){var height=args[0];var el=this.innerElement;YAHOO.util.Dom.setStyle(el,"height",height);this.cfg.refireEvent("underlay");this.cfg.refireEvent("iframe");};YAHOO.widget.Panel.prototype.configWidth=function(type,args,obj){var width=args[0];var el=this.innerElement;YAHOO.util.Dom.setStyle(el,"width",width);this.cfg.refireEvent("underlay");this.cfg.refireEvent("iframe");};YAHOO.widget.Panel.prototype.configzIndex=function(type,args,obj){YAHOO.widget.Panel.superclass.configzIndex.call(this,type,args,obj);var maskZ=0;var currentZ=YAHOO.util.Dom.getStyle(this.element,"zIndex");if(this.mask){if(!currentZ||isNaN(currentZ)){currentZ=0;}
if(currentZ===0){this.cfg.setProperty("zIndex",1);}else{maskZ=currentZ-1;YAHOO.util.Dom.setStyle(this.mask,"zIndex",maskZ);}}};YAHOO.widget.Panel.prototype.buildWrapper=function(){var elementParent=this.element.parentNode;var originalElement=this.element;var wrapper=document.createElement("div");wrapper.className=YAHOO.widget.Panel.CSS_PANEL_CONTAINER;wrapper.id=originalElement.id+"_c";if(elementParent){elementParent.insertBefore(wrapper,originalElement);}
wrapper.appendChild(originalElement);this.element=wrapper;this.innerElement=originalElement;YAHOO.util.Dom.setStyle(this.innerElement,"visibility","inherit");};YAHOO.widget.Panel.prototype.sizeUnderlay=function(){if(this.underlay&&this.browser!="gecko"&&this.browser!="safari"){this.underlay.style.width=this.innerElement.offsetWidth+"px";this.underlay.style.height=this.innerElement.offsetHeight+"px";}};YAHOO.widget.Panel.prototype.onDomResize=function(e,obj){YAHOO.widget.Panel.superclass.onDomResize.call(this,e,obj);var me=this;setTimeout(function(){me.sizeUnderlay();},0);};YAHOO.widget.Panel.prototype.registerDragDrop=function(){if(this.header){if(!YAHOO.util.DD){return;}
this.dd=new YAHOO.util.DD(this.element.id,this.id);if(!this.header.id){this.header.id=this.id+"_h";}
var me=this;this.dd.startDrag=function(){if(me.browser=="ie"){YAHOO.util.Dom.addClass(me.element,"drag");}
if(me.cfg.getProperty("constraintoviewport")){var offsetHeight=me.element.offsetHeight;var offsetWidth=me.element.offsetWidth;var viewPortWidth=YAHOO.util.Dom.getViewportWidth();var viewPortHeight=YAHOO.util.Dom.getViewportHeight();var scrollX=window.scrollX||document.documentElement.scrollLeft;var scrollY=window.scrollY||document.documentElement.scrollTop;var topConstraint=scrollY+10;var leftConstraint=scrollX+10;var bottomConstraint=scrollY+viewPortHeight-offsetHeight-10;var rightConstraint=scrollX+viewPortWidth-offsetWidth-10;this.minX=leftConstraint;this.maxX=rightConstraint;this.constrainX=true;this.minY=topConstraint;this.maxY=bottomConstraint;this.constrainY=true;}else{this.constrainX=false;this.constrainY=false;}
me.dragEvent.fire("startDrag",arguments);};this.dd.onDrag=function(){me.syncPosition();me.cfg.refireEvent("iframe");if(this.platform=="mac"&&this.browser=="gecko"){this.showMacGeckoScrollbars();}
me.dragEvent.fire("onDrag",arguments);};this.dd.endDrag=function(){if(me.browser=="ie"){YAHOO.util.Dom.removeClass(me.element,"drag");}
me.dragEvent.fire("endDrag",arguments);};this.dd.setHandleElId(this.header.id);this.dd.addInvalidHandleType("INPUT");this.dd.addInvalidHandleType("SELECT");this.dd.addInvalidHandleType("TEXTAREA");}};YAHOO.widget.Panel.prototype.buildMask=function(){if(!this.mask){this.mask=document.createElement("div");this.mask.id=this.id+"_mask";this.mask.className="mask";this.mask.innerHTML="&#160;";var maskClick=function(e,obj){YAHOO.util.Event.stopEvent(e);};var firstChild=document.body.firstChild;if(firstChild){document.body.insertBefore(this.mask,document.body.firstChild);}else{document.body.appendChild(this.mask);}}};YAHOO.widget.Panel.prototype.hideMask=function(){if(this.cfg.getProperty("modal")&&this.mask){this.mask.style.display="none";this.hideMaskEvent.fire();YAHOO.util.Dom.removeClass(document.body,"masked");}};YAHOO.widget.Panel.prototype.showMask=function(){if(this.cfg.getProperty("modal")&&this.mask){YAHOO.util.Dom.addClass(document.body,"masked");this.sizeMask();this.mask.style.display="block";this.showMaskEvent.fire();}};YAHOO.widget.Panel.prototype.sizeMask=function(){if(this.mask){this.mask.style.height=YAHOO.util.Dom.getDocumentHeight()+"px";this.mask.style.width=YAHOO.util.Dom.getDocumentWidth()+"px";}};YAHOO.widget.Panel.prototype.render=function(appendToNode){return YAHOO.widget.Panel.superclass.render.call(this,appendToNode,this.innerElement);};YAHOO.widget.Panel.prototype.destroy=function(){YAHOO.widget.Overlay.windowResizeEvent.unsubscribe(this.sizeMask,this);if(this.close){YAHOO.util.Event.purgeElement(this.close);}
YAHOO.widget.Panel.superclass.destroy.call(this);};YAHOO.widget.Panel.prototype.toString=function(){return"Panel "+this.id;};YAHOO.widget.Dialog=function(el,userConfig){YAHOO.widget.Dialog.superclass.constructor.call(this,el,userConfig);};YAHOO.extend(YAHOO.widget.Dialog,YAHOO.widget.Panel);YAHOO.widget.Dialog.CSS_DIALOG="yui-dialog";YAHOO.widget.Dialog._EVENT_TYPES={"BEFORE_SUBMIT":"beforeSubmit","SUBMIT":"submit","MANUAL_SUBMIT":"manualSubmit","ASYNC_SUBMIT":"asyncSubmit","FORM_SUBMIT":"formSubmit","CANCEL":"cancel"};YAHOO.widget.Dialog._DEFAULT_CONFIG={"POST_METHOD":{key:"postmethod",value:"async"},"BUTTONS":{key:"buttons",value:"none"}};YAHOO.widget.Dialog.prototype.initDefaultConfig=function(){YAHOO.widget.Dialog.superclass.initDefaultConfig.call(this);this.callback={success:null,failure:null,argument:null};var DEFAULT_CONFIG=YAHOO.widget.Dialog._DEFAULT_CONFIG;this.cfg.addProperty(DEFAULT_CONFIG.POST_METHOD.key,{handler:this.configPostMethod,value:DEFAULT_CONFIG.POST_METHOD.value,validator:function(val){if(val!="form"&&val!="async"&&val!="none"&&val!="manual"){return false;}else{return true;}}});this.cfg.addProperty(DEFAULT_CONFIG.BUTTONS.key,{handler:this.configButtons,value:DEFAULT_CONFIG.BUTTONS.value});};YAHOO.widget.Dialog.prototype.initEvents=function(){YAHOO.widget.Dialog.superclass.initEvents.call(this);var EVENT_TYPES=YAHOO.widget.Dialog._EVENT_TYPES;this.beforeSubmitEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_SUBMIT,this);this.submitEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.SUBMIT,this);this.manualSubmitEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.MANUAL_SUBMIT,this);this.asyncSubmitEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.ASYNC_SUBMIT,this);this.formSubmitEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.FORM_SUBMIT,this);this.cancelEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CANCEL,this);};YAHOO.widget.Dialog.prototype.init=function(el,userConfig){YAHOO.widget.Dialog.superclass.init.call(this,el);this.beforeInitEvent.fire(YAHOO.widget.Dialog);YAHOO.util.Dom.addClass(this.element,YAHOO.widget.Dialog.CSS_DIALOG);this.cfg.setProperty("visible",false);if(userConfig){this.cfg.applyConfig(userConfig,true);}
this.showEvent.subscribe(this.focusFirst,this,true);this.beforeHideEvent.subscribe(this.blurButtons,this,true);this.beforeRenderEvent.subscribe(function(){var buttonCfg=this.cfg.getProperty("buttons");if(buttonCfg&&buttonCfg!="none"){if(!this.footer){this.setFooter("");}}},this,true);this.initEvent.fire(YAHOO.widget.Dialog);};YAHOO.widget.Dialog.prototype.doSubmit=function(){var pm=this.cfg.getProperty("postmethod");switch(pm){case"async":var method=this.form.getAttribute("method")||'POST';method=method.toUpperCase();YAHOO.util.Connect.setForm(this.form);var cObj=YAHOO.util.Connect.asyncRequest(method,this.form.getAttribute("action"),this.callback);this.asyncSubmitEvent.fire();break;case"form":this.form.submit();this.formSubmitEvent.fire();break;case"none":case"manual":this.manualSubmitEvent.fire();break;}};YAHOO.widget.Dialog.prototype._onFormKeyDown=function(p_oEvent){var oTarget=YAHOO.util.Event.getTarget(p_oEvent),nCharCode=YAHOO.util.Event.getCharCode(p_oEvent);if(nCharCode==13&&oTarget.tagName&&oTarget.tagName.toUpperCase()=="INPUT"){var sType=oTarget.type;if(sType=="text"||sType=="password"||sType=="checkbox"||sType=="radio"||sType=="file"){this.defaultHtmlButton.click();}}};YAHOO.widget.Dialog.prototype.registerForm=function(){var form=this.element.getElementsByTagName("form")[0];if(!form){var formHTML="<form name=\"frm_"+this.id+"\" action=\"\"></form>";this.body.innerHTML+=formHTML;form=this.element.getElementsByTagName("form")[0];}
this.firstFormElement=function(){for(var f=0;f<form.elements.length;f++){var el=form.elements[f];if(el.focus&&!el.disabled){if(el.type&&el.type!="hidden"){return el;}}}
return null;}();this.lastFormElement=function(){for(var f=form.elements.length-1;f>=0;f--){var el=form.elements[f];if(el.focus&&!el.disabled){if(el.type&&el.type!="hidden"){return el;}}}
return null;}();this.form=form;if(this.form&&(this.browser=="ie"||this.browser=="ie7"||this.browser=="gecko")){YAHOO.util.Event.addListener(this.form,"keydown",this._onFormKeyDown,null,this);}
if(this.cfg.getProperty("modal")&&this.form){var me=this;var firstElement=this.firstFormElement||this.firstButton;if(firstElement){this.preventBackTab=new YAHOO.util.KeyListener(firstElement,{shift:true,keys:9},{fn:me.focusLast,scope:me,correctScope:true});this.showEvent.subscribe(this.preventBackTab.enable,this.preventBackTab,true);this.hideEvent.subscribe(this.preventBackTab.disable,this.preventBackTab,true);}
var lastElement=this.lastButton||this.lastFormElement;if(lastElement){this.preventTabOut=new YAHOO.util.KeyListener(lastElement,{shift:false,keys:9},{fn:me.focusFirst,scope:me,correctScope:true});this.showEvent.subscribe(this.preventTabOut.enable,this.preventTabOut,true);this.hideEvent.subscribe(this.preventTabOut.disable,this.preventTabOut,true);}}};YAHOO.widget.Dialog.prototype.configClose=function(type,args,obj){var val=args[0];var doCancel=function(e,obj){obj.cancel();};if(val){if(!this.close){this.close=document.createElement("div");YAHOO.util.Dom.addClass(this.close,"container-close");this.close.innerHTML="&#160;";this.innerElement.appendChild(this.close);YAHOO.util.Event.addListener(this.close,"click",doCancel,this);}else{this.close.style.display="block";}}else{if(this.close){this.close.style.display="none";}}};YAHOO.widget.Dialog.prototype.configButtons=function(type,args,obj){var buttons=args[0];if(buttons!="none"){this.buttonSpan=null;this.buttonSpan=document.createElement("span");this.buttonSpan.className="button-group";for(var b=0;b<buttons.length;b++){var button=buttons[b];var htmlButton=document.createElement("button");htmlButton.setAttribute("type","button");if(button.isDefault){htmlButton.className="default";this.defaultHtmlButton=htmlButton;}
htmlButton.appendChild(document.createTextNode(button.text));YAHOO.util.Event.addListener(htmlButton,"click",button.handler,this,true);this.buttonSpan.appendChild(htmlButton);button.htmlButton=htmlButton;if(b===0){this.firstButton=button.htmlButton;}
if(b==(buttons.length-1)){this.lastButton=button.htmlButton;}}
this.setFooter(this.buttonSpan);this.cfg.refireEvent("iframe");this.cfg.refireEvent("underlay");}else{if(this.buttonSpan){if(this.buttonSpan.parentNode){this.buttonSpan.parentNode.removeChild(this.buttonSpan);}
this.buttonSpan=null;this.firstButton=null;this.lastButton=null;this.defaultHtmlButton=null;}}};YAHOO.widget.Dialog.prototype.focusFirst=function(type,args,obj){if(args){var e=args[1];if(e){YAHOO.util.Event.stopEvent(e);}}
if(this.firstFormElement){this.firstFormElement.focus();}else{this.focusDefaultButton();}};YAHOO.widget.Dialog.prototype.focusLast=function(type,args,obj){if(args){var e=args[1];if(e){YAHOO.util.Event.stopEvent(e);}}
var buttons=this.cfg.getProperty("buttons");if(buttons&&buttons instanceof Array){this.focusLastButton();}else{if(this.lastFormElement){this.lastFormElement.focus();}}};YAHOO.widget.Dialog.prototype.focusDefaultButton=function(){if(this.defaultHtmlButton){this.defaultHtmlButton.focus();}};YAHOO.widget.Dialog.prototype.blurButtons=function(){var buttons=this.cfg.getProperty("buttons");if(buttons&&buttons instanceof Array){var html=buttons[0].htmlButton;if(html){html.blur();}}};YAHOO.widget.Dialog.prototype.focusFirstButton=function(){var buttons=this.cfg.getProperty("buttons");if(buttons&&buttons instanceof Array){var html=buttons[0].htmlButton;if(html){html.focus();}}};YAHOO.widget.Dialog.prototype.focusLastButton=function(){var buttons=this.cfg.getProperty("buttons");if(buttons&&buttons instanceof Array){var html=buttons[buttons.length-1].htmlButton;if(html){html.focus();}}};YAHOO.widget.Dialog.prototype.configPostMethod=function(type,args,obj){var postmethod=args[0];this.registerForm();YAHOO.util.Event.addListener(this.form,"submit",function(e){YAHOO.util.Event.stopEvent(e);this.submit();this.form.blur();},this,true);};YAHOO.widget.Dialog.prototype.validate=function(){return true;};YAHOO.widget.Dialog.prototype.submit=function(){if(this.validate()){this.beforeSubmitEvent.fire();this.doSubmit();this.submitEvent.fire();this.hide();return true;}else{return false;}};YAHOO.widget.Dialog.prototype.cancel=function(){this.cancelEvent.fire();this.hide();};YAHOO.widget.Dialog.prototype.getData=function(){var oForm=this.form;if(oForm){var aElements=oForm.elements,nTotalElements=aElements.length,oData={},sName,oElement,nElements;for(var i=0;i<nTotalElements;i++){sName=aElements[i].name;function isFormElement(p_oElement){var sTagName=p_oElement.tagName.toUpperCase();return((sTagName=="INPUT"||sTagName=="TEXTAREA"||sTagName=="SELECT")&&p_oElement.name==sName);}
oElement=YAHOO.util.Dom.getElementsBy(isFormElement,"*",oForm);nElements=oElement.length;if(nElements>0){if(nElements==1){oElement=oElement[0];var sType=oElement.type,sTagName=oElement.tagName.toUpperCase();switch(sTagName){case"INPUT":if(sType=="checkbox"){oData[sName]=oElement.checked;}
else if(sType!="radio"){oData[sName]=oElement.value;}
break;case"TEXTAREA":oData[sName]=oElement.value;break;case"SELECT":var aOptions=oElement.options,nOptions=aOptions.length,aValues=[],oOption,sValue;for(var n=0;n<nOptions;n++){oOption=aOptions[n];if(oOption.selected){sValue=oOption.value;if(!sValue||sValue===""){sValue=oOption.text;}
aValues[aValues.length]=sValue;}}
oData[sName]=aValues;break;}}
else{var sType=oElement[0].type;switch(sType){case"radio":var oRadio;for(var n=0;n<nElements;n++){oRadio=oElement[n];if(oRadio.checked){oData[sName]=oRadio.value;break;}}
break;case"checkbox":var aValues=[],oCheckbox;for(var n=0;n<nElements;n++){oCheckbox=oElement[n];if(oCheckbox.checked){aValues[aValues.length]=oCheckbox.value;}}
oData[sName]=aValues;break;}}}}}
return oData;};YAHOO.widget.Dialog.prototype.destroy=function(){var Event=YAHOO.util.Event,oForm=this.form,oFooter=this.footer;if(oFooter){var aButtons=oFooter.getElementsByTagName("button");if(aButtons&&aButtons.length>0){var i=aButtons.length-1;do{Event.purgeElement(aButtons[i],false,"click");}
while(i--);}}
if(oForm){Event.purgeElement(oForm);this.body.removeChild(oForm);this.form=null;}
YAHOO.widget.Dialog.superclass.destroy.call(this);};YAHOO.widget.Dialog.prototype.toString=function(){return"Dialog "+this.id;};YAHOO.widget.SimpleDialog=function(el,userConfig){YAHOO.widget.SimpleDialog.superclass.constructor.call(this,el,userConfig);};YAHOO.extend(YAHOO.widget.SimpleDialog,YAHOO.widget.Dialog);YAHOO.widget.SimpleDialog.ICON_BLOCK="blckicon";YAHOO.widget.SimpleDialog.ICON_ALARM="alrticon";YAHOO.widget.SimpleDialog.ICON_HELP="hlpicon";YAHOO.widget.SimpleDialog.ICON_INFO="infoicon";YAHOO.widget.SimpleDialog.ICON_WARN="warnicon";YAHOO.widget.SimpleDialog.ICON_TIP="tipicon";YAHOO.widget.SimpleDialog.CSS_SIMPLEDIALOG="yui-simple-dialog";YAHOO.widget.SimpleDialog._DEFAULT_CONFIG={"ICON":{key:"icon",value:"none",suppressEvent:true},"TEXT":{key:"text",value:"",suppressEvent:true,supercedes:["icon"]}};YAHOO.widget.SimpleDialog.prototype.initDefaultConfig=function(){YAHOO.widget.SimpleDialog.superclass.initDefaultConfig.call(this);var DEFAULT_CONFIG=YAHOO.widget.SimpleDialog._DEFAULT_CONFIG;this.cfg.addProperty(DEFAULT_CONFIG.ICON.key,{handler:this.configIcon,value:DEFAULT_CONFIG.ICON.value,suppressEvent:DEFAULT_CONFIG.ICON.suppressEvent});this.cfg.addProperty(DEFAULT_CONFIG.TEXT.key,{handler:this.configText,value:DEFAULT_CONFIG.TEXT.value,suppressEvent:DEFAULT_CONFIG.TEXT.suppressEvent,supercedes:DEFAULT_CONFIG.TEXT.supercedes});};YAHOO.widget.SimpleDialog.prototype.init=function(el,userConfig){YAHOO.widget.SimpleDialog.superclass.init.call(this,el);this.beforeInitEvent.fire(YAHOO.widget.SimpleDialog);YAHOO.util.Dom.addClass(this.element,YAHOO.widget.SimpleDialog.CSS_SIMPLEDIALOG);this.cfg.queueProperty("postmethod","manual");if(userConfig){this.cfg.applyConfig(userConfig,true);}
this.beforeRenderEvent.subscribe(function(){if(!this.body){this.setBody("");}},this,true);this.initEvent.fire(YAHOO.widget.SimpleDialog);};YAHOO.widget.SimpleDialog.prototype.registerForm=function(){YAHOO.widget.SimpleDialog.superclass.registerForm.call(this);this.form.innerHTML+="<input type=\"hidden\" name=\""+this.id+"\" value=\"\"/>";};YAHOO.widget.SimpleDialog.prototype.configIcon=function(type,args,obj){var icon=args[0];if(icon&&icon!="none"){var iconHTML="";if(icon.indexOf(".")==-1){iconHTML="<span class=\"yui-icon "+icon+"\" >&#160;</span>";}else{iconHTML="<img src=\""+this.imageRoot+icon+"\" class=\"yui-icon\" />";}
this.body.innerHTML=iconHTML+this.body.innerHTML;}};YAHOO.widget.SimpleDialog.prototype.configText=function(type,args,obj){var text=args[0];if(text){this.setBody(text);this.cfg.refireEvent("icon");}};YAHOO.widget.SimpleDialog.prototype.toString=function(){return"SimpleDialog "+this.id;};YAHOO.widget.ContainerEffect=function(overlay,attrIn,attrOut,targetElement,animClass){if(!animClass){animClass=YAHOO.util.Anim;}
this.overlay=overlay;this.attrIn=attrIn;this.attrOut=attrOut;this.targetElement=targetElement||overlay.element;this.animClass=animClass;};YAHOO.widget.ContainerEffect.prototype.init=function(){this.beforeAnimateInEvent=new YAHOO.util.CustomEvent("beforeAnimateIn",this);this.beforeAnimateOutEvent=new YAHOO.util.CustomEvent("beforeAnimateOut",this);this.animateInCompleteEvent=new YAHOO.util.CustomEvent("animateInComplete",this);this.animateOutCompleteEvent=new YAHOO.util.CustomEvent("animateOutComplete",this);this.animIn=new this.animClass(this.targetElement,this.attrIn.attributes,this.attrIn.duration,this.attrIn.method);this.animIn.onStart.subscribe(this.handleStartAnimateIn,this);this.animIn.onTween.subscribe(this.handleTweenAnimateIn,this);this.animIn.onComplete.subscribe(this.handleCompleteAnimateIn,this);this.animOut=new this.animClass(this.targetElement,this.attrOut.attributes,this.attrOut.duration,this.attrOut.method);this.animOut.onStart.subscribe(this.handleStartAnimateOut,this);this.animOut.onTween.subscribe(this.handleTweenAnimateOut,this);this.animOut.onComplete.subscribe(this.handleCompleteAnimateOut,this);};YAHOO.widget.ContainerEffect.prototype.animateIn=function(){this.beforeAnimateInEvent.fire();this.animIn.animate();};YAHOO.widget.ContainerEffect.prototype.animateOut=function(){this.beforeAnimateOutEvent.fire();this.animOut.animate();};YAHOO.widget.ContainerEffect.prototype.handleStartAnimateIn=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleTweenAnimateIn=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleCompleteAnimateIn=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleStartAnimateOut=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleTweenAnimateOut=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleCompleteAnimateOut=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.toString=function(){var output="ContainerEffect";if(this.overlay){output+=" ["+this.overlay.toString()+"]";}
return output;};YAHOO.widget.ContainerEffect.FADE=function(overlay,dur){var fade=new YAHOO.widget.ContainerEffect(overlay,{attributes:{opacity:{from:0,to:1}},duration:dur,method:YAHOO.util.Easing.easeIn},{attributes:{opacity:{to:0}},duration:dur,method:YAHOO.util.Easing.easeOut},overlay.element);fade.handleStartAnimateIn=function(type,args,obj){YAHOO.util.Dom.addClass(obj.overlay.element,"hide-select");if(!obj.overlay.underlay){obj.overlay.cfg.refireEvent("underlay");}
if(obj.overlay.underlay){obj.initialUnderlayOpacity=YAHOO.util.Dom.getStyle(obj.overlay.underlay,"opacity");obj.overlay.underlay.style.filter=null;}
YAHOO.util.Dom.setStyle(obj.overlay.element,"visibility","visible");YAHOO.util.Dom.setStyle(obj.overlay.element,"opacity",0);};fade.handleCompleteAnimateIn=function(type,args,obj){YAHOO.util.Dom.removeClass(obj.overlay.element,"hide-select");if(obj.overlay.element.style.filter){obj.overlay.element.style.filter=null;}
if(obj.overlay.underlay){YAHOO.util.Dom.setStyle(obj.overlay.underlay,"opacity",obj.initialUnderlayOpacity);}
obj.overlay.cfg.refireEvent("iframe");obj.animateInCompleteEvent.fire();};fade.handleStartAnimateOut=function(type,args,obj){YAHOO.util.Dom.addClass(obj.overlay.element,"hide-select");if(obj.overlay.underlay){obj.overlay.underlay.style.filter=null;}};fade.handleCompleteAnimateOut=function(type,args,obj){YAHOO.util.Dom.removeClass(obj.overlay.element,"hide-select");if(obj.overlay.element.style.filter){obj.overlay.element.style.filter=null;}
YAHOO.util.Dom.setStyle(obj.overlay.element,"visibility","hidden");YAHOO.util.Dom.setStyle(obj.overlay.element,"opacity",1);obj.overlay.cfg.refireEvent("iframe");obj.animateOutCompleteEvent.fire();};fade.init();return fade;};YAHOO.widget.ContainerEffect.SLIDE=function(overlay,dur){var x=overlay.cfg.getProperty("x")||YAHOO.util.Dom.getX(overlay.element);var y=overlay.cfg.getProperty("y")||YAHOO.util.Dom.getY(overlay.element);var clientWidth=YAHOO.util.Dom.getClientWidth();var offsetWidth=overlay.element.offsetWidth;var slide=new YAHOO.widget.ContainerEffect(overlay,{attributes:{points:{to:[x,y]}},duration:dur,method:YAHOO.util.Easing.easeIn},{attributes:{points:{to:[(clientWidth+25),y]}},duration:dur,method:YAHOO.util.Easing.easeOut},overlay.element,YAHOO.util.Motion);slide.handleStartAnimateIn=function(type,args,obj){obj.overlay.element.style.left=(-25-offsetWidth)+"px";obj.overlay.element.style.top=y+"px";};slide.handleTweenAnimateIn=function(type,args,obj){var pos=YAHOO.util.Dom.getXY(obj.overlay.element);var currentX=pos[0];var currentY=pos[1];if(YAHOO.util.Dom.getStyle(obj.overlay.element,"visibility")=="hidden"&&currentX<x){YAHOO.util.Dom.setStyle(obj.overlay.element,"visibility","visible");}
obj.overlay.cfg.setProperty("xy",[currentX,currentY],true);obj.overlay.cfg.refireEvent("iframe");};slide.handleCompleteAnimateIn=function(type,args,obj){obj.overlay.cfg.setProperty("xy",[x,y],true);obj.startX=x;obj.startY=y;obj.overlay.cfg.refireEvent("iframe");obj.animateInCompleteEvent.fire();};slide.handleStartAnimateOut=function(type,args,obj){var vw=YAHOO.util.Dom.getViewportWidth();var pos=YAHOO.util.Dom.getXY(obj.overlay.element);var yso=pos[1];var currentTo=obj.animOut.attributes.points.to;obj.animOut.attributes.points.to=[(vw+25),yso];};slide.handleTweenAnimateOut=function(type,args,obj){var pos=YAHOO.util.Dom.getXY(obj.overlay.element);var xto=pos[0];var yto=pos[1];obj.overlay.cfg.setProperty("xy",[xto,yto],true);obj.overlay.cfg.refireEvent("iframe");};slide.handleCompleteAnimateOut=function(type,args,obj){YAHOO.util.Dom.setStyle(obj.overlay.element,"visibility","hidden");obj.overlay.cfg.setProperty("xy",[x,y]);obj.animateOutCompleteEvent.fire();};slide.init();return slide;};YAHOO.register("container",YAHOO.widget.Module,{version:"2.2.2",build:"204"});
// container_core-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

YAHOO.util.Config=function(owner){if(owner){this.init(owner);}};YAHOO.util.Config.CONFIG_CHANGED_EVENT="configChanged";YAHOO.util.Config.BOOLEAN_TYPE="boolean";YAHOO.util.Config.prototype={owner:null,queueInProgress:false,config:null,initialConfig:null,eventQueue:null,configChangedEvent:null,checkBoolean:function(val){return(typeof val==YAHOO.util.Config.BOOLEAN_TYPE);},checkNumber:function(val){return(!isNaN(val));},fireEvent:function(key,value){var property=this.config[key];if(property&&property.event){property.event.fire(value);}},addProperty:function(key,propertyObject){key=key.toLowerCase();this.config[key]=propertyObject;propertyObject.event=new YAHOO.util.CustomEvent(key,this.owner);propertyObject.key=key;if(propertyObject.handler){propertyObject.event.subscribe(propertyObject.handler,this.owner);}
this.setProperty(key,propertyObject.value,true);if(!propertyObject.suppressEvent){this.queueProperty(key,propertyObject.value);}},getConfig:function(){var cfg={};for(var prop in this.config){var property=this.config[prop];if(property&&property.event){cfg[prop]=property.value;}}
return cfg;},getProperty:function(key){var property=this.config[key.toLowerCase()];if(property&&property.event){return property.value;}else{return undefined;}},resetProperty:function(key){key=key.toLowerCase();var property=this.config[key];if(property&&property.event){if(this.initialConfig[key]&&!YAHOO.lang.isUndefined(this.initialConfig[key])){this.setProperty(key,this.initialConfig[key]);}
return true;}else{return false;}},setProperty:function(key,value,silent){key=key.toLowerCase();if(this.queueInProgress&&!silent){this.queueProperty(key,value);return true;}else{var property=this.config[key];if(property&&property.event){if(property.validator&&!property.validator(value)){return false;}else{property.value=value;if(!silent){this.fireEvent(key,value);this.configChangedEvent.fire([key,value]);}
return true;}}else{return false;}}},queueProperty:function(key,value){key=key.toLowerCase();var property=this.config[key];if(property&&property.event){if(!YAHOO.lang.isUndefined(value)&&property.validator&&!property.validator(value)){return false;}else{if(!YAHOO.lang.isUndefined(value)){property.value=value;}else{value=property.value;}
var foundDuplicate=false;var iLen=this.eventQueue.length;for(var i=0;i<iLen;i++){var queueItem=this.eventQueue[i];if(queueItem){var queueItemKey=queueItem[0];var queueItemValue=queueItem[1];if(queueItemKey==key){this.eventQueue[i]=null;this.eventQueue.push([key,(!YAHOO.lang.isUndefined(value)?value:queueItemValue)]);foundDuplicate=true;break;}}}
if(!foundDuplicate&&!YAHOO.lang.isUndefined(value)){this.eventQueue.push([key,value]);}}
if(property.supercedes){var sLen=property.supercedes.length;for(var s=0;s<sLen;s++){var supercedesCheck=property.supercedes[s];var qLen=this.eventQueue.length;for(var q=0;q<qLen;q++){var queueItemCheck=this.eventQueue[q];if(queueItemCheck){var queueItemCheckKey=queueItemCheck[0];var queueItemCheckValue=queueItemCheck[1];if(queueItemCheckKey==supercedesCheck.toLowerCase()){this.eventQueue.push([queueItemCheckKey,queueItemCheckValue]);this.eventQueue[q]=null;break;}}}}}
return true;}else{return false;}},refireEvent:function(key){key=key.toLowerCase();var property=this.config[key];if(property&&property.event&&!YAHOO.lang.isUndefined(property.value)){if(this.queueInProgress){this.queueProperty(key);}else{this.fireEvent(key,property.value);}}},applyConfig:function(userConfig,init){if(init){this.initialConfig=userConfig;}
for(var prop in userConfig){this.queueProperty(prop,userConfig[prop]);}},refresh:function(){for(var prop in this.config){this.refireEvent(prop);}},fireQueue:function(){this.queueInProgress=true;for(var i=0;i<this.eventQueue.length;i++){var queueItem=this.eventQueue[i];if(queueItem){var key=queueItem[0];var value=queueItem[1];var property=this.config[key];property.value=value;this.fireEvent(key,value);}}
this.queueInProgress=false;this.eventQueue=[];},subscribeToConfigEvent:function(key,handler,obj,override){var property=this.config[key.toLowerCase()];if(property&&property.event){if(!YAHOO.util.Config.alreadySubscribed(property.event,handler,obj)){property.event.subscribe(handler,obj,override);}
return true;}else{return false;}},unsubscribeFromConfigEvent:function(key,handler,obj){var property=this.config[key.toLowerCase()];if(property&&property.event){return property.event.unsubscribe(handler,obj);}else{return false;}},toString:function(){var output="Config";if(this.owner){output+=" ["+this.owner.toString()+"]";}
return output;},outputEventQueue:function(){var output="";for(var q=0;q<this.eventQueue.length;q++){var queueItem=this.eventQueue[q];if(queueItem){output+=queueItem[0]+"="+queueItem[1]+", ";}}
return output;}};YAHOO.util.Config.prototype.init=function(owner){this.owner=owner;this.configChangedEvent=new YAHOO.util.CustomEvent(YAHOO.util.CONFIG_CHANGED_EVENT,this);this.queueInProgress=false;this.config={};this.initialConfig={};this.eventQueue=[];};YAHOO.util.Config.alreadySubscribed=function(evt,fn,obj){for(var e=0;e<evt.subscribers.length;e++){var subsc=evt.subscribers[e];if(subsc&&subsc.obj==obj&&subsc.fn==fn){return true;}}
return false;};YAHOO.widget.Module=function(el,userConfig){if(el){this.init(el,userConfig);}else{}};YAHOO.widget.Module.IMG_ROOT=null;YAHOO.widget.Module.IMG_ROOT_SSL=null;YAHOO.widget.Module.CSS_MODULE="yui-module";YAHOO.widget.Module.CSS_HEADER="hd";YAHOO.widget.Module.CSS_BODY="bd";YAHOO.widget.Module.CSS_FOOTER="ft";YAHOO.widget.Module.RESIZE_MONITOR_SECURE_URL="javascript:false;";YAHOO.widget.Module.textResizeEvent=new YAHOO.util.CustomEvent("textResize");YAHOO.widget.Module._EVENT_TYPES={"BEFORE_INIT":"beforeInit","INIT":"init","APPEND":"append","BEFORE_RENDER":"beforeRender","RENDER":"render","CHANGE_HEADER":"changeHeader","CHANGE_BODY":"changeBody","CHANGE_FOOTER":"changeFooter","CHANGE_CONTENT":"changeContent","DESTORY":"destroy","BEFORE_SHOW":"beforeShow","SHOW":"show","BEFORE_HIDE":"beforeHide","HIDE":"hide"};YAHOO.widget.Module._DEFAULT_CONFIG={"VISIBLE":{key:"visible",value:true,validator:YAHOO.lang.isBoolean},"EFFECT":{key:"effect",suppressEvent:true,supercedes:["visible"]},"MONITOR_RESIZE":{key:"monitorresize",value:true}};YAHOO.widget.Module.prototype={constructor:YAHOO.widget.Module,element:null,header:null,body:null,footer:null,id:null,imageRoot:YAHOO.widget.Module.IMG_ROOT,initEvents:function(){var EVENT_TYPES=YAHOO.widget.Module._EVENT_TYPES;this.beforeInitEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_INIT,this);this.initEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.INIT,this);this.appendEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.APPEND,this);this.beforeRenderEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_RENDER,this);this.renderEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.RENDER,this);this.changeHeaderEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CHANGE_HEADER,this);this.changeBodyEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CHANGE_BODY,this);this.changeFooterEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CHANGE_FOOTER,this);this.changeContentEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.CHANGE_CONTENT,this);this.destroyEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.DESTORY,this);this.beforeShowEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_SHOW,this);this.showEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.SHOW,this);this.beforeHideEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_HIDE,this);this.hideEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.HIDE,this);},platform:function(){var ua=navigator.userAgent.toLowerCase();if(ua.indexOf("windows")!=-1||ua.indexOf("win32")!=-1){return"windows";}else if(ua.indexOf("macintosh")!=-1){return"mac";}else{return false;}}(),browser:function(){var ua=navigator.userAgent.toLowerCase();if(ua.indexOf('opera')!=-1){return'opera';}else if(ua.indexOf('msie 7')!=-1){return'ie7';}else if(ua.indexOf('msie')!=-1){return'ie';}else if(ua.indexOf('safari')!=-1){return'safari';}else if(ua.indexOf('gecko')!=-1){return'gecko';}else{return false;}}(),isSecure:function(){if(window.location.href.toLowerCase().indexOf("https")===0){return true;}else{return false;}}(),initDefaultConfig:function(){var DEFAULT_CONFIG=YAHOO.widget.Module._DEFAULT_CONFIG;this.cfg.addProperty(DEFAULT_CONFIG.VISIBLE.key,{handler:this.configVisible,value:DEFAULT_CONFIG.VISIBLE.value,validator:DEFAULT_CONFIG.VISIBLE.validator});this.cfg.addProperty(DEFAULT_CONFIG.EFFECT.key,{suppressEvent:DEFAULT_CONFIG.EFFECT.suppressEvent,supercedes:DEFAULT_CONFIG.EFFECT.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.MONITOR_RESIZE.key,{handler:this.configMonitorResize,value:DEFAULT_CONFIG.MONITOR_RESIZE.value});},init:function(el,userConfig){this.initEvents();this.beforeInitEvent.fire(YAHOO.widget.Module);this.cfg=new YAHOO.util.Config(this);if(this.isSecure){this.imageRoot=YAHOO.widget.Module.IMG_ROOT_SSL;}
if(typeof el=="string"){var elId=el;el=document.getElementById(el);if(!el){el=document.createElement("div");el.id=elId;}}
this.element=el;if(el.id){this.id=el.id;}
var childNodes=this.element.childNodes;if(childNodes){for(var i=0;i<childNodes.length;i++){var child=childNodes[i];switch(child.className){case YAHOO.widget.Module.CSS_HEADER:this.header=child;break;case YAHOO.widget.Module.CSS_BODY:this.body=child;break;case YAHOO.widget.Module.CSS_FOOTER:this.footer=child;break;}}}
this.initDefaultConfig();YAHOO.util.Dom.addClass(this.element,YAHOO.widget.Module.CSS_MODULE);if(userConfig){this.cfg.applyConfig(userConfig,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.renderEvent,this.cfg.fireQueue,this.cfg)){this.renderEvent.subscribe(this.cfg.fireQueue,this.cfg,true);}
this.initEvent.fire(YAHOO.widget.Module);},initResizeMonitor:function(){if(this.browser!="opera"){var resizeMonitor=document.getElementById("_yuiResizeMonitor");if(!resizeMonitor){resizeMonitor=document.createElement("iframe");var bIE=(this.browser.indexOf("ie")===0);if(this.isSecure&&YAHOO.widget.Module.RESIZE_MONITOR_SECURE_URL&&bIE){resizeMonitor.src=YAHOO.widget.Module.RESIZE_MONITOR_SECURE_URL;}
resizeMonitor.id="_yuiResizeMonitor";resizeMonitor.style.visibility="hidden";document.body.appendChild(resizeMonitor);resizeMonitor.style.width="10em";resizeMonitor.style.height="10em";resizeMonitor.style.position="absolute";var nLeft=-1*resizeMonitor.offsetWidth;var nTop=-1*resizeMonitor.offsetHeight;resizeMonitor.style.top=nTop+"px";resizeMonitor.style.left=nLeft+"px";resizeMonitor.style.borderStyle="none";resizeMonitor.style.borderWidth="0";YAHOO.util.Dom.setStyle(resizeMonitor,"opacity","0");resizeMonitor.style.visibility="visible";if(!bIE){var doc=resizeMonitor.contentWindow.document;doc.open();doc.close();}}
var fireTextResize=function(){YAHOO.widget.Module.textResizeEvent.fire();};if(resizeMonitor&&resizeMonitor.contentWindow){this.resizeMonitor=resizeMonitor;YAHOO.widget.Module.textResizeEvent.subscribe(this.onDomResize,this,true);if(!YAHOO.widget.Module.textResizeInitialized){if(!YAHOO.util.Event.addListener(this.resizeMonitor.contentWindow,"resize",fireTextResize)){YAHOO.util.Event.addListener(this.resizeMonitor,"resize",fireTextResize);}
YAHOO.widget.Module.textResizeInitialized=true;}}}},onDomResize:function(e,obj){var nLeft=-1*this.resizeMonitor.offsetWidth,nTop=-1*this.resizeMonitor.offsetHeight;this.resizeMonitor.style.top=nTop+"px";this.resizeMonitor.style.left=nLeft+"px";},setHeader:function(headerContent){if(!this.header){this.header=document.createElement("div");this.header.className=YAHOO.widget.Module.CSS_HEADER;}
if(typeof headerContent=="string"){this.header.innerHTML=headerContent;}else{this.header.innerHTML="";this.header.appendChild(headerContent);}
this.changeHeaderEvent.fire(headerContent);this.changeContentEvent.fire();},appendToHeader:function(element){if(!this.header){this.header=document.createElement("div");this.header.className=YAHOO.widget.Module.CSS_HEADER;}
this.header.appendChild(element);this.changeHeaderEvent.fire(element);this.changeContentEvent.fire();},setBody:function(bodyContent){if(!this.body){this.body=document.createElement("div");this.body.className=YAHOO.widget.Module.CSS_BODY;}
if(typeof bodyContent=="string")
{this.body.innerHTML=bodyContent;}else{this.body.innerHTML="";this.body.appendChild(bodyContent);}
this.changeBodyEvent.fire(bodyContent);this.changeContentEvent.fire();},appendToBody:function(element){if(!this.body){this.body=document.createElement("div");this.body.className=YAHOO.widget.Module.CSS_BODY;}
this.body.appendChild(element);this.changeBodyEvent.fire(element);this.changeContentEvent.fire();},setFooter:function(footerContent){if(!this.footer){this.footer=document.createElement("div");this.footer.className=YAHOO.widget.Module.CSS_FOOTER;}
if(typeof footerContent=="string"){this.footer.innerHTML=footerContent;}else{this.footer.innerHTML="";this.footer.appendChild(footerContent);}
this.changeFooterEvent.fire(footerContent);this.changeContentEvent.fire();},appendToFooter:function(element){if(!this.footer){this.footer=document.createElement("div");this.footer.className=YAHOO.widget.Module.CSS_FOOTER;}
this.footer.appendChild(element);this.changeFooterEvent.fire(element);this.changeContentEvent.fire();},render:function(appendToNode,moduleElement){this.beforeRenderEvent.fire();if(!moduleElement){moduleElement=this.element;}
var me=this;var appendTo=function(element){if(typeof element=="string"){element=document.getElementById(element);}
if(element){element.appendChild(me.element);me.appendEvent.fire();}};if(appendToNode){appendTo(appendToNode);}else{if(!YAHOO.util.Dom.inDocument(this.element)){return false;}}
if(this.header&&!YAHOO.util.Dom.inDocument(this.header)){var firstChild=moduleElement.firstChild;if(firstChild){moduleElement.insertBefore(this.header,firstChild);}else{moduleElement.appendChild(this.header);}}
if(this.body&&!YAHOO.util.Dom.inDocument(this.body)){if(this.footer&&YAHOO.util.Dom.isAncestor(this.moduleElement,this.footer)){moduleElement.insertBefore(this.body,this.footer);}else{moduleElement.appendChild(this.body);}}
if(this.footer&&!YAHOO.util.Dom.inDocument(this.footer)){moduleElement.appendChild(this.footer);}
this.renderEvent.fire();return true;},destroy:function(){var parent;if(this.element){YAHOO.util.Event.purgeElement(this.element,true);parent=this.element.parentNode;}
if(parent){parent.removeChild(this.element);}
this.element=null;this.header=null;this.body=null;this.footer=null;for(var e in this){if(e instanceof YAHOO.util.CustomEvent){e.unsubscribeAll();}}
YAHOO.widget.Module.textResizeEvent.unsubscribe(this.onDomResize,this);this.destroyEvent.fire();},show:function(){this.cfg.setProperty("visible",true);},hide:function(){this.cfg.setProperty("visible",false);},configVisible:function(type,args,obj){var visible=args[0];if(visible){this.beforeShowEvent.fire();YAHOO.util.Dom.setStyle(this.element,"display","block");this.showEvent.fire();}else{this.beforeHideEvent.fire();YAHOO.util.Dom.setStyle(this.element,"display","none");this.hideEvent.fire();}},configMonitorResize:function(type,args,obj){var monitor=args[0];if(monitor){this.initResizeMonitor();}else{YAHOO.widget.Module.textResizeEvent.unsubscribe(this.onDomResize,this,true);this.resizeMonitor=null;}}};YAHOO.widget.Module.prototype.toString=function(){return"Module "+this.id;};YAHOO.widget.Overlay=function(el,userConfig){YAHOO.widget.Overlay.superclass.constructor.call(this,el,userConfig);};YAHOO.extend(YAHOO.widget.Overlay,YAHOO.widget.Module);YAHOO.widget.Overlay._EVENT_TYPES={"BEFORE_MOVE":"beforeMove","MOVE":"move"};YAHOO.widget.Overlay._DEFAULT_CONFIG={"X":{key:"x",validator:YAHOO.lang.isNumber,suppressEvent:true,supercedes:["iframe"]},"Y":{key:"y",validator:YAHOO.lang.isNumber,suppressEvent:true,supercedes:["iframe"]},"XY":{key:"xy",suppressEvent:true,supercedes:["iframe"]},"CONTEXT":{key:"context",suppressEvent:true,supercedes:["iframe"]},"FIXED_CENTER":{key:"fixedcenter",value:false,validator:YAHOO.lang.isBoolean,supercedes:["iframe","visible"]},"WIDTH":{key:"width",suppressEvent:true,supercedes:["iframe"]},"HEIGHT":{key:"height",suppressEvent:true,supercedes:["iframe"]},"ZINDEX":{key:"zindex",value:null},"CONSTRAIN_TO_VIEWPORT":{key:"constraintoviewport",value:false,validator:YAHOO.lang.isBoolean,supercedes:["iframe","x","y","xy"]},"IFRAME":{key:"iframe",value:(YAHOO.widget.Module.prototype.browser=="ie"?true:false),validator:YAHOO.lang.isBoolean,supercedes:["zIndex"]}};YAHOO.widget.Overlay.IFRAME_SRC="javascript:false;";YAHOO.widget.Overlay.TOP_LEFT="tl";YAHOO.widget.Overlay.TOP_RIGHT="tr";YAHOO.widget.Overlay.BOTTOM_LEFT="bl";YAHOO.widget.Overlay.BOTTOM_RIGHT="br";YAHOO.widget.Overlay.CSS_OVERLAY="yui-overlay";YAHOO.widget.Overlay.prototype.init=function(el,userConfig){YAHOO.widget.Overlay.superclass.init.call(this,el);this.beforeInitEvent.fire(YAHOO.widget.Overlay);YAHOO.util.Dom.addClass(this.element,YAHOO.widget.Overlay.CSS_OVERLAY);if(userConfig){this.cfg.applyConfig(userConfig,true);}
if(this.platform=="mac"&&this.browser=="gecko"){if(!YAHOO.util.Config.alreadySubscribed(this.showEvent,this.showMacGeckoScrollbars,this)){this.showEvent.subscribe(this.showMacGeckoScrollbars,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.hideEvent,this.hideMacGeckoScrollbars,this)){this.hideEvent.subscribe(this.hideMacGeckoScrollbars,this,true);}}
this.initEvent.fire(YAHOO.widget.Overlay);};YAHOO.widget.Overlay.prototype.initEvents=function(){YAHOO.widget.Overlay.superclass.initEvents.call(this);var EVENT_TYPES=YAHOO.widget.Overlay._EVENT_TYPES;this.beforeMoveEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.BEFORE_MOVE,this);this.moveEvent=new YAHOO.util.CustomEvent(EVENT_TYPES.MOVE,this);};YAHOO.widget.Overlay.prototype.initDefaultConfig=function(){YAHOO.widget.Overlay.superclass.initDefaultConfig.call(this);var DEFAULT_CONFIG=YAHOO.widget.Overlay._DEFAULT_CONFIG;this.cfg.addProperty(DEFAULT_CONFIG.X.key,{handler:this.configX,validator:DEFAULT_CONFIG.X.validator,suppressEvent:DEFAULT_CONFIG.X.suppressEvent,supercedes:DEFAULT_CONFIG.X.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.Y.key,{handler:this.configY,validator:DEFAULT_CONFIG.Y.validator,suppressEvent:DEFAULT_CONFIG.Y.suppressEvent,supercedes:DEFAULT_CONFIG.Y.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.XY.key,{handler:this.configXY,suppressEvent:DEFAULT_CONFIG.XY.suppressEvent,supercedes:DEFAULT_CONFIG.XY.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.CONTEXT.key,{handler:this.configContext,suppressEvent:DEFAULT_CONFIG.CONTEXT.suppressEvent,supercedes:DEFAULT_CONFIG.CONTEXT.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.FIXED_CENTER.key,{handler:this.configFixedCenter,value:DEFAULT_CONFIG.FIXED_CENTER.value,validator:DEFAULT_CONFIG.FIXED_CENTER.validator,supercedes:DEFAULT_CONFIG.FIXED_CENTER.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.WIDTH.key,{handler:this.configWidth,suppressEvent:DEFAULT_CONFIG.WIDTH.suppressEvent,supercedes:DEFAULT_CONFIG.WIDTH.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.HEIGHT.key,{handler:this.configHeight,suppressEvent:DEFAULT_CONFIG.HEIGHT.suppressEvent,supercedes:DEFAULT_CONFIG.HEIGHT.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.ZINDEX.key,{handler:this.configzIndex,value:DEFAULT_CONFIG.ZINDEX.value});this.cfg.addProperty(DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.key,{handler:this.configConstrainToViewport,value:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.value,validator:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.validator,supercedes:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.supercedes});this.cfg.addProperty(DEFAULT_CONFIG.IFRAME.key,{handler:this.configIframe,value:DEFAULT_CONFIG.IFRAME.value,validator:DEFAULT_CONFIG.IFRAME.validator,supercedes:DEFAULT_CONFIG.IFRAME.supercedes});};YAHOO.widget.Overlay.prototype.moveTo=function(x,y){this.cfg.setProperty("xy",[x,y]);};YAHOO.widget.Overlay.prototype.hideMacGeckoScrollbars=function(){YAHOO.util.Dom.removeClass(this.element,"show-scrollbars");YAHOO.util.Dom.addClass(this.element,"hide-scrollbars");};YAHOO.widget.Overlay.prototype.showMacGeckoScrollbars=function(){YAHOO.util.Dom.removeClass(this.element,"hide-scrollbars");YAHOO.util.Dom.addClass(this.element,"show-scrollbars");};YAHOO.widget.Overlay.prototype.configVisible=function(type,args,obj){var visible=args[0];var currentVis=YAHOO.util.Dom.getStyle(this.element,"visibility");if(currentVis=="inherit"){var e=this.element.parentNode;while(e.nodeType!=9&&e.nodeType!=11){currentVis=YAHOO.util.Dom.getStyle(e,"visibility");if(currentVis!="inherit"){break;}
e=e.parentNode;}
if(currentVis=="inherit"){currentVis="visible";}}
var effect=this.cfg.getProperty("effect");var effectInstances=[];if(effect){if(effect instanceof Array){for(var i=0;i<effect.length;i++){var eff=effect[i];effectInstances[effectInstances.length]=eff.effect(this,eff.duration);}}else{effectInstances[effectInstances.length]=effect.effect(this,effect.duration);}}
var isMacGecko=(this.platform=="mac"&&this.browser=="gecko");if(visible){if(isMacGecko){this.showMacGeckoScrollbars();}
if(effect){if(visible){if(currentVis!="visible"||currentVis===""){this.beforeShowEvent.fire();for(var j=0;j<effectInstances.length;j++){var ei=effectInstances[j];if(j===0&&!YAHOO.util.Config.alreadySubscribed(ei.animateInCompleteEvent,this.showEvent.fire,this.showEvent)){ei.animateInCompleteEvent.subscribe(this.showEvent.fire,this.showEvent,true);}
ei.animateIn();}}}}else{if(currentVis!="visible"||currentVis===""){this.beforeShowEvent.fire();YAHOO.util.Dom.setStyle(this.element,"visibility","visible");this.cfg.refireEvent("iframe");this.showEvent.fire();}}}else{if(isMacGecko){this.hideMacGeckoScrollbars();}
if(effect){if(currentVis=="visible"){this.beforeHideEvent.fire();for(var k=0;k<effectInstances.length;k++){var h=effectInstances[k];if(k===0&&!YAHOO.util.Config.alreadySubscribed(h.animateOutCompleteEvent,this.hideEvent.fire,this.hideEvent)){h.animateOutCompleteEvent.subscribe(this.hideEvent.fire,this.hideEvent,true);}
h.animateOut();}}else if(currentVis===""){YAHOO.util.Dom.setStyle(this.element,"visibility","hidden");}}else{if(currentVis=="visible"||currentVis===""){this.beforeHideEvent.fire();YAHOO.util.Dom.setStyle(this.element,"visibility","hidden");this.cfg.refireEvent("iframe");this.hideEvent.fire();}}}};YAHOO.widget.Overlay.prototype.doCenterOnDOMEvent=function(){if(this.cfg.getProperty("visible")){this.center();}};YAHOO.widget.Overlay.prototype.configFixedCenter=function(type,args,obj){var val=args[0];if(val){this.center();if(!YAHOO.util.Config.alreadySubscribed(this.beforeShowEvent,this.center,this)){this.beforeShowEvent.subscribe(this.center,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(YAHOO.widget.Overlay.windowResizeEvent,this.doCenterOnDOMEvent,this)){YAHOO.widget.Overlay.windowResizeEvent.subscribe(this.doCenterOnDOMEvent,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(YAHOO.widget.Overlay.windowScrollEvent,this.doCenterOnDOMEvent,this)){YAHOO.widget.Overlay.windowScrollEvent.subscribe(this.doCenterOnDOMEvent,this,true);}}else{YAHOO.widget.Overlay.windowResizeEvent.unsubscribe(this.doCenterOnDOMEvent,this);YAHOO.widget.Overlay.windowScrollEvent.unsubscribe(this.doCenterOnDOMEvent,this);}};YAHOO.widget.Overlay.prototype.configHeight=function(type,args,obj){var height=args[0];var el=this.element;YAHOO.util.Dom.setStyle(el,"height",height);this.cfg.refireEvent("iframe");};YAHOO.widget.Overlay.prototype.configWidth=function(type,args,obj){var width=args[0];var el=this.element;YAHOO.util.Dom.setStyle(el,"width",width);this.cfg.refireEvent("iframe");};YAHOO.widget.Overlay.prototype.configzIndex=function(type,args,obj){var zIndex=args[0];var el=this.element;if(!zIndex){zIndex=YAHOO.util.Dom.getStyle(el,"zIndex");if(!zIndex||isNaN(zIndex)){zIndex=0;}}
if(this.iframe){if(zIndex<=0){zIndex=1;}
YAHOO.util.Dom.setStyle(this.iframe,"zIndex",(zIndex-1));}
YAHOO.util.Dom.setStyle(el,"zIndex",zIndex);this.cfg.setProperty("zIndex",zIndex,true);};YAHOO.widget.Overlay.prototype.configXY=function(type,args,obj){var pos=args[0];var x=pos[0];var y=pos[1];this.cfg.setProperty("x",x);this.cfg.setProperty("y",y);this.beforeMoveEvent.fire([x,y]);x=this.cfg.getProperty("x");y=this.cfg.getProperty("y");this.cfg.refireEvent("iframe");this.moveEvent.fire([x,y]);};YAHOO.widget.Overlay.prototype.configX=function(type,args,obj){var x=args[0];var y=this.cfg.getProperty("y");this.cfg.setProperty("x",x,true);this.cfg.setProperty("y",y,true);this.beforeMoveEvent.fire([x,y]);x=this.cfg.getProperty("x");y=this.cfg.getProperty("y");YAHOO.util.Dom.setX(this.element,x,true);this.cfg.setProperty("xy",[x,y],true);this.cfg.refireEvent("iframe");this.moveEvent.fire([x,y]);};YAHOO.widget.Overlay.prototype.configY=function(type,args,obj){var x=this.cfg.getProperty("x");var y=args[0];this.cfg.setProperty("x",x,true);this.cfg.setProperty("y",y,true);this.beforeMoveEvent.fire([x,y]);x=this.cfg.getProperty("x");y=this.cfg.getProperty("y");YAHOO.util.Dom.setY(this.element,y,true);this.cfg.setProperty("xy",[x,y],true);this.cfg.refireEvent("iframe");this.moveEvent.fire([x,y]);};YAHOO.widget.Overlay.prototype.showIframe=function(){if(this.iframe){this.iframe.style.display="block";}};YAHOO.widget.Overlay.prototype.hideIframe=function(){if(this.iframe){this.iframe.style.display="none";}};YAHOO.widget.Overlay.prototype.configIframe=function(type,args,obj){var val=args[0];if(val){if(!YAHOO.util.Config.alreadySubscribed(this.showEvent,this.showIframe,this)){this.showEvent.subscribe(this.showIframe,this,true);}
if(!YAHOO.util.Config.alreadySubscribed(this.hideEvent,this.hideIframe,this)){this.hideEvent.subscribe(this.hideIframe,this,true);}
var x=this.cfg.getProperty("x");var y=this.cfg.getProperty("y");if(!x||!y){this.syncPosition();x=this.cfg.getProperty("x");y=this.cfg.getProperty("y");}
if(!isNaN(x)&&!isNaN(y)){if(!this.iframe){this.iframe=document.createElement("iframe");if(this.isSecure){this.iframe.src=YAHOO.widget.Overlay.IFRAME_SRC;}
var parent=this.element.parentNode;if(parent){parent.appendChild(this.iframe);}else{document.body.appendChild(this.iframe);}
YAHOO.util.Dom.setStyle(this.iframe,"position","absolute");YAHOO.util.Dom.setStyle(this.iframe,"border","none");YAHOO.util.Dom.setStyle(this.iframe,"margin","0");YAHOO.util.Dom.setStyle(this.iframe,"padding","0");YAHOO.util.Dom.setStyle(this.iframe,"opacity","0");if(this.cfg.getProperty("visible")){this.showIframe();}else{this.hideIframe();}}
var iframeDisplay=YAHOO.util.Dom.getStyle(this.iframe,"display");if(iframeDisplay=="none"){this.iframe.style.display="block";}
YAHOO.util.Dom.setXY(this.iframe,[x,y]);var width=this.element.clientWidth;var height=this.element.clientHeight;YAHOO.util.Dom.setStyle(this.iframe,"width",(width+2)+"px");YAHOO.util.Dom.setStyle(this.iframe,"height",(height+2)+"px");if(iframeDisplay=="none"){this.iframe.style.display="none";}}}else{if(this.iframe){this.iframe.style.display="none";}
this.showEvent.unsubscribe(this.showIframe,this);this.hideEvent.unsubscribe(this.hideIframe,this);}};YAHOO.widget.Overlay.prototype.configConstrainToViewport=function(type,args,obj){var val=args[0];if(val){if(!YAHOO.util.Config.alreadySubscribed(this.beforeMoveEvent,this.enforceConstraints,this)){this.beforeMoveEvent.subscribe(this.enforceConstraints,this,true);}}else{this.beforeMoveEvent.unsubscribe(this.enforceConstraints,this);}};YAHOO.widget.Overlay.prototype.configContext=function(type,args,obj){var contextArgs=args[0];if(contextArgs){var contextEl=contextArgs[0];var elementMagnetCorner=contextArgs[1];var contextMagnetCorner=contextArgs[2];if(contextEl){if(typeof contextEl=="string"){this.cfg.setProperty("context",[document.getElementById(contextEl),elementMagnetCorner,contextMagnetCorner],true);}
if(elementMagnetCorner&&contextMagnetCorner){this.align(elementMagnetCorner,contextMagnetCorner);}}}};YAHOO.widget.Overlay.prototype.align=function(elementAlign,contextAlign){var contextArgs=this.cfg.getProperty("context");if(contextArgs){var context=contextArgs[0];var element=this.element;var me=this;if(!elementAlign){elementAlign=contextArgs[1];}
if(!contextAlign){contextAlign=contextArgs[2];}
if(element&&context){var contextRegion=YAHOO.util.Dom.getRegion(context);var doAlign=function(v,h){switch(elementAlign){case YAHOO.widget.Overlay.TOP_LEFT:me.moveTo(h,v);break;case YAHOO.widget.Overlay.TOP_RIGHT:me.moveTo(h-element.offsetWidth,v);break;case YAHOO.widget.Overlay.BOTTOM_LEFT:me.moveTo(h,v-element.offsetHeight);break;case YAHOO.widget.Overlay.BOTTOM_RIGHT:me.moveTo(h-element.offsetWidth,v-element.offsetHeight);break;}};switch(contextAlign){case YAHOO.widget.Overlay.TOP_LEFT:doAlign(contextRegion.top,contextRegion.left);break;case YAHOO.widget.Overlay.TOP_RIGHT:doAlign(contextRegion.top,contextRegion.right);break;case YAHOO.widget.Overlay.BOTTOM_LEFT:doAlign(contextRegion.bottom,contextRegion.left);break;case YAHOO.widget.Overlay.BOTTOM_RIGHT:doAlign(contextRegion.bottom,contextRegion.right);break;}}}};YAHOO.widget.Overlay.prototype.enforceConstraints=function(type,args,obj){var pos=args[0];var x=pos[0];var y=pos[1];var offsetHeight=this.element.offsetHeight;var offsetWidth=this.element.offsetWidth;var viewPortWidth=YAHOO.util.Dom.getViewportWidth();var viewPortHeight=YAHOO.util.Dom.getViewportHeight();var scrollX=document.documentElement.scrollLeft||document.body.scrollLeft;var scrollY=document.documentElement.scrollTop||document.body.scrollTop;var topConstraint=scrollY+10;var leftConstraint=scrollX+10;var bottomConstraint=scrollY+viewPortHeight-offsetHeight-10;var rightConstraint=scrollX+viewPortWidth-offsetWidth-10;if(x<leftConstraint){x=leftConstraint;}else if(x>rightConstraint){x=rightConstraint;}
if(y<topConstraint){y=topConstraint;}else if(y>bottomConstraint){y=bottomConstraint;}
this.cfg.setProperty("x",x,true);this.cfg.setProperty("y",y,true);this.cfg.setProperty("xy",[x,y],true);};YAHOO.widget.Overlay.prototype.center=function(){var scrollX=document.documentElement.scrollLeft||document.body.scrollLeft;var scrollY=document.documentElement.scrollTop||document.body.scrollTop;var viewPortWidth=YAHOO.util.Dom.getClientWidth();var viewPortHeight=YAHOO.util.Dom.getClientHeight();var elementWidth=this.element.offsetWidth;var elementHeight=this.element.offsetHeight;var x=(viewPortWidth/2)-(elementWidth/2)+scrollX;var y=(viewPortHeight/2)-(elementHeight/2)+scrollY;this.cfg.setProperty("xy",[parseInt(x,10),parseInt(y,10)]);this.cfg.refireEvent("iframe");};YAHOO.widget.Overlay.prototype.syncPosition=function(){var pos=YAHOO.util.Dom.getXY(this.element);this.cfg.setProperty("x",pos[0],true);this.cfg.setProperty("y",pos[1],true);this.cfg.setProperty("xy",pos,true);};YAHOO.widget.Overlay.prototype.onDomResize=function(e,obj){YAHOO.widget.Overlay.superclass.onDomResize.call(this,e,obj);var me=this;setTimeout(function(){me.syncPosition();me.cfg.refireEvent("iframe");me.cfg.refireEvent("context");},0);};YAHOO.widget.Overlay.prototype.destroy=function(){if(this.iframe){this.iframe.parentNode.removeChild(this.iframe);}
this.iframe=null;YAHOO.widget.Overlay.windowResizeEvent.unsubscribe(this.doCenterOnDOMEvent,this);YAHOO.widget.Overlay.windowScrollEvent.unsubscribe(this.doCenterOnDOMEvent,this);YAHOO.widget.Overlay.superclass.destroy.call(this);};YAHOO.widget.Overlay.prototype.toString=function(){return"Overlay "+this.id;};YAHOO.widget.Overlay.windowScrollEvent=new YAHOO.util.CustomEvent("windowScroll");YAHOO.widget.Overlay.windowResizeEvent=new YAHOO.util.CustomEvent("windowResize");YAHOO.widget.Overlay.windowScrollHandler=function(e){if(YAHOO.widget.Module.prototype.browser=="ie"||YAHOO.widget.Module.prototype.browser=="ie7"){if(!window.scrollEnd){window.scrollEnd=-1;}
clearTimeout(window.scrollEnd);window.scrollEnd=setTimeout(function(){YAHOO.widget.Overlay.windowScrollEvent.fire();},1);}else{YAHOO.widget.Overlay.windowScrollEvent.fire();}};YAHOO.widget.Overlay.windowResizeHandler=function(e){if(YAHOO.widget.Module.prototype.browser=="ie"||YAHOO.widget.Module.prototype.browser=="ie7"){if(!window.resizeEnd){window.resizeEnd=-1;}
clearTimeout(window.resizeEnd);window.resizeEnd=setTimeout(function(){YAHOO.widget.Overlay.windowResizeEvent.fire();},100);}else{YAHOO.widget.Overlay.windowResizeEvent.fire();}};YAHOO.widget.Overlay._initialized=null;if(YAHOO.widget.Overlay._initialized===null){YAHOO.util.Event.addListener(window,"scroll",YAHOO.widget.Overlay.windowScrollHandler);YAHOO.util.Event.addListener(window,"resize",YAHOO.widget.Overlay.windowResizeHandler);YAHOO.widget.Overlay._initialized=true;}
YAHOO.widget.OverlayManager=function(userConfig){this.init(userConfig);};YAHOO.widget.OverlayManager.CSS_FOCUSED="focused";YAHOO.widget.OverlayManager.prototype={constructor:YAHOO.widget.OverlayManager,overlays:null,initDefaultConfig:function(){this.cfg.addProperty("overlays",{suppressEvent:true});this.cfg.addProperty("focusevent",{value:"mousedown"});},init:function(userConfig){this.cfg=new YAHOO.util.Config(this);this.initDefaultConfig();if(userConfig){this.cfg.applyConfig(userConfig,true);}
this.cfg.fireQueue();var activeOverlay=null;this.getActive=function(){return activeOverlay;};this.focus=function(overlay){var o=this.find(overlay);if(o){if(activeOverlay!=o){if(activeOverlay){activeOverlay.blur();}
activeOverlay=o;YAHOO.util.Dom.addClass(activeOverlay.element,YAHOO.widget.OverlayManager.CSS_FOCUSED);this.overlays.sort(this.compareZIndexDesc);var topZIndex=YAHOO.util.Dom.getStyle(this.overlays[0].element,"zIndex");if(!isNaN(topZIndex)&&this.overlays[0]!=overlay){activeOverlay.cfg.setProperty("zIndex",(parseInt(topZIndex,10)+2));}
this.overlays.sort(this.compareZIndexDesc);o.focusEvent.fire();}}};this.remove=function(overlay){var o=this.find(overlay);if(o){var originalZ=YAHOO.util.Dom.getStyle(o.element,"zIndex");o.cfg.setProperty("zIndex",-1000,true);this.overlays.sort(this.compareZIndexDesc);this.overlays=this.overlays.slice(0,this.overlays.length-1);o.hideEvent.unsubscribe(o.blur);o.destroyEvent.unsubscribe(this._onOverlayDestroy,o);if(o.element){YAHOO.util.Event.removeListener(o.element,this.cfg.getProperty("focusevent"),this._onOverlayElementFocus);}
o.cfg.setProperty("zIndex",originalZ,true);o.cfg.setProperty("manager",null);o.focusEvent.unsubscribeAll();o.blurEvent.unsubscribeAll();o.focusEvent=null;o.blurEvent=null;o.focus=null;o.blur=null;}};this.blurAll=function(){for(var o=0;o<this.overlays.length;o++){this.overlays[o].blur();}};this._onOverlayBlur=function(p_sType,p_aArgs){activeOverlay=null;};var overlays=this.cfg.getProperty("overlays");if(!this.overlays){this.overlays=[];}
if(overlays){this.register(overlays);this.overlays.sort(this.compareZIndexDesc);}},_onOverlayElementFocus:function(p_oEvent){var oTarget=YAHOO.util.Event.getTarget(p_oEvent),oClose=this.close;if(oClose&&(oTarget==oClose||YAHOO.util.Dom.isAncestor(oClose,oTarget))){this.blur();}
else{this.focus();}},_onOverlayDestroy:function(p_sType,p_aArgs,p_oOverlay){this.remove(p_oOverlay);},register:function(overlay){if(overlay instanceof YAHOO.widget.Overlay){overlay.cfg.addProperty("manager",{value:this});overlay.focusEvent=new YAHOO.util.CustomEvent("focus",overlay);overlay.blurEvent=new YAHOO.util.CustomEvent("blur",overlay);var mgr=this;overlay.focus=function(){mgr.focus(this);};overlay.blur=function(){if(mgr.getActive()==this){YAHOO.util.Dom.removeClass(this.element,YAHOO.widget.OverlayManager.CSS_FOCUSED);this.blurEvent.fire();}};overlay.blurEvent.subscribe(mgr._onOverlayBlur);overlay.hideEvent.subscribe(overlay.blur);overlay.destroyEvent.subscribe(this._onOverlayDestroy,overlay,this);YAHOO.util.Event.addListener(overlay.element,this.cfg.getProperty("focusevent"),this._onOverlayElementFocus,null,overlay);var zIndex=YAHOO.util.Dom.getStyle(overlay.element,"zIndex");if(!isNaN(zIndex)){overlay.cfg.setProperty("zIndex",parseInt(zIndex,10));}else{overlay.cfg.setProperty("zIndex",0);}
this.overlays.push(overlay);return true;}else if(overlay instanceof Array){var regcount=0;for(var i=0;i<overlay.length;i++){if(this.register(overlay[i])){regcount++;}}
if(regcount>0){return true;}}else{return false;}},find:function(overlay){if(overlay instanceof YAHOO.widget.Overlay){for(var o=0;o<this.overlays.length;o++){if(this.overlays[o]==overlay){return this.overlays[o];}}}else if(typeof overlay=="string"){for(var p=0;p<this.overlays.length;p++){if(this.overlays[p].id==overlay){return this.overlays[p];}}}
return null;},compareZIndexDesc:function(o1,o2){var zIndex1=o1.cfg.getProperty("zIndex");var zIndex2=o2.cfg.getProperty("zIndex");if(zIndex1>zIndex2){return-1;}else if(zIndex1<zIndex2){return 1;}else{return 0;}},showAll:function(){for(var o=0;o<this.overlays.length;o++){this.overlays[o].show();}},hideAll:function(){for(var o=0;o<this.overlays.length;o++){this.overlays[o].hide();}},toString:function(){return"OverlayManager";}};YAHOO.widget.ContainerEffect=function(overlay,attrIn,attrOut,targetElement,animClass){if(!animClass){animClass=YAHOO.util.Anim;}
this.overlay=overlay;this.attrIn=attrIn;this.attrOut=attrOut;this.targetElement=targetElement||overlay.element;this.animClass=animClass;};YAHOO.widget.ContainerEffect.prototype.init=function(){this.beforeAnimateInEvent=new YAHOO.util.CustomEvent("beforeAnimateIn",this);this.beforeAnimateOutEvent=new YAHOO.util.CustomEvent("beforeAnimateOut",this);this.animateInCompleteEvent=new YAHOO.util.CustomEvent("animateInComplete",this);this.animateOutCompleteEvent=new YAHOO.util.CustomEvent("animateOutComplete",this);this.animIn=new this.animClass(this.targetElement,this.attrIn.attributes,this.attrIn.duration,this.attrIn.method);this.animIn.onStart.subscribe(this.handleStartAnimateIn,this);this.animIn.onTween.subscribe(this.handleTweenAnimateIn,this);this.animIn.onComplete.subscribe(this.handleCompleteAnimateIn,this);this.animOut=new this.animClass(this.targetElement,this.attrOut.attributes,this.attrOut.duration,this.attrOut.method);this.animOut.onStart.subscribe(this.handleStartAnimateOut,this);this.animOut.onTween.subscribe(this.handleTweenAnimateOut,this);this.animOut.onComplete.subscribe(this.handleCompleteAnimateOut,this);};YAHOO.widget.ContainerEffect.prototype.animateIn=function(){this.beforeAnimateInEvent.fire();this.animIn.animate();};YAHOO.widget.ContainerEffect.prototype.animateOut=function(){this.beforeAnimateOutEvent.fire();this.animOut.animate();};YAHOO.widget.ContainerEffect.prototype.handleStartAnimateIn=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleTweenAnimateIn=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleCompleteAnimateIn=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleStartAnimateOut=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleTweenAnimateOut=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.handleCompleteAnimateOut=function(type,args,obj){};YAHOO.widget.ContainerEffect.prototype.toString=function(){var output="ContainerEffect";if(this.overlay){output+=" ["+this.overlay.toString()+"]";}
return output;};YAHOO.widget.ContainerEffect.FADE=function(overlay,dur){var fade=new YAHOO.widget.ContainerEffect(overlay,{attributes:{opacity:{from:0,to:1}},duration:dur,method:YAHOO.util.Easing.easeIn},{attributes:{opacity:{to:0}},duration:dur,method:YAHOO.util.Easing.easeOut},overlay.element);fade.handleStartAnimateIn=function(type,args,obj){YAHOO.util.Dom.addClass(obj.overlay.element,"hide-select");if(!obj.overlay.underlay){obj.overlay.cfg.refireEvent("underlay");}
if(obj.overlay.underlay){obj.initialUnderlayOpacity=YAHOO.util.Dom.getStyle(obj.overlay.underlay,"opacity");obj.overlay.underlay.style.filter=null;}
YAHOO.util.Dom.setStyle(obj.overlay.element,"visibility","visible");YAHOO.util.Dom.setStyle(obj.overlay.element,"opacity",0);};fade.handleCompleteAnimateIn=function(type,args,obj){YAHOO.util.Dom.removeClass(obj.overlay.element,"hide-select");if(obj.overlay.element.style.filter){obj.overlay.element.style.filter=null;}
if(obj.overlay.underlay){YAHOO.util.Dom.setStyle(obj.overlay.underlay,"opacity",obj.initialUnderlayOpacity);}
obj.overlay.cfg.refireEvent("iframe");obj.animateInCompleteEvent.fire();};fade.handleStartAnimateOut=function(type,args,obj){YAHOO.util.Dom.addClass(obj.overlay.element,"hide-select");if(obj.overlay.underlay){obj.overlay.underlay.style.filter=null;}};fade.handleCompleteAnimateOut=function(type,args,obj){YAHOO.util.Dom.removeClass(obj.overlay.element,"hide-select");if(obj.overlay.element.style.filter){obj.overlay.element.style.filter=null;}
YAHOO.util.Dom.setStyle(obj.overlay.element,"visibility","hidden");YAHOO.util.Dom.setStyle(obj.overlay.element,"opacity",1);obj.overlay.cfg.refireEvent("iframe");obj.animateOutCompleteEvent.fire();};fade.init();return fade;};YAHOO.widget.ContainerEffect.SLIDE=function(overlay,dur){var x=overlay.cfg.getProperty("x")||YAHOO.util.Dom.getX(overlay.element);var y=overlay.cfg.getProperty("y")||YAHOO.util.Dom.getY(overlay.element);var clientWidth=YAHOO.util.Dom.getClientWidth();var offsetWidth=overlay.element.offsetWidth;var slide=new YAHOO.widget.ContainerEffect(overlay,{attributes:{points:{to:[x,y]}},duration:dur,method:YAHOO.util.Easing.easeIn},{attributes:{points:{to:[(clientWidth+25),y]}},duration:dur,method:YAHOO.util.Easing.easeOut},overlay.element,YAHOO.util.Motion);slide.handleStartAnimateIn=function(type,args,obj){obj.overlay.element.style.left=(-25-offsetWidth)+"px";obj.overlay.element.style.top=y+"px";};slide.handleTweenAnimateIn=function(type,args,obj){var pos=YAHOO.util.Dom.getXY(obj.overlay.element);var currentX=pos[0];var currentY=pos[1];if(YAHOO.util.Dom.getStyle(obj.overlay.element,"visibility")=="hidden"&&currentX<x){YAHOO.util.Dom.setStyle(obj.overlay.element,"visibility","visible");}
obj.overlay.cfg.setProperty("xy",[currentX,currentY],true);obj.overlay.cfg.refireEvent("iframe");};slide.handleCompleteAnimateIn=function(type,args,obj){obj.overlay.cfg.setProperty("xy",[x,y],true);obj.startX=x;obj.startY=y;obj.overlay.cfg.refireEvent("iframe");obj.animateInCompleteEvent.fire();};slide.handleStartAnimateOut=function(type,args,obj){var vw=YAHOO.util.Dom.getViewportWidth();var pos=YAHOO.util.Dom.getXY(obj.overlay.element);var yso=pos[1];var currentTo=obj.animOut.attributes.points.to;obj.animOut.attributes.points.to=[(vw+25),yso];};slide.handleTweenAnimateOut=function(type,args,obj){var pos=YAHOO.util.Dom.getXY(obj.overlay.element);var xto=pos[0];var yto=pos[1];obj.overlay.cfg.setProperty("xy",[xto,yto],true);obj.overlay.cfg.refireEvent("iframe");};slide.handleCompleteAnimateOut=function(type,args,obj){YAHOO.util.Dom.setStyle(obj.overlay.element,"visibility","hidden");obj.overlay.cfg.setProperty("xy",[x,y]);obj.animateOutCompleteEvent.fire();};slide.init();return slide;};YAHOO.register("container_core",YAHOO.widget.Module,{version:"2.2.2",build:"204"});
// menu-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

(function(){var Dom=YAHOO.util.Dom,Event=YAHOO.util.Event;YAHOO.widget.MenuManager=function(){var m_bInitializedEventHandlers=false,m_oMenus={},m_oItems={},m_oVisibleMenus={},m_oEventTypes={"click":"clickEvent","mousedown":"mouseDownEvent","mouseup":"mouseUpEvent","mouseover":"mouseOverEvent","mouseout":"mouseOutEvent","keydown":"keyDownEvent","keyup":"keyUpEvent","keypress":"keyPressEvent"},m_oFocusedMenuItem=null;function addItem(p_oItem){var sId=p_oItem.id;if(p_oItem&&m_oItems[sId]!=p_oItem){m_oItems[sId]=p_oItem;p_oItem.destroyEvent.subscribe(onItemDestroy);}}
function removeItem(p_oItem){var sId=p_oItem.id;if(sId&&m_oItems[sId]){delete m_oItems[sId];}}
function getMenuRootElement(p_oElement){var oParentNode;if(p_oElement&&p_oElement.tagName){switch(p_oElement.tagName.toUpperCase()){case"DIV":oParentNode=p_oElement.parentNode;if((Dom.hasClass(p_oElement,"hd")||Dom.hasClass(p_oElement,"bd")||Dom.hasClass(p_oElement,"ft"))&&oParentNode&&oParentNode.tagName&&oParentNode.tagName.toUpperCase()=="DIV"){return oParentNode;}
else{return p_oElement;}
break;case"LI":return p_oElement;default:oParentNode=p_oElement.parentNode;if(oParentNode){return getMenuRootElement(oParentNode);}
break;}}}
function onDOMEvent(p_oEvent){var oTarget=Event.getTarget(p_oEvent),oElement=getMenuRootElement(oTarget),oMenuItem,oMenu;if(oElement){var sTagName=oElement.tagName.toUpperCase();if(sTagName=="LI"){var sId=oElement.id;if(sId&&m_oItems[sId]){oMenuItem=m_oItems[sId];oMenu=oMenuItem.parent;}}
else if(sTagName=="DIV"){if(oElement.id){oMenu=m_oMenus[oElement.id];}}}
if(oMenu){var sCustomEventType=m_oEventTypes[p_oEvent.type];if(oMenuItem&&!oMenuItem.cfg.getProperty("disabled")){oMenuItem[sCustomEventType].fire(p_oEvent);if(p_oEvent.type=="keyup"||p_oEvent.type=="mousedown"){if(m_oFocusedMenuItem!=oMenuItem){if(m_oFocusedMenuItem){m_oFocusedMenuItem.blurEvent.fire();}
oMenuItem.focusEvent.fire();}}}
oMenu[sCustomEventType].fire(p_oEvent,oMenuItem);}
else if(p_oEvent.type=="mousedown"){if(m_oFocusedMenuItem){m_oFocusedMenuItem.blurEvent.fire();m_oFocusedMenuItem=null;}
for(var i in m_oMenus){if(YAHOO.lang.hasOwnProperty(m_oMenus,i)){oMenu=m_oMenus[i];if(oMenu.cfg.getProperty("clicktohide")&&oMenu.cfg.getProperty("position")=="dynamic"){oMenu.hide();}
else{oMenu.clearActiveItem(true);}}}}
else if(p_oEvent.type=="keyup"){if(m_oFocusedMenuItem){m_oFocusedMenuItem.blurEvent.fire();m_oFocusedMenuItem=null;}}}
function onMenuDestroy(p_sType,p_aArgs){if(m_oMenus[this.id]){delete m_oMenus[this.id];}}
function onMenuFocus(p_sType,p_aArgs){var oItem=p_aArgs[0];if(oItem){m_oFocusedMenuItem=oItem;}}
function onMenuBlur(p_sType,p_aArgs){m_oFocusedMenuItem=null;}
function onItemDestroy(p_sType,p_aArgs){var sId=this.id;if(sId&&m_oItems[sId]){delete m_oItems[sId];}}
function onMenuVisibleConfigChange(p_sType,p_aArgs){var bVisible=p_aArgs[0];if(bVisible){m_oVisibleMenus[this.id]=this;}
else if(m_oVisibleMenus[this.id]){delete m_oVisibleMenus[this.id];}}
function onItemAdded(p_sType,p_aArgs){addItem(p_aArgs[0]);}
function onItemRemoved(p_sType,p_aArgs){removeItem(p_aArgs[0]);}
return{addMenu:function(p_oMenu){if(p_oMenu&&p_oMenu.id&&!m_oMenus[p_oMenu.id]){m_oMenus[p_oMenu.id]=p_oMenu;if(!m_bInitializedEventHandlers){var oDoc=document;Event.on(oDoc,"mouseover",onDOMEvent,this,true);Event.on(oDoc,"mouseout",onDOMEvent,this,true);Event.on(oDoc,"mousedown",onDOMEvent,this,true);Event.on(oDoc,"mouseup",onDOMEvent,this,true);Event.on(oDoc,"click",onDOMEvent,this,true);Event.on(oDoc,"keydown",onDOMEvent,this,true);Event.on(oDoc,"keyup",onDOMEvent,this,true);Event.on(oDoc,"keypress",onDOMEvent,this,true);m_bInitializedEventHandlers=true;}
p_oMenu.destroyEvent.subscribe(onMenuDestroy);p_oMenu.cfg.subscribeToConfigEvent("visible",onMenuVisibleConfigChange);p_oMenu.itemAddedEvent.subscribe(onItemAdded);p_oMenu.itemRemovedEvent.subscribe(onItemRemoved);p_oMenu.focusEvent.subscribe(onMenuFocus);p_oMenu.blurEvent.subscribe(onMenuBlur);}},removeMenu:function(p_oMenu){if(p_oMenu&&m_oMenus[p_oMenu.id]){delete m_oMenus[p_oMenu.id];}},hideVisible:function(){var oMenu;for(var i in m_oVisibleMenus){if(YAHOO.lang.hasOwnProperty(m_oVisibleMenus,i)){oMenu=m_oVisibleMenus[i];if(oMenu.cfg.getProperty("position")=="dynamic"){oMenu.hide();}}}},getMenus:function(){return m_oMenus;},getMenu:function(p_sId){if(m_oMenus[p_sId]){return m_oMenus[p_sId];}},getFocusedMenuItem:function(){return m_oFocusedMenuItem;},getFocusedMenu:function(){if(m_oFocusedMenuItem){return(m_oFocusedMenuItem.parent.getRoot());}},toString:function(){return("MenuManager");}};}();})();(function(){var Dom=YAHOO.util.Dom,Event=YAHOO.util.Event,CustomEvent=YAHOO.util.CustomEvent,Lang=YAHOO.lang;YAHOO.widget.Menu=function(p_oElement,p_oConfig){if(p_oConfig){this.parent=p_oConfig.parent;this.lazyLoad=p_oConfig.lazyLoad||p_oConfig.lazyload;this.itemData=p_oConfig.itemData||p_oConfig.itemdata;}
YAHOO.widget.Menu.superclass.constructor.call(this,p_oElement,p_oConfig);};YAHOO.widget.Menu._EVENT_TYPES={"MOUSE_OVER":"mouseover","MOUSE_OUT":"mouseout","MOUSE_DOWN":"mousedown","MOUSE_UP":"mouseup","CLICK":"click","KEY_PRESS":"keypress","KEY_DOWN":"keydown","KEY_UP":"keyup","FOCUS":"focus","BLUR":"blur","ITEM_ADDED":"itemAdded","ITEM_REMOVED":"itemRemoved"};YAHOO.widget.Menu._checkPosition=function(p_sPosition){if(typeof p_sPosition=="string"){var sPosition=p_sPosition.toLowerCase();return("dynamic,static".indexOf(sPosition)!=-1);}};YAHOO.widget.Menu._DEFAULT_CONFIG={"VISIBLE":{key:"visible",value:false,validator:Lang.isBoolean},"CONSTRAIN_TO_VIEWPORT":{key:"constraintoviewport",value:true,validator:Lang.isBoolean,supercedes:["iframe","x","y","xy"]},"POSITION":{key:"position",value:"dynamic",validator:YAHOO.widget.Menu._checkPosition,supercedes:["visible"]},"SUBMENU_ALIGNMENT":{key:"submenualignment",value:["tl","tr"]},"AUTO_SUBMENU_DISPLAY":{key:"autosubmenudisplay",value:true,validator:Lang.isBoolean},"SHOW_DELAY":{key:"showdelay",value:250,validator:Lang.isNumber},"HIDE_DELAY":{key:"hidedelay",value:0,validator:Lang.isNumber,suppressEvent:true},"SUBMENU_HIDE_DELAY":{key:"submenuhidedelay",value:250,validator:Lang.isNumber},"CLICK_TO_HIDE":{key:"clicktohide",value:true,validator:Lang.isBoolean},"CONTAINER":{key:"container"},"MAX_HEIGHT":{key:"maxheight",value:0,validator:Lang.isNumber},"CLASS_NAME":{key:"classname",value:null,validator:Lang.isString}};YAHOO.lang.extend(YAHOO.widget.Menu,YAHOO.widget.Overlay,{CSS_CLASS_NAME:"yuimenu",ITEM_TYPE:null,GROUP_TITLE_TAG_NAME:"h6",_nHideDelayId:null,_nShowDelayId:null,_nSubmenuHideDelayId:null,_nBodyScrollId:null,_bHideDelayEventHandlersAssigned:false,_bHandledMouseOverEvent:false,_bHandledMouseOutEvent:false,_aGroupTitleElements:null,_aItemGroups:null,_aListElements:null,_nCurrentMouseX:0,_nMaxHeight:-1,_bStopMouseEventHandlers:false,_sClassName:null,lazyLoad:false,itemData:null,activeItem:null,parent:null,srcElement:null,mouseOverEvent:null,mouseOutEvent:null,mouseDownEvent:null,mouseUpEvent:null,clickEvent:null,keyPressEvent:null,keyDownEvent:null,keyUpEvent:null,itemAddedEvent:null,itemRemovedEvent:null,init:function(p_oElement,p_oConfig){this._aItemGroups=[];this._aListElements=[];this._aGroupTitleElements=[];if(!this.ITEM_TYPE){this.ITEM_TYPE=YAHOO.widget.MenuItem;}
var oElement;if(typeof p_oElement=="string"){oElement=document.getElementById(p_oElement);}
else if(p_oElement.tagName){oElement=p_oElement;}
if(oElement&&oElement.tagName){switch(oElement.tagName.toUpperCase()){case"DIV":this.srcElement=oElement;if(!oElement.id){oElement.setAttribute("id",Dom.generateId());}
YAHOO.widget.Menu.superclass.init.call(this,oElement);this.beforeInitEvent.fire(YAHOO.widget.Menu);break;case"SELECT":this.srcElement=oElement;YAHOO.widget.Menu.superclass.init.call(this,Dom.generateId());this.beforeInitEvent.fire(YAHOO.widget.Menu);break;}}
else{YAHOO.widget.Menu.superclass.init.call(this,p_oElement);this.beforeInitEvent.fire(YAHOO.widget.Menu);}
if(this.element){var oEl=this.element;Dom.addClass(oEl,this.CSS_CLASS_NAME);this.initEvent.subscribe(this._onInit,this,true);this.beforeRenderEvent.subscribe(this._onBeforeRender,this,true);this.renderEvent.subscribe(this._onRender);this.beforeShowEvent.subscribe(this._onBeforeShow,this,true);this.showEvent.subscribe(this._onShow,this,true);this.beforeHideEvent.subscribe(this._onBeforeHide,this,true);this.hideEvent.subscribe(this._onHide,this,true);this.mouseOverEvent.subscribe(this._onMouseOver,this,true);this.mouseOutEvent.subscribe(this._onMouseOut,this,true);this.clickEvent.subscribe(this._onClick,this,true);this.keyDownEvent.subscribe(this._onKeyDown,this,true);this.keyPressEvent.subscribe(this._onKeyPress,this,true);YAHOO.widget.Module.textResizeEvent.subscribe(this._onTextResize,this,true);if(p_oConfig){this.cfg.applyConfig(p_oConfig,true);}
YAHOO.widget.MenuManager.addMenu(this);this.initEvent.fire(YAHOO.widget.Menu);}},_initSubTree:function(){var oNode;if(this.srcElement.tagName.toUpperCase()=="DIV"){oNode=this.body.firstChild;var nGroup=0,sGroupTitleTagName=this.GROUP_TITLE_TAG_NAME.toUpperCase();do{if(oNode&&oNode.tagName){switch(oNode.tagName.toUpperCase()){case sGroupTitleTagName:this._aGroupTitleElements[nGroup]=oNode;break;case"UL":this._aListElements[nGroup]=oNode;this._aItemGroups[nGroup]=[];nGroup++;break;}}}
while((oNode=oNode.nextSibling));if(this._aListElements[0]){Dom.addClass(this._aListElements[0],"first-of-type");}}
oNode=null;if(this.srcElement.tagName){var sSrcElementTagName=this.srcElement.tagName.toUpperCase();switch(sSrcElementTagName){case"DIV":if(this._aListElements.length>0){var i=this._aListElements.length-1;do{oNode=this._aListElements[i].firstChild;do{if(oNode&&oNode.tagName&&oNode.tagName.toUpperCase()=="LI"){this.addItem(new this.ITEM_TYPE(oNode,{parent:this}),i);}}
while((oNode=oNode.nextSibling));}
while(i--);}
break;case"SELECT":oNode=this.srcElement.firstChild;do{if(oNode&&oNode.tagName){switch(oNode.tagName.toUpperCase()){case"OPTGROUP":case"OPTION":this.addItem(new this.ITEM_TYPE(oNode,{parent:this}));break;}}}
while((oNode=oNode.nextSibling));break;}}},_getFirstEnabledItem:function(){var aItems=this.getItems(),nItems=aItems.length,oItem;for(var i=0;i<nItems;i++){oItem=aItems[i];if(oItem&&!oItem.cfg.getProperty("disabled")&&oItem.element.style.display!="none"){return oItem;}}},_addItemToGroup:function(p_nGroupIndex,p_oItem,p_nItemIndex){var oItem;if(p_oItem instanceof this.ITEM_TYPE){oItem=p_oItem;oItem.parent=this;}
else if(typeof p_oItem=="string"){oItem=new this.ITEM_TYPE(p_oItem,{parent:this});}
else if(typeof p_oItem=="object"){p_oItem.parent=this;oItem=new this.ITEM_TYPE(p_oItem.text,p_oItem);}
if(oItem){if(oItem.cfg.getProperty("selected")){this.activeItem=oItem;}
var nGroupIndex=typeof p_nGroupIndex=="number"?p_nGroupIndex:0,aGroup=this._getItemGroup(nGroupIndex),oGroupItem;if(!aGroup){aGroup=this._createItemGroup(nGroupIndex);}
if(typeof p_nItemIndex=="number"){var bAppend=(p_nItemIndex>=aGroup.length);if(aGroup[p_nItemIndex]){aGroup.splice(p_nItemIndex,0,oItem);}
else{aGroup[p_nItemIndex]=oItem;}
oGroupItem=aGroup[p_nItemIndex];if(oGroupItem){if(bAppend&&(!oGroupItem.element.parentNode||oGroupItem.element.parentNode.nodeType==11)){this._aListElements[nGroupIndex].appendChild(oGroupItem.element);}
else{function getNextItemSibling(p_aArray,p_nStartIndex){return(p_aArray[p_nStartIndex]||getNextItemSibling(p_aArray,(p_nStartIndex+1)));}
var oNextItemSibling=getNextItemSibling(aGroup,(p_nItemIndex+1));if(oNextItemSibling&&(!oGroupItem.element.parentNode||oGroupItem.element.parentNode.nodeType==11)){this._aListElements[nGroupIndex].insertBefore(oGroupItem.element,oNextItemSibling.element);}}
oGroupItem.parent=this;this._subscribeToItemEvents(oGroupItem);this._configureSubmenu(oGroupItem);this._updateItemProperties(nGroupIndex);this.itemAddedEvent.fire(oGroupItem);return oGroupItem;}}
else{var nItemIndex=aGroup.length;aGroup[nItemIndex]=oItem;oGroupItem=aGroup[nItemIndex];if(oGroupItem){if(!Dom.isAncestor(this._aListElements[nGroupIndex],oGroupItem.element)){this._aListElements[nGroupIndex].appendChild(oGroupItem.element);}
oGroupItem.element.setAttribute("groupindex",nGroupIndex);oGroupItem.element.setAttribute("index",nItemIndex);oGroupItem.parent=this;oGroupItem.index=nItemIndex;oGroupItem.groupIndex=nGroupIndex;this._subscribeToItemEvents(oGroupItem);this._configureSubmenu(oGroupItem);if(nItemIndex===0){Dom.addClass(oGroupItem.element,"first-of-type");}
this.itemAddedEvent.fire(oGroupItem);return oGroupItem;}}}},_removeItemFromGroupByIndex:function(p_nGroupIndex,p_nItemIndex){var nGroupIndex=typeof p_nGroupIndex=="number"?p_nGroupIndex:0,aGroup=this._getItemGroup(nGroupIndex);if(aGroup){var aArray=aGroup.splice(p_nItemIndex,1),oItem=aArray[0];if(oItem){this._updateItemProperties(nGroupIndex);if(aGroup.length===0){var oUL=this._aListElements[nGroupIndex];if(this.body&&oUL){this.body.removeChild(oUL);}
this._aItemGroups.splice(nGroupIndex,1);this._aListElements.splice(nGroupIndex,1);oUL=this._aListElements[0];if(oUL){Dom.addClass(oUL,"first-of-type");}}
this.itemRemovedEvent.fire(oItem);return oItem;}}},_removeItemFromGroupByValue:function(p_nGroupIndex,p_oItem){var aGroup=this._getItemGroup(p_nGroupIndex);if(aGroup){var nItems=aGroup.length,nItemIndex=-1;if(nItems>0){var i=nItems-1;do{if(aGroup[i]==p_oItem){nItemIndex=i;break;}}
while(i--);if(nItemIndex>-1){return this._removeItemFromGroupByIndex(p_nGroupIndex,nItemIndex);}}}},_updateItemProperties:function(p_nGroupIndex){var aGroup=this._getItemGroup(p_nGroupIndex),nItems=aGroup.length;if(nItems>0){var i=nItems-1,oItem,oLI;do{oItem=aGroup[i];if(oItem){oLI=oItem.element;oItem.index=i;oItem.groupIndex=p_nGroupIndex;oLI.setAttribute("groupindex",p_nGroupIndex);oLI.setAttribute("index",i);Dom.removeClass(oLI,"first-of-type");}}
while(i--);if(oLI){Dom.addClass(oLI,"first-of-type");}}},_createItemGroup:function(p_nIndex){if(!this._aItemGroups[p_nIndex]){this._aItemGroups[p_nIndex]=[];var oUL=document.createElement("ul");this._aListElements[p_nIndex]=oUL;return this._aItemGroups[p_nIndex];}},_getItemGroup:function(p_nIndex){var nIndex=((typeof p_nIndex=="number")?p_nIndex:0);return this._aItemGroups[nIndex];},_configureSubmenu:function(p_oItem){var oSubmenu=p_oItem.cfg.getProperty("submenu");if(oSubmenu){this.cfg.configChangedEvent.subscribe(this._onParentMenuConfigChange,oSubmenu,true);this.renderEvent.subscribe(this._onParentMenuRender,oSubmenu,true);oSubmenu.beforeShowEvent.subscribe(this._onSubmenuBeforeShow,oSubmenu,true);oSubmenu.showEvent.subscribe(this._onSubmenuShow,null,p_oItem);oSubmenu.hideEvent.subscribe(this._onSubmenuHide,null,p_oItem);}},_subscribeToItemEvents:function(p_oItem){p_oItem.focusEvent.subscribe(this._onMenuItemFocus);p_oItem.blurEvent.subscribe(this._onMenuItemBlur);p_oItem.cfg.configChangedEvent.subscribe(this._onMenuItemConfigChange,p_oItem,this);},_getOffsetWidth:function(){var oClone=this.element.cloneNode(true);Dom.setStyle(oClone,"width","");document.body.appendChild(oClone);var sWidth=oClone.offsetWidth;document.body.removeChild(oClone);return sWidth;},_setWidth:function(){var sWidth;if(this.element.parentNode.tagName.toUpperCase()=="BODY"){if(this.browser=="opera"){sWidth=this._getOffsetWidth();}
else{Dom.setStyle(this.element,"width","auto");sWidth=this.element.offsetWidth;}}
else{sWidth=this._getOffsetWidth();}
this.cfg.setProperty("width",(sWidth+"px"));},_onWidthChange:function(p_sType,p_aArgs){var sWidth=p_aArgs[0];if(sWidth&&!this._hasSetWidthHandlers){this.itemAddedEvent.subscribe(this._setWidth);this.itemRemovedEvent.subscribe(this._setWidth);this._hasSetWidthHandlers=true;}
else if(this._hasSetWidthHandlers){this.itemAddedEvent.unsubscribe(this._setWidth);this.itemRemovedEvent.unsubscribe(this._setWidth);this._hasSetWidthHandlers=false;}},_onVisibleChange:function(p_sType,p_aArgs){var bVisible=p_aArgs[0];if(bVisible){Dom.addClass(this.element,"visible");}
else{Dom.removeClass(this.element,"visible");}},_cancelHideDelay:function(){var oRoot=this.getRoot();if(oRoot._nHideDelayId){window.clearTimeout(oRoot._nHideDelayId);}},_execHideDelay:function(){this._cancelHideDelay();var oRoot=this.getRoot(),me=this;function hideMenu(){if(oRoot.activeItem){oRoot.clearActiveItem();}
if(oRoot==me&&me.cfg.getProperty("position")=="dynamic"){me.hide();}}
oRoot._nHideDelayId=window.setTimeout(hideMenu,oRoot.cfg.getProperty("hidedelay"));},_cancelShowDelay:function(){var oRoot=this.getRoot();if(oRoot._nShowDelayId){window.clearTimeout(oRoot._nShowDelayId);}},_execShowDelay:function(p_oMenu){var oRoot=this.getRoot();function showMenu(){if(p_oMenu.parent.cfg.getProperty("selected")){p_oMenu.show();}}
oRoot._nShowDelayId=window.setTimeout(showMenu,oRoot.cfg.getProperty("showdelay"));},_execSubmenuHideDelay:function(p_oSubmenu,p_nMouseX,p_nHideDelay){var me=this;p_oSubmenu._nSubmenuHideDelayId=window.setTimeout(function(){if(me._nCurrentMouseX>(p_nMouseX+10)){p_oSubmenu._nSubmenuHideDelayId=window.setTimeout(function(){p_oSubmenu.hide();},p_nHideDelay);}
else{p_oSubmenu.hide();}},50);},_disableScrollHeader:function(){if(!this._bHeaderDisabled){Dom.addClass(this.header,"topscrollbar_disabled");this._bHeaderDisabled=true;}},_disableScrollFooter:function(){if(!this._bFooterDisabled){Dom.addClass(this.footer,"bottomscrollbar_disabled");this._bFooterDisabled=true;}},_enableScrollHeader:function(){if(this._bHeaderDisabled){Dom.removeClass(this.header,"topscrollbar_disabled");this._bHeaderDisabled=false;}},_enableScrollFooter:function(){if(this._bFooterDisabled){Dom.removeClass(this.footer,"bottomscrollbar_disabled");this._bFooterDisabled=false;}},_onMouseOver:function(p_sType,p_aArgs,p_oMenu){if(this._bStopMouseEventHandlers){return false;}
var oEvent=p_aArgs[0],oItem=p_aArgs[1],oTarget=Event.getTarget(oEvent);if(!this._bHandledMouseOverEvent&&(oTarget==this.element||Dom.isAncestor(this.element,oTarget))){this._nCurrentMouseX=0;Event.on(this.element,"mousemove",this._onMouseMove,this,true);this.clearActiveItem();if(this.parent&&this._nSubmenuHideDelayId){window.clearTimeout(this._nSubmenuHideDelayId);this.parent.cfg.setProperty("selected",true);var oParentMenu=this.parent.parent;oParentMenu._bHandledMouseOutEvent=true;oParentMenu._bHandledMouseOverEvent=false;}
this._bHandledMouseOverEvent=true;this._bHandledMouseOutEvent=false;}
if(oItem&&!oItem.handledMouseOverEvent&&!oItem.cfg.getProperty("disabled")&&(oTarget==oItem.element||Dom.isAncestor(oItem.element,oTarget))){var nShowDelay=this.cfg.getProperty("showdelay"),bShowDelay=(nShowDelay>0);if(bShowDelay){this._cancelShowDelay();}
var oActiveItem=this.activeItem;if(oActiveItem){oActiveItem.cfg.setProperty("selected",false);}
var oItemCfg=oItem.cfg;oItemCfg.setProperty("selected",true);if(this.hasFocus()){oItem.focus();}
if(this.cfg.getProperty("autosubmenudisplay")){var oSubmenu=oItemCfg.getProperty("submenu");if(oSubmenu){if(bShowDelay){this._execShowDelay(oSubmenu);}
else{oSubmenu.show();}}}
oItem.handledMouseOverEvent=true;oItem.handledMouseOutEvent=false;}},_onMouseOut:function(p_sType,p_aArgs,p_oMenu){if(this._bStopMouseEventHandlers){return false;}
var oEvent=p_aArgs[0],oItem=p_aArgs[1],oRelatedTarget=Event.getRelatedTarget(oEvent),bMovingToSubmenu=false;if(oItem&&!oItem.cfg.getProperty("disabled")){var oItemCfg=oItem.cfg,oSubmenu=oItemCfg.getProperty("submenu");if(oSubmenu&&(oRelatedTarget==oSubmenu.element||Dom.isAncestor(oSubmenu.element,oRelatedTarget))){bMovingToSubmenu=true;}
if(!oItem.handledMouseOutEvent&&((oRelatedTarget!=oItem.element&&!Dom.isAncestor(oItem.element,oRelatedTarget))||bMovingToSubmenu)){if(!bMovingToSubmenu){oItem.cfg.setProperty("selected",false);if(oSubmenu){var nSubmenuHideDelay=this.cfg.getProperty("submenuhidedelay"),nShowDelay=this.cfg.getProperty("showdelay");if(!(this instanceof YAHOO.widget.MenuBar)&&nSubmenuHideDelay>0&&nShowDelay>=nSubmenuHideDelay){this._execSubmenuHideDelay(oSubmenu,Event.getPageX(oEvent),nSubmenuHideDelay);}
else{oSubmenu.hide();}}}
oItem.handledMouseOutEvent=true;oItem.handledMouseOverEvent=false;}}
if(!this._bHandledMouseOutEvent&&((oRelatedTarget!=this.element&&!Dom.isAncestor(this.element,oRelatedTarget))||bMovingToSubmenu)){Event.removeListener(this.element,"mousemove",this._onMouseMove);this._nCurrentMouseX=Event.getPageX(oEvent);this._bHandledMouseOutEvent=true;this._bHandledMouseOverEvent=false;}},_onMouseMove:function(p_oEvent,p_oMenu){if(this._bStopMouseEventHandlers){return false;}
this._nCurrentMouseX=Event.getPageX(p_oEvent);},_onClick:function(p_sType,p_aArgs,p_oMenu){var oEvent=p_aArgs[0],oItem=p_aArgs[1],oTarget=Event.getTarget(oEvent);if(oItem&&!oItem.cfg.getProperty("disabled")){var oItemCfg=oItem.cfg,oSubmenu=oItemCfg.getProperty("submenu");if(oTarget==oItem.submenuIndicator&&oSubmenu){if(oSubmenu.cfg.getProperty("visible")){oSubmenu.hide();oSubmenu.parent.focus();}
else{this.clearActiveItem();oItem.cfg.setProperty("selected",true);oSubmenu.show();oSubmenu.setInitialFocus();}}
else{var sURL=oItemCfg.getProperty("url"),bCurrentPageURL=(sURL.substr((sURL.length-1),1)=="#"),sTarget=oItemCfg.getProperty("target"),bHasTarget=(sTarget&&sTarget.length>0);if(oTarget.tagName.toUpperCase()=="A"&&bCurrentPageURL&&!bHasTarget){Event.preventDefault(oEvent);oItem.focus();}
if(oTarget.tagName.toUpperCase()!="A"&&!bCurrentPageURL&&!bHasTarget){document.location=sURL;}
if(bCurrentPageURL&&!oSubmenu){var oRoot=this.getRoot();if(oRoot.cfg.getProperty("position")=="static"){oRoot.clearActiveItem();}
else if(oRoot.cfg.getProperty("clicktohide")){oRoot.hide();}}}}},_onKeyDown:function(p_sType,p_aArgs,p_oMenu){var oEvent=p_aArgs[0],oItem=p_aArgs[1],me=this,oSubmenu;function stopMouseEventHandlers(){me._bStopMouseEventHandlers=true;window.setTimeout(function(){me._bStopMouseEventHandlers=false;},10);}
if(oItem&&!oItem.cfg.getProperty("disabled")){var oItemCfg=oItem.cfg,oParentItem=this.parent,oRoot,oNextItem;switch(oEvent.keyCode){case 38:case 40:oNextItem=(oEvent.keyCode==38)?oItem.getPreviousEnabledSibling():oItem.getNextEnabledSibling();if(oNextItem){this.clearActiveItem();oNextItem.cfg.setProperty("selected",true);oNextItem.focus();if(this.cfg.getProperty("maxheight")>0){var oBody=this.body;oBody.scrollTop=(oNextItem.element.offsetTop+
oNextItem.element.offsetHeight)-oBody.offsetHeight;var nScrollTop=oBody.scrollTop,nScrollTarget=oBody.scrollHeight-oBody.offsetHeight;if(nScrollTop===0){this._disableScrollHeader();this._enableScrollFooter();}
else if(nScrollTop==nScrollTarget){this._enableScrollHeader();this._disableScrollFooter();}
else{this._enableScrollHeader();this._enableScrollFooter();}}}
Event.preventDefault(oEvent);stopMouseEventHandlers();break;case 39:oSubmenu=oItemCfg.getProperty("submenu");if(oSubmenu){if(!oItemCfg.getProperty("selected")){oItemCfg.setProperty("selected",true);}
oSubmenu.show();oSubmenu.setInitialFocus();oSubmenu.setInitialSelection();}
else{oRoot=this.getRoot();if(oRoot instanceof YAHOO.widget.MenuBar){oNextItem=oRoot.activeItem.getNextEnabledSibling();if(oNextItem){oRoot.clearActiveItem();oNextItem.cfg.setProperty("selected",true);oSubmenu=oNextItem.cfg.getProperty("submenu");if(oSubmenu){oSubmenu.show();}
oNextItem.focus();}}}
Event.preventDefault(oEvent);stopMouseEventHandlers();break;case 37:if(oParentItem){var oParentMenu=oParentItem.parent;if(oParentMenu instanceof YAHOO.widget.MenuBar){oNextItem=oParentMenu.activeItem.getPreviousEnabledSibling();if(oNextItem){oParentMenu.clearActiveItem();oNextItem.cfg.setProperty("selected",true);oSubmenu=oNextItem.cfg.getProperty("submenu");if(oSubmenu){oSubmenu.show();}
oNextItem.focus();}}
else{this.hide();oParentItem.focus();}}
Event.preventDefault(oEvent);stopMouseEventHandlers();break;}}
if(oEvent.keyCode==27){if(this.cfg.getProperty("position")=="dynamic"){this.hide();if(this.parent){this.parent.focus();}}
else if(this.activeItem){oSubmenu=this.activeItem.cfg.getProperty("submenu");if(oSubmenu&&oSubmenu.cfg.getProperty("visible")){oSubmenu.hide();this.activeItem.focus();}
else{this.activeItem.blur();this.activeItem.cfg.setProperty("selected",false);}}
Event.preventDefault(oEvent);}},_onKeyPress:function(p_sType,p_aArgs,p_oMenu){var oEvent=p_aArgs[0];if(oEvent.keyCode==40||oEvent.keyCode==38){YAHOO.util.Event.preventDefault(oEvent);}},_onTextResize:function(p_sType,p_aArgs,p_oMenu){if(this.browser=="gecko"&&!this._handleResize){this._handleResize=true;return;}
var oConfig=this.cfg;if(oConfig.getProperty("position")=="dynamic"){oConfig.setProperty("width",(this._getOffsetWidth()+"px"));}},_onScrollTargetMouseOver:function(p_oEvent,p_oMenu){this._cancelHideDelay();var oTarget=Event.getTarget(p_oEvent),oBody=this.body,me=this,nScrollTarget,fnScrollFunction;function scrollBodyDown(){var nScrollTop=oBody.scrollTop;if(nScrollTop<nScrollTarget){oBody.scrollTop=(nScrollTop+1);me._enableScrollHeader();}
else{oBody.scrollTop=nScrollTarget;window.clearInterval(me._nBodyScrollId);me._disableScrollFooter();}}
function scrollBodyUp(){var nScrollTop=oBody.scrollTop;if(nScrollTop>0){oBody.scrollTop=(nScrollTop-1);me._enableScrollFooter();}
else{oBody.scrollTop=0;window.clearInterval(me._nBodyScrollId);me._disableScrollHeader();}}
if(Dom.hasClass(oTarget,"hd")){fnScrollFunction=scrollBodyUp;}
else{nScrollTarget=oBody.scrollHeight-oBody.offsetHeight;fnScrollFunction=scrollBodyDown;}
this._nBodyScrollId=window.setInterval(fnScrollFunction,10);},_onScrollTargetMouseOut:function(p_oEvent,p_oMenu){window.clearInterval(this._nBodyScrollId);this._cancelHideDelay();},_onInit:function(p_sType,p_aArgs,p_oMenu){this.cfg.subscribeToConfigEvent("width",this._onWidthChange);this.cfg.subscribeToConfigEvent("visible",this._onVisibleChange);if(((this.parent&&!this.lazyLoad)||(!this.parent&&this.cfg.getProperty("position")=="static")||(!this.parent&&!this.lazyLoad&&this.cfg.getProperty("position")=="dynamic"))&&this.getItemGroups().length===0){if(this.srcElement){this._initSubTree();}
if(this.itemData){this.addItems(this.itemData);}}
else if(this.lazyLoad){this.cfg.fireQueue();}},_onBeforeRender:function(p_sType,p_aArgs,p_oMenu){var oConfig=this.cfg,oEl=this.element,nListElements=this._aListElements.length;if(nListElements>0){var i=0,bFirstList=true,oUL,oGroupTitle;do{oUL=this._aListElements[i];if(oUL){if(bFirstList){Dom.addClass(oUL,"first-of-type");bFirstList=false;}
if(!Dom.isAncestor(oEl,oUL)){this.appendToBody(oUL);}
oGroupTitle=this._aGroupTitleElements[i];if(oGroupTitle){if(!Dom.isAncestor(oEl,oGroupTitle)){oUL.parentNode.insertBefore(oGroupTitle,oUL);}
Dom.addClass(oUL,"hastitle");}}
i++;}
while(i<nListElements);}},_onRender:function(p_sType,p_aArgs){if(this.cfg.getProperty("position")=="dynamic"&&!this.cfg.getProperty("width")){this._setWidth();}},_onBeforeShow:function(p_sType,p_aArgs,p_oMenu){if(this.lazyLoad&&this.getItemGroups().length===0){if(this.srcElement){this._initSubTree();}
if(this.itemData){if(this.parent&&this.parent.parent&&this.parent.parent.srcElement&&this.parent.parent.srcElement.tagName.toUpperCase()=="SELECT"){var nOptions=this.itemData.length;for(var n=0;n<nOptions;n++){if(this.itemData[n].tagName){this.addItem((new this.ITEM_TYPE(this.itemData[n])));}}}
else{this.addItems(this.itemData);}}
var oSrcElement=this.srcElement;if(oSrcElement){if(oSrcElement.tagName.toUpperCase()=="SELECT"){if(Dom.inDocument(oSrcElement)){this.render(oSrcElement.parentNode);}
else{this.render(this.cfg.getProperty("container"));}}
else{this.render();}}
else{if(this.parent){this.render(this.parent.element);}
else{this.render(this.cfg.getProperty("container"));this.cfg.refireEvent("xy");}}}
if(this.cfg.getProperty("position")=="dynamic"){var nViewportHeight=Dom.getViewportHeight();if(this.parent&&this.parent.parent instanceof YAHOO.widget.MenuBar){var oRegion=YAHOO.util.Region.getRegion(this.parent.element);nViewportHeight=(nViewportHeight-oRegion.bottom);}
if(this.element.offsetHeight>=nViewportHeight){var nMaxHeight=this.cfg.getProperty("maxheight");this._nMaxHeight=nMaxHeight;this.cfg.setProperty("maxheight",(nViewportHeight-20));}
if(this.cfg.getProperty("maxheight")>0){var oBody=this.body;if(oBody.scrollTop>0){oBody.scrollTop=0;}
this._disableScrollHeader();this._enableScrollFooter();}}},_onShow:function(p_sType,p_aArgs,p_oMenu){var oParent=this.parent;if(oParent){var oParentMenu=oParent.parent,aParentAlignment=oParentMenu.cfg.getProperty("submenualignment"),aAlignment=this.cfg.getProperty("submenualignment");if((aParentAlignment[0]!=aAlignment[0])&&(aParentAlignment[1]!=aAlignment[1])){this.cfg.setProperty("submenualignment",[aParentAlignment[0],aParentAlignment[1]]);}
if(!oParentMenu.cfg.getProperty("autosubmenudisplay")&&oParentMenu.cfg.getProperty("position")=="static"){oParentMenu.cfg.setProperty("autosubmenudisplay",true);function disableAutoSubmenuDisplay(p_oEvent){if(p_oEvent.type=="mousedown"||(p_oEvent.type=="keydown"&&p_oEvent.keyCode==27)){var oTarget=Event.getTarget(p_oEvent);if(oTarget!=oParentMenu.element||!YAHOO.util.Dom.isAncestor(oParentMenu.element,oTarget)){oParentMenu.cfg.setProperty("autosubmenudisplay",false);Event.removeListener(document,"mousedown",disableAutoSubmenuDisplay);Event.removeListener(document,"keydown",disableAutoSubmenuDisplay);}}}
Event.on(document,"mousedown",disableAutoSubmenuDisplay);Event.on(document,"keydown",disableAutoSubmenuDisplay);}}},_onBeforeHide:function(p_sType,p_aArgs,p_oMenu){var oActiveItem=this.activeItem;if(oActiveItem){var oConfig=oActiveItem.cfg;oConfig.setProperty("selected",false);var oSubmenu=oConfig.getProperty("submenu");if(oSubmenu){oSubmenu.hide();}}
if(this==this.getRoot()){this.blur();}},_onHide:function(p_sType,p_aArgs,p_oMenu){if(this._nMaxHeight!=-1){this.cfg.setProperty("maxheight",this._nMaxHeight);this._nMaxHeight=-1;}},_onParentMenuConfigChange:function(p_sType,p_aArgs,p_oSubmenu){var sPropertyName=p_aArgs[0][0],oPropertyValue=p_aArgs[0][1];switch(sPropertyName){case"iframe":case"constraintoviewport":case"hidedelay":case"showdelay":case"submenuhidedelay":case"clicktohide":case"effect":case"classname":p_oSubmenu.cfg.setProperty(sPropertyName,oPropertyValue);break;}},_onParentMenuRender:function(p_sType,p_aArgs,p_oSubmenu){var oParentMenu=p_oSubmenu.parent.parent,oConfig={constraintoviewport:oParentMenu.cfg.getProperty("constraintoviewport"),xy:[0,0],clicktohide:oParentMenu.cfg.getProperty("clicktohide"),effect:oParentMenu.cfg.getProperty("effect"),showdelay:oParentMenu.cfg.getProperty("showdelay"),hidedelay:oParentMenu.cfg.getProperty("hidedelay"),submenuhidedelay:oParentMenu.cfg.getProperty("submenuhidedelay"),classname:oParentMenu.cfg.getProperty("classname")};if(this.cfg.getProperty("position")==oParentMenu.cfg.getProperty("position")){oConfig.iframe=oParentMenu.cfg.getProperty("iframe");}
p_oSubmenu.cfg.applyConfig(oConfig);if(!this.lazyLoad){var oLI=this.parent.element;if(this.element.parentNode==oLI){this.render();}
else{this.render(oLI);}}},_onSubmenuBeforeShow:function(p_sType,p_aArgs,p_oSubmenu){var oParent=this.parent,aAlignment=oParent.parent.cfg.getProperty("submenualignment");this.cfg.setProperty("context",[oParent.element,aAlignment[0],aAlignment[1]]);var nScrollTop=oParent.parent.body.scrollTop;if((this.browser=="gecko"||this.browser=="safari")&&nScrollTop>0){this.cfg.setProperty("y",(this.cfg.getProperty("y")-nScrollTop));}},_onSubmenuShow:function(p_sType,p_aArgs){this.submenuIndicator.firstChild.nodeValue=this.EXPANDED_SUBMENU_INDICATOR_TEXT;},_onSubmenuHide:function(p_sType,p_aArgs){this.submenuIndicator.firstChild.nodeValue=this.COLLAPSED_SUBMENU_INDICATOR_TEXT;},_onMenuItemFocus:function(p_sType,p_aArgs){this.parent.focusEvent.fire(this);},_onMenuItemBlur:function(p_sType,p_aArgs){this.parent.blurEvent.fire(this);},_onMenuItemConfigChange:function(p_sType,p_aArgs,p_oItem){var sPropertyName=p_aArgs[0][0],oPropertyValue=p_aArgs[0][1];switch(sPropertyName){case"selected":if(oPropertyValue===true){this.activeItem=p_oItem;}
break;case"submenu":var oSubmenu=p_aArgs[0][1];if(oSubmenu){this._configureSubmenu(p_oItem);}
break;case"text":case"helptext":if(this.element.style.width){var sWidth=this._getOffsetWidth()+"px";Dom.setStyle(this.element,"width",sWidth);}
break;}},enforceConstraints:function(type,args,obj){if(this.parent&&!(this.parent.parent instanceof YAHOO.widget.MenuBar)){var oConfig=this.cfg,pos=args[0],x=pos[0],y=pos[1],offsetHeight=this.element.offsetHeight,offsetWidth=this.element.offsetWidth,viewPortWidth=YAHOO.util.Dom.getViewportWidth(),viewPortHeight=YAHOO.util.Dom.getViewportHeight(),scrollX=Math.max(document.documentElement.scrollLeft,document.body.scrollLeft),scrollY=Math.max(document.documentElement.scrollTop,document.body.scrollTop),nPadding=(this.parent&&this.parent.parent instanceof YAHOO.widget.MenuBar)?0:10,topConstraint=scrollY+nPadding,leftConstraint=scrollX+nPadding,bottomConstraint=scrollY+viewPortHeight-offsetHeight-nPadding,rightConstraint=scrollX+viewPortWidth-offsetWidth-nPadding,aContext=oConfig.getProperty("context"),oContextElement=aContext?aContext[0]:null;if(x<10){x=leftConstraint;}else if((x+offsetWidth)>viewPortWidth){if(oContextElement&&((x-oContextElement.offsetWidth)>offsetWidth)){x=(x-(oContextElement.offsetWidth+offsetWidth));}
else{x=rightConstraint;}}
if(y<10){y=topConstraint;}else if(y>bottomConstraint){if(oContextElement&&(y>offsetHeight)){y=((y+oContextElement.offsetHeight)-offsetHeight);}
else{y=bottomConstraint;}}
oConfig.setProperty("x",x,true);oConfig.setProperty("y",y,true);oConfig.setProperty("xy",[x,y],true);}},configVisible:function(p_sType,p_aArgs,p_oMenu){if(this.cfg.getProperty("position")=="dynamic"){YAHOO.widget.Menu.superclass.configVisible.call(this,p_sType,p_aArgs,p_oMenu);}
else{var bVisible=p_aArgs[0],sDisplay=Dom.getStyle(this.element,"display");if(bVisible){if(sDisplay!="block"){this.beforeShowEvent.fire();Dom.setStyle(this.element,"display","block");this.showEvent.fire();}}
else{if(sDisplay=="block"){this.beforeHideEvent.fire();Dom.setStyle(this.element,"display","none");this.hideEvent.fire();}}}},configPosition:function(p_sType,p_aArgs,p_oMenu){var sCSSPosition=p_aArgs[0]=="static"?"static":"absolute",oCfg=this.cfg;Dom.setStyle(this.element,"position",sCSSPosition);if(sCSSPosition=="static"){oCfg.setProperty("iframe",false);Dom.setStyle(this.element,"display","block");oCfg.setProperty("visible",true);}
else{Dom.setStyle(this.element,"visibility","hidden");}
if(sCSSPosition=="absolute"){var nZIndex=oCfg.getProperty("zindex");if(!nZIndex||nZIndex===0){nZIndex=this.parent?(this.parent.parent.cfg.getProperty("zindex")+1):1;oCfg.setProperty("zindex",nZIndex);}}},configIframe:function(p_sType,p_aArgs,p_oMenu){if(this.cfg.getProperty("position")=="dynamic"){YAHOO.widget.Menu.superclass.configIframe.call(this,p_sType,p_aArgs,p_oMenu);}},configHideDelay:function(p_sType,p_aArgs,p_oMenu){var nHideDelay=p_aArgs[0],oMouseOutEvent=this.mouseOutEvent,oMouseOverEvent=this.mouseOverEvent,oKeyDownEvent=this.keyDownEvent;if(nHideDelay>0){if(!this._bHideDelayEventHandlersAssigned){oMouseOutEvent.subscribe(this._execHideDelay,this);oMouseOverEvent.subscribe(this._cancelHideDelay,this,true);oKeyDownEvent.subscribe(this._cancelHideDelay,this,true);this._bHideDelayEventHandlersAssigned=true;}}
else{oMouseOutEvent.unsubscribe(this._execHideDelay,this);oMouseOverEvent.unsubscribe(this._cancelHideDelay,this);oKeyDownEvent.unsubscribe(this._cancelHideDelay,this);this._bHideDelayEventHandlersAssigned=false;}},configContainer:function(p_sType,p_aArgs,p_oMenu){var oElement=p_aArgs[0];if(typeof oElement=='string'){this.cfg.setProperty("container",document.getElementById(oElement),true);}},_setMaxHeight:function(p_sType,p_aArgs,p_nMaxHeight){this.cfg.setProperty("maxheight",p_nMaxHeight);this.renderEvent.unsubscribe(this._setMaxHeight);},configMaxHeight:function(p_sType,p_aArgs,p_oMenu){var nMaxHeight=p_aArgs[0],oBody=this.body;if(this.lazyLoad&&!oBody){this.renderEvent.unsubscribe(this._setMaxHeight);if(nMaxHeight>0){this.renderEvent.subscribe(this._setMaxHeight,nMaxHeight,this);}
return;}
Dom.setStyle(oBody,"height","auto");Dom.setStyle(oBody,"overflow","visible");var oHeader=this.header,oFooter=this.footer,fnMouseOver=this._onScrollTargetMouseOver,fnMouseOut=this._onScrollTargetMouseOut;if((nMaxHeight>0)&&(oBody.offsetHeight>nMaxHeight)){if(!this.cfg.getProperty("width")){this._setWidth();}
if(!oHeader&&!oFooter){this.setHeader("&#32;");this.setFooter("&#32;");oHeader=this.header;oFooter=this.footer;Dom.addClass(oHeader,"topscrollbar");Dom.addClass(oFooter,"bottomscrollbar");this.element.insertBefore(oHeader,oBody);this.element.appendChild(oFooter);Event.on(oHeader,"mouseover",fnMouseOver,this,true);Event.on(oHeader,"mouseout",fnMouseOut,this,true);Event.on(oFooter,"mouseover",fnMouseOver,this,true);Event.on(oFooter,"mouseout",fnMouseOut,this,true);}
var nHeight=(nMaxHeight-
(this.footer.offsetHeight+this.header.offsetHeight));Dom.setStyle(oBody,"height",(nHeight+"px"));Dom.setStyle(oBody,"overflow","hidden");}
else if(oHeader&&oFooter){Dom.setStyle(oBody,"height","auto");Dom.setStyle(oBody,"overflow","visible");Event.removeListener(oHeader,"mouseover",fnMouseOver);Event.removeListener(oHeader,"mouseout",fnMouseOut);Event.removeListener(oFooter,"mouseover",fnMouseOver);Event.removeListener(oFooter,"mouseout",fnMouseOut);this.element.removeChild(oHeader);this.element.removeChild(oFooter);this.header=null;this.footer=null;}},configClassName:function(p_sType,p_aArgs,p_oMenu){var sClassName=p_aArgs[0];if(this._sClassName){Dom.removeClass(this.element,this._sClassName);}
Dom.addClass(this.element,sClassName);this._sClassName=sClassName;},initEvents:function(){YAHOO.widget.Menu.superclass.initEvents.call(this);var EVENT_TYPES=YAHOO.widget.Menu._EVENT_TYPES;this.mouseOverEvent=new CustomEvent(EVENT_TYPES.MOUSE_OVER,this);this.mouseOutEvent=new CustomEvent(EVENT_TYPES.MOUSE_OUT,this);this.mouseDownEvent=new CustomEvent(EVENT_TYPES.MOUSE_DOWN,this);this.mouseUpEvent=new CustomEvent(EVENT_TYPES.MOUSE_UP,this);this.clickEvent=new CustomEvent(EVENT_TYPES.CLICK,this);this.keyPressEvent=new CustomEvent(EVENT_TYPES.KEY_PRESS,this);this.keyDownEvent=new CustomEvent(EVENT_TYPES.KEY_DOWN,this);this.keyUpEvent=new CustomEvent(EVENT_TYPES.KEY_UP,this);this.focusEvent=new CustomEvent(EVENT_TYPES.FOCUS,this);this.blurEvent=new CustomEvent(EVENT_TYPES.BLUR,this);this.itemAddedEvent=new CustomEvent(EVENT_TYPES.ITEM_ADDED,this);this.itemRemovedEvent=new CustomEvent(EVENT_TYPES.ITEM_REMOVED,this);},getRoot:function(){var oItem=this.parent;if(oItem){var oParentMenu=oItem.parent;return oParentMenu?oParentMenu.getRoot():this;}
else{return this;}},toString:function(){var sReturnVal="Menu",sId=this.id;if(sId){sReturnVal+=(" "+sId);}
return sReturnVal;},setItemGroupTitle:function(p_sGroupTitle,p_nGroupIndex){if(typeof p_sGroupTitle=="string"&&p_sGroupTitle.length>0){var nGroupIndex=typeof p_nGroupIndex=="number"?p_nGroupIndex:0,oTitle=this._aGroupTitleElements[nGroupIndex];if(oTitle){oTitle.innerHTML=p_sGroupTitle;}
else{oTitle=document.createElement(this.GROUP_TITLE_TAG_NAME);oTitle.innerHTML=p_sGroupTitle;this._aGroupTitleElements[nGroupIndex]=oTitle;}
var i=this._aGroupTitleElements.length-1,nFirstIndex;do{if(this._aGroupTitleElements[i]){Dom.removeClass(this._aGroupTitleElements[i],"first-of-type");nFirstIndex=i;}}
while(i--);if(nFirstIndex!==null){Dom.addClass(this._aGroupTitleElements[nFirstIndex],"first-of-type");}}},addItem:function(p_oItem,p_nGroupIndex){if(p_oItem){return this._addItemToGroup(p_nGroupIndex,p_oItem);}},addItems:function(p_aItems,p_nGroupIndex){if(Lang.isArray(p_aItems)){var nItems=p_aItems.length,aItems=[],oItem;for(var i=0;i<nItems;i++){oItem=p_aItems[i];if(oItem){if(Lang.isArray(oItem)){aItems[aItems.length]=this.addItems(oItem,i);}
else{aItems[aItems.length]=this._addItemToGroup(p_nGroupIndex,oItem);}}}
if(aItems.length){return aItems;}}},insertItem:function(p_oItem,p_nItemIndex,p_nGroupIndex){if(p_oItem){return this._addItemToGroup(p_nGroupIndex,p_oItem,p_nItemIndex);}},removeItem:function(p_oObject,p_nGroupIndex){if(typeof p_oObject!="undefined"){var oItem;if(p_oObject instanceof YAHOO.widget.MenuItem){oItem=this._removeItemFromGroupByValue(p_nGroupIndex,p_oObject);}
else if(typeof p_oObject=="number"){oItem=this._removeItemFromGroupByIndex(p_nGroupIndex,p_oObject);}
if(oItem){oItem.destroy();return oItem;}}},getItems:function(){var aGroups=this._aItemGroups,nGroups=aGroups.length;return((nGroups==1)?aGroups[0]:(Array.prototype.concat.apply([],aGroups)));},getItemGroups:function(){return this._aItemGroups;},getItem:function(p_nItemIndex,p_nGroupIndex){if(typeof p_nItemIndex=="number"){var aGroup=this._getItemGroup(p_nGroupIndex);if(aGroup){return aGroup[p_nItemIndex];}}},clearContent:function(){var aItems=this.getItems(),nItems=aItems.length,oElement=this.element,oBody=this.body,oHeader=this.header,oFooter=this.footer;if(nItems>0){var i=nItems-1,oItem,oSubmenu;do{oItem=aItems[i];if(oItem){oSubmenu=oItem.cfg.getProperty("submenu");if(oSubmenu){this.cfg.configChangedEvent.unsubscribe(this._onParentMenuConfigChange,oSubmenu);this.renderEvent.unsubscribe(this._onParentMenuRender,oSubmenu);}
oItem.destroy();}}
while(i--);}
if(oHeader){Event.purgeElement(oHeader);oElement.removeChild(oHeader);}
if(oFooter){Event.purgeElement(oFooter);oElement.removeChild(oFooter);}
if(oBody){Event.purgeElement(oBody);oBody.innerHTML="";}
this._aItemGroups=[];this._aListElements=[];this._aGroupTitleElements=[];this.cfg.setProperty("width",null);},destroy:function(){Event.purgeElement(this.element);this.mouseOverEvent.unsubscribeAll();this.mouseOutEvent.unsubscribeAll();this.mouseDownEvent.unsubscribeAll();this.mouseUpEvent.unsubscribeAll();this.clickEvent.unsubscribeAll();this.keyPressEvent.unsubscribeAll();this.keyDownEvent.unsubscribeAll();this.keyUpEvent.unsubscribeAll();this.focusEvent.unsubscribeAll();this.blurEvent.unsubscribeAll();this.itemAddedEvent.unsubscribeAll();this.itemRemovedEvent.unsubscribeAll();this.cfg.unsubscribeFromConfigEvent("width",this._onWidthChange);this.cfg.unsubscribeFromConfigEvent("visible",this._onVisibleChange);if(this._hasSetWidthHandlers){this.itemAddedEvent.unsubscribe(this._setWidth);this.itemRemovedEvent.unsubscribe(this._setWidth);this._hasSetWidthHandlers=false;}
YAHOO.widget.Module.textResizeEvent.unsubscribe(this._onTextResize,this);this.clearContent();this._aItemGroups=null;this._aListElements=null;this._aGroupTitleElements=null;YAHOO.widget.Menu.superclass.destroy.call(this);},setInitialFocus:function(){var oItem=this._getFirstEnabledItem();if(oItem){oItem.focus();}},setInitialSelection:function(){var oItem=this._getFirstEnabledItem();if(oItem){oItem.cfg.setProperty("selected",true);}},clearActiveItem:function(p_bBlur){if(this.cfg.getProperty("showdelay")>0){this._cancelShowDelay();}
var oActiveItem=this.activeItem;if(oActiveItem){var oConfig=oActiveItem.cfg;if(p_bBlur){oActiveItem.blur();}
oConfig.setProperty("selected",false);var oSubmenu=oConfig.getProperty("submenu");if(oSubmenu){oSubmenu.hide();}
this.activeItem=null;}},focus:function(){if(!this.hasFocus()){this.setInitialFocus();}},blur:function(){if(this.hasFocus()){var oItem=YAHOO.widget.MenuManager.getFocusedMenuItem();if(oItem){oItem.blur();}}},hasFocus:function(){return(YAHOO.widget.MenuManager.getFocusedMenu()==this.getRoot());},initDefaultConfig:function(){YAHOO.widget.Menu.superclass.initDefaultConfig.call(this);var oConfig=this.cfg,DEFAULT_CONFIG=YAHOO.widget.Menu._DEFAULT_CONFIG;oConfig.addProperty(DEFAULT_CONFIG.VISIBLE.key,{handler:this.configVisible,value:DEFAULT_CONFIG.VISIBLE.value,validator:DEFAULT_CONFIG.VISIBLE.validator});oConfig.addProperty(DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.key,{handler:this.configConstrainToViewport,value:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.value,validator:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.validator,supercedes:DEFAULT_CONFIG.CONSTRAIN_TO_VIEWPORT.supercedes});oConfig.addProperty(DEFAULT_CONFIG.POSITION.key,{handler:this.configPosition,value:DEFAULT_CONFIG.POSITION.value,validator:DEFAULT_CONFIG.POSITION.validator,supercedes:DEFAULT_CONFIG.POSITION.supercedes});oConfig.addProperty(DEFAULT_CONFIG.SUBMENU_ALIGNMENT.key,{value:DEFAULT_CONFIG.SUBMENU_ALIGNMENT.value});oConfig.addProperty(DEFAULT_CONFIG.AUTO_SUBMENU_DISPLAY.key,{value:DEFAULT_CONFIG.AUTO_SUBMENU_DISPLAY.value,validator:DEFAULT_CONFIG.AUTO_SUBMENU_DISPLAY.validator});oConfig.addProperty(DEFAULT_CONFIG.SHOW_DELAY.key,{value:DEFAULT_CONFIG.SHOW_DELAY.value,validator:DEFAULT_CONFIG.SHOW_DELAY.validator});oConfig.addProperty(DEFAULT_CONFIG.HIDE_DELAY.key,{handler:this.configHideDelay,value:DEFAULT_CONFIG.HIDE_DELAY.value,validator:DEFAULT_CONFIG.HIDE_DELAY.validator,suppressEvent:DEFAULT_CONFIG.HIDE_DELAY.suppressEvent});oConfig.addProperty(DEFAULT_CONFIG.SUBMENU_HIDE_DELAY.key,{value:DEFAULT_CONFIG.SUBMENU_HIDE_DELAY.value,validator:DEFAULT_CONFIG.SUBMENU_HIDE_DELAY.validator});oConfig.addProperty(DEFAULT_CONFIG.CLICK_TO_HIDE.key,{value:DEFAULT_CONFIG.CLICK_TO_HIDE.value,validator:DEFAULT_CONFIG.CLICK_TO_HIDE.validator});oConfig.addProperty(DEFAULT_CONFIG.CONTAINER.key,{handler:this.configContainer,value:document.body});oConfig.addProperty(DEFAULT_CONFIG.MAX_HEIGHT.key,{handler:this.configMaxHeight,value:DEFAULT_CONFIG.MAX_HEIGHT.value,validator:DEFAULT_CONFIG.MAX_HEIGHT.validator});oConfig.addProperty(DEFAULT_CONFIG.CLASS_NAME.key,{handler:this.configClassName,value:DEFAULT_CONFIG.CLASS_NAME.value,validator:DEFAULT_CONFIG.CLASS_NAME.validator});}});})();(function(){var Dom=YAHOO.util.Dom,Module=YAHOO.widget.Module,Menu=YAHOO.widget.Menu,CustomEvent=YAHOO.util.CustomEvent,Lang=YAHOO.lang;YAHOO.widget.MenuItem=function(p_oObject,p_oConfig){if(p_oObject){if(p_oConfig){this.parent=p_oConfig.parent;this.value=p_oConfig.value;this.id=p_oConfig.id;}
this.init(p_oObject,p_oConfig);}};YAHOO.widget.MenuItem._EVENT_TYPES={"MOUSE_OVER":"mouseover","MOUSE_OUT":"mouseout","MOUSE_DOWN":"mousedown","MOUSE_UP":"mouseup","CLICK":"click","KEY_PRESS":"keypress","KEY_DOWN":"keydown","KEY_UP":"keyup","ITEM_ADDED":"itemAdded","ITEM_REMOVED":"itemRemoved","FOCUS":"focus","BLUR":"blur","DESTROY":"destroy"};YAHOO.widget.MenuItem._DEFAULT_CONFIG={"TEXT":{key:"text",value:"",validator:Lang.isString,suppressEvent:true},"HELP_TEXT":{key:"helptext"},"URL":{key:"url",value:"#",suppressEvent:true},"TARGET":{key:"target",suppressEvent:true},"EMPHASIS":{key:"emphasis",value:false,validator:Lang.isBoolean,suppressEvent:true},"STRONG_EMPHASIS":{key:"strongemphasis",value:false,validator:Lang.isBoolean,suppressEvent:true},"CHECKED":{key:"checked",value:false,validator:Lang.isBoolean,suppressEvent:true,supercedes:["disabled"]},"DISABLED":{key:"disabled",value:false,validator:Lang.isBoolean,suppressEvent:true},"SELECTED":{key:"selected",value:false,validator:Lang.isBoolean,suppressEvent:true},"SUBMENU":{key:"submenu"},"ONCLICK":{key:"onclick"},"CLASS_NAME":{key:"classname",value:null,validator:Lang.isString}};YAHOO.widget.MenuItem.prototype={COLLAPSED_SUBMENU_INDICATOR_TEXT:"Submenu collapsed.  Click to expand submenu.",EXPANDED_SUBMENU_INDICATOR_TEXT:"Submenu expanded.  Click to collapse submenu.",DISABLED_SUBMENU_INDICATOR_TEXT:"Submenu collapsed.  (Item disabled.)",CHECKED_TEXT:"Menu item checked.",DISABLED_CHECKED_TEXT:"Checked. (Item disabled.)",CSS_CLASS_NAME:"yuimenuitem",SUBMENU_TYPE:null,_oAnchor:null,_oText:null,_oHelpTextEM:null,_oSubmenu:null,_oCheckedIndicator:null,_oOnclickAttributeValue:null,_sClassName:null,constructor:YAHOO.widget.MenuItem,index:null,groupIndex:null,parent:null,element:null,srcElement:null,value:null,submenuIndicator:null,browser:Module.prototype.browser,id:null,destroyEvent:null,mouseOverEvent:null,mouseOutEvent:null,mouseDownEvent:null,mouseUpEvent:null,clickEvent:null,keyPressEvent:null,keyDownEvent:null,keyUpEvent:null,focusEvent:null,blurEvent:null,init:function(p_oObject,p_oConfig){if(!this.SUBMENU_TYPE){this.SUBMENU_TYPE=Menu;}
this.cfg=new YAHOO.util.Config(this);this.initDefaultConfig();var oConfig=this.cfg;if(Lang.isString(p_oObject)){this._createRootNodeStructure();oConfig.setProperty("text",p_oObject);}
else if(this._checkDOMNode(p_oObject)){switch(p_oObject.tagName.toUpperCase()){case"OPTION":this._createRootNodeStructure();oConfig.setProperty("text",p_oObject.text);this.srcElement=p_oObject;break;case"OPTGROUP":this._createRootNodeStructure();oConfig.setProperty("text",p_oObject.label);this.srcElement=p_oObject;this._initSubTree();break;case"LI":var oAnchor=this._getFirstElement(p_oObject,"A"),sURL="#",sTarget,sText;if(oAnchor){sURL=oAnchor.getAttribute("href");sTarget=oAnchor.getAttribute("target");if(oAnchor.innerText){sText=oAnchor.innerText;}
else{var oRange=oAnchor.ownerDocument.createRange();oRange.selectNodeContents(oAnchor);sText=oRange.toString();}}
else{var oText=p_oObject.firstChild;sText=oText.nodeValue;oAnchor=document.createElement("a");oAnchor.setAttribute("href",sURL);p_oObject.replaceChild(oAnchor,oText);oAnchor.appendChild(oText);}
this.srcElement=p_oObject;this.element=p_oObject;this._oAnchor=oAnchor;var oEmphasisNode=this._getFirstElement(oAnchor),bEmphasis=false,bStrongEmphasis=false;if(oEmphasisNode){this._oText=oEmphasisNode.firstChild;switch(oEmphasisNode.tagName.toUpperCase()){case"EM":bEmphasis=true;break;case"STRONG":bStrongEmphasis=true;break;}}
else{this._oText=oAnchor.firstChild;}
oConfig.setProperty("text",sText,true);oConfig.setProperty("url",sURL,true);oConfig.setProperty("target",sTarget,true);oConfig.setProperty("emphasis",bEmphasis,true);oConfig.setProperty("strongemphasis",bStrongEmphasis,true);this._initSubTree();break;}}
if(this.element){var sId=this.element.id;if(!sId){sId=this.id||Dom.generateId();this.element.id=sId;}
this.id=sId;Dom.addClass(this.element,this.CSS_CLASS_NAME);var EVENT_TYPES=YAHOO.widget.MenuItem._EVENT_TYPES;this.mouseOverEvent=new CustomEvent(EVENT_TYPES.MOUSE_OVER,this);this.mouseOutEvent=new CustomEvent(EVENT_TYPES.MOUSE_OUT,this);this.mouseDownEvent=new CustomEvent(EVENT_TYPES.MOUSE_DOWN,this);this.mouseUpEvent=new CustomEvent(EVENT_TYPES.MOUSE_UP,this);this.clickEvent=new CustomEvent(EVENT_TYPES.CLICK,this);this.keyPressEvent=new CustomEvent(EVENT_TYPES.KEY_PRESS,this);this.keyDownEvent=new CustomEvent(EVENT_TYPES.KEY_DOWN,this);this.keyUpEvent=new CustomEvent(EVENT_TYPES.KEY_UP,this);this.focusEvent=new CustomEvent(EVENT_TYPES.FOCUS,this);this.blurEvent=new CustomEvent(EVENT_TYPES.BLUR,this);this.destroyEvent=new CustomEvent(EVENT_TYPES.DESTROY,this);if(p_oConfig){oConfig.applyConfig(p_oConfig);}
oConfig.fireQueue();}},_getFirstElement:function(p_oElement,p_sTagName){var oFirstChild=p_oElement.firstChild,oElement;if(oFirstChild){if(oFirstChild.nodeType==1){oElement=oFirstChild;}
else{var oNextSibling=oFirstChild.nextSibling;if(oNextSibling&&oNextSibling.nodeType==1){oElement=oNextSibling;}}}
if(p_sTagName){return(oElement&&oElement.tagName.toUpperCase()==p_sTagName)?oElement:false;}
return oElement;},_checkDOMNode:function(p_oObject){return(p_oObject&&p_oObject.tagName);},_createRootNodeStructure:function(){var oTemplate=YAHOO.widget.MenuItem._MenuItemTemplate;if(!oTemplate){oTemplate=document.createElement("li");oTemplate.innerHTML="<a href=\"#\">s</a>";YAHOO.widget.MenuItem._MenuItemTemplate=oTemplate;}
this.element=oTemplate.cloneNode(true);this._oAnchor=this.element.firstChild;this._oText=this._oAnchor.firstChild;this.element.appendChild(this._oAnchor);},_initSubTree:function(){var oSrcEl=this.srcElement,oConfig=this.cfg;if(oSrcEl.childNodes.length>0){if(this.parent.lazyLoad&&this.parent.srcElement&&this.parent.srcElement.tagName.toUpperCase()=="SELECT"){oConfig.setProperty("submenu",{id:Dom.generateId(),itemdata:oSrcEl.childNodes});}
else{var oNode=oSrcEl.firstChild,aOptions=[];do{if(oNode&&oNode.tagName){switch(oNode.tagName.toUpperCase()){case"DIV":oConfig.setProperty("submenu",oNode);break;case"OPTION":aOptions[aOptions.length]=oNode;break;}}}
while((oNode=oNode.nextSibling));var nOptions=aOptions.length;if(nOptions>0){var oMenu=new this.SUBMENU_TYPE(Dom.generateId());oConfig.setProperty("submenu",oMenu);for(var n=0;n<nOptions;n++){oMenu.addItem((new oMenu.ITEM_TYPE(aOptions[n])));}}}}},configText:function(p_sType,p_aArgs,p_oItem){var sText=p_aArgs[0];if(this._oText){this._oText.nodeValue=sText;}},configHelpText:function(p_sType,p_aArgs,p_oItem){var me=this,oHelpText=p_aArgs[0],oEl=this.element,oConfig=this.cfg,aNodes=[oEl,this._oAnchor],oSubmenuIndicator=this.submenuIndicator;function initHelpText(){Dom.addClass(aNodes,"hashelptext");if(oConfig.getProperty("disabled")){oConfig.refireEvent("disabled");}
if(oConfig.getProperty("selected")){oConfig.refireEvent("selected");}}
function removeHelpText(){Dom.removeClass(aNodes,"hashelptext");oEl.removeChild(me._oHelpTextEM);me._oHelpTextEM=null;}
if(this._checkDOMNode(oHelpText)){oHelpText.className="helptext";if(this._oHelpTextEM){this._oHelpTextEM.parentNode.replaceChild(oHelpText,this._oHelpTextEM);}
else{this._oHelpTextEM=oHelpText;oEl.insertBefore(this._oHelpTextEM,oSubmenuIndicator);}
initHelpText();}
else if(Lang.isString(oHelpText)){if(oHelpText.length===0){removeHelpText();}
else{if(!this._oHelpTextEM){this._oHelpTextEM=document.createElement("em");this._oHelpTextEM.className="helptext";oEl.insertBefore(this._oHelpTextEM,oSubmenuIndicator);}
this._oHelpTextEM.innerHTML=oHelpText;initHelpText();}}
else if(!oHelpText&&this._oHelpTextEM){removeHelpText();}},configURL:function(p_sType,p_aArgs,p_oItem){var sURL=p_aArgs[0];if(!sURL){sURL="#";}
this._oAnchor.setAttribute("href",sURL);},configTarget:function(p_sType,p_aArgs,p_oItem){var sTarget=p_aArgs[0],oAnchor=this._oAnchor;if(sTarget&&sTarget.length>0){oAnchor.setAttribute("target",sTarget);}
else{oAnchor.removeAttribute("target");}},configEmphasis:function(p_sType,p_aArgs,p_oItem){var bEmphasis=p_aArgs[0],oAnchor=this._oAnchor,oText=this._oText,oConfig=this.cfg,oEM;if(bEmphasis&&oConfig.getProperty("strongemphasis")){oConfig.setProperty("strongemphasis",false);}
if(oAnchor){if(bEmphasis){oEM=document.createElement("em");oEM.appendChild(oText);oAnchor.appendChild(oEM);}
else{oEM=this._getFirstElement(oAnchor,"EM");if(oEM){oAnchor.removeChild(oEM);oAnchor.appendChild(oText);}}}},configStrongEmphasis:function(p_sType,p_aArgs,p_oItem){var bStrongEmphasis=p_aArgs[0],oAnchor=this._oAnchor,oText=this._oText,oConfig=this.cfg,oStrong;if(bStrongEmphasis&&oConfig.getProperty("emphasis")){oConfig.setProperty("emphasis",false);}
if(oAnchor){if(bStrongEmphasis){oStrong=document.createElement("strong");oStrong.appendChild(oText);oAnchor.appendChild(oStrong);}
else{oStrong=this._getFirstElement(oAnchor,"STRONG");if(oStrong){oAnchor.removeChild(oStrong);oAnchor.appendChild(oText);}}}},configChecked:function(p_sType,p_aArgs,p_oItem){var bChecked=p_aArgs[0],oEl=this.element,oConfig=this.cfg,oEM;if(bChecked){var oTemplate=YAHOO.widget.MenuItem._CheckedIndicatorTemplate;if(!oTemplate){oTemplate=document.createElement("em");oTemplate.innerHTML=this.CHECKED_TEXT;oTemplate.className="checkedindicator";YAHOO.widget.MenuItem._CheckedIndicatorTemplate=oTemplate;}
oEM=oTemplate.cloneNode(true);var oSubmenu=this.cfg.getProperty("submenu");if(oSubmenu&&oSubmenu.element){oEl.insertBefore(oEM,oSubmenu.element);}
else{oEl.appendChild(oEM);}
Dom.addClass(oEl,"checked");this._oCheckedIndicator=oEM;if(oConfig.getProperty("disabled")){oConfig.refireEvent("disabled");}
if(oConfig.getProperty("selected")){oConfig.refireEvent("selected");}}
else{oEM=this._oCheckedIndicator;Dom.removeClass(oEl,"checked");if(oEM){oEl.removeChild(oEM);}
this._oCheckedIndicator=null;}},configDisabled:function(p_sType,p_aArgs,p_oItem){var bDisabled=p_aArgs[0],oConfig=this.cfg,oAnchor=this._oAnchor,aNodes=[this.element,oAnchor],oHelpText=this._oHelpTextEM,oCheckedIndicator=this._oCheckedIndicator,oSubmenuIndicator=this.submenuIndicator,i=1;if(oHelpText){i++;aNodes[i]=oHelpText;}
if(oCheckedIndicator){oCheckedIndicator.firstChild.nodeValue=bDisabled?this.DISABLED_CHECKED_TEXT:this.CHECKED_TEXT;i++;aNodes[i]=oCheckedIndicator;}
if(oSubmenuIndicator){oSubmenuIndicator.firstChild.nodeValue=bDisabled?this.DISABLED_SUBMENU_INDICATOR_TEXT:this.COLLAPSED_SUBMENU_INDICATOR_TEXT;i++;aNodes[i]=oSubmenuIndicator;}
if(bDisabled){if(oConfig.getProperty("selected")){oConfig.setProperty("selected",false);}
oAnchor.removeAttribute("href");Dom.addClass(aNodes,"disabled");}
else{oAnchor.setAttribute("href",oConfig.getProperty("url"));Dom.removeClass(aNodes,"disabled");}},configSelected:function(p_sType,p_aArgs,p_oItem){if(!this.cfg.getProperty("disabled")){var bSelected=p_aArgs[0],oHelpText=this._oHelpTextEM,oSubmenuIndicator=this.submenuIndicator,oCheckedIndicator=this._oCheckedIndicator,aNodes=[this.element,this._oAnchor],i=1;if(oHelpText){i++;aNodes[i]=oHelpText;}
if(oSubmenuIndicator){i++;aNodes[i]=oSubmenuIndicator;}
if(oCheckedIndicator){i++;aNodes[i]=oCheckedIndicator;}
if(bSelected){Dom.addClass(aNodes,"selected");}
else{Dom.removeClass(aNodes,"selected");}}},configSubmenu:function(p_sType,p_aArgs,p_oItem){var oEl=this.element,oSubmenu=p_aArgs[0],oSubmenuIndicator=this.submenuIndicator,oConfig=this.cfg,aNodes=[this.element,this._oAnchor],bLazyLoad=this.parent&&this.parent.lazyLoad,oMenu;if(oSubmenu){if(oSubmenu instanceof Menu){oMenu=oSubmenu;oMenu.parent=this;oMenu.lazyLoad=bLazyLoad;}
else if(typeof oSubmenu=="object"&&oSubmenu.id&&!oSubmenu.nodeType){var sSubmenuId=oSubmenu.id,oSubmenuConfig=oSubmenu;oSubmenuConfig.lazyload=bLazyLoad;oSubmenuConfig.parent=this;oMenu=new this.SUBMENU_TYPE(sSubmenuId,oSubmenuConfig);this.cfg.setProperty("submenu",oMenu,true);}
else{oMenu=new this.SUBMENU_TYPE(oSubmenu,{lazyload:bLazyLoad,parent:this});this.cfg.setProperty("submenu",oMenu,true);}
if(oMenu){this._oSubmenu=oMenu;if(!oSubmenuIndicator){var oTemplate=YAHOO.widget.MenuItem._oSubmenuIndicatorTemplate;if(!oTemplate){oTemplate=document.createElement("em");oTemplate.innerHTML=this.COLLAPSED_SUBMENU_INDICATOR_TEXT;oTemplate.className="submenuindicator";YAHOO.widget.MenuItem._oSubmenuIndicatorTemplate=oTemplate;}
oSubmenuIndicator=oTemplate.cloneNode(true);if(oMenu.element.parentNode==oEl){if(this.browser=="opera"){oEl.appendChild(oSubmenuIndicator);oMenu.renderEvent.subscribe(function(){oSubmenuIndicator.parentNode.insertBefore(oSubmenuIndicator,oMenu.element);});}
else{oEl.insertBefore(oSubmenuIndicator,oMenu.element);}}
else{oEl.appendChild(oSubmenuIndicator);}
this.submenuIndicator=oSubmenuIndicator;}
Dom.addClass(aNodes,"hassubmenu");if(oConfig.getProperty("disabled")){oConfig.refireEvent("disabled");}
if(oConfig.getProperty("selected")){oConfig.refireEvent("selected");}}}
else{Dom.removeClass(aNodes,"hassubmenu");if(oSubmenuIndicator){oEl.removeChild(oSubmenuIndicator);}
if(this._oSubmenu){this._oSubmenu.destroy();}}},configOnClick:function(p_sType,p_aArgs,p_oItem){var oObject=p_aArgs[0];if(this._oOnclickAttributeValue&&(this._oOnclickAttributeValue!=oObject)){this.clickEvent.unsubscribe(this._oOnclickAttributeValue.fn,this._oOnclickAttributeValue.obj);this._oOnclickAttributeValue=null;}
if(!this._oOnclickAttributeValue&&typeof oObject=="object"&&typeof oObject.fn=="function"){this.clickEvent.subscribe(oObject.fn,(oObject.obj||this),oObject.scope);this._oOnclickAttributeValue=oObject;}},configClassName:function(p_sType,p_aArgs,p_oItem){var sClassName=p_aArgs[0];if(this._sClassName){Dom.removeClass(this.element,this._sClassName);}
Dom.addClass(this.element,sClassName);this._sClassName=sClassName;},initDefaultConfig:function(){var oConfig=this.cfg,DEFAULT_CONFIG=YAHOO.widget.MenuItem._DEFAULT_CONFIG;oConfig.addProperty(DEFAULT_CONFIG.TEXT.key,{handler:this.configText,value:DEFAULT_CONFIG.TEXT.value,validator:DEFAULT_CONFIG.TEXT.validator,suppressEvent:DEFAULT_CONFIG.TEXT.suppressEvent});oConfig.addProperty(DEFAULT_CONFIG.HELP_TEXT.key,{handler:this.configHelpText});oConfig.addProperty(DEFAULT_CONFIG.URL.key,{handler:this.configURL,value:DEFAULT_CONFIG.URL.value,suppressEvent:DEFAULT_CONFIG.URL.suppressEvent});oConfig.addProperty(DEFAULT_CONFIG.TARGET.key,{handler:this.configTarget,suppressEvent:DEFAULT_CONFIG.TARGET.suppressEvent});oConfig.addProperty(DEFAULT_CONFIG.EMPHASIS.key,{handler:this.configEmphasis,value:DEFAULT_CONFIG.EMPHASIS.value,validator:DEFAULT_CONFIG.EMPHASIS.validator,suppressEvent:DEFAULT_CONFIG.EMPHASIS.suppressEvent});oConfig.addProperty(DEFAULT_CONFIG.STRONG_EMPHASIS.key,{handler:this.configStrongEmphasis,value:DEFAULT_CONFIG.STRONG_EMPHASIS.value,validator:DEFAULT_CONFIG.STRONG_EMPHASIS.validator,suppressEvent:DEFAULT_CONFIG.STRONG_EMPHASIS.suppressEvent});oConfig.addProperty(DEFAULT_CONFIG.CHECKED.key,{handler:this.configChecked,value:DEFAULT_CONFIG.CHECKED.value,validator:DEFAULT_CONFIG.CHECKED.validator,suppressEvent:DEFAULT_CONFIG.CHECKED.suppressEvent,supercedes:DEFAULT_CONFIG.CHECKED.supercedes});oConfig.addProperty(DEFAULT_CONFIG.DISABLED.key,{handler:this.configDisabled,value:DEFAULT_CONFIG.DISABLED.value,validator:DEFAULT_CONFIG.DISABLED.validator,suppressEvent:DEFAULT_CONFIG.DISABLED.suppressEvent});oConfig.addProperty(DEFAULT_CONFIG.SELECTED.key,{handler:this.configSelected,value:DEFAULT_CONFIG.SELECTED.value,validator:DEFAULT_CONFIG.SELECTED.validator,suppressEvent:DEFAULT_CONFIG.SELECTED.suppressEvent});oConfig.addProperty(DEFAULT_CONFIG.SUBMENU.key,{handler:this.configSubmenu});oConfig.addProperty(DEFAULT_CONFIG.ONCLICK.key,{handler:this.configOnClick});oConfig.addProperty(DEFAULT_CONFIG.CLASS_NAME.key,{handler:this.configClassName,value:DEFAULT_CONFIG.CLASS_NAME.value,validator:DEFAULT_CONFIG.CLASS_NAME.validator});},getNextEnabledSibling:function(){if(this.parent instanceof Menu){var nGroupIndex=this.groupIndex;function getNextArrayItem(p_aArray,p_nStartIndex){return p_aArray[p_nStartIndex]||getNextArrayItem(p_aArray,(p_nStartIndex+1));}
var aItemGroups=this.parent.getItemGroups(),oNextItem;if(this.index<(aItemGroups[nGroupIndex].length-1)){oNextItem=getNextArrayItem(aItemGroups[nGroupIndex],(this.index+1));}
else{var nNextGroupIndex;if(nGroupIndex<(aItemGroups.length-1)){nNextGroupIndex=nGroupIndex+1;}
else{nNextGroupIndex=0;}
var aNextGroup=getNextArrayItem(aItemGroups,nNextGroupIndex);oNextItem=getNextArrayItem(aNextGroup,0);}
return(oNextItem.cfg.getProperty("disabled")||oNextItem.element.style.display=="none")?oNextItem.getNextEnabledSibling():oNextItem;}},getPreviousEnabledSibling:function(){if(this.parent instanceof Menu){var nGroupIndex=this.groupIndex;function getPreviousArrayItem(p_aArray,p_nStartIndex){return p_aArray[p_nStartIndex]||getPreviousArrayItem(p_aArray,(p_nStartIndex-1));}
function getFirstItemIndex(p_aArray,p_nStartIndex){return p_aArray[p_nStartIndex]?p_nStartIndex:getFirstItemIndex(p_aArray,(p_nStartIndex+1));}
var aItemGroups=this.parent.getItemGroups(),oPreviousItem;if(this.index>getFirstItemIndex(aItemGroups[nGroupIndex],0)){oPreviousItem=getPreviousArrayItem(aItemGroups[nGroupIndex],(this.index-1));}
else{var nPreviousGroupIndex;if(nGroupIndex>getFirstItemIndex(aItemGroups,0)){nPreviousGroupIndex=nGroupIndex-1;}
else{nPreviousGroupIndex=aItemGroups.length-1;}
var aPreviousGroup=getPreviousArrayItem(aItemGroups,nPreviousGroupIndex);oPreviousItem=getPreviousArrayItem(aPreviousGroup,(aPreviousGroup.length-1));}
return(oPreviousItem.cfg.getProperty("disabled")||oPreviousItem.element.style.display=="none")?oPreviousItem.getPreviousEnabledSibling():oPreviousItem;}},focus:function(){var oParent=this.parent,oAnchor=this._oAnchor,oActiveItem=oParent.activeItem,me=this;function setFocus(){try{if((me.browser=="ie"||me.browser=="ie7")&&!document.hasFocus()){return;}
oAnchor.focus();}
catch(e){}}
if(!this.cfg.getProperty("disabled")&&oParent&&oParent.cfg.getProperty("visible")&&this.element.style.display!="none"){if(oActiveItem){oActiveItem.blur();}
window.setTimeout(setFocus,0);this.focusEvent.fire();}},blur:function(){var oParent=this.parent;if(!this.cfg.getProperty("disabled")&&oParent&&Dom.getStyle(oParent.element,"visibility")=="visible"){this._oAnchor.blur();this.blurEvent.fire();}},hasFocus:function(){return(YAHOO.widget.MenuManager.getFocusedMenuItem()==this);},destroy:function(){var oEl=this.element;if(oEl){var oSubmenu=this.cfg.getProperty("submenu");if(oSubmenu){oSubmenu.destroy();}
this.mouseOverEvent.unsubscribeAll();this.mouseOutEvent.unsubscribeAll();this.mouseDownEvent.unsubscribeAll();this.mouseUpEvent.unsubscribeAll();this.clickEvent.unsubscribeAll();this.keyPressEvent.unsubscribeAll();this.keyDownEvent.unsubscribeAll();this.keyUpEvent.unsubscribeAll();this.focusEvent.unsubscribeAll();this.blurEvent.unsubscribeAll();this.cfg.configChangedEvent.unsubscribeAll();var oParentNode=oEl.parentNode;if(oParentNode){oParentNode.removeChild(oEl);this.destroyEvent.fire();}
this.destroyEvent.unsubscribeAll();}},toString:function(){var sReturnVal="MenuItem";if(this.cfg&&this.cfg.getProperty("text")){sReturnVal+=(": "+this.cfg.getProperty("text"));}
return sReturnVal;}};})();YAHOO.widget.ContextMenu=function(p_oElement,p_oConfig){YAHOO.widget.ContextMenu.superclass.constructor.call(this,p_oElement,p_oConfig);};YAHOO.widget.ContextMenu._EVENT_TYPES={"TRIGGER_CONTEXT_MENU":"triggerContextMenu","CONTEXT_MENU":((YAHOO.widget.Module.prototype.browser=="opera"?"mousedown":"contextmenu")),"CLICK":"click"};YAHOO.widget.ContextMenu._DEFAULT_CONFIG={"TRIGGER":{key:"trigger"}};YAHOO.lang.extend(YAHOO.widget.ContextMenu,YAHOO.widget.Menu,{_oTrigger:null,_bCancelled:false,contextEventTarget:null,triggerContextMenuEvent:null,init:function(p_oElement,p_oConfig){if(!this.ITEM_TYPE){this.ITEM_TYPE=YAHOO.widget.ContextMenuItem;}
YAHOO.widget.ContextMenu.superclass.init.call(this,p_oElement);this.beforeInitEvent.fire(YAHOO.widget.ContextMenu);if(p_oConfig){this.cfg.applyConfig(p_oConfig,true);}
this.initEvent.fire(YAHOO.widget.ContextMenu);},initEvents:function(){YAHOO.widget.ContextMenu.superclass.initEvents.call(this);this.triggerContextMenuEvent=new YAHOO.util.CustomEvent(YAHOO.widget.ContextMenu._EVENT_TYPES.TRIGGER_CONTEXT_MENU,this);},cancel:function(){this._bCancelled=true;},_removeEventHandlers:function(){var Event=YAHOO.util.Event,oTrigger=this._oTrigger;if(oTrigger){Event.removeListener(oTrigger,YAHOO.widget.ContextMenu._EVENT_TYPES.CONTEXT_MENU,this._onTriggerContextMenu);if(this.browser=="opera"){Event.removeListener(oTrigger,YAHOO.widget.ContextMenu._EVENT_TYPES.CLICK,this._onTriggerClick);}}},_onTriggerClick:function(p_oEvent,p_oMenu){if(p_oEvent.ctrlKey){YAHOO.util.Event.stopEvent(p_oEvent);}},_onTriggerContextMenu:function(p_oEvent,p_oMenu){var Event=YAHOO.util.Event;if(p_oEvent.type=="mousedown"&&!p_oEvent.ctrlKey){return;}
Event.stopEvent(p_oEvent);YAHOO.widget.MenuManager.hideVisible();this.contextEventTarget=Event.getTarget(p_oEvent);this.triggerContextMenuEvent.fire(p_oEvent);if(!this._bCancelled){this.cfg.setProperty("xy",Event.getXY(p_oEvent));this.show();}
this._bCancelled=false;},toString:function(){var sReturnVal="ContextMenu",sId=this.id;if(sId){sReturnVal+=(" "+sId);}
return sReturnVal;},initDefaultConfig:function(){YAHOO.widget.ContextMenu.superclass.initDefaultConfig.call(this);this.cfg.addProperty(YAHOO.widget.ContextMenu._DEFAULT_CONFIG.TRIGGER.key,{handler:this.configTrigger});},destroy:function(){this._removeEventHandlers();YAHOO.widget.ContextMenu.superclass.destroy.call(this);},configTrigger:function(p_sType,p_aArgs,p_oMenu){var Event=YAHOO.util.Event,oTrigger=p_aArgs[0];if(oTrigger){if(this._oTrigger){this._removeEventHandlers();}
this._oTrigger=oTrigger;Event.on(oTrigger,YAHOO.widget.ContextMenu._EVENT_TYPES.CONTEXT_MENU,this._onTriggerContextMenu,this,true);if(this.browser=="opera"){Event.on(oTrigger,YAHOO.widget.ContextMenu._EVENT_TYPES.CLICK,this._onTriggerClick,this,true);}}
else{this._removeEventHandlers();}}});YAHOO.widget.ContextMenuItem=function(p_oObject,p_oConfig){YAHOO.widget.ContextMenuItem.superclass.constructor.call(this,p_oObject,p_oConfig);};YAHOO.lang.extend(YAHOO.widget.ContextMenuItem,YAHOO.widget.MenuItem,{init:function(p_oObject,p_oConfig){if(!this.SUBMENU_TYPE){this.SUBMENU_TYPE=YAHOO.widget.ContextMenu;}
YAHOO.widget.ContextMenuItem.superclass.init.call(this,p_oObject);var oConfig=this.cfg;if(p_oConfig){oConfig.applyConfig(p_oConfig,true);}
oConfig.fireQueue();},toString:function(){var sReturnVal="ContextMenuItem";if(this.cfg&&this.cfg.getProperty("text")){sReturnVal+=(": "+this.cfg.getProperty("text"));}
return sReturnVal;}});YAHOO.widget.MenuBar=function(p_oElement,p_oConfig){YAHOO.widget.MenuBar.superclass.constructor.call(this,p_oElement,p_oConfig);};YAHOO.widget.MenuBar._DEFAULT_CONFIG={"POSITION":{key:"position",value:"static",validator:YAHOO.widget.Menu._checkPosition,supercedes:["visible"]},"SUBMENU_ALIGNMENT":{key:"submenualignment",value:["tl","bl"]},"AUTO_SUBMENU_DISPLAY":{key:"autosubmenudisplay",value:false,validator:YAHOO.lang.isBoolean}};YAHOO.lang.extend(YAHOO.widget.MenuBar,YAHOO.widget.Menu,{init:function(p_oElement,p_oConfig){if(!this.ITEM_TYPE){this.ITEM_TYPE=YAHOO.widget.MenuBarItem;}
YAHOO.widget.MenuBar.superclass.init.call(this,p_oElement);this.beforeInitEvent.fire(YAHOO.widget.MenuBar);if(p_oConfig){this.cfg.applyConfig(p_oConfig,true);}
this.initEvent.fire(YAHOO.widget.MenuBar);},CSS_CLASS_NAME:"yuimenubar",_onKeyDown:function(p_sType,p_aArgs,p_oMenuBar){var Event=YAHOO.util.Event,oEvent=p_aArgs[0],oItem=p_aArgs[1],oSubmenu;if(oItem&&!oItem.cfg.getProperty("disabled")){var oItemCfg=oItem.cfg;switch(oEvent.keyCode){case 37:case 39:if(oItem==this.activeItem&&!oItemCfg.getProperty("selected")){oItemCfg.setProperty("selected",true);}
else{var oNextItem=(oEvent.keyCode==37)?oItem.getPreviousEnabledSibling():oItem.getNextEnabledSibling();if(oNextItem){this.clearActiveItem();oNextItem.cfg.setProperty("selected",true);if(this.cfg.getProperty("autosubmenudisplay")){oSubmenu=oNextItem.cfg.getProperty("submenu");if(oSubmenu){oSubmenu.show();}}
oNextItem.focus();}}
Event.preventDefault(oEvent);break;case 40:if(this.activeItem!=oItem){this.clearActiveItem();oItemCfg.setProperty("selected",true);oItem.focus();}
oSubmenu=oItemCfg.getProperty("submenu");if(oSubmenu){if(oSubmenu.cfg.getProperty("visible")){oSubmenu.setInitialSelection();oSubmenu.setInitialFocus();}
else{oSubmenu.show();}}
Event.preventDefault(oEvent);break;}}
if(oEvent.keyCode==27&&this.activeItem){oSubmenu=this.activeItem.cfg.getProperty("submenu");if(oSubmenu&&oSubmenu.cfg.getProperty("visible")){oSubmenu.hide();this.activeItem.focus();}
else{this.activeItem.cfg.setProperty("selected",false);this.activeItem.blur();}
Event.preventDefault(oEvent);}},_onClick:function(p_sType,p_aArgs,p_oMenuBar){YAHOO.widget.MenuBar.superclass._onClick.call(this,p_sType,p_aArgs,p_oMenuBar);var oItem=p_aArgs[1];if(oItem&&!oItem.cfg.getProperty("disabled")){var Event=YAHOO.util.Event,Dom=YAHOO.util.Dom,oEvent=p_aArgs[0],oTarget=Event.getTarget(oEvent),oActiveItem=this.activeItem,oConfig=this.cfg;if(oActiveItem&&oActiveItem!=oItem){this.clearActiveItem();}
oItem.cfg.setProperty("selected",true);var oSubmenu=oItem.cfg.getProperty("submenu");if(oSubmenu&&oTarget!=oItem.submenuIndicator){if(oSubmenu.cfg.getProperty("visible")){oSubmenu.hide();}
else{oSubmenu.show();}}}},toString:function(){var sReturnVal="MenuBar",sId=this.id;if(sId){sReturnVal+=(" "+sId);}
return sReturnVal;},initDefaultConfig:function(){YAHOO.widget.MenuBar.superclass.initDefaultConfig.call(this);var oConfig=this.cfg,DEFAULT_CONFIG=YAHOO.widget.MenuBar._DEFAULT_CONFIG;oConfig.addProperty(DEFAULT_CONFIG.POSITION.key,{handler:this.configPosition,value:DEFAULT_CONFIG.POSITION.value,validator:DEFAULT_CONFIG.POSITION.validator,supercedes:DEFAULT_CONFIG.POSITION.supercedes});oConfig.addProperty(DEFAULT_CONFIG.SUBMENU_ALIGNMENT.key,{value:DEFAULT_CONFIG.SUBMENU_ALIGNMENT.value});oConfig.addProperty(DEFAULT_CONFIG.AUTO_SUBMENU_DISPLAY.key,{value:DEFAULT_CONFIG.AUTO_SUBMENU_DISPLAY.value,validator:DEFAULT_CONFIG.AUTO_SUBMENU_DISPLAY.validator});}});YAHOO.widget.MenuBarItem=function(p_oObject,p_oConfig){YAHOO.widget.MenuBarItem.superclass.constructor.call(this,p_oObject,p_oConfig);};YAHOO.lang.extend(YAHOO.widget.MenuBarItem,YAHOO.widget.MenuItem,{init:function(p_oObject,p_oConfig){if(!this.SUBMENU_TYPE){this.SUBMENU_TYPE=YAHOO.widget.Menu;}
YAHOO.widget.MenuBarItem.superclass.init.call(this,p_oObject);var oConfig=this.cfg;if(p_oConfig){oConfig.applyConfig(p_oConfig,true);}
oConfig.fireQueue();},CSS_CLASS_NAME:"yuimenubaritem",toString:function(){var sReturnVal="MenuBarItem";if(this.cfg&&this.cfg.getProperty("text")){sReturnVal+=(": "+this.cfg.getProperty("text"));}
return sReturnVal;}});YAHOO.register("menu",YAHOO.widget.Menu,{version:"2.2.2",build:"204"});
// element-beta-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

YAHOO.util.Attribute=function(hash,owner){if(owner){this.owner=owner;this.configure(hash,true);}};YAHOO.util.Attribute.prototype={name:undefined,value:null,owner:null,readOnly:false,writeOnce:false,_initialConfig:null,_written:false,method:null,validator:null,getValue:function(){return this.value;},setValue:function(value,silent){var beforeRetVal;var owner=this.owner;var name=this.name;var event={type:name,prevValue:this.getValue(),newValue:value};if(this.readOnly||(this.writeOnce&&this._written)){return false;}
if(this.validator&&!this.validator.call(owner,value)){return false;}
if(!silent){beforeRetVal=owner.fireBeforeChangeEvent(event);if(beforeRetVal===false){return false;}}
if(this.method){this.method.call(owner,value);}
this.value=value;this._written=true;event.type=name;if(!silent){this.owner.fireChangeEvent(event);}
return true;},configure:function(map,init){map=map||{};this._written=false;this._initialConfig=this._initialConfig||{};for(var key in map){if(key&&YAHOO.lang.hasOwnProperty(map,key)){this[key]=map[key];if(init){this._initialConfig[key]=map[key];}}}},resetValue:function(){return this.setValue(this._initialConfig.value);},resetConfig:function(){this.configure(this._initialConfig);},refresh:function(silent){this.setValue(this.value,silent);}};(function(){var Lang=YAHOO.util.Lang;YAHOO.util.AttributeProvider=function(){};YAHOO.util.AttributeProvider.prototype={_configs:null,get:function(key){var configs=this._configs||{};var config=configs[key];if(!config){return undefined;}
return config.value;},set:function(key,value,silent){var configs=this._configs||{};var config=configs[key];if(!config){return false;}
return config.setValue(value,silent);},getAttributeKeys:function(){var configs=this._configs;var keys=[];var config;for(var key in configs){config=configs[key];if(Lang.hasOwnProperty(configs,key)&&!Lang.isUndefined(config)){keys[keys.length]=key;}}
return keys;},setAttributes:function(map,silent){for(var key in map){if(Lang.hasOwnProperty(map,key)){this.set(key,map[key],silent);}}},resetValue:function(key,silent){var configs=this._configs||{};if(configs[key]){this.set(key,configs[key]._initialConfig.value,silent);return true;}
return false;},refresh:function(key,silent){var configs=this._configs;key=((Lang.isString(key))?[key]:key)||this.getAttributeKeys();for(var i=0,len=key.length;i<len;++i){if(configs[key[i]]&&!Lang.isUndefined(configs[key[i]].value)&&!Lang.isNull(configs[key[i]].value)){configs[key[i]].refresh(silent);}}},register:function(key,map){this.setAttributeConfig(key,map);},getAttributeConfig:function(key){var configs=this._configs||{};var config=configs[key]||{};var map={};for(key in config){if(Lang.hasOwnProperty(config,key)){map[key]=config[key];}}
return map;},setAttributeConfig:function(key,map,init){var configs=this._configs||{};map=map||{};if(!configs[key]){map.name=key;configs[key]=new YAHOO.util.Attribute(map,this);}else{configs[key].configure(map,init);}},configureAttribute:function(key,map,init){this.setAttributeConfig(key,map,init);},resetAttributeConfig:function(key){var configs=this._configs||{};configs[key].resetConfig();},fireBeforeChangeEvent:function(e){var type='before';type+=e.type.charAt(0).toUpperCase()+e.type.substr(1)+'Change';e.type=type;return this.fireEvent(e.type,e);},fireChangeEvent:function(e){e.type+='Change';return this.fireEvent(e.type,e);}};YAHOO.augment(YAHOO.util.AttributeProvider,YAHOO.util.EventProvider);})();(function(){var Dom=YAHOO.util.Dom,AttributeProvider=YAHOO.util.AttributeProvider;YAHOO.util.Element=function(el,map){if(arguments.length){this.init(el,map);}};YAHOO.util.Element.prototype={DOM_EVENTS:null,appendChild:function(child){child=child.get?child.get('element'):child;this.get('element').appendChild(child);},getElementsByTagName:function(tag){return this.get('element').getElementsByTagName(tag);},hasChildNodes:function(){return this.get('element').hasChildNodes();},insertBefore:function(element,before){element=element.get?element.get('element'):element;before=(before&&before.get)?before.get('element'):before;this.get('element').insertBefore(element,before);},removeChild:function(child){child=child.get?child.get('element'):child;this.get('element').removeChild(child);return true;},replaceChild:function(newNode,oldNode){newNode=newNode.get?newNode.get('element'):newNode;oldNode=oldNode.get?oldNode.get('element'):oldNode;return this.get('element').replaceChild(newNode,oldNode);},initAttributes:function(map){},addListener:function(type,fn,obj,scope){var el=this.get('element');scope=scope||this;el=this.get('id')||el;var self=this;if(!this._events[type]){if(this.DOM_EVENTS[type]){YAHOO.util.Event.addListener(el,type,function(e){if(e.srcElement&&!e.target){e.target=e.srcElement;}
self.fireEvent(type,e);},obj,scope);}
this.createEvent(type,this);}
this.subscribe.apply(this,arguments);},on:function(){this.addListener.apply(this,arguments);},removeListener:function(type,fn){this.unsubscribe.apply(this,arguments);},addClass:function(className){Dom.addClass(this.get('element'),className);},getElementsByClassName:function(className,tag){return Dom.getElementsByClassName(className,tag,this.get('element'));},hasClass:function(className){return Dom.hasClass(this.get('element'),className);},removeClass:function(className){return Dom.removeClass(this.get('element'),className);},replaceClass:function(oldClassName,newClassName){return Dom.replaceClass(this.get('element'),oldClassName,newClassName);},setStyle:function(property,value){var el=this.get('element');if(!el){return this._queue[this._queue.length]=['setStyle',arguments];}
return Dom.setStyle(el,property,value);},getStyle:function(property){return Dom.getStyle(this.get('element'),property);},fireQueue:function(){var queue=this._queue;for(var i=0,len=queue.length;i<len;++i){this[queue[i][0]].apply(this,queue[i][1]);}},appendTo:function(parent,before){parent=(parent.get)?parent.get('element'):Dom.get(parent);this.fireEvent('beforeAppendTo',{type:'beforeAppendTo',target:parent});before=(before&&before.get)?before.get('element'):Dom.get(before);var element=this.get('element');if(!element){return false;}
if(!parent){return false;}
if(element.parent!=parent){if(before){parent.insertBefore(element,before);}else{parent.appendChild(element);}}
this.fireEvent('appendTo',{type:'appendTo',target:parent});},get:function(key){var configs=this._configs||{};var el=configs.element;if(el&&!configs[key]&&!YAHOO.lang.isUndefined(el.value[key])){return el.value[key];}
return AttributeProvider.prototype.get.call(this,key);},set:function(key,value,silent){var el=this.get('element');if(!el){this._queue[this._queue.length]=['set',arguments];if(this._configs[key]){this._configs[key].value=value;}
return;}
if(!this._configs[key]&&!YAHOO.lang.isUndefined(el[key])){_registerHTMLAttr.call(this,key);}
return AttributeProvider.prototype.set.apply(this,arguments);},setAttributeConfig:function(key,map,init){var el=this.get('element');if(el&&!this._configs[key]&&!YAHOO.lang.isUndefined(el[key])){_registerHTMLAttr.call(this,key,map);}else{AttributeProvider.prototype.setAttributeConfig.apply(this,arguments);}},getAttributeKeys:function(){var el=this.get('element');var keys=AttributeProvider.prototype.getAttributeKeys.call(this);for(var key in el){if(!this._configs[key]){keys[key]=keys[key]||el[key];}}
return keys;},createEvent:function(type,scope){this._events[type]=true;AttributeProvider.prototype.createEvent.apply(this,arguments);},init:function(el,attr){_initElement.apply(this,arguments);}};var _initElement=function(el,attr){this._queue=this._queue||[];this._events=this._events||{};this._configs=this._configs||{};attr=attr||{};attr.element=attr.element||el||null;this.DOM_EVENTS={'click':true,'dblclick':true,'keydown':true,'keypress':true,'keyup':true,'mousedown':true,'mousemove':true,'mouseout':true,'mouseover':true,'mouseup':true,'focus':true,'blur':true,'submit':true};var isReady=false;if(YAHOO.lang.isString(el)){_registerHTMLAttr.call(this,'id',{value:attr.element});}
if(Dom.get(el)){isReady=true;_initHTMLElement.call(this,attr);_initContent.call(this,attr);}
YAHOO.util.Event.onAvailable(attr.element,function(){if(!isReady){_initHTMLElement.call(this,attr);}
this.fireEvent('available',{type:'available',target:attr.element});},this,true);YAHOO.util.Event.onContentReady(attr.element,function(){if(!isReady){_initContent.call(this,attr);}
this.fireEvent('contentReady',{type:'contentReady',target:attr.element});},this,true);};var _initHTMLElement=function(attr){this.setAttributeConfig('element',{value:Dom.get(attr.element),readOnly:true});};var _initContent=function(attr){this.initAttributes(attr);this.setAttributes(attr,true);this.fireQueue();};var _registerHTMLAttr=function(key,map){var el=this.get('element');map=map||{};map.name=key;map.method=map.method||function(value){el[key]=value;};map.value=map.value||el[key];this._configs[key]=new YAHOO.util.Attribute(map,this);};YAHOO.augment(YAHOO.util.Element,AttributeProvider);})();YAHOO.register("element",YAHOO.util.Element,{version:"2.2.2",build:"204"});
// tabview-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

(function(){YAHOO.widget.TabView=function(el,attr){attr=attr||{};if(arguments.length==1&&!YAHOO.lang.isString(el)&&!el.nodeName){attr=el;el=attr.element||null;}
if(!el&&!attr.element){el=_createTabViewElement.call(this,attr);}
YAHOO.widget.TabView.superclass.constructor.call(this,el,attr);};YAHOO.extend(YAHOO.widget.TabView,YAHOO.util.Element);var proto=YAHOO.widget.TabView.prototype;var Dom=YAHOO.util.Dom;var Event=YAHOO.util.Event;var Tab=YAHOO.widget.Tab;proto.CLASSNAME='yui-navset';proto.TAB_PARENT_CLASSNAME='yui-nav';proto.CONTENT_PARENT_CLASSNAME='yui-content';proto._tabParent=null;proto._contentParent=null;proto.addTab=function(tab,index){var tabs=this.get('tabs');if(!tabs){this._queue[this._queue.length]=['addTab',arguments];return false;}
index=(index===undefined)?tabs.length:index;var before=this.getTab(index);var self=this;var el=this.get('element');var tabParent=this._tabParent;var contentParent=this._contentParent;var tabElement=tab.get('element');var contentEl=tab.get('contentEl');if(before){tabParent.insertBefore(tabElement,before.get('element'));}else{tabParent.appendChild(tabElement);}
if(contentEl&&!Dom.isAncestor(contentParent,contentEl)){contentParent.appendChild(contentEl);}
if(!tab.get('active')){tab.set('contentVisible',false,true);}else{this.set('activeTab',tab,true);}
var activate=function(e){YAHOO.util.Event.preventDefault(e);self.set('activeTab',this);};tab.addListener(tab.get('activationEvent'),activate);tab.addListener('activationEventChange',function(e){if(e.prevValue!=e.newValue){tab.removeListener(e.prevValue,activate);tab.addListener(e.newValue,activate);}});tabs.splice(index,0,tab);};proto.DOMEventHandler=function(e){var el=this.get('element');var target=YAHOO.util.Event.getTarget(e);var tabParent=this._tabParent;if(Dom.isAncestor(tabParent,target)){var tabEl;var tab=null;var contentEl;var tabs=this.get('tabs');for(var i=0,len=tabs.length;i<len;i++){tabEl=tabs[i].get('element');contentEl=tabs[i].get('contentEl');if(target==tabEl||Dom.isAncestor(tabEl,target)){tab=tabs[i];break;}}
if(tab){tab.fireEvent(e.type,e);}}};proto.getTab=function(index){return this.get('tabs')[index];};proto.getTabIndex=function(tab){var index=null;var tabs=this.get('tabs');for(var i=0,len=tabs.length;i<len;++i){if(tab==tabs[i]){index=i;break;}}
return index;};proto.removeTab=function(tab){var tabCount=this.get('tabs').length;var index=this.getTabIndex(tab);var nextIndex=index+1;if(tab==this.get('activeTab')){if(tabCount>1){if(index+1==tabCount){this.set('activeIndex',index-1);}else{this.set('activeIndex',index+1);}}}
this._tabParent.removeChild(tab.get('element'));this._contentParent.removeChild(tab.get('contentEl'));this._configs.tabs.value.splice(index,1);};proto.toString=function(){var name=this.get('id')||this.get('tagName');return"TabView "+name;};proto.contentTransition=function(newTab,oldTab){newTab.set('contentVisible',true);oldTab.set('contentVisible',false);};proto.initAttributes=function(attr){YAHOO.widget.TabView.superclass.initAttributes.call(this,attr);if(!attr.orientation){attr.orientation='top';}
var el=this.get('element');this.setAttributeConfig('tabs',{value:[],readOnly:true});this._tabParent=this.getElementsByClassName(this.TAB_PARENT_CLASSNAME,'ul')[0]||_createTabParent.call(this);this._contentParent=this.getElementsByClassName(this.CONTENT_PARENT_CLASSNAME,'div')[0]||_createContentParent.call(this);this.setAttributeConfig('orientation',{value:attr.orientation,method:function(value){var current=this.get('orientation');this.addClass('yui-navset-'+value);if(current!=value){this.removeClass('yui-navset-'+current);}
switch(value){case'bottom':this.appendChild(this._tabParent);break;}}});this.setAttributeConfig('activeIndex',{value:attr.activeIndex,method:function(value){this.set('activeTab',this.getTab(value));},validator:function(value){return!this.getTab(value).get('disabled');}});this.setAttributeConfig('activeTab',{value:attr.activeTab,method:function(tab){var activeTab=this.get('activeTab');if(tab){tab.set('active',true);this._configs['activeIndex'].value=this.getTabIndex(tab);}
if(activeTab&&activeTab!=tab){activeTab.set('active',false);}
if(activeTab&&tab!=activeTab){this.contentTransition(tab,activeTab);}else if(tab){tab.set('contentVisible',true);}},validator:function(value){return!value.get('disabled');}});if(this._tabParent){_initTabs.call(this);}
for(var type in this.DOM_EVENTS){if(YAHOO.lang.hasOwnProperty(this.DOM_EVENTS,type)){this.addListener.call(this,type,this.DOMEventHandler);}}};var _initTabs=function(){var tab,attr,contentEl;var el=this.get('element');var tabs=_getChildNodes(this._tabParent);var contentElements=_getChildNodes(this._contentParent);for(var i=0,len=tabs.length;i<len;++i){attr={};if(contentElements[i]){attr.contentEl=contentElements[i];}
tab=new YAHOO.widget.Tab(tabs[i],attr);this.addTab(tab);if(tab.hasClass(tab.ACTIVE_CLASSNAME)){this._configs.activeTab.value=tab;}}};var _createTabViewElement=function(attr){var el=document.createElement('div');if(this.CLASSNAME){el.className=this.CLASSNAME;}
return el;};var _createTabParent=function(attr){var el=document.createElement('ul');if(this.TAB_PARENT_CLASSNAME){el.className=this.TAB_PARENT_CLASSNAME;}
this.get('element').appendChild(el);return el;};var _createContentParent=function(attr){var el=document.createElement('div');if(this.CONTENT_PARENT_CLASSNAME){el.className=this.CONTENT_PARENT_CLASSNAME;}
this.get('element').appendChild(el);return el;};var _getChildNodes=function(el){var nodes=[];var childNodes=el.childNodes;for(var i=0,len=childNodes.length;i<len;++i){if(childNodes[i].nodeType==1){nodes[nodes.length]=childNodes[i];}}
return nodes;};})();(function(){var Dom=YAHOO.util.Dom,Event=YAHOO.util.Event;var Tab=function(el,attr){attr=attr||{};if(arguments.length==1&&!YAHOO.lang.isString(el)&&!el.nodeName){attr=el;el=attr.element;}
if(!el&&!attr.element){el=_createTabElement.call(this,attr);}
this.loadHandler={success:function(o){this.set('content',o.responseText);},failure:function(o){}};Tab.superclass.constructor.call(this,el,attr);this.DOM_EVENTS={};};YAHOO.extend(Tab,YAHOO.util.Element);var proto=Tab.prototype;proto.LABEL_TAGNAME='em';proto.ACTIVE_CLASSNAME='selected';proto.DISABLED_CLASSNAME='disabled';proto.LOADING_CLASSNAME='loading';proto.dataConnection=null;proto.loadHandler=null;proto.toString=function(){var el=this.get('element');var id=el.id||el.tagName;return"Tab "+id;};proto.initAttributes=function(attr){attr=attr||{};Tab.superclass.initAttributes.call(this,attr);var el=this.get('element');this.setAttributeConfig('activationEvent',{value:attr.activationEvent||'click'});this.setAttributeConfig('labelEl',{value:attr.labelEl||_getlabelEl.call(this),method:function(value){var current=this.get('labelEl');if(current){if(current==value){return false;}
this.replaceChild(value,current);}else if(el.firstChild){this.insertBefore(value,el.firstChild);}else{this.appendChild(value);}}});this.setAttributeConfig('label',{value:attr.label||_getLabel.call(this),method:function(value){var labelEl=this.get('labelEl');if(!labelEl){this.set('labelEl',_createlabelEl.call(this));}
_setLabel.call(this,value);}});this.setAttributeConfig('contentEl',{value:attr.contentEl||document.createElement('div'),method:function(value){var current=this.get('contentEl');if(current){if(current==value){return false;}
this.replaceChild(value,current);}}});this.setAttributeConfig('content',{value:attr.content,method:function(value){this.get('contentEl').innerHTML=value;}});var _dataLoaded=false;this.setAttributeConfig('dataSrc',{value:attr.dataSrc});this.setAttributeConfig('cacheData',{value:attr.cacheData||false,validator:YAHOO.lang.isBoolean});this.setAttributeConfig('loadMethod',{value:attr.loadMethod||'GET',validator:YAHOO.lang.isString});this.setAttributeConfig('dataLoaded',{value:false,validator:YAHOO.lang.isBoolean,writeOnce:true});this.setAttributeConfig('dataTimeout',{value:attr.dataTimeout||null,validator:YAHOO.lang.isNumber});this.setAttributeConfig('active',{value:attr.active||this.hasClass(this.ACTIVE_CLASSNAME),method:function(value){if(value===true){this.addClass(this.ACTIVE_CLASSNAME);this.set('title','active');}else{this.removeClass(this.ACTIVE_CLASSNAME);this.set('title','');}},validator:function(value){return YAHOO.lang.isBoolean(value)&&!this.get('disabled');}});this.setAttributeConfig('disabled',{value:attr.disabled||this.hasClass(this.DISABLED_CLASSNAME),method:function(value){if(value===true){Dom.addClass(this.get('element'),this.DISABLED_CLASSNAME);}else{Dom.removeClass(this.get('element'),this.DISABLED_CLASSNAME);}},validator:YAHOO.lang.isBoolean});this.setAttributeConfig('href',{value:attr.href||'#',method:function(value){this.getElementsByTagName('a')[0].href=value;},validator:YAHOO.lang.isString});this.setAttributeConfig('contentVisible',{value:attr.contentVisible,method:function(value){if(value){this.get('contentEl').style.display='block';if(this.get('dataSrc')){if(!this.get('dataLoaded')||!this.get('cacheData')){_dataConnect.call(this);}}}else{this.get('contentEl').style.display='none';}},validator:YAHOO.lang.isBoolean});};var _createTabElement=function(attr){var el=document.createElement('li');var a=document.createElement('a');a.href=attr.href||'#';el.appendChild(a);var label=attr.label||null;var labelEl=attr.labelEl||null;if(labelEl){if(!label){label=_getLabel.call(this,labelEl);}}else{labelEl=_createlabelEl.call(this);}
a.appendChild(labelEl);return el;};var _getlabelEl=function(){return this.getElementsByTagName(this.LABEL_TAGNAME)[0];};var _createlabelEl=function(){var el=document.createElement(this.LABEL_TAGNAME);return el;};var _setLabel=function(label){var el=this.get('labelEl');el.innerHTML=label;};var _getLabel=function(){var label,el=this.get('labelEl');if(!el){return undefined;}
return el.innerHTML;};var _dataConnect=function(){if(!YAHOO.util.Connect){return false;}
Dom.addClass(this.get('contentEl').parentNode,this.LOADING_CLASSNAME);this.dataConnection=YAHOO.util.Connect.asyncRequest(this.get('loadMethod'),this.get('dataSrc'),{success:function(o){this.loadHandler.success.call(this,o);this.set('dataLoaded',true);this.dataConnection=null;Dom.removeClass(this.get('contentEl').parentNode,this.LOADING_CLASSNAME);},failure:function(o){this.loadHandler.failure.call(this,o);this.dataConnection=null;Dom.removeClass(this.get('contentEl').parentNode,this.LOADING_CLASSNAME);},scope:this,timeout:this.get('dataTimeout')});};YAHOO.widget.Tab=Tab;})();YAHOO.register("tabview",YAHOO.widget.TabView,{version:"2.2.2",build:"204"});
// progressindicator.js
var isIE;
	var genMask = null;
	var progressFinished=false;
	YAHOO.namespace("example.container");

	var progressIndicator = function(){}
	progressIndicator.Static = {
	
		init: function(){
			if (!YAHOO.example.container.wait){
				YAHOO.example.container.wait = new YAHOO.widget.Panel("wait",{ width:"420px", height:"200px", fixedcenter:true, close:false, draggable:false, modal:false, visible:false});
				YAHOO.example.container.wait.setBody($("staticProgressIndicator").innerHTML);
				YAHOO.example.container.wait.render(document.body);
				YAHOO.example.container.type="static";
				YAHOO.example.container.wait.show();			
				}
			},	
		
		hide: function(){
			//Hides the Panel
			if((YAHOO.example.container.wait)&&(YAHOO.example.container.type=="static")){
				YAHOO.example.container.wait.hide();
				YAHOO.example.container.wait = undefined;
			}
			YAHOO.example.container.stopped=true;
			if (genMask != null){
				genMask.hideMask();
			}
		},
		
		launch: function(){
			if(YAHOO.example.container.stopped){
				YAHOO.example.container.stopped=false;
			}else{
				progressIndicator.Static.init();
			}
		},	
		
		show: function(){
			if (isEnabled=="true")
				{
				//Begin generic mask - This is the mask behind the progress indicator panel dialog
				if (genMask == null){
					genMask = new YAHOO.widget.Panel ("genMask", { visible:false, modal:true} );
					genMask.render(document.body);
 				}
 					genMask.showMask();
				// End generic mask
				YAHOO.example.container.stopped=false;
				setTimeout("progressIndicator.Static.launch()", waitTime);
				}
		}
	}

	progressIndicator.Dynamic = {
		init: function(){
			// Initialize the temporary Panel to display while waiting for external content to load
			YAHOO.example.container.wait = new YAHOO.widget.Panel("wait",{ width:"420px", height:"200px", fixedcenter:true, close:false, draggable:false, modal:true, visible:false, effect:{effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5}});

			YAHOO.example.container.wait.setBody($("dynamicProgressIndicator").innerHTML);
			YAHOO.example.container.wait.render(document.body);

			//Indicates it's static/dynamic
			YAHOO.example.container.type="dynamic";

			// Show the Panel
			YAHOO.example.container.wait.show();
			
			$("dynamicProgressIndicator").innerHTML = "";
		},
		
		update: function(){
			if (progressFinished!="true"){
				var url = "updateProgressIndicator.wss";
				bhGet = new BHAPI.BHAsyncJsonGet(url, false);
				bhGet.subsOnSuccess(function(){progressIndicator.Dynamic.update();}, this);
				bhGet.subsOnFailure(function(){progressIndicator.Dynamic.update();}, this);
				bhGet.connect();	
			}
		},
		
		show: function(){
			var url = "displayProgressIndicator.wss";
			bhGet = new BHAPI.BHAsyncJsonGet(url, false);
			bhGet.subsOnSuccess(function(){progressIndicator.Dynamic.init();progressIndicator.Dynamic.update();}, this);
			bhGet.connect();
		}
	}

// yahoo-dom-event.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

if(typeof YAHOO=="undefined"){var YAHOO={};}
YAHOO.namespace=function(){var a=arguments,o=null,i,j,d;for(i=0;i<a.length;i=i+1){d=a[i].split(".");o=YAHOO;for(j=(d[0]=="YAHOO")?1:0;j<d.length;j=j+1){o[d[j]]=o[d[j]]||{};o=o[d[j]];}}
return o;};YAHOO.log=function(msg,cat,src){var l=YAHOO.widget.Logger;if(l&&l.log){return l.log(msg,cat,src);}else{return false;}};YAHOO.init=function(){this.namespace("util","widget","example");if(typeof YAHOO_config!="undefined"){var l=YAHOO_config.listener,ls=YAHOO.env.listeners,unique=true,i;if(l){for(i=0;i<ls.length;i=i+1){if(ls[i]==l){unique=false;break;}}
if(unique){ls.push(l);}}}};YAHOO.register=function(name,mainClass,data){var mods=YAHOO.env.modules;if(!mods[name]){mods[name]={versions:[],builds:[]};}
var m=mods[name],v=data.version,b=data.build,ls=YAHOO.env.listeners;m.name=name;m.version=v;m.build=b;m.versions.push(v);m.builds.push(b);m.mainClass=mainClass;for(var i=0;i<ls.length;i=i+1){ls[i](m);}
if(mainClass){mainClass.VERSION=v;mainClass.BUILD=b;}else{YAHOO.log("mainClass is undefined for module "+name,"warn");}};YAHOO.env=YAHOO.env||{modules:[],listeners:[],getVersion:function(name){return YAHOO.env.modules[name]||null;}};YAHOO.lang={isArray:function(obj){if(obj&&obj.constructor&&obj.constructor.toString().indexOf('Array')>-1){return true;}else{return YAHOO.lang.isObject(obj)&&obj.constructor==Array;}},isBoolean:function(obj){return typeof obj=='boolean';},isFunction:function(obj){return typeof obj=='function';},isNull:function(obj){return obj===null;},isNumber:function(obj){return typeof obj=='number'&&isFinite(obj);},isObject:function(obj){return obj&&(typeof obj=='object'||YAHOO.lang.isFunction(obj));},isString:function(obj){return typeof obj=='string';},isUndefined:function(obj){return typeof obj=='undefined';},hasOwnProperty:function(obj,prop){if(Object.prototype.hasOwnProperty){return obj.hasOwnProperty(prop);}
return!YAHOO.lang.isUndefined(obj[prop])&&obj.constructor.prototype[prop]!==obj[prop];},extend:function(subc,superc,overrides){if(!superc||!subc){throw new Error("YAHOO.lang.extend failed, please check that "+"all dependencies are included.");}
var F=function(){};F.prototype=superc.prototype;subc.prototype=new F();subc.prototype.constructor=subc;subc.superclass=superc.prototype;if(superc.prototype.constructor==Object.prototype.constructor){superc.prototype.constructor=superc;}
if(overrides){for(var i in overrides){subc.prototype[i]=overrides[i];}}},augment:function(r,s){if(!s||!r){throw new Error("YAHOO.lang.augment failed, please check that "+"all dependencies are included.");}
var rp=r.prototype,sp=s.prototype,a=arguments,i,p;if(a[2]){for(i=2;i<a.length;i=i+1){rp[a[i]]=sp[a[i]];}}else{for(p in sp){if(!rp[p]){rp[p]=sp[p];}}}}};YAHOO.init();YAHOO.util.Lang=YAHOO.lang;YAHOO.augment=YAHOO.lang.augment;YAHOO.extend=YAHOO.lang.extend;YAHOO.register("yahoo",YAHOO,{version:"2.2.2",build:"204"});
(function(){var Y=YAHOO.util,getStyle,setStyle,id_counter=0,propertyCache={};var ua=navigator.userAgent.toLowerCase(),isOpera=(ua.indexOf('opera')>-1),isSafari=(ua.indexOf('safari')>-1),isGecko=(!isOpera&&!isSafari&&ua.indexOf('gecko')>-1),isIE=(!isOpera&&ua.indexOf('msie')>-1);var patterns={HYPHEN:/(-[a-z])/i,ROOT_TAG:/body|html/i};var toCamel=function(property){if(!patterns.HYPHEN.test(property)){return property;}
if(propertyCache[property]){return propertyCache[property];}
var converted=property;while(patterns.HYPHEN.exec(converted)){converted=converted.replace(RegExp.$1,RegExp.$1.substr(1).toUpperCase());}
propertyCache[property]=converted;return converted;};if(document.defaultView&&document.defaultView.getComputedStyle){getStyle=function(el,property){var value=null;if(property=='float'){property='cssFloat';}
var computed=document.defaultView.getComputedStyle(el,'');if(computed){value=computed[toCamel(property)];}
return el.style[property]||value;};}else if(document.documentElement.currentStyle&&isIE){getStyle=function(el,property){switch(toCamel(property)){case'opacity':var val=100;try{val=el.filters['DXImageTransform.Microsoft.Alpha'].opacity;}catch(e){try{val=el.filters('alpha').opacity;}catch(e){}}
return val/100;break;case'float':property='styleFloat';default:var value=el.currentStyle?el.currentStyle[property]:null;return(el.style[property]||value);}};}else{getStyle=function(el,property){return el.style[property];};}
if(isIE){setStyle=function(el,property,val){switch(property){case'opacity':if(YAHOO.lang.isString(el.style.filter)){el.style.filter='alpha(opacity='+val*100+')';if(!el.currentStyle||!el.currentStyle.hasLayout){el.style.zoom=1;}}
break;case'float':property='styleFloat';default:el.style[property]=val;}};}else{setStyle=function(el,property,val){if(property=='float'){property='cssFloat';}
el.style[property]=val;};}
YAHOO.util.Dom={get:function(el){if(YAHOO.lang.isString(el)){return document.getElementById(el);}
if(YAHOO.lang.isArray(el)){var c=[];for(var i=0,len=el.length;i<len;++i){c[c.length]=Y.Dom.get(el[i]);}
return c;}
if(el){return el;}
return null;},getStyle:function(el,property){property=toCamel(property);var f=function(element){return getStyle(element,property);};return Y.Dom.batch(el,f,Y.Dom,true);},setStyle:function(el,property,val){property=toCamel(property);var f=function(element){setStyle(element,property,val);};Y.Dom.batch(el,f,Y.Dom,true);},getXY:function(el){var f=function(el){if((el.parentNode===null||el.offsetParent===null||this.getStyle(el,'display')=='none')&&el!=document.body){return false;}
var parentNode=null;var pos=[];var box;if(el.getBoundingClientRect){box=el.getBoundingClientRect();var doc=document;if(!this.inDocument(el)&&parent.document!=document){doc=parent.document;if(!this.isAncestor(doc.documentElement,el)){return false;}}
var scrollTop=Math.max(doc.documentElement.scrollTop,doc.body.scrollTop);var scrollLeft=Math.max(doc.documentElement.scrollLeft,doc.body.scrollLeft);return[box.left+scrollLeft,box.top+scrollTop];}
else{pos=[el.offsetLeft,el.offsetTop];parentNode=el.offsetParent;var hasAbs=this.getStyle(el,'position')=='absolute';if(parentNode!=el){while(parentNode){pos[0]+=parentNode.offsetLeft;pos[1]+=parentNode.offsetTop;if(isSafari&&!hasAbs&&this.getStyle(parentNode,'position')=='absolute'){hasAbs=true;}
parentNode=parentNode.offsetParent;}}
if(isSafari&&hasAbs){pos[0]-=document.body.offsetLeft;pos[1]-=document.body.offsetTop;}}
parentNode=el.parentNode;while(parentNode.tagName&&!patterns.ROOT_TAG.test(parentNode.tagName))
{if(Y.Dom.getStyle(parentNode,'display')!='inline'){pos[0]-=parentNode.scrollLeft;pos[1]-=parentNode.scrollTop;}
parentNode=parentNode.parentNode;}
return pos;};return Y.Dom.batch(el,f,Y.Dom,true);},getX:function(el){var f=function(el){return Y.Dom.getXY(el)[0];};return Y.Dom.batch(el,f,Y.Dom,true);},getY:function(el){var f=function(el){return Y.Dom.getXY(el)[1];};return Y.Dom.batch(el,f,Y.Dom,true);},setXY:function(el,pos,noRetry){var f=function(el){var style_pos=this.getStyle(el,'position');if(style_pos=='static'){this.setStyle(el,'position','relative');style_pos='relative';}
var pageXY=this.getXY(el);if(pageXY===false){return false;}
var delta=[parseInt(this.getStyle(el,'left'),10),parseInt(this.getStyle(el,'top'),10)];if(isNaN(delta[0])){delta[0]=(style_pos=='relative')?0:el.offsetLeft;}
if(isNaN(delta[1])){delta[1]=(style_pos=='relative')?0:el.offsetTop;}
if(pos[0]!==null){el.style.left=pos[0]-pageXY[0]+delta[0]+'px';}
if(pos[1]!==null){el.style.top=pos[1]-pageXY[1]+delta[1]+'px';}
if(!noRetry){var newXY=this.getXY(el);if((pos[0]!==null&&newXY[0]!=pos[0])||(pos[1]!==null&&newXY[1]!=pos[1])){this.setXY(el,pos,true);}}};Y.Dom.batch(el,f,Y.Dom,true);},setX:function(el,x){Y.Dom.setXY(el,[x,null]);},setY:function(el,y){Y.Dom.setXY(el,[null,y]);},getRegion:function(el){var f=function(el){var region=new Y.Region.getRegion(el);return region;};return Y.Dom.batch(el,f,Y.Dom,true);},getClientWidth:function(){return Y.Dom.getViewportWidth();},getClientHeight:function(){return Y.Dom.getViewportHeight();},getElementsByClassName:function(className,tag,root){var method=function(el){return Y.Dom.hasClass(el,className);};return Y.Dom.getElementsBy(method,tag,root);},hasClass:function(el,className){var re=new RegExp('(?:^|\\s+)'+className+'(?:\\s+|$)');var f=function(el){return re.test(el.className);};return Y.Dom.batch(el,f,Y.Dom,true);},addClass:function(el,className){var f=function(el){if(this.hasClass(el,className)){return;}
el.className=[el.className,className].join(' ');};Y.Dom.batch(el,f,Y.Dom,true);},removeClass:function(el,className){var re=new RegExp('(?:^|\\s+)'+className+'(?:\\s+|$)','g');var f=function(el){if(!this.hasClass(el,className)){return;}
var c=el.className;el.className=c.replace(re,' ');if(this.hasClass(el,className)){this.removeClass(el,className);}};Y.Dom.batch(el,f,Y.Dom,true);},replaceClass:function(el,oldClassName,newClassName){if(oldClassName===newClassName){return false;}
var re=new RegExp('(?:^|\\s+)'+oldClassName+'(?:\\s+|$)','g');var f=function(el){if(!this.hasClass(el,oldClassName)){this.addClass(el,newClassName);return;}
el.className=el.className.replace(re,' '+newClassName+' ');if(this.hasClass(el,oldClassName)){this.replaceClass(el,oldClassName,newClassName);}};Y.Dom.batch(el,f,Y.Dom,true);},generateId:function(el,prefix){prefix=prefix||'yui-gen';el=el||{};var f=function(el){if(el){el=Y.Dom.get(el);}else{el={};}
if(!el.id){el.id=prefix+id_counter++;}
return el.id;};return Y.Dom.batch(el,f,Y.Dom,true);},isAncestor:function(haystack,needle){haystack=Y.Dom.get(haystack);if(!haystack||!needle){return false;}
var f=function(needle){if(haystack.contains&&!isSafari){return haystack.contains(needle);}
else if(haystack.compareDocumentPosition){return!!(haystack.compareDocumentPosition(needle)&16);}
else{var parent=needle.parentNode;while(parent){if(parent==haystack){return true;}
else if(!parent.tagName||parent.tagName.toUpperCase()=='HTML'){return false;}
parent=parent.parentNode;}
return false;}};return Y.Dom.batch(needle,f,Y.Dom,true);},inDocument:function(el){var f=function(el){return this.isAncestor(document.documentElement,el);};return Y.Dom.batch(el,f,Y.Dom,true);},getElementsBy:function(method,tag,root){tag=tag||'*';var nodes=[];if(root){root=Y.Dom.get(root);if(!root){return nodes;}}else{root=document;}
var elements=root.getElementsByTagName(tag);if(!elements.length&&(tag=='*'&&root.all)){elements=root.all;}
for(var i=0,len=elements.length;i<len;++i){if(method(elements[i])){nodes[nodes.length]=elements[i];}}
return nodes;},batch:function(el,method,o,override){var id=el;el=Y.Dom.get(el);var scope=(override)?o:window;if(!el||el.tagName||!el.length){if(!el){return false;}
return method.call(scope,el,o);}
var collection=[];for(var i=0,len=el.length;i<len;++i){if(!el[i]){id=el[i];}
collection[collection.length]=method.call(scope,el[i],o);}
return collection;},getDocumentHeight:function(){var scrollHeight=(document.compatMode!='CSS1Compat')?document.body.scrollHeight:document.documentElement.scrollHeight;var h=Math.max(scrollHeight,Y.Dom.getViewportHeight());return h;},getDocumentWidth:function(){var scrollWidth=(document.compatMode!='CSS1Compat')?document.body.scrollWidth:document.documentElement.scrollWidth;var w=Math.max(scrollWidth,Y.Dom.getViewportWidth());return w;},getViewportHeight:function(){var height=self.innerHeight;var mode=document.compatMode;if((mode||isIE)&&!isOpera){height=(mode=='CSS1Compat')?document.documentElement.clientHeight:document.body.clientHeight;}
return height;},getViewportWidth:function(){var width=self.innerWidth;var mode=document.compatMode;if(mode||isIE){width=(mode=='CSS1Compat')?document.documentElement.clientWidth:document.body.clientWidth;}
return width;}};})();YAHOO.util.Region=function(t,r,b,l){this.top=t;this[1]=t;this.right=r;this.bottom=b;this.left=l;this[0]=l;};YAHOO.util.Region.prototype.contains=function(region){return(region.left>=this.left&&region.right<=this.right&&region.top>=this.top&&region.bottom<=this.bottom);};YAHOO.util.Region.prototype.getArea=function(){return((this.bottom-this.top)*(this.right-this.left));};YAHOO.util.Region.prototype.intersect=function(region){var t=Math.max(this.top,region.top);var r=Math.min(this.right,region.right);var b=Math.min(this.bottom,region.bottom);var l=Math.max(this.left,region.left);if(b>=t&&r>=l){return new YAHOO.util.Region(t,r,b,l);}else{return null;}};YAHOO.util.Region.prototype.union=function(region){var t=Math.min(this.top,region.top);var r=Math.max(this.right,region.right);var b=Math.max(this.bottom,region.bottom);var l=Math.min(this.left,region.left);return new YAHOO.util.Region(t,r,b,l);};YAHOO.util.Region.prototype.toString=function(){return("Region {"+"top: "+this.top+", right: "+this.right+", bottom: "+this.bottom+", left: "+this.left+"}");};YAHOO.util.Region.getRegion=function(el){var p=YAHOO.util.Dom.getXY(el);var t=p[1];var r=p[0]+el.offsetWidth;var b=p[1]+el.offsetHeight;var l=p[0];return new YAHOO.util.Region(t,r,b,l);};YAHOO.util.Point=function(x,y){if(x instanceof Array){y=x[1];x=x[0];}
this.x=this.right=this.left=this[0]=x;this.y=this.top=this.bottom=this[1]=y;};YAHOO.util.Point.prototype=new YAHOO.util.Region();YAHOO.register("dom",YAHOO.util.Dom,{version:"2.2.2",build:"204"});
YAHOO.util.CustomEvent=function(type,oScope,silent,signature){this.type=type;this.scope=oScope||window;this.silent=silent;this.signature=signature||YAHOO.util.CustomEvent.LIST;this.subscribers=[];if(!this.silent){}
var onsubscribeType="_YUICEOnSubscribe";if(type!==onsubscribeType){this.subscribeEvent=new YAHOO.util.CustomEvent(onsubscribeType,this,true);}};YAHOO.util.CustomEvent.LIST=0;YAHOO.util.CustomEvent.FLAT=1;YAHOO.util.CustomEvent.prototype={subscribe:function(fn,obj,override){if(!fn){throw new Error("Invalid callback for subscriber to '"+this.type+"'");}
if(this.subscribeEvent){this.subscribeEvent.fire(fn,obj,override);}
this.subscribers.push(new YAHOO.util.Subscriber(fn,obj,override));},unsubscribe:function(fn,obj){if(!fn){return this.unsubscribeAll();}
var found=false;for(var i=0,len=this.subscribers.length;i<len;++i){var s=this.subscribers[i];if(s&&s.contains(fn,obj)){this._delete(i);found=true;}}
return found;},fire:function(){var len=this.subscribers.length;if(!len&&this.silent){return true;}
var args=[],ret=true,i;for(i=0;i<arguments.length;++i){args.push(arguments[i]);}
var argslength=args.length;if(!this.silent){}
for(i=0;i<len;++i){var s=this.subscribers[i];if(s){if(!this.silent){}
var scope=s.getScope(this.scope);if(this.signature==YAHOO.util.CustomEvent.FLAT){var param=null;if(args.length>0){param=args[0];}
ret=s.fn.call(scope,param,s.obj);}else{ret=s.fn.call(scope,this.type,args,s.obj);}
if(false===ret){if(!this.silent){}
return false;}}}
return true;},unsubscribeAll:function(){for(var i=0,len=this.subscribers.length;i<len;++i){this._delete(len-1-i);}
return i;},_delete:function(index){var s=this.subscribers[index];if(s){delete s.fn;delete s.obj;}
this.subscribers.splice(index,1);},toString:function(){return"CustomEvent: "+"'"+this.type+"', "+"scope: "+this.scope;}};YAHOO.util.Subscriber=function(fn,obj,override){this.fn=fn;this.obj=obj||null;this.override=override;};YAHOO.util.Subscriber.prototype.getScope=function(defaultScope){if(this.override){if(this.override===true){return this.obj;}else{return this.override;}}
return defaultScope;};YAHOO.util.Subscriber.prototype.contains=function(fn,obj){if(obj){return(this.fn==fn&&this.obj==obj);}else{return(this.fn==fn);}};YAHOO.util.Subscriber.prototype.toString=function(){return"Subscriber { obj: "+(this.obj||"")+", override: "+(this.override||"no")+" }";};if(!YAHOO.util.Event){YAHOO.util.Event=function(){var loadComplete=false;var DOMReady=false;var listeners=[];var unloadListeners=[];var legacyEvents=[];var legacyHandlers=[];var retryCount=0;var onAvailStack=[];var legacyMap=[];var counter=0;var lastError=null;return{POLL_RETRYS:200,POLL_INTERVAL:10,EL:0,TYPE:1,FN:2,WFN:3,OBJ:3,ADJ_SCOPE:4,isSafari:(/KHTML/gi).test(navigator.userAgent),webkit:function(){var v=navigator.userAgent.match(/AppleWebKit\/([^ ]*)/);if(v&&v[1]){return v[1];}
return null;}(),isIE:(!this.webkit&&!navigator.userAgent.match(/opera/gi)&&navigator.userAgent.match(/msie/gi)),_interval:null,startInterval:function(){if(!this._interval){var self=this;var callback=function(){self._tryPreloadAttach();};this._interval=setInterval(callback,this.POLL_INTERVAL);}},onAvailable:function(p_id,p_fn,p_obj,p_override){onAvailStack.push({id:p_id,fn:p_fn,obj:p_obj,override:p_override,checkReady:false});retryCount=this.POLL_RETRYS;this.startInterval();},onDOMReady:function(p_fn,p_obj,p_override){this.DOMReadyEvent.subscribe(p_fn,p_obj,p_override);},onContentReady:function(p_id,p_fn,p_obj,p_override){onAvailStack.push({id:p_id,fn:p_fn,obj:p_obj,override:p_override,checkReady:true});retryCount=this.POLL_RETRYS;this.startInterval();},addListener:function(el,sType,fn,obj,override){if(!fn||!fn.call){return false;}
if(this._isValidCollection(el)){var ok=true;for(var i=0,len=el.length;i<len;++i){ok=this.on(el[i],sType,fn,obj,override)&&ok;}
return ok;}else if(typeof el=="string"){var oEl=this.getEl(el);if(oEl){el=oEl;}else{this.onAvailable(el,function(){YAHOO.util.Event.on(el,sType,fn,obj,override);});return true;}}
if(!el){return false;}
if("unload"==sType&&obj!==this){unloadListeners[unloadListeners.length]=[el,sType,fn,obj,override];return true;}
var scope=el;if(override){if(override===true){scope=obj;}else{scope=override;}}
var wrappedFn=function(e){return fn.call(scope,YAHOO.util.Event.getEvent(e),obj);};var li=[el,sType,fn,wrappedFn,scope];var index=listeners.length;listeners[index]=li;if(this.useLegacyEvent(el,sType)){var legacyIndex=this.getLegacyIndex(el,sType);if(legacyIndex==-1||el!=legacyEvents[legacyIndex][0]){legacyIndex=legacyEvents.length;legacyMap[el.id+sType]=legacyIndex;legacyEvents[legacyIndex]=[el,sType,el["on"+sType]];legacyHandlers[legacyIndex]=[];el["on"+sType]=function(e){YAHOO.util.Event.fireLegacyEvent(YAHOO.util.Event.getEvent(e),legacyIndex);};}
legacyHandlers[legacyIndex].push(li);}else{try{this._simpleAdd(el,sType,wrappedFn,false);}catch(ex){this.lastError=ex;this.removeListener(el,sType,fn);return false;}}
return true;},fireLegacyEvent:function(e,legacyIndex){var ok=true,le,lh,li,scope,ret;lh=legacyHandlers[legacyIndex];for(var i=0,len=lh.length;i<len;++i){li=lh[i];if(li&&li[this.WFN]){scope=li[this.ADJ_SCOPE];ret=li[this.WFN].call(scope,e);ok=(ok&&ret);}}
le=legacyEvents[legacyIndex];if(le&&le[2]){le[2](e);}
return ok;},getLegacyIndex:function(el,sType){var key=this.generateId(el)+sType;if(typeof legacyMap[key]=="undefined"){return-1;}else{return legacyMap[key];}},useLegacyEvent:function(el,sType){if(this.webkit&&("click"==sType||"dblclick"==sType)){var v=parseInt(this.webkit,10);if(!isNaN(v)&&v<418){return true;}}
return false;},removeListener:function(el,sType,fn){var i,len;if(typeof el=="string"){el=this.getEl(el);}else if(this._isValidCollection(el)){var ok=true;for(i=0,len=el.length;i<len;++i){ok=(this.removeListener(el[i],sType,fn)&&ok);}
return ok;}
if(!fn||!fn.call){return this.purgeElement(el,false,sType);}
if("unload"==sType){for(i=0,len=unloadListeners.length;i<len;i++){var li=unloadListeners[i];if(li&&li[0]==el&&li[1]==sType&&li[2]==fn){unloadListeners.splice(i,1);return true;}}
return false;}
var cacheItem=null;var index=arguments[3];if("undefined"==typeof index){index=this._getCacheIndex(el,sType,fn);}
if(index>=0){cacheItem=listeners[index];}
if(!el||!cacheItem){return false;}
if(this.useLegacyEvent(el,sType)){var legacyIndex=this.getLegacyIndex(el,sType);var llist=legacyHandlers[legacyIndex];if(llist){for(i=0,len=llist.length;i<len;++i){li=llist[i];if(li&&li[this.EL]==el&&li[this.TYPE]==sType&&li[this.FN]==fn){llist.splice(i,1);break;}}}}else{try{this._simpleRemove(el,sType,cacheItem[this.WFN],false);}catch(ex){this.lastError=ex;return false;}}
delete listeners[index][this.WFN];delete listeners[index][this.FN];listeners.splice(index,1);return true;},getTarget:function(ev,resolveTextNode){var t=ev.target||ev.srcElement;return this.resolveTextNode(t);},resolveTextNode:function(node){if(node&&3==node.nodeType){return node.parentNode;}else{return node;}},getPageX:function(ev){var x=ev.pageX;if(!x&&0!==x){x=ev.clientX||0;if(this.isIE){x+=this._getScrollLeft();}}
return x;},getPageY:function(ev){var y=ev.pageY;if(!y&&0!==y){y=ev.clientY||0;if(this.isIE){y+=this._getScrollTop();}}
return y;},getXY:function(ev){return[this.getPageX(ev),this.getPageY(ev)];},getRelatedTarget:function(ev){var t=ev.relatedTarget;if(!t){if(ev.type=="mouseout"){t=ev.toElement;}else if(ev.type=="mouseover"){t=ev.fromElement;}}
return this.resolveTextNode(t);},getTime:function(ev){if(!ev.time){var t=new Date().getTime();try{ev.time=t;}catch(ex){this.lastError=ex;return t;}}
return ev.time;},stopEvent:function(ev){this.stopPropagation(ev);this.preventDefault(ev);},stopPropagation:function(ev){if(ev.stopPropagation){ev.stopPropagation();}else{ev.cancelBubble=true;}},preventDefault:function(ev){if(ev.preventDefault){ev.preventDefault();}else{ev.returnValue=false;}},getEvent:function(e){var ev=e||window.event;if(!ev){var c=this.getEvent.caller;while(c){ev=c.arguments[0];if(ev&&Event==ev.constructor){break;}
c=c.caller;}}
return ev;},getCharCode:function(ev){return ev.charCode||ev.keyCode||0;},_getCacheIndex:function(el,sType,fn){for(var i=0,len=listeners.length;i<len;++i){var li=listeners[i];if(li&&li[this.FN]==fn&&li[this.EL]==el&&li[this.TYPE]==sType){return i;}}
return-1;},generateId:function(el){var id=el.id;if(!id){id="yuievtautoid-"+counter;++counter;el.id=id;}
return id;},_isValidCollection:function(o){return(o&&o.length&&typeof o!="string"&&!o.tagName&&!o.alert&&typeof o[0]!="undefined");},elCache:{},getEl:function(id){return document.getElementById(id);},clearCache:function(){},DOMReadyEvent:new YAHOO.util.CustomEvent("DOMReady",this),_load:function(e){if(!loadComplete){loadComplete=true;var EU=YAHOO.util.Event;EU._ready();if(this.isIE){EU._simpleRemove(window,"load",EU._load);}}},_ready:function(e){if(!DOMReady){DOMReady=true;var EU=YAHOO.util.Event;EU.DOMReadyEvent.fire();EU._simpleRemove(document,"DOMContentLoaded",EU._ready);}},_tryPreloadAttach:function(){if(this.locked){return false;}
if(this.isIE&&!DOMReady){return false;}
this.locked=true;var tryAgain=!loadComplete;if(!tryAgain){tryAgain=(retryCount>0);}
var notAvail=[];var executeItem=function(el,item){var scope=el;if(item.override){if(item.override===true){scope=item.obj;}else{scope=item.override;}}
item.fn.call(scope,item.obj);};var i,len,item,el;for(i=0,len=onAvailStack.length;i<len;++i){item=onAvailStack[i];if(item&&!item.checkReady){el=this.getEl(item.id);if(el){executeItem(el,item);onAvailStack[i]=null;}else{notAvail.push(item);}}}
for(i=0,len=onAvailStack.length;i<len;++i){item=onAvailStack[i];if(item&&item.checkReady){el=this.getEl(item.id);if(el){if(loadComplete||el.nextSibling){executeItem(el,item);onAvailStack[i]=null;}}else{notAvail.push(item);}}}
retryCount=(notAvail.length===0)?0:retryCount-1;if(tryAgain){this.startInterval();}else{clearInterval(this._interval);this._interval=null;}
this.locked=false;return true;},purgeElement:function(el,recurse,sType){var elListeners=this.getListeners(el,sType);if(elListeners){for(var i=0,len=elListeners.length;i<len;++i){var l=elListeners[i];this.removeListener(el,l.type,l.fn);}}
if(recurse&&el&&el.childNodes){for(i=0,len=el.childNodes.length;i<len;++i){this.purgeElement(el.childNodes[i],recurse,sType);}}},getListeners:function(el,sType){var results=[],searchLists;if(!sType){searchLists=[listeners,unloadListeners];}else if(sType=="unload"){searchLists=[unloadListeners];}else{searchLists=[listeners];}
for(var j=0;j<searchLists.length;++j){var searchList=searchLists[j];if(searchList&&searchList.length>0){for(var i=0,len=searchList.length;i<len;++i){var l=searchList[i];if(l&&l[this.EL]===el&&(!sType||sType===l[this.TYPE])){results.push({type:l[this.TYPE],fn:l[this.FN],obj:l[this.OBJ],adjust:l[this.ADJ_SCOPE],index:i});}}}}
return(results.length)?results:null;},_unload:function(e){var EU=YAHOO.util.Event,i,j,l,len,index;for(i=0,len=unloadListeners.length;i<len;++i){l=unloadListeners[i];if(l){var scope=window;if(l[EU.ADJ_SCOPE]){if(l[EU.ADJ_SCOPE]===true){scope=l[EU.OBJ];}else{scope=l[EU.ADJ_SCOPE];}}
l[EU.FN].call(scope,EU.getEvent(e),l[EU.OBJ]);unloadListeners[i]=null;l=null;scope=null;}}
unloadListeners=null;if(listeners&&listeners.length>0){j=listeners.length;while(j){index=j-1;l=listeners[index];if(l){EU.removeListener(l[EU.EL],l[EU.TYPE],l[EU.FN],index);}
j=j-1;}
l=null;EU.clearCache();}
for(i=0,len=legacyEvents.length;i<len;++i){legacyEvents[i][0]=null;legacyEvents[i]=null;}
legacyEvents=null;EU._simpleRemove(window,"unload",EU._unload);},_getScrollLeft:function(){return this._getScroll()[1];},_getScrollTop:function(){return this._getScroll()[0];},_getScroll:function(){var dd=document.documentElement,db=document.body;if(dd&&(dd.scrollTop||dd.scrollLeft)){return[dd.scrollTop,dd.scrollLeft];}else if(db){return[db.scrollTop,db.scrollLeft];}else{return[0,0];}},regCE:function(){},_simpleAdd:function(){if(window.addEventListener){return function(el,sType,fn,capture){el.addEventListener(sType,fn,(capture));};}else if(window.attachEvent){return function(el,sType,fn,capture){el.attachEvent("on"+sType,fn);};}else{return function(){};}}(),_simpleRemove:function(){if(window.removeEventListener){return function(el,sType,fn,capture){el.removeEventListener(sType,fn,(capture));};}else if(window.detachEvent){return function(el,sType,fn){el.detachEvent("on"+sType,fn);};}else{return function(){};}}()};}();(function(){var EU=YAHOO.util.Event;EU.on=EU.addListener;if(EU.isIE){document.write('<scr'+'ipt id="_yui_eu_dr" defer="true" src="//:"></script>');var el=document.getElementById("_yui_eu_dr");el.onreadystatechange=function(){if("complete"==this.readyState){this.parentNode.removeChild(this);YAHOO.util.Event._ready();}};el=null;YAHOO.util.Event.onDOMReady(YAHOO.util.Event._tryPreloadAttach,YAHOO.util.Event,true);}else if(EU.webkit){EU._drwatch=setInterval(function(){var rs=document.readyState;if("loaded"==rs||"complete"==rs){clearInterval(EU._drwatch);EU._drwatch=null;EU._ready();}},EU.POLL_INTERVAL);}else{EU._simpleAdd(document,"DOMContentLoaded",EU._ready);}
EU._simpleAdd(window,"load",EU._load);EU._simpleAdd(window,"unload",EU._unload);EU._tryPreloadAttach();})();}
YAHOO.util.EventProvider=function(){};YAHOO.util.EventProvider.prototype={__yui_events:null,__yui_subscribers:null,subscribe:function(p_type,p_fn,p_obj,p_override){this.__yui_events=this.__yui_events||{};var ce=this.__yui_events[p_type];if(ce){ce.subscribe(p_fn,p_obj,p_override);}else{this.__yui_subscribers=this.__yui_subscribers||{};var subs=this.__yui_subscribers;if(!subs[p_type]){subs[p_type]=[];}
subs[p_type].push({fn:p_fn,obj:p_obj,override:p_override});}},unsubscribe:function(p_type,p_fn,p_obj){this.__yui_events=this.__yui_events||{};var ce=this.__yui_events[p_type];if(ce){return ce.unsubscribe(p_fn,p_obj);}else{return false;}},unsubscribeAll:function(p_type){return this.unsubscribe(p_type);},createEvent:function(p_type,p_config){this.__yui_events=this.__yui_events||{};var opts=p_config||{};var events=this.__yui_events;if(events[p_type]){}else{var scope=opts.scope||this;var silent=opts.silent||null;var ce=new YAHOO.util.CustomEvent(p_type,scope,silent,YAHOO.util.CustomEvent.FLAT);events[p_type]=ce;if(opts.onSubscribeCallback){ce.subscribeEvent.subscribe(opts.onSubscribeCallback);}
this.__yui_subscribers=this.__yui_subscribers||{};var qs=this.__yui_subscribers[p_type];if(qs){for(var i=0;i<qs.length;++i){ce.subscribe(qs[i].fn,qs[i].obj,qs[i].override);}}}
return events[p_type];},fireEvent:function(p_type,arg1,arg2,etc){this.__yui_events=this.__yui_events||{};var ce=this.__yui_events[p_type];if(ce){var args=[];for(var i=1;i<arguments.length;++i){args.push(arguments[i]);}
return ce.fire.apply(ce,args);}else{return null;}},hasEvent:function(type){if(this.__yui_events){if(this.__yui_events[type]){return true;}}
return false;}};YAHOO.util.KeyListener=function(attachTo,keyData,handler,event){if(!attachTo){}else if(!keyData){}else if(!handler){}
if(!event){event=YAHOO.util.KeyListener.KEYDOWN;}
var keyEvent=new YAHOO.util.CustomEvent("keyPressed");this.enabledEvent=new YAHOO.util.CustomEvent("enabled");this.disabledEvent=new YAHOO.util.CustomEvent("disabled");if(typeof attachTo=='string'){attachTo=document.getElementById(attachTo);}
if(typeof handler=='function'){keyEvent.subscribe(handler);}else{keyEvent.subscribe(handler.fn,handler.scope,handler.correctScope);}
function handleKeyPress(e,obj){if(!keyData.shift){keyData.shift=false;}
if(!keyData.alt){keyData.alt=false;}
if(!keyData.ctrl){keyData.ctrl=false;}
if(e.shiftKey==keyData.shift&&e.altKey==keyData.alt&&e.ctrlKey==keyData.ctrl){var dataItem;var keyPressed;if(keyData.keys instanceof Array){for(var i=0;i<keyData.keys.length;i++){dataItem=keyData.keys[i];if(dataItem==e.charCode){keyEvent.fire(e.charCode,e);break;}else if(dataItem==e.keyCode){keyEvent.fire(e.keyCode,e);break;}}}else{dataItem=keyData.keys;if(dataItem==e.charCode){keyEvent.fire(e.charCode,e);}else if(dataItem==e.keyCode){keyEvent.fire(e.keyCode,e);}}}}
this.enable=function(){if(!this.enabled){YAHOO.util.Event.addListener(attachTo,event,handleKeyPress);this.enabledEvent.fire(keyData);}
this.enabled=true;};this.disable=function(){if(this.enabled){YAHOO.util.Event.removeListener(attachTo,event,handleKeyPress);this.disabledEvent.fire(keyData);}
this.enabled=false;};this.toString=function(){return"KeyListener ["+keyData.keys+"] "+attachTo.tagName+
(attachTo.id?"["+attachTo.id+"]":"");};};YAHOO.util.KeyListener.KEYDOWN="keydown";YAHOO.util.KeyListener.KEYUP="keyup";YAHOO.register("event",YAHOO.util.Event,{version:"2.2.2",build:"204"});
// logger-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

YAHOO.widget.LogMsg=function(oConfigs){if(oConfigs&&(oConfigs.constructor==Object)){for(var param in oConfigs){this[param]=oConfigs[param];}}};YAHOO.widget.LogMsg.prototype.msg=null;YAHOO.widget.LogMsg.prototype.time=null;YAHOO.widget.LogMsg.prototype.category=null;YAHOO.widget.LogMsg.prototype.source=null;YAHOO.widget.LogMsg.prototype.sourceDetail=null;YAHOO.widget.LogWriter=function(sSource){if(!sSource){YAHOO.log("Could not instantiate LogWriter due to invalid source.","error","LogWriter");return;}
this._source=sSource;};YAHOO.widget.LogWriter.prototype.toString=function(){return"LogWriter "+this._sSource;};YAHOO.widget.LogWriter.prototype.log=function(sMsg,sCategory){YAHOO.widget.Logger.log(sMsg,sCategory,this._source);};YAHOO.widget.LogWriter.prototype.getSource=function(){return this._sSource;};YAHOO.widget.LogWriter.prototype.setSource=function(sSource){if(!sSource){YAHOO.log("Could not set source due to invalid source.","error",this.toString());return;}
else{this._sSource=sSource;}};YAHOO.widget.LogWriter.prototype._source=null;YAHOO.widget.LogReader=function(elContainer,oConfigs){var oSelf=this;this._sName=YAHOO.widget.LogReader._index;YAHOO.widget.LogReader._index++;if(oConfigs&&(oConfigs.constructor==Object)){for(var param in oConfigs){this[param]=oConfigs[param];}}
elContainer=YAHOO.util.Dom.get(elContainer);if(elContainer&&elContainer.tagName&&(elContainer.tagName.toLowerCase()=="div")){this._elContainer=elContainer;YAHOO.util.Dom.addClass(this._elContainer,"yui-log");}
else{this._elContainer=document.body.appendChild(document.createElement("div"));YAHOO.util.Dom.addClass(this._elContainer,"yui-log");YAHOO.util.Dom.addClass(this._elContainer,"yui-log-container");var containerStyle=this._elContainer.style;if(this.width){containerStyle.width=this.width;}
if(this.right){containerStyle.right=this.right;}
if(this.top){containerStyle.top=this.top;}
if(this.left){containerStyle.left=this.left;containerStyle.right="auto";}
if(this.bottom){containerStyle.bottom=this.bottom;containerStyle.top="auto";}
if(this.fontSize){containerStyle.fontSize=this.fontSize;}
if(navigator.userAgent.toLowerCase().indexOf("opera")!=-1){document.body.style+='';}}
if(this._elContainer){if(!this._elHd){this._elHd=this._elContainer.appendChild(document.createElement("div"));this._elHd.id="yui-log-hd"+this._sName;this._elHd.className="yui-log-hd";this._elCollapse=this._elHd.appendChild(document.createElement("div"));this._elCollapse.className="yui-log-btns";this._btnCollapse=document.createElement("input");this._btnCollapse.type="button";this._btnCollapse.style.fontSize=YAHOO.util.Dom.getStyle(this._elContainer,"fontSize");this._btnCollapse.className="yui-log-button";this._btnCollapse.value="Collapse";this._btnCollapse=this._elCollapse.appendChild(this._btnCollapse);YAHOO.util.Event.addListener(oSelf._btnCollapse,'click',oSelf._onClickCollapseBtn,oSelf);this._title=this._elHd.appendChild(document.createElement("h4"));this._title.innerHTML="Logger Console";}
if(!this._elConsole){this._elConsole=this._elContainer.appendChild(document.createElement("div"));this._elConsole.className="yui-log-bd";if(this.height){this._elConsole.style.height=this.height;}}
if(!this._elFt&&this.footerEnabled){this._elFt=this._elContainer.appendChild(document.createElement("div"));this._elFt.className="yui-log-ft";this._elBtns=this._elFt.appendChild(document.createElement("div"));this._elBtns.className="yui-log-btns";this._btnPause=document.createElement("input");this._btnPause.type="button";this._btnPause.style.fontSize=YAHOO.util.Dom.getStyle(this._elContainer,"fontSize");this._btnPause.className="yui-log-button";this._btnPause.value="Pause";this._btnPause=this._elBtns.appendChild(this._btnPause);YAHOO.util.Event.addListener(oSelf._btnPause,'click',oSelf._onClickPauseBtn,oSelf);this._btnClear=document.createElement("input");this._btnClear.type="button";this._btnClear.style.fontSize=YAHOO.util.Dom.getStyle(this._elContainer,"fontSize");this._btnClear.className="yui-log-button";this._btnClear.value="Clear";this._btnClear=this._elBtns.appendChild(this._btnClear);YAHOO.util.Event.addListener(oSelf._btnClear,'click',oSelf._onClickClearBtn,oSelf);this._elCategoryFilters=this._elFt.appendChild(document.createElement("div"));this._elCategoryFilters.className="yui-log-categoryfilters";this._elSourceFilters=this._elFt.appendChild(document.createElement("div"));this._elSourceFilters.className="yui-log-sourcefilters";}}
if(YAHOO.util.DD&&this.draggable){var ylog_dd=new YAHOO.util.DD(this._elContainer);ylog_dd.setHandleElId(this._elHd.id);this._elHd.style.cursor="move";}
if(!this._buffer){this._buffer=[];}
this._lastTime=YAHOO.widget.Logger.getStartTime();YAHOO.widget.Logger.newLogEvent.subscribe(this._onNewLog,this);YAHOO.widget.Logger.logResetEvent.subscribe(this._onReset,this);this._filterCheckboxes={};this._categoryFilters=[];var catsLen=YAHOO.widget.Logger.categories.length;if(this._elCategoryFilters){for(var i=0;i<catsLen;i++){this._createCategoryCheckbox(YAHOO.widget.Logger.categories[i]);}}
this._sourceFilters=[];var sourcesLen=YAHOO.widget.Logger.sources.length;if(this._elSourceFilters){for(var j=0;j<sourcesLen;j++){this._createSourceCheckbox(YAHOO.widget.Logger.sources[j]);}}
YAHOO.widget.Logger.categoryCreateEvent.subscribe(this._onCategoryCreate,this);YAHOO.widget.Logger.sourceCreateEvent.subscribe(this._onSourceCreate,this);this._filterLogs();YAHOO.log("LogReader initialized",null,this.toString());};YAHOO.widget.LogReader.prototype.logReaderEnabled=true;YAHOO.widget.LogReader.prototype.width=null;YAHOO.widget.LogReader.prototype.height=null;YAHOO.widget.LogReader.prototype.top=null;YAHOO.widget.LogReader.prototype.left=null;YAHOO.widget.LogReader.prototype.right=null;YAHOO.widget.LogReader.prototype.bottom=null;YAHOO.widget.LogReader.prototype.fontSize=null;YAHOO.widget.LogReader.prototype.footerEnabled=true;YAHOO.widget.LogReader.prototype.verboseOutput=true;YAHOO.widget.LogReader.prototype.newestOnTop=true;YAHOO.widget.LogReader.prototype.outputBuffer=100;YAHOO.widget.LogReader.prototype.thresholdMax=500;YAHOO.widget.LogReader.prototype.thresholdMin=100;YAHOO.widget.LogReader.prototype.isCollapsed=false;YAHOO.widget.LogReader.prototype.isPaused=false;YAHOO.widget.LogReader.prototype.draggable=true;YAHOO.widget.LogReader.prototype.toString=function(){return"LogReader instance"+this._sName;};YAHOO.widget.LogReader.prototype.pause=function(){this.isPaused=true;this._btnPause.value="Resume";this._timeout=null;this.logReaderEnabled=false;};YAHOO.widget.LogReader.prototype.resume=function(){this.isPaused=false;this._btnPause.value="Pause";this.logReaderEnabled=true;this._printBuffer();};YAHOO.widget.LogReader.prototype.hide=function(){this._elContainer.style.display="none";};YAHOO.widget.LogReader.prototype.show=function(){this._elContainer.style.display="block";};YAHOO.widget.LogReader.prototype.collapse=function(){this._elConsole.style.display="none";if(this._elFt){this._elFt.style.display="none";}
this._btnCollapse.value="Expand";this.isCollapsed=true;};YAHOO.widget.LogReader.prototype.expand=function(){this._elConsole.style.display="block";if(this._elFt){this._elFt.style.display="block";}
this._btnCollapse.value="Collapse";this.isCollapsed=false;};YAHOO.widget.LogReader.prototype.getCheckbox=function(filter){return this._filterCheckboxes[filter];};YAHOO.widget.LogReader.prototype.getCategories=function(){return this._categoryFilters;};YAHOO.widget.LogReader.prototype.showCategory=function(sCategory){var filtersArray=this._categoryFilters;if(filtersArray.indexOf){if(filtersArray.indexOf(sCategory)>-1){return;}}
else{for(var i=0;i<filtersArray.length;i++){if(filtersArray[i]===sCategory){return;}}}
this._categoryFilters.push(sCategory);this._filterLogs();this.getCheckbox(sCategory).checked=true;};YAHOO.widget.LogReader.prototype.hideCategory=function(sCategory){var filtersArray=this._categoryFilters;for(var i=0;i<filtersArray.length;i++){if(sCategory==filtersArray[i]){filtersArray.splice(i,1);break;}}
this._filterLogs();this.getCheckbox(sCategory).checked=false;};YAHOO.widget.LogReader.prototype.getSources=function(){return this._sourceFilters;};YAHOO.widget.LogReader.prototype.showSource=function(sSource){var filtersArray=this._sourceFilters;if(filtersArray.indexOf){if(filtersArray.indexOf(sSource)>-1){return;}}
else{for(var i=0;i<filtersArray.length;i++){if(sSource==filtersArray[i]){return;}}}
filtersArray.push(sSource);this._filterLogs();this.getCheckbox(sSource).checked=true;};YAHOO.widget.LogReader.prototype.hideSource=function(sSource){var filtersArray=this._sourceFilters;for(var i=0;i<filtersArray.length;i++){if(sSource==filtersArray[i]){filtersArray.splice(i,1);break;}}
this._filterLogs();this.getCheckbox(sSource).checked=false;};YAHOO.widget.LogReader.prototype.clearConsole=function(){this._timeout=null;this._buffer=[];this._consoleMsgCount=0;var elConsole=this._elConsole;while(elConsole.hasChildNodes()){elConsole.removeChild(elConsole.firstChild);}};YAHOO.widget.LogReader.prototype.setTitle=function(sTitle){this._title.innerHTML=this.html2Text(sTitle);};YAHOO.widget.LogReader.prototype.getLastTime=function(){return this._lastTime;};YAHOO.widget.LogReader.prototype.formatMsg=function(oLogMsg){var category=oLogMsg.category;var label=category.substring(0,4).toUpperCase();var time=oLogMsg.time;if(time.toLocaleTimeString){var localTime=time.toLocaleTimeString();}
else{localTime=time.toString();}
var msecs=time.getTime();var startTime=YAHOO.widget.Logger.getStartTime();var totalTime=msecs-startTime;var elapsedTime=msecs-this.getLastTime();var source=oLogMsg.source;var sourceDetail=oLogMsg.sourceDetail;var sourceAndDetail=(sourceDetail)?source+" "+sourceDetail:source;var msg=this.html2Text(oLogMsg.msg);var output=(this.verboseOutput)?["<pre class=\"yui-log-verbose\"><p><span class='",category,"'>",label,"</span> ",totalTime,"ms (+",elapsedTime,") ",localTime,": ","</p><p>",sourceAndDetail,": </p><p>",msg,"</p></pre>"]:["<pre><p><span class='",category,"'>",label,"</span> ",totalTime,"ms (+",elapsedTime,") ",localTime,": ",sourceAndDetail,": ",msg,"</p></pre>"];return output.join("");};YAHOO.widget.LogReader.prototype.html2Text=function(sHtml){if(sHtml){sHtml+="";return sHtml.replace(/&/g,"&#38;").replace(/</g,"&#60;").replace(/>/g,"&#62;");}
return"";};YAHOO.widget.LogReader._index=0;YAHOO.widget.LogReader.prototype._sName=null;YAHOO.widget.LogReader.prototype._buffer=null;YAHOO.widget.LogReader.prototype._consoleMsgCount=0;YAHOO.widget.LogReader.prototype._lastTime=null;YAHOO.widget.LogReader.prototype._timeout=null;YAHOO.widget.LogReader.prototype._filterCheckboxes=null;YAHOO.widget.LogReader.prototype._categoryFilters=null;YAHOO.widget.LogReader.prototype._sourceFilters=null;YAHOO.widget.LogReader.prototype._elContainer=null;YAHOO.widget.LogReader.prototype._elHd=null;YAHOO.widget.LogReader.prototype._elCollapse=null;YAHOO.widget.LogReader.prototype._btnCollapse=null;YAHOO.widget.LogReader.prototype._title=null;YAHOO.widget.LogReader.prototype._elConsole=null;YAHOO.widget.LogReader.prototype._elFt=null;YAHOO.widget.LogReader.prototype._elBtns=null;YAHOO.widget.LogReader.prototype._elCategoryFilters=null;YAHOO.widget.LogReader.prototype._elSourceFilters=null;YAHOO.widget.LogReader.prototype._btnPause=null;YAHOO.widget.LogReader.prototype._btnClear=null;YAHOO.widget.LogReader.prototype._createCategoryCheckbox=function(sCategory){var oSelf=this;if(this._elFt){var elParent=this._elCategoryFilters;var filters=this._categoryFilters;var elFilter=elParent.appendChild(document.createElement("span"));elFilter.className="yui-log-filtergrp";var chkCategory=document.createElement("input");chkCategory.id="yui-log-filter-"+sCategory+this._sName;chkCategory.className="yui-log-filter-"+sCategory;chkCategory.type="checkbox";chkCategory.category=sCategory;chkCategory=elFilter.appendChild(chkCategory);chkCategory.checked=true;filters.push(sCategory);YAHOO.util.Event.addListener(chkCategory,'click',oSelf._onCheckCategory,oSelf);var lblCategory=elFilter.appendChild(document.createElement("label"));lblCategory.htmlFor=chkCategory.id;lblCategory.className=sCategory;lblCategory.innerHTML=sCategory;this._filterCheckboxes[sCategory]=chkCategory;}};YAHOO.widget.LogReader.prototype._createSourceCheckbox=function(sSource){var oSelf=this;if(this._elFt){var elParent=this._elSourceFilters;var filters=this._sourceFilters;var elFilter=elParent.appendChild(document.createElement("span"));elFilter.className="yui-log-filtergrp";var chkSource=document.createElement("input");chkSource.id="yui-log-filter"+sSource+this._sName;chkSource.className="yui-log-filter"+sSource;chkSource.type="checkbox";chkSource.source=sSource;chkSource=elFilter.appendChild(chkSource);chkSource.checked=true;filters.push(sSource);YAHOO.util.Event.addListener(chkSource,'click',oSelf._onCheckSource,oSelf);var lblSource=elFilter.appendChild(document.createElement("label"));lblSource.htmlFor=chkSource.id;lblSource.className=sSource;lblSource.innerHTML=sSource;this._filterCheckboxes[sSource]=chkSource;}};YAHOO.widget.LogReader.prototype._filterLogs=function(){if(this._elConsole!==null){this.clearConsole();this._printToConsole(YAHOO.widget.Logger.getStack());}};YAHOO.widget.LogReader.prototype._printBuffer=function(){this._timeout=null;if(this._elConsole!==null){var thresholdMax=this.thresholdMax;thresholdMax=(thresholdMax&&!isNaN(thresholdMax))?thresholdMax:500;if(this._consoleMsgCount<thresholdMax){var entries=[];for(var i=0;i<this._buffer.length;i++){entries[i]=this._buffer[i];}
this._buffer=[];this._printToConsole(entries);}
else{this._filterLogs();}
if(!this.newestOnTop){this._elConsole.scrollTop=this._elConsole.scrollHeight;}}};YAHOO.widget.LogReader.prototype._printToConsole=function(aEntries){var entriesLen=aEntries.length;var thresholdMin=this.thresholdMin;if(isNaN(thresholdMin)||(thresholdMin>this.thresholdMax)){thresholdMin=0;}
var entriesStartIndex=(entriesLen>thresholdMin)?(entriesLen-thresholdMin):0;var sourceFiltersLen=this._sourceFilters.length;var categoryFiltersLen=this._categoryFilters.length;for(var i=entriesStartIndex;i<entriesLen;i++){var okToPrint=false;var okToFilterCats=false;var entry=aEntries[i];var source=entry.source;var category=entry.category;for(var j=0;j<sourceFiltersLen;j++){if(source==this._sourceFilters[j]){okToFilterCats=true;break;}}
if(okToFilterCats){for(var k=0;k<categoryFiltersLen;k++){if(category==this._categoryFilters[k]){okToPrint=true;break;}}}
if(okToPrint){var output=this.formatMsg(entry);if(this.newestOnTop){this._elConsole.innerHTML=output+this._elConsole.innerHTML;}
else{this._elConsole.innerHTML+=output;}
this._consoleMsgCount++;this._lastTime=entry.time.getTime();}}};YAHOO.widget.LogReader.prototype._onCategoryCreate=function(sType,aArgs,oSelf){var category=aArgs[0];if(oSelf._elFt){oSelf._createCategoryCheckbox(category);}};YAHOO.widget.LogReader.prototype._onSourceCreate=function(sType,aArgs,oSelf){var source=aArgs[0];if(oSelf._elFt){oSelf._createSourceCheckbox(source);}};YAHOO.widget.LogReader.prototype._onCheckCategory=function(v,oSelf){var category=this.category;if(!this.checked){oSelf.hideCategory(category);}
else{oSelf.showCategory(category);}};YAHOO.widget.LogReader.prototype._onCheckSource=function(v,oSelf){var source=this.source;if(!this.checked){oSelf.hideSource(source);}
else{oSelf.showSource(source);}};YAHOO.widget.LogReader.prototype._onClickCollapseBtn=function(v,oSelf){if(!oSelf.isCollapsed){oSelf.collapse();}
else{oSelf.expand();}};YAHOO.widget.LogReader.prototype._onClickPauseBtn=function(v,oSelf){if(!oSelf.isPaused){oSelf.pause();}
else{oSelf.resume();}};YAHOO.widget.LogReader.prototype._onClickClearBtn=function(v,oSelf){oSelf.clearConsole();};YAHOO.widget.LogReader.prototype._onNewLog=function(sType,aArgs,oSelf){var logEntry=aArgs[0];oSelf._buffer.push(logEntry);if(oSelf.logReaderEnabled===true&&oSelf._timeout===null){oSelf._timeout=setTimeout(function(){oSelf._printBuffer();},oSelf.outputBuffer);}};YAHOO.widget.LogReader.prototype._onReset=function(sType,aArgs,oSelf){oSelf._filterLogs();};YAHOO.widget.Logger={loggerEnabled:true,_browserConsoleEnabled:false,categories:["info","warn","error","time","window"],sources:["global"],_stack:[],maxStackEntries:2500,_startTime:new Date().getTime(),_lastTime:null};YAHOO.widget.Logger.log=function(sMsg,sCategory,sSource){if(this.loggerEnabled){if(!sCategory){sCategory="info";}
else{sCategory=sCategory.toLocaleLowerCase();if(this._isNewCategory(sCategory)){this._createNewCategory(sCategory);}}
var sClass="global";var sDetail=null;if(sSource){var spaceIndex=sSource.indexOf(" ");if(spaceIndex>0){sClass=sSource.substring(0,spaceIndex);sDetail=sSource.substring(spaceIndex,sSource.length);}
else{sClass=sSource;}
if(this._isNewSource(sClass)){this._createNewSource(sClass);}}
var timestamp=new Date();var logEntry=new YAHOO.widget.LogMsg({msg:sMsg,time:timestamp,category:sCategory,source:sClass,sourceDetail:sDetail});var stack=this._stack;var maxStackEntries=this.maxStackEntries;if(maxStackEntries&&!isNaN(maxStackEntries)&&(stack.length>=maxStackEntries)){stack.shift();}
stack.push(logEntry);this.newLogEvent.fire(logEntry);if(this._browserConsoleEnabled){this._printToBrowserConsole(logEntry);}
return true;}
else{return false;}};YAHOO.widget.Logger.reset=function(){this._stack=[];this._startTime=new Date().getTime();this.loggerEnabled=true;this.log("Logger reset");this.logResetEvent.fire();};YAHOO.widget.Logger.getStack=function(){return this._stack;};YAHOO.widget.Logger.getStartTime=function(){return this._startTime;};YAHOO.widget.Logger.disableBrowserConsole=function(){YAHOO.log("Logger output to the function console.log() has been disabled.");this._browserConsoleEnabled=false;};YAHOO.widget.Logger.enableBrowserConsole=function(){this._browserConsoleEnabled=true;YAHOO.log("Logger output to the function console.log() has been enabled.");};YAHOO.widget.Logger.categoryCreateEvent=new YAHOO.util.CustomEvent("categoryCreate",this,true);YAHOO.widget.Logger.sourceCreateEvent=new YAHOO.util.CustomEvent("sourceCreate",this,true);YAHOO.widget.Logger.newLogEvent=new YAHOO.util.CustomEvent("newLog",this,true);YAHOO.widget.Logger.logResetEvent=new YAHOO.util.CustomEvent("logReset",this,true);YAHOO.widget.Logger._createNewCategory=function(sCategory){this.categories.push(sCategory);this.categoryCreateEvent.fire(sCategory);};YAHOO.widget.Logger._isNewCategory=function(sCategory){for(var i=0;i<this.categories.length;i++){if(sCategory==this.categories[i]){return false;}}
return true;};YAHOO.widget.Logger._createNewSource=function(sSource){this.sources.push(sSource);this.sourceCreateEvent.fire(sSource);};YAHOO.widget.Logger._isNewSource=function(sSource){if(sSource){for(var i=0;i<this.sources.length;i++){if(sSource==this.sources[i]){return false;}}
return true;}};YAHOO.widget.Logger._printToBrowserConsole=function(oEntry){if(window.console&&console.log){var category=oEntry.category;var label=oEntry.category.substring(0,4).toUpperCase();var time=oEntry.time;if(time.toLocaleTimeString){var localTime=time.toLocaleTimeString();}
else{localTime=time.toString();}
var msecs=time.getTime();var elapsedTime=(YAHOO.widget.Logger._lastTime)?(msecs-YAHOO.widget.Logger._lastTime):0;YAHOO.widget.Logger._lastTime=msecs;var output=localTime+" ("+
elapsedTime+"ms): "+
oEntry.source+": "+
oEntry.msg;console.log(output);}};YAHOO.widget.Logger._onWindowError=function(sMsg,sUrl,sLine){try{YAHOO.widget.Logger.log(sMsg+' ('+sUrl+', line '+sLine+')',"window");if(YAHOO.widget.Logger._origOnWindowError){YAHOO.widget.Logger._origOnWindowError();}}
catch(e){return false;}};if(window.onerror){YAHOO.widget.Logger._origOnWindowError=window.onerror;}
window.onerror=YAHOO.widget.Logger._onWindowError;YAHOO.widget.Logger.log("Logger initialized");YAHOO.register("logger",YAHOO.widget.Logger,{version:"2.2.2",build:"204"});
// bhapi.js
/* isSubmitting GLOBAL FLAG, used to know if a form is being submited. */
	var isSubmitting=false;

 YAHOO.util.Connect.initHeader("Connection", "close", true);

/*Create the global Object BHAPI*/		
	var BHAPI = function(){}
	
	BHAPI.VisualEffect = {
		cursorWait: function() {
			var body = document.getElementsByTagName("body")[0];
			YAHOO.util.Dom.setStyle(body,"cursor","wait")
		},
		cursorClear: function() {
			var body = document.getElementsByTagName("body")[0];
			YAHOO.util.Dom.setStyle(body,"cursor","")
		},

		//function to set the focus to a specific element referenced by the passed id
		setFocusById: function(id){
    		if (navigator.appName.indexOf("Netscape") > -1 && navigator.appVersion.charAt(0) == "4" ) {
	 			return;    
    		}
			var element=document.getElementById(id);
			if (element) {
	    		element.focus();
			}
		}
	}
	
	/****************************************************************************
	*
	* 	CLASS: BHConnection
	*
	*****************************************************************************/
	BHAPI.BHConnection = function (url, method, showProgress){

		var url = url;
		var method = method;
		var showProgress = showProgress;

		//------------------ EVENT HANDLING -----------------------------
		//  The events
		var onSuccess = new YAHOO.util.CustomEvent("onSuccess", this);
		var onFailure = new YAHOO.util.CustomEvent("onFailure", this);

		// The subscriber methods
		this.subsOnSuccess = function(what, where){
			onSuccess.subscribe(what, where);
		}

		this.subsOnFailure = function(what, where){
			onFailure.subscribe(what, where);
		}

		//------------------ CONNECTION HANDLING -----------------------------
		// ---- Method to replace the ajax into the document... This should probably be refactored
		var ajaxReplace = function(o){
			//Update
			var U = "innerHTML=";
			//Dom Update
			var DU = "textContent+=";
	
			if(o.responseText !== undefined && o.responseText !== ''){
				var myObject = eval('(' + o.responseText + ')');
				for ( var i=0; i < myObject.length; i++){
					var action = myObject[i].action;
					var id = myObject[i].id;
					var params = myObject[i].parameters;
					YAHOO.log(i+". Action="+action+", ID="+id+", params="+params);
					//eval("document.getElementById('" + myObject[i].id + "')." + action + "'"+ myObject[i].parameters + "'");
					//eval("document.getElementById('" + myObject[i].id + "')." + action +  myObject[i].parameters );
					anElement = document.getElementById(id);
					if(anElement){
						if(action == 'D'){
							anElement.style.display='none'; 
						}
						if(action == 'U'){
							anElement.innerHTML=params;
							anElement.style.display='';
						}
						if(action == 'UV'){
							anElement.value=params;
						}
						YAHOO.log(i+". AjaxCommand completed");
					}else if(action === 'SV'){
						eval(id+"=\'"+params+"\'");
					}else{
						YAHOO.log(i+". AjaxCommand Not completed, Id="+id+" cannot be found");
					}
					
				}
				if(typeof bh_initializeListener==='function'){
					bh_initializeListener();
				}
			}
		};

		// ---- Connection Event Handling ---
		//What to do when te connection returns
		function connReturn(o){
	
	//TODO THESE MIGHT GO IN EVENT HANDLERS OUTSIDE THIS OBJECT!
			progressIndicator.Static.hide();
			//progressIndicator.Fader.hide();
			BHAPI.VisualEffect.cursorClear();
	
		}
	
		// What to do if the connection success
		function success(o){
			connReturn(o);
			YAHOO.log("AJAX success");
	//TODO ADD a beforAjaxReplace event
			ajaxReplace(o);
			onSuccess.fire();
		}
	
		// What to do if the connection fails
		function failure(o){
			connReturn(o)
			onFailure.fire();	
			document.location = 'displayError.wss';
		}
	
		// The callback Object...
		var callback = {success: success, failure: failure};

		// ---- Connection Methods ---
		// The connect method, connects to the SERVER!
		this.connect = function(){
			
			// show an hourglass
			BHAPI.VisualEffect.cursorWait();

			// show the progress Bar ?
			if(showProgress){
				progressIndicator.Static.show();
				//progressIndicator.Fader.show();
			}
				
			//CONNECT !!!
			return YAHOO.util.Connect.asyncRequest(method, url, callback);   

		/*========USED TO DEBUGG!!!! ======================
			alert("METHOD : " + method + "\n" + "URL : " + url);
			callback.success();
			callback.failure();
		===================================================*/
		}
	
	}

	/****************************************************************************
	*
	* 	CLASS: BHAPI.BHAsyncJsonGet
	*	Extends: BHAPI.BHConnection
	*
	*****************************************************************************/
	BHAPI.BHAsyncJsonGet = function(url, showProgress){
	 BHAPI.BHAsyncJsonGet.superclass.constructor.call(this, url, "GET", showProgress);  
	}
	YAHOO.lang.extend(BHAPI.BHAsyncJsonGet, BHAPI.BHConnection);

	/****************************************************************************
	*
	* 	CLASS: BHAPI.BHAsyncJsonFormSubmit
	*	Extends: BHAPI.BHConnection
	*
	*****************************************************************************/
	BHAPI.BHAsyncJsonFormSubmit = function(formObject, url, showProgress){
		BHAPI.BHAsyncJsonFormSubmit.superclass.constructor.call(this, url, "POST", showProgress);
		var formObject = formObject;
	
		//overwrite the connect method to set the form prior to connectig to the server
		oldConnect = this.connect;
		this.connect = function(){
			YAHOO.util.Connect.setForm(formObject);   
			return oldConnect();
		}
	}
	YAHOO.lang.extend(BHAPI.BHAsyncJsonFormSubmit, BHAPI.BHConnection);
	
	/****************************************************************************
	*
	* 	CLASS: BHAPI.Scroller
	*
	*****************************************************************************/

	/* -------------------------------------------------------------------------- */
	/* Functions to initialize and perform the scrolling anchor links. */
	/* -------------------------------------------------------------------------- */
	
	BHAPI.Scroller = function () {
	     
	    var stepIncrement = 50;// The number of pixels that each step moves the window.
	    var stepDelay = 10;// The number of milliseconds between steps.
	    var limit = 6 * 1000;// After 6 seconds the scroll is killed.
	    
	    var running = false;
	    
	    /* Recursive scrolling method. Steps through the complete scroll. */
	  
	   function scrollStep(to, dest, down) {
	    
	   if(!running || (down && to >= dest) || (!down && to <= dest)) {
	   BHAPI.Scroller.killScroll();
	   return;
	   }
	    
	   if((down && to >= (dest - (2 * stepIncrement))) ||
	   (!down && to <= (dest - (2 * stepIncrement)))) {
	   stepIncrement = stepIncrement * 0.55;
	   }
	    
	   window.scrollTo(0, to);
	    
	   // Assign the returned function to a public method.
	   BHAPI.Scroller.nextStep = callNext(+to + stepIncrement, dest, down);
	   window.setTimeout(BHAPI.Scroller.nextStep, stepDelay);
	   }
	    
	   /* Create a closure so that scrollStep can be accessed by window.setTimeout(). */
	    
	   function callNext(to, dest, down) {
	    
	   return function() { scrollStep(to, dest, down); };
	   }
	    
	   return {
	    
		   nextStep: null,
		   killTimeout: null,
		    
		   /* Sets up and calls scrollStep. */
		    
		   anchorScroll: function(e, obj) {
		    
			   var clickedLink = YAHOO.util.Event.getTarget(e);			   

			   if(clickedLink == null)
			   	clickedLink = e;
			   
			   if(clickedLink.href == null || clickedLink.href == '')
			   	 clickedLink = clickedLink.parentNode;		

			   if(clickedLink.href != null && clickedLink.href != ''){ 	   	 
				   var anchorId = clickedLink.href.replace(/^.*#/, '');
				   var target = YAHOO.util.Dom.get(anchorId);
				    
				   if(target || anchorId == 'top') {
					   YAHOO.util.Event.stopEvent(e);
					   running = true;
					    
					   var yCoord = ((YAHOO.util.Dom.getY(target) - 6) < 0) ? 0 : YAHOO.util.Dom.getY(target) - 6;
					   var currentYPosition = (document.all) ? document.body.scrollTop : window.pageYOffset;
					   var down = true;
					    
					   if(currentYPosition > yCoord) {
						   stepIncrement *= -1;// Reverse the direction if we are scrolling up.
						   down = false;
					   }
					    
					   // Stop the scroll once the time limit is reached.
					   BHAPI.Scroller.killTimeout = window.setTimeout(BHAPI.Scroller.killScroll, limit);
					    
					   // Start the scroll by calling scrollStep().
					   scrollStep(currentYPosition + stepIncrement, yCoord, down);
				   }
			   }
		   },
		    
		   /* Kill the scroll after a timeout, to prevent an endless loop. */
		    
		   killScroll: function() {
			   window.clearTimeout(BHAPI.Scroller.killTimeout);
			   running = false;
			   stepIncrement = 50;
		   },
			
			/* Function used to reposition the page based on the hidden parameter anchorPoint. */
			
			scrollToAnchorPoint: function() {
			   	var anchors = document.getElementsByName("anchorPoint");
				var target = null;
				
				if(anchors && anchors[0] && anchors[0].value!=''){
					var anchor = anchors[0].value;
					var index = anchor.indexOf("CONTROL_");
			 		if(index!=-1)	
			 			anchor = anchor.substring(index);

			   		target = YAHOO.util.Dom.get(anchor);
			   		
			   		if(target){
			   			target = ((YAHOO.util.Dom.getY(target) - 6) < 0) ? 0 : YAHOO.util.Dom.getY(target) - 6 - (screen.height * 25 / 100);
			   			running = true;
			   			BHAPI.Scroller.killTimeout = window.setTimeout(BHAPI.Scroller.killScroll, 200);
					    stepIncrement = target / 2;
					    stepDelay = 1;
					   	scrollStep(stepIncrement, target, true);
			   		}					
			 	}			 			
			},
			
			/* It scrolls automatically to items selected in Select Lists for a given form. */
			scrollToSelection: function(form){
				
				for(e = 0; e < form.elements.length; e++) {
				  elm = form.elements[e];
				  if(elm.type == "select-one" ) {
					var SelectObject = document.configForm.elements[elm.name];
				    SelectObject.selectedIndex = SelectObject.selectedIndex;
				  } else if(elm.type == "select-multiple" ) {
				    	var SelectObject = document.configForm.elements[elm.name];
					    for (var i=SelectObject.options.length-1; i>=0; i--) {
						   SelectObject.options[i].selected = SelectObject.options[i].selected;
				        }
				  }
				}
		   
            	if (form.displaySummary ) {
		        	form.displaySummary.value = "false"; 
            	}
				if (form.displayComparison ) {
	            	form.displayComparison.value = "false"; 
				}
			},
			
		   /* Attach the scrolling method to the links with the class 'scrolling-link'. */
		    
		   init: function() {
			   var links = YAHOO.util.Dom.getElementsByClassName('scrolling-link', 'a');
			   for ( var i=0; i < links.length; i++){
			   	YAHOO.util.Event.removeListener(links[i], 'click');
			   	YAHOO.util.Event.addListener(links[i], 'click', BHAPI.Scroller.anchorScroll, BHAPI.Scroller, true);
			   }
		   }
	   }
	    
	}(); 
	
	BHAPI.showPopup = {

		initializePanelDialog: function(o, a, wth){
			YAHOO.namespace("bh.container");
			var wth= wth;
			if (wth == null){
				wth = "400px";
			}
			//Html splitting in header and body
			var sections = (a[0].responseText).split("<!-- MASTHEAD_END -->");//MJM: be carefull here, any change in popuplayout should be checked here too.
			//Create DIV tag
			var newdiv = document.createElement('div');
			newdiv.setAttribute("id","bhPanelDialog");
			window.document.body.appendChild(newdiv);
			//Create the panel
			YAHOO.bh.container.panel1 = new YAHOO.widget.Panel("bhPanelDialog", { width:wth , height:"430px", fixedcenter: true, visible:false, draggable:true, modal:true ,constraintoviewport:true } );
			YAHOO.bh.container.panel1.setHeader(sections[0]);
			YAHOO.bh.container.panel1.setBody(sections[1]);
			YAHOO.bh.container.panel1.render();
			progressIndicator.Static.hide();
			BHAPI.VisualEffect.cursorClear();
			YAHOO.bh.container.panel1.show();
			
			//Add the mask's listener
			YAHOO.util.Event.addListener("dialogCancel", "click", YAHOO.bh.container.panel1.destroy, YAHOO.bh.container.panel1, true);
			YAHOO.util.Event.addListener("bhPanelDialog_mask", "click", YAHOO.bh.container.panel1.destroy, YAHOO.bh.container.panel1, true);
			YAHOO.util.Event.addListener("dialogConfirm", "click", YAHOO.bh.container.panel1.hide, YAHOO.bh.container.panel1, true);
		},
		
		show: function (url, wth){
			url = url + '&rtail='+ Math.random()*5;
			bhGet = new BHAPI.BHAsyncHtmlGet(url);
			bhGet.subsOnSuccess(function(o,a){BHAPI.showPopup.initializePanelDialog(o,a,wth);}, this);
			bhGet.connect();
		}
	
	} 
	
	BHAPI.BHAsyncHtmlGet = function(url){
			//alert(url);	
			var url = url;
					//------------------ EVENT HANDLING -----------------------------	
						//  The events
								var onSuccess = new YAHOO.util.CustomEvent("onSuccess", this);
								var onFailure = new YAHOO.util.CustomEvent("onFailure", this);
						// The subscriber methods
								this.subsOnSuccess = function(what, where){
											onSuccess.subscribe(what, where);
											}	
								this.subsOnFailure = function(what, where){
											onFailure.subscribe(what, where);		
											}	
						// What to do if the connection success
								function success(o){
											YAHOO.log("AJAX success" + o);
											onSuccess.fire(o);		
								}		
						// What to do if the connection fails
								function failure(o){	
										onFailure.fire();	
								}	
						// The callback Object...		
								var callback = {success: success, failure: failure};
				// ---- Connection Methods ---		
						// The connect method, connects to the SERVER!		
								this.connect = function(){		
									return YAHOO.util.Connect.asyncRequest("GET", url, callback);callback.success(); callback.failure(); 
						  		}
 	};	
// bubbling.js

(function() {
  var $Y = YAHOO.util,
	  $E = YAHOO.util.Event,
	  $D = YAHOO.util.Dom,
	  $L = YAHOO.lang,
	  $  = YAHOO.util.Dom.get;

  /**
  * @class Bubble
  */
  BHAPI.Bubble = function () {
  	var obj = {};
	
    var navigateActionsControl = function (layer, args) {
	  obj.processingAction (layer, args, obj.navigateActions);
    };
	var	changeActionsControl = function (layer, args) {
	  obj.processingAction (layer, args, obj.changeActions);
	};
	// public vars
	obj.ready = false;
	obj.bubble = { // CustomEvent Handles
		          navigate: new $Y.CustomEvent('navigate'),
		          change: 	new $Y.CustomEvent('change')
				};
	
	obj.onEventTrigger = function(b, e, m){
	  e = e || $E.getEvent();
	  m = m || {};
	  m.action = b;
	  m.target = (e?$E.getTarget(e):null);
	  m.decrepitate = false;
	  m.event = e;
	  m.stop = false;
	  this.bubble[b].fire(e, m);
	  if (m.stop) {
	  	$E.stopEvent(e);
	  }
	};
	obj.onNavigate = function(e){
	  this.onEventTrigger ('navigate', e);
	  this.onChange (e);
	};

	obj.onChange = function(e){
	  this.onEventTrigger('change', e);
	};

	/**
	* * This represent the elimination of an event
	* @public
	* @param {object} e Referencia al evento
	* @return void
	*/
	obj.eventGarbage = function (e) {
	  if ($L.isObject(e)) {
	    $E.stopEvent(e);
	  }
	  return false;
	};
	
	/**
	* * This method determine the default action for an element
	* @public
	* @param {object} el        element reference
	* @param {object} actions   object with the list of posibles actions
	* @return void
	*/
	obj.getActionName = function (el, depot) {
	  depot = depot || {};
	  var result = {};
	  var b = null, r = null,
	      f = ($D.inDocument(el)?function(b){return $D.hasClass(el, b)}:function(b){return el.hasClass(b);}); // f: check is certain object has a classname
	  if (el && ($L.isObject(el) || (el = $( el )))) {
	  	try{
			r = el.getAttribute("rel"); // if rel is available...
		}catch(e){};
		var qty = 0;
		for (b in depot) { // behaviors in the depot...
			if ((depot.hasOwnProperty(b)) && (f(b) || (b === r))) {
				result[qty++] = b;
			}
		}
	  }
	  return result;
	};
	
	// remove and add all classes from the element that are passed by parameter
	obj.replaceClasses = function (el, removeClasses, addClasses){
		var remC = removeClasses || [];
		var addC = addClasses || [];
		for(i=0;i<remC.length;i++)
	 		$D.removeClass(el, remC[i]);
		for(j=0;j<addC.length;j++)
			$D.addClass(el, addC[j]);
	};
	/*****************************************************************************************
	 * Ajax Custom Navigation Events
	 *****************************************************************************************/

	obj.processingAction = function (layer, args, actions) {
      var behaviors = null;
	  if (!args[1].decrepitate) {
	  	var el = args[1].target;
	  	while(el) {	  	  	
		  behaviors = this.getActionName ( el, actions );	
		   
		  var executed = false;
		  var executed2 = false;
		  for(b in behaviors) {
		  	if(actions[behaviors[b]][0].apply(args[1], [layer, args]))		
		  		executed = true;
		  	this.replaceClasses(el, actions[behaviors[b]][1], actions[behaviors[b]][2]);
		  	executed2 = true;
		  }
		  if(executed){
		    this.eventGarbage(args[0]);
			args[1].decrepitate = true;
			args[1].stop = true;
			break;
		  }	
		  if(executed2)
		   break;
		  if (el.tagName == "BODY")
			break;
			
		  el = el.parentNode;
		}
	  }
	};
	
	obj.navigateActions = {
	};
    obj.addNavigateAction = function (n, f, rc, ac) {
		if (n && f && (!this.navigateActions.hasOwnProperty(n))) {
		  	this.navigateActions[n] = [f,rc,ac];
		}
    };
    obj.addNavigateActions = function (actions) {
    	actions = actions || {}
	 	for(i=0;i<actions.length;i++) {
	 		var action = actions[i];
			this.addNavigateAction(action[0],action[1],action[2],action[3]);
		}
	};
    
    obj.changeActions = {
	};
    obj.addChangeAction = function (n, f, rc, ac) {
		if (n && f && (!this.changeActions.hasOwnProperty(n))) {
		 var func = function (layer, args) {
		 				if(args[1].target!=null){
		 					var exist = false;
		 					var listeners = $E.getListeners(args[1].target,"change");
		 					for(i=0;listeners!=null && i<listeners.size();i++) 
		 						if(listeners[i].fn == f)
		 							exist = true;
		 					if(!exist)
								$E.addListener(args[1].target, "change", f, args);
	    				}
		 			};
		 this.changeActions[n] = [func,rc,ac];
		}
    };
	obj.addChangeActions = function (actions) {
		actions = actions || {}
	 	for(i=0;i<actions.length;i++) {
	 		var action = actions[i];
			this.addChangeAction(action[0],action[1],action[2]);
		}
	};
	
	
	// default behaviors
	//$E.addListener(window, "resize", obj.onRepaint, obj, true);

	// default Suscriptions
	obj.bubble.navigate.subscribe(navigateActionsControl);
	obj.bubble.change.subscribe(changeActionsControl);

	// initialization inside the selfconstructor
	obj.init = function () {
	  if (!this.ready) {
	    var el = document.body;
	    $E.addListener(el, "click", obj.onNavigate, obj, true);
	    
		this.ready = true;
	  }
	};
	$E.onDOMReady(obj.init, obj, true);
	return obj;
  }();
})();
// GlobalBehaviors.js
BHAPI.Bubble.globalBehaviors = function (){
	var behavior = {};

	behavior.hrefOverwrite = function (layer,args){
		var element = YAHOO.util.Event.getTarget(args[0]);
		if(element.href==null)
			element = element.parentNode;
		if(element && element.href!=null)
			element.href="javascript:void(0)"
	}
	
	behavior.displayMessageAA = function (layer,args){
		var event = args[0];
		var element = YAHOO.util.Event.getTarget(event);
		var url = element.href;
		var mode=document.forms['pageLayoutForm'].showMessageAA.value;
		var pattern = 'closeSession.wss';
		if(mode=='false'){
			if(url.search(pattern) == -1){
				window.location.href=url;
			}
			else {
				window.location.href='displayHomePage.wss';
			}
		} 
		else{
			BHAPI.showPopup.show('displayMessagePopUp.wss?url=' + url);
		}
	}
	
	return behavior;
}();
// GlobalMapping.js
BHAPI.Bubble.createGlobalActions = function (){
	
	var behaviors = BHAPI.Bubble.globalBehaviors;
	
	var clickActions = new Array(
						['ibm.first', behaviors.displayMessageAA],
						['hrefOverwriteAction', behaviors.hrefOverwrite]
					   );
	
	BHAPI.Bubble.addNavigateActions(clickActions);
}

YAHOO.util.Event.onDOMReady(BHAPI.Bubble.createGlobalActions);
// CommonFunctions.js
// Functions to submit a form.
//   Default is to perform the Check Config - otherwise
//   the caller needs to specify not to.  The default check-config
//   flag should be a blank or null so that when JavaScript is
//   turned off the Check Config will still work properly.
// defect 587: Release10_cd3. fixed scroll bar to no for the createHelpWindow.
// defect 1908: UI_110. Enlarged the product detail browser window 

//function to submit the config and ras forms
function executeSubmit(form)  
{
if(!isSubmitting){
	isSubmitting=true;
	form.onsubmit = "";
	form.submit();
}else{
	if(submissionMessage && submissionMessage!=""){
		alert(submissionMessage);
	}
}
  progressIndicator.Static.hide();
  BHAPI.VisualEffect.cursorClear();

}   

// function used for the double submission
// specially needed for when the button
// implies no new page like the save button
// in this case, 7 seconds are used to wait,
// the resets the flag and the action can be called
// again
function countdown(count){
 count--; 
 if (count>0){
	 var func = "countdown(";
	 func = func + count;
	 func = func + ")";
     Id = window.setTimeout(func,1000); 
 } else {
   isSubmitting=false;
 }
}


function jsSubmit(form, trigger)
  {
  form.trigger.value = trigger;
  executeSubmit(form);
  //form.submit();
  }		

//function to set the focus to the add to cart button 
function setFocusById(id)
{
    if (navigator.appName.indexOf("Netscape") > -1 && navigator.appVersion.charAt(0) == "4" ) {
	 	return;    
    }
	var element=document.getElementById(id);
	if (element) {
	    element.focus();
	}
}

// function to disable the Enter key for the control
function disableSubmit(evt)
{
    if (navigator.appName.indexOf("Netscape") > -1 && navigator.appVersion.charAt(0) == "4" ) {
	 	return true;
    }
    var pK = document.all? window.event.keyCode:evt.which;
	return pK != 13;	 	
}


//help popup window accepting title bar parameter
var newwin;
function createHelpWindow(fileName, title, heading1)
  { 
    //newwin = window.open('displayPopup.wss?filename=' + fileName + '&source=' + title + '&heading1=' + heading1, 'help', 'status=no,resizable=yes,scrollbars=yes,width=500,height=400,left=290,top=250');	   
    bhWindowOpen('displayPopup.wss?filename=' + fileName + '&source=' + title + '&heading1=' + heading1, 'help', 'status=no,resizable=yes,scrollbars=yes,width=500,height=400,left=290,top=250');	   
  }  

var globalFuncName;
var globalArgs;

function bhWindowOpen(){
	newwin = window.open(bhWindowOpen.arguments[0],bhWindowOpen.arguments[1],bhWindowOpen.arguments[2]);	
}

function callBackErrorHandler(message){
	window.location.href='displayNav.wss';
}

//popup to external sites
function popup(fileName)
  {
   var newwin = window.open(fileName, 'pop', 'status=no,resizable=yes,scrollbars=yes,width=600,height=450,left=290,top=250');
  }
  
//pagehelp popup window accepting parameters for title bar, heading1(Customize etc), and prod description  
function createPageHelpWindow(fileName, title, heading1 , proddesc)
  {
    //newwin = window.open('displayPopup.wss?filename=' + fileName + '&source=' + title + '&heading1=' + heading1 + '&proddesc=' + proddesc, 'help', 'status=no,resizable=yes,scrollbars=yes,width=500,height=400,left=290,top=250');	   
    bhWindowOpen('displayPopup.wss?filename=' + fileName + '&source=' + title + '&heading1=' + heading1 + '&proddesc=' + proddesc, 'help', 'status=no,resizable=yes,scrollbars=yes,width=500,height=400,left=290,top=250');	   
  }     

//page repositioning, is executed in the onload event of the body tag
function getAnchorPosition(anchorname)
{

var useWindow=false;var coordinates=new Object();var x=0,y=0;var use_gebi=false, 
use_css=false, use_layers=false;if(document.getElementById){use_gebi=true;}
else if(document.all){use_css=true;}else if(document.layers){
use_layers=true;}
if(use_gebi && document.all){
x=AnchorPosition_getPageOffsetLeft(document.all[anchorname]);
y=AnchorPosition_getPageOffsetTop(document.all[anchorname]);}else if(use_gebi)
{var o=document.getElementById(anchorname);x=AnchorPosition_getPageOffsetLeft(o);
y=AnchorPosition_getPageOffsetTop(o);}
else if(use_css){x=AnchorPosition_getPageOffsetLeft(document.all[anchorname]);
y=AnchorPosition_getPageOffsetTop(document.all[anchorname]);}else if(use_layers)
{
var found=0;for(var i=0;i<document.anchors.length;i++){var aname='id'+document.anchors[i].name;if(aname==anchorname)
{found=1;break;}}if(found==0){coordinates.x=0;coordinates.y=0;return coordinates.y;}x=document.anchors[i].x;
y=document.anchors[i].y;}else{coordinates.x=0;coordinates.y=0;return coordinates.y;}
coordinates.x=x;coordinates.y=y;return coordinates.y;}

function getAnchorWindowPosition(anchorname){
	var coordinates=getAnchorPosition(anchorname);
	var x=0;
	var y=0;
	if(document.getElementById){
		if(isNaN(window.screenX)){
			x=coordinates.x-document.body.scrollLeft+window.screenLeft;
			y=coordinates.y-document.body.scrollTop+window.screenTop;
		}else{
			x=coordinates.x+window.screenX+(window.outerWidth-window.innerWidth)-window.pageXOffset;
			y=coordinates.y+window.screenY+(window.outerHeight-24-window.innerHeight)-window.pageYOffset;
		}
	}else if(document.all){
		x=coordinates.x-document.body.scrollLeft+window.screenLeft;
		y=coordinates.y-document.body.scrollTop+window.screenTop;
	}else if(document.layers){
		x=coordinates.x+window.screenX+(window.outerWidth-window.innerWidth)-window.pageXOffset;
		y=coordinates.y+window.screenY+(window.outerHeight-24-window.innerHeight)-window.pageYOffset;
	}
	coordinates.x=x;
	coordinates.y=y;
	return coordinates;
}

function AnchorPosition_getPageOffsetLeft(el){
	var ol=el.offsetLeft;
	el=el.offsetParent;
	while(el != null){
		ol += el.offsetLeft;
		el=el.offsetParent;
	}
	return ol;
}

function AnchorPosition_getWindowOffsetLeft(el){
	return AnchorPosition_getPageOffsetLeft(el)-document.body.scrollLeft;
}

function AnchorPosition_getPageOffsetTop(el){
	var ot=el.offsetTop;
	el=el.offsetParent;
	while(el != null){
		ot += el.offsetTop;
		el=el.offsetParent;
	}
	return ot;
}

function AnchorPosition_getWindowOffsetTop(el){
	return AnchorPosition_getPageOffsetTop(el)-document.body.scrollTop;
}

// Functions used by the newer version of the Repositioning, that shows the
// selected control close to the center of the Screen, taking into accoun the resoultion
function repositionPage() {

        if(document.forms['configForm'] && document.forms['configForm'].anchorPoint && document.forms['configForm'].anchorPoint.value!=''){
                window.location.hash=document.forms['configForm'].anchorPoint.value;
                window.location.hash.link();

				var iPos = document.forms['configForm'].anchorPoint.value.indexOf("CONTROL_");
                
                if ( iPos!= -1) {
                    var coordenates = getAnchorPosition("id"+document.forms['configForm'].anchorPoint.value);
                    self.scroll(1,coordenates - (screen.height * 25 / 100) );
                }
        }
        
        if (document.forms['configForm']) {
        	form = document.forms['configForm'];
        	
     	
			// It scrolls automatically to items selected in Select Lists
			for(e = 0; e < form.elements.length; e++) {
				  elm = form.elements[e];
				  if(elm.type == "select-one" ) {
					var SelectObject = document.configForm.elements[elm.name];
				    SelectObject.selectedIndex = SelectObject.selectedIndex;
				  } else if(elm.type == "select-multiple" ) {
				    	var SelectObject = document.configForm.elements[elm.name];
					    for (var i=SelectObject.options.length-1; i>=0; i--) {
						   SelectObject.options[i].selected = SelectObject.options[i].selected;
				        }
				  }
			}
		    // End it scrolls automatically to items selected in Select Lists

        	
            if (form.displaySummary ) {
		        form.displaySummary.value = "false"; 
            }
			if (form.displayComparison ) {
	            form.displayComparison.value = "false"; 
			}
  	    }
        // set the initial focus to first object with id='primary' or 'secondary'		
        if (document.forms['newProducts']) {
        	form = document.forms['newProducts'];
      		setFocusById("secondary"); 
		} else {
			setFocusById("primary");
		}	


		// Analyses and determines the focus for the Translator Pages
		if(document.forms['translatorFocusForm'] && document.forms['translatorFocusForm'].anchorPoint && document.forms['translatorFocusForm'].anchorPoint.value!=''){
			window.location.hash=document.forms['translatorFocusForm'].anchorPoint.value;
			window.location.hash.link();
		}

                
}

  
function showProductInfo(controlName){
	var field = eval("document.forms['configForm']."+controlName);
	var fieldValue = '';
	
	if(field){//Exist control
		if(field.options){ //Is select
			fieldValue = field.options[field.selectedIndex].value;
		}else if(field.type=="checkbox"){ //Is checkbox
			if(field.checked){
				fieldValue = field.value;
			}
		}else if(field.length && field.length>0 && field[0].type=="radio"){ //Is radio
			var radios = field;
			var idValue='';
			for(i=0;i<field.length;i++){
				if(field[i].checked){
					idValue = field[i].value;
				}
			}
			if(idValue!=''){
				fieldValue = idValue;
			}
		}
		
		if(fieldValue!=''){
			productLink = document.forms['configForm'].productLink.value;
			var fileName = productLink + fieldValue.substring(fieldValue.indexOf(document.forms['configForm'].CONST_CPN_JS.value)+4);

			//window.open('displayPartInformation.wss?productDetailUrl='+fileName, 'pop', 'status=no,resizable=yes,scrollbars=yes,width=600,height=450,left=290,top=250');
			var sizeX = screen.availWidth * 0.8;
	        var sizeY = screen.availHeight * 0.8;

			//window.open('displayPartInformation.wss?productDetailUrl='+fileName, 'pop', "status=yes,resizable=yes,scrollbars=yes,height="+sizeY+",width="+sizeX+", menubar=yes, toolbar=yes,directories=yes, location=yes,left=150,top=150");			
			bhWindowOpen('displayPartInformation.wss?productDetailUrl='+fileName, 'pop', "status=yes,resizable=yes,scrollbars=yes,height="+sizeY+",width="+sizeX+", menubar=yes, toolbar=yes,directories=yes, location=yes,left=150,top=150");			
		}else{
			createHelpWindow('noselectionmade.html');
		}
	}
}
//function to submit the config and ras forms
function executeSubmitNav(form, actionTarget)  
{
	BHAPI.VisualEffect.cursorWait();
	bh_summary_behaviors_showStaticProgressIndicator();
	executeNoProgressSubmitNav(form, actionTarget);
}

function executeNoProgressSubmitNav(form, actionTarget){
	form.action=actionTarget;
	executeSubmit(form);
}


function ackSARMessage() {
	BHAPI.VisualEffect.cursorWait();
	bh_summary_behaviors_showStaticProgressIndicator();
	var form = window.document.forms['navigatorForm'];
	eval(form).action="ackSARMessage.wss";
	eval(form).submit();
}




function executeConfirmChangeSettings(actionTarget)  {
	
	var locale = document.changeSettingsForm.Control_LocaleList.value;
	var primaryCurrency = document.changeSettingsForm.Control_PrimaryCurrencies.value;
	var secondaryCurrency = document.changeSettingsForm.Control_SecondaryCurrencies.value;
	
	window.opener.document.newProducts.Control_LocaleList.value=locale
	window.opener.document.newProducts.Control_PrimaryCurrencies.value=primaryCurrency;
	window.opener.document.newProducts.Control_SecondaryCurrencies.value=secondaryCurrency;
	var result = actionTarget + "?" + "Control_LocaleList=" + locale + "&Control_PrimaryCurrencies=" + primaryCurrency + "&Control_SecondaryCurrencies=" + secondaryCurrency;
	
	form=window.opener.document.forms[1];
	eval(form).action=result;
	eval(form).submit();
	window.close();
}

function executeConfirmCopyDelete(form, actionTarget, param, defaultQty) {
	var result = "";
	window.opener.document.navigatorForm.CopyDelete_contextId.value=param;
	if(form=='copyConfirm'){
		//var qty = document.copyDeleteForm.CID_Copy_QTY.value; //TODO: RAB - delete this once the copyProduct SIL's method has changed
		var qty = 1;
		//window.opener.document.navigatorForm.CID_Copy_QTY.value=qty; //TODO: RAB - delete this once the copyProduct SIL's method has changed
		result = actionTarget + "?" + "CopyDelete_contextId=" + param + "&CID_Copy_QTY=" + qty ;
	} else {
		var deepDelete = document.copyDeleteForm.DEEP_DELETE.value;
		result = actionTarget + "?" + "CopyDelete_contextId=" + param + "&DEEP_DELETE=" + deepDelete;;
	}

	window.close();
	form=window.opener.document.forms['navigatorForm'];
	eval(form).action=result;
	eval(window.opener).progressIndicator.Static.show();
	eval(form).submit();
}

function executeCloseSession() {
	var result = "";
	result = "closeSession.wss";
	form=window.opener.document.forms['navigatorForm'];
	eval(form).action=result;
	eval(form).submit();
	window.close();
}

function confirmSelection(url) {
	var currencyOptions = eval("document.forms['currencySelectionForm'].currency");
	var selectedCurrency = '';
	
	if(currencyOptions){//Exist control
		var idValue='';
		for(i=0;i<currencyOptions.length;i++){
			if(currencyOptions[i].checked){
				idValue = currencyOptions[i].value;
			}		
		}
	
		if(idValue!=''){
			selectedCurrency = idValue;
		}
	}
	
	var finalURL = url + '?currency=' + selectedCurrency;	
	window.opener.location.href=finalURL;
	window.close();
}

//display popup window
function displayPopUp(fileName, title, heading1, url) {
	//newwin = window.open('displayMessagePopUp.wss?filename=' + fileName + '&source=' + title + '&heading1=' + heading1 + '&url=' + url, 'help', 'status=no,resizable=yes,scrollbars=yes,width=500,height=400,left=290,top=250');
	bhWindowOpen('displayMessagePopUp.wss?filename=' + fileName + '&source=' + title + '&heading1=' + heading1 + '&url=' + url, 'help', 'status=no,resizable=yes,scrollbars=yes,width=500,height=400,left=290,top=250');
}

function executeConfirmPopUp(url) {
	form=window.opener.document.forms[1];
	eval(form).action="closeSession.wss";
	eval(form).submit();
	window.close();
}

function displayWindow(url) {
	form=document.forms[0];
	eval(form).action=url;
	eval(form).submit();
}

//display confirm popup window
function displayMessagePopUp(fileName, title, heading1, url) {
	var mode=document.forms['pageLayoutForm'].showMessageAA.value;
	if (mode=='true') {
		//newwin = window.open('displayMessagePopUp.wss?filename=' + fileName + '&source=' + title + '&heading1=' + heading1 + '&url=' + url, 'help', 'status=no,resizable=yes,scrollbars=yes,width=500,height=400,left=290,top=250');
		bhWindowOpen('displayMessagePopUp.wss?filename=' + fileName + '&source=' + title + '&heading1=' + heading1 + '&url=' + url, 'help', 'status=no,resizable=yes,scrollbars=yes,width=500,height=400,left=290,top=250');
	} else {
		window.location.href=url;
	}
} //end function
// dragdrop-min.js
/*
Copyright (c) 2007, Yahoo! Inc. All rights reserved.
Code licensed under the BSD License:
http://developer.yahoo.net/yui/license.txt
version: 2.2.2
*/

if(!YAHOO.util.DragDropMgr){YAHOO.util.DragDropMgr=function(){var Event=YAHOO.util.Event;return{ids:{},handleIds:{},dragCurrent:null,dragOvers:{},deltaX:0,deltaY:0,preventDefault:true,stopPropagation:true,initalized:false,locked:false,interactionInfo:null,init:function(){this.initialized=true;},POINT:0,INTERSECT:1,STRICT_INTERSECT:2,mode:0,_execOnAll:function(sMethod,args){for(var i in this.ids){for(var j in this.ids[i]){var oDD=this.ids[i][j];if(!this.isTypeOfDD(oDD)){continue;}
oDD[sMethod].apply(oDD,args);}}},_onLoad:function(){this.init();Event.on(document,"mouseup",this.handleMouseUp,this,true);Event.on(document,"mousemove",this.handleMouseMove,this,true);Event.on(window,"unload",this._onUnload,this,true);Event.on(window,"resize",this._onResize,this,true);},_onResize:function(e){this._execOnAll("resetConstraints",[]);},lock:function(){this.locked=true;},unlock:function(){this.locked=false;},isLocked:function(){return this.locked;},locationCache:{},useCache:true,clickPixelThresh:3,clickTimeThresh:1000,dragThreshMet:false,clickTimeout:null,startX:0,startY:0,regDragDrop:function(oDD,sGroup){if(!this.initialized){this.init();}
if(!this.ids[sGroup]){this.ids[sGroup]={};}
this.ids[sGroup][oDD.id]=oDD;},removeDDFromGroup:function(oDD,sGroup){if(!this.ids[sGroup]){this.ids[sGroup]={};}
var obj=this.ids[sGroup];if(obj&&obj[oDD.id]){delete obj[oDD.id];}},_remove:function(oDD){for(var g in oDD.groups){if(g&&this.ids[g][oDD.id]){delete this.ids[g][oDD.id];}}
delete this.handleIds[oDD.id];},regHandle:function(sDDId,sHandleId){if(!this.handleIds[sDDId]){this.handleIds[sDDId]={};}
this.handleIds[sDDId][sHandleId]=sHandleId;},isDragDrop:function(id){return(this.getDDById(id))?true:false;},getRelated:function(p_oDD,bTargetsOnly){var oDDs=[];for(var i in p_oDD.groups){for(j in this.ids[i]){var dd=this.ids[i][j];if(!this.isTypeOfDD(dd)){continue;}
if(!bTargetsOnly||dd.isTarget){oDDs[oDDs.length]=dd;}}}
return oDDs;},isLegalTarget:function(oDD,oTargetDD){var targets=this.getRelated(oDD,true);for(var i=0,len=targets.length;i<len;++i){if(targets[i].id==oTargetDD.id){return true;}}
return false;},isTypeOfDD:function(oDD){return(oDD&&oDD.__ygDragDrop);},isHandle:function(sDDId,sHandleId){return(this.handleIds[sDDId]&&this.handleIds[sDDId][sHandleId]);},getDDById:function(id){for(var i in this.ids){if(this.ids[i][id]){return this.ids[i][id];}}
return null;},handleMouseDown:function(e,oDD){this.currentTarget=YAHOO.util.Event.getTarget(e);this.dragCurrent=oDD;var el=oDD.getEl();this.startX=YAHOO.util.Event.getPageX(e);this.startY=YAHOO.util.Event.getPageY(e);this.deltaX=this.startX-el.offsetLeft;this.deltaY=this.startY-el.offsetTop;this.dragThreshMet=false;this.clickTimeout=setTimeout(function(){var DDM=YAHOO.util.DDM;DDM.startDrag(DDM.startX,DDM.startY);},this.clickTimeThresh);},startDrag:function(x,y){clearTimeout(this.clickTimeout);if(this.dragCurrent){this.dragCurrent.b4StartDrag(x,y);this.dragCurrent.startDrag(x,y);}
this.dragThreshMet=true;},handleMouseUp:function(e){if(!this.dragCurrent){return;}
clearTimeout(this.clickTimeout);if(this.dragThreshMet){this.fireEvents(e,true);}else{}
this.stopDrag(e);this.stopEvent(e);},stopEvent:function(e){if(this.stopPropagation){YAHOO.util.Event.stopPropagation(e);}
if(this.preventDefault){YAHOO.util.Event.preventDefault(e);}},stopDrag:function(e){if(this.dragCurrent){if(this.dragThreshMet){this.dragCurrent.b4EndDrag(e);this.dragCurrent.endDrag(e);}
this.dragCurrent.onMouseUp(e);}
this.dragCurrent=null;this.dragOvers={};},handleMouseMove:function(e){if(!this.dragCurrent){return true;}
if(YAHOO.util.Event.isIE&&!e.button){this.stopEvent(e);return this.handleMouseUp(e);}
if(!this.dragThreshMet){var diffX=Math.abs(this.startX-YAHOO.util.Event.getPageX(e));var diffY=Math.abs(this.startY-YAHOO.util.Event.getPageY(e));if(diffX>this.clickPixelThresh||diffY>this.clickPixelThresh){this.startDrag(this.startX,this.startY);}}
if(this.dragThreshMet){this.dragCurrent.b4Drag(e);this.dragCurrent.onDrag(e);this.fireEvents(e,false);}
this.stopEvent(e);return true;},fireEvents:function(e,isDrop){var dc=this.dragCurrent;if(!dc||dc.isLocked()){return;}
var x=YAHOO.util.Event.getPageX(e);var y=YAHOO.util.Event.getPageY(e);var pt=new YAHOO.util.Point(x,y);var pos=dc.getTargetCoord(pt.x,pt.y);var el=dc.getDragEl();curRegion=new YAHOO.util.Region(pos.y,pos.x+el.offsetWidth,pos.y+el.offsetHeight,pos.x);var oldOvers=[];var outEvts=[];var overEvts=[];var dropEvts=[];var enterEvts=[];for(var i in this.dragOvers){var ddo=this.dragOvers[i];if(!this.isTypeOfDD(ddo)){continue;}
if(!this.isOverTarget(pt,ddo,this.mode,curRegion)){outEvts.push(ddo);}
oldOvers[i]=true;delete this.dragOvers[i];}
for(var sGroup in dc.groups){if("string"!=typeof sGroup){continue;}
for(i in this.ids[sGroup]){var oDD=this.ids[sGroup][i];if(!this.isTypeOfDD(oDD)){continue;}
if(oDD.isTarget&&!oDD.isLocked()&&oDD!=dc){if(this.isOverTarget(pt,oDD,this.mode,curRegion)){if(isDrop){dropEvts.push(oDD);}else{if(!oldOvers[oDD.id]){enterEvts.push(oDD);}else{overEvts.push(oDD);}
this.dragOvers[oDD.id]=oDD;}}}}}
this.interactionInfo={out:outEvts,enter:enterEvts,over:overEvts,drop:dropEvts,point:pt,draggedRegion:curRegion,sourceRegion:this.locationCache[dc.id],validDrop:isDrop};if(isDrop&&!dropEvts.length){this.interactionInfo.validDrop=false;dc.onInvalidDrop(e);}
if(this.mode){if(outEvts.length){dc.b4DragOut(e,outEvts);dc.onDragOut(e,outEvts);}
if(enterEvts.length){dc.onDragEnter(e,enterEvts);}
if(overEvts.length){dc.b4DragOver(e,overEvts);dc.onDragOver(e,overEvts);}
if(dropEvts.length){dc.b4DragDrop(e,dropEvts);dc.onDragDrop(e,dropEvts);}}else{var len=0;for(i=0,len=outEvts.length;i<len;++i){dc.b4DragOut(e,outEvts[i].id);dc.onDragOut(e,outEvts[i].id);}
for(i=0,len=enterEvts.length;i<len;++i){dc.onDragEnter(e,enterEvts[i].id);}
for(i=0,len=overEvts.length;i<len;++i){dc.b4DragOver(e,overEvts[i].id);dc.onDragOver(e,overEvts[i].id);}
for(i=0,len=dropEvts.length;i<len;++i){dc.b4DragDrop(e,dropEvts[i].id);dc.onDragDrop(e,dropEvts[i].id);}}},getBestMatch:function(dds){var winner=null;var len=dds.length;if(len==1){winner=dds[0];}else{for(var i=0;i<len;++i){var dd=dds[i];if(this.mode==this.INTERSECT&&dd.cursorIsOver){winner=dd;break;}else{if(!winner||!winner.overlap||(dd.overlap&&winner.overlap.getArea()<dd.overlap.getArea())){winner=dd;}}}}
return winner;},refreshCache:function(groups){var g=groups||this.ids;for(var sGroup in g){if("string"!=typeof sGroup){continue;}
for(var i in this.ids[sGroup]){var oDD=this.ids[sGroup][i];if(this.isTypeOfDD(oDD)){var loc=this.getLocation(oDD);if(loc){this.locationCache[oDD.id]=loc;}else{delete this.locationCache[oDD.id];}}}}},verifyEl:function(el){try{if(el){var parent=el.offsetParent;if(parent){return true;}}}catch(e){}
return false;},getLocation:function(oDD){if(!this.isTypeOfDD(oDD)){return null;}
var el=oDD.getEl(),pos,x1,x2,y1,y2,t,r,b,l;try{pos=YAHOO.util.Dom.getXY(el);}catch(e){}
if(!pos){return null;}
x1=pos[0];x2=x1+el.offsetWidth;y1=pos[1];y2=y1+el.offsetHeight;t=y1-oDD.padding[0];r=x2+oDD.padding[1];b=y2+oDD.padding[2];l=x1-oDD.padding[3];return new YAHOO.util.Region(t,r,b,l);},isOverTarget:function(pt,oTarget,intersect,curRegion){var loc=this.locationCache[oTarget.id];if(!loc||!this.useCache){loc=this.getLocation(oTarget);this.locationCache[oTarget.id]=loc;}
if(!loc){return false;}
oTarget.cursorIsOver=loc.contains(pt);var dc=this.dragCurrent;if(!dc||(!intersect&&!dc.constrainX&&!dc.constrainY)){return oTarget.cursorIsOver;}
oTarget.overlap=null;if(!curRegion){var pos=dc.getTargetCoord(pt.x,pt.y);var el=dc.getDragEl();curRegion=new YAHOO.util.Region(pos.y,pos.x+el.offsetWidth,pos.y+el.offsetHeight,pos.x);}
var overlap=curRegion.intersect(loc);if(overlap){oTarget.overlap=overlap;return(intersect)?true:oTarget.cursorIsOver;}else{return false;}},_onUnload:function(e,me){this.unregAll();},unregAll:function(){if(this.dragCurrent){this.stopDrag();this.dragCurrent=null;}
this._execOnAll("unreg",[]);for(i in this.elementCache){delete this.elementCache[i];}
this.elementCache={};this.ids={};},elementCache:{},getElWrapper:function(id){var oWrapper=this.elementCache[id];if(!oWrapper||!oWrapper.el){oWrapper=this.elementCache[id]=new this.ElementWrapper(YAHOO.util.Dom.get(id));}
return oWrapper;},getElement:function(id){return YAHOO.util.Dom.get(id);},getCss:function(id){var el=YAHOO.util.Dom.get(id);return(el)?el.style:null;},ElementWrapper:function(el){this.el=el||null;this.id=this.el&&el.id;this.css=this.el&&el.style;},getPosX:function(el){return YAHOO.util.Dom.getX(el);},getPosY:function(el){return YAHOO.util.Dom.getY(el);},swapNode:function(n1,n2){if(n1.swapNode){n1.swapNode(n2);}else{var p=n2.parentNode;var s=n2.nextSibling;if(s==n1){p.insertBefore(n1,n2);}else if(n2==n1.nextSibling){p.insertBefore(n2,n1);}else{n1.parentNode.replaceChild(n2,n1);p.insertBefore(n1,s);}}},getScroll:function(){var t,l,dde=document.documentElement,db=document.body;if(dde&&(dde.scrollTop||dde.scrollLeft)){t=dde.scrollTop;l=dde.scrollLeft;}else if(db){t=db.scrollTop;l=db.scrollLeft;}else{}
return{top:t,left:l};},getStyle:function(el,styleProp){return YAHOO.util.Dom.getStyle(el,styleProp);},getScrollTop:function(){return this.getScroll().top;},getScrollLeft:function(){return this.getScroll().left;},moveToEl:function(moveEl,targetEl){var aCoord=YAHOO.util.Dom.getXY(targetEl);YAHOO.util.Dom.setXY(moveEl,aCoord);},getClientHeight:function(){return YAHOO.util.Dom.getViewportHeight();},getClientWidth:function(){return YAHOO.util.Dom.getViewportWidth();},numericSort:function(a,b){return(a-b);},_timeoutCount:0,_addListeners:function(){var DDM=YAHOO.util.DDM;if(YAHOO.util.Event&&document){DDM._onLoad();}else{if(DDM._timeoutCount>2000){}else{setTimeout(DDM._addListeners,10);if(document&&document.body){DDM._timeoutCount+=1;}}}},handleWasClicked:function(node,id){if(this.isHandle(id,node.id)){return true;}else{var p=node.parentNode;while(p){if(this.isHandle(id,p.id)){return true;}else{p=p.parentNode;}}}
return false;}};}();YAHOO.util.DDM=YAHOO.util.DragDropMgr;YAHOO.util.DDM._addListeners();}
(function(){var Event=YAHOO.util.Event;var Dom=YAHOO.util.Dom;YAHOO.util.DragDrop=function(id,sGroup,config){if(id){this.init(id,sGroup,config);}};YAHOO.util.DragDrop.prototype={id:null,config:null,dragElId:null,handleElId:null,invalidHandleTypes:null,invalidHandleIds:null,invalidHandleClasses:null,startPageX:0,startPageY:0,groups:null,locked:false,lock:function(){this.locked=true;},unlock:function(){this.locked=false;},isTarget:true,padding:null,_domRef:null,__ygDragDrop:true,constrainX:false,constrainY:false,minX:0,maxX:0,minY:0,maxY:0,deltaX:0,deltaY:0,maintainOffset:false,xTicks:null,yTicks:null,primaryButtonOnly:true,available:false,hasOuterHandles:false,b4StartDrag:function(x,y){},startDrag:function(x,y){},b4Drag:function(e){},onDrag:function(e){},onDragEnter:function(e,id){},b4DragOver:function(e){},onDragOver:function(e,id){},b4DragOut:function(e){},onDragOut:function(e,id){},b4DragDrop:function(e){},onDragDrop:function(e,id){},onInvalidDrop:function(e){},b4EndDrag:function(e){},endDrag:function(e){},b4MouseDown:function(e){},onMouseDown:function(e){},onMouseUp:function(e){},onAvailable:function(){},getEl:function(){if(!this._domRef){this._domRef=Dom.get(this.id);}
return this._domRef;},getDragEl:function(){return Dom.get(this.dragElId);},init:function(id,sGroup,config){this.initTarget(id,sGroup,config);Event.on(this.id,"mousedown",this.handleMouseDown,this,true);},initTarget:function(id,sGroup,config){this.config=config||{};this.DDM=YAHOO.util.DDM;this.groups={};if(typeof id!=="string"){id=Dom.generateId(id);}
this.id=id;this.addToGroup((sGroup)?sGroup:"default");this.handleElId=id;Event.onAvailable(id,this.handleOnAvailable,this,true);this.setDragElId(id);this.invalidHandleTypes={A:"A"};this.invalidHandleIds={};this.invalidHandleClasses=[];this.applyConfig();},applyConfig:function(){this.padding=this.config.padding||[0,0,0,0];this.isTarget=(this.config.isTarget!==false);this.maintainOffset=(this.config.maintainOffset);this.primaryButtonOnly=(this.config.primaryButtonOnly!==false);},handleOnAvailable:function(){this.available=true;this.resetConstraints();this.onAvailable();},setPadding:function(iTop,iRight,iBot,iLeft){if(!iRight&&0!==iRight){this.padding=[iTop,iTop,iTop,iTop];}else if(!iBot&&0!==iBot){this.padding=[iTop,iRight,iTop,iRight];}else{this.padding=[iTop,iRight,iBot,iLeft];}},setInitPosition:function(diffX,diffY){var el=this.getEl();if(!this.DDM.verifyEl(el)){return;}
var dx=diffX||0;var dy=diffY||0;var p=Dom.getXY(el);this.initPageX=p[0]-dx;this.initPageY=p[1]-dy;this.lastPageX=p[0];this.lastPageY=p[1];this.setStartPosition(p);},setStartPosition:function(pos){var p=pos||Dom.getXY(this.getEl());this.deltaSetXY=null;this.startPageX=p[0];this.startPageY=p[1];},addToGroup:function(sGroup){this.groups[sGroup]=true;this.DDM.regDragDrop(this,sGroup);},removeFromGroup:function(sGroup){if(this.groups[sGroup]){delete this.groups[sGroup];}
this.DDM.removeDDFromGroup(this,sGroup);},setDragElId:function(id){this.dragElId=id;},setHandleElId:function(id){if(typeof id!=="string"){id=Dom.generateId(id);}
this.handleElId=id;this.DDM.regHandle(this.id,id);},setOuterHandleElId:function(id){if(typeof id!=="string"){id=Dom.generateId(id);}
Event.on(id,"mousedown",this.handleMouseDown,this,true);this.setHandleElId(id);this.hasOuterHandles=true;},unreg:function(){Event.removeListener(this.id,"mousedown",this.handleMouseDown);this._domRef=null;this.DDM._remove(this);},isLocked:function(){return(this.DDM.isLocked()||this.locked);},handleMouseDown:function(e,oDD){var button=e.which||e.button;if(this.primaryButtonOnly&&button>1){return;}
if(this.isLocked()){return;}
this.b4MouseDown(e);this.onMouseDown(e);this.DDM.refreshCache(this.groups);var pt=new YAHOO.util.Point(Event.getPageX(e),Event.getPageY(e));if(!this.hasOuterHandles&&!this.DDM.isOverTarget(pt,this)){}else{if(this.clickValidator(e)){this.setStartPosition();this.DDM.handleMouseDown(e,this);this.DDM.stopEvent(e);}else{}}},clickValidator:function(e){var target=Event.getTarget(e);return(this.isValidHandleChild(target)&&(this.id==this.handleElId||this.DDM.handleWasClicked(target,this.id)));},getTargetCoord:function(iPageX,iPageY){var x=iPageX-this.deltaX;var y=iPageY-this.deltaY;if(this.constrainX){if(x<this.minX){x=this.minX;}
if(x>this.maxX){x=this.maxX;}}
if(this.constrainY){if(y<this.minY){y=this.minY;}
if(y>this.maxY){y=this.maxY;}}
x=this.getTick(x,this.xTicks);y=this.getTick(y,this.yTicks);return{x:x,y:y};},addInvalidHandleType:function(tagName){var type=tagName.toUpperCase();this.invalidHandleTypes[type]=type;},addInvalidHandleId:function(id){if(typeof id!=="string"){id=Dom.generateId(id);}
this.invalidHandleIds[id]=id;},addInvalidHandleClass:function(cssClass){this.invalidHandleClasses.push(cssClass);},removeInvalidHandleType:function(tagName){var type=tagName.toUpperCase();delete this.invalidHandleTypes[type];},removeInvalidHandleId:function(id){if(typeof id!=="string"){id=Dom.generateId(id);}
delete this.invalidHandleIds[id];},removeInvalidHandleClass:function(cssClass){for(var i=0,len=this.invalidHandleClasses.length;i<len;++i){if(this.invalidHandleClasses[i]==cssClass){delete this.invalidHandleClasses[i];}}},isValidHandleChild:function(node){var valid=true;var nodeName;try{nodeName=node.nodeName.toUpperCase();}catch(e){nodeName=node.nodeName;}
valid=valid&&!this.invalidHandleTypes[nodeName];valid=valid&&!this.invalidHandleIds[node.id];for(var i=0,len=this.invalidHandleClasses.length;valid&&i<len;++i){valid=!Dom.hasClass(node,this.invalidHandleClasses[i]);}
return valid;},setXTicks:function(iStartX,iTickSize){this.xTicks=[];this.xTickSize=iTickSize;var tickMap={};for(var i=this.initPageX;i>=this.minX;i=i-iTickSize){if(!tickMap[i]){this.xTicks[this.xTicks.length]=i;tickMap[i]=true;}}
for(i=this.initPageX;i<=this.maxX;i=i+iTickSize){if(!tickMap[i]){this.xTicks[this.xTicks.length]=i;tickMap[i]=true;}}
this.xTicks.sort(this.DDM.numericSort);},setYTicks:function(iStartY,iTickSize){this.yTicks=[];this.yTickSize=iTickSize;var tickMap={};for(var i=this.initPageY;i>=this.minY;i=i-iTickSize){if(!tickMap[i]){this.yTicks[this.yTicks.length]=i;tickMap[i]=true;}}
for(i=this.initPageY;i<=this.maxY;i=i+iTickSize){if(!tickMap[i]){this.yTicks[this.yTicks.length]=i;tickMap[i]=true;}}
this.yTicks.sort(this.DDM.numericSort);},setXConstraint:function(iLeft,iRight,iTickSize){this.leftConstraint=parseInt(iLeft,10);this.rightConstraint=parseInt(iRight,10);this.minX=this.initPageX-this.leftConstraint;this.maxX=this.initPageX+this.rightConstraint;if(iTickSize){this.setXTicks(this.initPageX,iTickSize);}
this.constrainX=true;},clearConstraints:function(){this.constrainX=false;this.constrainY=false;this.clearTicks();},clearTicks:function(){this.xTicks=null;this.yTicks=null;this.xTickSize=0;this.yTickSize=0;},setYConstraint:function(iUp,iDown,iTickSize){this.topConstraint=parseInt(iUp,10);this.bottomConstraint=parseInt(iDown,10);this.minY=this.initPageY-this.topConstraint;this.maxY=this.initPageY+this.bottomConstraint;if(iTickSize){this.setYTicks(this.initPageY,iTickSize);}
this.constrainY=true;},resetConstraints:function(){if(this.initPageX||this.initPageX===0){var dx=(this.maintainOffset)?this.lastPageX-this.initPageX:0;var dy=(this.maintainOffset)?this.lastPageY-this.initPageY:0;this.setInitPosition(dx,dy);}else{this.setInitPosition();}
if(this.constrainX){this.setXConstraint(this.leftConstraint,this.rightConstraint,this.xTickSize);}
if(this.constrainY){this.setYConstraint(this.topConstraint,this.bottomConstraint,this.yTickSize);}},getTick:function(val,tickArray){if(!tickArray){return val;}else if(tickArray[0]>=val){return tickArray[0];}else{for(var i=0,len=tickArray.length;i<len;++i){var next=i+1;if(tickArray[next]&&tickArray[next]>=val){var diff1=val-tickArray[i];var diff2=tickArray[next]-val;return(diff2>diff1)?tickArray[i]:tickArray[next];}}
return tickArray[tickArray.length-1];}},toString:function(){return("DragDrop "+this.id);}};})();YAHOO.util.DD=function(id,sGroup,config){if(id){this.init(id,sGroup,config);}};YAHOO.extend(YAHOO.util.DD,YAHOO.util.DragDrop,{scroll:true,autoOffset:function(iPageX,iPageY){var x=iPageX-this.startPageX;var y=iPageY-this.startPageY;this.setDelta(x,y);},setDelta:function(iDeltaX,iDeltaY){this.deltaX=iDeltaX;this.deltaY=iDeltaY;},setDragElPos:function(iPageX,iPageY){var el=this.getDragEl();this.alignElWithMouse(el,iPageX,iPageY);},alignElWithMouse:function(el,iPageX,iPageY){var oCoord=this.getTargetCoord(iPageX,iPageY);if(!this.deltaSetXY){var aCoord=[oCoord.x,oCoord.y];YAHOO.util.Dom.setXY(el,aCoord);var newLeft=parseInt(YAHOO.util.Dom.getStyle(el,"left"),10);var newTop=parseInt(YAHOO.util.Dom.getStyle(el,"top"),10);this.deltaSetXY=[newLeft-oCoord.x,newTop-oCoord.y];}else{YAHOO.util.Dom.setStyle(el,"left",(oCoord.x+this.deltaSetXY[0])+"px");YAHOO.util.Dom.setStyle(el,"top",(oCoord.y+this.deltaSetXY[1])+"px");}
this.cachePosition(oCoord.x,oCoord.y);this.autoScroll(oCoord.x,oCoord.y,el.offsetHeight,el.offsetWidth);},cachePosition:function(iPageX,iPageY){if(iPageX){this.lastPageX=iPageX;this.lastPageY=iPageY;}else{var aCoord=YAHOO.util.Dom.getXY(this.getEl());this.lastPageX=aCoord[0];this.lastPageY=aCoord[1];}},autoScroll:function(x,y,h,w){if(this.scroll){var clientH=this.DDM.getClientHeight();var clientW=this.DDM.getClientWidth();var st=this.DDM.getScrollTop();var sl=this.DDM.getScrollLeft();var bot=h+y;var right=w+x;var toBot=(clientH+st-y-this.deltaY);var toRight=(clientW+sl-x-this.deltaX);var thresh=40;var scrAmt=(document.all)?80:30;if(bot>clientH&&toBot<thresh){window.scrollTo(sl,st+scrAmt);}
if(y<st&&st>0&&y-st<thresh){window.scrollTo(sl,st-scrAmt);}
if(right>clientW&&toRight<thresh){window.scrollTo(sl+scrAmt,st);}
if(x<sl&&sl>0&&x-sl<thresh){window.scrollTo(sl-scrAmt,st);}}},applyConfig:function(){YAHOO.util.DD.superclass.applyConfig.call(this);this.scroll=(this.config.scroll!==false);},b4MouseDown:function(e){this.setStartPosition();this.autoOffset(YAHOO.util.Event.getPageX(e),YAHOO.util.Event.getPageY(e));},b4Drag:function(e){this.setDragElPos(YAHOO.util.Event.getPageX(e),YAHOO.util.Event.getPageY(e));},toString:function(){return("DD "+this.id);}});YAHOO.util.DDProxy=function(id,sGroup,config){if(id){this.init(id,sGroup,config);this.initFrame();}};YAHOO.util.DDProxy.dragElId="ygddfdiv";YAHOO.extend(YAHOO.util.DDProxy,YAHOO.util.DD,{resizeFrame:true,centerFrame:false,createFrame:function(){var self=this;var body=document.body;if(!body||!body.firstChild){setTimeout(function(){self.createFrame();},50);return;}
var div=this.getDragEl();if(!div){div=document.createElement("div");div.id=this.dragElId;var s=div.style;s.position="absolute";s.visibility="hidden";s.cursor="move";s.border="2px solid #aaa";s.zIndex=999;body.insertBefore(div,body.firstChild);}},initFrame:function(){this.createFrame();},applyConfig:function(){YAHOO.util.DDProxy.superclass.applyConfig.call(this);this.resizeFrame=(this.config.resizeFrame!==false);this.centerFrame=(this.config.centerFrame);this.setDragElId(this.config.dragElId||YAHOO.util.DDProxy.dragElId);},showFrame:function(iPageX,iPageY){var el=this.getEl();var dragEl=this.getDragEl();var s=dragEl.style;this._resizeProxy();if(this.centerFrame){this.setDelta(Math.round(parseInt(s.width,10)/2),Math.round(parseInt(s.height,10)/2));}
this.setDragElPos(iPageX,iPageY);YAHOO.util.Dom.setStyle(dragEl,"visibility","visible");},_resizeProxy:function(){if(this.resizeFrame){var DOM=YAHOO.util.Dom;var el=this.getEl();var dragEl=this.getDragEl();var bt=parseInt(DOM.getStyle(dragEl,"borderTopWidth"),10);var br=parseInt(DOM.getStyle(dragEl,"borderRightWidth"),10);var bb=parseInt(DOM.getStyle(dragEl,"borderBottomWidth"),10);var bl=parseInt(DOM.getStyle(dragEl,"borderLeftWidth"),10);if(isNaN(bt)){bt=0;}
if(isNaN(br)){br=0;}
if(isNaN(bb)){bb=0;}
if(isNaN(bl)){bl=0;}
var newWidth=Math.max(0,el.offsetWidth-br-bl);var newHeight=Math.max(0,el.offsetHeight-bt-bb);DOM.setStyle(dragEl,"width",newWidth+"px");DOM.setStyle(dragEl,"height",newHeight+"px");}},b4MouseDown:function(e){this.setStartPosition();var x=YAHOO.util.Event.getPageX(e);var y=YAHOO.util.Event.getPageY(e);this.autoOffset(x,y);this.setDragElPos(x,y);},b4StartDrag:function(x,y){this.showFrame(x,y);},b4EndDrag:function(e){YAHOO.util.Dom.setStyle(this.getDragEl(),"visibility","hidden");},endDrag:function(e){var DOM=YAHOO.util.Dom;var lel=this.getEl();var del=this.getDragEl();DOM.setStyle(del,"visibility","");DOM.setStyle(lel,"visibility","hidden");YAHOO.util.DDM.moveToEl(lel,del);DOM.setStyle(del,"visibility","hidden");DOM.setStyle(lel,"visibility","");},toString:function(){return("DDProxy "+this.id);}});YAHOO.util.DDTarget=function(id,sGroup,config){if(id){this.initTarget(id,sGroup,config);}};YAHOO.extend(YAHOO.util.DDTarget,YAHOO.util.DragDrop,{toString:function(){return("DDTarget "+this.id);}});YAHOO.register("dragdrop",YAHOO.util.DragDropMgr,{version:"2.2.2",build:"204"});