<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar Row Select</title>
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar Select Whole Row (YUI Version .12)</a></h1></div>

    <div id="bd">
    <p>Updated this example to work with YUI Version .12. <a href="index11.php">The original can be found here</a>.</p>
    <p>Click on a date to select the entire row.</p>
    <p><a href="javascript:alert(cal1.getSelectedDates());">What is selected?</a></p>
    <div id="cal1Container"></div><br clear="all">
    <textarea name="code" class="JScript">
var cal1;
function init() {
    cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container', {
        MULTI_SELECT: true
    });
    
    cal1.selectEvent.subscribe(rowSelect, cal1, true);
    cal1.render();
}

function rowSelect(ev, arr) {
    /* Deselect all items */
    this.deselectAll();
    /* Remove the selected class */
    $D.removeClass(this.cells, 'selected');
    /* Prep the array of selected items */
    var selected = [];
    /* Find the cell index of the selected date */
    for (var i = 0; i < this.cellDates.length; i++) {
        if (this._fieldArraysAreEqual(arr[0][0], this.cellDates[i])) {
            var index = i;
            break;
        }
    }
    /* The TR parent of the selected date */
    var row = this.cells[index].parentNode;
    /* All of the TDs in that row */
    var tds = row.getElementsByTagName('td');
    for (var i = 0; i < tds.length; i++) {
        var cell = tds[i];
        /* Get the cell index of this TD */
        var index = parseInt(cell.id.replace(this.id + '_cell', ''));
        /* The date of this TD */
        var d = this.cellDates[index];
        var dCellDate = this._toDate(d);
        /* This check can be removed if you want them to be able to select days outside of the current month */
        if (!this.isDateOOM(dCellDate)) {
            var selectDate = d.concat();
            /* Add this date to the selected array */
            selected[selected.length] = selectDate;
            /* Set selected style */
            this.renderCellStyleSelected(dCellDate, cell);
        }
    }
    /* Update the config with the array of selected dates */
    this.cfg.setProperty("selected", selected);
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
function init() {
    cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container', {
        MULTI_SELECT: true
    });
    
    cal1.selectEvent.subscribe(rowSelect, cal1, true);
    cal1.render();

    dp.SyntaxHighlighter.HighlightAll('code'); 
}

function rowSelect(ev, arr) {
    /* Deselect all items */
    this.deselectAll();
    /* Remove the selected class */
    $D.removeClass(this.cells, 'selected');
    /* Prep the array of selected items */
    var selected = [];
    /* Find the cell index of the selected date */
    for (var i = 0; i < this.cellDates.length; i++) {
        if (this._fieldArraysAreEqual(arr[0][0], this.cellDates[i])) {
            var index = i;
            break;
        }
    }
    /* The TR parent of the selected date */
    var row = this.cells[index].parentNode;
    /* All of the TDs in that row */
    var tds = row.getElementsByTagName('td');
    for (var i = 0; i < tds.length; i++) {
        var cell = tds[i];
        /* Get the cell index of this TD */
        var index = parseInt(cell.id.replace(this.id + '_cell', ''));
        /* The date of this TD */
        var d = this.cellDates[index];
        var dCellDate = this._toDate(d);
        /* This check can be removed if you want them to be able to select days outside of the current month */
        if (!this.isDateOOM(dCellDate)) {
            var selectDate = d.concat();
            /* Add this date to the selected array */
            selected[selected.length] = selectDate;
            /* Set selected style */
            this.renderCellStyleSelected(dCellDate, cell);
        }
    }
    /* Update the config with the array of selected dates */
    this.cfg.setProperty("selected", selected);
}

$E.addListener(window, 'load', init);
</script>
</body>
</html>

