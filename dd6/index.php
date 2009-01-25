<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop: Ordering</title>
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
        .demo {
            height: 100px;
            width: 100px;
            background-color: #ccc;
            float: left;
            margin: 1em;
            border: 1px solid black;
            font-size: 120%;
            font-weight: bold;
        }
        #player1 { background-color: red; cursor: move; height: 99px; }
        #player2 { background-color: blue; cursor: move; height: 99px; }
        #player3 { background-color: green; cursor: move; height: 99px; }
        #player4 { background-color: yellow; cursor: move; height: 99px; }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop: Ordering</a></h1></div>
    <div id="bd">
    Positions: <input type="text" id="overTarget" value="" size="75" /><br>
    <div>
        <div id="target1" class="demo"></div>
        <div id="target2" class="demo"></div>
        <div id="target3" class="demo"></div>
        <div id="target4" class="demo"></div>
    </div>
    <br clear="all" />
    <div>
        <div id="p1" class="demo"><div id="player1">1</div></div>
        <div id="p2" class="demo"><div id="player2">2</div></div>
        <div id="p3" class="demo"><div id="player3">3</div></div>
        <div id="p4" class="demo"><div id="player4">4</div></div>
    </div>
    </div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>

<script type="text/javascript">
var defaultZ = 900;
var pos = [];
pos[0] = 'empty';
pos[1] = 'empty';
pos[2] = 'empty';
pos[3] = 'empty';
var dragging = false;
var lastTar = '';

YAHOO.util.DDM.mode = YAHOO.util.DDM.INTERSECT;

function init() {
    YAHOO.util.Dom.get('overTarget').value = pos;

    play1 = new YAHOO.util.DD('player1');
    play2 = new YAHOO.util.DD('player2');
    play3 = new YAHOO.util.DD('player3');
    play4 = new YAHOO.util.DD('player4');

    play1.onDragOver = dragOver;
    play2.onDragOver = dragOver;
    play3.onDragOver = dragOver;
    play4.onDragOver = dragOver;

    play1.onDragStart = dragStart;
    play2.onDragStart = dragStart;
    play3.onDragStart = dragStart;
    play4.onDragStart = dragStart;

    play1.onDragDrop = dragDrop;
    play2.onDragDrop = dragDrop;
    play3.onDragDrop = dragDrop;
    play4.onDragDrop = dragDrop;

    play1.onMouseUp = mouseUp;
    play2.onMouseUp = mouseUp;
    play3.onMouseUp = mouseUp;
    play4.onMouseUp = mouseUp;

    tar1 = new YAHOO.util.DDTarget('target1');
    tar2 = new YAHOO.util.DDTarget('target2');
    tar3 = new YAHOO.util.DDTarget('target3');
    tar4 = new YAHOO.util.DDTarget('target4');
}

function dragOver(ev, id) {
    var bestMatch = YAHOO.util.DDM.getBestMatch(id);
    YAHOO.util.Dom.setStyle(bestMatch.id, 'border', '1px solid red');
    if (lastTar && (lastTar.id != bestMatch.id)) {
        YAHOO.util.Dom.setStyle(lastTar.id, 'border', '1px solid black');
    }
    lastTar = bestMatch;
}

function dragDrop(ev, id) {
    var bestMatch = YAHOO.util.DDM.getBestMatch(id);
    var tar = YAHOO.util.Event.getTarget(ev);
    xy = YAHOO.util.Dom.getXY(bestMatch.id);
    YAHOO.util.Dom.setXY(tar, xy);
    pos[bestMatch.id.substring(6) - 1] = tar.id;

    //This kills the drag and drop..
    this.unreg();
    dragging = true;
    YAHOO.util.Dom.get('overTarget').value = pos;
}

function mouseUp(ev) {
    if (!dragging) {
        var tar = YAHOO.util.Event.getTarget(ev);
        xy = YAHOO.util.Dom.getXY('p' + tar.id.substring(6));
        YAHOO.util.Dom.setXY(tar, xy);
        
    }
    if (lastTar) {
        YAHOO.util.Dom.setStyle(lastTar.id, 'border', '1px solid black');
    }
    dragging = false;
}

function dragStart() {
    dragging = false;
}

YAHOO.util.Event.addListener(window, 'load', init);

</script>
</body>
</html>
