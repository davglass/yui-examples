<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Italic with Color Patch</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2, #button_cont {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Italic with Color Patch</a></h1></div>
    <div id="bd">
    <p></p>
    <p><a href="#thecode">Jump to the code</a> -- <a href="patch.js">Patch Source File</a> -- <a href="patch-min.js">Compressed Source File</a></p>
    <textarea id="editor">
    This is a test.<br>
    This is a test.<br>
    This is a test.<br>
    This is a test.<br>
    This is a test.<br>
    This is a test.<br>
    </textarea>
    <textarea id="editor2">
    This is a test.<br>
    This is a test.<br>
    This is a test.<br>
    This is a test.<br>
    This is a test.<br>
    This is a test.<br>
    </textarea>
    <h2 id="thecode">The Javascript</h2>
    <textarea name="code" class="JScript"><? include('patch.js'); ?></textarea>
    
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
<script type="text/javascript" src="patch.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.SimpleEditor('editor', {
        height: '300px',
        width: '522px'
    });
    myEditor.render();

    var myEditor = new YAHOO.widget.Editor('editor2', {
        height: '300px',
        width: '522px'
    });
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
