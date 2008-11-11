<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop Offsets</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #bd {
            position: relative;
        }
        #demo {
            height: 100px;
            width: 100px;
            border: 1px solid black;
            background-color: #ccc;
            cursor: move;
        }

        #drop {
            height: 300px;
            width: 300px;
            position: absolute;
            top: 50px;
            right: 50px;
            border: 1px solid black;
            background-color: #ccc;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop Offsets</a></h1></div>
    <div id="bd">
        <div id="drop">Drop Here</div>
        <div id="demo">Drag Me</div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var dd = new YAHOO.util.DD('demo');
    dd.on('dragOverEvent', function() {
        console.log(arguments, this);
    });
    var ddT = new YAHOO.util.DDTarget('drop');

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
