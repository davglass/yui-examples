<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Resize Utility: Textarea</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #wrap {
            height: 208px;
            width: 408px;
        }
        #resize {
            height: 200px;
            width: 400px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Resize Utility: Textarea</a></h1></div>
    <div id="bd">
    <p>This example shows how to resize a <code>textarea</code>.</p>
    <div id="wrap">
        <textarea id="resize">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper, rutrum ac, enim. Nullam pretium interdum metus. Ut in neque. Vivamus ut lorem vitae turpis porttitor tempor. Nam consectetuer est quis lacus. Mauris ut diam nec diam tincidunt eleifend. Vivamus magna. Praesent commodo egestas metus. Praesent condimentum bibendum metus. Sed sem sem, molestie et, venenatis eget, suscipit quis, dui. Morbi molestie, ipsum nec posuere lobortis, massa diam aliquet pede, tempor ultricies neque tortor sit amet nisi. Suspendisse vel quam in nisl dictum condimentum. Maecenas volutpat leo vitae leo. Nullam elit arcu, ullamcorper commodo, elementum nec, dictum nec, augue. Maecenas at tellus vitae ante fermentum elementum. Ut auctor ante et nisi. Suspendisse sagittis tristique eros.
        </textarea>
    </div>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var resize = new YAHOO.util.Resize('wrap');
        resize.on('resize', function(e) {
            Dom.setStyle('resize', 'height', (e.height - 10) + 'px');
            Dom.setStyle('resize', 'width', (e.width - 10) + 'px');
        }, resize, true);
    });
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/resize/resize-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var resize = new YAHOO.util.Resize('wrap');
        resize.on('resize', function(e) {
            Dom.setStyle('resize', 'height', (e.height - 10) + 'px');
            Dom.setStyle('resize', 'width', (e.width - 10) + 'px');
        }, resize, true);
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
