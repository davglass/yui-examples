/*
    Dav Glass
    <dav.glass@yahoo.com>
    http://davglass.com/
*/
YAHOO.widget.Gestures = {
    init: function(obj) {
        //init the object
        if (!obj) {
            alert('You must define a config object!');
            return false;
        }
        this.config = obj;
        if (!this.config.threshold) {
            this.config.threshold = 20;
        }
        this.config.enabled = true;
        YAHOO.util.Event.addListener(document, 'mousedown', YAHOO.widget.Gestures._mouseDown, YAHOO.widget.Gestures, true);
        YAHOO.util.Event.addListener(document, 'mouseup', YAHOO.widget.Gestures._mouseUp, YAHOO.widget.Gestures, true);
    },
    _mouseDown: function(ev) {
        this.config.down_x = YAHOO.util.Event.getPageX(ev);
        this.config.down_y = YAHOO.util.Event.getPageY(ev);
    },
    _mouseUp: function(ev) {
        var proc = false;
        this.config.up_x = YAHOO.util.Event.getPageX(ev);
        this.config.up_y = YAHOO.util.Event.getPageY(ev);
        if (this.config.enabled) {
            YAHOO.util.Event.stopEvent(ev);
            this.handle();
            
        }
    },
    disable: function() {
        this.config.enabled = false;
    },
    enable: function() {
        this.config.enabled = true;
    },
    handle: function() {
        var func = '';
        var offsetX = (this.config.down_x - this.config.up_x);
        if (this.config.up_x > this.config.down_x) {
            offsetX = (this.config.up_x - this.config.down_x);
        }
        var offsetY = (this.config.down_y - this.config.up_y);
        if (this.config.up_y > this.config.down_y) {
            offsetY = (this.config.up_y - this.config.down_y);
        }
        if (offsetY > this.config.threshold) {
            if (this.config.down_y > this.config.up_y) {
                func = 'up';
            }
            if (this.config.down_y < this.config.up_y) {
                func = 'down';
            }
        }
        if (offsetX > this.config.threshold) {
            if (this.config.down_x > this.config.up_x) {
                func += 'left';
            }
            if (this.config.down_x < this.config.up_x) {
                func += 'right';
            }
        }
        if (func != '') {
            var tmpFunc = eval('this.config.' + func);
            if (typeof tmpFunc == 'function') {
                tmpFunc();
            }
        }
        this.config.up_x = 0;
        this.config.up_y = 0;
        this.config.down_x = 0;
        this.config.down_y = 0;
    }
}
