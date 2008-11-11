<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: TabView: Add a close button to a tab </title>
    <link rel="stylesheet" href="http://us.js2.yimg.com/us.js.yimg.com/lib/common/css/reset-fonts-grids_2.1.2.css" type="text/css">
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

    #demo ul.yui-nav li span.close {
        background-image: url(http://us.i1.yimg.com/us.yimg.com/i/nt/ic/ut/alt3/close12_1.gif);
        text-indent: 500px;
        display: block;
        overflow: hidden;
        width: 12px;
        height: 12px;
        position: absolute;
        top: 2px;
        right: 2px;
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: TabView: Add a close button to a tab</a></h1></div>
    <div id="bd">
        <h2>Dynamically create and delete a tab</h2>
        <p><a href="#" id="add-tab">Click here to add a new tab</a></p>
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li class="tab1 selected"><a href="#"><em>Tab One Label</em></a></li>
                <li class="tab2"><a href="#"><em>Tab Two Label<span class="close">X</span></em></a></li>
                <li class="tab3"><a href="#"><em>Tab Three Label<span class="close">X</span></em></a></li>
            </ul>            
            <div class="yui-content">
                <div class="tab1">Tab One Content</div>
                <div class="tab2">Tab Two Content</div>
                <div class="tab3">Tab Three Content</div>
            </div>
        </div>
        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
<p><a href="#" id="add-tab">Click here to add a new tab</a></p>
<div id="demo" class="yui-navset">
    <ul class="yui-nav">
        <li class="tab1 selected"><a href="#"><em>Tab One Label</em></a></li>
        <li class="tab2"><a href="#"><em>Tab Two Label<span class="close">X</span></em></a></li>
        <li class="tab3"><a href="#"><em>Tab Three Label<span class="close">X</span></em></a></li>
    </ul>            
    <div class="yui-content">
        <div class="tab1">Tab One Content</div>
        <div class="tab2">Tab Two Content</div>
        <div class="tab3">Tab Three Content</div>
    </div>
</div>
</textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
YAHOO.example.tabs = function() {
    var t_counter = 0;  // iterator for new tab labels
    
    var myTabs = new YAHOO.widget.TabView('demo');
    
    myTabs.on('contentReady', function() { // ensure Tabs exist before accessing
        YAHOO.util.Dom.batch(myTabs.get('tabs'), function(tab) {
            YAHOO.util.Event.on(tab.getElementsByClassName('close')[0], 'click', handleClose, tab);
        });
        
        YAHOO.util.Event.on('add-tab', 'click', addTab, myTabs, true);
    });
    
    var handleClose = function(e, tab) {
        YAHOO.util.Event.preventDefault(e);
        myTabs.removeTab(tab);
    };
    
    function addTab(e) {
        YAHOO.util.Event.preventDefault(e);
        t_counter++;
        var newTab = new YAHOO.widget.Tab({
            label: 'New Tab #' + t_counter + '<span class="close">X</span>',
            content: 'New tab content for Tab # ' + t_counter + ' goes here.'
        });
        
        this.addTab(newTab);
        YAHOO.util.Event.on(newTab.getElementsByClassName('close')[0], 'click', handleClose, newTab);
    };
}();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>


<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/tabview/tabview-min.js"></script> 
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
YAHOO.example.tabs = function() {
    var t_counter = 0;  // iterator for new tab labels
    
    var myTabs = new YAHOO.widget.TabView('demo');
    
    myTabs.on('contentReady', function() { // ensure Tabs exist before accessing
        YAHOO.util.Dom.batch(myTabs.get('tabs'), function(tab) {
            YAHOO.util.Event.on(tab.getElementsByClassName('close')[0], 'click', handleClose, tab);
        });
        
        YAHOO.util.Event.on('add-tab', 'click', addTab, myTabs, true);
    });
    
    var handleClose = function(e, tab) {
        YAHOO.util.Event.preventDefault(e);
        myTabs.removeTab(tab);
    };
    
    function addTab(e) {
        YAHOO.util.Event.preventDefault(e);
        t_counter++;
        var newTab = new YAHOO.widget.Tab({
            label: 'New Tab #' + t_counter + '<span class="close">X</span>',
            content: 'New tab content for Tab # ' + t_counter + ' goes here.'
        });
        
        this.addTab(newTab);
        YAHOO.util.Event.on(newTab.getElementsByClassName('close')[0], 'click', handleClose, newTab);
    };
}();


YAHOO.util.Event.on(window, 'load', function() { dp.SyntaxHighlighter.HighlightAll('code'); });

</script>
</body>
</html>
