<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop Select List</title>
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
        select {
            width: 200px;
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Drag Drop Select List</a></h1></div>
    <div id="bd">
    <select id="mainBox" size="4">
        <option id="dd1"> Test 1 </option>
        <option id="dd2"> Test 2 </option>
        <option id="dd3"> Test 3 </option>
        <option id="dd4"> Test 4 </option>
        <option id="dd5"> Test 5 </option>
        <option id="dd6"> Test 6 </option>
        <option id="dd7"> Test 7 </option>
        <option id="dd8"> Test 8 </option>
        <option id="dd9"> Test 9 </option>
    </select>
    <div id="results"></div>
    </div>
</div>
<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript">


function init() {
    new YAHOO.util.DDProxy("dd1");
    new YAHOO.util.DDProxy("dd2");
    new YAHOO.util.DDProxy("dd3");
    new YAHOO.util.DDProxy("dd4");
    new YAHOO.util.DDProxy("dd5");
    new YAHOO.util.DDProxy("dd6");
    new YAHOO.util.DDProxy("dd7");
    new YAHOO.util.DDProxy("dd8");
    new YAHOO.util.DDProxy("dd9");

}

YAHOO.util.Event.addListener(window, 'load', init);

</script>
</body>
</html>
