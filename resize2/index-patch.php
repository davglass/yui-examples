<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Resize Utility endResize Patch</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #test {
            border: 1px solid black;
            height: 200px;
            width: 200px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Resize Utility endResize Patch</a></h1></div>
    <div id="bd">
        <p>This example contains a patch for the lack of an endResize event in the 2.5.0/2.5.1 release of the YUI Resize Utility.</p>
        <p>Only one of these files should be included on the page after the Resize Utility has been included. <a href="patch.js">Full source of the patch</a> - <a href="patch-min.js">Compressed version</a></p>
        <div id="test">Resize Me</div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/logger/logger-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/resize/resize-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="patch-min.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    Event.onDOMReady(function() {
        var logger = new YAHOO.widget.LogReader();
        var resize = new YAHOO.util.Resize('test');
        resize.on('startResize', function() {
            YAHOO.log('startResize', 'info', 'Resize')
        });
        resize.on('resize', function() {
            YAHOO.log('resize', 'info', 'Resize');
        });
        resize.on('endResize', function() {
            YAHOO.log('endResize', 'info', 'Resize');
        });
    });


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
