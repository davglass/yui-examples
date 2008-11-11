<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DataTable Patchs</title>
    <link rel="stylesheet" href="http://us.js2.yimg.com/us.js.yimg.com/lib/common/css/reset-fonts-grids_2.1.2.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #editing {margin:1em;}
        #editing table {border-collapse:collapse;}
        #editing th, #editing td {border:1px solid #000;padding:.25em;}
        #editing th {background-color:#696969;color:#fff;}
        /*dark gray*/
        #editing .yui-dt-odd {background-color:#eee;}
         /*light gray*/
        #editing .yui-dt-editable.yui-dt-highlight {background-color:#BEDAFF;}
         /*light blue*/
        .yui-dt-coled-textbox input { border: 1px solid #ccc; border-right: 2px solid #999; border-bottom: 2px solid #999; }
        .yui-dt-coled-textarea textarea { border: 1px solid #ccc; border-right: 2px solid #999; border-bottom: 2px solid #999; }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DataTable Patchs</a></h1></div>
    <div id="bd">
    <div id="editing"></div>
    <h2>Classname Patch</h2>
    <textarea name="code" class="HTML">
.yui-dt-coled-textbox input { border: 1px solid #ccc; border-right: 2px solid #999; border-bottom: 2px solid #999; }
.yui-dt-coled-textarea textarea { border: 1px solid #ccc; border-right: 2px solid #999; border-bottom: 2px solid #999; }
    </textarea>
    <textarea name="code" class="JScript">
YAHOO.widget.ColumnEditor = function(sType) {
    //CODE SNIPPED
    YAHOO.util.Dom.addClass(this.container, 'yui-dt-coled-' + this.type);
    switch(this.type) {
        case "textbox":
            this.createTextboxEditor();
            break;
        case "textarea":
            this.createTextareaEditor();
            break;
        default:
            break;
    }
    //CODE SNIPPED
};
    </textarea>
    <h2>Second Classname Patch</h2>
    <textarea name="code" class="JScript">
//New Class Definitions
/**
 * Class name assigned to first td elements.
 *
 * @property CLASS_FIRST_COLUMN
 * @type String
 * @static
 * @final
 * @default "yui-dt-first-column"
 */
YAHOO.widget.DataTable.CLASS_FIRST_COLUMN = "yui-dt-first-column";

/**
 * Class name assigned to last td elements.
 *
 * @property CLASS_LAST_COLUMN
 * @type String
 * @static
 * @final
 * @default "yui-dt-last-column"
 */
YAHOO.widget.DataTable.CLASS_LAST_COLUMN = "yui-dt-last-column";

/////////////////////////////////////////////////////////////////

YAHOO.widget.DataTable.prototype._addRow = function(oRecord, index) {

    //CODE SNIPPED

    // Create TBODY cells
    for(var j=0; j<oColumnSet.keys.length; j++) {

        //CODE SNIPPED

        if (j == 0) {
            //This should be a reference to the first one in the row
            YAHOO.util.Dom.addClass(elCell, YAHOO.widget.DataTable.CLASS_FIRST_COLUMN);
        }

        //CODE SNIPPED

    }
    //This should be a reference to the last one in the row
    YAHOO.util.Dom.addClass(elCell, YAHOO.widget.DataTable.CLASS_LAST_COLUMN);

    //CODE SNIPPED

    return elRow.id;
};
    </textarea>
    <h2>Third Classname Patch</h2>
    <textarea name="code" class="JScript">
/**
 * Class name assigned to table element.
 *
 * @property CLASS_DATA_TABLE
 * @type String
 * @static
 * @final
 * @default "yui-dt"
 */
YAHOO.widget.DataTable.CLASS_DATA_TABLE = "yui-dt";


YAHOO.widget.DataTable.prototype._initTable = function() {
    //CODE SNIPPED

    // Create TABLE
    this._elTable = this._elContainer.appendChild(document.createElement("table"));
    var elTable = this._elTable;

    //Add an id for styling
    elTable.id = this.id;

    //Add a class for styling
    YAHOO.util.Dom.addClass(elTable, YAHOO.widget.DataTable.CLASS_DATA_TABLE);

    //CODE SNIPPED
}
    </textarea>
    </div>
</div>

<script type="text/javascript" src="http://developer.yahoo.com/yui/build/yahoo/yahoo.js"></script>
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/dom/dom.js"></script>
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/event/event.js"></script>
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/logger/logger.js"></script>
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/datasource/datasource-beta-debug.js"></script>
<script type="text/javascript" src="./datatable-beta-debug.js"></script>
<script type="text/javascript" src="http://developer.yahoo.com/yui/examples/datatable/js/data.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>

<script type="text/javascript">
//var myLogger = new YAHOO.widget.LogReader();


var myColumnHeaders = [
    {key:"SKU"} ,
    {key:"Quantity",editor:"textbox"},
    {key:"Item",editor:"textbox"},
    {key:"Description",editor:"textarea"}
];

var myColumnSet = new YAHOO.widget.ColumnSet(myColumnHeaders);
var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.inventory);
myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
myDataSource.responseSchema = {
    fields: ["SKU","Quantity","Item","Description"]
};

var myDataTable = new YAHOO.widget.DataTable("editing", myColumnSet, myDataSource,{caption:"Example: Inline Editing"});
myDataTable.subscribe("cellClickEvent",myDataTable.onEventEditCell);
myDataTable.subscribe("cellMouseoverEvent",myDataTable.onEventHighlightCell);
myDataTable.subscribe("cellMouseoutEvent",myDataTable.onEventUnhighlightCell);

var onCellEdit = function(oArgs) {
    YAHOO.log("Cell \"" + oArgs.target.id +
            "\" was updated from \"" + oArgs.oldData + "\" to \"" +
            oArgs.newData + "\"", "info", this.toString());
}

myDataTable.subscribe("cellEditEvent",onCellEdit);

dp.SyntaxHighlighter.HighlightAll('code');
</script>
</body>
</html>
