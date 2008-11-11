<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Making Dialog act like Module</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/container/assets/container.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/button/assets/button.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-dialog {
            display: none;
            position: absolute;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Making Dialog act like Module</a></h1></div>
    <div id="bd">
        <div id="open_cont"></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/button/button-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    dp.SyntaxHighlighter.HighlightAll('code');
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        //panel = null,
        _button = null;

        Event.onDOMReady(function() {
            panel = new YAHOO.widget.Dialog('test', {
                height: '200px',
                width: '350px',
                visible: false,
                xy: [ 300, 300 ]
            });
            panel.setHeader('Test');
            panel.setBody('This is a test. This is a test. This is a test. This is a test.');
            panel.render(document.body);

            panel.showEvent.subscribe(function() {
                Dom.setStyle(this.element, 'display', 'block');
            }, panel, true);

            panel.hideEvent.subscribe(function() {
                Dom.setStyle(this.element, 'display', 'none');
            }, panel, true);


            _button = new YAHOO.widget.Button({
                id: 'openButton',
                container: 'open_cont',
                label: 'Toggle Dialog'
            });
            _button.on('click', function() {
                if (Dom.getStyle(panel.element, 'display') == 'none') {
                    panel.show();
                } else {
                    panel.hide();
                }
            });
        });
})()

</script>
</body>
</html>
