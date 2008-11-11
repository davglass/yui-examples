<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: TreeView from UL</title>
    <link href="../css/fonts-min.css" rel="stylesheet" type="text/css">
    <link href="../css/grids-min.css" rel="stylesheet" type="text/css">
    <link href="assets/tree.css" rel="stylesheet" type="text/css">
    <link href="../css/calendar_assets/calendar.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        #treeHolder {
            border: 1px solid blue;
            height: 35em;
            width: 20em;
        }
        #preData {
            border: 1px solid red;
            color: red;
        }
        #preData {
            margin-top: 0;
        }
    </style>
</head>
<body>
<div id="treeDiv1"></div>
    <script src="../js/yahoo-min.js" type="text/javascript"></script>
    <script src="../js/dom-min.js" type="text/javascript"></script>
    <script src="../js/event-min.js" type="text/javascript"></script>
    <script src="../js/animation-min.js" type="text/javascript"></script>
    <script src="../js/treeview-min.js" type="text/javascript"></script>
    <script src="../js/calendar-min.js" type="text/javascript"></script>
    <script type="text/javascript">

var tree;
var cal1;
function treeInit() {
    tree = new YAHOO.widget.TreeView("treeDiv1");
    var root = tree.getRoot();
    var tmpNode = new YAHOO.widget.TextNode('Click to view the calendar', root, false);
    var tmpNode2 = new YAHOO.widget.TextNode('YUI Calendar<div id="testCal"></div>', tmpNode, false);
    var tmpNode3 = new YAHOO.widget.TextNode("Empty Node 1", root, false);
    var tmpNode31 = new YAHOO.widget.TextNode('Empty Node 1-1', tmpNode3, false);
    var tmpNode4 = new YAHOO.widget.TextNode("Empty Node 2", root, false);
    var tmpNode41 = new YAHOO.widget.TextNode('Empty Node 2-1', tmpNode4, false);
    var tmpNode5 = new YAHOO.widget.TextNode("Empty Node 3", root, false);
    var tmpNode51 = new YAHOO.widget.TextNode('Empty Node 3-1', tmpNode5, false);
    var tmpNode6 = new YAHOO.widget.TextNode("Empty Node 4", root, false);
    var tmpNode61 = new YAHOO.widget.TextNode('Empty Node 4-1', tmpNode6, false);
    var tmpNode7 = new YAHOO.widget.TextNode("Empty Node 5", root, false);
    var tmpNode71 = new YAHOO.widget.TextNode('Empty Node 5-1', tmpNode7, false);
    
    tree.draw();
}

function makeCal() {
    cal1 = new YAHOO.widget.Calendar("cal1","testCal");
    cal1.render();
}

treeInit();
YAHOO.util.Event.onAvailable('testCal', makeCal);
    </script>
</body>
</html>
