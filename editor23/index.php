<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Multiple Edit Areas, One Editor - Advanced</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI:  Editor: Multiple Edit Areas, One Editor - Advanced</a></h1></div>
    <div id="bd">
    <p>This is an Advanced example based on the <a href="http://developer.yahoo.com/yui/examples/editor/multi_editor.html">One Editor, Multiple Edit Areas</a> example.</p>
    <h2>The Example</h2>
    <p><a href="example.php">Open Example in a new Window</a></p>
<h2>The Javascript</h2>
<textarea name="code" class="JScript">
myEditor.setEditorHTML(tar.innerHTML);
//Get a reference to the Editor's iframe body
var body = myEditor._getDoc.call(myEditor).body;
//Set the style of the body to match the container that was opened.
Dom.setStyle(body, 'background-color', Dom.getStyle(tar, 'background-color'));
Dom.setStyle(body, 'color', Dom.getStyle(tar, 'color'));
YAHOO.log('Reposition the editor with the elements xy', 'info', 'example');
Dom.setXY(myEditor.get('element_cont').get('element'), xy);
</textarea>
<textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        editing = null;
    
    YAHOO.log('Setup a stripped down config for the editor', 'info', 'example');
    var myConfig = {
        height: '150px',
        width: '380px',
        animate: true,
        toolbar: {
            titlebar: 'My Editor',
            collapse: true,
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
                        { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                }
            ]
        }
    };

    YAHOO.log('Override the prototype of the toolbar to use a different string for the collapse button', 'info', 'example');
    YAHOO.widget.Toolbar.prototype.STR_COLLAPSE = 'Click to close the editor.';
    YAHOO.log('Create the Editor..', 'info', 'example');
    myEditor = new YAHOO.widget.Editor('editor', myConfig);
    myEditor.on('toolbarLoaded', function() {
        YAHOO.log('Toolbar is loaded, add a listener for the toolbarCollapsed event', 'info', 'example');
        this.toolbar.on('toolbarCollapsed', function() {
            YAHOO.log('Toolbar was collapsed, reposition and save the editors data', 'info', 'example');
            Dom.setXY(this.get('element_cont').get('element'), [-99999, -99999]);
            Dom.removeClass(this.toolbar.get('cont').parentNode, 'yui-toolbar-container-collapsed');
            myEditor.saveHTML();
            editing.innerHTML = myEditor.get('element').value;
            editing = null;
        }, myEditor, true);
    }, myEditor, true);
    myEditor.render();

    Event.on('editable_cont', 'dblclick', function(ev) {
        var tar = Event.getTarget(ev);
        if (Dom.hasClass(tar, 'editable')) {
            YAHOO.log('An element with the classname of editable was double clicked on.', 'info', 'example');
            if (editing !== null) {
                YAHOO.log('There is an editor open, save its data before continuing..', 'info', 'example');
                myEditor.saveHTML();
                editing.innerHTML = myEditor.get('element').value;
            }
            YAHOO.log('Get the XY position of the Element that was clicked', 'info', 'example');
            var xy = Dom.getXY(tar);
            YAHOO.log('Set the Editors HTML with the elements innerHTML', 'info', 'example');
            myEditor.setEditorHTML(tar.innerHTML);
            var body = myEditor._getDoc.call(myEditor).body;
            Dom.setStyle(body, 'background-color', Dom.getStyle(tar, 'background-color'));
            Dom.setStyle(body, 'color', Dom.getStyle(tar, 'color'));
            YAHOO.log('Reposition the editor with the elements xy', 'info', 'example');
            Dom.setXY(myEditor.get('element_cont').get('element'), xy);
            editing = tar;
        }
    });

})();
</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;



    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
