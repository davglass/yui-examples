<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"><title>Using Drag and Drop to Reorder a List (Nested Edition)</title>
    <style type="text/css">
    body {
        margin:0;
        padding:0;
        font-size:14px;
    }
    </style>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script>


    <style type="text/css">

        div.workarea { padding:10px; float:left }

        ul.draglist {
            position: relative;
            width: 200px;
            background: #f7f7f7;
            border: 1px solid gray;
            list-style: none;
            margin:10px;
            padding:0;
            float:left;
        }

        ul.draglist li {
            margin: 1px;
            cursor: move;
        }


    </style>
</head>
<body class="yui-skin-sam">
    <div id="columnWrapper">
    </div>


<script type="text/javascript">

(function() {

var Dom = YAHOO.util.Dom;
var Event = YAHOO.util.Event;
var DDM = YAHOO.util.DragDropMgr;

//////////////////////////////////////////////////////////////////////////////
// example app
//////////////////////////////////////////////////////////////////////////////
YAHOO.example.DDApp = {
    init: function() {
   
        var columns = 4
        var containers = 4
        var links = 6

        //Generate the columns
        for (var i=1; i < columns + 1; i= i+1) {
            var columnWrapper = document.getElementById("columnWrapper");
            //Create new div that wraps around the UL list
            var newContainerWrapper = columnWrapper.appendChild(document.createElement("div"));
            newContainerWrapper.id = "containerWrapper_" + i;
            //Create new UL
            newContainerWrapper.innerHTML = "<ul id='column_" + i + "'class='draglist'></ul>"
            //Add target ability to the new UL and add to containers group
            new YAHOO.util.DDTarget("column_" + i, "containers");

            //Now add containers in the columns
            for (var x = 1; x < links + 1; x = x + 1) {
                var parentColumn = document.getElementById("column_" + i);
                var newContainer = parentColumn.appendChild(document.createElement("li"));
                newContainer.id = "container_" + i + "_" + x; //Each container with unique ID
                newContainer.innerHTML = "Sample Title "  + i + "_" + x
                //Add drag and drop ability and add to containers group
                var tmp1 = new YAHOO.example.DDList("container_"  + i + "_" + x, "containers");
                //PERFORMANCE
                tmp1.addToGroup('links_' + i);

                //Create new div that wraps around the sub UL list
                var newContainerBody = newContainer.appendChild(document.createElement("div"));
                newContainerBody.id = "containerBody_" + i + "_" + x;
                newContainerBody.innerHTML = "<ul id='linkList_" + i + "_" + x + "'class='linksList'></ul>"
                //Add target ability to the new sub UL and add to links group
                new YAHOO.util.DDTarget("linkList_" + i + "_" + x, "links");

                for (var y = 1; y < links + 1; y = y + 1) {
                    var parentLinkList = document.getElementById("linkList_" + i + "_" + x);
                    var newLink = parentLinkList.appendChild(document.createElement("li"));
                    newLink.id = "link_" + i + "_" + x + "_" + y;
                    newLink.innerHTML = "Sample text and id: " + i + "_" + x + "_" + y;

                    var tmp = new YAHOO.example.DDList("link_" + i + "_" + x + "_" + y, "links");
                    //PERFORMANCE
                    tmp.addToGroup('links_' + i);
                }//End of links generation loop
            }//End of container generation loop
        }//End of column generation loop

    }
};

//////////////////////////////////////////////////////////////////////////////
// custom drag and drop implementation
//////////////////////////////////////////////////////////////////////////////

YAHOO.example.DDList = function(id, sGroup, config) {

    YAHOO.example.DDList.superclass.constructor.call(this, id, sGroup, config);

    this.logger = this.logger || YAHOO;
    var el = this.getDragEl();
    //Dom.setStyle(el, "opacity", 0.67); // The proxy is slightly transparent

    this.goingUp = false;
    this.lastY = 0;
};

YAHOO.extend(YAHOO.example.DDList, YAHOO.util.DDProxy, {
    _lastOver: null,
    startDrag: function(x, y) {
        this.logger.log(this.id + " startDrag");

        // make the proxy look like the source element
        var dragEl = this.getDragEl();
        var clickEl = this.getEl();
        Dom.setStyle(clickEl, "visibility", "hidden");


        dragEl.innerHTML = clickEl.innerHTML;

        Dom.setStyle(dragEl, "color", Dom.getStyle(clickEl, "color"));
        Dom.setStyle(dragEl, "backgroundColor", Dom.getStyle(clickEl, "backgroundColor"));
        Dom.setStyle(dragEl, "border", "2px solid gray");
    },

    endDrag: function(e) {
        var srcEl = this.getEl();
        var proxy = this.getDragEl();

        // Show the proxy element and animate it to the src element's location
        Dom.setStyle(proxy, "visibility", "");
        var a = new YAHOO.util.Motion(
            proxy, {
                points: {
                    to: Dom.getXY(srcEl)
                }
            },
            0.2,
            YAHOO.util.Easing.easeOut
        )
        var proxyid = proxy.id;
        var thisid = this.id;

        // Hide the proxy and show the source element when finished with the animation
        a.onComplete.subscribe(function() {
                Dom.setStyle(proxyid, "visibility", "hidden");
                Dom.setStyle(thisid, "visibility", "");
            });
        a.animate();
    },

    onDragDrop: function(e, id) {
        // If there is one drop interaction, the li was dropped either on the list,
        // or it was dropped on the current location of the source element.
        if (DDM.interactionInfo.drop.length === 1) {

            // The position of the cursor at the time of the drop (YAHOO.util.Point)
            var pt = DDM.interactionInfo.point;

            // The region occupied by the source element at the time of the drop
            var region = DDM.interactionInfo.sourceRegion;

            // Check to see if we are over the source element's location.  We will
            // append to the bottom of the list once we are sure it was a drop in
            // the negative space (the area of the list without any list items)
            if (!region.intersect(pt)) {
                var destEl = Dom.get(id);
                var destDD = DDM.getDDById(id);
                destEl.appendChild(this.getEl());
                destDD.isEmpty = false;
                DDM.refreshCache();
            }

        }
    },

    onDrag: function(e) {

        // Keep track of the direction of the drag for use during onDragOver
        var y = Event.getPageY(e);

        if (y < this.lastY) {
            this.goingUp = true;
        } else if (y > this.lastY) {
            this.goingUp = false;
        }

        this.lastY = y;
    },

    onDragOver: function(e, id) {
   
        var srcEl = this.getEl();
        var destEl = Dom.get(id);

        //PERFORMANCE
        if (this._lastOver && (this._lastOver[0] == srcEl) && (this._lastOver[1] == destEl)) {
            return false;
        }

        // We are only concerned with list items, we ignore the dragover
        // notifications for the list.
        if (destEl.nodeName.toLowerCase() == "li") {
            var orig_p = srcEl.parentNode;
            var p = destEl.parentNode;

            if (this.goingUp) {
                p.insertBefore(srcEl, destEl); // insert above
            } else {
                p.insertBefore(srcEl, destEl.nextSibling); // insert below
            }
            //START PERFORMANCE
            var overDD = DDM.getDDById(destEl.id);
            //Get the group from the element we are over
            for (var d in overDD.groups) {
                if (d !== 'links') {
                    //Refresh the cache for only that group
                    DDM.refreshCache(d);
                }
            }
            //Get the group from the element we are using
            for (var i in this.groups) {
                if (i !== 'links') {
                    //Refresh the cache for only that group
                    DDM.refreshCache(i);
                }
            }
            //END PERFORMANCE
        }
        //PERFORMANCE
        this._lastOver = [srcEl, destEl];
    }
});

Event.onDOMReady(YAHOO.example.DDApp.init, YAHOO.example.DDApp, true);

})();


</script>
</body>
</html>
