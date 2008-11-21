<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: TextArea Counter</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #counter {
            border: 1px solid #808080;
            width: 500px;
        }
        #editor {
            height: 300px;
            width: 500px;
            border: none;
            font-family: monospace;
            font-size: 13px;
            line-height: 16px;
            white-space: pre;
            margin: 0;
            padding: 0;
        }
        #bar {
            border-top: 1px solid #808080;
            height: 20px;
        }
        #bar span {
            float: right;
            margin: 2px;
            border: 1px solid #808080;
            display: block;
            height: 15px;
            padding: 0 2px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: TextArea Counter</a></h1></div>
    <div id="bd">
    <p>This example shows how to calculate line numbers for a textarea.</p>
    <div id="counter">
        <textarea id="editor" spellcheck="false"></textarea>
        <div id="bar"><span id="words">Words: 0</span><span id="chars">Chars: 0</span><span id="rows">Rows: 1</span><span id="cols">Cols: 0</span></div>
    </div>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
    <?php include('source.js'); ?>
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/selector/selector-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="source.js"></script>
<script type="text/javascript">

(function() {
    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
