<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor with Basic Link and Image Editing</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor with Basic Link and Image Editing</a></h1></div>
    <div id="bd">
    <p>This example shows how to have an Editor instance using the SimpleEditor Image and Link editing.</p>
    <textarea id="editor">
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '522px',
        dompath: true
    });
    //Override these methods on the current instance with copies from the SimpleEditor's prototype
    myEditor._handleCreateLinkClick = YAHOO.widget.SimpleEditor.prototype._handleCreateLinkClick;
    myEditor._handleCreateLinkWindowClose = YAHOO.widget.SimpleEditor.prototype._handleCreateLinkWindowClose;
    myEditor._handleInsertImageClick = YAHOO.widget.SimpleEditor.prototype._handleInsertImageClick;
    myEditor._handleInsertImageWindowClose = YAHOO.widget.SimpleEditor.prototype._handleInsertImageWindowClose;
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
        height: '300px',
        width: '522px',
        dompath: true
    });
    //Override these methods on the current instance with copies from the SimpleEditor's prototype
    myEditor._handleCreateLinkClick = YAHOO.widget.SimpleEditor.prototype._handleCreateLinkClick;
    myEditor._handleCreateLinkWindowClose = YAHOO.widget.SimpleEditor.prototype._handleCreateLinkWindowClose;
    myEditor._handleInsertImageClick = YAHOO.widget.SimpleEditor.prototype._handleInsertImageClick;
    myEditor._handleInsertImageWindowClose = YAHOO.widget.SimpleEditor.prototype._handleInsertImageWindowClose;
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
