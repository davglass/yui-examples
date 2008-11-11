<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Calendar with Tooltip Overlay</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
		@import url( ../css/calendar_assets/calendar.css );
		@import url( ../css/container_assets/container.css );
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
        #cal1Container {
            margin: 5em;
        }
        .tt {
            width: 250px;
        }
        p {
            margin: .5em;
            padding: .5em;
        }
        textarea {
            width: 100%;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar with Tooltip Overlay (YUI Version .12)</a></h1></div>

    <div id="bd">
    <p>Updated this example to work with YUI Version .12. <a href="index11.php">The original can be found here</a>.</p>
    <p>This example allows you to create an associative array containing dates and tooltips. It will populate the calendar with the selected dates &amp; build the tooltip widget. So hover over the highlighted dates.</p>
    <p>UPDATED: This example now supports multiple months, I have the below calendar set with dates for the next year.</p>
    <p>Currently, I am using PHP to generate the array of dates. It would not be that hard to use JSON or XHR to accomplish this.</p>
<div id="cal1Container"></div> 
</div>
<h2>The Javascript</h2>
    <textarea name="code" class="JScript">
var cal1;
var myDates = {
'2/2/2007':    'Feb 2nd - This is a test. This is a test. This is a test. This is a test. This is a test.',
'2/7/2007':    'Feb 7th - This is a test. This is a test. This is a test. This is a test. This is a test.',
'2/14/2007':    'Feb 14th - This is a test. This is a test. This is a test. This is a test. This is a test.',
'2/17/2007':    'Feb 17th - This is a test. This is a test. This is a test. This is a test. This is a test.',
'2/25/2007':    'Feb 25th - This is a test. This is a test. This is a test. This is a test. This is a test.'};

var dateHolder = [];

function init() {
    strDates = '';
    for (var tmpDate in myDates) {
        strDates = strDates + ',' + tmpDate;
    }
    cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container', {
        pagedate: '2/2007',
        selected: strDates,
        MULTI_SELECT: true
    }
    );
    cal1.beforeRenderEvent.subscribe(getDates);
    cal1.renderEvent.subscribe(addListeners);
    cal1.render();

    $E.addListener('addTip', 'click', addDynamicTip);
}
function addDynamicTip(ev) {
    var nDate = $('newDate').value;
    var nTip = $('newTip').value;
    if (nDate && nTip) {
        myDates[nDate] = nTip;
        cal1.select(nDate);
        addListeners();
    }
    $E.stopEvent(ev);
}
function getDates() {
    var curDate = cal1.cfg.getProperty('pagedate');
    var url = 'json-backend.php?getMonth=' + (curDate.getMonth() +1) + '&getYear=' + curDate.getFullYear();
    var transaction = YAHOO.util.Connect.asyncRequest('GET', url, callback, null);
}
function parseNewDates(o) {
    var newDates = eval('(' + o.responseText + ')');
    myDates = newDates;
    addListeners();
}
var callback = {
    success: parseNewDates
}
function addListeners() {
    for (var i = 0; i < dateHolder.length; i++) {
        dateHolder[i].destroy();
    }
    var tds = $D.getElementsByClassName('calcell', 'td', cal1.table);
    for (var i = 0; i < tds.length; i++) {
        //Parse the current date to (m/d/yyyy)
        var tmpDate = cal1.cellDates[i][1] + '/' + cal1.cellDates[i][2] + '/' + cal1.cellDates[i][0];
        if (myDates[tmpDate]) {
            //This fails in IE, not sure why?!?!
            try {
            cal1.selectCell(i);
            } catch (e) {}
            dateHolder[dateHolder.length] = myTooltip = new YAHOO.widget.Tooltip(cal1.cells[i].id + '_tooltip', { 
                context: cal1.cells[i].id, 
                text: myDates[tmpDate],
                showDelay:500 } );

        }
    }
}

$E.addListener(window, 'load', init);
</textarea>
<h2>The PHP</h2>
<textarea name="code" class="PHP">
include('JSON.php');
$json = new Services_JSON();


$getMonth = (($_GET['getMonth']) ? $_GET['getMonth'] : date('n'));
if (($getMonth < 1) || ($getMonth > 12)) {
    $getMonth = date('n');
}
$getYear = (($_GET['getYear']) ? $_GET['getYear'] : date('Y'));


