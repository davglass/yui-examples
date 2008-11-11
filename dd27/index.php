<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop Snap to Grid</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        p {
            background-color: #fff;
        }
        #davdoc {
            background-image: url( grid.png );
        }
        #dragelicious {
            height: 100px;
            width: 100px;
            background-color: blue;
            top: 212px;
            left: 119px;
            position: absolute;
            cursor: move;
        }
        .dp-highlighter {
            position: relative;
            top: 300px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop Snap to Grid</a></h1></div>
    <div id="bd">
        <p>This example shows how to use setXConstraint and setYConstraint with the <code>ticks</code> option set to make a DD object snap to a grid.</p>
		<div id="dragelicious"></div>
        <textarea name="code" class="JScript" id="code">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myDDObj = new YAHOO.util.DD("dragelicious");
    //Object can move 0 pixels left &amp; 600 pixels right
    //In 25 pixel movements 
    myDDObj.setXConstraint(0, 600, 25);
    //Object can move 50 pixels up &amp; 100 pixels down
    //In 25 pixel movements 
    myDDObj.setYConstraint(50, 100, 25);
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myDDObj = new YAHOO.util.DD("dragelicious");
    //Object can move 0 pixels left & 600 pixels right
    //In 25 pixel movements 
    myDDObj.setXConstraint(0, 600, 25);
    //Object can move 50 pixels up & 100 pixels down
    //In 25 pixel movements 
    myDDObj.setYConstraint(50, 100, 25);

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
