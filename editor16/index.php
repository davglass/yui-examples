<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Prototype: 1.4</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor and Prototype: 1.4</a></h1></div>
    <div id="bd">
        <p>This page contains YUI RTE 2.4.1 and Prototype: 1.4</p>
        <h2>Editor #1</h2>
        <textarea id="msgpost">This is a test</textarea>
        <h2>Editor #2</h2>
        <textarea id="msgpost2">This is a test</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="prototype-1.4.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/element/element-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/container/container_core-min.js"></script>	
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/menu/menu-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/button/button-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/editor/editor-beta-min.js"></script>
<script type="text/javascript" src="../editor34/patch-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        win = null;

    var myEditor = new YAHOO.widget.Editor('msgpost', {
        height: '300px',
        width: '545px',
        dompath: true, //Turns on the bar at the bottom
        animate: true //Animates the opening, closing and moving of Editor windows
    });
    myEditor.render();

    var myEditor2 = new YAHOO.widget.Editor('msgpost2', {
        height: '300px',
        width: '545px',
        dompath: true, //Turns on the bar at the bottom
        animate: true //Animates the opening, closing and moving of Editor windows
    });
    myEditor2.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
