<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Disable context menu inside editor</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Disable context menu inside editor</a></h1></div>
    <div id="bd">
        <p>This example shows how to stop the browser context menu inside the editable area.</p>
        <p><a href="#thecode">Jump to the code</a></p>
        <textarea id="editor"></textarea>
        <h2 id="thecode">The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    //Initialize the Editor instance
    var editor = new YAHOO.widget.SimpleEditor('editor', {
        width: '533px',
        height: '300px'
    });
    //Listen for the contentLoaded event
    editor.on('editorContentLoaded', function() {
        //Listen for the contextmenu event on the editor document
        Event.on(this._getDoc(), 'contextmenu', function(ev) {
            //Stop the event and the context menu will not open.
            Event.stopEvent(ev);
        });
    });
    //Render the editor
    editor.render();
})();
        </textarea>

    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/menu/menu-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/editor/editor-beta-min.js"></script>
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    //Initialize the Editor instance
    var editor = new YAHOO.widget.SimpleEditor('editor', {
        width: '533px',
        height: '300px'
    });
    //Listen for the contentLoaded event
    editor.on('editorContentLoaded', function() {
        //Listen for the contextmenu event on the editor document
        Event.on(this._getDoc(), 'contextmenu', function(ev) {
            //Stop the event and the context menu will not open.
            Event.stopEvent(ev);
        });
    });
    //Render the editor
    editor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
