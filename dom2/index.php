<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Dom.getXY in iframe</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }

	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Dom.getXY in iframe</a></h1></div>
    <div id="bd">
    <p><iframe src="test.htm" height="300" width="300" id="testFrame" border="1" frameBorder="1"></iframe></p>
    <a href="#" id="getXY">[Get Picture XY]</a>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Event = YAHOO.util.Event,
        Dom = YAHOO.util.Dom;

    Event.onAvailable('getXY', function(ev) {
        Event.on('getXY', 'click', function(ev) {
            var doc = Dom.get('testFrame').contentWindow.document;
            var pic = doc.getElementById('pic');
            var DomXY = Dom.getXY(pic);
            alert('Dom.getXY on pic returned: [' + DomXY.join(', ') + ']');
            Event.stopEvent(ev);
        });
    });
})()

</script>
</body>
</html>
