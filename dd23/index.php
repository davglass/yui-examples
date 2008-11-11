<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop & Resize a Panel</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #a {
            position:absolute;
            left: 150px;
            top: 150px;
            border: 1px solid;
            width: 150px;
            height: 150px;
            background-color:yellow;
        }
       
        #b {
            height: 30px;
            border: 1px solid;
            background-color:green;
            cursor: move;
        }
       
        #c {
            position: absolute;
            bottom: -1px;
            right: -1px;
            height: 10px;
            width: 10px;
            border: 1px solid;
            background-color:red;
            cursor: se-resize;
        }
        #thecode {
            position: relative;
            top: 205px;
        }
    </style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop & Resize a Panel</a></h1></div>
    <div id="bd">
        <p>In response to this <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/22952">YDN-Javascript thread</a></p>
        <div id="a">
            <div id="b"></div>
            <div id="c"></div>
        </div>
        <div id="thecode">
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
YAHOO.example.DDResize = function(panelElId, handleElId, sGroup, config) {
    this.panel = YAHOO.util.Dom.get(panelElId);
    YAHOO.example.DDResize.superclass.constructor.call(this, handleElId, sGroup, config);
};

YAHOO.extend(YAHOO.example.DDResize, YAHOO.util.DragDrop, {

    onMouseDown: function(e) {
        var panel = this.panel;
        this.startWidth = panel.offsetWidth;
        this.startHeight = panel.offsetHeight;

        this.startPos = [YAHOO.util.Event.getPageX(e),
                         YAHOO.util.Event.getPageY(e)];
    },

    onDrag: function(e) {
        var newPos = [YAHOO.util.Event.getPageX(e),
                      YAHOO.util.Event.getPageY(e)];

        var offsetX = newPos[0] - this.startPos[0];
        var offsetY = newPos[1] - this.startPos[1];

        var newWidth = Math.max(this.startWidth + offsetX, 10);
        var newHeight = Math.max(this.startHeight + offsetY, 10);

        var panel = this.panel;
        panel.style.width = newWidth + "px";
        panel.style.height = newHeight + "px";
    }
});

YAHOO.util.Event.onDOMReady(function() {                               
    var dd1 = new YAHOO.util.DD('a', 'move');
    dd1.setHandleElId('b');
   
    var dd2 = new YAHOO.example.DDResize('a', 'c', 'resize');
});
        </textarea>
        </div>
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

            YAHOO.example.DDResize = function(panelElId, handleElId, sGroup, config) {
                this.panel = YAHOO.util.Dom.get(panelElId);
                YAHOO.example.DDResize.superclass.constructor.call(this, handleElId, sGroup, config);
            };
           
            YAHOO.extend(YAHOO.example.DDResize, YAHOO.util.DragDrop, {
           
                onMouseDown: function(e) {
                    var panel = this.panel;
                    this.startWidth = panel.offsetWidth;
                    this.startHeight = panel.offsetHeight;
           
                    this.startPos = [YAHOO.util.Event.getPageX(e),
                                     YAHOO.util.Event.getPageY(e)];
                },
           
                onDrag: function(e) {
                    var newPos = [YAHOO.util.Event.getPageX(e),
                                  YAHOO.util.Event.getPageY(e)];
           
                    var offsetX = newPos[0] - this.startPos[0];
                    var offsetY = newPos[1] - this.startPos[1];
           
                    var newWidth = Math.max(this.startWidth + offsetX, 10);
                    var newHeight = Math.max(this.startHeight + offsetY, 10);
           
                    var panel = this.panel;
                    panel.style.width = newWidth + "px";
                    panel.style.height = newHeight + "px";
                }
            });
           
            YAHOO.util.Event.onDOMReady(function() {                               
                var dd1 = new YAHOO.util.DD('a', 'move');
                dd1.setHandleElId('b');
               
                var dd2 = new YAHOO.example.DDResize('a', 'c', 'resize');
            });


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
