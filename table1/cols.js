(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    cols = function() {
        this.constructor.superclass.constructor.apply(this, arguments);

        this.table = this.getEl().offsetParent;
        this.table2 = this.getEl().offsetParent.parentNode.getElementsByTagName('table')[1];
        this.initConstraints();
        this.rows = [];
    };

    YAHOO.extend(cols, YAHOO.util.DDProxy, {
        rows: null,
        afterEl: null,
        pointer: function() {
            var p = document.createElement('div');
            p.id = 'colPointer';
            p.className = 'pointer';
            p.style.display = 'none';
            document.body.insertBefore(p, document.body.firstChild);
            return p;
        }(),
        initConstraints: function() {
            //Get the top, right, bottom and left positions
            var region = Dom.getRegion(this.table),
                //Get the element we are working on
                el = this.getEl(),
                //Get the xy position of it
                xy = Dom.getXY(el),
                //Get the width and height
                width = parseInt(Dom.getStyle(el, 'width'), 10),
                height = parseInt(Dom.getStyle(el, 'height'), 10),
                //Set left to x minus left
                left = ((xy[0] - region.left) + 15), //Buffer of 15px
                //Set right to right minus x minus width
                right = ((region.right - xy[0] - width) + 15);

            //Set the constraints based on the above calculations
            this.setXConstraint(left, right);
            this.setYConstraint(10, 10);
            this.setPadding(0, 25, (this.table.parentNode.offsetHeight + 10) , 25);

            Event.on(window, 'resize', function() {
                this.initConstraints();
            }, this, true);
        },
        createFrame: function() {
            this.constructor.superclass.createFrame.apply(this, arguments);
        },
        _resizeProxy: function() {
            this.constructor.superclass._resizeProxy.apply(this, arguments);
            var dragEl = this.getDragEl(),
                el = this.getEl();
            Dom.setStyle(dragEl, 'height', Dom.getStyle(this.table.parentNode, 'height'));
            Dom.setStyle(dragEl, 'width', (parseInt(Dom.getStyle(dragEl, 'width')) + 4) + 'px');
            Dom.setStyle(dragEl, 'border', '');
            Dom.setStyle(dragEl, 'background-color', '#ccc');
            Dom.setStyle(dragEl, 'opacity', '.75');
            dragEl.innerHTML = '<table width="100%"><thead></thead><tbody></tbody></table>';

            Dom.setStyle(this.pointer, 'height', (this.table.parentNode.offsetHeight + 10) + 'px');
            Dom.setStyle(this.pointer, 'display', 'block');
            var xy = Dom.getXY(el);
            Dom.setXY(this.pointer, [xy[0], (xy[1] - 5)]);
        },
        startDrag: function() {
            var dragEl = this.getDragEl();

            var index = this.getEl().cellIndex;
            for (var i = 0; i < this.table2.rows.length; i++) {
                this.rows.push(this.table2.rows[i].cells[index]);
            }

            var t = dragEl.firstChild;
            var tr = document.createElement('tr');
            tr.appendChild(this.rows[0].cloneNode(true));
            t.tHead.appendChild(tr);
            for (var i = 1; i < this.rows.length; i++) {
                tr = document.createElement('tr');
                var td = this.rows[i].cloneNode(true);
                tr.appendChild(td);
                t.tBodies[0].appendChild(tr);
            }

            Dom.addClass(this.rows, 'hidden');
        },
        onDragOver: function(ev, id) {
            var mouseX = Event.getPageX(ev),
                targetX = Dom.getX(id),
                midX = targetX + ((Dom.get(id).offsetWidth)/2);
            
            if (mouseX < midX) {
                //Before
                this.afterEl = Dom.get(id);
                Dom.setX(this.pointer, targetX);
            } else {
                //After
                this.afterEl = this.table.rows[0].cells[Dom.get(id).cellIndex + 1];
                if (this.afterEl && this.afterEl.tagName && (this.afterEl.tagName.toLowerCase() == 'th')) {
                    targetX = Dom.getX(this.table.rows[0].cells[Dom.get(id).cellIndex + 1]);
                    Dom.setX(this.pointer, targetX);
                } else {
                    var thisWidth = parseInt(this.getEl().offsetWidth);
                    Dom.setX(this.pointer, (targetX + thisWidth));
                }
            }
        },
        moveRow: function(table, i, index, newIndex, insert) {
            var moveTD = table.rows[i].cells[index];
            if (insert) {
                var toTD = table.rows[i].cells[newIndex];
                setTimeout(function() {
                    moveTD.parentNode.insertBefore(moveTD, toTD);
                }, 0);
            } else {
                //End of table
                setTimeout(function() {
                    moveTD.parentNode.appendChild(moveTD);
                }, 0);
            }
        },
        onDragDrop: function() {
            var insert = false,
                newIndex = 0;
            if (this.afterEl && this.afterEl.tagName && (this.afterEl.tagName.toLowerCase() == 'th')) {
                insert = true;
                newIndex = this.afterEl.cellIndex;
            }
            var index = this.getEl().cellIndex;
            for (var i = 0; i < this.table2.rows.length; i++) {
                if (i == 0) {
                    this.moveRow(this.table, i, index, newIndex, insert);
                }
                if (i == 1) {
                    this.moveRow(this.table, i, index, newIndex, insert);
                }
                this.moveRow(this.table2, i, index, newIndex, insert);
            }
        },
        endDrag: function() {
            Dom.removeClass(this.rows, 'hidden');
            this.rows = [];
            this.afterEl = null;
            Dom.setStyle(this.pointer, 'display', 'none');
        }
    });

    Event.onDOMReady(function() {
        var table0 = Dom.get('table0');
        var table = Dom.get('table1');
        for (var t = 1; t < 21; t++) {
            var tr = document.createElement('tr');
            for (var d = 1; d < 11; d++) {
                var td = document.createElement('td');
                td.innerHTML = d + ' - ' + t;
                tr.appendChild(td);
            }
            table.tBodies[0].appendChild(tr);
        }
        var ths = table0.getElementsByTagName('th');

        for (var i = 0; i < ths.length; i++) {
            new cols(ths[i]);   
        }
    });


})();

