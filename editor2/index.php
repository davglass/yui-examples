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
<p>New Prototype Approach. You can now have more than one on the screen..</p>
<form id="mainForm">
    <textarea id="editor" style="height: 250px; width: 500px;"><font face="Courier New"><u>This</u></font><font face="Courier New"> is</font> <b>some</b> <i>content</i>... <i><b>Test Again</b></i></textarea>
    <textarea id="editor2" style="height: 250px; width: 500px;"><font face="Courier New"><u>This</u></font><font face="Courier New"> is</font> <b>some</b> <i>content</i>... <i><b>Test Again</b></i></textarea>
</form>
<form id="dumbForm1"></form>
<form id="dumbForm2"></form>
<form id="dumbForm3"></form>
<form id="dumbForm4"></form>
<a href="javascript: myEditor.save();">Save #1</a><br>
<a href="javascript: myEditor2.render();">Render #2</a> - <a href="javascript: myEditor2.save();">Save #2</a>
<div id="debug_holder"></div>
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
<script type="text/javascript" src="editor.js?msiesucks=<?php echo(mktime()); ?>"></script>
<script type="text/javascript">
    var myEditor = new YAHOO.widget.Editor('editor');
    myEditor.render();

    var myEditor2 = new YAHOO.widget.Editor('editor2', { showwait: false });
    myEditor2.onSave.subscribe(save2);
    //myEditor2.render();

    function save2() {
        debug('Save2 Fired..');
    }
</script>
</body>
</html>
