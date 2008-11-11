<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Mixed buttons</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Mixed Buttons</a></h1></div>
    <div id="bd">
    <p>This example shows using mixed button types in the editor.</p>
    <textarea id="editor" rows="10" cols="100">
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.Editor('editor', {
        height: '350px',
        width: '580px',
        dompath: true,
        toolbar: {
            titlebar: 'My Editor',
            buttons: [
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold', value: 'bold' },
                        { type: 'push', label: 'Italic', value: 'italic' },
                        { type: 'push', label: 'Underline', value: 'underline' },
                        { type: 'separator' },
                        { type: 'select', label: 'Arial', value: 'fontname', disabled: true,
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
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                }
            ]
        }
        
    });
    editor.on('toolbarLoaded', function() {
        this.toolbar.buttonType = YAHOO.widget.ToolbarButton;
        var buttonConfig = {
            type: 'select', label: 'Normal', value: 'fontsize2', disabled: true,
            menu: [
                { text: 'X-Small' },
                { text: 'Small' },
                { text: 'Normal' },
                { text: 'Large' },
                { text: 'X-Large' }
            ]
        };
        editor.toolbar.addButtonToGroup(buttonConfig, 'textstyle'); 

    });

    editor.render();
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/editor/editor-beta-min.js"></script> 

<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.Editor('editor', {
        height: '350px',
        width: '580px',
        dompath: true,
        toolbar: {
            titlebar: 'My Editor',
            buttons: [
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold', value: 'bold' },
                        { type: 'push', label: 'Italic', value: 'italic' },
                        { type: 'push', label: 'Underline', value: 'underline' },
                        { type: 'separator' },
                        { type: 'select', label: 'Arial', value: 'fontname', disabled: true,
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
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                }
            ]
        }
        
    });
    editor.on('toolbarLoaded', function() {
        this.toolbar.buttonType = YAHOO.widget.ToolbarButton;
        var buttonConfig = {
            type: 'select', label: 'Normal', value: 'fontsize2', disabled: true,
            menu: [
                { text: 'X-Small' },
                { text: 'Small' },
                { text: 'Normal' },
                { text: 'Large' },
                { text: 'X-Large' }
            ]
        };
        editor.toolbar.addButtonToGroup(buttonConfig, 'textstyle'); 

    });

    editor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
