<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Patch for SF #2148477</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Patch for SF #2148477</a></h1></div>
    <div id="bd">
    <p>Editor: Patch for SF #<a href="https://sourceforge.net/tracker/?func=detail&atid=836476&aid=2148477&group_id=165715">2148477</a></p>
    <p>Download the patch file: <a href="patch.js">source</a> - <a href="patch-min.js">min</a></p>
    <div class="yui-skin-sam">
        <textarea id="editor">
        </textarea>
    </div>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript"><?php include('patch.js'); ?></textarea>

    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/container/container_core-min.js&2.6.0/build/menu/menu-min.js&2.6.0/build/element/element-beta-min.js&2.6.0/build/button/button-min.js&2.6.0/build/editor/editor-min.js"></script>
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="patch-min.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    var myEditor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '600px',
        dompath: true
    });
    myEditor.render();


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
