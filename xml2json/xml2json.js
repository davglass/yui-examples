(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang;

    var XML2JSON = function(xml) {
        this.xml = xml;
        this._rawXML = xml;
    };

    XML2JSON.prototype = {
        rawJSON: null,
        xmlDOM: null,
        _cleanXML: function() {
            this.xml = Lang.trim(this.xml);
            this.xml = this.xml.replace(/>\s*\</g,'><');
            this.xml = this.xml.replace(/\s*\/>/g,'/>');
            this.xml = this.xml.replace(/<\?[^>]*>/g,"").replace(/<\![^>]*>/g,"");
            this._fixEndTags();
        },
        _fixEndTags: function() {
            var _xml = this.xml.split('/>');
            for (var i = 1; i < _xml.length; i++) {
                var _tag = _xml[i - 1].substring(_xml[i - 1].lastIndexOf('<') + 1).split(' ')[0];
                _xml[i] = '></' + _tag + '>' + _xml[i];
            }
            _xml = _xml.join('');
            this.xml = _xml;
        },
        _convertToXMLObject: function() {
            var dom = null;
            if (window.DOMParser) {
                try { 
                    dom = (new DOMParser()).parseFromString(this.xml, "text/xml"); 
                } catch (e) {
                    dom = null;
                }
           } else if (window.ActiveXObject) {
                try {
                    dom = new ActiveXObject('Microsoft.XMLDOM');
                    dom.async = false;
                    if (!dom.loadXML(this.xml)) {// parse error ..
                        window.alert(dom.parseError.reason + dom.parseError.srcText);
                    }
                } catch (e) {
                    dom = null; 
                }
            } else {
              alert("cannot parse xml string!");
            }
            this.xmlDOM = dom;
        },
        escape: function(txt) {
            return txt.replace(/[\\]/g, "\\\\")
                .replace(/[\"]/g, '\\"')
                .replace(/[\n]/g, '\\n')
                .replace(/[\r]/g, '\\r');
        },
        _getInnerData: function(node) {
            var s = "";
            if ("innerHTML" in node) {
                s = node.innerHTML;
            } else {
                //Node has no innerHTML, do it manually
                var _x = function(n) {
                    var s = "";
                    if (n.nodeType == 1) {
                        s += '<' + n.nodeName;
                        for (var i = 0; i < n.attributes.length; i++) {
                            s += ' ' + n.attributes[i].nodeName + '=\'' + (n.attributes[i].nodeValue || '').toString() + '\'';
                        }
                        if (n.firstChild) {
                            s += '>';
                            for (var c=n.firstChild; c; c=c.nextSibling) {
                                s += _x(c);
                            }
                            s += '</' + n.nodeName + '>';
                        } else {
                            s += '/>';
                        }
                    } else if (n.nodeType == 3) {
                        s += n.nodeValue;
                    } else if (n.nodeType == 4) {
                        s += '<![CDATA[' + n.nodeValue + ']]>';
                    }
                    return s;
                };
                for (var c = node.firstChild; c; c = c.nextSibling) {
                    s += _x(c);
                }
         }
         return s;
        },
        parse: function() {
            this._cleanXML();
            this._convertToXMLObject();
            if (this.xmlDOM) {
                this.rawJSON = this._parse(this.xmlDOM);
                return this.rawJSON;
            }
        },
        _parse: function(xml) {
            var o = {};
            /* Element Node */
            if (xml.nodeType == 1) {
                //Element has attributes
                if (xml.attributes.length)  {
                    for (var i = 0; i < xml.attributes.length; i++) {
                        if (!o._attrs) {
                            o._attrs = {};
                        }
                        //Hang them on the ._attrs Object
                        o._attrs[xml.attributes[i].nodeName] = (xml.attributes[i].nodeValue || '').toString();
                    }
                }
                //Element has child nodes
                if (xml.firstChild) {
                    var txtNode = 0,
                        cDataNode = 0,
                        hasChild = false;

                    for (var n=xml.firstChild; n; n=n.nextSibling) {
                        if (n.nodeType == 1) {
                            hasChild = true;
                        } else if ((n.nodeType == 3) && n.nodeValue.match(/[^ \f\n\r\t\v]/)) {
                            txtNode++; //Plain Text Node
                        } else if (n.nodeType == 4) {
                            cDataNode++; //Node contains CDATA string
                        }
                    }
                    if (hasChild) {
                        if (txtNode < 2 && cDataNode < 2) {
                            for (var n = xml.firstChild; n; n = n.nextSibling) {
                                if (n.nodeType == 3) {  //Text Node
                                    o._text = this.escape(n.nodeValue);
                                } else if (n.nodeType == 4) { // CDATA Node
                                    o._cdata = this.escape(n.nodeValue);
                                } else if (o[n.nodeName]) { // There already is an element here
                                    if (o[n.nodeName] instanceof Array) { //Add to the array
                                        o[n.nodeName][o[n.nodeName].length] = this._parse(n);
                                    } else { //Create the array
                                        o[n.nodeName] = [o[n.nodeName], this._parse(n)];
                                    }
                            } else { //First time we have seen this element
                               o[n.nodeName] = this._parse(n);
                            }
                         }
                      } else {
                         if (!xml.attributes.length) {
                            o = this.escape(this._getInnerData(xml));
                         } else {
                            o._text = this.escape(this._getInnerData(xml));
                        }
                      }
                    } else if (txtNode) {
                        if (!xml.attributes.length) {
                             o = this.escape(this._getInnerData(xml));
                        } else {
                            o._text = this.escape(this._getInnerData(xml));
                        }
                    } else if (cDataNode) {
                        if (cDataNode > 1) {
                            o = this.escape(this._getInnerData(xml));
                        } else {
                            for (var n=xml.firstChild; n; n=n.nextSibling) {
                                o._cdata = this.escape(n.nodeValue);
                            }
                        }
                    }
                    if (!xml.attributes.length && !xml.firstChild) {
                        o = null;
                    }
                }
            } else if (xml.nodeType==9) { //This is where we should start
                o = this._parse(xml.documentElement);
            }
                
            return o;
        }
        
    };




    var JSON2XML = function(json) {
        if (Lang.isString(json)) {
            json = YAHOO.lang.JSON.parse(json);
        }
        this.json = json;
    };

    JSON2XML.prototype = {
        _lineEnding: null,
        _parse: function(v, name) {
            var xml = "";
            if (v instanceof Array) {
                for (var i = 0, n = v.length; i < n; i++) {
                    xml += this._parse(v[i], name) + this._lineEnding;
                }
            } else if (typeof(v) == 'object') {
                var hasChild = false;
                if (name != '_attrs') {
                    xml += "<" + name;
                    for (var m in v) {
                        if (m == "_attrs") {
                            for (var a in v[m]) {
                                xml += ' ' + a + '="' + v[m][a].toString() + '"';
                            }
                        } else {
                            hasChild = true;
                        }
                    }
                    xml += ((hasChild) ? '>' : '/>' + this._lineEnding);
                    if (hasChild) {
                        for (var m in v) {
                            if (m == "_attrs") {
                            } else if (m == "_text") {
                                xml += v[m];
                            } else if (m == "_cdata") {
                                xml += "<![CDATA[" + v[m] + "]]>";
                            } else if (m.charAt(0) != "@") {
                                xml += this._parse(v[m], m);
                            }
                        }
                        xml += "</" + name + ">" + this._lineEnding;
                     }
                }
            } else {
                xml += "<" + name + ">" + v.toString() +  "</" + name + ">" + this._lineEnding;
            }
            return xml;
        },
        parse: function(config) {
            config = config || {};
            rootTag = 'json';
            if (config.rootTag) {
                rootTag = config.rootTag;
            }
            if (Lang.isValue(config.lineEnding)) {
                if (config.lineEnding === false) {
                    this._lineEnding = '';
                } else {
                    this._lineEnding = config.lineEnding;
                }
            } else {
                this._lineEnding = '\n';
            }
            var xml = '<' + rootTag;
            if (this.json._attrs) {
                for (var a in this.json._attrs) {
                    xml += ' ' + a + '="' + this.json._attrs[a].toString() + '"';
                }
            }
            xml += '>' + this._lineEnding;
            for (var i in this.json) {
                xml += this._parse(this.json[i], i);
            }
            xml += '</' + rootTag + '>';
            return xml;
        }
    };

    YAHOO.util.XML2JSON = XML2JSON;
    YAHOO.util.JSON2XML = JSON2XML;

})();

