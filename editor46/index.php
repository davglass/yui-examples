<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: SourceForge Bug #1898886</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #editor {
            visibility: hidden;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: SourceForge Bug #1898886</a></h1></div>
    <div id="bd">
        <p>This patch fixes <a href="http://sourceforge.net/tracker/index.php?func=detail&aid=1898886&group_id=165715&atid=836476">SourceForge Bug #1898886</a></p>
        <form method="post" action="index.php" id="form1">
        <textarea id="editor" name="editor" rows="20" cols="75">
        <?php
            if ($_POST['editor']) {
                echo(stripslashes($_POST['editor']));
            } else {
        ?>
            Test This.<br>
            Test This.<br>
            Test This.<br>
            Test This.<br>
            Test This.<br>
            Test This.<br>
            Test This.<br>
        <?php
        }
        ?>       
        </textarea>
        <br><input type="submit" id="submit" name="submit" value="Submit Form"/>
        <br><input type="submit" id="submit2" name="submit2" value="Submit Form (2)"/>
        </form>
        <h2>The Patch File</h2>
        <a href="patch-min.js">Get the minimized version</a>
        <textarea name="code" class="JScript">
        <?php include('patch.js'); ?>
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/selector/selector-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/editor/editor-beta-min.js"></script> 
<script type="text/javascript" src="patch-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    YAHOO.util.Event.on('form1', 'submit', function() {
        var b = YAHOO.util.Selector.query('#form1 input');
        b[0].disabled = true;
        b[1].disabled = true;
    });

    var myConfig = {
        height: '300px',
        width: '530px',
        animate: true,
        dompath: true,
        handleSubmit: true,
        focusAtStart: true
    };

    var myEditor = new YAHOO.widget.SimpleEditor('editor', myConfig);
    myEditor.render();


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
