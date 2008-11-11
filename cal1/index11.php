<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar Row Select</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
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

	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar Select Whole Row (YUI Version .11)</a></h1></div>

    <div id="bd">
<p>Click on a date to select the entire row.</p>
<a href="javascript:alert(cal1.getSelectedDates());">What is selected?</a>
<div id="cal1Container"></div> 
</div>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/calendar-min-11.js"></script>
<script type="text/javascript">
var cal1;
function init() {
    cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
    /* This must be set to allow for more than one date selection */
    cal1.Options.MULTI_SELECT = true;
    cal1.Options.ROW_SELECT_ONE = true;
    
    cal1.doSelectCell = function(e, cal) {
        if (cal1.Options.ROW_SELECT_ONE) {
            /* Didn't Work as expected!!!*/
            cal1.deselectAll();
            YAHOO.util.Dom.removeClass(cal1.cells, 'selected');
        }
        var row = this.parentNode;
        var tds = row.getElementsByTagName('td');
        for (var i = 0; i < tds.length; i++) {
            var cell = tds[i];
            var index = cell.index;
            var d = cal.cellDates[index];
            var date = new Date(d[0],d[1]-1,d[2]);
            var link = cell.getElementsByTagName("A")[0];
            if (link) {
                link.blur();
                cal.selectCell(index);
            }
        }
    }
    
   
    cal1.render();
}


init();
</script>
</body>
</html>
