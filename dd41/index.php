<?php
    $count = (($_GET['count']) ? $_GET['count'] : 300);
    $unreg = (($_GET['unreg']) ? true : false);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop: Memory Leak</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .demo {
            border: 1px solid black;
            width: 40px;
            height: 20px;
            background-color: #ccc;
            float: left;
            margin: 3px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop: Memory Leak</a></h1></div>
    <div id="bd">
        <p>This example is addressing <a href="https://sourceforge.net/tracker/?func=detail&atid=836477&aid=1987371&group_id=165715">SF Bug #1987371</a></p>
        <p>This example creates 300 (pass ?count=xxx for more) div's, then attaches a YAHOO.util.DD instance to it.</p>
        <p>Passing ?unreg=1 will force them to be unregistered right after creation.</p>
        <?php
        for ($i = 1; $i <= $count; $i++) {
            echo('<div class="demo" id="demo_'.$i.'">#'.$i.'</div>'."\n");
        }
        ?>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/dragdrop/dragdrop-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        <?php
        for ($i = 1; $i <= $count; $i++) {
            echo('dd'.$i.' = new YAHOO.util.DD("demo_'.$i.'");'."\n");
            if ($unreg) {
                echo('dd'.$i.'.unreg();'."\n");
            }
        }
        ?>

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
