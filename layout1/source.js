(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myPanel;

    Event.onDOMReady(function() {
	 		startTime();
        var layout = new YAHOO.widget.Layout({
            units: [
                { position: 'top', height: 100, resize: false, body: 'hdr', collapse: false, resize: false },
                { position: 'left', width: 200, resize: false, body: 'lhs', collapse: false, close: false, collapseSize: 50, scroll: true, animate: true },
                { position: 'center', body: 'center1' }
            ]
        });
        layout.on('render', function() {
            //Simulate a fixed center setting.
            var c = layout.getSizes().center;
            var l = ((c.l + (c.w / 2)) - 200), t = ((c.t + (c.h / 2)) - 90);

			myPanel = new YAHOO.widget.Panel("panel1", {
				width:"400px", 
				//fixedcenter: true, //Removed this setting
				//constraintoviewport: true, //Removed this setting
				underlay:"shadow", 
				close:true, 
				visible:false, 
				draggable:true,
                xy: [l, t]
            });
			//If we haven't built our panel using existing markup,
			//we can set its content via script:
			myPanel.setHeader("The Panel");
			myPanel.setBody("This is a draggable panel .... where will it stop??<br>Now<br>is<br>time");
			//Although we configured many properties in the
			//constructor, we can configure more properties or 
			//change existing ones after our Panel has been
			//instantiated:
			myPanel.cfg.setProperty("underlay","matte");
			myPanel.render();
			myPanel.show();
            //Hook into the startDragEvent and set the constraints AFTER Container does it's thing
            myPanel.dd.on('startDragEvent', constrainPanel);
            constrainPanel();
        });
        /*
        * Code pulled from region example:
        * http://developer.yahoo.com/yui/examples/dragdrop/dd-region.html
        */
        var constrainPanel = function() {
            //Reference to the DD object
            var dd = myPanel.dd;
            //Reference to the sizes object for the center unit
            var region = layout.getSizes().center;
            var el = dd.getEl();
            //Reset the Constriants that panel mucked with
            dd.resetConstraints();
            
            var width = parseInt(Dom.getStyle(el, 'width'), 10); 
            var height = parseInt(Dom.getStyle(el, 'height'), 10);


            //Get the xy position of it
            var xy = Dom.getXY(el);

            //Set left to x minus left
            var left = xy[0] - region.l;

            //Set right to right minus x minus width
            var right = (region.l + region.w) - xy[0] - width;

            //Set top to y minus top
            var top = xy[1] - region.t;

            //Set bottom to bottom minus y minus height
            var bottom = (region.t + region.h) - xy[1] - height;

            //Set the constraints based on the above calculations
            dd.setXConstraint(left, right);
            dd.setYConstraint(top, bottom);
        };
        layout.on('resize', constrainPanel);
        layout.render();
    });
})();
