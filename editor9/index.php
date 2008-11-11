<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor inside Panel</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	  .exeTable {width:800px;border-spacing:0px}
	  #container {height:15em;}
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor inside Panel</a></h1></div>
    <div id="bd">
    <a href="#thecode">Jump to the code</a>
<div id="container">
<div><button id="show1">Show panel1</button><button id="hide1">Hide panel1</button></div>
<div id="panel1">
<div class="hd">Tutor Note</div>
<div class="bd"><textarea id="Hello">Hello World</textarea></div>
<div class="ft">End of Panel 1</div>
</div>
</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<h2 id="thecode">The HTML</h2>
<textarea name="code" class="HTML">
<div id="container">
<div><button id="show1">Show panel1</button><button id="hide1">Hide panel1</button></div>
<div id="panel1">
<div class="hd">Tutor Note</div>
<div class="bd">&lt;textarea id="Hello"&gt;Hello World&lt;/textarea&gt;</div>
<div class="ft">End of Panel 1</div>
</div>
</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
<div>Test Text Test Text Test Text Test Text Test Text</div>
</textarea>
<h2 >The Javascript</h2>
<textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = null;

    YAHOO.namespace("example.container");

    function init() {
        // Instantiate a Panel from markup
        YAHOO.example.container.panel1 = new YAHOO.widget.Panel("panel1", { width:"600px", visible:false, constraintoviewport:true } );

        /**
        * This is the key..
        * The editable area is an iframe, so in Internet explorer it
        * covers elements even when it is set to visiblity hidden.
        * So basically we move it out of the way when it's hidden and
        * put it back when we show it.
        */
        YAHOO.example.container.panel1.hideEvent.subscribe(function() {
            myEditor.get('iframe').setStyle('position', 'absolute');
            myEditor.get('iframe').setStyle('left', '-9999px');
        });
        YAHOO.example.container.panel1.showEvent.subscribe(function() {
            myEditor.get('iframe').setStyle('position', 'static');
            myEditor.get('iframe').setStyle('left', '');
            myEditor._setDesignMode('on');
        });

        YAHOO.example.container.panel1.render();
        Event.addListener("show1", "click", YAHOO.example.container.panel1.show, YAHOO.example.container.panel1, true);
        Event.addListener("hide1", "click", YAHOO.example.container.panel1.hide, YAHOO.example.container.panel1, true);

        if (!myEditor) {
            myEditor = new YAHOO.widget.Editor('Hello', { 
                height: '300px', 
                width: '100%', 
                dompath: false, 
                animate: false 
            });
            myEditor.on('afterRender', function() {
                this.get('iframe').setStyle('position', 'absolute');
                this.get('iframe').setStyle('left', '-9999px');
            }, myEditor, true);
            myEditor.render(); 	  		
        }
    }

    Event.addListener(window, "load", init);
})();
</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/container/container-min.js"></script>	
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/menu/menu-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/button/button-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/editor/editor-beta-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = null;

    YAHOO.namespace("example.container");

    function init() {
        // Instantiate a Panel from markup
        YAHOO.example.container.panel1 = new YAHOO.widget.Panel("panel1", { width:"600px", visible:false, constraintoviewport:true } );

        /**
        * This is the key..
        * The editable area is an iframe, so in Internet explorer it
        * covers elements even when it is set to visiblity hidden.
        * So basically we move it out of the way when it's hidden and
        * put it back when we show it.
        */
        YAHOO.example.container.panel1.hideEvent.subscribe(function() {
            myEditor.get('iframe').setStyle('position', 'absolute');
            myEditor.get('iframe').setStyle('left', '-9999px');
        });
        YAHOO.example.container.panel1.showEvent.subscribe(function() {
            myEditor.get('iframe').setStyle('position', 'static');
            myEditor.get('iframe').setStyle('left', '');
            myEditor._setDesignMode('on');
        });

        YAHOO.example.container.panel1.render();
        Event.addListener("show1", "click", YAHOO.example.container.panel1.show, YAHOO.example.container.panel1, true);
        Event.addListener("hide1", "click", YAHOO.example.container.panel1.hide, YAHOO.example.container.panel1, true);

        if (!myEditor) {
            myEditor = new YAHOO.widget.Editor('Hello', { 
                height: '300px', 
                width: '100%', 
                dompath: false, 
                animate: false 
            });
            myEditor.on('afterRender', function() {
                this.get('iframe').setStyle('position', 'absolute');
                this.get('iframe').setStyle('left', '-9999px');
            }, myEditor, true);
            myEditor.render(); 	  		
        }
    }

    Event.addListener(window, "load", init);

    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