$months[1] = array(3,8,11,19,26);
$months[2] = array(2,7,14,17,25);
$months[3] = array(1,6,13,18,27);
$months[4] = array(3,8,11,19,26);
$months[5] = array(2,7,14,17,25);
$months[6] = array(1,6,13,18,27);
$months[7] = array(3,8,11,19,26);
$months[8] = array(2,7,14,17,25);
$months[9] = array(1,6,13,18,27);
$months[10] = array(3,8,11,19,26);
$months[11] = array(2,7,14,17,25);
$months[12] = array(1,6,13,18,27);

$dates = array();

$monthStamp = mktime(0,0,0,($getMonth),1,$getYear);
$curMonth = date('m', $monthStamp);
while (list($k, $day) = each($months[$getMonth])) {
    $thisStamp = mktime(0,0,0,$curMonth,$day,$getYear);
    $thisDate = date("n/j/Y", $thisStamp);
    $dates[$thisDate] = date('M jS', $thisStamp).' - This is a test. This is a test. This is a test. This is a test. This is a test.';
}

echo($json->encode($dates));
</textarea>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/utilities_2.1.2.js"></script>
<script type="text/javascript" src="../js/calendar-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>

<script type="text/javascript">
var cal1;
var myDates = {
<?php
    $months[0] = array(1,6,13,18,27);
    $months[1] = array(3,8,11,19,26);
    $months[2] = array(2,7,14,17,25);
    $months[3] = array(1,6,13,18,27);
    $months[4] = array(3,8,11,19,26);
    $months[5] = array(2,7,14,17,25);
    $months[6] = array(1,6,13,18,27);
    $months[7] = array(3,8,11,19,26);
    $months[8] = array(2,7,14,17,25);
    $months[9] = array(1,6,13,18,27);
    $months[10] = array(3,8,11,19,26);
    $months[11] = array(2,7,14,17,25);
    $out = array();
    $m = date('n');
    $y = date('Y');
    $thisMonth = date('n/Y');
    $monthStamp = mktime(0,0,0,($m),1,$y);
    $curMonth = date('m', $monthStamp);
    while (list($k, $day) = each($months[$m])) {
        $thisStamp = mktime(0,0,0,$curMonth,$day,$y);
        $thisDate = date("n/j/Y", $thisStamp);
        $out[] = "'$thisDate':    '".date('M jS', $thisStamp)." - This is a test. This is a test. This is a test. This is a test. This is a test.'";
    }
    echo(implode(",\n", $out));
?>
};

var dateHolder = [];

function init() {
    strDates = '';
    for (var tmpDate in myDates) {
        strDates = strDates + ',' + tmpDate;
    }
    cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container', {
        pagedate: '<?php echo($thisMonth); ?>',
        selected: strDates,
        MULTI_SELECT: true
    }
    );
    cal1.beforeRenderEvent.subscribe(getDates);
    cal1.renderEvent.subscribe(addListeners);
    cal1.render();

    $E.addListener('addTip', 'click', addDynamicTip);
    dp.SyntaxHighlighter.HighlightAll('code'); 
}
function addDynamicTip(ev) {
    var nDate = $('newDate').value;
    var nTip = $('newTip').value;
    if (nDate && nTip) {
        myDates[nDate] = nTip;
        cal1.select(nDate);
        addListeners();
    }
    $E.stopEvent(ev);
}
function getDates() {
    var curDate = cal1.cfg.getProperty('pagedate');
    var url = 'json-backend.php?getMonth=' + (curDate.getMonth() +1) + '&getYear=' + curDate.getFullYear();
    var transaction = YAHOO.util.Connect.asyncRequest('GET', url, callback, null);
}
function parseNewDates(o) {
    var newDates = eval('(' + o.responseText + ')');
    myDates = newDates;
    addListeners();
}
var callback = {
    success: parseNewDates
}
function addListeners() {
    for (var i = 0; i < dateHolder.length; i++) {
        dateHolder[i].destroy();
    }
    var tds = $D.getElementsByClassName('calcell', 'td', cal1.table);
    for (var i = 0; i < tds.length; i++) {
        //Parse the current date to (m/d/yyyy)
        var tmpDate = cal1.cellDates[i][1] + '/' + cal1.cellDates[i][2] + '/' + cal1.cellDates[i][0];
        if (myDates[tmpDate]) {
            //This fails in IE, not sure why?!?!
            try {
            cal1.selectCell(i);
            } catch (e) {}
            dateHolder[dateHolder.length] = myTooltip = new YAHOO.widget.Tooltip(cal1.cells[i].id + '_tooltip', { 
                context: cal1.cells[i].id, 
                text: myDates[tmpDate],
                showDelay:500 } );

        }
    }
}

$E.addListener(window, 'load', init);
</script>
</body>
</html>
