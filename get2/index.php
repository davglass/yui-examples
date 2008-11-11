<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Get and Pipes - Example 2</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #news {
            margin: 1em;
            width: 550px;
        }
        #news h3 {
            font-weight: bold;
        }
        #news .yui-content ul {
            margin-left: 20px;
        }
        #news .yui-content ul li {
            list-style-type: disc;
        }

        #news p {
            margin: 0;
            font-size: 85%;
        }
        #news img {
            padding: 8px;
        }
        #news .yui-nav li {
            margin: 0;
            padding: 0;
            margin-left: 1px;
            text-align: center;
        }
        
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Get and Pipes - Example 2</a></h1></div>
    <div id="bd">
        <p>I created a <a href="http://pipes.yahoo.com/pipes/pipe.info?_id=VE3fZVjT3BG0lA1gjtzu1g">Pipe</a> that builds a URL for a Yahoo! News feed, then using Pipes we can convert it to
        a useable JSON feed, then inject it into a <a href="http://developer.yahoo.com/yui/tabview">TabView</a> control.</p>
        <p>Now we can have a Yahoo! News Feed based TabView <strong>without</strong> a server side proxy.</p>
        <div id="news" class="yui-navset">
            <ul class="yui-nav">
                <li class="selected" id="newsTop"><a href="#tab1"><em>Top Stories</em></a></li>
                <li id="newsWorld"><a href="#tab2"><em>World</em></a></li>
                <li id="newsEnt"><a href="#tab3"><em>Entertainment</em></a></li>
                <li id="newsSports"><a href="#tab4"><em>Sports</em></a></li>
            </ul>
            <div class="yui-content">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Sel = YAHOO.util.Selector,
        Get = YAHOO.util.Get,
        tabView = null;

    YAHOO.namespace('GetExample');
        //Generic parse function
        var _filter = function(r) {
            var data = r.value.items,
                str = '';
                for (var i = 1; i < 8; i++) {
                    str += '<li><a href="' + data[i].link + '" target="_blank">' + data[i].title + '</a></li>';
                }
                str = '<ul>' + str + '</ul>';
                var d = data[0].description.replace('</a>', '<h3><a href="' + data[0].link + '">' + data[0].title + '</a></h3>');
                str =  d + str;
            return str;
        };
        //Get World News callback
        YAHOO.GetExample.getWorldNews = function(r) {
            var str = _filter(r);
            tabView.get('tabs')[1].set('content', str);
        };
        //Get Entertainment callback
        YAHOO.GetExample.getEntNews = function(r) {
            var str = _filter(r);
            tabView.get('tabs')[2].set('content', str);
        };
        //Get Sports News callback
        YAHOO.GetExample.getSportsNews = function(r) {
            var str = _filter(r);
            tabView.get('tabs')[3].set('content', str);
        };
        //Get Top News Callback
        YAHOO.GetExample.getTopNews = function(r) {
            //Filter the data
            var str = _filter(r);
            //Update the first tabs content
            tabView.get('tabs')[0].set('content', str);
            //Fire off the other Get commands to get the other data..
            Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=VE3fZVjT3BG0lA1gjtzu1g&newsfeed=world&_render=json&_callback=YAHOO.GetExample.getWorldNews'); 
            Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=VE3fZVjT3BG0lA1gjtzu1g&newsfeed=entertainment&_render=json&_callback=YAHOO.GetExample.getEntNews'); 
            Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=VE3fZVjT3BG0lA1gjtzu1g&newsfeed=sports&_render=json&_callback=YAHOO.GetExample.getSportsNews'); 
        };


    Event.onDOMReady(function() {
        //Create the tabView from markup..
        tabView = new YAHOO.widget.TabView('news');
        //Use Get to fetch the Pipe data, requesting a JSON view and a callback of YAHOO.GetExample.get
        Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=VE3fZVjT3BG0lA1gjtzu1g&newsfeed=topstories&_render=json&_callback=YAHOO.GetExample.getTopNews'); 
    });
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/selector/selector-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/get/get-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/element/element-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/tabview/tabview-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Sel = YAHOO.util.Selector,
        Get = YAHOO.util.Get,
        tabView = null;

    YAHOO.namespace('GetExample');
        //Generic parse function
        var _filter = function(r) {
            var data = r.value.items,
                str = '';
                for (var i = 1; i < 8; i++) {
                    str += '<li><a href="' + data[i].link + '" target="_blank">' + data[i].title + '</a></li>';
                }
                str = '<ul>' + str + '</ul>';
                var d = data[0].description.replace('</a>', '<h3><a href="' + data[0].link + '">' + data[0].title + '</a></h3>');
                str =  d + str;
            return str;
        };
        //Get World News callback
        YAHOO.GetExample.getWorldNews = function(r) {
            var str = _filter(r);
            tabView.get('tabs')[1].set('content', str);
        };
        //Get Entertainment callback
        YAHOO.GetExample.getEntNews = function(r) {
            var str = _filter(r);
            tabView.get('tabs')[2].set('content', str);
        };
        //Get Sports News callback
        YAHOO.GetExample.getSportsNews = function(r) {
            var str = _filter(r);
            tabView.get('tabs')[3].set('content', str);
        };
        //Get Top News Callback
        YAHOO.GetExample.getTopNews = function(r) {
            //Filter the data
            var str = _filter(r);
            //Update the first tabs content
            tabView.get('tabs')[0].set('content', str);
            //Fire off the other Get commands to get the other data..
            Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=VE3fZVjT3BG0lA1gjtzu1g&newsfeed=world&_render=json&_callback=YAHOO.GetExample.getWorldNews'); 
            Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=VE3fZVjT3BG0lA1gjtzu1g&newsfeed=entertainment&_render=json&_callback=YAHOO.GetExample.getEntNews'); 
            Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=VE3fZVjT3BG0lA1gjtzu1g&newsfeed=sports&_render=json&_callback=YAHOO.GetExample.getSportsNews'); 
        };


    Event.onDOMReady(function() {
        //Create the tabView from markup..
        tabView = new YAHOO.widget.TabView('news');
        //Use Get to fetch the Pipe data, requesting a JSON view and a callback of YAHOO.GetExample.get
        Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=VE3fZVjT3BG0lA1gjtzu1g&newsfeed=topstories&_render=json&_callback=YAHOO.GetExample.getTopNews'); 
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
