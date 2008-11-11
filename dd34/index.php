<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop: Multiple Items</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #play {
            width: 500px;
            border: 1px solid black;
            zoom: 1;
        }
        #play:after { display: block; clear: both; visibility: hidden; content: '.'; height: 0; }        
        #play .drag {
            height: 100px;
            width: 100px;
            border: 1px solid black;
            background-color: #ccc;
            float: left;
            margin: 5px;
        }
        #play .selected {
            border: 1px solid red;
        }
        #bd {
            position: relative;
        }
        #drop, #drop2 {
            position: absolute;
            right: 10px;
            top: 100px;
            height: 400px;
            width: 200px;
            border: 1px solid black;
            background-color: #ccc;
            zoom: 1;
        }
        #drop2 {
            right: 230px;
        }
        #drop:after, #drop2:after { display: block; clear: both; visibility: hidden; content: '.'; height: 0; }        
        #drop .drag, #drop2 .drag {
            height: 50px;
            width: 50px;
            border: 1px solid black;
            background-color: #ccc;
            float: left;
            margin: 5px;
            overflow: hidden;
        }
        #promo {
            margin-right: 430px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop: Multiple Items</a></h1></div>
    <div id="bd">
        <div id="promo">
        <p>This example shows a <strong>simple</strong> solution to allowing the user to multi-select items and then drag and drop them.</p>
        <p>You shift click the items you want to add to the drag queue (they will get a red border), once you have selected all the items, click one that is highlighted and drag it.</p>
        <p>The other selected items will attach themselves to the main dragged item with a little bit of an offset, then you can drop them on the droppable area to the right.</p>
        <p><a href="#thecode">The Javascript Code for this example</a></p>
        </div>
        <div id="drop">Drop on me..</div>
        <div id="drop2">Drop on me..II</div>
        <div id="play">
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
            <div class="drag">Draggable</div>
        </div>
        <h2 id="thecode">The Javascript</h2>
        <textarea name="code" class="JScript"><?php include('source.js'); ?></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/selector/selector-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="source.js?stamp=<?php echo(mktime()); ?>"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;



    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
