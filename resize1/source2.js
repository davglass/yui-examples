(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        Event.onDOMReady(function() {
            // Setup constants
            var mask = null, ifrm = null;
            // QUIRKS FLAG, FOR BOX MODEL
            var IE_QUIRKS = (YAHOO.env.ua.ie && document.compatMode == "BackCompat");

            // UNDERLAY/IFRAME SYNC REQUIRED
            var IE_SYNC = (YAHOO.env.ua.ie == 6 || (YAHOO.env.ua.ie == 7 && IE_QUIRKS));

            // PADDING USED FOR BODY ELEMENT (Hardcoded for example)
            var PANEL_BODY_PADDING = (10*2) // 10px top/bottom padding applied to Panel body element. The top/bottom border width is 0

            // Create a panel Instance, from the 'resizablepanel2' DIV standard module markup
            var panel = new YAHOO.widget.Panel('resizablepanel2', {
                draggable: true,
                close: false,
                width: '500px',
                underlay: 'none',
                y: 400
            });
            panel.renderEvent.subscribe(function() {
                YAHOO.util.Dom.setStyle(this.body.getElementsByTagName('iframe'), 'overflow', 'auto');
                mask = Dom.getElementsByClassName('resize-mask', 'div', panel.element)[0];
                ifrm = panel.element.getElementsByTagName('iframe')[0];
            }, panel, true);
            panel.render();

            // Create Resize instance, binding it to the 'resizablepanel' DIV 
            var resize = new YAHOO.util.Resize('resizablepanel2', {
                autoRatio: false,
                minWidth: 300,
                minHeight: 100,
                status: true
            });
            //This fixes a position issue with IE6 and overflow hidden
            if (YAHOO.env.ua.ie == 6) {
                Dom.setStyle(resize._handles.r, 'height', (panel.element.offsetHeight - 5) + 'px');

                resize.on('startResize', function() {
                    Dom.setStyle(mask, 'height', panel.body.offsetHeight + 'px');
                    Dom.setStyle(mask, 'width', panel.body.offsetWidth + 'px');
                });
            }

            // Setup resize handler to update the size of the Panel's body element
            // whenever the size of the 'resizablepanel2' DIV changes
            resize.on('resize', function(args) {

                var panelHeight = args.height;
                var panelWidth = args.width;
                if (!panelHeight) {
                    panelHeight = resize._cache.height;
                }
                if (!panelWidth) {
                    panelWidth = resize._cache.width;
                }

                var headerHeight = this.header.offsetHeight; // Content + Padding + Border
                var footerHeight = this.footer.offsetHeight; // Content + Padding + Border

                var bodyHeight = (panelHeight - headerHeight - footerHeight);
                var bodyContentHeight = (IE_QUIRKS) ? bodyHeight : bodyHeight - PANEL_BODY_PADDING;
                var bodyContentWidth = (IE_QUIRKS) ? panelWidth : panelWidth - PANEL_BODY_PADDING;

                Dom.setStyle(this.body, 'height', bodyContentHeight + 'px');
                Dom.setStyle(this.body, 'width', bodyContentWidth + 'px');

                if (YAHOO.env.ua.ie == 6) {
                    Dom.setStyle(resize._handles.r, 'height', (this.element.offsetHeight - 5) + 'px');
                    Dom.setStyle(mask, 'height', bodyHeight + 'px');
                    Dom.setStyle(mask, 'width', panelWidth + 'px');

                    Dom.setStyle(ifrm, 'height', bodyContentHeight + 'px');
                    Dom.setStyle(ifrm, 'width', bodyContentWidth + 'px');
                }

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

