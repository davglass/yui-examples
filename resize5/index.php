<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Resize: Panel: Multiple</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }

    #resizablepanel .bd, #resizablepanel2 .bd {
        overflow:auto;
        height:10em;
        background-color:#fff;
        padding:10px;
    }

    #resizablepanel .ft, #resizablepanel2 .ft {
        height:15px;
        padding:0;
    }

    #resizablepanel .yui-resize-handle-br, #resizablepanel2 .yui-resize-handle-br {
        right:0;
        bottom:0;
        height: 8px;
        width: 8px;
        position:absolute;
    }

    /*  
        The following CSS is added to prevent scrollbar bleedthrough on
        Gecko browsers (e.g. Firefox) on MacOS.
    */

    /*
        PLEASE NOTE: It is necessary to toggle the "overflow" property 
        of the body element between "hidden" and "auto" in order to 
        prevent the scrollbars from remaining visible after the the 
        Resizable Panel is hidden.  For more information on this issue, 
        read the comments in the "container-core.css" file.
       
        We use the #reziablepanel_c id based specifier, so that the rule
        is specific enough to over-ride the .bd overflow rule above.
    */

    #resizablepanel_c.hide-scrollbars .yui-resize .bd, #resizablepanel2_c.hide-scrollbars .yui-resize .bd {
        overflow: hidden;
    }

    #resizablepanel_c.show-scrollbars .yui-resize .bd, #resizablepanel2_c.show-scrollbars .yui-resize .bd {
        overflow: auto;
    }

    /*
        PLEASE NOTE: It is necessary to set the "overflow" property of
        the underlay element to "visible" in order for the 
        scrollbars on the body of a Resizable Panel instance to be 
        visible.  By default the "overflow" property of the underlay 
        element is set to "auto" when a Panel is made visible on
        Gecko for Mac OS X to prevent scrollbars from poking through
        it on that browser + platform combintation.  For more 
        information on this issue, read the comments in the 
        "container-core.css" file.
    */

    #resizablepanel_c.show-scrollbars .underlay, #resizablepanel2_c.show-scrollbars .underlay {
        overflow: visible;
    }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Resize: Panel: Multiple</a></h1></div>
    <div id="bd">


        <div id="resizablepanel">
            <div class="hd">Resizable Panel</div>
            <div class="bd">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse nulla. Fusce mauris massa, rutrum eu, imperdiet ut, placerat at, nunc. Vestibulum consequat ligula ut lacus. Nulla nec pede. Fusce consequat, augue et eleifend ornare, nibh mi dapibus lorem, ut lacinia turpis eros at eros. Proin laoreet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla velit. Fusce id sem sit amet felis porta mollis. Aliquam erat volutpat. Etiam tortor. Donec dui felis, pretium quis, vulputate et, molestie non, nisi.</p>
            </div>
            <div class="ft"></div>
        </div>

        <div id="resizablepanel2">
            <div class="hd">Resizable Panel II</div>
            <div class="bd">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse nulla. Fusce mauris massa, rutrum eu, imperdiet ut, placerat at, nunc. Vestibulum consequat ligula ut lacus. Nulla nec pede. Fusce consequat, augue et eleifend ornare, nibh mi dapibus lorem, ut lacinia turpis eros at eros. Proin laoreet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla velit. Fusce id sem sit amet felis porta mollis. Aliquam erat volutpat. Etiam tortor. Donec dui felis, pretium quis, vulputate et, molestie non, nisi.</p>
            </div>
            <div class="ft"></div>
        </div>


    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/resize/resize-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
    YAHOO.util.Event.onDOMReady(function() {

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
                width: '500px',
                close: false,
                xy: [300, 150]
            });
            panel.render();

            // Create Resize instance, binding it to the 'resizablepanel' DIV 
            var resize = new YAHOO.util.Resize('resizablepanel', {
                handles: ['br'],
                autoRatio: false,
                minWidth: 300,
                minHeight: 100,
                status: true
            });

            // Create a panel Instance, from the 'resizablepanel' DIV standard module markup
            var panel2 = new YAHOO.widget.Panel('resizablepanel2', {
                draggable: true,
                width: '500px',
                close: false,
                xy: [200, 450]
            });
            panel2.render();

            // Create Resize instance, binding it to the 'resizablepanel' DIV 
            var resize2 = new YAHOO.util.Resize('resizablepanel2', {
                handles: ['br'],
                autoRatio: false,
                minWidth: 300,
                minHeight: 100,
                status: true
            });

            // Setup resize handler to update the size of the Panel's body element
            // whenever the size of the 'resizablepanel' DIV changes
            function calcResize(args) {

                var panelHeight = args.height;

                var headerHeight = this.header.offsetHeight; // Content + Padding + Border
                var footerHeight = this.footer.offsetHeight; // Content + Padding + Border

                var bodyHeight = (panelHeight - headerHeight - footerHeight);
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
        };
        resize.on('resize', calcResize, panel, true);
        resize2.on('resize', calcResize, panel2, true);
    });

    dp.SyntaxHighlighter.HighlightAll('code');

</script>
</body>
</html>
