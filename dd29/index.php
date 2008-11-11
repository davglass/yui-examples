<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop - Copy not move</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #play {
            height: 300px;
        }
        #demo {
            cursor: move;
        }
        .demo {
            height: 100px;
            width: 100px;
            border: 1px solid black;
            background-color: #ccc;
        }
        #target {
            height: 200px;
            width: 400px;
            border: 1px solid black;
            background-color: #ccc;
            float: right;
        }
        #target.over {
            background-color: green;
            color: white;
        }
        #target .demo {
            float: left;
            height: 25px;
            width: 50px;
            margin: .25em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop - Copy not move</a></h1></div>
    <div id="bd">
    <div id="play">
        <div id="demo" class="demo">Drag Me</div>
        <div id="target">Drop Here</div>
    </div>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var dd = new YAHOO.util.DD('demo');
    dd.onDragDrop = function() {
        Dom.setStyle('demo', 'top', '');
        Dom.setStyle('demo', 'left', '');
        Dom.removeClass('target', 'over');
        var el = Dom.get('demo').cloneNode(true);
        el.id = Dom.generateId();
        el.innerHTML = 'Dropped';
        Dom.get('target').appendChild(el);
    };
    dd.onInvalidDrop = function() {
        Dom.setStyle('demo', 'top', '');
        Dom.setStyle('demo', 'left', '');
        Dom.removeClass('target', 'over');
    };
    dd.onDragOver = function() {
        Dom.addClass('target', 'over');
    };
    dd.onDragOut = function() {
        Dom.removeClass('target', 'over');
    };
    var tar = new YAHOO.util.DDTarget('target');
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var dd = new YAHOO.util.DD('demo');
    dd.onDragDrop = function() {
        Dom.setStyle('demo', 'top', '');
        Dom.setStyle('demo', 'left', '');
        Dom.removeClass('target', 'over');
        var el = Dom.get('demo').cloneNode(true);
        el.id = Dom.generateId();
        el.innerHTML = 'Dropped';
        Dom.get('target').appendChild(el);
    };
    dd.onInvalidDrop = function() {
        Dom.setStyle('demo', 'top', '');
        Dom.setStyle('demo', 'left', '');
        Dom.removeClass('target', 'over');
    };
    dd.onDragOver = function() {
        Dom.addClass('target', 'over');
    };
    dd.onDragOut = function() {
        Dom.removeClass('target', 'over');
    };
    var tar = new YAHOO.util.DDTarget('target');

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
