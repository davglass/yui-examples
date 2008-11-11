<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Multiple Flickr Image Search</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <link rel="stylesheet" type="text/css" href="editor_flickr.css">
    <style type="text/css" media="screen">
        p, h2, #button_cont {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Multiple Flickr Image Search</a></h1></div>
    <div id="bd">
    <p>This example has been requested several times on the list, so I figured that I would make it one of my examples.</p>
    <p>In this example, I will port the <a href="http://developer.yahoo.com/yui/examples/editor/flickr_editor.html">Flickr Image Search</a> example and allow it to be placed on more than one editor instance.</p>
    <p><a href="editor_flickr.js">Here is the ful source for the example.</a></p>
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
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/menu/menu-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/editor/editor-beta-min.js"></script>
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="editor_flickr.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    var myEditor = new YAHOO.FlickrEditor('editor', {
        height: '300px',
        width: '522px'
    });
    myEditor.render();
    var myEditor2 = new YAHOO.FlickrEditor('editor2', {
        height: '300px',
        width: '522px'
    });
    myEditor2.render();



    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
