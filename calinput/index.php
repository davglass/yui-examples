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
        .yui_calinput {
            background-image: url( calendar.gif );
            background-position: top right;
            background-repeat: no-repeat;
        }
        p {
            margin: 1em;
        }
        #bd {
            position: relative;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar attached to Text Input</a></h1></div>
    <div id="bd">
    <p>Here is an example on how to attach a popup calendar to a text input. Just place your cursor in the text box & the calendar will appear.</p>

    <p>Select Date 1: <input type="text" id="cal1Date" size="25" value="" /></p>
    <p>Select Date 2: <input type="text" id="cal2Date" size="25" value="" /></p>
</div>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/calendar-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript" src="../tools/tools.js"></script>
<script type="text/javascript" src="./calinput.js"></script>
<script type="text/javascript">

var calInput1 = new YAHOO.widget.CalInput('cal1Date');
calInput1.render();

var calInput2 = new YAHOO.widget.CalInput('cal2Date');
calInput2.render();

</script>
</body>
</html>
