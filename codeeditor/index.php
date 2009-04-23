<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Code Editor w/Syntax Highlighting</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style>
        #form1 {
            margin: 2em;
        }
        .yui-toolbar-subcont {
            display: none;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-titlebar span.collapse {
            display: none;
        }
    </style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Code Editor w/Syntax Highlighting</a></h1></div>
    <div id="bd">
        <p>This is a very early prototype of changing the Editor to work as a Syntax Highlighting Code Editor.</p>
        <p><a href="code-editor.js">Javascript Souce Code here.</a></p>
        <p><a href="line-numbers.png">Line Numbers Image here.</a></p>
        <p><a href="blank.htm">Blank HTML file here.</a></p>
        <form method="post" action="index.php" id="form1">
        <textarea id="editor" name="editor" rows="20" cols="75"></textarea>
        </form>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/editor/editor-min.js"></script> 
<script src="code-editor.js?bust=<?php echo(mktime()); ?>"></script>
</body>
</html>
