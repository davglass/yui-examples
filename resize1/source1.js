(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        Event.onDOMReady(function() {
            // Setup constants

            // QUIRKS FLAG, FOR BOX MODEL
            var IE_QUIRKS = (YAHOO.env.ua.ie && document.compatMode == "BackCompat");

            // UNDERLAY/IFRAME SYNC REQUIRED
            var IE_SYNC = (YAHOO.env.ua.ie == 6 || (YAHOO.env.ua.ie == 7 && IE_QUIRKS));

            // PADDING USED FOR BODY ELEMENT (Hardcoded for example)
            var PANEL_BODY_PADDING = (10*2) // 10px top/bottom padding applied to Panel body element. The top/bottom border width is 0

            // Create a panel Instance, from the 'resizablepanel' DIV standard module markup
            var panel = new YAHOO.widget.Panel('resizablepanel', {
                draggable: true,
                close: false,
                width: '500px',
                underlay: 'none'
            });
            panel.renderEvent.subscribe(function() {
                YAHOO.util.Dom.setStyle(this.body.getElementsByTagName('iframe'), 'overflow', 'auto');
            }, panel, true);
            panel.render();

            // Create Resize instance, binding it to the 'resizablepanel' DIV 
            var resize = new YAHOO.util.Resize('resizablepanel', {
                autoRatio: false,
                minWidth: 300,
                minHeight: 100,
                status: true
            });
            //This fixes a position issue with IE6 and overflow hidden
            if (YAHOO.env.ua.ie == 6) {
                Dom.setStyle(resize._handles.r, 'height', (panel.element.offsetHeight - 5) + 'px');
            }

            // Setup resize handler to update the size of the Panel's body element
            // whenever the size of the 'resizablepanel' DIV changes
            resize.on('resize', function(args) {
                //This fixes a position issue with IE6 and overflow hidden
                if (YAHOO.env.ua.ie == 6) {
                    Dom.setStyle(resize._handles.r, 'height', (panel.element.offsetHeight - 5) + 'px');
                }

                var panelHeight = args.height;

                var headerHeight = this.header.offsetHeight; // Content + Padding + Border
                var footerHeight = this.footer.offsetHeight; // Content + Padding + Border

                var bodyHeight = (panelHeight - headerHeight - footerHeight);
                var bodyContentHeight = (IE_QUIRKS) ? bodyHeight : bodyHeight - PANEL_BODY_PADDING;

                YAHOO.util.Dom.setStyle(this.body, 'height', bodyContentHeight + 'px');
                YAHOO.util.Dom.setStyle(this.body.getElementsByTagName('iframe'), 'height', bodyContentHeight + 'px');

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
            }, panel, true);

        }
    );
})();

