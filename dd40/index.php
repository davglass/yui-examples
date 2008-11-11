<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- this code is working
Known problem:
1. div can be dropped below other and not beside
2. the mosue needs to be at the area for insertion to be possible
3. when moving to the left, it needs to be at the starting point
-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Using Drag and Drop to Reorder a List</title>

<style type="text/css">
/*margin and padding on body element
can introduce errors in determining
element position and are not recommended;
we turn them off as a foundation for YUI
CSS treatments. */
body {
    margin:0;
    padding:0;
}
</style>

<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 



<!--begin custom header content for this example-->

<style type="text/css">

div.workarea { padding:10px; float:left }

ul.draglist {
    position: relative;
    width: 200px;
    height:240px;
    background: #f7f7f7;
    border: 1px solid gray;
    list-style: none;
    margin:0;
    padding:0;
}

ul.draglist li {
    margin: 1px;
    cursor: move;
}

ul.draglist_alt {
    position: relative;
    width: 200px;
    list-style: none;
    margin:0;
    padding:0;
    /*
    The bottom padding provides the cushion that makes the empty
    list targetable. Alternatively, we could leave the padding
    off by default, adding it when we detect that the list is empty.
    */
    padding-bottom:20px;
}

ul.draglist_alt li {
    margin: 1px;
    cursor: move;
}


li.list1 {
    background-color: #D1E6EC;
    border:1px solid #7EA6B2;
}

li.list2 {
    background-color: #D8D4E2;
    border:1px solid #6B4C86;
}

#user_actions { float: right; }

#tabmenu { padding: 0.1em 0 0 4em; *padding: 0 0 0 4em; height: 26px; min-width: 1300px; *width: 1175px; _width: 1175px; margin-top: -0.5em;*margin-top: -2.7em; _margin-top: -1.4em; position: fixed; }
.tab, .current { float: left; text-align: center; }
.tab-text { position: relative; top: 8px; left: -4px; }
.tab-text-long { position: relative; top: 8px; left: -4px; font-size:85%; }
.tab {
    cursor:move;
    list-style: none;
    float: left;
    background-position: 0 -100px;
    width: 98px;
    height: 27px;

    height: 30px;
    border: 1px solid #ccc;
    background-color: #fff;
    border-bottom: 1px solid #fff;
    margin-right: 2px;
}
* html .tab {
    height: 26px;
}

</style>


<!--end custom header content for this example-->

</head>

<body class=" yui-skin-sam">
<h1>Using Drag and Drop to Reorder a Tab Menu</h1>
<br/> <H1>Tab menus</H1>
<div id="tabmenu">
    <div id="scroll-priv"><a href="#"><img src="../images/leftarrow.gif" alt="Prev"/></a></div>
    <div id="tabs-container" style="background-color:red;height:26px">
        <div id="tab1" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab1</span></a></div>
        <div id="tab2" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab2</span></a></div>
        <div id="tab3" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab3</span></a></div>
        <div id="tab4" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab4</span></a></div>
        <div id="tab5" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab6</span></a></div>
        <div id="tab6" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab7</span></a></div>
        <div id="tab7" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab8</span></a></div>
        <div id="tab8" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab9</span></a></div>
        <div id="tab9" class="tab"><a href="javascript:void(0);" class="tabs" name="tabLink"><span class="tab-text">Tab10</span></a></div>
    </div>
    <div id="scroll-next"><a href="#"><img src="../images/rightarrow.gif" alt="Next"/></a></div>
</div>
<br/>

<script type="text/javascript">
var MENU = {};
MENU.tabs = {};
var yDom = YAHOO.util.Dom;
var yEvent = YAHOO.util.Event;
var yDDM = YAHOO.util.DragDropMgr;

