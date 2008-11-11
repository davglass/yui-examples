<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Layout Manager: Custom LayoutUnits</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Layout Manager: Custom LayoutUnits</a></h1></div>
    <div id="bd">
    <p>This example shows how to use HTML that is already on the page to build a Layout Unit..</p>
    <p><a href="example.php" target="_blank">View Example</a></p>
    <h2>The HTML for the Example</h2>
    <textarea name="code" class="JScript">
    <style>
    .yui-skin-sam .yui-layout .yui-layout-unit-left div.yui-layout-hd .collapse {
        display: none;
    }
    </style>
    <body class="yui-skin-sam">
    <div id="left">
        <div class="yui-layout-hd">Custom Header<a href="#" id="hideLeft">HIDE</a></div>
        <div class="yui-layout-bd">
            <p>This is the body of my custom layout unit marked up in HTML.</p>
            <p>This is the body of my custom layout unit marked up in HTML.</p>
        </div>
        <div class="yui-layout-ft">My Footer in HTML</div>
    </div>
    </body>
    </textarea>
    <h2>The Javascript for the Example</h2>
    <textarea name="code" class="JScript"><?php include('source.js'); ?></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script> 
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
