<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Dom getStyle - background-position</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo, #demo2 {
            height: 200px;
            width: 200px;
            border: 1px solid black;
            background-image: url( Photo1.jpg );
            margin: 2em;
            background-repeat: no-repeat;
        }
        #demo {
            background-position: 20px 20px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Dom getStyle - background-position</a></h1></div>
    <div id="bd">
        <p>computedStyle doesn't return background-position when it is declared in CSS, but it will return it when it's declared inline..</p>
        <p>Click the DIV's below to see it's background-position</p>
        <div id="demo">Set in CSS</div>
        <div id="demo2" style="background-position: 15px 15px">Set inline</div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.on(['demo', 'demo2'], 'click', function() {
        alert('Background-Position: ' + YAHOO.util.Dom.getStyle(this, 'background-position'));
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
