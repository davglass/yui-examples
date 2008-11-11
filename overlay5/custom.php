<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Container using my Effects class</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( ../css/container_assets/container.css );
        @import url( style.css );

        #dlg {
            border: 1px solid black;
        }
        .overlay {
            position: relative;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Container using my Effects class</a></h1></div>

    <div id="bd">
<button onclick="handleShow()">Show Panel</button>
<button onclick="handleHide()">Hide Panel</button>

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
<script type="text/javascript" src="../js/logger-min.js"></script>
<script type="text/javascript" src="./container-debug.js"></script>
<script type="text/javascript" src="effects.js"></script>
<script type="text/javascript">
YAHOO.namespace('example.container');
var shown = false;

function handleShow() {
    YAHOO.example.container.dlg.show();
}

function handleHide() {
    YAHOO.example.container.dlg.hide();
}

function showEffect(obj) {
    console.log('showEffect fired...' + this.element.id);
    var eff = new YAHOO.widget.Effects.BlindRight(this.element);
}

function hideEffect(obj) {
    console.log('hideEffect fired...' + this.element.id);
    var eff = new YAHOO.widget.Effects.BlindLeft(this.element);
}

function init() {
    YAHOO.example.container.dlg = new YAHOO.widget.Overlay('dlg', { visible: false, underlay: 'shadow', close: true });
    YAHOO.example.container.dlg.render(YAHOO.util.Dom.get('bd'));
    YAHOO.example.container.dlg.hide();
    YAHOO.example.container.dlg.showEvent.subscribe(showEffect, YAHOO.example.container.dlg, true);
    YAHOO.example.container.dlg.hideEvent.subscribe(hideEffect, YAHOO.example.container.dlg, true);
}

YAHOO.util.Event.addListener(window, "load", init);


</script>
</body>
</html>
