<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: One editor, multiple edit areas - TEXTAREAS</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-editor-container {
            position: absolute;
            top: -9999px;
            left: -9999px;
            z-index: 999;
        }
        #editor {
            visibility: hidden;
            position: absolute;
        }
        .editable {
            border: 1px solid black;
            margin: .25em;
            float: left;
            width: 350px;
            height: 100px;
            overflow: auto;
        }
        #editable_cont {
            height: 20em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: One editor, multiple edit areas - TEXTAREAS</a></h1></div>
    <div id="bd">
        <textarea id="editor"></textarea>
        <p>Double click any of the areas below to edit it's content. Then click the collapse button in the toolbar to remove the editor.</p>
        <p>This is a modified version of the <a href="http://developer.yahoo.com/yui/examples/editor/multi_editor.html">One editor, multiple edit areas</a> example. It uses textareas instead of DIV's.</p>
        <div id="editable_cont">
            <textarea class="editable">#1. Double click me to edit the contents</textarea>
            <textarea class="editable">#2. Double click me to edit the contents</textarea>
            <textarea class="editable">#3. Double click me to edit the contents</textarea>
            <textarea class="editable">#4. Double click me to edit the contents</textarea>
            <textarea class="editable">#5. Double click me to edit the contents</textarea>
            <textarea class="editable">#6. Double click me to edit the contents</textarea>
        </div>
        <h2>The Javascript</h2>
        <textarea class="JScript" name="code"><?php include('source.js'); ?></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/yahoo-dom-event/yahoo-dom-event.js&2.7.0/build/container/container_core-min.js&2.7.0/build/menu/menu-min.js&2.7.0/build/element/element-min.js&2.7.0/build/button/button-min.js&2.7.0/build/editor/editor-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="source.js"></script>
<script type="text/javascript">

dp.SyntaxHighlighter.HighlightAll('code');

</script>
</body>
</html>
