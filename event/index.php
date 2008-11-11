<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Events</title>
    <link rel="stylesheet" href="http://us.js2.yimg.com/us.js.yimg.com/lib/common/css/reset-fonts-grids_2.1.2.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            margin: 1em;
            border: 1px solid black;
            background-color: #ccc;
            width: 10em;
        }
        #demo ul {
            list-style-type: disc;
            margin: 1em;
        }
        #demo ul li {
            margin-left: 20px;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Events</a></h1></div>
    <div id="bd">
        <div id="demo">
            <ul>
                <li><a href="test1.htm">Test 1</a></li>
                <li><a href="test2.htm">Test 2</a></li>
                <li><a href="test3.htm">Test 3</a></li>
                <li><a href="test4.htm">Test 4</a></li>
                <li><a href="test5.htm">Test 5</a></li>
                <li><a href="test6.htm">Test 6</a></li>
                <li><a href="test7.htm">Test 7</a></li>
                <li><a href="test8.htm">Test 8</a></li>
            </ul>
        </div>
        <textarea name="code" class="JScript">
function init() {
    YAHOO.util.Event.addListener('demo', 'click', handleClick);
    dp.SyntaxHighlighter.HighlightAll('code');
}

function handleClick(ev) {
    var tar = YAHOO.util.Event.getTarget(ev);
    if (tar.tagName.toLowerCase() == 'a') {
        var str = 'You clicked on ' + tar.innerHTML + ' with an href of ' + tar.href;
        alert(str);
    }
    YAHOO.util.Event.stopEvent(ev);
}

YAHOO.util.Event.addListener(window, 'load', init);
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/utilities_2.1.2.js"></script>
<script type="text/javascript" src="../js/tools-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">


function init() {
    YAHOO.util.Event.addListener('demo', 'click', handleClick);
    dp.SyntaxHighlighter.HighlightAll('code');
}

function handleClick(ev) {
    var tar = YAHOO.util.Event.getTarget(ev);
    if (tar.tagName.toLowerCase() == 'a') {
        var str = 'You clicked on ' + tar.innerHTML + ' with an href of ' + tar.href;
        alert(str);
    }
    YAHOO.util.Event.stopEvent(ev);
}

YAHOO.util.Event.addListener(window, 'load', init);

</script>
</body>
</html>
