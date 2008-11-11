/**
* @fileoverview Provides a programatic way of creating DOM objects and children.
* @author Dav Glass <dav.glass@yahoo.com>
* @version 0.4 
* @class Provides a programatic way of creating DOM objects and children.
* @requires YAHOO.util.Dom
* @requires YAHOO.util.Event
* @requires YAHOO.Tools
*/
/**
* @constructor
* @class Provides a programmatic way of creating DOM objects and children.
* Usage:<br>
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
*/
YAHOO.util.Dom.create = function(tagName) {
    _makeStyleObject = function(attrsObj, elm) {
        for (var i in attrsObj) {
            switch (i.toLowerCase()) {
                case 'listener':
                   if (attrsObj[i] instanceof Array) {
                       var ev = attrsObj[i][0];
                       var func = attrsObj[i][1];
                       var base = attrsObj[i][2];
                       var scope = attrsObj[i][3];
                       YAHOO.util.Event.addListener(elm, ev, func, base, scope);
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
    }
    tagName = tagName.toLowerCase();
    elm = document.createElement(tagName);
    var txt = false;
    var attrsObj = false;

    if (!elm) { return false; }
    
    for (var i = 1; i < arguments.length; i++) {
        txt = arguments[i];
        if (typeof txt == 'string') {
            _txt = YAHOO.Tools.makeTextObject(txt);
            elm.appendChild(_txt);
        } else if (txt instanceof Array) {
            YAHOO.Tools.makeChildren(txt, elm);
        } else if (typeof txt == 'object') {
            _makeStyleObject(txt, elm);
        }
    }
    return elm;
}

