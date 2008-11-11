<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Filter Href's from Document</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2, #button_cont {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Filter Href's from Document</a></h1></div>
    <div id="bd">
    <p>This example show's how to filter the HTML inside the Editor and place it back into the Editor.</p>
    <p><a href="#thecode">Jump to the code</a></p>
    <textarea id="editor">
    <a href="#">Lorem ipsum dolor sit amet</a>, consectetuer adipiscing elit. <a href="#">Suspendisse justo nibh</a>, pharetra at, adipiscing ullamcorper. Lorem <a href="#">ipsum dolor sit amet</a>, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper.
    </textarea>
    <div id="button_cont"></div>
    <h2 id="thecode">The Javascript</h2>
    <textarea name="code" class="JScript"><? include('source.js'); ?></textarea>
    
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/menu/menu-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/editor/editor-beta-min.js"></script>
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="source.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
