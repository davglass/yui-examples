<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Calendar Bug</title>
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar pageDate bug (YUI Version .12)</a></h1></div>

    <div id="bd">
    <p>Updated this example to work with YUI Version .12. <a href="index11.php">The original can be found here</a>.</p>
    <p>Click on a date to select the entire row.</p>
    <p><a href="javascript:alert(cal1.getSelectedDates());">What is selected?</a></p>
    <div id="cal1Container"></div><br clear="all">
    <textarea name="code" class="JScript">
    </textarea>
</div>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../js/yui-012.js"></script>
<script type="text/javascript" src="../tools/tools-min.js"></script>
<script src="../js/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="../js/calendar-min.js"></script>
<script type="text/javascript">
var cal1;
function init() {
    cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container');
    cal1.render();

    dp.SyntaxHighlighter.HighlightAll('code'); 
}


$E.addListener(window, 'load', init);
</script>
</body>
</html>
