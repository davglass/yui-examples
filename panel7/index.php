<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor inside of a Dialog</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #bd {
            _height: 800px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor inside of a Dialog</a></h1></div>
    <div id="bd">
        <p>This example shows a YUI Editor inside of a <a href="http://developer.yahoo.com/yui/container/dialog/index.html">Dialog Control</a></p>
        <div id="buttonHolder"></div>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        panel = null,
        button = null,
        showing = false,
        myEditor = null;

    Event.on(window, 'load', function() {
        panel = new YAHOO.widget.Dialog('demo', {
            visible: false,
            width: '580px',
            fixedcenter: true,
            modal: true
        });
        panel.setHeader('Editor');
        panel.setBody('&lt;textarea id="editor"&gt;<b>This</b> <i>is some</i> test text.&lt;/textarea&gt;');
        panel.hideEvent.subscribe(function() {
            myEditor.hide();
            showing = false;
        });
        panel.showEvent.subscribe(function() {
            myEditor.show();
            showing = true;
        });
        panel.render(document.body);
    });

    button = new YAHOO.widget.Button({
        label: 'Toggle Editor',
        value: 'toggle',
        container: 'buttonHolder'
    });

    button.on('click', function() {
        if (showing) {
            panel.hide();
        } else {
            panel.show();
        }
    });

    myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px',
        height: '250px'
    });
    myEditor.on('afterRender', function() {
        myEditor.hide();
    });
    myEditor.render();
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/element/element-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container-min.js"></script>     
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/menu/menu-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/editor/editor-beta-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        panel = null,
        button = null,
        showing = false,
        myEditor = null;

    Event.on(window, 'load', function() {
        panel = new YAHOO.widget.Dialog('demo', {
            visible: false,
            width: '580px',
            fixedcenter: true,
            modal: true
        });
        panel.setHeader('Editor');
        panel.setBody('<textarea id="editor"><b>This</b> <i>is some</i> test text.</textarea>');
        panel.hideEvent.subscribe(function() {
            myEditor.hide();
            showing = false;
        });
        panel.showEvent.subscribe(function() {
            myEditor.show();
            showing = true;
        });
        panel.render(document.body);
    });

    button = new YAHOO.widget.Button({
        label: 'Toggle Editor',
        value: 'toggle',
        container: 'buttonHolder'
    });

    button.on('click', function() {
        if (showing) {
            panel.hide();
        } else {
            panel.show();
        }
    });

    myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px',
        height: '250px'
    });
    myEditor.on('afterRender', function() {
        myEditor.hide();
    });
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
