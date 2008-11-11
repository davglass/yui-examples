<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: TabView - Scrolling Tabs</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            width: 350px;
        }
        #tab4, #tab5, #tab6, #tab7, #tab8, #tab9 {
            display: none;
        }
        #demo span.arrow {
            display: block;
            height: 2em;
            width: .5em;
            color: white;
            background:#2647A0 url(http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/sprite.png) repeat-x scroll left -1400px;
            position: absolute;
            top: 0;
            cursor: pointer;
        }
        #demo span.right {
            right: 0;
        }
        #demo span.left {
            left: 0;
        }
        #demo span.disabled {
            cursor: default;
            color: black;
            background: #D8D8D8 url(http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/sprite.png) repeat-x scroll 0 0;
        }
        #tab1 {
            margin-left: 9px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: TabView - Scrolling Tabs</a></h1></div>
    <div id="bd">
        <div id="demo" class="yui-navset">
            <span class="arrow left disabled" id="left">&lt;</span>
            <span class="arrow right" id="right">&gt;</span>
            <ul class="yui-nav">
                <li id="tab1" class="selected"><a href="#tab1"><em>Tab One Label</em></a></li>
                <li id="tab2"><a href="#tab2"><em>Tab Two Label</em></a></li>
                <li id="tab3"><a href="#tab3"><em>Tab Three Label</em></a></li>
                <li id="tab4"><a href="#tab4"><em>Tab Four Label</em></a></li>
                <li id="tab5"><a href="#tab5"><em>Tab Five Label</em></a></li>
                <li id="tab6"><a href="#tab6"><em>Tab Six Label</em></a></li>
                <li id="tab7"><a href="#tab7"><em>Tab Seven Label</em></a></li>
                <li id="tab8"><a href="#tab8"><em>Tab Eight Label</em></a></li>
                <li id="tab9"><a href="#tab9"><em>Tab Nine Label</em></a></li>
            </ul>            
            <div class="yui-content">
                <div><p>Tab One Content</p></div>
                <div style="display: none"><p>Tab Two Content</p></div>
                <div style="display: none"><p>Tab Three Content</p></div>
                <div style="display: none"><p>Tab Four Content</p></div>
                <div style="display: none"><p>Tab Five Content</p></div>
                <div style="display: none"><p>Tab Six Content</p></div>
                <div style="display: none"><p>Tab Seven Content</p></div>
                <div style="display: none"><p>Tab Eight Content</p></div>
                <div style="display: none"><p>Tab Nine Content</p></div>
            </div>
        </div>
        <p>&nbsp;</p>
        <textarea name="code" class="JScript">
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<form id="demoForm" action="index.php" method="post"><input type="hidden" id="demoURL" value=""></form>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/tabview/tabview-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myTabs = new YAHOO.widget.TabView("demo");
    var tabsCount = 3;
    var set = { tab1: true, tab2: true, tab3: true };

    Event.on('right', 'click', function() {
        var tabs = myTabs.get('tabs');
        console.log(tabs);
        for (var i = 0; i < tabs.length; i++) {
            console.log(tabs[i].get('id'), Dom.getStyle(tabs[i].get('element'), 'display'));
        }
        
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
