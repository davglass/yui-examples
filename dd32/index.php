<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop ALWAYS on top</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
.dd-demo {
    position:relative;
    border:4px solid #666;
    text-align:center;
    color:#fff;
    cursor:move;
    height:60px;
    width:60px;
}

.dd-demo-em {
    border:4px solid purple;
}

#dd-demo-1 { 
    background-color:#6D739A;top:0px; left:105px;
}

#dd-demo-2 { 
    background-color:#566F4E;top:50px; left:245px;
}

#dd-demo-3 {
    background-color:#7E5B60;top:-150px; left:385px;
}

#play {
    margin: 3em;
}
        
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop ALWAYS on top</a></h1></div>
    <div id="bd">
        <div id="play">
            <div id="dd-demo-1" class="dd-demo">1</div>
            <div id="dd-demo-2" class="dd-demo">2</div>
            <div id="dd-demo-3" class="dd-demo">3</div>
        </div>
        <h2 id="thecode">The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    // Our custom drag and drop implementation, extending YAHOO.util.DD
    YAHOO.example.DDOnTop = function(id, sGroup, config) {
        YAHOO.example.DDOnTop.superclass.constructor.apply(this, arguments);
    };

    //Cache the zIndex
    YAHOO.util.DDM._curZindex = 999;

    YAHOO.extend(YAHOO.example.DDOnTop, YAHOO.util.DD, {
        startDrag: function(x, y) {
            YAHOO.log(this.id + " startDrag", "info", "example");

            var style = this.getEl().style;

            // The z-index needs to be set very high so the element will indeed be on top
            style.zIndex = YAHOO.util.DDM._curZindex;
            //Up the zIndex so the next call makes it higher
            YAHOO.util.DDM._curZindex++;
        }
    });



    var dd, dd2, dd3;
        Event.onDOMReady(function() {
            dd = new YAHOO.example.DDOnTop("dd-demo-1");
            dd2 = new YAHOO.example.DDOnTop("dd-demo-2");
            dd3 = new YAHOO.example.DDOnTop("dd-demo-3");
        });

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    // Our custom drag and drop implementation, extending YAHOO.util.DD
    YAHOO.example.DDOnTop = function(id, sGroup, config) {
        YAHOO.example.DDOnTop.superclass.constructor.apply(this, arguments);
    };

    //Cache the zIndex
    YAHOO.util.DDM._curZindex = 999;

    YAHOO.extend(YAHOO.example.DDOnTop, YAHOO.util.DD, {
        startDrag: function(x, y) {
            YAHOO.log(this.id + " startDrag", "info", "example");

            var style = this.getEl().style;

            // The z-index needs to be set very high so the element will indeed be on top
            style.zIndex = YAHOO.util.DDM._curZindex;
            //Up the zIndex so the next call makes it higher
            YAHOO.util.DDM._curZindex++;
        }
    });



    var dd, dd2, dd3;
        Event.onDOMReady(function() {
            dd = new YAHOO.example.DDOnTop("dd-demo-1");
            dd2 = new YAHOO.example.DDOnTop("dd-demo-2");
            dd3 = new YAHOO.example.DDOnTop("dd-demo-3");
        });


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
