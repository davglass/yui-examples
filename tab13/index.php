<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Active Tab Label</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Active Tab Label</a></h1></div>
    <div id="bd">
        <div id="demo"></div>
        <button id="activeLabel">Get Active Tab Label</button>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/tabview/tabview-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    YAHOO.widget.Tab.prototype.ACTIVE_TITLE = 'My Tab';

    myTabs = new YAHOO.widget.TabView("demo");
    myTabs.addTab( new YAHOO.widget.Tab({
        label: 'Tab One Label',
        content: '<p>Tab One Content</p>',
        active: true
    }));
    
    myTabs.addTab( new YAHOO.widget.Tab({
        label: 'Tab Two Label',
        content: '<p>Tab Two Content</p>'
    }));
    
    myTabs.addTab( new YAHOO.widget.Tab({
        label: 'Tab Three Label',
        content: '<p>Tab Three Content</p>'
    }));
    
    myTabs.addTab( new YAHOO.widget.Tab({
        label: 'Tab Four Label',
        content: '<p>Tab Four Content</p>'
    }));
    
    myTabs.addTab( new YAHOO.widget.Tab({
        label: 'Tab Five Label',
        content: '<p>Tab Five Content</p>'
    }));

    Event.on('activeLabel', 'click', function() {
        alert('Active Tab Label: ' + myTabs.get('activeTab').get('label'));
    });
    

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
