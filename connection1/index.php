<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Connection Example</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">

        p {
            padding: .25em;
        }
        #make_conn {
            margin: 1em;
            border: 1px solid black;
            padding: .25em .25em .25em 18px;
            background-color: #eee;
        }
        .calling {
            background-image: url( progress.gif );
            background-repeat: no-repeat;
            background-position: 3px 3px;
            color: #999;
            font-style: italic;
        }
        .good {
            color: green;
        }
        .bad {
            color: red;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Connection Example</a></h1></div>
    <div id="bd">
        <p>Click the button below to fire an XHR request to a page that will sleep for about 5 seconds.</p>
        <button id="make_conn">Click to make Connection</button>
        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
        <button id="make_conn">Click to make Connection</button>
        </textarea>
        <h2>The CSS</h2>
        <textarea name="code" class="HTML">
        #make_conn {
            margin: 1em;
            border: 1px solid black;
            padding: .25em .25em .25em 18px;
            background-color: #eee;
        }
        .calling {
            background-image: url( progress.gif );
            background-repeat: no-repeat;
            background-position: 3px 3px;
            color: #999;
            font-style: italic;
        }
        .good {
            color: green;
        }
        .bad {
            color: red;
        }
        </textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
var conn = null;
var conn_maker = null;

function init() {
    conn_maker = YAHOO.util.Dom.get('make_conn');
    YAHOO.util.Event.addListener(conn_maker, 'click', makeConnection);
}

callback = {
    success: handleGood,
    failure: handleBad
}

function handleGood(o) {
    YAHOO.util.Dom.replaceClass('make_conn', 'calling', 'good');
    YAHOO.util.Dom.get('make_conn').innerHTML = 'Connection Worked';
}

function handleBad(o) {
    YAHOO.util.Dom.replaceClass('make_conn', 'calling', 'bad');
    YAHOO.util.Dom.get('make_conn').innerHTML = 'Connection Failed';
}

function makeConnection() {
    YAHOO.util.Dom.removeClass('make_conn', 'good');
    YAHOO.util.Dom.removeClass('make_conn', 'bad');
    YAHOO.util.Dom.addClass('make_conn', 'calling');
    YAHOO.util.Dom.get('make_conn').innerHTML = 'Calling Server...';
    var sUrl = "xml.php"; 
    var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);
}

YAHOO.util.Event.addListener(window, 'load', init);
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
    
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
var conn = null;
var conn_maker = null;

function init() {
    dp.SyntaxHighlighter.HighlightAll('code'); 
    conn_maker = YAHOO.util.Dom.get('make_conn');
    YAHOO.util.Event.addListener(conn_maker, 'click', makeConnection);
}

callback = {
    success: handleGood,
    failure: handleBad
}

function handleGood(o) {
    YAHOO.util.Dom.replaceClass('make_conn', 'calling', 'good');
    YAHOO.util.Dom.get('make_conn').innerHTML = 'Connection Worked';
}

function handleBad(o) {
    YAHOO.util.Dom.replaceClass('make_conn', 'calling', 'bad');
    YAHOO.util.Dom.get('make_conn').innerHTML = 'Connection Failed';
}

function makeConnection() {
    YAHOO.util.Dom.removeClass('make_conn', 'good');
    YAHOO.util.Dom.removeClass('make_conn', 'bad');
    YAHOO.util.Dom.addClass('make_conn', 'calling');
    YAHOO.util.Dom.get('make_conn').innerHTML = 'Calling Server...';
    var sUrl = "xml.php"; 
    var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);
}

YAHOO.util.Event.addListener(window, 'load', init);
</script>
</body>
</html>

