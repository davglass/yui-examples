<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: 3-way Resizable Panel with iFrame inside</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <link rel="stylesheet" type="text/css" href="source.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }

	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: 3-way Resizable Panel with iFrame inside</a></h1></div>
    <div id="bd">
        <p><strong>Resizable Panel #1</strong>: This technique uses pure CSS to make the iframe invisible when the panel starts resizing.</p>
        <p><strong>Resizable Panel #2</strong>: This technique uses a mixture of JS and CSS to mask the iframe when the panel starts resizing. I have the mask set with a light opacity so you can see it.</p>
        <p><a href="source1.js">Javascript Source for Panel #1</a> - <a href="source2.js">Javascript Source for Panel #2</a> - <a href="source.css">Css File for both examples</a></p>
        <div id="resizablepanel">
            <div class="hd">Resizable Panel #1</div>
            <div class="bd">
                <iframe src="blank.htm" border="0" frameborder="0" scrolling="yes"></iframe>
            </div>
            <div class="ft"></div>
        </div>
        <p></p>
        <div id="resizablepanel2">
            <div class="hd">Resizable Panel #2</div>
            <div class="bd">
                <iframe src="blank.htm" border="0" frameborder="0" scrolling="yes"></iframe>
                <div class="resize-mask"></div>
            </div>
            <div class="ft"></div>
        </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/resize/resize-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="source1.js"></script>
<script type="text/javascript" src="source2.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
