<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Layout: Inside a TabView</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            width: 500px;
            margin: 2em;
        }
        #demo .yui-content {
            height: 400px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Layout: Inside a TabView</a></h1></div>
    <div id="bd">
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li><a href="#tab1"><em>Tab One Label</em></a></li>
                <li class="selected"><a href="#tab2"><em>Tab Two Label</em></a></li>
                <li><a href="#tab3"><em>Tab Three Label</em></a></li>
            </ul>            
            <div class="yui-content">
                <div id="tab1"><p>Tab One Content</p></div>
                <div id="tab2"><p>Tab Two Content</p></div>
                <div id="tab3"><p>Tab Three Content</p></div>
            </div>
        </div>
        <h2>Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var tabView = new YAHOO.widget.TabView('demo');
    var tab2 = tabView.get('tabs')[1];
    var cont = tab2.get('contentEl');
    cont.innerHTML = '';

    var layout = new YAHOO.widget.Layout(cont, {
        width: cont.offsetWidth - 10,
        height: cont.parentNode.offsetHeight - 10,
        minWidth: 300,
        minHeight: 300,
        units: [
            { position: 'left', resize: true, body: 'Left Body', width: 100 },
            { position: 'top', resize: true, body: 'Top Body', height: 25 },
            { position: 'center',  body: 'Layout body' }
        ]
    });
    layout.render();
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/utilities/utilities.js&2.6.0/build/resize/resize-min.js&2.6.0/build/selector/selector-beta-min.js&2.6.0/build/layout/layout-min.js&2.6.0/build/tabview/tabview-min.js"></script>
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var tabView = new YAHOO.widget.TabView('demo');
    var tab2 = tabView.get('tabs')[1];
    var cont = tab2.get('contentEl');
    cont.innerHTML = '';

    var layout = new YAHOO.widget.Layout(cont, {
        width: cont.offsetWidth - 10,
        height: cont.parentNode.offsetHeight - 10,
        minWidth: 300,
        minHeight: 300,
        units: [
            { position: 'left', resize: true, body: 'Left Body', width: 100 },
            { position: 'top', resize: true, body: 'Top Body', height: 25 },
            { position: 'center',  body: 'Layout body' }
        ]
    });
    layout.render();
    

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
