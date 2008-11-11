<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop: Image inside a DIV</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            height: 200px;
            width: 200px;
            overflow: hidden;
            position: relative;
            border: 2px solid black;
        }
        #demo img {
            cursor: move;
            position: absolute;
            top: 0;
            left: 0;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop: Image inside a DIV</a></h1></div>
    <div id="bd">
        <div id="demo"><img src="japan.jpg" id="pic"></div>
        <h2>The CSS</h2>
        <textarea name="code" class="CSS">
        #demo {
            height: 200px;
            width: 200px;
            overflow: hidden;
            position: relative;
            border: 2px solid black;
            top: 50px;
            left: 50px;
        }
        #demo img {
            cursor: move;
            position: absolute;
            top: 0;
            left: 0;
        }
        </textarea>
        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
        <div id="demo"><img src="japan.jpg" id="pic"></div>
        </textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
            var dd = new YAHOO.util.DD('pic');
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var dd = new YAHOO.util.DD('pic');

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
