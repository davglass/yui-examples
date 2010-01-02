<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Clear/Print</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
.yui-skin-sam .yui-toolbar-container .yui-toolbar-clear span.yui-toolbar-icon {
    background-image: url( clear.png );
    background-position: 1px 0px;
    left: 6px;
}
.yui-skin-sam .yui-toolbar-container .yui-toolbar-clear-selected span.yui-toolbar-icon {
    background-image: url( clear.png );
    background-position: 1px 0px;
    left: 6px;
}	
.yui-skin-sam .yui-toolbar-container .yui-toolbar-print span.yui-toolbar-icon {
    background-image: url( print.png );
    background-position: 1px 0px;
    left: 6px;
}
.yui-skin-sam .yui-toolbar-container .yui-toolbar-print-selected span.yui-toolbar-icon {
    background-image: url( print.png );
    background-position: 1px 0px;
    left: 6px;
}	
    </style>

</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Default Font</a></h1></div>
    <div id="bd">
        <p>This example shows how to add Clear and Print buttons to the Editor.</p>
        <textarea id="editor">
        This is a test. This is a test. This is a test. This is a test. This is a test. 
        </textarea>

        <h2>The CSS</h2>
<script src="http://gist.github.com/267387.js"></script>
        <h2>The Javascript</h2>
        <script src="http://gist.github.com/267388.js"></script>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js&2.8.0r4/build/container/container_core-min.js&2.8.0r4/build/menu/menu-min.js&2.8.0r4/build/element/element-min.js&2.8.0r4/build/button/button-min.js&2.8.0r4/build/editor/editor-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script>

var editor = new YAHOO.widget.Editor('editor', {
    height: '300px',
    width: '600px',
    dompath: true
});
editor.on('toolbarLoaded', function() {
    //Create a new Group of buttons
    var newGroup = {
        group: 'clearprint', label: 'Clear/Print',
        buttons: [
            //Add the Clear Button
            { type: 'push', label: 'Clear', value: 'clear' },
            //Add the Print Button
            { type: 'push', label: 'Print', value: 'print' }
        ]
    };
    //Add the group to the Toolbar
    editor.toolbar.addButtonGroup(newGroup);

    //Listen for the clear button click
    editor.toolbar.on('clearClick', function(ev) {
        //Clear the Editor
        editor.setEditorHTML('');
        //Focus the Editor
        editor.focus();
    });
    //Listen for the Print button click
    editor.toolbar.on('printClick', function(ev) {
        //Tell the window to print.
        editor._getWindow().print();
    });
});
editor.render();

dp.SyntaxHighlighter.HighlightAll('code');
</script>
</body>
</html>
