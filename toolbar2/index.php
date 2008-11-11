<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Toolbar Dynamic Showing Buttons</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #cont {
            margin: 1em;
        }
        #control {
            margin: 3em;
            border: 1px solid black;
            background-color: #f2f2f2;
            height: 25px;
        }
        #action {
            width: 95px;
        }
        #year {
            width: 50px;
        }
        #placement1, #placement2, #placement3, #creative1, #creative2 {
            width: 100px;
        }
        #placement1 a, #placement2 a, #placement3 a {
            padding-left: 12px;
        }
        #creative1, #creative2 {
            display: none;
        }
        #creative1 a, #creative2 a {
            padding-left: 12px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Toolbar Dynamic Showing Buttons</a></h1></div>
    <div id="bd">
        <div class="yui-editor-container" id="cont">
            <div id="toolbar"></div>
        </div>
        <div id="control">Toolbar Output</div>
        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
        <div class="yui-editor-container" id="cont">
            <div id="toolbar"></div>
        </div>
        <div id="control">Toolbar Output</div>
        </textarea>
        <h2>The CSS</h2>
        <textarea name="code" class="HTML">
    <style type="text/css" media="screen">
        #cont {
            margin: 1em;
        }
        #control {
            margin: 3em;
            border: 1px solid black;
            background-color: #f2f2f2;
            height: 25px;
        }
        #action {
            width: 95px;
        }
        #year {
            width: 50px;
        }
        #placement1, #placement2, #placement3, #creative1, #creative2 {
            width: 100px;
        }
        #placement1 a, #placement2 a, #placement3 a {
            padding-left: 12px;
        }
        #creative1, #creative2 {
            display: none;
        }
        #creative1 a, #creative2 a {
            padding-left: 12px;
        }
	</style>
        </textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var tbar = new YAHOO.widget.Toolbar('toolbar', {
        buttonType: 'advanced',
        buttons: [
            { group: 'actions', label: 'Actions',
                buttons: [
                    { type: 'separator' },
                    { type: 'select', label: 'Placement', value: 'action', id: 'action',
                        menu: [
                            { text: 'Placement', checked: true },
                            { text: 'Creative' }
                        ]
                    },
                    { type: 'separator' },
                    { type: 'select', label: '2007', value: 'year', id: 'year',
                        menu: [
                            { text: '2007', checked: true },
                            { text: '2008' }
                        ]
                    },
                    { type: 'separator' },
                    { type: 'menu', label: 'Placement 1', value: 'placement1', id: 'placement1',
                        menu: [
                            { text: 'Custom Action 1', value: 'action11'},
                            { text: 'Custom Action 2', value: 'action21' }
                        ]
                    },
                    { type: 'menu', label: 'Placement 2', value: 'placement2', id: 'placement2',
                        menu: [
                            { text: 'Custom Action 1', value: 'action12'},
                            { text: 'Custom Action 2', value: 'action22' }
                        ]
                    },
                    { type: 'menu', label: 'Placement 3', value: 'placement3', id: 'placement3',
                        menu: [
                            { text: 'Custom Action 1', value: 'action13'},
                            { text: 'Custom Action 2', value: 'action23' }
                        ]
                    },
                    { type: 'menu', label: 'Creative 1', value: 'creative1', id: 'creative1',
                        menu: function() {
                            var menu = [];
                            for (var i = 1; i < 300; i++) {
                                menu[menu.length] = { text: 'Custom Action ' + i, value: 'action' + (i) + '4'};
                            }
                            return menu;
                        }()
                        /*[
                            { text: 'Custom Action 1', value: 'action14'},
                            { text: 'Custom Action 2', value: 'action24' }
                        ]*/
                    },
                    { type: 'menu', label: 'Creative 2', value: 'creative2', id: 'creative2',
                        menu: [
                            { text: 'Custom Action 1', value: 'action15' },
                            { text: 'Custom Action 2', value: 'action25',
                                submenu: {
                                    id: Dom.generateId(),
                                    itemdata: [
                                        { text: 'Custom Action 2-1', value: 'action25-1' },
                                        { text: 'Custom Action 2-2', value: 'action25-2' },
                                        { text: 'Custom Action 2-3', value: 'action25-3' }
                                    ] 
                                }
                            }
                        ]
                    }
                ]
            }
        ]
    });
    tbar.on('actionClick', function(ev) {
        var value = ev.button.value.toLowerCase(),
            dis1 = 'none', dis2 = 'block';

        if (value == 'placement') {
            Dom.get('control').innerHTML = 'Changing to Placement buttons';
            dis1 = 'block', dis2 = 'none';
        } else {
            Dom.get('control').innerHTML = 'Changing to Creative buttons';
        }
        this.getButtonById('year').setStyle('display', dis1);
        this.getButtonById('placement1').setStyle('display', dis1);
        this.getButtonById('placement2').setStyle('display', dis1);
        this.getButtonById('placement3').setStyle('display', dis1);

        this.getButtonById('creative1').setStyle('display', dis2);
        this.getButtonById('creative2').setStyle('display', dis2);
        return false;
    }, tbar, true);
    tbar.on('action12Click', function(ev) {
        Dom.get('control').innerHTML = 'Menu (' + ev.button.menucmd + '): ' + ev.button.value;
        return false;
    });
    tbar.on('buttonClick', function(ev) {
        Dom.get('control').innerHTML = 'Button (' + ev.button.menucmd + '): ' + ev.button.value;
    });
    tbar.set('grouplabels', false);

    //Hack the maxheight config for creative1
    tbar.getButtonById('creative1').getMenu().cfg.subscribeToConfigEvent("maxheight", function (p_sType, p_aArgs) {
        var nMaxHeight = p_aArgs[0];
        if (nMaxHeight != 150) {
            this.cfg.setProperty("maxheight", 150);
        }
    });
    //Now set it
    tbar.getButtonById('creative1').getMenu().cfg.setProperty("maxheight", 50);

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/editor/simpleeditor-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var tbar = new YAHOO.widget.Toolbar('toolbar', {
        buttonType: 'advanced',
        buttons: [
            { group: 'actions', label: 'Actions',
                buttons: [
                    { type: 'separator' },
                    { type: 'select', label: 'Placement', value: 'action', id: 'action',
                        menu: [
                            { text: 'Placement', checked: true },
                            { text: 'Creative' }
                        ]
                    },
                    { type: 'separator' },
                    { type: 'select', label: '2007', value: 'year', id: 'year',
                        menu: [
                            { text: '2007', checked: true },
                            { text: '2008' }
                        ]
                    },
                    { type: 'separator' },
                    { type: 'menu', label: 'Placement 1', value: 'placement1', id: 'placement1',
                        menu: [
                            { text: 'Custom Action 1', value: 'action11'},
                            { text: 'Custom Action 2', value: 'action21' }
                        ]
                    },
                    { type: 'menu', label: 'Placement 2', value: 'placement2', id: 'placement2',
                        menu: [
                            { text: 'Custom Action 1', value: 'action12'},
                            { text: 'Custom Action 2', value: 'action22' }
                        ]
                    },
                    { type: 'menu', label: 'Placement 3', value: 'placement3', id: 'placement3',
                        menu: [
                            { text: 'Custom Action 1', value: 'action13'},
                            { text: 'Custom Action 2', value: 'action23' }
                        ]
                    },
                    { type: 'menu', label: 'Creative 1', value: 'creative1', id: 'creative1',
                        menu: function() {
                            var menu = [];
                            for (var i = 1; i < 300; i++) {
                                menu[menu.length] = { text: 'Custom Action ' + i, value: 'action' + (i) + '4'};
                            }
                            return menu;
                        }()
                        /*[
                            { text: 'Custom Action 1', value: 'action14'},
                            { text: 'Custom Action 2', value: 'action24' }
                        ]*/
                    },
                    { type: 'menu', label: 'Creative 2', value: 'creative2', id: 'creative2',
                        menu: [
                            { text: 'Custom Action 1', value: 'action15' },
                            { text: 'Custom Action 2', value: 'action25',
                                submenu: {
                                    id: Dom.generateId(),
                                    itemdata: [
                                        { text: 'Custom Action 2-1', value: 'action25-1' },
                                        { text: 'Custom Action 2-2', value: 'action25-2' },
                                        { text: 'Custom Action 2-3', value: 'action25-3' }
                                    ] 
                                }
                            }
                        ]
                    }
                ]
            }
        ]
    });
    tbar.on('actionClick', function(ev) {
        var value = ev.button.value.toLowerCase(),
            dis1 = 'none', dis2 = 'block';

        if (value == 'placement') {
            Dom.get('control').innerHTML = 'Changing to Placement buttons';
            dis1 = 'block', dis2 = 'none';
        } else {
            Dom.get('control').innerHTML = 'Changing to Creative buttons';
        }
        this.getButtonById('year').setStyle('display', dis1);
        this.getButtonById('placement1').setStyle('display', dis1);
        this.getButtonById('placement2').setStyle('display', dis1);
        this.getButtonById('placement3').setStyle('display', dis1);

        this.getButtonById('creative1').setStyle('display', dis2);
        this.getButtonById('creative2').setStyle('display', dis2);
        return false;
    }, tbar, true);
    tbar.on('action12Click', function(ev) {
        Dom.get('control').innerHTML = 'Menu (' + ev.button.menucmd + '): ' + ev.button.value;
        return false;
    });
    tbar.on('buttonClick', function(ev) {
        Dom.get('control').innerHTML = 'Button (' + ev.button.menucmd + '): ' + ev.button.value;
    });
    tbar.set('grouplabels', false);

    //Hack the maxheight config for creative1
    tbar.getButtonById('creative1').getMenu().cfg.subscribeToConfigEvent("maxheight", function (p_sType, p_aArgs) {
        var nMaxHeight = p_aArgs[0];
        if (nMaxHeight != 150) {
            this.cfg.setProperty("maxheight", 150);
        }
    });
    //Now set it
    tbar.getButtonById('creative1').getMenu().cfg.setProperty("maxheight", 50);

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
