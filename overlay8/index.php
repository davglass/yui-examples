<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Overlay Delayed Close</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Overlay Delayed Close</a></h1></div>
    <div id="bd">
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/container/container-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        timer = null;

    YAHOO.namespace('example.container');
    Event.onDOMReady(function() {
        YAHOO.example.container.overlay2 = new YAHOO.widget.Panel("overlay2" , {
            visible:false,
            context: ['bd',"tl", "bl"],
            width:"200px" 
        });


        YAHOO.example.container.overlay2.showEvent.subscribe(function() {
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout('YAHOO.example.container.overlay2.hide()', 2000); //Call myOverlay.hide after 2 seconds
        });

        YAHOO.example.container.overlay2.hideEvent.subscribe(function() {
            if (timer) {
                clearTimeout(timer);
            }
        });

        YAHOO.example.container.overlay2.setBody('This is a test');
        YAHOO.example.container.overlay2.render(document.body) ;
        YAHOO.example.container.overlay2.show();
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
