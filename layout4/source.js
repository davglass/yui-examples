(function() {
    var Dom = YAHOO.util.Dom,
    Event = YAHOO.util.Event,
    layout = null,
    resize = null,
    tabDemo = null;
   
    Event.onDOMReady(function() {
        // Setup constants
       
        // QUIRKS FLAG, FOR BOX MODEL
        var IE_QUIRKS = (YAHOO.env.ua.ie && document.compatMode == "BackCompat");
       
        // UNDERLAY/IFRAME SYNC REQUIRED
        var IE_SYNC = (YAHOO.env.ua.ie == 6 || (YAHOO.env.ua.ie == 7 && IE_QUIRKS));
       
        // PADDING USED FOR BODY ELEMENT (Hardcoded for example)
        var PANEL_BODY_PADDING = (10*2) // 10px top/bottom padding applied to Panel body element. The top/bottom border width is 0
       
        var panel = new YAHOO.widget.Panel('demo', {
            draggable: true,
            close: false,
            underlay: 'none',
            width: '500px',
            xy: [5, 5]
        });
        panel.setHeader('<div style="background: white;"><img src="http://localhost:8080/visionary/images/HARP_Logo.jpg"> <b>Visionary</b></div>');
        panel.setBody('<div id="layout"></div>');
        panel.beforeRenderEvent.subscribe(function() {
            Event.onAvailable('layout', function() {
                layout = new YAHOO.widget.Layout('layout', {
                    height: 400,
                    width: 480,
                    units: [
                        { position: 'top', height: 25, resize: false, body: 'Top', gutter: '2' },
                        //{ position: 'left', width: 150, resize: true, body: 'Left', gutter: '0 5 0 2', minWidth: 150, maxWidth: 300 },
                        { position: 'bottom', height: 25, body: 'Bottom', gutter: '2' },
                        { position: 'center', body: '<div id="tabDemo"></div>', scroll: true, gutter: '0 2 0 2' }
                    ]
                });
               
                // Create tabbed content panel inside the Layout Pane

                //Changed this line, we need to render the TabView on Layout render not panel, because
                //the layout get's rendered AFTER the panel does so tabDemo doesn't exist here.
                //panel.beforeRenderEvent.subscribe(function() {
                layout.on('render', function() {
                    Event.onAvailable('tabDemo', function() {
                       
                        var tabDemo = new YAHOO.widget.TabView("tabDemo");
                        tabDemo.addTab( new YAHOO.widget.Tab({
                            label: 'User',
                            content: '<p>User tab content.</p>',
                            active: true
                        }));
                       
                        tabDemo.addTab( new YAHOO.widget.Tab({
                            label: 'Melee',
                            content: '<p>Melee tab content.</p>'
                        }));
                       
                        tabDemo.addTab( new YAHOO.widget.Tab({
                            label: 'Encounter',
                            content: '<p>Encounter tab content.</p>'
                        }));
                        //TabView doesn't have a render method
                       //tabDemo.render();
                       //No reason to move the TabView instance since it's already been placed inside the center unit.
                       //tabDemo.appendTo(centerUnit.body);
                    });                       
                });
                layout.render();
                var centerUnit = layout.getUnitByPosition('center');
            });
        });
       
        panel.render();
        resize = new YAHOO.util.Resize('demo', {
            handles: ['br'],
            autoRatio: true,
            status: true,
            minWidth: 380,
            minHeight: 400
        });
        resize.on('resize', function(args) {
            var panelHeight = args.height;
            var headerHeight = this.header.offsetHeight; //Content + Padding + Border
            var bodyHeight = (panelHeight - headerHeight);
            var bodyContentHeight = (IE_QUIRKS) ? bodyHeight : bodyHeight - PANEL_BODY_PADDING;
           
            YAHOO.util.Dom.setStyle(this.body, 'height', bodyContentHeight + 'px');
           
            if (IE_SYNC) {
               
                // Keep the underlay and iframe size in sync.
                // You could also set the width property, to achieve the
                // same results, if you wanted to keep the panel's internal
                // width property in sync with the DOM width.
                this.sizeUnderlay();
               
                // Syncing the iframe can be expensive. Disable iframe if you
                // don't need it.
               
                this.syncIframe();
            }
           
            layout.set('height', bodyContentHeight);
            layout.set('width', (args.width - PANEL_BODY_PADDING));
            layout.resize();
           
        }, panel, true);
    });
})();
