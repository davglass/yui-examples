<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Vista style menu button</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2, #test {
            margin: 1em;
        }
        #status {
            border: 1px solid red;
            color: red;
            height: 25px;
            padding: 3px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Vista style menu button</a></h1></div>
    <div id="bd">
        <p>I don't use Windows so I don't know if this is exactly the way these buttons work, but here is my attempt at it.</p>
        <div id="status"></div>
        <div id="test"></div>
        <textarea name="code" class="JScript">
(function() {
    var menuClick = function(type, args, item) {
        var menu = item.parent;
        _button.set('label', item.cfg.getProperty('text')); 
        _button.set('value', item.value); 
        var menu_items = menu.getItems()
        for (var i = 0; i &lt; menu_items.length; i++) {
            //Uncheck the menu item
            menu_items[i].cfg.setProperty('checked', false);
        }
        item.cfg.setProperty('checked', true);
    };

    var _button = new YAHOO.widget.Button({
        type: 'split',
        label: 'One',
        value: '1',
        container: 'test',
        menu: [
            { text: 'One', value: '1', onclick: { fn: menuClick }, checked: true },
            { text: 'Two', value: '2', onclick: { fn: menuClick } },
            { text: 'Three', value: '3', onclick: { fn: menuClick } },
            { text: 'Four', value: '4', onclick: { fn: menuClick } }
        ]
    });
    _button.on('click', function() {
        //The current value
        var _currentValue = this.get('value');
        //The menu items
        var menu_items = this.getMenu().getItems();
        var next = 0;
        //Menu hasn't rendered yet, let's render it now..
        if (menu_items.length === 0) {
            this.getMenu()._onBeforeShow();
            menu_items = this.getMenu().getItems();
        }
        for (var i = 0; i &lt; menu_items.length; i++) {
            //Uncheck the menu item
            menu_items[i].cfg.setProperty('checked', false);
            //The value of the menu matches the current value
            if (menu_items[i].value == _currentValue) { //Current Menu Item
                if (i == (menu_items.length - 1)) { //We are at the end, start over
                    next = 0;
                } else {
                    next = i + 1; //The next menu item
                }
            }
        }
        //Check the proper menu item
        menu_items[next].cfg.setProperty('checked', true);
        //Set the label and the value of the button to the checked item
        this.set('value', menu_items[next].value);
        this.set('label', menu_items[next].cfg.getProperty('text'));
    }, _button, true);
    _button.on('valueChange', function(ev) {
        YAHOO.util.Dom.get('status').innerHTML = 'Button value changed from (' + ev.prevValue + ') to (' + ev.newValue + ')';
    });
})();
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
    var menuClick = function(type, args, item) {
        var menu = item.parent;
        _button.set('label', item.cfg.getProperty('text')); 
        _button.set('value', item.value); 
        var menu_items = menu.getItems()
        for (var i = 0; i < menu_items.length; i++) {
            //Uncheck the menu item
            menu_items[i].cfg.setProperty('checked', false);
        }
        item.cfg.setProperty('checked', true);
    };

    var _button = new YAHOO.widget.Button({
        type: 'split',
        label: 'One',
        value: '1',
        container: 'test',
        menu: [
            { text: 'One', value: '1', onclick: { fn: menuClick }, checked: true },
            { text: 'Two', value: '2', onclick: { fn: menuClick } },
            { text: 'Three', value: '3', onclick: { fn: menuClick } },
            { text: 'Four', value: '4', onclick: { fn: menuClick } }
        ]
    });
    _button.on('click', function() {
        //The current value
        var _currentValue = this.get('value');
        //The menu items
        var menu_items = this.getMenu().getItems();
        var next = 0;
        //Menu hasn't rendered yet, let's render it now..
        if (menu_items.length === 0) {
            this.getMenu()._onBeforeShow();
            menu_items = this.getMenu().getItems();
        }
        for (var i = 0; i < menu_items.length; i++) {
            //Uncheck the menu item
            menu_items[i].cfg.setProperty('checked', false);
            //The value of the menu matches the current value
            if (menu_items[i].value == _currentValue) { //Current Menu Item
                if (i == (menu_items.length - 1)) { //We are at the end, start over
                    next = 0;
                } else {
                    next = i + 1; //The next menu item
                }
            }
        }
        //Check the proper menu item
        menu_items[next].cfg.setProperty('checked', true);
        //Set the label and the value of the button to the checked item
        this.set('value', menu_items[next].value);
        this.set('label', menu_items[next].cfg.getProperty('text'));
    }, _button, true);
    _button.on('valueChange', function(ev) {
        YAHOO.util.Dom.get('status').innerHTML = 'Button value changed from (' + ev.prevValue + ') to (' + ev.newValue + ')';
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
