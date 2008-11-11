<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Toolbar Dynamic Buttons</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #control {
            margin: 3em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Toolbar Dynamic Buttons</a></h1></div>
    <div id="bd">
        <div class="yui-editor-container">
            <div id="toolbar"></div>
        </div>
        <div id="control"></div>
        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
        <div class="yui-editor-container">
            <div id="toolbar"></div>
        </div>
        <div id="control"></div>
        </textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var tbar = new YAHOO.widget.Toolbar('toolbar', {
        buttonType: 'advanced',
        buttons: [
            { group: 'textstyle', label: 'Font Style',
                buttons: [
                    { type: 'push', label: 'Bold', value: 'bold', id: 'bold' },
                    { type: 'push', label: 'Italic', value: 'italic', id: 'italic' },
                    { type: 'push', label: 'Underline', value: 'underline', id: 'underline' },
                    { type: 'separator' },
                    { type: 'select', label: 'Arial', value: 'fontname',
                        menu: [
                            { text: 'Arial', checked: true },
                            { text: 'Arial Black' },
                            { text: 'Comic Sans MS' },
                            { text: 'Courier New' },
                            { text: 'Lucida Console' },
                            { text: 'Tahoma' },
                            { text: 'Times New Roman' },
                            { text: 'Trebuchet MS' },
                            { text: 'Verdana' }
                        ]
                    },
                    { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ] },
                    { type: 'separator' },
                    { type: 'color', label: 'Font Color', value: 'forecolor' },
                    { type: 'color', label: 'Background Color', value: 'backcolor' }
                ]
            }
        ]
    });

    var _b = new YAHOO.widget.Button({
        container: 'control',
        label: 'Toggle Buttons'
    });
    var showing = false;
    var buttons1 = ['bold', 'italic', 'underline'];
    var buttons2 = ['fontname', 'fontsize', 'forecolor', 'backcolor'];
    _b.on('click', function() {
        var state1 = 'block',
            state2 = 'none';
        if (showing) {
            showing = false;
            state1 = 'none';
            state2 = 'block';
        } else {
            showing = true;
        }
        for (var i = 0; i &lt; buttons1.length; i++) {
            tbar.getButtonByValue(buttons1[i]).setStyle('display', state1);
        }
        for (var i = 0; i &lt; buttons2.length; i++) {
            tbar.getButtonByValue(buttons2[i]).setStyle('display', state2);
        }
    });

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/editor/simpleeditor-beta-min.js"></script> 
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
            { group: 'textstyle', label: 'Font Style',
                buttons: [
                    { type: 'push', label: 'Bold', value: 'bold', id: 'bold' },
                    { type: 'push', label: 'Italic', value: 'italic', id: 'italic' },
                    { type: 'push', label: 'Underline', value: 'underline', id: 'underline' },
                    { type: 'separator' },
                    { type: 'select', label: 'Arial', value: 'fontname',
                        menu: [
                            { text: 'Arial', checked: true },
                            { text: 'Arial Black' },
                            { text: 'Comic Sans MS' },
                            { text: 'Courier New' },
                            { text: 'Lucida Console' },
                            { text: 'Tahoma' },
                            { text: 'Times New Roman' },
                            { text: 'Trebuchet MS' },
                            { text: 'Verdana' }
                        ]
                    },
                    { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ] },
                    { type: 'separator' },
                    { type: 'color', label: 'Font Color', value: 'forecolor' },
                    { type: 'color', label: 'Background Color', value: 'backcolor' }
                ]
            }
        ]
    });

    var _b = new YAHOO.widget.Button({
        container: 'control',
        label: 'Toggle Buttons'
    });
    var showing = false;
    var buttons1 = ['bold', 'italic', 'underline'];
    var buttons2 = ['fontname', 'fontsize', 'forecolor', 'backcolor'];
    _b.on('click', function() {
        var state1 = 'block',
            state2 = 'none';
        if (showing) {
            showing = false;
            state1 = 'none';
            state2 = 'block';
        } else {
            showing = true;
        }
        for (var i = 0; i < buttons1.length; i++) {
            tbar.getButtonByValue(buttons1[i]).setStyle('display', state1);
        }
        for (var i = 0; i < buttons2.length; i++) {
            tbar.getButtonByValue(buttons2[i]).setStyle('display', state2);
        }
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
