/**
 * @description <p>General Tools.</p>
 * @module Tools
 * @version 1.2
 * @namespace YAHOO
 * @requires yahoo, dom, event
*/
/**
 * @description <p>General Tools.</p><p>Now contains a modified version of Douglas Crockford's json.js that doesn't
 * mess with the DOM's prototype methods
 * http://www.json.org/js.html</p>
 * @class Tools
 * @static
 * @namespace YAHOO
 * @requires yahoo, dom, event
*/
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        /**
        * @private
        * @property keyStr
        * @description The key string to use for base64Encode/Decode.
        */
        keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
        /**
        * @private
        * @property jsonCodes
        * @description The string codes for encodeStr.
        */
        jsonCodes = {
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"' : '\\"',
            '\\': '\\\\'
        },

        /**
        * @private
        * @property tools_version
        * @description The version number of YAHOO.Tools
        */
        tools_version = '1.5',

        /**
        * @private
        * @property tools_build
        * @description The build number of YAHOO.Tools
        */
        tools_build = '180',
        /**
        * @private
        * @property regExs
        * @description All regexes at the top level object to cache them.
        */
        regExs = {
            quotes: /\x22/g,
            startspace: /^\s+/g,
            endspace: /\s+$/g,
            striptags: /<\/?[^>]+>/gi,
            hasbr: /<br/i,
            hasp: /<p>/i,
            rbr: /<br>/gi,
            rbr2: /<br\/>/gi,
            rendp: /<\/p>/gi,
            rp: /<p>/gi,
            base64: /[^A-Za-z0-9\+\/\=]/g,
            syntaxCheck: /^("(\\.|[^"\\\n\r])*?"|[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t])+?$/
        };

    YAHOO.Tools = {
        /**
        * @method clipStyle
        * @description This function is meant to temporarily "clip" a given style to something else while retaining the old one for later use
        * @param {String/HTMLElement} elm The element to clip the style of
        * @param {String} _name The name of the style that you want to clip
        * @param {String} _style The new style to set once the old one is clipped
        */
        clipStyle: function(elm, _name, _style) {
            elm = Dom.get(elm);
            if (!elm._style) {
                elm._style = {};
            }
            elm._style['_' + _name] = Dom.getStyle(elm, _name);
            return Dom.setStyle(elm, _name, _style);
        },

        /**
        * @method unclipStyle
        * @description This function is meant to undo the effects of clipStyle
        * @param {String/HTMLElement} elm The element to clip the style of
        * @param {String} _name The name of the style that you want to clip
        */
        unclipStyle: function(elm, _name) {
            elm = Dom.get(elm);
            var out;
            if (elm._style['_' + _name]) {
                out = Dom.setStyle(elm, _name, elm._style['_' + _name]);
                delete elm._style[_name];
            } else {
                out = false;
            }
            return out;
        },

        /**
        * @method getHeight
        * @description This normalizes getting the height of an element in IE
        * @param {String/HTMLElement} elm The element to get the height of
        * @returns The Height in pixels
        * @type String
        */
        getHeight: function(elm) {
            return YAHOO.Tools.getSizes().height;
        },
        /**
        * @method getSize
        * @description This normalizes getting the height and width of an element
        * @param {String/HTMLElement} elm The element to get the size of
        * @returns An object of height and width
        * @type Object
        */
        getSizes: function(elm) {
            elm = Dom.get(elm);
            var br = YAHOO.Tools.getBrowserAgent(),
                out = {},
                clipped = false;
            if (Dom.getStyle(elm, 'display') == 'none') {
                clipped = true;
                YAHOO.Tools.clipStyle(elm, 'position', 'absolute');
                YAHOO.Tools.clipStyle(elm, 'visibility', 'hidden');
                Dom.setStyle(elm, 'display', 'block');
            }
            out.height = Dom.getStyle(elm, 'height');
            out.width = Dom.getStyle(elm, 'width');

            if (br.ie) {
                //IE treat differently
                if (out.height == 'auto') {
                    elm.style.zoom = 1;
                    out.height = elm.clientHeight + 'px';
                }
            }

            if (clipped) {
                Dom.setStyle(elm, 'display', 'none');
                YAHOO.Tools.clipStyle(elm, 'position');
                YAHOO.Tools.clipStyle(elm, 'visibility');
            }
            return out;
        },
        /**
        * @method getCenter
        * @description Get the XY coords required to place the element at the center of the screen
        * @param {String/HTMLElement} elm The element to place at the center of the screen
        * @returns The XY coords required to place the element at the center of the screen
        * @type Array
        */
        getCenter: function(elm) {
            elm = Dom.get(elm);
            var cX = Math.round((Dom.getViewportWidth() - parseInt(Dom.getStyle(elm, 'width'), 10)) / 2);
            var cY = Math.round((Dom.getViewportHeight() - parseInt(YAHOO.Tools.getHeight(elm), 10)) / 2);
            return [cX, cY];
        },

        /**
        * @method makeTextObject
        * @description Converts a text string into a DOM object
        * @param {String} txt String to convert
        * @returns A string to a textNode
        */
        makeTextObject: function(txt) {
            return document.createTextNode(txt);
        },
        /**
        * @method makeChildren
        * @description Takes an Array of DOM objects and appends them as a child to the main Element
        * @param {Array} arr Array of elements to append to elm.
        * @param {HTMLElement/String} elm A reference or ID to the main Element that the children will be appended to
        */
        makeChildren: function(arr, elm) {
            elm = Dom.get(elm);
            for (var i in arr) {
                var _val = arr[i];
                if (typeof _val == 'string') {
                    _val = YAHOO.Tools.makeTxtObject(_val);
                }
                elm.appendChild(_val);
            }
        },
        /**
        * @method styleToCamel
        * @description Converts a standard CSS string to a Javascriptable Camel Case variable name
        * @param {String} str The CSS string to convert to camel case Javascript String
        * Example:<br>
        * background-color<br>
        * backgroundColor<br><br>
        * list-style-type<br>
        * listStyleType
        */
        styleToCamel: function(str) {
            var _tmp = str.split('-');
            var _new_style = _tmp[0];
            for (var i = 1; i < _tmp.length; i++) {
                _new_style += _tmp[i].substring(0, 1).toUpperCase() + _tmp[i].substring(1, _tmp[i].length); 
            }
            return _new_style;
        },
        /**
        * @method removeQuotes
        * @description Removes " from a given string
        * @param {String} str The string to remove quotes from
        */
        removeQuotes: function(str) {
            var checkText = str.toString();
            return checkText.replace(regExs.quotes, '').toString();
        },
        /**
        * @method trim
        * @depreciated Replaced by YAHOO.lang.trim
        */
        trim: function(str) {
            return YAHOO.lang.trim(str);
        },
        /**
        * @method stripTags
        * @description Removes all HTML tags from a string.
        * @param {String} str The string to remove HTML from
        */
        stripTags: function(str) {
            return str.replace(regExs.striptags, '');
        },
        /**
        * @method hasBRs
        * @description Returns True/False if it finds BR' or P's
        * @param {String} str The string to search
        */
        hasBRs: function(str) {
            return str.match(regExs.hasbr) || str.match(regExs.hasp);
        },
        /**
        * @method convertBRs2NLs
        * @description Converts BR's and P's to Plain Text Line Feeds
        * @param {String} str The string to search
        */
        convertBRs2NLs: function(str) {
            return str.replace(regExs.rbr, "\n").replace(regExs.rbr2, "\n").replace(regExs.rendp, "\n").replace(regExs.rp, "");
        },
        /**
        * @method stringRepeat
        * @description Repeats a string n number of times
        * @param {String} str The string to repeat
        * @param {Integer} repeat Number of times to repeat it
        * @returns Repeated string
        * @type String
        */
        stringRepeat: function(str, repeat) {
            return [repeat + 1].join(str);
        },
        /**
        * @method stringReverse
        * @description Reverses a string
        * @param {String} str The string to reverse
        * @returns Reversed string
        * @type String
        */
        stringReverse: function(str) {
            var new_str = '';
            for (var i = 0; i < str.length; i++) {
                new_str = new_str + str.charAt((str.length -1) -i);
            }
            return new_str;
        },
        /**
        * @method printf
        * @description printf function written in Javascript<br>
        * <pre>var test = "You are viewing messages {0} - {1} out of {2}";
        * YAHOO.Tools.printf(test, '5', '25', '500');</pre><br>
        * This will return a string like:<br>
        * "You are view messages 5 - 25 out of 500"<br>
        * Patched provided by: Peter Foti [foti-1@comcast.net]<br>
        * @param {String} string
        * @returns Parsed String
        * @type String
        */
        printf: function() {
            var num = arguments.length;
            var oStr = arguments[0];
            
            for (var i = 1; i < num; i++) {
                var pattern = "\\{" + (i-1) + "\\}";
                var re = new RegExp(pattern, "g");
                oStr = oStr.replace(re, arguments[i]);
            }
            return oStr;
        },
        /**
        * @method setStyleString
        * @description Trims starting and trailing white space from a string.
        * @param {HTMLElement/Array/String} el Single element, array of elements or id string to apply the style string to
        * @param {String} str The CSS string to apply to the elements
        * Example:
        * color: black; text-decoration: none; background-color: yellow;
        */
        setStyleString: function(el, str) {
            var _tmp = str.split(';');
            for (var x in _tmp) {
                if (x) {
                    var __tmp = YAHOO.Tools.trim(_tmp[x]);
                    __tmp = _tmp[x].split(':');
                    if (__tmp[0] && __tmp[1]) {
                        var _attr = YAHOO.Tools.trim(__tmp[0]);
                        var _val = YAHOO.Tools.trim(__tmp[1]);
                        if (_attr && _val) {
                            if (_attr.indexOf('-') != -1) {
                                _attr = YAHOO.Tools.styleToCamel(_attr);
                            }
                            Dom.setStyle(el, _attr, _val);
                        }
                    }
                }
            }
        },
        /**
        * @method getSelection
        * @depreciated Remove from toolkit
        */
        getSelection: function() {
        },

        /**
        * @method removeElement
        * @description Remove the element from the document. Also removes child elements and listeners.
        * @param {HTMLElement/Array/String} el Single element, array of elements or id string to remove from the document
        */
        removeElement: function(el) {
             if (!(el instanceof Array)) {
                 el = [Dom.get(el)];
             }
             for (var i = 0; i < el.length; i++) {
                 if (el[i].parentNode) {
                     Event.purgeElement(el[i], true);
                     while (el[i].childNodes[0]) {
                         el[i].removeChild(el[i].childNodes[0]);
                     }
                     el[i].parentNode.removeChild(el[i]);
                 }
             }
        },

        /**
        * @method setCookie
        * @description Set a cookie.
        * @param {String} name The name of the cookie to be set
        * @param {String} value The value of the cookie
        * @param {String} expires A valid Javascript Date object
        * @param {String} path The path of the cookie (Deaults to /)
        * @param {String} domain The domain to attach the cookie to
        * @param {Boolean} secure Boolean True or False
        */
        setCookie: function(name, value, expires, path, domain, secure) {
             var argv = arguments,
                argc = arguments.length;
             expires = (argc > 2) ? argv[2] : null;
             path = (argc > 3) ? argv[3] : '/';
             domain = (argc > 4) ? argv[4] : null;
             secure = (argc > 5) ? argv[5] : false;
             document.cookie = name + "=" + escape (value) +
               ((expires === null) ? "" : ("; expires=" + expires.toGMTString())) +
               ((path === null) ? "" : ("; path=" + path)) +
               ((domain === null) ? "" : ("; domain=" + domain)) +
               ((secure === true) ? "; secure" : "");
        },

        /**
        * @method getCookie
        * @description Get the value of a cookie.
        * @param {String} name The name of the cookie to get
        */
        getCookie: function(name) {
            var dc = document.cookie;
            var prefix = name + '=';
            var begin = dc.indexOf('; ' + prefix);
            if (begin == -1) {
                begin = dc.indexOf(prefix);
                if (begin !== 0) {
                    return null;
                }
            } else {
                begin += 2;
            }
            var end = document.cookie.indexOf(';', begin); 
            if (end == -1) {
                end = dc.length;
            }
            return unescape(dc.substring(begin + prefix.length, end));
        },
        /**
        * @method deleteCookie
        * @description Delete a cookie
        * @param {String} name The name of the cookie to delete.
        */
        deleteCookie: function(name, path, domain) {
            if (YAHOO.Tools.getCookie(name)) {
                document.cookie = name + '=' + ((path) ? '; path=' + path : '') + ((domain) ? '; domain=' + domain : '') + '; expires=Thu, 01-Jan-70 00:00:01 GMT';
            }
        },
        /**
        * @method getBrowserEngine
        * @depreciated Replaced by YAHOO.env.ua
        */
        getBrowserEngine: function() {
            var browsers = YAHOO.env.ua;
            browsers.msie = browsers.ie;
            browsers.ua = navigator.userAgent;
            return browsers;
        },
        /**
        * @method getBrowserAgent
        * @depreciated Replaced by YAHOO.env.ua
        */
        getBrowserAgent: function() {
            return YAHOO.Tools.getBrowserEngine();
        },
        /**
        * @method checkFlash
        * @description Check if Flash is enabled and return the version number
        * @return Version number or false on error
        * @type String
        */
        checkFlash: function() {
            var br = YAHOO.Tools.getBrowserEngine(),
                flash = false;
            if (br.ie) {
                try {
                    // version will be set for 7.X or greater players
                    var axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
                    var versionStr = axo.GetVariable("$version");
                    var tempArray = versionStr.split(" ");  // ["WIN", "2,0,0,11"]
                    var tempString = tempArray[1];           // "2,0,0,11"
                    var versionArray = tempString.split(",");  // ['2', '0', '0', '11']
                    flash = versionArray[0];
                } catch (e) {
                }
            } else {
                var flashObj = null;
                var tokens, len, curr_tok, hasVersion;
                if (navigator.mimeTypes && navigator.mimeTypes['application/x-shockwave-flash']) {
                    flashObj = navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin;
                }
                if (flashObj === null) {
                    flash = false;
                } else {
                    tokens = navigator.plugins['Shockwave Flash'].description.split(' ');
                    len = tokens.length;
                    while(len--) {
                        curr_tok = tokens[len];
                        if(!isNaN(parseInt(curr_tok, 10))) {
                            hasVersion = curr_tok;
                            flash = hasVersion;
                            break;
                        }
                    }
                }
            }
            return flash;
        },
        /**
        * @method setAttr
        * @description Set Mass Attributes on an Element
        * @param {Object} attrObj Object containing the attributes to set.
        * @param {HTMLElement/String} elm The element you want to apply the attribute to
        * Supports adding listeners and setting style from a CSS style string.<br>
        */
        setAttr: function(attrsObj, elm) {
            if (typeof elm == 'string') {
                elm = Dom.get(elm);
            }
            for (var i in attrsObj) {
                switch (i.toLowerCase()) {
                    case 'listener':
                       if (attrsObj[i] instanceof Array) {
                           var ev = attrsObj[i][0];
                           var func = attrsObj[i][1];
                           var base = attrsObj[i][2];
                           var scope = attrsObj[i][3];
                           Event.addListener(elm, ev, func, base, scope);
                       }
                       break;
                   case 'classname':
                   case 'class':
                       elm.className = attrsObj[i];
                       break;
                   case 'style':
                       YAHOO.Tools.setStyleString(elm, attrsObj[i]);
                       break;
                   default:
                       elm.setAttribute(i, attrsObj[i]);
                       break;
               }
           }
        },
        /**
        * @method create
        * @description Usage:<br>
        * <pre><code>
        * div = YAHOO.util.Dom.create('div', 'Single DIV. This is some test text.', {
        *           className:'test1',
        *           style:'font-size: 20px'
        *       }
        * );
        * test1.appendChild(div);
        * <br><br>- or -<br><br>
        * div = YAHOO.util.Dom.create('div', {className:'test2',style:'font-size:11px'}, 
        *        [YAHOO.util.Dom.create('p', {
        *            style:'border: 1px solid red; color: blue',
        *            listener: ['click', test]
        *           },
        *           'This is a P inside of a DIV both styled.')
        *       ]
        *);
        *    test2.appendChild(div);
        *
        * </code></pre>
        * @param {String} tagName Tag name to create
        * @param {Object} attrs Element attributes in object notation
        * @param {Array} children Array of children to append to the created element
        * @param {String} txt Text string to insert into the created element
        * @returns A reference to the newly created element
        * @type HTMLReference
        */
        create: function(tagName) {
            tagName = tagName.toLowerCase();
            var elm = document.createElement(tagName),
                txt = false,
                attrsObj = false;

            if (!elm) { return false; }
            
            for (var i = 1; i < arguments.length; i++) {
                txt = arguments[i];
                if (typeof txt == 'string') {
                    var _txt = YAHOO.Tools.makeTextObject(txt);
                    elm.appendChild(_txt);
                } else if (txt instanceof Array) {
                    YAHOO.Tools.makeChildren(txt, elm);
                } else if (typeof txt == 'object') {
                    YAHOO.Tools.setAttr(txt, elm);
                }
            }
            return elm;
        },
        /**
        * @method insertAfter
        * @description Inserts an HTML Element after another in the DOM Tree.
        * @param    {HTMLElement}   elm The element to insert
        * @param    {HTMLElement}    curNode The element to insert it before
        */
        insertAfter: function(elm, curNode) {
            if (curNode.nextSibling) {
                curNode.parentNode.insertBefore(elm, curNode.nextSibling);
            } else {
                curNode.parentNode.appendChild(elm);
            }
        },
        /**
        * @method inArray
        * @description Validates that the value passed is in the Array passed.
        * @param    {Array}   arr The Array to search (haystack)
        * @param    {String}    val The value to search for (needle)
        * @returns True if the value is found
        * @type Boolean
        */
        inArray: function(arr, val) {
            if (arr instanceof Array) {
                for (var i = (arr.length -1); i >= 0; i--) {
                    if (arr[i] === val) {
                        return true;
                    }
                }
            }
            return false;
        },
        /**
        * @method checkBoolean
        * @depeciated Replaced by YAHOO.lang.isBoolean
        */
        checkBoolean: function(str) {
            return YAHOO.lang.isBoolean(str);
        },
        /**
        * @method checkNumber
        * @depreciated Replaced by YAHOO.lang.isNumber
        */
        checkNumber: function(str) {
            return YAHOO.lang.isNumber(str);
        },
        /**
        * @method PixelToEm
        * @description Divide your desired pixel width by 13 to find em width. Multiply that value by 0.9759 for IE via *width.
        * @param    {Integer}   size The pixel size to convert to em.
        * @return Object of sizes (2) {msie: size, other: size }
        * @type Object
        */
        PixelToEm: function(size) {
            var data = {};
            var sSize = (size / 13);
            data.other = (Math.round(sSize * 100) / 100);
            data.msie = (Math.round((sSize * 0.9759) * 100) / 100);
            return data;
        },
        /**
        * @method PixelToEmStyle
        * @description Return a string of CSS statements for this pixel size in ems
        * @param    {Integer}   size The pixel size to convert to em.
        * @param    {String}    prop The property to apply the style to.
        * @return String of CSS style statements (width:46.15em;*width:45.04em;min-width:600px;)
        * @type String
        */
        PixelToEmStyle: function(size, prop) {
            var data = '',
                sSize = (size / 13);
            prop = ((prop) ? prop.toLowerCase() : 'width');
            data += prop + ':' + (Math.round(sSize * 100) / 100) + 'em;';
            data += '*' + prop + ':' + (Math.round((sSize * 0.9759) * 100) / 100) + 'em;';
            if ((prop == 'width') || (prop == 'height')) {
                data += 'min-' + prop + ':' + size + 'px;';
            }
            return data;
        },
        /**
        * @method base64Encode
        * @description Base64 Encodes a string
        * @param    {String}    str The string to base64 encode.
        * @return Base64 Encoded String
        * @type String
        */
        base64Encode: function(str) {
            var data = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            do {
                chr1 = str.charCodeAt(i++);
                chr2 = str.charCodeAt(i++);
                chr3 = str.charCodeAt(i++);

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }

                data = data + keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4);
            } while (i < str.length);
           
            return data;
        },
        /**
        * @method base64Decode
        * @description Base64 Decodes a string
        * @param    {String}    str The base64 encoded string to decode.
        * @return The decoded String
        * @type String
        */
        base64Decode: function(str) {
            var data = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
            str = str.replace(regExs.base64, "");

            do {
                enc1 = keyStr.indexOf(str.charAt(i++));
                enc2 = keyStr.indexOf(str.charAt(i++));
                enc3 = keyStr.indexOf(str.charAt(i++));
                enc4 = keyStr.indexOf(str.charAt(i++));

                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;

                data = data + String.fromCharCode(chr1);

                if (enc3 != 64) {
                    data = data + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    data = data + String.fromCharCode(chr3);
                }
            } while (i < str.length);

            return data;
        },
        /**
        * @method getQueryString
        * @description Parses a Query String, if one is not provided, it will look in location.href<br>
        * NOTE: This function will also handle test[] vars and convert them to an array inside of the return object.<br>
        * This now supports #hash vars, it will return it in the object as Obj.hash
        * @param    {String}    str The string to parse as a query string
        * @return An object of the parts of the parsed query string
        * @type Object
        */
        getQueryString: function(str) {
            var qstr = {}, arr = null;
            if (!str) {
                str = location.href.split('?');
                if (str.length != 2) {
                    str = ['', location.href];
                }
            } else {
                str = ['', str];
            }
            if (str[1].match('#')) {
                var _tmp = str[1].split('#');
                qstr.hash = _tmp[1];
                str[1] = _tmp[0];
            }
            if (str[1]) {
                str = str[1].split('&');
                if (str.length) {
                    for (var i = 0; i < str.length; i++) {
                        var part = str[i].split('=');
                        if (part[0].indexOf('[') != -1) {
                            if (part[0].indexOf('[]') != -1) {
                                //Array
                                arr = part[0].substring(0, part[0].length - 2);
                                if (!qstr[arr]) {
                                    qstr[arr] = [];
                                }
                                qstr[arr][qstr[arr].length] = part[1];
                            } else {
                                //Object
                                arr = part[0].substring(0, part[0].indexOf('['));
                                var data = part[0].substring((part[0].indexOf('[') + 1), part[0].indexOf(']'));
                                if (!qstr[arr]) {
                                    qstr[arr] = {};
                                }
                                //Object
                                qstr[arr][data] = part[1];
                            }
                        } else {
                            qstr[part[0]] = part[1];
                        }
                    }
                }
            }
            return qstr;
        },
        /**
        * @method getQueryStringVar
        * @description Parses a Query String Var<br>
        * NOTE: This function will also handle test[] vars and convert them to an array inside of the return object.
        * @param    {String}    str The var to get from the query string
        * @param    {String}    qstr The optional query string to parse, will use location.href as default
        * @return The value of the var in the querystring.
        * @type String/Array
        */
        getQueryStringVar: function(str, qstr) {
            var qs = YAHOO.Tools.getQueryString(qstr);
            if (qs[str]) {
                return qs[str];
            } else {
                return false;
            }
        },
        /**
        * @method padDate
        * @description Function to pad a date with a beginning 0 so 1 becomes 01, 2 becomes 02, etc..
        * @param {String} n The string to pad
        * @returns Zero padded string
        * @type String
        */
        padDate: function(n) {
            return n < 10 ? '0' + n : n;
        },
        /**
        * @method encodeStr
        * @description Converts a string to a JSON string
        * @param {String} str Converts a string to a JSON string
        * @returns JSON Encoded string
        * @type String
        */
        encodeStr: function(str) {
            if (/["\\\x00-\x1f]/.test(str)) {
                return '"' + str.replace(/([\x00-\x1f\\"])/g, function(a, b) {
                    var c = jsonCodes[b];
                    if(c) {
                        return c;
                    }
                    c = b.charCodeAt();
                    return '\\u00' +
                        Math.floor(c / 16).toString(16) +
                        (c % 16).toString(16);
                }) + '"';
            }
            return '"' + str + '"';
        },
        /**
        * @method encodeArr
        * @description Converts an Array to a JSON string
        * @param {Array} arr Converts an Array to a JSON string
        * @returns JSON encoded string
        * @type String
        */
        encodeArr: function(arr) {
            var a = ['['], b, i, l = arr.length, v;
                for (i = 0; i < l; i += 1) {
                    v = arr[i];
                    switch (typeof v) {
                        case 'undefined':
                        case 'function':
                        case 'unknown':
                            break;
                        default:
                            if (b) {
                                a.push(',');
                            }
                            a.push(v === null ? "null" : YAHOO.Tools.JSONEncode(v));
                            b = true;
                    }
                }
                a.push(']');
                return a.join('');
        },
        /**
        * @method encodeDate
        * @description Converts a Date object to a JSON string
        * @param {Object} d Converts a Date object to a JSON string
        * @returns JSON encoded Date string
        * @type String
        */
        encodeDate: function(d) {
            var dateStr = '"' + d.getFullYear() + '-' + YAHOO.Tools.padDate(d.getMonth() + 1) +
                '-' + YAHOO.Tools.padDate(d.getDate()) +
                'T' + YAHOO.Tools.padDate(d.getHours()) + ':' +
                YAHOO.Tools.padDate(d.getMinutes()) + ':' + YAHOO.Tools.padDate(d.getSeconds()) + '"';
            return dateStr;
        },
        /**
        * @method fixJSONDate
        * @description Fixes the JSON date format
        * @param {String} dateStr JSON encoded date string (YYYY-MM-DDTHH:MM:SS)
        * @returns Date Object
        * @type Object
        */
        fixJSONDate: function(dateStr) {
            var tmp = dateStr.split('T');
            var fixedDate = dateStr;
            if (tmp.length == 2) {
                var tmpDate = tmp[0].split('-');
                if (tmpDate.length == 3) {
                    fixedDate = new Date(tmpDate[0], (tmpDate[1] - 1), tmpDate[2]);
                    var tmpTime = tmp[1].split(':');
                    if (tmpTime.length == 3) {
                        fixedDate.setHours(tmpTime[0], tmpTime[1], tmpTime[2]);
                    }
                }
            }
            return fixedDate;
        },
        /**
        * @method JSONEncode
        * @description Encode a Javascript Object/Array into a JSON string
        * @param {String/Object/Array} o Converts the object to a JSON string
        * @returns JSON String
        * @type String
        */
        JSONEncode: function(o) {
            if ((typeof o == 'undefined') || (o === null)) {
                return 'null';
            } else if (o instanceof Array) {
                return YAHOO.Tools.encodeArr(o);
            } else if (o instanceof Date) {
                return YAHOO.Tools.encodeDate(o);
            } else if (typeof o == 'string') {
                return YAHOO.Tools.encodeStr(o);
            } else if (typeof o == 'number') {
                return isFinite(o) ? String(o) : "null";
            } else if (typeof o == 'boolean') {
                return String(o);
            } else {
                var a = ['{'], b, i, v;
                for (i in o) {
                    v = o[i];
                    switch (typeof v) {
                        case 'undefined':
                        case 'function':
                        case 'unknown':
                            break;
                        default:
                            if (b) {
                                a.push(',');
                            }
                            a.push(YAHOO.Tools.JSONEncode(i), ':', ((v === null) ? "null" : YAHOO.Tools.JSONEncode(v)));
                            b = true;
                    }
                }
                a.push('}');
                return a.join('');
            }
        },
        /**
        * @method JSONParse
        * @description Converts/evals a JSON string into a native Javascript object
        * @param {String} json Converts the JSON string back into the native object
        * @param {Boolean} autoDate Try to autofix date objects 
        * @returns eval'd object
        * @type Object/Array/String
        */
        JSONParse: function(json, autoDate) {
            autoDate = ((autoDate) ? true : false);
            try {
                if (regExs.syntaxCheck.test(json)) {
                    var j = eval('(' + json + ')');
                    if (autoDate) {
                        function walk(k, v) {
                            if (v && typeof v === 'object') {
                                for (var i in v) {
                                    if (v.hasOwnProperty(i)) {
                                        v[i] = walk(i, v[i]);
                                    }
                                }
                            }
                            if (k.toLowerCase().indexOf('date') >= 0) {
                                return YAHOO.Tools.fixJSONDate(v);
                            } else {
                                return v;
                            }
                        }
                        return walk('', j);
                    } else {
                        return j;
                    }
                }
            } catch(e) {
                YAHOO.log(e, 'error', 'Tools');
            }
            throw new SyntaxError("parseJSON");
        }
    };

    YAHOO.register('tools', YAHOO.Tools, { version: tools_version, build: tools_build });
})();
/*
* Try to catch the developers that use the wrong case 8-)
*/
YAHOO.tools = YAHOO.Tools;
YAHOO.TOOLS = YAHOO.Tools;
YAHOO.util.Dom.create = YAHOO.Tools.create;
/*
* Smaller Code
*/

var $A = YAHOO.util.Anim,
    $E = YAHOO.util.Event,
    $D = YAHOO.util.Dom,
    $T = YAHOO.Tools,
    $ = YAHOO.util.Dom.get,
    $$ = YAHOO.util.Dom.getElementsByClassName;
