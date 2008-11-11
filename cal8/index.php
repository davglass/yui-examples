<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Fixed Center Calendar</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #showCal {
            height: 35px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Fixed Center Calendar</a></h1></div>
    <div id="bd">
        <p>This example shows a calendar rendered in an Overlay with <code>fixedcenter</code> set to true.</p>
        <p><div id="showCal"></div></p>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event
        state = 'off';

    Event.onDOMReady(function() {
        var panel = new YAHOO.widget.Overlay('calHolder', {
            fixedcenter: true,
            visible: false
        });
        panel.setBody('<div id="cal1Container"></div>');
        panel.render(document.body);

        var cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container');
        cal1.render();

        var button = new YAHOO.widget.Button({
            container: 'showCal',
            value: 'test',
            label: 'Show Calendar'
        });
        button.on('click', function() {
            if (state == 'off') {
                state = 'on';
                panel.show();
                button.set('label', 'Hide Calendar');
            } else {
                state = 'off';
                panel.hide();
                button.set('label', 'Show Calendar');
            }
        });
    });
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/calendar/calendar-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/button/button-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event
        state = 'off';

    Event.onDOMReady(function() {
        var panel = new YAHOO.widget.Overlay('calHolder', {
            fixedcenter: true,
            visible: false
        });
        panel.setBody('<div id="cal1Container"></div>');
        panel.render(document.body);

        var cal1 = new YAHOO.widget.Calendar('cal1', 'cal1Container');
        cal1.render();

        var button = new YAHOO.widget.Button({
            container: 'showCal',
            value: 'test',
            label: 'Show Calendar'
        });
        button.on('click', function() {
            if (state == 'off') {
                state = 'on';
                panel.show();
                button.set('label', 'Hide Calendar');
            } else {
                state = 'off';
                panel.hide();
                button.set('label', 'Show Calendar');
            }
        });
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
