<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Bacon Utility</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            margin: 2em;
            border: 1px solid black;
            width: 400px;
            height: 300px;
        }
        #demo2 {
            height: 100px;
            width: 200px;
            border: 1px solid blue;
            position: absolute;
            top: 300px;
            right: 200px;
        }
        .show-bacon {
            background-image: url( bacon.jpg );
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Bacon Utility</a></h1></div>
    <div id="bd">
        <p>This example is in response to this <a href="https://twitter.com/ysaw/statuses/957253347">Twitter status</a>. Make sure your sound is on ;)</p>
        <p><strong>Update: added <a href="docs/">API docs here</a></strong></p>
        <div id="demo">Mouse Over Me..</div>
        <div id="demo2">Mouse Over Me too..</div>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
    var foo = new YAHOO.util.Bacon('demo');
    var bar = new YAHOO.util.Bacon('demo2');
        </textarea>
        <textarea name="code" class="JScript"><?php include('bacon.js'); ?></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="soundmanager2-nodebug-jsmin.js"></script>
<script type="text/javascript" src="bacon.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var foo = new YAHOO.util.Bacon('demo');
    var bar = new YAHOO.util.Bacon('demo2');

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
