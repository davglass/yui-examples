<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar Issue</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
		@import url( ../css/calendar_assets/calendar.css );
/* highlight the whole row */
		tr.hilite-row td.calcell {
			background-color:yellow;
		}

		/* highlight the current cell in the standard highlight color */
		tr.hilite-row td.calcellhover {
			cursor:pointer;
			color:#FFF;
			background-color:#FF9900;
			border:1px solid #FF9900;
		}

		/* make sure out of month cells don't highlight too */
		tr.hilite-row td.calcell.oom {
			cursor:default;
			color:#999;
			background-color:#EEE;
			border:1px solid #E0E0E0;
		}
        p, #cal1Container {
            margin: 1em;
        }
        textarea {
            width: 100%;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar Issue (YUI Version .12)</a></h1></div>
    <div id="bd">
        <div id="date_container"></div>
        <input type="text" name="date" id="date"/>
        <input type="button" name="show_calendar" value="Show Calendar" onClick="display_calendar('date');"/>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../js/yui-012.js"></script>
<script type="text/javascript" src="../tools/tools-min.js"></script>
<script src="../js/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="../js/calendar-min.js"></script>
<script type="text/javascript">
var calendar = null;
function display_calendar(textbox_name) {
    if (calendar) {
        calendar.show();
    } else {
        calendar = new YAHOO.widget.Calendar('calendar',textbox_name+"_container", {title:"Choose a date:", close:true});
        document.getElementById(textbox_name).value = "test1";//THIS WORKS FINE
        calendar.render();
        document.getElementById(textbox_name).value = "test2"; //WHY DOESN'T THIS WORK?!?!@??!
        //calendar.hide();
        //document.getElementById(textbox_name).value = "test3"; //WHY DOESN'T THIS WORK?!?!@??!
    }
};
</script>

</body>
</html>
