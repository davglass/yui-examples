<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar (Multi Select) Text Input</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/dpSyntaxHighlighter.css">

    <style type="text/css" media="screen">
		@import url( ../css/calendar_assets/calendar.css );
        #cal1Container {
            position: absolute;
            display: none;
        }
        p, #cal1Container {
            margin: 1em;
        }
        textarea {
            width: 100%;
        }
        #cal1Container {
            z-index: 500;
        }
        .dp-highlighter {
            z-index: 1;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar (Multi Select) attached to Text Input (YUI Version .12)</a></h1></div>
    <div id="bd">
        <p>Updated this example to work with YUI Version .12.</p>
        <p>Here is an example on how to attach a popup calendar to a text input. Just place your cursor in the text box & the calendar will appear.</p>
        Select Date: <input type="text" id="cal1Date" size="65" value="1/10/2007,1/13/2007,2/6/2007,2/19/2007" />
        <div id="cal1Container"></div>
        <br clear="all">
        <textarea name="code" class="JScript">
var cal1;
var over_cal = false;
function init() {
    /*cal1 = new YAHOO.widget.Calendar("cal1","cal1Container", { MULTI_SELECT: true });*/
    cal1 = new YAHOO.widget.CalendarGroup("cal1","cal1Container", { MULTI_SELECT: true, close: true, selected: '' });
    cal1.selectEvent.subscribe(getDate, cal1, true);
    //Added this to update the text input when you deselect a date
    cal1.deselectEvent.subscribe(getDate, cal1, true);
    cal1.renderEvent.subscribe(setupListeners, cal1, true);

    $E.addListener('cal1Date', 'focus', showCal);
    $E.addListener('cal1Date', 'blur', hideCal);
    cal1.render();
}

function setupListeners() {
    $E.addListener('cal1Container', 'mouseover', overCal);
    $E.addListener('cal1Container', 'mouseout', outCal);
}

function getDate() {
        var calDate = this.getSelectedDates();
        var calDateStr = [];
        for (var i = 0; i < calDate.length; i++) {
            calDateStr[calDateStr.length] = (calDate[i].getMonth() + 1) + '/' + calDate[i].getDate() + '/' + calDate[i].getFullYear();
        }
        $('cal1Date').value = calDateStr.join(',');
        //Removed this so that the calendar doesn't disappear when you select a date
        //over_cal = false;
        //hideCal();
}

function showCal() {
    var xy = $D.getXY('cal1Date');
    $D.setStyle('cal1Container', 'display', 'block');
    xy[1] = xy[1] + parseInt($T.getHeight('cal1Date')) + 3;
    $D.setXY('cal1Container', xy);
    // Added this if statement to check if the text input has a value
    // If it does then set the config object and re-render the calendar
    if ($('cal1Date').value) {
        cal1.cfg.setProperty('selected', $('cal1Date').value);
        cal1.render();
    }
}

function hideCal() {
    if (!over_cal) {
        $D.setStyle('cal1Container', 'display', 'none');
    }
}

function overCal() {
    over_cal = true;
}

function outCal() {
    over_cal = false;
}

$E.addListener(window, 'load', init);
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
var over_cal = false;
function init() {
    /*cal1 = new YAHOO.widget.Calendar("cal1","cal1Container", { MULTI_SELECT: true });*/
    cal1 = new YAHOO.widget.CalendarGroup("cal1","cal1Container", { MULTI_SELECT: true, close: true, selected: '' });
    cal1.selectEvent.subscribe(getDate, cal1, true);
    //Added this to update the text input when you deselect a date
    cal1.deselectEvent.subscribe(getDate, cal1, true);
    cal1.renderEvent.subscribe(setupListeners, cal1, true);

    $E.addListener('cal1Date', 'focus', showCal);
    $E.addListener('cal1Date', 'blur', hideCal);
    cal1.render();
    dp.SyntaxHighlighter.HighlightAll('code'); 
}

function setupListeners() {
    $E.addListener('cal1Container', 'mouseover', overCal);
    $E.addListener('cal1Container', 'mouseout', outCal);
}

function getDate() {
        var calDate = this.getSelectedDates();
        var calDateStr = [];
        for (var i = 0; i < calDate.length; i++) {
            calDateStr[calDateStr.length] = (calDate[i].getMonth() + 1) + '/' + calDate[i].getDate() + '/' + calDate[i].getFullYear();
        }
        $('cal1Date').value = calDateStr.join(',');
        //Removed this so that the calendar doesn't disappear when you select a date
        //over_cal = false;
        //hideCal();
}

function showCal() {
    var xy = $D.getXY('cal1Date');
    $D.setStyle('cal1Container', 'display', 'block');
    xy[1] = xy[1] + parseInt($T.getHeight('cal1Date')) + 3;
    $D.setXY('cal1Container', xy);
    // Added this if statement to check if the text input has a value
    // If it does then set the config object and re-render the calendar
    if ($('cal1Date').value) {
        cal1.cfg.setProperty('selected', $('cal1Date').value);
        cal1.render();
    }
}

function hideCal() {
    if (!over_cal) {
        $D.setStyle('cal1Container', 'display', 'none');
    }
}

function overCal() {
    over_cal = true;
}

function outCal() {
    over_cal = false;
}

$E.addListener(window, 'load', init);
</script>
</body>
</html>
