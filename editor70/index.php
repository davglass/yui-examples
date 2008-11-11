<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: BBCode</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #out {
            display: none;
            height: 400px;
            width: 80%;
            margin: 2em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: BBCode</a></h1></div>
    <div id="bd">
    <p>This example shows a simple BBCode formatter for the Editor.</p>
    <p>You can download the <a href="source.js">source here</a>.</p>
    <p><button id="saveOut">Clean HTML</button></p>
    <textarea id="editor">
        <img src="Photo1.jpg" align="right">
        This is a test<br><strong>Strong Tag</strong> <em>Em Tag</em> <span style="font-weight: bold">Style Bold</span>
        <p class="yui-noedit">This is some test text. And a <a href="#">test link</a>.</p>
        This is a test.<br>
        <span style="text-decoration: underline;">This is a test</span>.<br>
        <font face="Courier New"><u>This</u></font><font face="Courier New"> is</font> <b>some</b> <i id="testId">content</i>... <i class="test"><b class="test1 test2">Test Again</b></i><br>Some more plain text goes here..<br>
        <ol>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ol>
        <a href="http://blog.davglass.com/">This is <b>some</b> more test text.</a> This is some more test text. This is some more test text. This is some more test text.<br>
        <ul>
            <li>List Item</li>
        </ul>
        <font face="Times New Roman">This is some more test text. This is some more <b>test <i>text</i></b></font>. This is some more test text. This is some more test text. This is some more test text. This is some more test text. This is some more test text. This is some more test text. This is some more test text.     
    </textarea>
    <textarea id="out">
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/container/container_core-min.js&2.6.0/build/menu/menu-min.js&2.6.0/build/element/element-beta-min.js&2.6.0/build/button/button-min.js&2.6.0/build/animation/animation-min.js&2.6.0/build/dragdrop/dragdrop-min.js&2.6.0/build/editor/editor-min.js"></script> 
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
