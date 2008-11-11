<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI:  Split Button w/ Dynamic Menu</title>
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Split Button w/ Dynamic Menu</a></h1></div>
    <div id="bd">
        <p>Click a link to add a different menu to the split button.</p>
        <p><strong>Update:</strong> I updated this example based on feedback from Menu/Button author Todd Kloots.</p>
        <div id="test"></div>
        <p>
        <a href="#" id="menu1">[Add Menu 1]</a>
        <a href="#" id="menu2">[Add Menu 2]</a>
        </p>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        _button = null,
        oMenu = null;

    Event.onAvailable('test', function() {
        
        oMenu = new YAHOO.widget.Menu('menu_holder');


        _button = new YAHOO.widget.Button({
            type: 'split',
            label: 'Test Split',
            value: 'test1',
            disabled: true,
            lazyloadmenu: false,
            container: 'test',
            menu: oMenu
        });
    });

    Event.on('menu1', 'click', function(ev) {
        Event.stopEvent(ev);
        var menu = [
            { text: "Menu 1 - One", value: 1 },
            { text: "Menu 1 - Two", value: 2 },
            { text: "Menu 1 - Three", value: 3 }
        ];
        var aItems = oMenu.getItems();

        if (aItems.length > 0) { 
            oMenu.clearContent();
        }

        oMenu.addItems(menu);
        if (Dom.inDocument('menu_holder')) {
            oMenu.render();
        } else {
            oMenu.render(document.body);
        }
        _button.set('disabled', false);
    });

    Event.on('menu2', 'click', function(ev) {
        Event.stopEvent(ev);
        var menu = [
            { text: "Menu 2 - One", value: 1 },
            { text: "Menu 2 - Two", value: 2 },
            { text: "Menu 2 - Three", value: 3 }
        ];
        var aItems = oMenu.getItems();

        if (aItems.length > 0) { 
            oMenu.clearContent();
        }

        oMenu.addItems(menu);
        if (Dom.inDocument('menu_holder')) {
            oMenu.render();
        } else {
            oMenu.render(document.body);
        }
        _button.set('disabled', false);
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})()        
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/button/button-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        _button = null,
        oMenu = null;

    Event.onAvailable('test', function() {
        
        oMenu = new YAHOO.widget.Menu('menu_holder');


        _button = new YAHOO.widget.Button({
            type: 'split',
            label: 'Test Split',
            value: 'test1',
            disabled: true,
            lazyloadmenu: false,
            container: 'test',
            menu: oMenu
        });
    });

    Event.on('menu1', 'click', function(ev) {
        Event.stopEvent(ev);
        var menu = [
            { text: "Menu 1 - One", value: 1 },
            { text: "Menu 1 - Two", value: 2 },
            { text: "Menu 1 - Three", value: 3 }
        ];
        var aItems = oMenu.getItems();

        if (aItems.length > 0) { 
            oMenu.clearContent();
        }

        oMenu.addItems(menu);
        if (Dom.inDocument('menu_holder')) {
            oMenu.render();
        } else {
            oMenu.render(document.body);
        }
        _button.set('disabled', false);
    });

    Event.on('menu2', 'click', function(ev) {
        Event.stopEvent(ev);
        var menu = [
            { text: "Menu 2 - One", value: 1 },
            { text: "Menu 2 - Two", value: 2 },
            { text: "Menu 2 - Three", value: 3 }
        ];
        var aItems = oMenu.getItems();

        if (aItems.length > 0) { 
            oMenu.clearContent();
        }

        oMenu.addItems(menu);
        if (Dom.inDocument('menu_holder')) {
            oMenu.render();
        } else {
            oMenu.render(document.body);
        }
        _button.set('disabled', false);
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
