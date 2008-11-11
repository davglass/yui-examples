<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Invoice</title>

<script src="http://yui.yahooapis.com/2.4.0/build/yuiloader/yuiloader-beta-min.js"></script>
<script type="text/javascript">

(function () {


	var loader = new YAHOO.util.YUILoader();
	loader.loadOptional = true;
	loader.require("reset-fonts-grids","base","datatable","dragdrop");
	loader.insert({ 
		onSuccess: function() {
			//shortcuts
			var $C = YAHOO.util.Connect,
				$E = YAHOO.util.Event,
				$D = YAHOO.util.Dom,
				$L = YAHOO.lang,
				$ = $D.get,
				$DT = YAHOO.widget.DataTable;

			// The invoice will be empty the first time around
			// so I change the message to prompt the user
			$DT.MSG_EMPTY = "Drop Items here.";

			$DT.prototype.refreshRow = function(row) {
				var $D = YAHOO.util.Dom;
				$D.batch($D.getChildren(this.getTrEl(row)),this.formatCell,this,true);
			};
			
			
			$DT.editRegExp = function(oEditor, oSelf) {
				var elCell = oEditor.cell;
				var oRecord = oEditor.record;
				var oColumn = oEditor.column;
				var elContainer = oEditor.container;
				var value = YAHOO.lang.isValue(oRecord.getData(oColumn.key)) ? oRecord.getData(oColumn.key) : "";
				var regExp = new RegExp(oColumn.editorOptions.regExp);
				if (oColumn.editorOptions.finalRegExp) {
					var finalRegExp = new RegExp(oColumn.editorOptions.finalRegExp);
				}
						

			    var elTextbox = elContainer.appendChild(document.createElement("input"));
			    elTextbox.type = "text";
			    elTextbox.style.width = elCell.offsetWidth + "px"; 
			    elTextbox.value = value;

				YAHOO.util.Event.addListener(elTextbox, "keypress", function(ev){
					
					if (YAHOO.env.ua.gecko > 0 && ev.keyCode) { 
						return;
					}
					var ch = ev.keyCode || ev.charCode, t = this.value, start, end; 
					if (document.selection && document.selection.createRange) {
						//undocumented IE trick to get the selection box.
						start = Math.abs(document.selection.createRange().moveStart("character", -1000000));
						end = Math.abs(document.selection.createRange().moveEnd("character", -1000000)); 
					} else {
						start = this.selectionStart;
						end = this.selectionEnd;
					}
					t = t.substr(0,start) + String.fromCharCode(ch) + t.substr(end);
					if (!regExp.test(t)) {
						YAHOO.util.Event.stopEvent(ev);
					}
				});
				var checkFinal = function() {
					if (finalRegExp) {
						if (finalRegExp.test(elTextbox.value)) {
							$D.removeClass(elTextbox,oColumn.editorOptions.failedRegExpClassName);
						} else {
							$D.addClass(elTextbox,oColumn.editorOptions.failedRegExpClassName);
						}
					}
				};

				
			    YAHOO.util.Event.addListener(elTextbox, "keyup", function(ev){
			        oEditor.value = elTextbox.value;
			        oSelf.fireEvent("editorUpdateEvent",{editor:oEditor});
					checkFinal();
			    });
			    elTextbox.focus();
			    elTextbox.select();
				checkFinal();
			};


				
			var formatCurrency = function (value) {
				return YAHOO.util.Number.format(value,{prefix:'$',decimalPlaces:2,thousandsSeparator:','});
			};
			
			// Source DataTable, the available items
			var dtSource = new $DT(
				'sourceContainer',
				[
					{key:'partNo',label:'Part Nbr.'},
					{key:'description',label:'Description'},
					{
						key:'unitPrice',
						label:'Unit Price',
						formatter:function(el, oRecord, oColumn, oData) {
							el.innerHTML = formatCurrency(oData);
						},
						className:'number'
					}
				],
				new YAHOO.util.DataSource(
					[
						{partNo:'12-34',description:'item 1',unitPrice:10},
						{partNo:'56-78',description:'item 3',unitPrice:8},
						{partNo:'90-12',description:'item 9',unitPrice:13},
						{partNo:'34-56',description:'item 11',unitPrice:3}
					],
					{
						responseType:YAHOO.util.DataSource.TYPE_JSARRAY,
						responseSchema: {
							fields:['partNo','description','unitPrice']
						}
					}
				),
				{rowSingleSelect: true}
			);

			// This will keep track of which items are already in the invoice
			// to avoid duplicates when the same item is dragged twice
			var recordRefs = {};
			
			// Destination DataTable, the invoice.
			var dtDest = new $DT(
				'invoiceContainer',
				[
					{key:'partNo',label:'Part Nbr.',formatter:function(el, oRecord, oColumn, oData) {
						el.innerHTML = oData;
						recordRefs[oData] = oRecord;						
					}},
					{key:'description',label:'Description'},
					{
						key:'unitPrice',
						label:'Unit Price',
						formatter:function(el, oRecord, oColumn, oData) {
							el.innerHTML = formatCurrency(oData);
						},
						className:'number'
					},
					{
						key:'qty',
						label:'Qty.',
						editor:$DT.editRegExp,
						editorOptions:{
							regExp:'^[+-]?\\d*\\.?\\d*$',
							validator:$DT.validateNumber
						},
						className:'number'
					},
					{	// This is a calculated field, it is not in the RecordSet, 
						// it has not been declared in the fields list of the DataSource
						key:'price',
						label:'Price',
						formatter:function(el, oRecord, oColumn, oData) {
							oData = oRecord.getData('qty') * oRecord.getData('unitPrice');
							el.innerHTML = formatCurrency(oData);
						},
						className:'number'
					}
				],
				new YAHOO.util.DataSource(
					[],
					{
						responseType:YAHOO.util.DataSource.TYPE_JSARRAY,
						responseSchema: {
							fields:['description','unitPrice','qty']
						}
					}
				)
			);

			dtDest.subscribe('cellClickEvent', dtDest.onEventShowCellEditor);  
			
			/* This doesn't work for IE so I had to do all the DOM stuff right below this comment:
			var tfoot = dtDest.getTableEl().appendChild(document.createElement('tfoot'));
			tfoot.innerHTML = '<tr><th  colspan="3">Sub total<\/th><td class="number" id="subTotal"><\/td><\/tr>' +
				'<tr><th  colspan="3">Discount<\/th><td class="number" id="discount">0%<\/td><\/tr>' +
				'<tr><th  colspan="3">Total<\/th><td class="number" id="total"><\/td><\/tr>';
			*/
			var tfoot = dtDest.getTableEl().createTFoot();
			var tr = tfoot.insertRow(-1);
			var th = tr.appendChild(document.createElement('th'));
			th.colSpan = 4;
			th.innerHTML = 'Sub Total';
			var td = tr.insertCell(-1);
			td.className= 'number';
			td.id = 'subTotal';
			
			tr = tfoot.insertRow(-1);
			th = tr.appendChild(document.createElement('th'));
			th.colSpan = 4;
			th.innerHTML = 'Discount';
			td = tr.insertCell(-1);
			td.className= 'number';
			td.id = 'discount';
			td.innerHTML = '0%';

			tr = tfoot.insertRow(-1);
			th = tr.appendChild(document.createElement('th'));
			th.colSpan = 4;
			th.innerHTML = 'Total';
			td = tr.insertCell(-1);
			td.className= 'number';
			td.id = 'total';
			
			
			// This is to calculate the totals since they are not actually part of the DataTable
			// I have to provide for its handling.
			var elSubTotal = $('subTotal');
			var subTotal;
			var elDiscount = $('discount');
			var discount = 0;
			var elTotal = $('total');
			var total;
			
			var refreshTotals = function () {
				var i, rec, len = dtDest.getRecordSet().getLength();
				for (i = 0,subTotal = 0 ;i < len;i++) {
					rec = dtDest.getRecord(i);
					subTotal += rec.getData('unitPrice') * rec.getData('qty');
				}
				elSubTotal.innerHTML = formatCurrency(subTotal);
				total = subTotal * (1 - discount / 100);
				elTotal.innerHTML = formatCurrency(total);
			};
			
			
			// On saving the in-line cell editor value, I have to check whether it is the discount field
			// which is not actually in the table and has to be handled separately
			// or any of the quantity fields, which requires updating the totals 
			// for the row and for the whole invoice.
			dtDest.subscribe('editorSaveEvent',function (ev) {
				if (ev.editor.column.key == 'discount') {
					discount = ev.newData;
					elDiscount.innerHTML = discount + '%';
					total = subTotal * (1 - discount / 100);
					elTotal.innerHTML = formatCurrency(total);
				} else {
					this.refreshRow(ev.editor.cell);
					refreshTotals();
				}
			});
			
			
			// This is the part that shows the in-line cell editor in the Discount cell
			// which is actually out of the DataTable itself
			// I just make a fake column and a fake record.
			// the fakeCol I can keep and reuse, the fake record I have to do again each time to
			// show the correct value in the edit box.
			var fakeCol;
			$E.on(elDiscount,'click',function () {
				if ($L.isUndefined(fakeCol)) {
					fakeCol = new YAHOO.widget.Column({
						key:'discount',
						editor:$DT.editRegExp,
						editorOptions:{
							regExp:'^[+-]?\\d*\\.?\\d*$',
							validator:$DT.validateNumber
						}
					});
				}
				dtDest.showCellEditor(
					elDiscount,
					new YAHOO.widget.Record({discount:discount}),
					fakeCol
				);
			});
			
			refreshTotals();
			

			// This is what does the dragging and dropping
			dtSource.subscribe("cellMousedownEvent",dtSource.onEventSelectRow);

			dtSource.subscribe('cellMousedownEvent', function(ev) {
			
				var destId = null;
					
				var selectedRecordIndex = dtSource.getSelectedRows();
				var srcRow = this.getTrEl($E.getTarget(ev));
			    var ddRow = new YAHOO.util.DDProxy(srcRow);
			    ddRow.handleMouseDown(ev.event);

			    ddRow.onDragOver = function(ev,id) {
			        YAHOO.util.Dom.addClass(id, 'over');
			        if (destId && (destId != id)) {
			            YAHOO.util.Dom.removeClass(destId, 'over');
			        }
			        destId = id;
			    };

			    ddRow.onDragOut = function() {
			        YAHOO.util.Dom.removeClass(destId, 'over');
			    };

			    ddRow.onDragDrop = function(ev) {
					var rec = dtSource.getRecord(selectedRecordIndex[0]).getData();
					// If there is already a record in the invoice for that part number, update it.
					if (recordRefs[rec.partNo]) {
						rec = recordRefs[rec.partNo];
						var recData = rec.getData();
						recData.qty++;
						dtDest.updateRow(rec,recData);
						var row = dtDest.getTrEl(rec);
						//This highlights the row for a little while
						// just in case the record was dropped somewhere else
						// so the use can see where it went
						$D.addClass(row,'over');
						window.setTimeout(
							function() {
								$D.removeClass(row,'over');
							},
							500
						)
					} else {
						rec.qty = 1;
						var rowIndex = dtDest.getRecordIndex(destId) || 0;
						dtDest.addRow(rec,rowIndex);
						// each row added has to be made the destination of the drag and drop operation
						new YAHOO.util.DDTarget(dtDest.getTrEl(rowIndex));
					}
					refreshTotals()
			        $D.removeClass(destId, 'over');
			        dtSource.unselectAllRows();
					// This is to fix an IE issue.
					YAHOO.util.DragDropMgr.stopDrag(ev,true);
					$(this.getDragEl()).style.visibility = 'hidden';
			    };

			});


		    // The first drag and drop destination is where the messages are shown
		    new YAHOO.util.DDTarget(dtDest.getMsgTbodyEl());


			// This is just for the sample SSN example described below.
			var dtSSN = new $DT(
				'SSNcontainer',
				[
					{
						key:'SSN',
						formatter:function(el, oRecord, oColumn, oData) {
							el.innerHTML = oData;
							if (/^\d{3}-\d{2}-\d{4}$/.test(oData)) {
								$D.removeClass(el,'yellow');
							} else {
								$D.addClass(el,'yellow');
							}
						},
						editor:$DT.editRegExp,
						editorOptions:{
							regExp:'^\\d{0,3}-?\\d{0,2}-?\\d{0,4}$',
							finalRegExp:'^\\d{3}-\\d{2}-\\d{4}$',
							failedRegExpClassName:'yellow'
						}
					}
				],
				new YAHOO.util.DataSource(
					[['123-45-6789']],
					{
						responseType:YAHOO.util.DataSource.TYPE_JSARRAY,
						responseSchema: {
							fields:['SSN']
						}
					}
				)
			);
			dtSSN.subscribe('cellClickEvent', dtSSN.onEventShowCellEditor);  


			
		}
		
	});
})();
		</script>
