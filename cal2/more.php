<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar Text Input</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/calendar/assets/calendar.css"> 

    <style type="text/css" media="screen">
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar attached to Text Input (YUI Version .12)</a></h1></div>
    <div id="bd">
        <p>Updated this example to work with YUI Version .12. <a href="index11.php">The original can be found here</a>.</p>
        <p>Here is an example on how to attach a popup calendar to a text input. Just place your cursor in the text box & the calendar will appear.</p>
        <form method="get" action="more.php">
            Select Date 1: <input type="text" name="cal1Date" id="cal1Date" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date']) ? urldecode($_GET['cal1Date']) : '') ?>" /><br>
            Select Date 2: <input type="text" name="cal1Date2" id="cal1Date2" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date2']) ? urldecode($_GET['cal1Date2']) : '') ?>" /><br>
            Select Date 3: <input type="text" name="cal1Date3" id="cal1Date3" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date3']) ? urldecode($_GET['cal1Date3']) : '') ?>" /><br>
            <input type="submit" value="Submit" />
        </form>
        <div id="cal1Container"></div>
        <br clear="all">
        <h2>The HTML/PHP</h2>
        <textarea name="code" class="HTML">
<form method="get" action="more.php">
    Select Date 1: <input type="text" name="cal1Date" id="cal1Date" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date']) ? urldecode($_GET['cal1Date']) : '') ?>" /><br>
    Select Date 2: <input type="text" name="cal1Date2" id="cal1Date2" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date2']) ? urldecode($_GET['cal1Date2']) : '') ?>" /><br>
    Select Date 3: <input type="text" name="cal1Date3" id="cal1Date3" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date3']) ? urldecode($_GET['cal1Date3']) : '') ?>" /><br>
    <input type="submit" value="Submit" />
</form>
<div id="cal1Container"></div>
</textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
var cal1;
var over_cal = false;
var cur_field = '';
function init() {
    cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
    cal1.selectEvent.subscribe(getDate, cal1, true);
    cal1.renderEvent.subscribe(setupListeners, cal1, true);
    YAHOO.util.Event.addListener(['cal1Date', 'cal1Date2', 'cal1Date3'], 'focus', showCal);
    YAHOO.util.Event.addListener(['cal1Date', 'cal1Date2', 'cal1Date3'], 'blur', hideCal);
    cal1.render();
    dp.SyntaxHighlighter.HighlightAll('code'); 
}

function setupListeners() {
    YAHOO.util.Event.addListener('cal1Container', 'mouseover', overCal);
    YAHOO.util.Event.addListener('cal1Container', 'mouseout', outCal);
}

function getDate() {
        var calDate = this.getSelectedDates()[0];
        calDate = (calDate.getMonth() + 1) + '/' + calDate.getDate() + '/' + calDate.getFullYear();
        cur_field.value = calDate;
        over_cal = false;
        hideCal();
}

function showCal(ev) {
    var tar = YAHOO.util.Event.getTarget(ev);
    cur_field = tar;
    var xy = YAHOO.util.Dom.getXY(tar);
    var date = YAHOO.util.Dom.get(tar).value;
    if (date) {
        cal1.cfg.setProperty('selected', date);
        cal1.cfg.setProperty('pagedate', new Date(date), true);
        cal1.render();
    } else {
        cal1.cfg.setProperty('selected', '');
        cal1.cfg.setProperty('pagedate', new Date(), true);
        cal1.render();
    }
    YAHOO.util.Dom.setStyle('cal1Container', 'display', 'block');
    xy[1] = xy[1] + 20;
    YAHOO.util.Dom.setXY('cal1Container', xy);
}

function hideCal() {
    if (!over_cal) {
        YAHOO.util.Dom.setStyle('cal1Container', 'display', 'none');
    }
}

function overCal() {
    over_cal = true;
}

function outCal() {
    over_cal = false;
}

YAHOO.util.Event.addListener(window, 'load', init);
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>

<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/calendar/calendar-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../tools/tools-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
var cal1;
var over_cal = false;
var cur_field = '';
function init() {
    cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
    cal1.selectEvent.subscribe(getDate, cal1, true);
    cal1.renderEvent.subscribe(setupListeners, cal1, true);
    YAHOO.util.Event.addListener(['cal1Date', 'cal1Date2', 'cal1Date3'], 'focus', showCal);
    YAHOO.util.Event.addListener(['cal1Date', 'cal1Date2', 'cal1Date3'], 'blur', hideCal);
    cal1.render();
    dp.SyntaxHighlighter.HighlightAll('code'); 
}

function setupListeners() {
    YAHOO.util.Event.addListener('cal1Container', 'mouseover', overCal);
    YAHOO.util.Event.addListener('cal1Container', 'mouseout', outCal);
}

function getDate() {
        var calDate = this.getSelectedDates()[0];
        calDate = (calDate.getMonth() + 1) + '/' + calDate.getDate() + '/' + calDate.getFullYear();
        cur_field.value = calDate;
        over_cal = false;
        hideCal();
}

function showCal(ev) {
    var tar = YAHOO.util.Event.getTarget(ev);
    cur_field = tar;
    var xy = YAHOO.util.Dom.getXY(tar);
    var date = YAHOO.util.Dom.get(tar).value;
    if (date) {
        cal1.cfg.setProperty('selected', date);
        cal1.cfg.setProperty('pagedate', new Date(date), true);
        cal1.render();
    } else {
        cal1.cfg.setProperty('selected', '');
        cal1.cfg.setProperty('pagedate', new Date(), true);
        cal1.render();
    }
    YAHOO.util.Dom.setStyle('cal1Container', 'display', 'block');
    xy[1] = xy[1] + 20;
    YAHOO.util.Dom.setXY('cal1Container', xy);
}

function hideCal() {
    if (!over_cal) {
        YAHOO.util.Dom.setStyle('cal1Container', 'display', 'none');
    }
}

function overCal() {
    over_cal = true;
}

function outCal() {
    over_cal = false;
}

YAHOO.util.Event.addListener(window, 'load', init);
</script>
</body>
</html>

