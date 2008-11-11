(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Sel = YAHOO.util.Selector;
    
    Event.onDOMReady(function() {
        //Static var to keep track of the elements we click on
        var items = {},
            multi = false,
            dd = null,
            target = new YAHOO.util.DDTarget('drop'),
            target2 = new YAHOO.util.DDTarget('drop2');
        
        //Give the drag items an id
        Dom.generateId(Sel.query('#play div.drag'));

        Event.on('play', 'mousedown', function(ev) {
            var tar = Event.getTarget(ev);
            if (Sel.test(tar,'#play div.drag')) {
                Event.stopEvent(ev);
                //If the shift key is pressed, add it to the list
                if (ev.shiftKey) {
                    if (!items[tar.id]) {
                        multi = true;
                        Dom.addClass(tar, 'selected');
                        items[tar.id] = tar;
                    } else {
                        Dom.removeClass(tar, 'selected');
                        delete items[tar.id];
                    }
                } else {
                    tar.innerHTML = 'Dragging me..';
                    dd = new YAHOO.util.DD(tar);
                    dd.on('invalidDropEvent', function() {
                        if (multi) {
                            for (var i in items) {
                                Dom.removeClass(items[i], 'selected');
                                items[i].style.top = '';
                                items[i].style.left = '';
                            }
                        } else {
                            tar.style.top = '';
                            tar.style.left = '';
                        }
                        tar.innerHTML = 'Draggable';
                        dd.unreg();
                        items = {};
                        multi = false;
                    });
                    dd.on('dragDropEvent', function(e) {
                        var id = e.info,
                        node = Dom.get(id);
                        if (multi) {
                            for (var i in items) {
                                node.appendChild(items[i]);
                                items[i].style.top = '';
                                items[i].style.left = '';
                                items[i].innerHTML = 'Dropped';
                            }
                        } else {
                            node.appendChild(tar);
                            tar.style.top = '';
                            tar.style.left = '';
                            tar.innerHTML = 'Dropped';
                        }
                        dd.unreg();
                        items = {};
                        multi = false;
                    });
                    dd.on('dragEvent', function(ev) {
                        //Get the pageXY of the event with the deltas setup by DragDrop
                        var xy = [Event.getPageX(ev.e) - this.deltaX, Event.getPageY(ev.e) - this.deltaY];
                        var offset = 5;
                        //Create a visual offset
                        for (var i in items) {
                            //Skip the item that we attached the dragDrop event to
                            if (items[i] != tar) {
                                //Purely a visual thing to offset the dragged elements
                                var offsetXY = [xy[0] - offset, xy[1] - offset];
                                Dom.setXY(items[i], offsetXY);
                                //Reset the offset
                                offset = (((offset * 2) > 20) ? 0 : (offset * 2));
                            }
                        }
                    });
                    dd.handleMouseDown(ev);
                }
            }

        });


    });

})();
