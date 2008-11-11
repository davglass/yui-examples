<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Examples</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #tabs {
            margin: .25em;
        }
        #tabs ul li {
            border: 1px solid black;
            padding: .25em;
            background-color: #ccc;
        }
        #tabs ul li.dav-test {
            background-color: green;
        }
        #tabs ul li a {
            text-decoration: none;
            color: #000;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t1">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Examples</a></h1></div>
    <div id="bd">
	    <div id="yui-main">
	        <div class="yui-b">
                <div class="yui-g">
                    <h2>Non Skinned TabView</h2>
                    <div id="tabs"></div>
	            </div>
            </div>
	    </div>
	    <div class="yui-b yui-skin-sam">
            <h2>Skinned Cal</h2>
            <div id="cal1"></div>
        </div>
        <br clear="all">
        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
<div id="yui-main">
    <div class="yui-b">
        <div class="yui-g">
            <h2>Non Skinned TabView</h2>
            <div id="tabs"></div>
        </div>
    </div>
</div>
<div class="yui-b yui-skin-sam"> <!-- Note the classname here -->
    <h2>Skinned Cal</h2>
    <div id="cal1"></div>
</div>
        </textarea>
        <h2>The CSS</h2>
        <textarea name="code" class="HTML">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #tabs {
            margin: .25em;
        }
        #tabs ul li {
            border: 1px solid black;
            padding: .25em;
            background-color: #ccc;
        }
        #tabs ul li.dav-test {
            background-color: green;
        }
        #tabs ul li a {
            text-decoration: none;
            color: #000;
        }
	</style>
        </textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        cal1 = null,
        myTabs = null;
    
    Event.onDOMReady(function() {
        cal1 = new YAHOO.widget.Calendar('calendar', 'cal1');
        cal1.render();

        myTabs = new YAHOO.widget.TabView('tabs');
        
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab One Label',
            content: '<p>Tab One Content</p>',
            active: true,
            className: 'dav-test' // Note className is passed here (not classname)
        }));
        
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab Two Label',
            content: '<p>Tab Two Content</p>'
        }));
        
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab Three Label',
            content: '<p>Tab Three Content</p>'
        }));
        
        
    });
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/tabview/tabview-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/calendar/calendar-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        cal1 = null,
        myTabs = null;
    
    Event.onDOMReady(function() {
        cal1 = new YAHOO.widget.Calendar('calendar', 'cal1');
        cal1.render();

        myTabs = new YAHOO.widget.TabView('tabs');
        
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab One Label',
            content: '<p>Tab One Content</p>',
            active: true,
            className: 'dav-test'
        }));
        
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab Two Label',
            content: '<p>Tab Two Content</p>'
        }));
        
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab Three Label',
            content: '<p>Tab Three Content</p>'
        }));
        
        
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
