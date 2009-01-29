<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Calendar with Tooltip Overlay</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    
    <style type="text/css" media="screen">
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
        .yui-tt-shadow {
            display: none;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar with Tooltip Overlay</a></h1></div>

    <div id="bd">
    <p>This example allows you to create an associative array containing dates and tooltips. It will populate the calendar with the selected dates &amp; build the tooltip widget. So hover over the highlighted dates.</p>
    <p>UPDATED: This example now supports multiple months, I have the below calendar set with dates for the next year.</p>
    <p>Currently, I am using PHP to generate the array of dates. It would not be that hard to use JSON or XHR to accomplish this.</p>
    <p><b>Updated: </b> <a href="index-json.php">Here is an updated example using a JSON XHR request.</a></p>
<div id="cal1Container"></div> 
</div>
<p>
<form id="notta">
Date: <input type="text" name="newDate" id="newDate" value="<?php echo(date('n/j/Y')); ?>" /><br>
Tooltip: <input type="text" name="newTip" id="newTip" size="50" value="Dynamically Added Tooltip" /><br>
<button id="addTip">Add Tooltip</button>
</form>
</p>
<h2>The HTML</h2>
<textarea name="code" class="HTML">
<div id="cal1Container"></div> 
<form id="notta">
Date: <input type="text" name="newDate" id="newDate" value="&lt?php echo(date('n/j/Y')); ?&gt;" /><br>
Tooltip: <input type="text" name="newTip" id="newTip" size="50" value="Dynamically Added Tooltip" /><br>
<button id="addTip">Add Tooltip</button>
</form>
</textarea>
<h2>The Javascript</h2>
<textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        cal1 = null,
        dateHolder = [],
        myTooltip = null,
        myDates = {
            '8/1/2007':    'Aug 1st - This is a test. This is a test. This is a test. This is a test. This is a test.',
            '8/6/2007':    'Aug 6th - This is a test. This is a test. This is a test. This is a test. This is a test.',
            '8/13/2007':    'Aug 13th - This is a test. This is a test. This is a test. This is a test. This is a test.',
            '7/25/2008':    'Jul 25th - This is a test. This is a test. This is a test. This is a test. This is a test.'
            //Example code snipped
        };


    function init() {
        strDates = '';
        for (var tmpDate in myDates) {
            strDates = strDates + ',' + tmpDate;
        }
        cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container', {
            pagedate: '8/2007',
            selected: strDates,
            MULTI_SELECT: true
        }
        );
        cal1.renderEvent.subscribe(addListeners);
        cal1.render();

        Event.addListener('addTip', 'click', addDynamicTip);
        dp.SyntaxHighlighter.HighlightAll('code'); 
    }
    function addDynamicTip(ev) {
        Event.stopEvent(ev);
        var nDate = Dom.get('newDate').value;
        var nTip = Dom.get('newTip').value;
        if (nDate && nTip) {
            myDates[nDate] = nTip;
            try { //For Internet Explorer, not sure why,,
                cal1.select(nDate);
            } catch (e) {}
            cal1.render();
        }
    }
    function addListeners() {
        var tds = Dom.getElementsByClassName('calcell', 'td', cal1.table);
        var tipTds = [];
        if (myTooltip) {
            myTooltip.destroy();
        }
        for (var i = 0; i &lt; tds.length; i++) {
            //Parse the current date to (m/d/yyyy)
            var tmpDate = cal1.cellDates[i][1] + '/' + cal1.cellDates[i][2] + '/' + cal1.cellDates[i][0];
            if (myDates[tmpDate]) {
                tds[i].title = myDates[tmpDate];
                tipTds[tipTds.length] = tds[i].id;
            }
        }
        myTooltip = new YAHOO.widget.Tooltip('cal_tooltip', { 
                context: tipTds, 
                showDelay:500 } );
    }

    Event.on(window, 'load', init);
})();
</textarea>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/calendar/calendar-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        cal1 = null,
        dateHolder = [],
        myTooltip = null,
        myDates = {
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
        cal1.renderEvent.subscribe(addListeners);
        cal1.render();

        Event.addListener('addTip', 'click', addDynamicTip);
        dp.SyntaxHighlighter.HighlightAll('code'); 
    }
    function addDynamicTip(ev) {
        Event.stopEvent(ev);
        var nDate = Dom.get('newDate').value;
        var nTip = Dom.get('newTip').value;
        if (nDate && nTip) {
            myDates[nDate] = nTip;
            try { //For Internet Explorer, not sure why,,
                cal1.select(nDate);
            } catch (e) {}
            cal1.render();
        }
    }
    function addListeners() {
        var tds = Dom.getElementsByClassName('calcell', 'td', cal1.table);
        var tipTds = [];
        if (myTooltip) {
            myTooltip.destroy();
        }
        for (var i = 0; i < tds.length; i++) {
            //Parse the current date to (m/d/yyyy)
            var tmpDate = cal1.cellDates[i][1] + '/' + cal1.cellDates[i][2] + '/' + cal1.cellDates[i][0];
            if (myDates[tmpDate]) {
                tds[i].title = myDates[tmpDate];
                tipTds[tipTds.length] = tds[i].id;
            }
        }
        myTooltip = new YAHOO.widget.Tooltip('cal_tooltip', { 
                context: tipTds, 
                showDelay:500 } );
    }

    Event.on(window, 'load', init);
})();
</script>
</body>
</html>
