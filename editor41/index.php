<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Embed Plugin</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-insertmedia span.yui-toolbar-icon {
            background-image: url( media.gif );
            background-position: 1px 0px;
            top: 1px;
            left: 4px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-insertmedia-selected span.yui-toolbar-icon {
            background-image: url( media.gif );
            background-position: 1px 0px;
            top: 1px;
            left: 4px;
        }
        #embedplugin {
            height: 70px;
            width: 300px;
        }
        #media_control {
            display: none;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Embed Plugin</a></h1></div>
    <div id="bd">
        <textarea id="editor">
        This is a test.
        </textarea>
        <h2>The Javascript</h2>
        <p><a href="embed.js">Link to the full source file.</a></p>
        <textarea name="code" class="JScript">
        <?php
        $str = file_get_contents('./embed.js');
        echo(htmlentities($str));
        ?>
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/editor/editor-debug.js"></script> 
<script type="text/javascript" src="embed.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
