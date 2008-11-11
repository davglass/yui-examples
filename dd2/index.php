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
        #droplist {
            border: 1px solid black;
            width: 250px;
            margin: 1em;
        }
        #results {
            border: 1px solid black;
            height: 45px;
            width: 350px;
            padding-left: .25em;
            margin: 1em;
        }
        ul {
            list-style-type: disc;
            margin: 5px 20px;
        }
        li {
            border: 1px solid white;
        }
        p {
            margin: 2em;
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
    <p>Basically, all I am doing is setting a var (lastTarget) onDragOver to the element that we are over. Then in the onDragDrop function, I am checking to see if the id that is returned matches the id that is stored in lastTarget. If it is, display the text in the box below.</p>
    <div id="droplist">
        <ul>
            <li id="test1">Test 1</li>
            <li id="test2">Test 2
                <ul>
                    <li id="test2-1">Test 2-1</li>
                    <li id="test2-2">Test 2-2</li>
                    <li id="test2-3">Test 2-3</li>
                    <li id="test2-4">Test 2-4</li>
                </ul>
            </li>
            <li id="test3">Test 3
                <ul>
                    <li id="test3-1">Test 3-1</li>
                    <li id="test3-2">Test 3-2</li>
                    <li id="test3-3">Test 3-3</li>
                    <li id="test3-4">Test 3-4</li>
                </ul>
            </li>
            <li id="test4">Test 4</li>
        </ul>
    </div>

    <div id="dropper">
    Drop me on the list
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

var dds = [];
var drop = null;
var lastTarget = false;
var myAnim = null;

function handleDrop(ev, id) {
    var tar = YAHOO.util.Event.getTarget(ev);
    if (lastTarget && id === lastTarget) {
        YAHOO.util.Dom.get('results').innerHTML = 'You dropped it on ID: (' + id + ')';
        clearDrop();
    }
}

function clearDrop() {
    myAnim = new YAHOO.util.Anim('dropper', {opacity: { to: 0 } });
    myAnim.animate();
    setTimeout('showDrop()', 2000);
}

function showDrop() {
    YAHOO.util.Dom.setXY('dropper', [350,250]);
    myAnim.attributes = { opacity: { to: 1}};
    myAnim.animate();
    YAHOO.util.Dom.get(lastTarget).style.border = '1px solid white';
    YAHOO.util.Dom.get('results').innerHTML = '';
}

function ddOver(ev, id) {
    var tar = YAHOO.util.Event.getTarget(ev);
    if (lastTarget) {
        YAHOO.util.Dom.get(lastTarget).style.border = '1px solid white';
    }
    lastTarget = id;
    YAHOO.util.Dom.get(id).style.border = '1px solid red';
}

function init() {
    var lis = YAHOO.util.Dom.get('droplist').getElementsByTagName('li');
    for (var i = 0; i < lis.length; i++) {
        dds[i] = new YAHOO.util.DDTarget(lis[i].id);
    }
    drop = new YAHOO.util.DDProxy('dropper');
    drop.onDragDrop = handleDrop;
    drop.onDragOver = ddOver;
}

YAHOO.util.Event.addListener(window, 'load', init);
</script>
</body>
</html>
