<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Highlight</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-codestyle {
            width: 100px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Highlight</a></h1></div>
    <div id="bd">
        <textarea id="editor">
def my_method(options)<br>
&nbsp;&nbsp;&nbsp;&nbsp;@variable = User.find(params[:id])<br>
end<br>
        </textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px',
        height: '300px',
        extracss: '.yui-tag-php { font-weight: bold; color: orange; } .yui-tag-ruby { font-weight: bold; color: red; }',
        toolbar: {
            collapse: true,
            titlebar: 'Text Editing Tools',
            draggable: false,
            buttons: [
                { group: 'codestyle', label: 'Code Style',
                    buttons: [
                        { type: 'select', label: 'HTML', value: 'codestyle', disabled: true,
                            menu: [
                                { text: 'HTML', value: 'html',  checked: true },
                                { text: 'Ruby', value: 'ruby' },
                                { text: 'PHP', value: 'php' }
                            ]
                        }
                    ]
                }
            ]
            
        }
    });
    myEditor.on('toolbarLoaded', function() {
        myEditor.on('afterNodeChange', function() {
            if (this._hasSelection()) {
                this.toolbar.enableButton('codestyle');
            } else {
                this.toolbar.disableButton('codestyle');
            }
        }, myEditor, true);
        myEditor.toolbar.on('codestyleClick', function(ev) {
            var type = ev.button.value.toLowerCase();
            this._createCurrentElement(type);
            return false;
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
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px',
        height: '300px',
        extracss: '.yui-tag-php { font-weight: bold; color: orange; } .yui-tag-ruby { font-weight: bold; color: red; }',
        toolbar: {
            collapse: true,
            titlebar: 'Text Editing Tools',
            draggable: false,
            buttons: [
                { group: 'codestyle', label: 'Code Style',
                    buttons: [
                        { type: 'select', label: 'HTML', value: 'codestyle', disabled: true,
                            menu: [
                                { text: 'HTML', value: 'html',  checked: true },
                                { text: 'Ruby', value: 'ruby' },
                                { text: 'PHP', value: 'php' }
                            ]
                        }
                    ]
                }
            ]
            
        }
    });
    myEditor.on('toolbarLoaded', function() {
        myEditor.on('afterNodeChange', function() {
            if (this._hasSelection()) {
                this.toolbar.enableButton('codestyle');
            } else {
                this.toolbar.disableButton('codestyle');
            }
        }, myEditor, true);
        myEditor.toolbar.on('codestyleClick', function(ev) {
            var type = ev.button.value.toLowerCase();
            this._createCurrentElement(type);
            return false;
        }, this, true);
    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