<style type="text/css">
	.yui-skin-sam .yui-dt-table td.number {
		text-align: right;
	}
	.yui-skin-sam .yui-dt-table tbody.over td,
	.yui-skin-sam .yui-dt-table tr.over	td {
		background-color:#426FD9;
		color:white;
	}
	.yellow {
		background-color: yellow;
	}
</style>

	</head>

	<body class="yui-skin-sam">
		<div id="doc" class="yui-t3"> 
			<div id="hd">
				<h1>Invoice</h1>
			</div>
			<div id="bd">
				<div  class="yui-b" id="sourceContainer"></div>
				<div id="yui-main"> 
					<div  class="yui-b"  id="invoiceContainer"></div>
				</div>
			</div>
			<div id="ft">
			<h2>Comments</h2>
			<p>This sample has several features, more than I intended initially, but here they go.</p>
			<p>It has a source table on the left containing items and their prices.  
			They can be dragged and dropped into the table on the right which is an invoice.
			Part numbers are unique.  If the same item is dropped in the destination, the quantity is increased in one.
			Initially all invoiced items have a quantity of 1.  This cell is editable with the
			DataTable's in-line cell editor.  Any quantity can be entered, even fractional and the totals
            immediately refreshed.   </p>
			<p>There is also a discount cell which can also be edited and the given discount immediately applied.</p>
			<h3>Drag and drop between tables</h3>
			<p>First obvious thing is the drag and drop capability.  It has DataTables both as source and as destination.  
			The rows drop wherever you place them in the destination table. The code is mostly a copy of a 
			<a href="http://blog.davglass.com/files/yui/datatable4/">sample</a> by Dav Glass. 
			An array <code>recordRefs</code> is built for the destination DataTable that points to each record, 
			indexed by the unique part number.  When an item is about to be dropped, this array is checked and if there
			is already a record for that item in the invoice, the <code>qty</code> field is incremented by one.
			The updated record will be highlighted for a little while so the user sees what has happened.</p>
			<h3>Summary in TFOOT element</h3>
			<p>The subtotal, discount and total rows are placed in the <code>TFOOT</code> element of the HTML table and are not under the control 
			of the DataTable, it doesn't know they are there, it doesn't mess with them, it leaves them alone so we are free to
			use that section.  Initially I draw this by setting the HTML for this into the <code>innerHTML</code> property of the <code>TFOOT</code> element. 
			In Firefox it worked, in IE it didn't so I had to go through all the DOM nonsense which works for both.</p>
			<h3>Off-table in-line cell editor</h3>
			<p>Funny title that.  The discount field is actually off the DataTable, nevertheless I tricked it to pop-up the 
			in-line cell editor in a cell which is outside its area.  To do that, I faked a <code>Record</code> and a <code>Column</code>, which, along the
			cell to be edited, are all the <code>showCellEditor</code> method needs.  Search for showCellEditor in the source and you'll see how I managed.</p>
			<h3>Editor with Regular Expression validator</h3>
			<p>One of the <code>editorOptions</code> properties is <code>validator</code> which is all and good, but a little late.  
			The function validates the string you entered into the input box once you have hit the Ok button. 
			At that point, if the validation fails, the value will be returned as <code>null</code> and you loose what you entered and what was initially there.  
			In the meantime you were able to enter any sort of funny characters and only at the end you get busted.</p>
			<p>It would be much better if the validation happened while the keys are being pressed.  
			I made my own cell editor, <code>YAHOO.widget.DataTable.editRegExp</code> which takes an <code>editorOptions.regExp</code> property
			against which the entry is validated at each keypress.  I tested it on FireFox and IE, I'm not sure how it would work in others.  You try, here it is:</p>
			<div id="SSNcontainer" style="margin:1em 3em"></div>
			<p>The little box above is an editable DataTable with just one field, an American-style Social Security Number (SSN).  
			The column definition for that field looks like this:</p>
