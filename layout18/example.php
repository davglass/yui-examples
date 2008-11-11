<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Layout Issue</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
</head>
<body class="yui-skin-sam" style="overflow:auto">

<div style="position:absolute;width:100%;" width="100%">
    <div id="topRowDiv" />
    <div id="selectorDiv" />
    <div id="navbarDiv" />
    <div id="loggerDiv" />
    <div id="detailsDiv" />
    <div id="centerDiv" />
</div>

<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.5.2/build/yahoo-dom-event/yahoo-dom-event.js&2.5.2/build/element/element-beta-min.js&2.5.2/build/animation/animation-min.js&2.5.2/build/dragdrop/dragdrop-min.js&2.5.2/build/resize/resize-beta-min.js&2.5.2/build/selector/selector-beta-min.js&2.5.2/build/layout/layout-beta-min.js"></script>
<script type="text/javascript">
var layoutOutter;
var layoutInner;

function layoutInnerRendered() {
}

function layoutOutterRendered() {

    var el = layoutOutter.getUnitByPosition('center').get('wrap');

    layoutInner = new YAHOO.widget.Layout(el, {
        parent: layoutOutter,
        width: layoutOutter.getSizes().center.w,
        height: layoutOutter.getSizes().center.h,
        units: [
            { position: 'center', body: 'selectorDiv', gutter: '2px', resize: true },
            { position: 'bottom', resize: true, height: 600, body: 'detailsDiv', gutter: '2px', collapse: true, collapseSize: 50, scroll: false }
        ]
    });

    layoutInner.on("render",layoutInnerRendered );
    layoutInner.render();
}

function initLayoutOutter() {
    // Whole page layout
    layoutOutter = new YAHOO.widget.Layout({
        units: [
            { position: 'top', resize: false, body: 'topRowDiv', height:50 },
            { position: 'right', header: 'Debugging Logger', width: 300, resize: true, gutter: '2px 5px', collapse: true, scroll: true, body: 'loggerDiv', maxWidth: 1000 },
            { position: 'left', id: "layoutNavBar", header: 'Catalog', width: 200, resize: true, body: 'navbarDiv', gutter: '2px 5px', collapse: true, collapseSize: 50, scroll: true, maxWidth: 300 },
            { position: 'center', body: 'centerDiv' }
        ]
    });

    layoutOutter.on("render", layoutOutterRendered );
    layoutOutter.render();
}

YAHOO.util.Event.onDOMReady(initLayoutOutter);


</script>
</body>
</html>
