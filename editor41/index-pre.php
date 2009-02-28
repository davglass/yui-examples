<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Embed Plugin</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-insertmedia span.yui-toolbar-icon {
            background-image: url( media.gif );
            background-position: 1px 0px;
            top: 1px;
            left: 4px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-insertmedia-selected span.yui-toolbar-icon {
            background-image: url( media.gif );
            background-position: 1px 0px;
            top: 1px;
            left: 4px;
        }
        #embedplugin {
            height: 70px;
            width: 300px;
        }
        #media_control {
            display: none;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Embed Plugin</a></h1></div>
    <div id="bd">
        <textarea id="editor">
        This is a test.
        </textarea>
        <h2>The Javascript</h2>
        <p><a href="embed.js">Link to the full source file.</a></p>
        <textarea name="code" class="JScript">
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
        body.innerHTML = '<p>Paste your embed string here:</p>&lt;textarea id="embedplugin"&gt;&lt;/textarea&gt;<div id="media_cont"></div>';
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
        extracss: '.yui-media { height: 100px; width: 100px; border: 1px solid black; background-color: #f2f2f2; 
        background-image: url( media.gif ); background-position: 45% 45%; background-repeat: no-repeat; }'
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
        
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/editor/editor-beta-min.js"></script> 
<script type="text/javascript" src="embed-pre.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
