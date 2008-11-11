<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Container showing/hiding with Motion</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( ../css/container_assets/container.css );
        @import url( style.css );
        #bd { position: relative; }
        #dlg {
            position: absolute;
            border: 1px solid black;
        }
        .panel-container {
            position: absolute;
        }
        p {
            margin: 1em;
        }
#target {
   background:red;
   font-size:0;
   position:absolute;
   left:300px;top:300px;
   width:10px;
   height:10px;
}

	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Container showing/hiding with Motion</a></h1></div>
    <div id="bd">
<div id="target"></div>
<button onclick="handleShow()">Show Panel/Dialog</button>
<button onclick="handleHide()">Hide Panel/Dialog</button>

<div id="dlg">
    <div class="hd">Title of Panel</div>
    <div class="bd">
        <p>Test text. Look at me.</p>
        <p>Test text. Look at me.</p>
        <p>Test text. Look at me.</p>
    </div>
</div>

</div>
<div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript" src="../effects/effects-min.js"></script>
<script type="text/javascript" src="../tools/tools-min.js"></script>
<script type="text/javascript">
YAHOO.namespace('example.container');
var attributes = {
      points: {
        from: [-350, -350],
         to: YAHOO.util.Dom.getXY('target'),
         control: [ [400, 800], [-100, 200] ]
      },
      opacity: { from: 0, to: 1 }
   };
var attributes2 = {
      points: {
         to: [-350, -350],
         control: [ [-100, 200], [400, 800] ]
      },
      opacity: { from: 1, to: 0 }
   };

function handleShow() {
   YAHOO.util.Dom.setStyle('dlg', 'visibility', 'visible');
   anim.animate();
    //YAHOO.example.container.dlg.show();
}

function handleHide() {
   anim2.animate();
    //YAHOO.example.container.dlg.hide();
}

function init() {
    YAHOO.example.container.dlg = new YAHOO.widget.Panel('dlg', {
        close: true,
        visible: false,
        height: '150px',
        width: '350px',
        underlay: 'none'
    }
    );
    YAHOO.example.container.dlg.render(YAHOO.util.Dom.get('bd'));

    anim = new YAHOO.util.Motion('dlg', attributes, 1, YAHOO.util.Easing.easeOut);
    anim2 = new YAHOO.util.Motion('dlg', attributes2, 1, YAHOO.util.Easing.easeOut);
}

YAHOO.util.Event.addListener(window, "load", init);



</script>
</body>
</html>
