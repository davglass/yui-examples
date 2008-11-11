<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Panel: Proxy Drag</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #thecode {
            margin-top: 250px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Panel: Proxy Drag</a></h1></div>
    <div id="bd">
    <p>This example shows how to make a <a href="http://developer.yahoo.com/yui/container/panel">Panel</a> use DDProxy instead of DD.</p>
    <h2 id="thecode">The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var panel = new YAHOO.widget.Panel('demo', {
            draggable: false,
            width: '200px',
            visible: true,
            xy: [300,200]
        });
        panel.setHeader('Test Panel');
        panel.setBody('This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. ');
        panel.beforeRenderEvent.subscribe(function() {
            var dd = new YAHOO.util.DDProxy(panel.element);
            dd.setHandleElId(panel.header);
            dd.on('endDragEvent', function() {
                panel.show();
            });
        }, panel, true);
        panel.render(document.body);
    });
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var panel = new YAHOO.widget.Panel('demo', {
            draggable: false,
            width: '200px',
            visible: true,
            xy: [300,200]
        });
        panel.setHeader('Test Panel');
        panel.setBody('This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. This is a test. ');
        panel.beforeRenderEvent.subscribe(function() {
            var dd = new YAHOO.util.DDProxy(panel.element);
            dd.setHandleElId(panel.header);
            dd.on('endDragEvent', function() {
                panel.show();
            });
        }, panel, true);
        panel.render(document.body);
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
