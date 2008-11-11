(function() {
YAHOO.widget.SimpleEditor.prototype._createCurrentElement = function(tagName, tagStyle) {
    tagName = ((tagName) ? tagName : 'a');
    var tar = null,
        el = [],
        _doc = this._getDoc();
    
    if (this.currentFont) {
        if (!tagStyle) {
            tagStyle = {};
        }
        tagStyle.fontFamily = this.currentFont;
        this.currentFont = null;
    }
    this.currentElement = [];

    var _elCreate = function(tagName, tagStyle) {
        var el = null;
        tagName = ((tagName) ? tagName : 'span');
        tagName = tagName.toLowerCase();
        switch (tagName) {
            case 'h1':
            case 'h2':
            case 'h3':
            case 'h4':
            case 'h5':
            case 'h6':
                el = _doc.createElement(tagName);
                break;
            default:
                el = _doc.createElement(tagName);
                if (tagName === 'span') {
                    YAHOO.util.Dom.addClass(el, 'yui-tag-' + tagName);
                    YAHOO.util.Dom.addClass(el, 'yui-tag');
                    el.setAttribute('tag', tagName);
                }

                for (var k in tagStyle) {
                    if (YAHOO.lang.hasOwnProperty(tagStyle, k)) {
                        el.style[k] = tagStyle[k];
                    }
                }
                break;
        }
        return el;
    };

    if (!this._hasSelection()) {
        if (this._getDoc().queryCommandEnabled('insertimage')) {
            this._getDoc().execCommand('insertimage', false, 'yui-tmp-img');
            var imgs = this._getDoc().getElementsByTagName('img');
            for (var j = 0; j < imgs.length; j++) {
                if (imgs[j].getAttribute('src', 2) == 'yui-tmp-img') {
                    el = _elCreate(tagName, tagStyle);
                    imgs[j].parentNode.replaceChild(el, imgs[j]);
                    this.currentElement[this.currentElement.length] = el;
                }
            }
        } else {
            if (this.currentEvent) {
                tar = YAHOO.util.Event.getTarget(this.currentEvent);
            } else {
                //For Safari..
                tar = this._getDoc().body;                        
            }
        }
        if (tar) {
            /**
            * @knownissue
            * @browser Safari 2.x
            * @description The issue here is that we have no way of knowing where the cursor position is
            * inside of the iframe, so we have to place the newly inserted data in the best place that we can.
            */
            el = _elCreate(tagName, tagStyle);
            if (this._isElement(tar, 'body') || this._isElement(tar, 'html')) {
                if (this._isElement(tar, 'html')) {
                    tar = this._getDoc().body;
                }
                tar.appendChild(el);
            } else if (tar.nextSibling) {
                tar.parentNode.insertBefore(el, tar.nextSibling);
            } else {
                tar.parentNode.appendChild(el);
            }
            //this.currentElement = el;
            this.currentElement[this.currentElement.length] = el;
            this.currentEvent = null;
            if (this.browser.webkit) {
                //Force Safari to focus the new element
                this._getSelection().setBaseAndExtent(el, 0, el, 0);
                if (this.browser.webkit3) {
                    this._getSelection().collapseToStart();
                } else {
                    this._getSelection().collapse(true);
                }
            }
        }
    } else {
        //Force CSS Styling for this action...
        this._setEditorStyle(true);
        this._getDoc().execCommand('fontname', false, 'yui-tmp');
        var _tmp = [], __tmp, __els = ['font', 'span', 'i', 'b', 'u'];

        if (!this._isElement(this._getSelectedElement(), 'body')) {
            __els[__els.length] = this._getDoc().getElementsByTagName(this._getSelectedElement().tagName);
            __els[__els.length] = this._getDoc().getElementsByTagName(this._getSelectedElement().parentNode.tagName);
        }
        for (var _els = 0; _els < __els.length; _els++) {
            var _tmp1 = this._getDoc().getElementsByTagName(__els[_els]);
            for (var e = 0; e < _tmp1.length; e++) {
                _tmp[_tmp.length] = _tmp1[e];
            }
        }
        
        for (var i = 0; i < _tmp.length; i++) {
            if ((YAHOO.util.Dom.getStyle(_tmp[i], 'font-family') == 'yui-tmp') || (_tmp[i].face && (_tmp[i].face == 'yui-tmp'))) {
                el = _elCreate(_tmp[i].tagName, tagStyle);
                el.innerHTML = _tmp[i].innerHTML;
                if (this._isElement(_tmp[i], 'ol') || (this._isElement(_tmp[i], 'ul'))) {
                    var fc = _tmp[i].getElementsByTagName('li')[0];
                    _tmp[i].style.fontFamily = 'inherit';
                    fc.style.fontFamily = 'inherit';
                    el.innerHTML = fc.innerHTML;
                    fc.innerHTML = '';
                    fc.appendChild(el);
                    this.currentElement[this.currentElement.length] = el;
                } else if (this._isElement(_tmp[i], 'li')) {
                    _tmp[i].innerHTML = '';
                    _tmp[i].appendChild(el);
                    _tmp[i].style.fontFamily = 'inherit';
                    this.currentElement[this.currentElement.length] = el;
                } else {
                    if (_tmp[i].parentNode) {
                        _tmp[i].parentNode.replaceChild(el, _tmp[i]);
                        this.currentElement[this.currentElement.length] = el;
                        this.currentEvent = null;
                        if (this.browser.webkit) {
                            //Force Safari to focus the new element
                            this._getSelection().setBaseAndExtent(el, 0, el, 0);
                            if (this.browser.webkit3) {
                                this._getSelection().collapseToStart();
                            } else {
                                this._getSelection().collapse(true);
                            }
                        }
                        if (this.browser.ie && tagStyle && tagStyle.fontSize) {
                            this._getSelection().empty();
                        }
                        if (this.browser.gecko) {
                            this._getSelection().collapseToStart();
                        }
                    }
                }
            }
        }
        var len = this.currentElement.length;
        for (var e = 0; e < len; e++) {
            if ((e + 1) != len) { //Skip the last one in the list
                if (this.currentElement[e] && this.currentElement[e].nextSibling) {
                    if (this._isElement(this.currentElement[e], 'br')) {
                        this.currentElement[this.currentElement.length] = this.currentElement[e].nextSibling;
                    }
                }
            }
        }
    }
};
})();
