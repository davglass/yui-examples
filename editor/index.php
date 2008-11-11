<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Simple WYSIWYG Editor</title>
        <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
        <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
        <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
        <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
        <link href="../css/container_assets/container.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Sample WYSIWYG Editor built with the YUI libraries.</a></h1></div>

    <div id="bd">
    <p><strong>This has been rolled into the latest release (2.3.0) of the YUI Library</strong></p>
    <p>You can see it here: <a href="http://developer.yahoo.com/yui/editor/">http://developer.yahoo.com/yui/editor/</a></p>
<p>This is a prototype Rich Text Editor built with the YUI libraries.</p>
<p>Most of the features work in IE, Firefox, Opera &amp; even Safari (Currently firefox works best).</p>
<p>Known issues with IE: Can't change the <strike>font family and font color</strike>, <strike>the toolbar flickers when you change something</strike>.</p>
<form>
    <textarea id="editor" style="height: 250px; width: 500px;"><font face="Courier New"><u>This</u></font><font face="Courier New"> is</font> <b>some</b> <i>content</i>... <i><b>Test Again</b></i></textarea>
    <!--textarea id="editor" style="height: 250px; width: 500px;">This is some content...Test Again</textarea-->
</form>
<a href="javascript: YAHOO.widget.Editor.save();">Save</a>
<!--div id="debug_holder"></div-->
</div>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript" src="../js/connection-min.js"></script>
<!--script type="text/javascript" src="../js/create.js"></script-->
<script type="text/javascript" src="../tools/tools.js"></script>
<script type="text/javascript" src="editor.js?this=<?= mktime(); ?>"></script>
<script type="text/javascript">
    YAHOO.widget.Editor.init('editor');
</script>
</body>
</html>
