(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang;

    var _handleWindowClose = function() {
    };

    var _handleWindow = function() {
        this.nodeChange();
        var el = this.currentElement[0],
        win = new YAHOO.widget.EditorWindow('spellcheck', {
            width: '170px'
        }),
        body = document.createElement('div');

        body.innerHTML = '<strong>Suggestions:</strong><br>';
        var ul = document.createElement('ul');
        ul.className = 'yui-spellcheck-list';
        body.appendChild(ul);

        var list = '';
        //Change this code to suit your backend checker
        for (var i = 0; i < this._spellData.length; i++) {
            if (el.innerHTML == this._spellData[i].word) {
                for (var s = 0; s < this._spellData[i].suggestions.length; s++) {
                    list = list + '<li title="Replace (' + this._spellData[i].word + ') with (' + this._spellData[i].suggestions[s] + ')">' + this._spellData[i].suggestions[s] + '</li>';
                }
            }
        }

        ul.innerHTML = list;
        
        Event.on(ul, 'click', function(ev) {
            var tar = Event.getTarget(ev);
            Event.stopEvent(ev);
            if (this._isElement(tar, 'li')) {
                el.innerHTML = tar.innerHTML;
                Dom.removeClass(el, 'yui-spellcheck');
                Dom.addClass(el, 'yui-non');

                var next = Dom.getElementsByClassName('yui-spellcheck', 'span', this._getDoc().body)[0];
                if (next) {
                    this.STOP_NODE_CHANGE = true;
                    this.currentElement = [next];
                    _handleWindow.call(this);
                } else {
                    this.checking = false;
                    this.toolbar.set('disabled', false);
                    this.closeWindow();
                }
                this.nodeChange();
            }
        }, this, true);

        this.on('afterOpenWindow', function() {            
            this.get('panel').syncIframe();
            var l = parseInt(this.currentWindow._knob.style.left, 10);
            if (l === 40) {
               this.currentWindow._knob.style.left = '1px';
            }
        }, this, true);

        win.setHeader('Spelling Suggestions');
        win.setBody(body);
        this.openWindow(win);

        
    };

    var myEditor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '530px',
        dompath: true,
        animate: true,
        extracss: '.yui-spellcheck { background-color: yellow; }'
    });
    /* {{{ Override _handleClick method to keep the window open on click */
    myEditor._handleClick = function(ev) {
        if (this._isNonEditable(ev)) {
            return false;
        }
        this._setCurrentEvent(ev);
        var tar =Event.getTarget(ev);
        if (this.currentWindow) {
            if (!Dom.hasClass(tar, 'yui-spellcheck')) {
                this.closeWindow();
            }
        }
        if (!Dom.hasClass(tar, 'yui-spellcheck')) {
            if (YAHOO.widget.EditorInfo.window.win && YAHOO.widget.EditorInfo.window.scope) {
                YAHOO.widget.EditorInfo.window.scope.closeWindow.call(YAHOO.widget.EditorInfo.window.scope);
            }
        }
        if (this.browser.webkit) {
            var tar =Event.getTarget(ev);
            if (this._isElement(tar, 'a') || this._isElement(tar.parentNode, 'a')) {
                Event.stopEvent(ev);
                this.nodeChange();
            }
        } else {
            this.nodeChange();
        }
    };
    /* }}} */
    
    myEditor.checking = false;
    myEditor._defaultToolbar.buttons[10].buttons[2] = {
      type: 'push',
      label: 'Check Spelling',
      value: 'spellcheck'
    };
    myEditor._checkSpelling = function(o) {
        //Change this code to suit your backend checker
        var data = eval('(' + o.responseText + ')');
        var html = this._getDoc().body.innerHTML;
        for (var i = 0; i < data.data.length; i++) {
            html = html.replace(data.data[i].word, '<span class="yui-spellcheck">' + data.data[i].word + '</span>');
        }
        this.setEditorHTML(html);
        this._spellData = data.data;
    };

    myEditor.on('windowspellcheckClose', function() {
        _handleWindowClose.call(this);
    }, myEditor, true);
    
    myEditor.on('editorMouseDown', function() {
        var el = this._getSelectedElement();
        if (Dom.hasClass(el, 'yui-spellcheck')) {
            this.currentElement = [el];
            _handleWindow.call(this);
            return false;
        }
    }, myEditor, true);
    myEditor.on('editorKeyDown', function(ev) {
        if (this.checking) {
            //We are spell checking, stop the event
            Event.stopEvent(ev.ev);
        }
    }, myEditor, true);
    myEditor.on('afterNodeChange', function() {
        this.toolbar.enableButton('spellcheck');
        if (this.checking) {
            this.toolbar.set('disabled', true);
            this.toolbar.getButtonByValue('spellcheck').set('disabled', false);
            this.toolbar.selectButton('spellcheck');
        }
    }, myEditor, true);
    myEditor.on('editorContentLoaded', function() {
        this._getDoc().body.spellcheck = false; //Turn off native spell check
    }, myEditor, true);
    myEditor.on('toolbarLoaded', function() {
        this.toolbar.on('spellcheckClick', function() {
            if (!this.checking) {
                this.checking = true;
                this._conn = YAHOO.util.Connect.asyncRequest('GET', 'check.php', {
                    success: this._checkSpelling,
                    failure: function() {},
                    scope: this
                }, null); 
            } else {
                this.checking = false;
                var el = Dom.getElementsByClassName('yui-spellcheck', 'span', this._getDoc().body);
                //More work needed here for cleanup..
                Dom.removeClass(el, 'yui-spellcheck');
                Dom.addClass(el, 'yui-none');
                this.toolbar.set('disabled', false);
                this.nodeChange();
            }
            return false;
        }, this, true);
    }, myEditor, true);
    myEditor.render();

})();
