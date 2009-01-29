(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        cal1,
        over_cal = false,
        cur_field = '';

    var init = function() {
        cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
        cal1.selectEvent.subscribe(getDate, cal1, true);
        cal1.renderEvent.subscribe(setupListeners, cal1, true);
        Event.addListener(['cal1Date1', 'cal1Date2', 'cal1Date3'], 'focus', showCal);
        Event.addListener(['cal1Date1', 'cal1Date2', 'cal1Date3'], 'blur', hideCal);
        cal1.render();
        dp.SyntaxHighlighter.HighlightAll('code'); 
    }

    var setupListeners = function() {
        Event.addListener('cal1Container', 'mouseover', function() {
            over_cal = true;
        });
        Event.addListener('cal1Container', 'mouseout', function() {
            over_cal = false;
        });
    }

    var getDate = function() {
            var calDate = this.getSelectedDates()[0];
            calDate = (calDate.getMonth() + 1) + '/' + calDate.getDate() + '/' + calDate.getFullYear();
            cur_field.value = calDate;            
            over_cal = false;
            hideCal();
    }

    var showCal = function(ev) {
        var tar = Event.getTarget(ev);
        cur_field = tar;
    
        var xy = Dom.getXY(tar),
            date = Dom.get(tar).value;
        if (date) {
            cal1.cfg.setProperty('selected', date);
            cal1.cfg.setProperty('pagedate', new Date(date), true);
        } else {
            cal1.cfg.setProperty('selected', '');
            cal1.cfg.setProperty('pagedate', new Date(), true);
        }
        cal1.render();
        Dom.setStyle('cal1Container', 'display', 'block');
        xy[1] = xy[1] + 20;
        Dom.setXY('cal1Container', xy);
    }

    var hideCal = function() {
        if (!over_cal) {
            Dom.setStyle('cal1Container', 'display', 'none');
        }
    }

    Event.addListener(window, 'load', init);

})();
