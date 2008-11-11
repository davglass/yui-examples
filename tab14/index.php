<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: TabView: disabled tab</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2, #demo {
            margin: 1em;
        }
        .yui-skin-sam .yui-navset .yui-nav li.disabled {
            opacity: .5;
        }
        .yui-skin-sam .yui-navset .yui-nav li.disabled a,
        .yui-skin-sam .yui-navset .yui-nav li.disabled a:hover {
            background:#D8D8D8 url(sprite.png) repeat-x scroll 0% 50%;
            cursor: default;
        }

	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: TabView: disabled tab</a></h1></div>
    <div id="bd">
<div id="demo" class="yui-navset">
    <ul class="yui-nav">
        <li class="selected"><a href="#tab1"><em>Tab One Label</em></a></li>
        <li><a href="#tab2"><em>Tab Two Label</em></a></li>
        <li><a href="#tab3"><em>Tab Three Label</em></a></li>
    </ul>            
    <div class="yui-content">
        <div id="tab1"><p>Tab One Content</p></div>
        <div id="tab2"><p>Tab Two Content</p></div>
        <div id="tab3"><p>Tab Three Content</p></div>
    </div>
</div>
    <h2>The CSS</h2>
    <textarea name="code" class="CSS">
        .yui-skin-sam .yui-navset .yui-nav li.disabled {
            opacity: .5;
        }
        .yui-skin-sam .yui-navset .yui-nav li.disabled a, .yui-skin-sam .yui-navset .yui-nav li.disabled a:hover {
            background:#D8D8D8 url(sprite.png) repeat-x scroll 0% 50%;
            cursor: default;
        }
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
    var tabView = new YAHOO.widget.TabView('demo');
    tabView.get('tabs')[1].set('disabled', true);
    tabView.get('tabs')[2].set('disabled', true);
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/element/element-beta-min.js&2.6.0/build/tabview/tabview-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var tabView = new YAHOO.widget.TabView('demo');
    tabView.get('tabs')[1].set('disabled', true);
    tabView.get('tabs')[2].set('disabled', true);

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
