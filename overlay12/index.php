<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: 0.12 Overlay Issue</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( http://blog.davglass.com/files/yui/css/container_assets/container.css );
        @import url( style.css );
        p { margin: .5em; }
        #test1, #test2, #test3 {
            display: block;
            border: 1px solid black;
            width: 200px;
            padding: 1em;
            margin: 1em;
            float: left;
            text-decoration: none;
            color: black;
        }
        #test1:hover, #test2:hover, #test3:hover {
            color: red;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
<div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: 0.12 Overlay Issue</a></h1></div>
<div id="bd">

<div id="cover"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.</p></div>
<a href="" id="test1">Show a panel with the following event subscribers:<p>beforeRenderEvent, changeHeaderEvent, changeBodyEvent</p><b>Works</b></a>
<a href="" id="test2">Show a panel with the following event subscribers:<p>beforeRenderEvent, renderEvent, changeHeaderEvent, changeBodyEvent, beforeShowEvent, showEvent, beforeHideEvent, hideEvent, showMaskEvent, hideMaskEvent</p><b>Fails - No Panel shown, only mask</b></a>
<a href="" id="test3">Show a panel with the following event subscribers:<p>renderEvent, beforeShowEvent, showEvent, beforeHideEvent, hideEvent, showMaskEvent, hideMaskEvent</p><b>Fails - No Panel shown, only mask</b></a>
<script type="text/javascript" src="yahoo-min.js"></script>
<script type="text/javascript" src="dom-min.js"></script>
<script type="text/javascript" src="event-min.js"></script>
<script type="text/javascript" src="animation-min.js"></script>
<script type="text/javascript" src="dragdrop-min.js"></script>
<script type="text/javascript" src="container-min.js"></script>
<script type="text/javascript">


YAHOO.log = function(str) {
    console.log(str);
}

YAHOO.namespace("example.panel");


	function initWait(ev) {
        //YAHOO.util.Dom.get('cover').innerHTML = '';
		YAHOO.example.panel.wait = 
				new YAHOO.widget.Panel("wait", 
								{ width: "240px", 
								  fixedcenter: true, 
								  underlay: "shadow", 
								  close: false, 
								  draggable: false, 
								  modal: true,
								  effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5} 
								  }
								 );
        YAHOO.example.panel.wait.beforeRenderEvent.subscribe(function() { debug('beforeRenderEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait.changeHeaderEvent.subscribe(function() { debug('changeHeaderEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait.changeBodyEvent.subscribe(function() { debug('changeBodyEvent Fired..'); }, YAHOO.example.panel.wait, true);

		YAHOO.example.panel.wait.setHeader("Loading (1), please wait...");
		YAHOO.example.panel.wait.setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");
        
		YAHOO.example.panel.wait.render(YAHOO.util.Dom.get('cover'));
        setTimeout('YAHOO.example.panel.wait.hide()', 5000);
        YAHOO.util.Event.stopEvent(ev);
	}
	function initWait2(ev) {
        //YAHOO.util.Dom.get('cover').innerHTML = '';
		YAHOO.example.panel.wait2 = 
				new YAHOO.widget.Panel("wait2", 
								{ width: "240px", 
								  fixedcenter: true, 
								  underlay: "shadow", 
								  close: false, 
								  draggable: false, 
								  modal: true,
								  effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5} 
								  }
								 );
        YAHOO.example.panel.wait2.beforeRenderEvent.subscribe(function() { debug('beforeRenderEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait2.renderEvent.subscribe(function() { debug('renderEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait2.changeHeaderEvent.subscribe(function() { debug('changeHeaderEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait2.changeBodyEvent.subscribe(function() { debug('changeBodyEvent Fired..'); }, YAHOO.example.panel.wait, true);

        YAHOO.example.panel.wait2.beforeShowEvent.subscribe(function() { debug('beforeShowEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait2.showEvent.subscribe(function() { debug('showEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait2.beforeHideEvent.subscribe(function() { debug('beforeHideEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait2.hideEvent.subscribe(function() { debug('hideEvent Fired..'); }, YAHOO.example.panel.wait, true);

        YAHOO.example.panel.wait2.showMaskEvent.subscribe(function() { debug('showMaskEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait2.hideMaskEvent.subscribe(function() { debug('hideMaskEvent Fired..'); }, YAHOO.example.panel.wait, true);

		YAHOO.example.panel.wait2.setHeader("Loading (2), please wait...");
		YAHOO.example.panel.wait2.setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");
        
		YAHOO.example.panel.wait2.render(YAHOO.util.Dom.get('cover'));
        setTimeout('YAHOO.example.panel.wait2.hide()', 5000);
        YAHOO.util.Event.stopEvent(ev);
	}
	function initWait3(ev) {
        //YAHOO.util.Dom.get('cover').innerHTML = '';
		YAHOO.example.panel.wait3 = 
				new YAHOO.widget.Panel("wait3", 
								{ width: "240px", 
								  fixedcenter: true, 
								  underlay: "shadow", 
								  close: false, 
								  draggable: false, 
								  modal: true,
								  effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5} 
								  }
								 );
        YAHOO.example.panel.wait3.renderEvent.subscribe(function() { debug('renderEvent Fired..'); }, YAHOO.example.panel.wait, true);

        YAHOO.example.panel.wait3.beforeShowEvent.subscribe(function() { debug('beforeShowEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait3.showEvent.subscribe(function() { debug('showEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait3.beforeHideEvent.subscribe(function() { debug('beforeHideEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait3.hideEvent.subscribe(function() { debug('hideEvent Fired..'); }, YAHOO.example.panel.wait, true);

        YAHOO.example.panel.wait3.showMaskEvent.subscribe(function() { debug('showMaskEvent Fired..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait3.hideMaskEvent.subscribe(function() { debug('hideMaskEvent Fired..'); }, YAHOO.example.panel.wait, true);

		YAHOO.example.panel.wait3.setHeader("Loading (3), please wait...");
		YAHOO.example.panel.wait3.setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");
        
		YAHOO.example.panel.wait3.render(YAHOO.util.Dom.get('cover'));
        YAHOO.example.panel.wait3.showMaskEvent.subscribe(function() { debug('showMaskEvent Fired After Render..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait3.hideEvent.subscribe(function() { debug('hideEvent Fired After Render..'); }, YAHOO.example.panel.wait, true);
        YAHOO.example.panel.wait3.hideMaskEvent.subscribe(function() { debug('hideMaskEvent Fired After Render..'); }, YAHOO.example.panel.wait, true);
        setTimeout('YAHOO.example.panel.wait3.hide()', 5000);
        YAHOO.util.Event.stopEvent(ev);
	}

	YAHOO.util.Event.addListener('test1', 'click', initWait);
	YAHOO.util.Event.addListener('test2', 'click', initWait2);
	YAHOO.util.Event.addListener('test3', 'click', initWait3);


function debug(str) {
    var c = YAHOO.util.Dom.get('cover');
    //c.innerHTML += '<p>' + str + '</p>';
    console.log(str);
}

</script>
</body>
</html>
