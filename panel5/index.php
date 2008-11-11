<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Panel and Button</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/container/assets/container.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/button/assets/button.css"> 
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Panel and Button</a></h1></div>
    <div id="bd">
        <div id="buttonHolder"></div>
        <h2>The Code</h2>
        <textarea class="JScript" name="code">
YAHOO.util.Event.on(window, 'load', function() {
    YAHOO.namespace('example.panel');
    YAHOO.example.panel._buttons = [];
    YAHOO.example.panel.handleSubmit = function() {
        alert('You clicked submit');
    }
    YAHOO.example.panel.handleCancel = function() {
        alert('You clicked cancel');
        YAHOO.example.panel.dialog.hide();
    }
    YAHOO.example.panel.dialog = new YAHOO.widget.Dialog('test', {
        height: '100px',
        width: '300px',
        visible: false,
        fixedcenter: true,
        position: 'absolute',
        modal: true
    });
    YAHOO.example.panel.dialog.setHeader('Test Dialog');
    YAHOO.example.panel.dialog.setBody('Login: <form><input type="text" value=""></form>');
    YAHOO.example.panel.dialog.setFooter('<span id="buttonSpan" class="button-group"></span>');
    YAHOO.example.panel.dialog.showEvent.subscribe(function() {
        if (this._buttons.length == 0) {
            this._buttons[0] = new YAHOO.widget.Button({
                type: 'button',
                label: 'Submit',
                container: 'panelFooter'
            });
            this._buttons[0].on('click', YAHOO.example.panel.handleSubmit);
            this._buttons[1] = new YAHOO.widget.Button({
                type: 'button',
                label: 'Cancel',
                container: 'panelFooter'
            });
            this._buttons[1].on('click', YAHOO.example.panel.handleCancel);
        }

    }, YAHOO.example.panel, true);
    YAHOO.example.panel.dialog.render(document.body);

    var openDialog = new YAHOO.widget.Button({
        label: 'Open Panel',
        type: 'button',
        container: 'buttonHolder'
    });

    openDialog.on('click', function(ev) {
        YAHOO.example.panel.dialog.show();
        YAHOO.util.Event.stopEvent(ev);
    });
});
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/button/button-beta-min.js"></script> 
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

YAHOO.util.Event.on(window, 'load', function() {
    YAHOO.namespace('example.panel');
    YAHOO.example.panel._buttons = [];
    YAHOO.example.panel.handleSubmit = function() {
        alert('You clicked submit');
    }
    YAHOO.example.panel.handleCancel = function() {
        alert('You clicked cancel');
        YAHOO.example.panel.dialog.hide();
    }
    YAHOO.example.panel.dialog = new YAHOO.widget.Dialog('test', {
        height: '100px',
        width: '300px',
        visible: false,
        fixedcenter: true,
        position: 'absolute',
        modal: true
    });
    YAHOO.example.panel.dialog.setHeader('Test Dialog');
    YAHOO.example.panel.dialog.setBody('Login: <form><input type="text" value=""></form>');
    YAHOO.example.panel.dialog.setFooter('<span id="buttonSpan" class="button-group"></span>');
    YAHOO.example.panel.dialog.showEvent.subscribe(function() {
        if (this._buttons.length == 0) {
            this._buttons[0] = new YAHOO.widget.Button({
                type: 'button',
                label: 'Submit',
                container: 'buttonSpan'
            });
            this._buttons[0].on('click', YAHOO.example.panel.handleSubmit);
            this._buttons[1] = new YAHOO.widget.Button({
                type: 'button',
                label: 'Cancel',
                container: 'buttonSpan'
            });
            this._buttons[1].on('click', YAHOO.example.panel.handleCancel);
        }

    }, YAHOO.example.panel, true);
    YAHOO.example.panel.dialog.render(document.body);

    var openDialog = new YAHOO.widget.Button({
        label: 'Open Panel',
        type: 'button',
        container: 'buttonHolder'
    });

    openDialog.on('click', function(ev) {
        YAHOO.example.panel.dialog.show();
        YAHOO.util.Event.stopEvent(ev);
    });

    dp.SyntaxHighlighter.HighlightAll('code'); 
});

</script>
</body>
</html>
