<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar Text Input</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
		@import url( ../css/calendar_assets/calendar.css );
        #cal1Container {
            position: absolute;
            display: none;
        }
        p {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar attached to Text Input</a></h1></div>

    <div id="bd">
<p>Here is an example on how to attach a popup calendar to a text input. Just place your cursor in the text box & the calendar will appear.</p>
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
<script type="text/javascript" src="../js/calendar-min-11.js"></script>
<script type="text/javascript">
var cal1;
var over_cal = false;
function init() {
    cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
    cal1.onSelect = function() {
        var calDate = cal1.getSelectedDates()[0];
        calDate = (calDate.getMonth() + 1) + '/' + calDate.getDate() + '/' + calDate.getFullYear();
        YAHOO.util.Dom.get('cal1Date').value = calDate;
        over_cal = false;
        hideCal();
    }
    cal1.render();
    YAHOO.util.Event.addListener('cal1Date', 'focus', showCal);
    YAHOO.util.Event.addListener('cal1Date', 'blur', hideCal);
    YAHOO.util.Event.addListener('cal1Container', 'mouseover', overCal);
    YAHOO.util.Event.addListener('cal1Container', 'mouseout', outCal);
}

function showCal() {
    YAHOO.util.Dom.setStyle('cal1Container', 'display', 'block');
}
function hideCal() {
    if (!over_cal) {
        YAHOO.util.Dom.setStyle('cal1Container', 'display', 'none');
        //YAHOO.util.Dom.get('cal1Date').value = cal1.getSelectedDates();
    }
}
function overCal() {
    over_cal = true;
}
function outCal() {
    over_cal = false;
}
init();

</script>
</body>
</html>

