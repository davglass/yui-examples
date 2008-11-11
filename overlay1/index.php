<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Load an external page in an Overlay </title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( ../css/container_assets/container.css );
        @import url( style.css );
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Load external webpage in an Overlay</a></h1></div>

    <div id="bd">
<button onclick="handle()">A webpage in an Onverlay</button>

<div id="dlg">
    <div class="hd">Look at the webpage below</div>
    <div class="bd">
        <form name="dlgForm" method="POST" action="">
        <iframe id="dlgFrame" src="about:blank"></iframe>
        </form>
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
<script type="text/javascript">
YAHOO.namespace('example.container');
var shown = false;

function handle() {
    if (!shown) {
        strReturn = prompt('What page do you want to load?', 'http://developer.yahoo.com/yui/');
        if (strReturn != '') {
            YAHOO.util.Dom.get('dlgFrame').src = strReturn;
            YAHOO.example.container.dlg.show();
            shown = true;
        }
    } else {
        YAHOO.example.container.dlg.hide();
        YAHOO.util.Dom.get('dlgFrame').src = 'about:blank';
        shown = false;
    }
}

	function init() {
        YAHOO.example.container.dlg = new YAHOO.widget.Overlay("dlg");
        YAHOO.example.container.dlg.cfg.setProperty("visible", false);
        YAHOO.example.container.dlg.cfg.setProperty("fixedcenter", true);
	}

	YAHOO.util.Event.addListener(window, "load", init);

</script>
</body>
</html>
