<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop Nested targets</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( style.css );

        #dropper {
            border: 1px solid black;
            background-color: #ccc;
            width: 150px;
            height: 15px;
            padding: .25em;
            cursor: pointer;
            cursor: hand;
            margin: 1em;
            position: absolute;
            top: 250px;
            left: 350px;
        }
        #dropBox {
            border: 1px solid black;
            width: 250px;
            height: 250px;
            margin: 1em;
        }
        #davdoc {
            position: relative;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Drag Drop onto Nested Targets</a></h1></div>
    <div id="bd">
    <select id="switcher">
        <option value="point">POINT</option>
        <option value="intersect">INTERSECT</option>
    </select>
    <div id="dropBox">
        Drop it here!
    </div>
    <div id="dropper">
    Drop me on the box
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
YAHOO.util.DDM.mode = YAHOO.util.DDM.POINT;

function modeSwitch() {
    var sw = YAHOO.util.Dom.get('switcher');
    var sInd = sw.options[sw.selectedIndex].value;
    if (sInd == 'point') {
        YAHOO.util.DDM.mode = YAHOO.util.DDM.POINT;
    } else {
        YAHOO.util.DDM.mode = YAHOO.util.DDM.INTERSECT;
    }
    res.innerHTML = 'Switching to ' + sInd + ' mode.';
    handleUp();
}

function handleOver(ev, dd) {
    var tar = YAHOO.util.Event.getTarget(ev);
    if (dd instanceof Array) {
        var onEl = dd[0].id;
    } else {
        var onEl = dd;
    }
    var str = 'Dropping: (' + tar.id + ')<br>On: (' + onEl + ')';
    res.innerHTML = str;
}

function init() {
    ddTar = new YAHOO.util.DDTarget('dropBox');
    drop = new YAHOO.util.DD('dropper');
    drop.onDragOver = handleOver;
    drop.onMouseUp = handleUp;
    YAHOO.util.Event.addListener('switcher', 'change', modeSwitch);
}

YAHOO.util.Event.addListener(window, 'load', init);

function handleUp(ev) {
    tar = YAHOO.util.Dom.get('dropper');
    var tmp2 = new YAHOO.util.DD(tar.id);
    YAHOO.util.Dom.setXY(tar, [350, 250]);
}


</script>
</body>
</html>
