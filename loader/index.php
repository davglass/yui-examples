<?php
    header('Location: http://developer.yahoo.com/yui/yuiloader/');
    exit;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Loader Script</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        @import url( ../css/calendar_assets/calendar.css );
        p, h2, pre {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Loader Script</a></h1></div>
    <div id="bd">
    <h2>YAHOO.Loader</h2>
    <p>This class allows for dynamic loading of Javascript files. It's a little hard to demo this feature, so I will just explain it.</p>
    <p>First, the only JavaScript files that are loaded on this page are: yahoo-min.js, connection-min.js and loader.js. Now in the JS we will do this:</p>
    <p><a href="../docs/?type=loader">Docs available here</a> - <a href="yahoo-loader-min.js">Minimized source here</a></p>
    <!--textarea name="code" class="JScript" style="width: 100%">
var files = Array();
files[0] = '../js/dom-min.js';
files[1] = '../js/event-min.js';
files[2] = '../js/animation-min.js';
files[3] = '../js/tools-min.js';
files[4] = '../js/davglass.js';
files[5] = '../js/dpSyntaxHighlighter.js';

YAHOO.Loader.onFileLoad = handleGood;

YAHOO.Loader.add(files);
YAHOO.Loader.load();

YAHOO.Loader.load('../js/calendar-min.js');
YAHOO.Loader.load('../js/event-min.js');
YAHOO.Loader.load('../js/container-min.js');

function moreload() {
    YAHOO.Loader.load(['../js/treeview-min.js', '../js/menu-min.js', '../effects/effects-min.js']);
    setTimeout('loadCal()', 2000);
}
function loadCal() {
    cal1 = new YAHOO.widget.Calendar("cal1","tester");
    cal1.render();
}

function handleGood(fileName, tId, status, o) {
    switch (fileName) {
        case '../js/davglass.js':
            //YAHOO.davglass.init();
            break;
        case '../js/dpSyntaxHighlighter.js':
            dp.SyntaxHighlighter.HighlightAll('code'); 
            break;
    }
}

setTimeout('moreload()', 5000);
    </textarea-->
    <p>Now if you have Firebug (or another debugger installed), you will see that the files: (dom, animation, event, calendar, tools and container) are now loaded.</p>
    <p>Now wait about 5-7 seconds and check again.. The files (treeview, menu &amp; effects) should now be loaded...Also a calendar will display below this line.</p>
    </div>
    <div id="tester"></div>
    <div id="ft">&nbsp;</div>
</div>

<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/connection-min.js"></script>
<script type="text/javascript" src="yahoo-loader.js"></script>
<script type="text/javascript">

var files = Array();
files[0] = '../js/dom-min.js';
files[1] = '../js/event-min.js';
files[2] = '../js/animation-min.js';
files[3] = '../js/tools-min.js';
files[4] = '../js/dpSyntaxHighlighter.js';

YAHOO.Loader.onFileLoad = handleGood;

YAHOO.Loader.add(files);
YAHOO.Loader.load();

YAHOO.Loader.load('../js/calendar-min.js');
YAHOO.Loader.load('../js/event-min.js');
YAHOO.Loader.load('../js/container-min.js');
YAHOO.Loader.load('../js/davglass.js');


function moreload() {
    YAHOO.Loader.load(['../js/treeview-min.js', '../js/menu-min.js', '../effects/effects-min.js']);
    setTimeout('loadCal()', 2000);
}
function loadCal() {
    cal1 = new YAHOO.widget.Calendar("cal1","tester");
    cal1.render();
}

function handleGood(fileName, tId, status, o) {
    switch (fileName) {
        case '../js/davglass.js':
            //YAHOO.davglass.init();
            break;
        case '../js/dpSyntaxHighlighter.js':
            dp.SyntaxHighlighter.HighlightAll('code'); 
            break;
    }
}

setTimeout('moreload()', 5000);


</script>
</body>
</html>
