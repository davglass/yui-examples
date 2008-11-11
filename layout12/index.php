<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Layout Manager: Prototype 1.6</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Layout Manager: Prototype 1.6</a></h1></div>
    <div id="bd">
    <p>This example was built for this <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/30688">YDN Javascript thread.</a></p>
    <p>The Resize Utility instance used for the Layout Unit's was getting the <code>wrap</code> config set due to prototype's use of Object/Function overloading (the have a method named wrap). This caused the Resize Utility to apply that config and caused LayoutUnit to not size itself properly. Hence, no resize handles.</p>
    <p>You can include this minimized patch after the includes for the YUI Layout Manager and it should start working again.</p>
    <p><a href="patch.js">Patch File</a> - <a href="patch-min.js">Min Patch File</a></p>
    <p><a href="example.php">View Example</a></p>
    <h2>The Javascript - Patch</h2>
    <textarea name="code" class="JScript">
    <?php include('patch.js'); ?>
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;



    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
