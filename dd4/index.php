<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop Example</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
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
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Drag Drop Example</a></h1></div>
    <div id="bd">
    <div id="dropper">
    Drage me around and drop me
    </div>
    <div id="results"></div>
    </div>
</div>
<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript">

var ddTar;
var res = YAHOO.util.Dom.get('results');
var startPoints = null;


function handleEnd(ev) {
    var tar = YAHOO.util.Event.getTarget(ev);
    var str = 'Starting X: ' + startPoints[0] + '<br>Starting Y: ' + startPoints[1] + '<br><br>';
    var xy = YAHOO.util.Dom.getXY(tar);
    str += 'Current X: ' + xy[0] + '<br>Current Y: ' + xy[1] + '<br>';
    startPoints = null;
    res.innerHTML = str;
}

function init() {
    drop = new YAHOO.util.DD('dropper');
    drop.endDrag = handleEnd;
    drop.onMouseUp = handleUp;
    drop.startDrag = handleStart;
}

YAHOO.util.Event.addListener(window, 'load', init);

function handleStart(x,y) {
    startPoints = [x, y];
}

function handleUp(ev) {
    init();
}


</script>
</body>
</html>
