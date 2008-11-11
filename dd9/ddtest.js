

(function() {

    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        DD = YAHOO.util.DD;

    var iframeDoc = Dom.get('testFrame').contentWindow.document;

    Event.addListener(iframeDoc, 'mouseup', function(ev) {
        var oEvent = document.createEvent("MouseEvents");
        oEvent.initEvent('mouseup', true, true);
        document.dispatchEvent(oEvent);
    });
    Event.addListener(iframeDoc, 'mousemove', function(ev) {
        e = document.createEvent("MouseEvents");
        var x = Event.getPageX(ev);
        var y = Event.getPageY(ev);
        //console.log('X: ' + x + ' - Y: ' + y);


        e.initMouseEvent('mousemove', true, true, window, 1, ((x + 50) - 50), ((y + 50) - 50), ((x + 50) - 50), ((y + 50) - 50), false, false, false, false, 0, null);
        //console.log(oEvent);
        document.dispatchEvent(e);
    });
        Event.addListener(iframeDoc, 'mousedown', function(ev) {
            //console.log('mousedown in frame');
            var oEvent = document.createEvent("MouseEvents");
            oEvent.initEvent('mousedown', true, true);
            document.dispatchEvent(oEvent);
        });


        var dd1 = new DD('dd1');
        
        var dd2Dom = iframeDoc.getElementById('dd2');
        var dd2 = new DD(dd2Dom);
        dd2.onDrag = function(ev) {
            console.log(ev);
            var x = Event.getPageX(ev);
            var y = Event.getPageY(ev);
            console.log(x + ': ' + y);
            if (this._cloned) {
                
                var xy = YAHOO.util.Dom.getXY(this._domRef);
                xy[0] = xy[0] + 50;
                xy[1] = xy[1] + 50;
                YAHOO.util.Dom.setXY(dd2Clone, xy);
                
            } else {
                /*
                var left = 50;
                var right = 200;
                var top = 50;
                var bottom = 200;

                if ((x < left) || (x > right) || (y < top) || (y > bottom)) {
                    console.log('sides touched - clone and hide');
                    if (!dd2._cloned) {
                        dd2Clone = dd2Dom.cloneNode(true);
                        dd2._cloned = true;
                        document.body.appendChild(dd2Clone);
                        Dom.setXY(dd2Clone, [x, y]);
                        Dom.setStyle(dd2Dom, 'background-color', 'yellow');
                        this.setOuterHandleElId(dd2Clone);
                    }
                }
                */
                dd2Clone = dd2Dom.cloneNode(true);
                dd2._cloned = true;
                document.body.appendChild(dd2Clone);
                Dom.setXY(dd2Clone, [x, y]);
                Dom.setStyle(dd2Dom, 'background-color', 'yellow');
                this.setOuterHandleElId(dd2Clone);
                YAHOO.util.Dom.setStyle(dd2Dom, 'visibility', 'hidden');
            }
        }
        dd2._domRef = dd2Dom;
        dd2.available = true;
        Event.on(dd2Dom, "mousedown", dd2.handleMouseDown, dd2, true);
        dd2.getDragEl = function() {
            return dd2Dom;
        }

        /* DD Overrided {{{
    dd2.alignElWithMouse = function(el, iPageX, iPageY) {
        var oCoord = this.getTargetCoord(iPageX, iPageY);
        console.log("****alignElWithMouse : " + el.id + ", " + aCoord + ", " + el.style.display);

        if (!this.deltaSetXY) {
            var aCoord = [oCoord.x, oCoord.y];
            YAHOO.util.Dom.setXY(el, aCoord);
            var newLeft = parseInt( YAHOO.util.Dom.getStyle(el, "left"), 10 );
            var newTop  = parseInt( YAHOO.util.Dom.getStyle(el, "top" ), 10 );

            this.deltaSetXY = [ newLeft - oCoord.x, newTop - oCoord.y ];
        } else {
            YAHOO.util.Dom.setStyle(el, "left", (oCoord.x + this.deltaSetXY[0]) + "px");
            YAHOO.util.Dom.setStyle(el, "top",  (oCoord.y + this.deltaSetXY[1]) + "px");
        }
        
        this.cachePosition(oCoord.x, oCoord.y);
        this.autoScroll(oCoord.x, oCoord.y, el.offsetHeight, el.offsetWidth);
    }
    dd2.getTargetCoord = function(iPageX, iPageY) {

        console.log("getTargetCoord: " + iPageX + ", " + iPageY);

        var x = iPageX - this.deltaX;
        var y = iPageY - this.deltaY;

        if (this.constrainX) {
            if (x < this.minX) { x = this.minX; }
            if (x > this.maxX) { x = this.maxX; }
        }

        if (this.constrainY) {
            if (y < this.minY) { y = this.minY; }
            if (y > this.maxY) { y = this.maxY; }
        }

        x = this.getTick(x, this.xTicks);
        y = this.getTick(y, this.yTicks);

        console.log("getTargetCoord " + 
                 " iPageX: " + iPageX +
                 " iPageY: " + iPageY +
                 " x: " + x + ", y: " + y);

        return {x:x, y:y};
    }
    dd2.b4Drag = function(e) {
        console.log(e);
        this.setDragElPos(YAHOO.util.Event.getPageX(e), 
                            YAHOO.util.Event.getPageY(e));
    }
        }}}*/
        
        //console.log(dd2);
        



    Event.addListener(document, 'mousedown', function() {
        //console.log('MouseDown in parent Document');
    });
    Event.addListener(document, 'mouseup', function(ev) {
        //console.log(ev);
        //console.log('MouseUp in parent Document');
    });

})();
