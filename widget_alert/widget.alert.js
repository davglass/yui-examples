(function() {
    YAHOO.namespace('widget.alert');

    alert_old = window.alert;
    window.alert = function(str) {
        YAHOO.widget.alert.dlg.setBody(str);
        YAHOO.widget.alert.dlg.cfg.queueProperty('icon', YAHOO.widget.SimpleDialog.ICON_WARN);
        YAHOO.widget.alert.dlg.cfg.queueProperty('zIndex', 9999);
        YAHOO.widget.alert.dlg.render(document.body);
        if (YAHOO.widget.alert.dlg.bringToTop) {
            YAHOO.widget.alert.dlg.bringToTop();
        }
        YAHOO.widget.alert.dlg.show();
    };


    YAHOO.util.Event.on(window, 'load', function() {

        var handleOK = function() {
            this.hide();
        };

        YAHOO.widget.alert.dlg = new YAHOO.widget.SimpleDialog('widget_alert', {
            visible:false,
            width: '20em',
            zIndex: 9999,
            close: false,
            fixedcenter: true,
            modal: false,
            draggable: true,
            constraintoviewport: true, 
            icon: YAHOO.widget.SimpleDialog.ICON_WARN,
            buttons: [
                { text: 'OK', handler: handleOK, isDefault: true }
                ]
        });
        YAHOO.widget.alert.dlg.setHeader("Alert!");
        YAHOO.widget.alert.dlg.setBody('Alert body passed to window.alert'); // Bug in panel, must have a body when rendered
        YAHOO.widget.alert.dlg.render(document.body);
    });
})();
