<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: ContextMenu Close Tab</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/menu/assets/menu.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
    #demo {
        width: 90%;
        margin: 1em;
    }
    #demo ul.yui-nav {
        zoom: 1;
    }
    #demo ul.yui-nav:after {
       display: block;
       clear: both;
       visibility: hidden;
       content: '.';
       height: 0;
    }
 
    #demo ul.yui-nav li {
        float: left;
        cursor: pointer;
        display: block;
        padding: .25em;
        border-top: 1px solid black;
        border-right: 1px solid black;
        border-left: 1px solid black;
        margin: .25em .25em -1px .25em;
    }

    #demo div.tab1, #demo div.tab2, #demo div.tab3 {
        padding: 0;
        margin: 0;
        height: 100%;
    }
    #demo ul.yui-nav li.selected {
        background-color: #ccc;
    }

    #demo ul.yui-nav li {
        position: relative;
        padding-right: 20px;
    }

    #demo ul.yui-nav li a {
        text-decoration: none;
        color: black;
    }

    #demo div.yui-content {
        border: 1px solid black;
        height: 250px;
        background-color: #ccc;
    }

    #demo .tab2, #demo .tab3 {
        display: none;
    }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Using a ContextMenu to Close a Tab</a></h1></div>
    <div id="bd">
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li class="tab1 selected">Tab One Label</li>
                <li class="tab2">Tab Two Label</li>
                <li class="tab3">Tab Three Label</li>
            </ul>            
            <div class="yui-content">
                <div class="tab1">Tab One Content</div>
                <div class="tab2">Tab Two Content</div>
                <div class="tab3">Tab Three Content</div>
            </div>
        </div>
        <h2>The Code</h2>
        <textarea class="JScript" name="code">
YAHOO.example.tabs = function() {
    var myTabs = new YAHOO.widget.TabView('demo');

    myTabs.on('contentReady', function() { // ensure Tabs exist before accessing
        
        var oContextMenu = new YAHOO.widget.ContextMenu('contextmenu', {
            trigger: myTabs._contentParent,
            lazyload: true,
            itemdata: [
                { text: 'Close This Tab' }
            ]
        });
        oContextMenu.clickEvent.subscribe(function() {
            //Don't close the last one
            if (myTabs.get('tabs').length > 1) {
                var tab = myTabs.get('activeTab');
                myTabs.removeTab(tab);
            }
        }, this, true);

        var oContextMenu2 = new YAHOO.widget.ContextMenu('contextmenu2', {
            trigger: myTabs._tabParent,
            lazyload: true,
            itemdata: [
                { text: 'Close This Tab' }
            ]
        });
        oContextMenu2.clickEvent.subscribe(function(ev, menuEvent, tabInstance) {
            var tar = menuEvent[1].parent.contextEventTarget;
            var tabs = myTabs.get('tabs');
            if (tabs.length > 1) {
                for (var i = 0; i < tabs.length; i++) {
                    if (tabs[i].get('element') == tar) {
                        //This is the one we clicked
                        myTabs.removeTab(tabs[i]);
                        break;
                    }
                }
            }
        }, this, true);
    });
    
}();
</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/tabview/tabview-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
YAHOO.example.tabs = function() {
    var myTabs = new YAHOO.widget.TabView('demo');

    myTabs.on('contentReady', function() { // ensure Tabs exist before accessing
        
        var oContextMenu = new YAHOO.widget.ContextMenu('contextmenu', {
            trigger: myTabs._contentParent,
            lazyload: true,
            itemdata: [
                { text: 'Close This Tab' }
            ]
        });
        oContextMenu.clickEvent.subscribe(function() {
            //Don't close the last one
            if (myTabs.get('tabs').length > 1) {
                var tab = myTabs.get('activeTab');
                myTabs.removeTab(tab);
            }
        }, this, true);

        var oContextMenu2 = new YAHOO.widget.ContextMenu('contextmenu2', {
            trigger: myTabs._tabParent,
            lazyload: true,
            itemdata: [
                { text: 'Close This Tab' }
            ]
        });
        oContextMenu2.clickEvent.subscribe(function(ev, menuEvent, tabInstance) {
            var tar = menuEvent[1].parent.contextEventTarget;
            var tabs = myTabs.get('tabs');
            if (tabs.length > 1) {
                for (var i = 0; i < tabs.length; i++) {
                    if (tabs[i].get('element') == tar) {
                        //This is the one we clicked
                        myTabs.removeTab(tabs[i]);
                        break;
                    }
                }
            }
        }, this, true);
    });
    
}();


$E.addListener(window, 'load', function() { dp.SyntaxHighlighter.HighlightAll('code'); });

</script>
</body>
</html>
