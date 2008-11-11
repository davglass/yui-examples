<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Draggable</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Draggable</a></h1></div>
    <div id="bd">
    <p>This example shows how to make the Editor draggable.</p>
    <textarea id="editor" rows="10" cols="100">
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.Editor('editor', {
        height: '350px',
        width: '580px',
        dompath: true
    });
    editor.on('toolbarLoaded', function() {
        var dd = new YAHOO.util.DD(editor.get('element_cont').get('element'));
        Dom.setStyle(editor.toolbar._titlebar, 'cursor', 'move');
        dd.setHandleElId(editor.toolbar._titlebar);
    });

    editor.render();
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/editor/editor-beta-min.js"></script> 

<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.Editor('editor', {
        height: '350px',
        width: '580px',
        dompath: true
    });
    editor.on('toolbarLoaded', function() {
        var dd = new YAHOO.util.DD(editor.get('element_cont').get('element'));
        Dom.setStyle(editor.toolbar._titlebar, 'cursor', 'move');
        dd.setHandleElId(editor.toolbar._titlebar);
    });

    editor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
