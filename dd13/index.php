<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop only fire drop event</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #play {
            position: relative;
            height: 150px;
        }
        #drop, #drag {
            height: 50px;
            width: 50px;
            border: 1px solid black;
            background-color: #F2F2F2;
            position: relative;
        }
        #drop {
            top: 25px;
            left: 25px;
        }
        #drag {
            cursor: pointer;
            top: 50px;
            left: 125px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop only fire drop event</a></h1></div>
    <div id="bd">
        <p>This example shows how to make DragDrop only fire the onDragDrop event. It will not fire the other stamdard events.</p>
        <p>Basically all we are doing is creating a copy of the <code>YAHOO.util.DragDropMgr.fireEvents</code> (<code>YAHOO.util.DragDropMgr._fireEvents</code>) method and creating a new one.</p>
        <p>Now, we put some simple logic in the new <code>fireEvents</code> method to call the copy <code>_fireEvents</code> only if the <code>isDrop</code> parameter is set to true.</p>
        <p><a href="#thecode">Jump to the code</a></p>
        <div id="play">
            <div id="drop">Drop</div>
            <div id="drag">Drag</div>
        </div>
        <h2 id="thecode">The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        dd1 = null, dd2 = null;

    YAHOO.util.DragDropMgr._fireEvents = YAHOO.util.DragDropMgr.fireEvents; 
    YAHOO.util.DragDropMgr.fireEvents = function(e, isDrop) {
        if (isDrop) {
            YAHOO.util.DragDropMgr._fireEvents(e, isDrop);
        }
    };
    
    dd1 = new YAHOO.util.DD('drag');
    dd2 = new YAHOO.util.DDTarget('drop');
    dd1.onDragDrop = function(e, id) {
        YAHOO.log('onDragDrop on element #' + id, 'info', 'example');
    };
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/logger/logger-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        dd1 = null, dd2 = null;

    Event.on(window, 'load', function() {
        var logger = new YAHOO.widget.LogReader(null, { logReaderEnabled: true });
    });

    
    YAHOO.util.DragDropMgr._fireEvents = YAHOO.util.DragDropMgr.fireEvents; 
    YAHOO.util.DragDropMgr.fireEvents = function(e, isDrop) {
        if (isDrop) {
            YAHOO.util.DragDropMgr._fireEvents(e, isDrop);
        }
    };
    

    dd1 = new YAHOO.util.DD('drag');
    dd2 = new YAHOO.util.DDTarget('drop');
    dd1.onDragDrop = function(e, id) {
        YAHOO.log('onDragDrop on element #' + id, 'info', 'example');
    };


    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
