<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Toolbar</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-toolbar-container .yui-button {
            overflow: visible;
        }
        .yui-skin-sam .yui-toolbar-container .yui-button-selected {
            background-repeat: repeat-x;
        }
        .yui-skin-sam .yui-toolbar-container {
            padding: 0.5em;
        }
        .yui-skin-sam .yui-toolbar-container span.yui-toolbar-separator {
            border-left: 1px solid #808080;
            margin: 0.2em 0.5em;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-bold,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-italic,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-underline {
            width: 60px;
            overflow: visible;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-underline {
            width: 80px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-bold .first-child,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-italic .first-child,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-underline .first-child {
            width: 80px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-bold .first-child a,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-italic .first-child a,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-underline .first-child a {
            width: 60px;
            position: static;
            padding-left: 21px;
        }
        #status {
            height: 1em;
            border: 1px solid red;
            color: red;
            margin: .5em;
            padding: .25em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Toolbar</a></h1></div>
    <div id="bd">
        <p>The <a href="http://developer.yahoo.com/yui/editor/">YUI Rich Text Editor's</a> toolbar can be used outside of the editor.</p>
        <p>It was released bundled with it, but can be used without it..</p>
        <p>Here is an example of a stand alone toolbar, it should also me noted that the buttons are fuly skinnable on their own, they are all assigned a unique classname for icon placement.</p>
        <div id="status"></div>

        <div class="yui-editor-container">
            <div class="first-child">
                <div id="toolbar"></div>
            </div>
        </div>
        <h2>The CSS</h2>
        <textarea name="code" class="CSS">
        .yui-toolbar-container .yui-button {
            overflow: visible;
        }
        .yui-skin-sam .yui-toolbar-container .yui-button-selected {
            background-repeat: repeat-x;
        }
        .yui-skin-sam .yui-toolbar-container {
            padding: 0.5em;
        }
        .yui-skin-sam .yui-toolbar-container span.yui-toolbar-separator {
            border-left: 1px solid #808080;
            margin: 0.2em 0.5em;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-bold,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-italic,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-underline {
            width: 60px;
            overflow: visible;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-underline {
            width: 80px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-bold .first-child,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-italic .first-child,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-underline .first-child {
            width: 80px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-bold .first-child a,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-italic .first-child a,
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-underline .first-child a {
            width: 60px;
            position: static;
            padding-left: 21px;
        }
        </textarea>
        <h2>The HTML</h2>
        <textarea name="code" class="html">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
<body class="yui-skin-sam">
<div class="yui-editor-container">
    <div class="first-child">
        <div id="toolbar"></div>
    </div>
</div>

<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/editor/simpleeditor-beta-min.js"></script> 
        </textarea>
        <h2>The Javascript</h2>
<textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        toolbar = null,
        status = null;

    Event.onDOMReady(function() {
        status = Dom.get('status');
        toolbar = new YAHOO.widget.Toolbar('toolbar', {
            buttonType: 'advanced',
            draggable: false,
            buttons: [
                { group: 'fontstyle', label: 'Font Name and Size',
                    buttons: [
                        { type: 'push', label: 'Bold', value: 'bold' },
                        { type: 'push', label: 'Italic', value: 'italic' },
                        { type: 'push', label: 'Underline', value: 'underline' },
                        { type: 'separator' },
                        { type: 'push', label: 'Subscript', value: 'subscript' },
                        { type: 'push', label: 'Superscript', value: 'superscript' },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor' },
                        { type: 'color', label: 'Back Color', value: 'backcolor' },
                        { type: 'separator' },
                        { type: 'push', label: 'Remove Formatting', value: 'removeformat' },
                        { type: 'push', label: 'Show Hidden Elements', value: 'hiddenelements' },
                        { type: 'separator' },
                        { type: 'select', label: 'Verdana', value: 'fontname',
                            menu: [
                                { text: 'Arial' },
                                { text: 'Arial Narrow' },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS' },
                                { text: 'Courier New' },
                                { text: 'Georgia' },
                                { text: 'System' },
                                { text: 'Times New Roman' },
                                { text: 'Verdana', checked: true }
                            ]
                        },
                        { type: 'spin', label: '23', value: 'fontsize', range: [5, 50] },
                        { type: 'separator' },
                        { type: 'push', label: 'Left', value: 'justifyleft' },
                        { type: 'push', label: 'Center', value: 'justifycenter' },
                        { type: 'push', label: 'Right', value: 'justifyright' },
                        { type: 'push', label: 'Full', value: 'justifyfull' }
                    ]
                }
            ]
        });
        toolbar.on('buttonClick', function(info) {
            //We have a button reference
            var _button = toolbar.getButtonByValue(info.button.value);
            toolbar.deselectAllButtons();
            toolbar.selectButton(_button);
            status.innerHTML = 'You clicked on ' + _button.get('label') + ', with the value of ' + ((info.button.color) ? '#' + info.button.color + ' : ' + info.button.colorName : info.button.value);
        });
    });

})();
</textarea>
        </script>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/editor/simpleeditor-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        toolbar = null,
        status = null;

    Event.onDOMReady(function() {
        status = Dom.get('status');
        toolbar = new YAHOO.widget.Toolbar('toolbar', {
            buttonType: 'advanced',
            draggable: false,
            buttons: [
                { group: 'fontstyle', label: 'Font Name and Size',
                    buttons: [
                        { type: 'push', label: 'Bold', value: 'bold' },
                        { type: 'push', label: 'Italic', value: 'italic' },
                        { type: 'push', label: 'Underline', value: 'underline' },
                        { type: 'separator' },
                        { type: 'push', label: 'Subscript', value: 'subscript' },
                        { type: 'push', label: 'Superscript', value: 'superscript' },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor' },
                        { type: 'color', label: 'Back Color', value: 'backcolor' },
                        { type: 'separator' },
                        { type: 'push', label: 'Remove Formatting', value: 'removeformat' },
                        { type: 'push', label: 'Show Hidden Elements', value: 'hiddenelements' },
                        { type: 'separator' },
                        { type: 'select', label: 'Verdana', value: 'fontname',
                            menu: [
                                { text: 'Arial' },
                                { text: 'Arial Narrow' },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS' },
                                { text: 'Courier New' },
                                { text: 'Georgia' },
                                { text: 'System' },
                                { text: 'Times New Roman' },
                                { text: 'Verdana', checked: true }
                            ]
                        },
                        { type: 'spin', label: '23', value: 'fontsize', range: [5, 50] },
                        { type: 'separator' },
                        { type: 'push', label: 'Left', value: 'justifyleft' },
                        { type: 'push', label: 'Center', value: 'justifycenter' },
                        { type: 'push', label: 'Right', value: 'justifyright' },
                        { type: 'push', label: 'Full', value: 'justifyfull' }
                    ]
                }
            ]
        });
        toolbar.on('buttonClick', function(info) {
            //We have a button reference
            var _button = toolbar.getButtonByValue(info.button.value);
            toolbar.deselectAllButtons();
            toolbar.selectButton(_button);
            status.innerHTML = 'You clicked on ' + _button.get('label') + ', with the value of ' + ((info.button.color) ? '#' + info.button.color + ' : ' + info.button.colorName : info.button.value);
        });
        dp.SyntaxHighlighter.HighlightAll('code');
    });

})();

</script>
</body>
</html>
