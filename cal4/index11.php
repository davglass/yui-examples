<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar Date Error</title>
    <style type="text/css" media="screen">
		@import url( ../css/calendar_assets/calendar.css );
        #cal1Container {
            position: absolute;
            /*display: none;*/
        }
	</style>
</head>
<body>
<h2>Calendar Date Error</h2>
<p>This is a modified version of the YUI Calendar with a fix (hopefully) for Brazilian time.</p>
<a href="javascript:alert(YAHOO.example.calendar.cal1.getSelectedDates());">What is selected?</a>
<div id="cal1Container"></div><br/>

<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="calendar-debug.js"></script>
<script type="text/javascript" src="../js/logger-min.js"></script>
<script type="text/javascript">
		YAHOO.namespace("example.calendar");

		function init() {
			YAHOO.example.calendar.cal1 = new YAHOO.widget.Calendar("YAHOO.example.calendar.cal1","cal1Container");
			YAHOO.example.calendar.cal1.render();
		}

		YAHOO.util.Event.addListener(window, "load", init);

</script>
</body>
</html>
