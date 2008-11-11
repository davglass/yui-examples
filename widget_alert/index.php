<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Dialog Alert</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">       
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style>
        p, h2 {
            margin: 1em;
        }
    </style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Dialog Alert Widget</a></h1></div>
    <div id="bd">
    <h2>Drop in Code</h2>
    <p>This widget is designed to be a dropin replacement for alert()</p>
    <p>Just include the widget.alert.js file and all of your JS alerts are now Dialog's</p>
    <p><a href="widget.alert.js">Source code</a></p>
    <h2>Example</h2>
    <p><button onclick="alert('Test alert() #1')">Show me an Alert</button><br/><br/>
    <a href="javascript: alert('Test alert() #2');">Test Again</a><br/><br/>
    <a href="javascript: alert_old('Test alert_old()');">Test Old Alert</a>
    </p>
    <h2>The HTML</h2>
    <textarea name="code" class="HTML">
    <p><button onclick="alert('Test alert() #1')">Show me an Alert</button><br/><br/>
    <a href="javascript: alert('Test alert() #2');">Test Again</a><br/><br/>
    <a href="javascript: alert_old('Test alert_old()');">Test Old Alert</a>
    </textarea>
    <h2>The Javascript</h2>
<textarea name="code" class="JScript">
<?php
include('widget.alert.js');
?>
</textarea>
</div>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/button/button-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
<script type="text/javascript" src="widget.alert.js"></script>
</body>
</html>
