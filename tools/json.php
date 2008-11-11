<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: YAHOO.Tools.JSONEncode/JSONParse</title>
    <link rel="stylesheet" href="http://us.js2.yimg.com/us.js.yimg.com/lib/common/css/reset-fonts-grids_2.1.2.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/logger.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: YAHOO.Tools.JSONEncode/JSONParse</a></h1></div>
    <div id="bd">
    <p>JSON encode/parse. <a href="../docs/?type=tools">Docs available here</a> - <a href="tools-min.js">Minimized source here</a></p>
    <h2>JSON encode/parse with the YAHOO LogReader</h2>
    <p>Here is a basic example of using the JSONEncode and JSONParse functions with the YAHOO LogReader.</p>
    <textarea name="code" class="JScript">
var myLogReader = null;
var myObj = null;
var myStr = null;
var testObj = null;

function init() {
    myLogReader = new YAHOO.widget.LogReader();
    myLogReader.show();

    myObj = {
        test: 'one',
        again: ['one', 'two', 'three'],
        myDate: new Date()
    }
    YAHOO.log(YAHOO.Tools.JSONEncode(myObj));
    myStr = YAHOO.Tools.JSONEncode(myObj);
    YAHOO.log(myStr);
    testObj = YAHOO.Tools.JSONParse(myStr, true);
    YAHOO.log(YAHOO.Tools.JSONEncode(testObj));
}

$E.addListener(window, 'load', init);
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/utilities_2.1.2.js"></script>
<script type="text/javascript" src="../js/logger-min.js"></script>
<script type="text/javascript" src="../tools/tools.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script src="../js/dpSyntaxHighlighter.js"></script>
<script type="text/javascript">
var myLogReader = null;
var myObj = null;
var myStr = null;
var testObj = null;

function init() {
    myLogReader = new YAHOO.widget.LogReader();
    myLogReader.show();

    myObj = {
        test: 'one',
        again: ['one', 'two', 'three'],
        myDate: new Date()
    }
    YAHOO.log(YAHOO.Tools.JSONEncode(myObj));
    myStr = YAHOO.Tools.JSONEncode(myObj);
    YAHOO.log(myStr);
    testObj = YAHOO.Tools.JSONParse(myStr, true);
    YAHOO.log(YAHOO.Tools.JSONEncode(testObj));
    dp.SyntaxHighlighter.HighlightAll('code'); 
}

$E.addListener(window, 'load', init);

</script>
</body>
</html>

