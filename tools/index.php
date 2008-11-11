<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: YAHOO.Tools</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: YAHOO.Tools</a></h1></div>
    <div id="bd">
    <p>General tools. <a href="../docs/?type=tools">Docs available here</a> - <a href="tools-min.js">Minimized source here</a></p>
    <h2>JSON Parsing</h2>
    <p>The YAHOO.Tools package now includes a version of <a href="http://www.json.org/js.html">Douglas Crockford's</a> JSON.js file that doesn't mess with the object prototypes.</p>
    <p>You can see an example of the <a href="json.php">JSON parser here</a>.</p>
    <h2>Browser Engine Object</h2>
    <p>YAHOO.Tools.getBrowserEngine();</p>
    <p>This function attempts to identify the core browsers through object detection. However, a developer may trash this detection by adding "functionality" to a page.</p>
    <p>Go ahead, change your User Agent string. This should still work 8-)</p>
    <p id="browser_engine"></p>
    <h2>Browser Agent Object</h2>
    <p>YAHOO.Tools.getBrowser();</p>
    <p>This function uses the User Agent string to determine it's information. It will be fooled by a User Agent switcher</p>
    <p id="browser_agent"></p>
    <h2>Current Functions in YAHOO.Tools</h2>
    <p id="tools_info"></p>
</div>
<div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="tools.js"></script>
<script type="text/javascript" src="../js/effects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">


function init() {
    var br = $T.getBrowserAgent();
    var str = '';
    for (var i in br) {
        if (br[i] && (i != 'ua')) {
            str += '<b>' + i + ': ' + br[i] + '</b><br>';
        } else {
            str += i + ': ' + br[i] + '<br>';
        }
    }
    $('browser_agent').innerHTML = str;

    var bro = $T.getBrowserEngine();
    var str = '';
    for (var i in bro) {
        if (bro[i] && (i != 'ua')) {
            str += '<b>' + i + ': ' + bro[i] + '</b><br>';
        } else {
            str += i + ': ' + bro[i] + '<br>';
        }
    }
    $('browser_engine').innerHTML = str;

    str = '';
    for (var i in YAHOO.Tools) {
        if ((i != 'prototype') && (i.toLowerCase() != 'version') && (i.toLowerCase() != 'build')) {
            str += i + '<br>';
        }
    }
    $('tools_info').innerHTML = str;
}

$E.addListener(window, 'load', init);

</script>
</body>
</html>
