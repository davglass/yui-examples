<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Event Test</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #results {
            height: 300px;
            width: 500px;
            border: 1px solid black;
            background-color: #f2f2f2;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Event Test</a></h1></div>
    <div id="bd">
        <p>This test uses a single Element instance to set attributes in itself, then via an Event sets the same value in an Object that doesn't use events. It creates 5 elements, then sets 30 attributes 50 times on each element.</p>
        <p>Eliminates the Control Object and sets the data from inside the "method" on the attribute.</p>
        <h2>Results</h2>
        <div id="results"></div>
        <div id="test1"></div>
        <div id="test2"></div>
        <div id="test3"></div>
        <div id="test4"></div>
        <div id="test5"></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/dom/dom-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/event/event-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/element/element-beta-min.js"></script> 
<script type="text/javascript" src="timer.js"></script> 
<script type="text/javascript" src="event-test2-2.js"></script> 
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    for (var e = 1; e < 6; e++) {
        YAHOO.Timer.start('Element' + e);
        var test = new YAHOO.Test('test' + e);
        for (var o = 0; o < 51; o++) {
            for (var s = 1; s < 31; s++) {
                test.set('attr' + s, true);
                test.set('title', 'Title for Element #' + e);
            }
        }
        Dom.get('results').innerHTML += YAHOO.Timer.end('Element' + e) + '<br>';
    }
    Dom.get('results').innerHTML += '<strong>' + YAHOO.Timer.avg() + '</strong>';
})();

</script>
</body>
</html>
