<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Element: addons</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            border: 1px solid black;
            width: 200px;
            height: 200px;
            background-color: #ccc;
            margin: 2em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Element: addons</a></h1></div>
    <div id="bd">
        <p>Add-on methods for the YUI Element Utility.</p>
        <p><a href="docs/">Docs</a> - <a href="element-addons.js">Source</a> - <a href="element-addons-min.js">Minned</a></p>
        <div id="demo">Click Me!</div>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var demo = new YAHOO.util.Element('demo');
    demo.on('click', function() {
        var str = '';
        str += 'xy: ' + this.getXY().join() + '<br>';
        str += 'region: ' + YAHOO.lang.dump(this.getRegion()) + '<br>';
        this.get('element').innerHTML = str;
    });
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="element-addons-min.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var demo = new YAHOO.util.Element('demo');
    demo.on('click', function() {
        var str = '';
        str += 'xy: ' + this.getXY().join() + '<br>';
        str += 'region: ' + YAHOO.lang.dump(this.getRegion()) + '<br>';
        this.get('element').innerHTML = str;
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
