<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Test Editor</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #bd { position: relative; }
        #editor {
            font-family: verdana; font-size: 100%;
            height: 350px;
            width: 350px;
            border: 1px solid red;
            opacity: 0;
            z-index: 10;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        #editorOver {
            height: 350px;
            width: 350px;
            border: 1px solid blue;
            z-index: 5;
            position: absolute;
            top: 11px;
            left: 8px;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: YAHOO.Tools</a></h1></div>
    <div id="bd">
        <p><textarea id="editor"></textarea></p>
        <div id="editorOver"></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript" src="../js/logger-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript" src="../tools/tools.js"></script>
<script type="text/javascript">
var e = null;
var o = null;
var over = null;

function init() {
    e = $('editor');
    o = $('editorOver');
    o.innerHTML = e.value;
    $E.addListener('editor', 'click', function() { console.log('Editor Clicked..'); });
    $E.addListener('editor', 'keyup', handleKeys);
}

function handleKeys() {
    o.innerHTML = e.value;
}

$E.addListener(window, 'load', init);

</script>
</body>
</html>