(function() {

MENU.tabs.DDApp = {
    init: function() {
        // make the target
        new YAHOO.util.DDTarget("tabs-container");

        //make the inner div draggable
        var innerDivCnt = yDom.getChildren('tabs-container').length;
        for (var i=0;i<innerDivCnt;i++) {
            new MENU.tabs.DDList(yDom.getChildren('tabs-container')[i].id);
        }
    }
};

////////////////////////////////////////////////////////////////////////\
// custom drag and drop implementation
////////////////////////////////////////////////////////////////////////\

MENU.tabs.DDList = function(id, sGroup, config) {
    MENU.tabs.DDList.superclass.constructor.call(this, id, sGroup, config);

    this.logger = this.logger || YAHOO;
    var el = this.getDragEl();
    yDom.setStyle(el, "opacity", 0.67); // The proxy is slightly transparent

    this.goingUp = false;
    this.lastY = 0;
};

YAHOO.extend(MENU.tabs.DDList, YAHOO.util.DDProxy, {

    startDrag: function(x, y) {
        this.logger.log(this.id + " startDrag");

        // make the proxy look like the source element
        var dragEl = this.getDragEl();
        var clickEl = this.getEl();
        yDom.setStyle(clickEl, "visibility", "hidden");

        dragEl.innerHTML = clickEl.innerHTML;

        yDom.setStyle(dragEl, "color", yDom.getStyle(clickEl, "color"));
        yDom.setStyle(dragEl, "backgroundColor", yDom.getStyle(clickEl, "backgroundColor"));
        yDom.setStyle(dragEl, "border", "2px solid gray");
    },
    endDrag: function(e) {
        //console.log(e);
        var srcEl = this.getEl();
        var proxy = this.getDragEl();

        // Show the proxy element and animate it to the src element's location
        yDom.setStyle(proxy, "visibility", "");
        var a = new YAHOO.util.Motion(proxy, {
            points: {
                // to: yDom.getXY(srcEl)
                to: yDom.getX(srcEl)
            }
        }, 0.2, YAHOO.util.Easing.easeOut);

        var proxyid = proxy.id;
        var thisid = this.id;

        // Hide the proxy and show the source element when finished with the animation
        a.onComplete.subscribe(function() {
            yDom.setStyle(proxyid, "visibility", "hidden");
            yDom.setStyle(thisid, "visibility", "");
        });
        a.animate();
    },

    onDragDrop: function(e, id) {
        // If there is one drop interaction, the li was dropped either on the list,
        // or it was dropped on the current location of the source element.
        //console.log(e);
        if (yDDM.interactionInfo.drop.length === 1) {
            // The position of the cursor at the time of the drop (YAHOO.util.Point)
            var pt = yDDM.interactionInfo.point;
            // The region occupied by the source element at the time of the drop
            var region = yDDM.interactionInfo.sourceRegion;

            // Check to see if we are over the source element's location. We will
            // append to the bottom of the list once we are sure it was a drop in
            // the negative space (the area of the list without any list items)
            if (!region.intersect(pt)) {
                var destEl = yDom.get(id);
                var destDD = yDDM.getDDById(id);
                destEl.appendChild(this.getEl());
                destDD.isEmpty = false;
                yDDM.refreshCache();
            }
        }
    },

    onDrag: function(e) {
        //console.log(e);
        // Keep track of the direction of the drag for use during onDragOver
        //var y = yEvent.getPageY(e);
        var y = yEvent.getPageX(e);

        if (y < this.lastY) {
            this.goingUp = true;
        } else if (y > this.lastY) {
            this.goingUp = false;
        }
        this.lastY = y;
    },

    onDragOver: function(e, id) {
        //console.log(yDom.get(id));
        var srcEl = this.getEl();
        var destEl = yDom.get(id);
        // We are only concerned with list items, we ignore the dragover
        // notifications for the list.
        if (id == "tabs-container") { return; }

        if (destEl.nodeName.toLowerCase() == "div") {
            var orig_p = srcEl.parentNode;
            var p = destEl.parentNode;

            if (this.goingUp) {
                p.insertBefore(srcEl, destEl); // insert above
            } else {
                p.insertBefore(srcEl, destEl.nextSibling); // insert below
            }

            yDDM.refreshCache();
        }
    }
});

MENU.tabs.DDRegion = function(id, sGroup, config) {
    this.cont = config.cont;
    MENU.tabs.DDRegion.superclass.constructor.apply(this, arguments);
};

YAHOO.extend(MENU.tabs.DDRegion, MENU.tabs.DDList, {
    cont: null,
    init: function() {
        //Call the parent's init method
        MENU.tabs.DDRegion.superclass.init.apply(this, arguments);
        this.initConstraints();
        yEvent.on(window, 'resize', this.initConstraints, this, true);
    },
    initConstraints: function() {
        //Get the top, right, bottom and left positions
        var region = yDom.getRegion(this.cont);

        //Get the element we are working on
        var el = this.getEl();

        //Get the xy position of it
        var xy = yDom.getXY(el);

        //Get the width and height
        var width = parseInt(yDom.getStyle(el, 'width'), 10);
        var height = parseInt(yDom.getStyle(el, 'height'), 10);

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

    }
    });
})();

yEvent.onDOMReady(function() {
    console.log("onDomReady");
    var innerDivCnt = yDom.getChildren('tabs-container').length;
    for (var i=0;i<innerDivCnt;i++) {
        //new MENU.tabs.DDList(yDom.getChildren('tabs-container')[i].id);
        new MENU.tabs.DDRegion(yDom.getChildren('tabs-container')[i].id, '', { cont: 'tabs-container' });
    }

});
</script>

<!--END SOURCE CODE FOR EXAMPLE =============================== -->

</body>
</html>



