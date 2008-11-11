<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Dom XY issue</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #bd {
            position: relative;
        }
        #demo1 {
            border: 1px solid black;
            background-color: #808080;
            height: 200px;
            width: 200px;
            position: absolute;
            top: 50px;
            left: 50px;
        }
        #demo3 {
            border: 1px solid black;
            background-color: #808080;
            height: 200px;
            width: 200px;
            position: absolute;
        }
        #demo2 {
            border: 1px solid black;
            background-color: red;
            opacity: .5;
            height: 100px;
            width: 100px;
            position: absolute;
        }
        #demo4 {
            border: 1px solid black;
            background-color: blue;
            opacity: .5;
            height: 100px;
            width: 100px;
            position: absolute;
            top: 450px;
            left: 500px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Dom XY Issue</a></h1></div>
    <div id="bd">
        <div id="demo1">Demo #1</div>
        <div id="demo3">Demo #3</div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<div id="demo2">Demo #2</div>
<div id="demo4">Demo #4</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var xy = Dom.getXY('demo1');
        Dom.setXY('demo2', xy);

        var xy2 = Dom.getXY('demo4');
        Dom.setXY('demo3', xy2);
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
