<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Dynamic Drap Drop</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #theList ul {
            list-style-type: disc;
            padding-left: 30px;
        }
        #play {
            border: 1px solid black;
            width: 98%;
            height: 400px;
            position: relative;
        }
        div.draggable {
            border: 1px solid black;
            color: white;
            height: 45px;
            width: 75px;
            margin: 5px;
            float: left;
            background-color: green;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Dynamic Drag Drop</a></h1></div>
    <div id="bd">
    <div id="status"></div>
    <div class="yui-gf">
        <div class="yui-u first">
            <div id="theList">
                <ul>
                    <li>Item #1</li>
                    <li>Item #2</li>
                    <li>Item #3</li>
                    <li>Item #4</li>
                    <li>Item #5</li>
                    <li>Item #6</li>
                    <li>Item #7</li>
                </ul>
            </div>
	    </div>
        <div class="yui-u">
            <div id="play">
                <div class="draggable">Draggable</div>
                <div class="draggable">Draggable</div>
                <div class="draggable">Draggable</div>
                <div class="draggable">Draggable</div>
                <div class="draggable">Draggable</div>
                <div class="draggable">Draggable</div>
                <div class="draggable">Draggable</div>
                <div class="draggable">Draggable</div>
                <div class="draggable">Draggable</div>
            </div>
	    </div>
    </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    dp.SyntaxHighlighter.HighlightAll('code');
    var ddTarget = null;
    var overItem = null;

    YAHOO.util.Event.onDOMReady(function() {
        var thisStatus = YAHOO.util.Dom.get('status');

        YAHOO.util.Event.on('theList', 'mouseover', function(ev) {
            var tar = YAHOO.util.Event.getTarget(ev);
            if (tar.tagName.toLowerCase() == 'li') {
                overItem = tar;
            } else {
                overItem = null;
            }
            console.log(overItem);
        });

        ddTarget = new YAHOO.util.DDTarget('theList');
        YAHOO.util.Event.on(document, 'mousedown', function(ev) {
            var tar = YAHOO.util.Event.getTarget(ev);
            if (YAHOO.util.Dom.hasClass(tar, 'draggable')) {
                var dd = new YAHOO.util.DDProxy(tar);
                dd.handleMouseDown(ev);

                dd.onDragDrop = function() {
                    thisStatus.innerHTML = 'You dropped this  on this li (' + overItem.innerHTML + ')';
                }

            }
        });
    });
})()

</script>
</body>
</html>
