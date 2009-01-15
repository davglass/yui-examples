<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar Row Select</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
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
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar Select Whole Row</a></h1></div>

    <div id="bd">
    <p>Updated this example to work with YUI Version 2.6.0.</p>
    <p>Click on a date to select the entire row.</p>
    <p><a href="#" id="showSelected">What is selected?</a></p>
    <div id="cal1Container"></div><br clear="all">
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        cal1 = null;


    Event.onDOMReady(function() {
        cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container', {
            MULTI_SELECT: true
        });
        
        cal1.selectEvent.subscribe(rowSelect, cal1, true);
        cal1.render();
    });

    Event.on('showSelected', 'click', function(e) {
        Event.stopEvent(e);
        alert(cal1.getSelectedDates());
    });



    var rowSelect = function(ev, arr) {
        /* Deselect all items */
        this.deselectAll();
        /* Remove the selected class */
        Dom.removeClass(this.cells, 'selected');
        /* Prep the array of selected items */
        var selected = [], index = 0;
        /* Find the cell index of the selected date */
        for (var i = 0; i &lt; this.cellDates.length; i++) {
            if (this._fieldArraysAreEqual(arr[0][0], this.cellDates[i])) {
                index = i;
                break;
            }
        }
        /* The TR parent of the selected date */
        var row = this.cells[index].parentNode,
            /* All of the TDs in that row */
            tds = row.getElementsByTagName('td');

        for (var i = 0; i &lt; tds.length; i++) {
            var cell = tds[i],
            /* Get the cell index of this TD */
                index = parseInt(cell.id.replace(this.id + '_cell', '')),
                /* The date of this TD */
                d = this.cellDates[index],
                dCellDate = this._toDate(d);

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

    dp.SyntaxHighlighter.HighlightAll('code');
})();
    </textarea>
</div>
<div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/calendar/calendar-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>

<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        cal1 = null;


    Event.onDOMReady(function() {
        cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container', {
            MULTI_SELECT: true
        });
        
        cal1.selectEvent.subscribe(rowSelect, cal1, true);
        cal1.render();
    });

    Event.on('showSelected', 'click', function(e) {
        Event.stopEvent(e);
        alert(cal1.getSelectedDates());
    });



    var rowSelect = function(ev, arr) {
        /* Deselect all items */
        this.deselectAll();
        /* Remove the selected class */
        Dom.removeClass(this.cells, 'selected');
        /* Prep the array of selected items */
        var selected = [], index = 0;
        /* Find the cell index of the selected date */
        for (var i = 0; i < this.cellDates.length; i++) {
            if (this._fieldArraysAreEqual(arr[0][0], this.cellDates[i])) {
                index = i;
                break;
            }
        }
        /* The TR parent of the selected date */
        var row = this.cells[index].parentNode,
            /* All of the TDs in that row */
            tds = row.getElementsByTagName('td');

        for (var i = 0; i < tds.length; i++) {
            var cell = tds[i],
            /* Get the cell index of this TD */
                index = parseInt(cell.id.replace(this.id + '_cell', '')),
                /* The date of this TD */
                d = this.cellDates[index],
                dCellDate = this._toDate(d);

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

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>

