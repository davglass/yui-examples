(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang;

    var _handleWindowClose = function() {
        var el = this.currentElement[0];
        //set the attribute on the element so we can parse it out afterward.
        el.setAttribute('url', Dom.get('embed_url').value);
        this.nodeChange();
    };

    var _handleMediaWindow = function() {
        var el = this._getSelectedElement(),
        win = new YAHOO.widget.EditorWindow('insertmedia', {
            width: '415px'
        }),
        body = document.createElement('div');

        //Do what you want here, just adding fluff..
        //Here is where you check to see if the attributes exist and then setup the form properly..
        body.innerHTML = '<p>Paste your embed string here:</p><textarea id="embedplugin"></textarea><div id="media_cont"></div>';
        body.innerHTML += '<div id="media_control"><form>URL: <input id="embed_url" type="text" value="" size="45"></form></div>';

        win.setHeader('Edit Media');
        win.setBody(body);
        this.openWindow(win);

        var _button = new YAHOO.widget.Button({
            id: Dom.generateId(),
            container: 'media_cont',
            label: 'Process',
            value: 'notta'
        });

        _button.on('click', function() {
            var el = Dom.get('embedplugin');
            if (el && el.value && (el.value != '')) {
                var div = document.createElement('div');
                div.innerHTML = el.value;

                Dom.setStyle('embedplugin', 'display', 'none');
                Dom.setStyle('media_cont', 'display', 'none');
                Dom.setStyle('media_control', 'display', 'block');
                var em = div.getElementsByTagName('embed')[0];
                Dom.get('embed_url').value = em.getAttribute('src');
                this.moveWindow();
                this.get('panel').syncIframe();
            }
        }, this, true);

        this.on('afterOpenWindow', function() {
            
            this.get('panel').syncIframe();
        }, this, true);
        
    };

    var myEditor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '570px',
        dompath: true,
        animate: true,
        extracss: '.yui-media { height: 100px; width: 100px; border: 1px solid black; background-color: #f2f2f2; background-image: url( media.gif ); background-position: 45% 45%; background-repeat: no-repeat; }'
    });
    myEditor._defaultToolbar.buttons[10].buttons[2] = {
      type: 'push',
      label: 'Insert Media Object',
      value: 'insertmedia'
    };

    myEditor.on('windowinsertmediaClose', function() {
        _handleWindowClose.call(this);
    }, myEditor, true);
    
    myEditor.cmd_insertmedia = function() {
        this.execCommand('insertimage', 'none');
        var el = this._swapEl(this.currentElement[0], 'div', function(el) {
            el.className = 'yui-media';
            Dom.setStyle(el, 'fontSize', '100px'); //Need this to get the position of the element correct.. Bug?
        });
        this.currentElement = [el];
        _handleMediaWindow.call(this);

    };
    myEditor.on('editorDoubleClick', function() {
        var el = this._getSelectedElement();
        if (Dom.hasClass(el, 'yui-media')) {
            this.currentElement = [el];
            _handleMediaWindow.call(this);
            return false;
        }
    }, myEditor, true);
    myEditor.on('afterNodeChange', function() {
        if (this._hasSelection()) {
            this.toolbar.disableButton('insertmedia');
        } else {
            this.toolbar.enableButton('insertmedia');
            var el = this._getSelectedElement();
            if (Dom.hasClass(el, 'yui-media')) {
                this.toolbar.selectButton('insertmedia');
            } else {
                this.toolbar.deselectButton('insertmedia');
            }
        }
    }, myEditor, true);
    myEditor.on('toolbarLoaded', function() {
        this.toolbar.on('insertmediaClick', function() {
            var el = this._getSelectedElement();
            if (Dom.hasClass(el, 'yui-media')) {
                this.currentElement = [el];
                _handleMediaWindow.call(this);
                return false;
            }
        }, this, true);
    }, myEditor, true);
    myEditor.render();

})();
