<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DD and onclick</title>
    <style type="text/css" media="screen">
        @import url( style.css );
	</style>
</head>
<body>

<div id="element1">Drag Me and an event will fire, then just click me and another event will fire.. sort of 8-)</div>

<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript">
var isDragging = false;

var dd1 = new YAHOO.util.DD("element1"); 

dd1.startDrag = handleDrag;

function handleDrag() {
    isDragging = true;
}

YAHOO.util.Event.addListener('element1', 'click', handleClick);

function handleClick(ev) {
    if (isDragging) {
        isDragging = false;
        alert('Click event fired after drag');
    } else {
        alert('Clicked without drag');
    }
}

</script>
</body>
</html>
