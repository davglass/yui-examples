<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop: Start and End Positions</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    
    <style type="text/css" media="screen">
        @import url( style.css );

        #dropper {
            border: 1px solid black;
            background-color: #ccc;
            width: 200px;
            height: 15px;
            padding: .25em;
            cursor: pointer;
            cursor: hand;
            margin: 1em;
            position: absolute;
            top: 250px;
            left: 350px;
        }
        #davdoc {
            position: relative;
        }
        #bd h2 {
            margin-top: 30em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop: Start and End Positions</a></h1></div>
    <div id="bd">
        <p>This example shows how to get the start and end positions from a DragDrop object.</p>
        <div id="dropper">
        Drag me around and drop me
        </div>
        <div id="results"></div>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Event = YAHOO.util.Event,
        Dom = YAHOO.util.Dom,
        ddTar = null,
        res = Dom.get('results'),
        startPoints = null;


    var handleEnd = function(ev) {
        var tar = Event.getTarget(ev),
            str = 'Starting X: ' + startPoints[0] + '<br>Starting Y: ' + startPoints[1] + '<br><br>',
            xy = Dom.getXY(tar);

        str += 'Current X: ' + xy[0] + '<br>Current Y: ' + xy[1] + '<br>';
        startPoints = null;
        res.innerHTML = str;
    };

    var handleStart = function() {
        startPoints = Dom.getXY('dropper');
    };

    Event.onDOMReady(function() {
        drop = new YAHOO.util.DD('dropper');
        drop.endDrag = handleEnd;
        drop.b4StartDrag = handleStart;
    });

})();
        </textarea>
    </div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script>
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Event = YAHOO.util.Event,
        Dom = YAHOO.util.Dom,
        ddTar = null,
        res = Dom.get('results'),
        startPoints = null;


    var handleEnd = function(ev) {
        var tar = Event.getTarget(ev),
            str = 'Starting X: ' + startPoints[0] + '<br>Starting Y: ' + startPoints[1] + '<br><br>',
            xy = Dom.getXY(tar);

        str += 'Current X: ' + xy[0] + '<br>Current Y: ' + xy[1] + '<br>';
        startPoints = null;
        res.innerHTML = str;
    };

    var handleStart = function() {
        startPoints = Dom.getXY('dropper');
    };

    Event.onDOMReady(function() {
        drop = new YAHOO.util.DD('dropper');
        drop.endDrag = handleEnd;
        drop.b4StartDrag = handleStart;
    });

    dp.SyntaxHighlighter.HighlightAll('code');

})();

</script>
</body>
</html>
