<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Calendar Mouse Navigation</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
		@import url( ../css/calendar_assets/calendar.css );
        #cal1Container {
            position: absolute;
            /*display: none;*/
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar with mouse navigation</a></h1></div>

    <div id="bd">

<p>Use the arrow keys &amp; enter keys to navigate this calendar</p>
Select Date: <input type="text" id="cal1Date" size="35" value="" />
<div id="cal1Container"></div><br/>
<!--a href="javascript:alert(cal1.getSelectedDates());">What is selected?</a-->
</div>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/calendar-min.js"></script>
<script type="text/javascript">
var cal1;
var sel_date = 0;
function init() {
    cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
    cal1.render();
    setDate();
    YAHOO.util.Event.addListener(document, 'keyup', checkKeys);
}
function setDate() {
    //couldn't find a better way to do this!!!
    for (var i = 0; i < cal1.cellDates.length; i++) {
        var _tmp = cal1.cellDates[i][0] + '.' + cal1.cellDates[i][1] + '.' + cal1.cellDates[i][2];
        var _tmp1 = cal1.today.getFullYear() + '.' + (cal1.today.getMonth() + 1) + '.' + cal1.today.getDate();
        if (_tmp == _tmp1) {
            cal1.selectCell(i);
            sel_date = i;
        }
    }
}
function selDates() {
    var calDate = cal1.getSelectedDates()[0];
    calDate = (calDate.getMonth() + 1) + '/' + calDate.getDate() + '/' + calDate.getFullYear();
    YAHOO.util.Dom.get('cal1Date').value = calDate;
    setDate();
}

function checkKeys(ev) {
    cells = cal1.cells;
    next = 0;
    switch (ev.keyCode) {
        case 13: //Enter
            selDates();
            break;
        case 37: //Left
            next = (sel_date - 1);
            break;
        case 38: //Up
            next = (sel_date - 7);
            break;
        case 39: //Right
            next = (sel_date + 1);
            break;
        case 40: //Down
            next = (sel_date + 7);
            break;
    }
    if ((next >= 0) && cells[next]) {
        sel_date = next;
        cal1.deselectCell(sel_date);
        cal1.selectCell(next);
    }
}

init();

</script>
</body>
</html>
