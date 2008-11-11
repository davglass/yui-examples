<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Overlay relative Module mask</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( ../css/container_assets/container.css );
        @import url( style.css );
        p { margin: .5em; }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
<div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Overlay relative Module mask</a></h1></div>
<div id="bd">
<p>Click the div below to get a modified "wait" panel. Note that this modified "wait" panel will only mask the DIV, not the body and it will attach the wait panel to the center of the DIV not the center of the body. Now if you click the link below a normal Wait Panel will load over the entire page.</p>
<p>I have accomplished this by over writing 2 of the Panel's prototype functions (<code>center &amp; sizeMask</code>). Then I attached a custom function called fixMask to the Custom Event <code>showMaskEvent</code></p>
<p>The functions behave the way they do based on where the panel is rendered. If it is rendered to the body, the mask takes up the whole page. If it is rendered inside of another object it will attach to that object.</p>
<p><a href="" id="fullMask">Panel with Full Page Mask</a></p>
<p><a href="" id="allPanels">Fire All Panel Events</a></p>
<div id="cover">This is the div we want to attach the module overlay to.</div>
<div id="cover2">This is the div we want to attach the module overlay to.</div>


<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript">


YAHOO.namespace("example.panel");


	function initWait() {
		YAHOO.example.panel.wait = 
				new YAHOO.widget.Panel("wait", 
								{ width: "240px", 
								  fixedcenter: true, 
								  underlay: "shadow", 
								  close: false, 
								  draggable: false, 
								  modal: true,
                                  zindex: 100,
								  effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5} 
								  }
								 );
		YAHOO.example.panel.wait.setHeader("Loading, please wait...");
		YAHOO.example.panel.wait.setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");
        
        YAHOO.example.panel.wait.showMaskEvent.subscribe(fixMask, YAHOO.example.panel.wait, true);
		YAHOO.example.panel.wait.render(YAHOO.util.Dom.get('cover'));
        setTimeout('YAHOO.example.panel.wait.hide()', 5000);
	}
	function initWait2() {
		YAHOO.example.panel.wait3 = 
				new YAHOO.widget.Panel("wait3", 
								{ width: "240px", 
								  fixedcenter: true, 
								  underlay: "shadow", 
								  close: false, 
								  draggable: false, 
								  modal: true,
                                  zindex: 100,
								  effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5} 
								  }
								 );
		YAHOO.example.panel.wait3.setHeader("Loading, please wait...");
		YAHOO.example.panel.wait3.setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");
        
        YAHOO.example.panel.wait3.showMaskEvent.subscribe(fixMask, YAHOO.example.panel.wait3, true);
		YAHOO.example.panel.wait3.render(YAHOO.util.Dom.get('cover2'));
        setTimeout('YAHOO.example.panel.wait3.hide()', 5000);
	}

	function initFull(ev) {
		YAHOO.example.panel.wait2 = 
				new YAHOO.widget.Panel("wait2", 
								{ width: "240px", 
								  fixedcenter: true, 
								  underlay: "shadow", 
								  close: false, 
								  draggable: false, 
								  modal: true,
                                  zindex: 200,
								  effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5} 
								  }
								 );
		YAHOO.example.panel.wait2.setHeader("Loading Full Page, please wait...");
		YAHOO.example.panel.wait2.setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");
        
		YAHOO.example.panel.wait2.render(document.body);
        setTimeout('YAHOO.example.panel.wait2.hide()', 5000);
        if (ev) {
            YAHOO.util.Event.stopEvent(ev);
        }
	}

	YAHOO.util.Event.addListener('cover', 'click', initWait);
	YAHOO.util.Event.addListener('cover2', 'click', initWait2);
	YAHOO.util.Event.addListener('fullMask', 'click', initFull);
	YAHOO.util.Event.addListener('allPanels', 'click', fireAll);


function fireAll(ev) {
    YAHOO.util.Event.stopEvent(ev);
    initWait();
    initWait2();
    initFull();
}


function fixMask() {
	if (this.mask) {
        var cover = this.element.parentNode.id;
        var xy = YAHOO.util.Dom.getXY(cover);
        this.mask.style.height = YAHOO.util.Dom.getStyle(cover, 'height');
        this.mask.style.width = YAHOO.util.Dom.getStyle(cover, 'width');
        YAHOO.util.Dom.setXY(this.mask, xy);
	}
}

YAHOO.widget.Overlay.prototype.center = function() {
    /*
	this.element.style.left = parseInt(x, 10) + "px";
	this.element.style.top = parseInt(y, 10) + "px";
	this.syncPosition();
	this.cfg.refireEvent("iframe");
    */
    var elementWidth = this.element.offsetWidth;
    var elementHeight = this.element.offsetHeight;

    if (this.element.parentNode == document.body) {
        var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
	    var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
        var viewPortWidth = YAHOO.util.Dom.getClientWidth();
        var viewPortHeight = YAHOO.util.Dom.getClientHeight();
        var x = (viewPortWidth / 2) - (elementWidth / 2) + scrollX;
        var y = (viewPortHeight / 2) - (elementHeight / 2) + scrollY;
    } else {
	    var scrollX = 0;
	    var scrollY = 0;
        var cover = this.element.parentNode.id;
        var coverXY = YAHOO.util.Dom.getXY(cover);
        var viewPortWidth = parseInt(YAHOO.util.Dom.getStyle(cover, 'width'));
        var viewPortHeight = parseInt(YAHOO.util.Dom.getStyle(cover, 'height'));
        var x = ((viewPortWidth / 2) - (elementWidth / 2) + scrollX) + coverXY[0];
        var y = ((viewPortHeight / 2) - (elementHeight / 2) + scrollY) + coverXY[1];
    }
    
	this.element.style.left = parseInt(x, 10) + "px";
	this.element.style.top = parseInt(y, 10) + "px";
	this.syncPosition();

	this.cfg.refireEvent("iframe");
};

YAHOO.widget.Panel.prototype.sizeMask = function() {
	if (this.mask) {
        if (this.element.parentNode == document.body) {
            this.mask.style.height = YAHOO.util.Dom.getDocumentHeight()+"px";
            this.mask.style.width = YAHOO.util.Dom.getDocumentWidth()+"px";
        } else {
            var cover = this.element.parentNode.id;
            var xy = YAHOO.util.Dom.getXY(cover);
            this.mask.style.height = YAHOO.util.Dom.getStyle(cover, 'height');
            this.mask.style.width = YAHOO.util.Dom.getStyle(cover, 'width');
            YAHOO.util.Dom.setXY(this.mask, xy);
        }
	}
};



</script>
</body>
</html>
