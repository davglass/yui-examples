<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Default Font</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Default Font</a></h1></div>
    <div id="bd">
        <p>This example shows how to change the Editor's default font.</p>
        <textarea id="editor">
        This is a test. This is a test. This is a test. This is a test. This is a test. 
        </textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/editor/simpleeditor-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    //Create the Editor instance
    var myEditor = new YAHOO.widget.SimpleEditor('editor', {
        width: '600px',
        height: '300px',
        dompath: true,
        extracss: 'body { font-family: Courier New }',
        toolbar: {
            titlebar: 'My Editor',
            buttons: [
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                            { type: 'push', label: 'Bold', value: 'bold' },
                            { type: 'push', label: 'Italic', value: 'italic' },
                            { type: 'push', label: 'Underline', value: 'underline' },
                            { type: 'separator' },
                            { type: 'select', label: 'Courier New', value: 'fontname', disabled: true,
                                menu: [
                                    { text: 'Arial' },
                                    { text: 'Arial Black' },
                                    { text: 'Comic Sans MS' },
                                    { text: 'Courier New', checked: true },
                                    { text: 'Lucida Console' },
                                    { text: 'Tahoma' },
                                    { text: 'Times New Roman' },
                                    { text: 'Trebuchet MS' },
                                    { text: 'Verdana' }
                                ]
                            },
                            { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true },
                            { type: 'separator' },
                            { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                            { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                        ]
                    }
                ]
            }
    });
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
