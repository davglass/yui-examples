<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop DataTable</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #datatable {
            margin-left: 100px;
            float: left;
        }
        #folders {
            float: left;
            list-style-type: disc;
            margin-left: 30px;
        }
        #folders li {
            border: 1px solid white;
        }
        #folders li.over {
            border: 1px solid red;
        }
        #status {
            border: 1px solid red;
            color: red;
            height: 2em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop DataTable</a></h1></div>
    <div id="bd">
        <div id="status"></div>
        <ul id="folders">
            <li>Folder 1</li>
            <li>Folder 2</li>
            <li>Folder 3</li>
            <li>Folder 4</li>
            <li>Folder 5</li>
            <li>Folder 6</li>
            <li>Folder 7</li>
        </ul>
        <div id="datatable" class="yui-dt"></div>
        <br clear="all">
        <h2>The Code</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        ddRow = null,
        overLi = null,
        selectedRow = null,
        thisStatus = Dom.get('status');

    var myColumnHeaders = [
        {key:"SKU", sortable: true } ,
        {key:"Quantity", sortable: true },
        {key:"Item", sortable: true },
        {key:"Description",sortable: true }
    ];

    var myColumnSet = new YAHOO.widget.ColumnSet(myColumnHeaders);
    var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.inventory);
    myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
    myDataSource.responseSchema = {
        fields: ["SKU","Quantity","Item","Description"]
    };

    var myDataTable = new YAHOO.widget.DataTable("datatable", myColumnSet, myDataSource, { sortedBy:{ colKey: "Item", dir: "desc" }, rowSingleSelect: true });
    myDataTable.subscribe("cellMousedownEvent",myDataTable.onEventSelectRow);

    var onRowSelect = function(ev) {
        
        thisStatus.innerHTML = '';
        var par = myDataTable.getTrEl(Event.getTarget(ev)); //The tr element
        selectedRow = myDataTable.getSelectedRows();
        ddRow = new YAHOO.util.DDProxy(par.id);
        ddRow.handleMouseDown(ev.event);

        ddRow.onDragOver = function() {
            Dom.addClass(arguments[1], 'over');
            if (overLi && (overLi != arguments[1])) {
                Dom.removeClass(overLi, 'over');
            }
            overLi = arguments[1];
        }

        ddRow.onDragOut = function() {
            Dom.removeClass(overLi, 'over');
        }

        ddRow.onDragDrop = function(ev) {
            thisStatus.innerHTML = 'You dropped this row (' + selectedRow + ') on this li (' + Dom.get(overLi).innerHTML + ')';
            Dom.removeClass(overLi, 'over');
            myDataTable.unselectAllRows();
            YAHOO.util.DragDropMgr.stopDrag(ev,true);
            Dom.get(this.getDragEl()).style.visibility = 'hidden';
            Dom.setStyle(this.getEl(), 'position', 'static');
            Dom.setStyle(this.getEl(), 'top', '');
            Dom.setStyle(this.getEl(), 'left', '');
        }

    };
    myDataTable.subscribe('cellMousedownEvent', onRowSelect);


    var lis = Dom.get('folders').getElementsByTagName('li');
    for (var i = 0; i &lt; lis.length; i++) {
        new YAHOO.util.DDTarget(lis[i]);
    }

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/datasource/datasource-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/datatable/datatable-beta-min.js"></script> 
<script type="text/javascript" src="data.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        ddRow = null,
        overLi = null,
        selectedRow = null,
        thisStatus = Dom.get('status');

    var myColumnHeaders = [
        {key:"SKU", sortable: true } ,
        {key:"Quantity", sortable: true },
        {key:"Item", sortable: true },
        {key:"Description",sortable: true }
    ];

    var myColumnSet = new YAHOO.widget.ColumnSet(myColumnHeaders);
    var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.inventory);
    myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
    myDataSource.responseSchema = {
        fields: ["SKU","Quantity","Item","Description"]
    };

    var myDataTable = new YAHOO.widget.DataTable("datatable", myColumnSet, myDataSource, { sortedBy:{ colKey: "Item", dir: "desc" }, rowSingleSelect: true });
    myDataTable.subscribe("cellMousedownEvent",myDataTable.onEventSelectRow);

    var onRowSelect = function(ev) {
        
        thisStatus.innerHTML = '';
        var par = myDataTable.getTrEl(Event.getTarget(ev)); //The tr element
        selectedRow = myDataTable.getSelectedRows();
        ddRow = new YAHOO.util.DDProxy(par.id);
        ddRow.handleMouseDown(ev.event);

        ddRow.onDragOver = function() {
            Dom.addClass(arguments[1], 'over');
            if (overLi && (overLi != arguments[1])) {
                Dom.removeClass(overLi, 'over');
            }
            overLi = arguments[1];
        }

        ddRow.onDragOut = function() {
            Dom.removeClass(overLi, 'over');
        }

        ddRow.onDragDrop = function(ev) {
            thisStatus.innerHTML = 'You dropped this row (' + selectedRow + ') on this li (' + Dom.get(overLi).innerHTML + ')';
            Dom.removeClass(overLi, 'over');
            myDataTable.unselectAllRows();
            YAHOO.util.DragDropMgr.stopDrag(ev,true);
            Dom.get(this.getDragEl()).style.visibility = 'hidden';
            Dom.setStyle(this.getEl(), 'position', 'static');
            Dom.setStyle(this.getEl(), 'top', '');
            Dom.setStyle(this.getEl(), 'left', '');
        }

    };
    myDataTable.subscribe('cellMousedownEvent', onRowSelect);


    var lis = Dom.get('folders').getElementsByTagName('li');
    for (var i = 0; i < lis.length; i++) {
        new YAHOO.util.DDTarget(lis[i]);
    }

    Event.on(window, 'load', function() {
        dp.SyntaxHighlighter.HighlightAll('code');
    });
})();
</script>
</body>
</html>
