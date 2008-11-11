<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Width Issues</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }

        .yui-skin-sam .yui-toolbar-container .yui-toolbar-classname {
            width:130px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-separator-6 {
            clear: left;
            padding: 0;
            margin: 0;
            *float: none;
            _width: 0;
            _font-size: 0;
        }
        .yui-toolbar-container.yui-toolbar-grouped span.yui-toolbar-separator-6 {
            *height: 0;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Width Issue</a></h1></div>
    <div id="bd">
        <p>CSS to help style the Editor with a width of 700px</p>
        <textarea id="editor"></textarea>
        <h2>The CSS</h2>
        <textarea name="code" class="CSS">
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-classname {
            width:130px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-separator-6 {
            clear: left;
            padding: 0;
            margin: 0;
            *float: none;
            _width: 0;
            _font-size: 0;
        }
        .yui-toolbar-container.yui-toolbar-grouped span.yui-toolbar-separator-6 {
            *height: 0;
        }
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/menu/menu-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.1/build/editor/editor-beta-min.js"></script>
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.Editor('editor', {
        width: '700px',
        height: '300px',
        toolbar: {
            titlebar: 'Text Editing Tools',
            collapse: true,
            buttons: [
                { group: 'css', label: 'CSS Class',
                    buttons: [
                        { type: 'select', label: 'Style', value: 'classname', disabled: false,
                            menu: [
                                { text: 'content', checked: true },
                                { text: 'header' },
                                { text: 'subhead' },
                                { text: 'contentTitle' },
                                { text: 'smallText' },
                                { text: 'callOut' }
                            ]
                        }
                    ]
                },
                { type: 'separator' },
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' },
                        { type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' },
                        { type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' },
                        { type: 'separator' },
                        { type: 'push', label: 'Subscript', value: 'subscript', disabled: true },
                        { type: 'push', label: 'Superscript', value: 'superscript', disabled: true },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true },
                        { type: 'separator' },
                        { type: 'push', label: 'Remove Formatting', value: 'removeformat', disabled: true },
                        { type: 'push', label: 'Show/Hide Hidden Elements', value: 'hiddenelements' }
                    ]
                },
                { type: 'separator' },
                { group: 'alignment', label: 'Alignment',
                    buttons: [
                        { type: 'push', label: 'Align Left CTRL + SHIFT + [', value: 'justifyleft' },
                        { type: 'push', label: 'Align Center CTRL + SHIFT + |', value: 'justifycenter' },
                        { type: 'push', label: 'Align Right CTRL + SHIFT + ]', value: 'justifyright' },
                        { type: 'push', label: 'Justify', value: 'justifyfull' }
                    ]
                },
                { type: 'separator' },
                { group: 'indentlist', label: 'Indenting and Lists',
                    buttons: [
                        { type: 'push', label: 'Indent', value: 'indent', disabled: true },
                        { type: 'push', label: 'Outdent', value: 'outdent', disabled: true },
                        { type: 'push', label: 'Create an Unordered List', value: 'insertunorderedlist' },
                        { type: 'push', label: 'Create an Ordered List', value: 'insertorderedlist' }
                    ]
                },
                { type: 'separator' },
                { group: 'insertitem', label: 'Insert Item',
                    buttons: [
                        { type: 'push', label: 'HTML Link CTRL + SHIFT + L', value: 'createlink', disabled: true },
                        { type: 'push', label: 'Insert Image', value: 'insertimage' }
                    ]
                },
                { type: 'separator' },
                { group: 'Code', label: 'Code',
                    buttons: [
                        { type: 'push', label: 'Edit HTML Code', value: 'editcode' }
                    ]
                },
                { type: 'separator' },
                { group: 'CMS', label: 'Other Tools',
                    buttons: [
                        { type: 'push', label: 'Link to page', value: 'pagelink' },
                        { type: 'push', label: 'Link to image', value: 'imagelink' },
                        { type: 'push', label: 'Link to pdf', value: 'pdflink' }
                    ]
                }
            ]
        }
    });
    editor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
