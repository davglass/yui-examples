<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Menu Button with icons</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yuimenuitemlabel {
            padding: 3px 25px;
            position: relative;
        }
        #button .yui-button {
            position: relative;
        }
        .yui-skin-sam .yui-button button, .yui-skin-sam .yui-button a {
            padding: 0 22px;
        }
        #button span.icon {
            display:block;
            height:18px;
            width:18px;
            position: absolute;
            top:0;
            left: 3px;
        }
        #button span.one-icon {
            background-image: url(icon1.gif);
        }
        #button span.two-icon {
            background-image: url(icon2.gif);
        }
        #button span.three-icon {
            background-image: url(icon3.gif);
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Menu Button with icons</a></h1></div>
    <div id="bd">
    <p>This example shows how to add icons to menu items in a Button.</p>
    <div id="button"></div>
    <h2>The CSS</h2>
    <textarea name="code" class="html">
        .yui-skin-sam .yuimenuitemlabel {
            padding: 3px 25px;
            position: relative;
        }
        #button .yui-button {
            position: relative;
        }
        .yui-skin-sam .yui-button button, .yui-skin-sam .yui-button a {
            padding: 0 22px;
        }
        #button span.icon {
            display:block;
            height:18px;
            width:18px;
            position: absolute;
            top:0;
            left: 3px;
        }
        #button span.one-icon {
            background-image: url(icon1.gif);
        }
        #button span.two-icon {
            background-image: url(icon2.gif);
        }
        #button span.three-icon {
            background-image: url(icon3.gif);
        }
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var onMenuItemClick = function(type, ev, item) {
        //Set the label to the selected item
        button.set('label', item.cfg.getProperty('text'));
    };

    var aMenuButton5Menu = [
        //Add some elements to skin..
		{ text: '<span class="icon one-icon"></span>One', value: 1, onclick: { fn: onMenuItemClick } },
		{ text: '<span class="icon two-icon"></span>Two', value: 2, onclick: { fn: onMenuItemClick } },
		{ text: '<span class="icon three-icon"></span>Three', value: 3, onclick: { fn: onMenuItemClick } }

	];


	var button = new YAHOO.widget.Button({
        type: "menu",
        //Set the default skin on the first item
        label: '<span class="icon one-icon"></span>One',
        id: 'button1',
        name: "mymenubutton",
        menu: aMenuButton5Menu,
        container: Dom.get('button')
    });

})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/button/button-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var onMenuItemClick = function(type, ev, item) {
        //Set the label to the selected item
        button.set('label', item.cfg.getProperty('text'));
    };

    var aMenuButton5Menu = [
        //Add some elements to skin..
		{ text: '<span class="icon one-icon"></span>One', value: 1, onclick: { fn: onMenuItemClick } },
		{ text: '<span class="icon two-icon"></span>Two', value: 2, onclick: { fn: onMenuItemClick } },
		{ text: '<span class="icon three-icon"></span>Three', value: 3, onclick: { fn: onMenuItemClick } }

	];


	var button = new YAHOO.widget.Button({
        type: "menu",
        //Set the default skin on the first item
        label: '<span class="icon one-icon"></span>One',
        id: 'button1',
        name: "mymenubutton",
        menu: aMenuButton5Menu,
        container: Dom.get('button')
    });


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
