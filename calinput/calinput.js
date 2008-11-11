

YAHOO.widget.CalInput = function(elmName) {
    this.element = $(elmName);
    this.topcontid = 'cal_cont_' + this.element.id;
    this.calid = 'cal_holder_' + this.element.id;
    this.showing = false;
}

YAHOO.widget.CalInput.prototype.render = function() {
    console.log('Render: ' + this.element);
    $D.addClass(this.element, 'yui_calinput');
    $E.addListener(this.element, 'focus', this._focus, this, true);
    this.container = new YAHOO.widget.Panel(this.topcontid, {
        visible: false,
        close: true,
        iframe: true,
        context: [this.element, 'tl', 'bl'],
        draggable: false,
        underlay: 'none',
        position: 'absolute'
    });
    this.container.setBody('<div id="' + this.calid + '"></div>');
    this.container.render(document.body);
    $E.onAvailable(this.calid, this._buildCal, this, true);
}

YAHOO.widget.CalInput.prototype._buildCal = function() {
    this.cal = new YAHOO.widget.Calendar(this.calid, this.calid);
    this.cal._element = this.element;
    this.cal._container = this.container;
    this.cal.onSelect = function() {
        var calDate = this.getSelectedDates()[0];
        calDate = (calDate.getMonth() + 1) + '/' + calDate.getDate() + '/' + calDate.getFullYear();
        this._element.value = calDate;
        this._container.hide();
    }
    this.cal.render();
}

YAHOO.widget.CalInput.prototype._focus = function() {
    this.container.cfg.setProperty('width',$D.getStyle(this.calid, 'width'));
    this.container.show();
    this.showing = true;
}
YAHOO.widget.CalInput.prototype._blur = function() {
    if (this.showing) {
        this.container.hide();
    }
    this.showing = false;
}

/*
var cal1;
var over_cal = false;
function init() {
    cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
    cal1.onSelect = function() {
        var calDate = cal1.getSelectedDates()[0];
        calDate = (calDate.getMonth() + 1) + '/' + calDate.getDate() + '/' + calDate.getFullYear();
        YAHOO.util.Dom.get('cal1Date').value = calDate;
        over_cal = false;
        hideCal();
    }
    cal1.render();
    YAHOO.util.Event.addListener('cal1Date', 'focus', showCal);
    YAHOO.util.Event.addListener('cal1Date', 'blur', hideCal);
    YAHOO.util.Event.addListener('cal1Container', 'mouseover', overCal);
    YAHOO.util.Event.addListener('cal1Container', 'mouseout', outCal);
}

function showCal() {
    YAHOO.util.Dom.setStyle('cal1Container', 'display', 'block');
}
function hideCal() {
    if (!over_cal) {
        YAHOO.util.Dom.setStyle('cal1Container', 'display', 'none');
        //YAHOO.util.Dom.get('cal1Date').value = cal1.getSelectedDates();
    }
}
function overCal() {
    over_cal = true;
}
function outCal() {
    over_cal = false;
}
init();
*/
