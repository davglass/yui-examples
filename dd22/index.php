<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop Radio Buttons</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop Radio Buttons</a></h1></div>
    <div id="bd">
        <p>Internet Explorer has a nasty bug related to DOM manipulation and forms (It has many other bugs too..) If you do an appendChild on a radio button or a checkbox, the checked state of the input is lost. This example gets around that issue.</p>
        <p><a href="#thecode">The Code</a></p>
		<div class="workarea">
		  <h3>List 1</h3>
		  <small>If you drag the checked radio, when you'll drop it, this won't be checked anymore</small>
		  <ul id="ul1" class="draglist">
		    <li class="list1" id="li1_1"><img src="moveBlock.png" id="mv11" /><input type="radio" name="radiogroup1" id="rdg1" /><label for="rdg1">Tick me 1</label></li>
		    <li class="list1" id="li1_2"><img src="moveBlock.png" id="mv12" /><input type="radio" name="radiogroup1" id="rdg2" /><label for="rdg2">Tick me 2</label></li>
		    <li class="list1" id="li1_3"><img src="moveBlock.png" id="mv13" /><input type="radio" name="radiogroup1" id="rdg3" /><label for="rdg3">Tick me 3</label></li>
		  </ul>
		</div>
		
		<div class="workarea">
		  <h3>List 2</h3>
		  <ul id="ul2" class="draglist">
		    <li class="list2" id="li2_1"><img src="moveBlock.png" id="mv21" /><input type="checkbox" name="checkbox1" id="rdg21" /><label for="rdg21">Tick me 1</label></li>
		    <li class="list2" id="li2_2"><img src="moveBlock.png" id="mv22" /><input type="checkbox" name="checkbox2" id="rdg22" /><label for="rdg22">Tick me 2</label></li>
		    <li class="list2" id="li2_3"><img src="moveBlock.png" id="mv23" /><input type="checkbox" name="checkbox3" id="rdg23" /><label for="rdg23">Tick me 3</label></li>
		  </ul>
		</div>
        <h2 id="thecode">The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {	
		var Dom = YAHOO.util.Dom,
		    Event = YAHOO.util.Event,
		    DDM = YAHOO.util.DragDropMgr;
		
		//////////////////////////////////////////////////////////////////////////////
		// example app
		//////////////////////////////////////////////////////////////////////////////
		YAHOO.example.DDApp = {
		    init: function() {
		
		        var rows=3,cols=2,i,j;
		        for (i=1;i<cols+1;i=i+1) {
		            new YAHOO.util.DDTarget("ul"+i);
		        }
		
		        for (i=1;i<cols+1;i=i+1) {
		            for (j=1;j<rows+1;j=j+1) {
		               var dd = new YAHOO.example.DDList("li" + i + "_" + j);
					   dd.setHandleElId("mv"+i+j);
		            }
		        }
		
		        Event.on("showButton", "click", this.showOrder);
		        Event.on("switchButton", "click", this.switchStyles);
		    },
		
		    showOrder: function() {
		        var parseList = function(ul, title) {
		            var items = ul.getElementsByTagName("li");
		            var out = title + ": ";
		            for (i=0;i<items.length;i=i+1) {
		                out += items[i].id + " ";
		            }
		            return out;
		        };
		
		        var ul1=Dom.get("ul1"), ul2=Dom.get("ul2");
		        alert(parseList(ul1, "List 1") + "\n" + parseList(ul2, "List 2"));
		
		    },
		
		    switchStyles: function() {
		        Dom.get("ul1").className = "draglist_alt";
		        Dom.get("ul2").className = "draglist_alt";
		    }
		};
		
		//////////////////////////////////////////////////////////////////////////////
		// custom drag and drop implementation
		//////////////////////////////////////////////////////////////////////////////
		
		YAHOO.example.DDList = function(id, sGroup, config) {
		
		    YAHOO.example.DDList.superclass.constructor.call(this, id, sGroup, config);
		
		    this.logger = this.logger || YAHOO;
		    var el = this.getDragEl();
		    Dom.setStyle(el, "opacity", 0.67); // The proxy is slightly transparent
		
		    this.goingUp = false;
		    this.lastY = 0;
		};
		
		YAHOO.extend(YAHOO.example.DDList, YAHOO.util.DDProxy, {
		
		    startDrag: function(x, y) {
		        this.logger.log(this.id + " startDrag");
		
		        // make the proxy look like the source element
		        var dragEl = this.getDragEl();
		        var clickEl = this.getEl();
		        Dom.setStyle(clickEl, "visibility", "hidden");
		
		        //dragEl.innerHTML = clickEl.innerHTML;
		
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
                        //Patched Code
                        var checked = false,
                        input = this.getEl().getElementsByTagName('input')[0];

                        if (input && input.tagName) {
                            checked = this.getEl().getElementsByTagName('input')[0].checked;
                        }
		                destEl.appendChild(this.getEl());

                        if (input && checked) {
                            input.checked = true;
                        }
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
		
		        // We are only concerned with list items, we ignore the dragover
		        // notifications for the list.
		        if (destEl.nodeName.toLowerCase() == "li") {
		            var orig_p = srcEl.parentNode,
		                p = destEl.parentNode,
                        checked = false,
                        input = this.getEl().getElementsByTagName('input')[0];

		            if (input && input.tagName) {
                        checked = this.getEl().getElementsByTagName('input')[0].checked;
                    }
		            if (this.goingUp) {
		                p.insertBefore(srcEl, destEl); // insert above
		            } else {
		                p.insertBefore(srcEl, destEl.nextSibling); // insert below
		            }
                    if (input && checked) {
                        input.checked = true;
                    }
		
		            DDM.refreshCache();
		        }
		    }
		});
		
		Event.onDOMReady(YAHOO.example.DDApp.init, YAHOO.example.DDApp, true);
    
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/logger/logger-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
		
		var Dom = YAHOO.util.Dom,
		    Event = YAHOO.util.Event,
		    DDM = YAHOO.util.DragDropMgr;
		
		//////////////////////////////////////////////////////////////////////////////
		// example app
		//////////////////////////////////////////////////////////////////////////////
		YAHOO.example.DDApp = {
		    init: function() {
		
		        var rows=3,cols=2,i,j;
		        for (i=1;i<cols+1;i=i+1) {
		            new YAHOO.util.DDTarget("ul"+i);
		        }
		
		        for (i=1;i<cols+1;i=i+1) {
		            for (j=1;j<rows+1;j=j+1) {
		               var dd = new YAHOO.example.DDList("li" + i + "_" + j);
					   dd.setHandleElId("mv"+i+j);
		            }
		        }
		
		        Event.on("showButton", "click", this.showOrder);
		        Event.on("switchButton", "click", this.switchStyles);
		    },
		
		    showOrder: function() {
		        var parseList = function(ul, title) {
		            var items = ul.getElementsByTagName("li");
		            var out = title + ": ";
		            for (i=0;i<items.length;i=i+1) {
		                out += items[i].id + " ";
		            }
		            return out;
		        };
		
		        var ul1=Dom.get("ul1"), ul2=Dom.get("ul2");
		        alert(parseList(ul1, "List 1") + "\n" + parseList(ul2, "List 2"));
		
		    },
		
		    switchStyles: function() {
		        Dom.get("ul1").className = "draglist_alt";
		        Dom.get("ul2").className = "draglist_alt";
		    }
		};
		
		//////////////////////////////////////////////////////////////////////////////
		// custom drag and drop implementation
		//////////////////////////////////////////////////////////////////////////////
		
		YAHOO.example.DDList = function(id, sGroup, config) {
		
		    YAHOO.example.DDList.superclass.constructor.call(this, id, sGroup, config);
		
		    this.logger = this.logger || YAHOO;
		    var el = this.getDragEl();
		    Dom.setStyle(el, "opacity", 0.67); // The proxy is slightly transparent
		
		    this.goingUp = false;
		    this.lastY = 0;
		};
		
		YAHOO.extend(YAHOO.example.DDList, YAHOO.util.DDProxy, {
		
		    startDrag: function(x, y) {
		        this.logger.log(this.id + " startDrag");
		
		        // make the proxy look like the source element
		        var dragEl = this.getDragEl();
		        var clickEl = this.getEl();
		        Dom.setStyle(clickEl, "visibility", "hidden");
		
		        //dragEl.innerHTML = clickEl.innerHTML;
		
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
                        //Patched Code
                        var checked = false,
                        input = this.getEl().getElementsByTagName('input')[0];

                        if (input && input.tagName) {
                            checked = this.getEl().getElementsByTagName('input')[0].checked;
                        }
		                destEl.appendChild(this.getEl());

                        if (input && checked) {
                            input.checked = true;
                        }
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
		
		        // We are only concerned with list items, we ignore the dragover
		        // notifications for the list.
		        if (destEl.nodeName.toLowerCase() == "li") {
		            var orig_p = srcEl.parentNode,
		                p = destEl.parentNode,
                        checked = false,
                        input = this.getEl().getElementsByTagName('input')[0];
		            if (input && input.tagName) {
                        checked = this.getEl().getElementsByTagName('input')[0].checked;
                    }
		            if (this.goingUp) {
		                p.insertBefore(srcEl, destEl); // insert above
		            } else {
		                p.insertBefore(srcEl, destEl.nextSibling); // insert below
		            }
                    if (input && checked) {
                        input.checked = true;
                    }
		
		            DDM.refreshCache();
		        }
		    }
		});
		
		Event.onDOMReady(YAHOO.example.DDApp.init, YAHOO.example.DDApp, true);
		
    dp.SyntaxHighlighter.HighlightAll('code');

    YAHOO.util.Event.on(window, 'load', function() {
        var logger = new YAHOO.widget.LogReader(null, { logReaderEnabled: true });
    });
    
})();

</script>
</body>
</html>
