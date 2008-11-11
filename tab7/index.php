<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: TabView - open tab from url</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css"> 
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: TabView - open tab from url</a></h1></div>
    <div id="bd">
        <p>This example will show how to set the active tab based on the #hash value passed to the url.</p>
        <p>It's a little hard to test since it need a reload and by nature #hash url's don't reload the page.</p>
        <p>Click the links below to simulate coming from another page.
            <ul id="demoLinks">
                <li><a href="#tab1">Tab One</a></li>
                <li><a href="#tab2">Tab Two</a></li>
                <li><a href="#tab3">Tab Three</a></li>
                <li><a href="#tab4">Tab Four</a></li>
                <li><a href="#tab5">Tab Five</a></li>
            </ul>
        </p>
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li class="selected"><a href="#tab1"><em>Tab One Label</em></a></li>
                <li><a href="#tab2"><em>Tab Two Label</em></a></li>
                <li><a href="#tab3"><em>Tab Three Label</em></a></li>
                <li><a href="#tab4"><em>Tab Four Label</em></a></li>
                <li><a href="#tab5"><em>Tab Five Label</em></a></li>
            </ul>            
            <div class="yui-content">
                <div><p>Tab One Content</p></div>
                <div style="display: none"><p>Tab Two Content</p></div>
                <div style="display: none"><p>Tab Three Content</p></div>
                <div style="display: none"><p>Tab Four Content</p></div>
                <div style="display: none"><p>Tab Five Content</p></div>
            </div>
        </div>
        <p>&nbsp;</p>
        <textarea name="code" class="JScript">
(function() {
    var myTabs = new YAHOO.widget.TabView("demo");
    
    var url = location.href.split('#');
    if (url[1]) {
        //We have a hash
        var tabHash = url[1];
        var tabs = myTabs.get('tabs');
        for (var i = 0; i < tabs.length; i++) {
            if (tabs[i].get('href') == '#' + tabHash) {
                myTabs.set('activeIndex', i);
                break;
            }
        }
    }
})()       
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<form id="demoForm" action="index.php" method="post"><input type="hidden" id="demoURL" value=""></form>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/tabview/tabview-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var myTabs = new YAHOO.widget.TabView("demo");
    
    var url = location.href.split('#');
    if (url[1]) {
        //We have a hash
        var tabHash = url[1];
        var tabs = myTabs.get('tabs');
        for (var i = 0; i < tabs.length; i++) {
            if (tabs[i].get('href') == '#' + tabHash) {
                myTabs.set('activeIndex', i);
                break;
            }
        }
    }

    dp.SyntaxHighlighter.HighlightAll('code');

    YAHOO.util.Event.onAvailable('demoLinks', function() {
        YAHOO.util.Event.on('demoLinks', 'click', function(ev) {
            var tar = YAHOO.util.Event.getTarget(ev);
            if (tar.tagName.toLowerCase() == 'a') {
                var hash = tar.getAttribute('href', 2);
                YAHOO.util.Dom.get('demoForm').setAttribute('action', 'index.php' + hash);
                YAHOO.util.Dom.get('demoForm').submit();
            }
        });
    });
})()

</script>
</body>
</html>