<pre>{
	key:'SSN',
	formatter:function(el, oRecord, oColumn, oData) {
		el.innerHTML = oData;
		if (/^\d{3}-\d{2}-\d{4}$/.test(oData)) {
			YAHOO.uti.Dom.removeClass(el,'yellow');
		} else {
			YAHOO.uti.Dom.addClass(el,'yellow');
		}
	},
	editor:YAHOO.widget.DataTable.editRegExp,
	editorOptions:{
		regExp:'^\\d{0,3}-?\\d{0,2}-?\\d{0,4}$',
		finalRegExp:'^\\d{3}-\\d{2}-\\d{4}$',
		failedRegExpClassName:'yellow'
	}
}</pre>
			<p>The column has a <code>formatter</code> function which simply copies the data into the cell 
			and it also tests it against a regular expression for a valid SSN and changes the style of the cell accordingly.  
			The <code>yellow</code> style simply sets a yellow background color. 
			The <code>editor</code> is set to my <code>editRegExp</code> editor and right after comes a bunch of <code>editorOptions</code>.  
			The first <code>regExp</code> takes 0 to 3 digits, an optional hyphen, then up to two more digits, another optional hyphen and up to four digits.  
			This expression is full of optionals, actually, an empty string is valid.  
			This is because while you are entering the data you have to admit partial entries.  
			The second expression, <code>finalRegExp</code> has no optionals.  
			It requires a specific number of digits and it requires the hyphens.  
			It is the same as used in the <code>formatter</code> and it does the same.  
			When the value tested against that regular expression fails, the style will be set to that given in <code>failedRegExpClassName</code>.</p>
			
			<p>Notice that the final regular expression does not prevent invalid data to be accepted, that is the job of the <code>validator</code>
			function, it just allows for a visual clue to the user that the data is not yet complete.  Also notice that the <code>validator</code> 
			function is also the place to do the final conversion of the text entered in the editor into the correct internal data type.  
			In the editable boxes for the invoice DataTable I have set <code>validator:YAHOO.widget.DataTable.validateNumber</code> to turn
			the quantities and discount into actual numbers.</p>
			<p>
			It is important that the regular expressions starts with a caret (^) and end with a dollar sign ($) so that it checks the full contents
			of the field from start to end.  I might have forced those two in the function but I can't imagine what regExp magic someone might want
			to make with it so I left them out.</p>
			<h3>Stingy with names</h3>
			<p>I've been an absolute miser with names.  No DataSource got named, no column definitions got named.  
			As much as possible I defined functions in-line not giving them names.  Is this a good style?  I'm not sure.  
			It can be done and it is perfectly legal JavaScript. Whether it is good style or not, that's kind of philosophical.
			I just wanted to see if it worked, and it does.  I certainly have nothing against modular programming and code reuse,
			but if some piece of code won't be used ever again, breaking up functionality into zillion of little functions
			with enormously long self-explanatory names (which often fail to explain enough, anyway) and then jumping 
			jump back and forth through the code to find where each little piece was defined is not my thing.</p>
			<h3>Shortcuts and hidden names</h3>
			<p>The whole code for this example is enclosed in an anonymous function that, since it doesn't have a name, can't be called 
			from anywhere, but it has a set of parenthesis at the end so it will be executed as soon as it has been defined (there is a further
			set of parenthesis enclosing the whole thing just because there is an ambiguity in the parser that gets it thoroughly confused, 
			and the extra parenthesis helps the parser).  Anyway, the cool thing about this is that all the variables declared within that
			anonymous function are local to that function, meaning, they can't be seen from outside.  That allows for much shorter variable names
			since they don't have to be qualified with an existing full namespace (such as <code>YAHOO.example</code>) or one that you have to 
			define.  Nevertheless, code within that function has full access to those variables declared outside of the function, which is the 
			global namespace. Thus, any reference to YAHOO within the anonymous function will be resolved to the global YAHOO namespace.  </p>
			
			<p>A method such as <code>YAHOO.widget.DataTable.prototype.refreshRow</code>, though declared within the anonymous function,
			gets into the global YAHOO namespace since the first part, <code>YAHOO</code>, is already global and the anonymous function has
			access to it and all the rest falls within it.</p>
			
			<p>This name hiding game also allows us to define handy shortcuts to often used named entities.  It is quite anoying to write
			<code>YAHOO.widget.DataTable</code> over and over again.  Within the anonymous function we can declare <code>$DT</code> to
			be a reference (or alias, if you wish) to the whole of <code>YAHOO.widget.DataTable</code>.  This will not only save time for you when 
			writing code but save time for the interpreter in trying to resolve such a complex hierarchy of names.  <code>$DT</code>, then, becomes
			a shortcut which benefits both you and the interpreter and since it is declared as a local variable within the anonymous function, it doesn't
			contaminate the global namespace.</p>
			
			<p>There is a whole bunch of such shortcuts at the beginning of the code.  Just as the use of an underscore ( _ ) character at the begining
			of a variable name is conventionally reserved for private variables, the dollar sign ( $ ) is reserved for such shortcuts and, specially
			the <code>$()</code> function (yes, it is a completely valid name) is reserved for <code>YAHOO.util.Dom.get()</code> making it the 
			shortest shortcut, the shortcutests?.</p>
			
			</div>
		</div>
	</body>
</html>
