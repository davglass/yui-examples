(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        dd1, dd2, dd3, topIndex = 0;


    YAHOO.example.DDRegion = function(id, sGroup, config) {
        this.cont = config.cont;
        YAHOO.example.DDRegion.superclass.constructor.apply(this, arguments);
    };

    YAHOO.extend(YAHOO.example.DDRegion, YAHOO.util.DD, {
        zIndex: null,
        cont: null,
        init: function() {
            //Call the parent's init method
            YAHOO.example.DDRegion.superclass.init.apply(this, arguments);
            this.initConstraints();
        },
        startDrag: function() {
            topIndex++;
            this.getDragEl().style.zIndex = topIndex;
        },
        initConstraints: function() {
            //Get the top, right, bottom and left positions
            var region = Dom.getRegion(this.cont);

            //Get the element we are working on
            var el = this.getEl();

            //Get the xy position of it
            var xy = Dom.getXY(el);

            //Get the width and height
            var width = parseInt(Dom.getStyle(el, 'width'), 10);
            var height = parseInt(Dom.getStyle(el, 'height'), 10);

            //Set left to x minus left
            var left = xy[0] - region.left;

            //Set right to right minus x minus width
            var right = region.right - xy[0] - width;

            //Set top to y minus top
            var top = xy[1] - region.top;

            //Set bottom to bottom minus y minus height
            var bottom = region.bottom - xy[1] - height;

            //Set the constraints based on the above calculations
            this.setXConstraint(left, right);
            this.setYConstraint(top, bottom);

            Event.on(window, 'resize', function() {
                this.initConstraints();
            }, this, true);
        }
    });
})();

