<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Calendar with Tooltip Overlay</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
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
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar with Tooltip Overlay</a></h1></div>

    <div id="bd">
    <p>This example allows you to create an associative array containing dates and tooltips. It will populate the calendar with the selected dates &amp; build the tooltip widget. So hover over the highlighted dates.</p>
    <p>UPDATED: This example now supports multiple months, I have the below calendar set with dates for the next year.</p>
    <p>Currently, I am using PHP to generate the array of dates. It would not be that hard to use JSON or XHR to accomplish this.</p>
<div id="cal1Container"></div> 
</div>
<p>
<form id="">
Date: <input type="text" name="newDate" id="newDate" value="<?php echo(date('n/j/Y')); ?>" /><br>
Tooltip: <input type="text" name="newTip" id="newTip" size="50" value="Dynamically Added Tooltip" /><br>
<button id="addTip">Add Tooltip</button>
</form>
</p>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript" src="../js/calendar-min-11.js"></script>
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
    while (list($k, $dates) = each($months)) {
        if ((($m + $k) > 12) && !$newYear) {
            $y = ($y + 1);
            $newYear = true;
        }
        $monthStamp = mktime(0,0,0,($m + $k),1,$y);
        $curMonth = date('m', $monthStamp);
        while (list($k, $day) = each($dates)) {
            $thisStamp = mktime(0,0,0,$curMonth,$day,$y);
            $thisDate = date("n/j/Y", $thisStamp);
            $out[] = "'$thisDate':    '".date('M jS', $thisStamp)." - This is a test. This is a test. This is a test. This is a test. This is a test.'";
        }
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
    cal1 = new YAHOO.widget.Calendar("cal1","cal1Container", '<?php echo($thisMonth); ?>', strDates);
    cal1.Options.MULTI_SELECT = true;
    cal1.onRender = addListeners;
    cal1.render();

    YAHOO.util.Event.addListener('addTip', 'click', addDynamicTip);
}
function addDynamicTip(ev) {
    var nDate = YAHOO.util.Dom.get('newDate').value;
    var nTip = YAHOO.util.Dom.get('newTip').value;
    if (nDate && nTip) {
        myDates[nDate] = nTip;
        cal1.select(nDate);
        addListeners();
    }
    YAHOO.util.Event.stopEvent(ev);
}
function addListeners() {
    for (var i = 0; i < dateHolder.length; i++) {
        dateHolder[i].destroy();
    }
    var tds = YAHOO.util.Dom.getElementsByClassName('calcell', 'td', cal1.table);
    for (var i = 0; i < tds.length; i++) {
        //Parse the current date to (m/d/yyyy)
        var tmpDate = cal1.cellDates[i][1] + '/' + cal1.cellDates[i][2] + '/' + cal1.cellDates[i][0];
        if (myDates[tmpDate]) {
            cal1.selectCell(i);
            dateHolder[dateHolder.length] = myTooltip = new YAHOO.widget.Tooltip(cal1.cells[i].id + '_tooltip', { 
                context: cal1.cells[i].id, 
                text: myDates[tmpDate],
                showDelay:500 } );

        }
    }
}

init();
</script>
</body>
</html>
