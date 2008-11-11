<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor rendered hidden</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #editable {
            padding: 1em;
            margin: 1em;
        }
        #demo {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor rendered hidden</a></h1></div>
    <div id="bd">
        <p></p>
        <div id="editable"><b>Double click</b> this text to load the <em>editor with this content</em>.</div>
        <div id="demo">
            <textarea id="editor">nada</textarea>
            <button id="save">Save Editor Content</button>
        </div>
        <h2>The HTML</h2>
        <textarea name="code" class="html">
        <div id="editable"><b>Double click</b> this text to load the <em>editor with this content</em>.</div>
        <div id="demo">
            &lt;textarea id="editor"&gt;This is some test text to be loaded in the editor.&lt;/textarea&gt;
            <button id="save">Save Editor Content</button>
        </div>
        </textarea>
        <h2>The CSS</h2>
        <textarea name="code" class="html">
        #editable {
            padding: 1em;
            margin: 1em;
        }
        #demo {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        </textarea>
        <h2 id="theCode">The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = null,
        _button = new YAHOO.widget.Button('save');

        _button.on('click', function() {
            myEditor.saveHTML();
            setTimeout(function() {
                Dom.get('editable').innerHTML = myEditor.get('textarea').value;
                Dom.setStyle('demo', 'position', 'absolute');
                Dom.setStyle('demo', 'top', '-9999px');
                Dom.setStyle('demo', 'left', '-9999px');
                Dom.setStyle('editable', 'display', 'block');
            }, 200);
        });

        myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '522px'
        });
        myEditor.render();

    Event.onDOMReady(function() {
        Event.on('editable', 'dblclick', function() {
            myEditor.setEditorHTML(Dom.get('editable').innerHTML);
            Dom.setStyle('demo', 'position', 'static');
            Dom.setStyle('demo', 'top', '');
            Dom.setStyle('demo', 'left', '');
            Dom.setStyle('editable', 'display', 'none');
            myEditor._focusWindow();
        });
    });
})();
</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/tabview/tabview-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/button/button-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/editor/editor-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = null,
        _button = new YAHOO.widget.Button('save');

        _button.on('click', function() {
            myEditor.saveHTML();
            setTimeout(function() {
                Dom.get('editable').innerHTML = myEditor.get('textarea').value;
                Dom.setStyle('demo', 'position', 'absolute');
                Dom.setStyle('demo', 'top', '-9999px');
                Dom.setStyle('demo', 'left', '-9999px');
                Dom.setStyle('editable', 'display', 'block');
            }, 200);
        });

        myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '522px'
        });
        myEditor.render();

    Event.onDOMReady(function() {
        Event.on('editable', 'dblclick', function() {
            myEditor.setEditorHTML(Dom.get('editable').innerHTML);
            Dom.setStyle('demo', 'position', 'static');
            Dom.setStyle('demo', 'top', '');
            Dom.setStyle('demo', 'left', '');
            Dom.setStyle('editable', 'display', 'none');
            myEditor._focusWindow();
        });
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
