<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Panel over Editor</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #editorMediaCenter-addfile, #editorMediaCenter-addimage {
            text-decoration: none;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Panel over Editor</a></h1></div>
    <div id="bd">
        <p>This example shows how to use a custom button to open a modal panel over the Editor.</p>
        <p><a href="#thecode">Jump to the code</a></p>
        <textarea id="msgpost"></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="../yui-dev/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="../yui-dev/build/element/element-beta-min.js"></script> 
<script type="text/javascript" src="../yui-dev/build/container/container-min.js"></script>     
<script type="text/javascript" src="../yui-dev/build/menu/menu-min.js"></script>
<script type="text/javascript" src="../yui-dev/build/button/button-beta-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script src="../yui-editor/js/toolbar-button.js?bust=<?php echo(mktime()); ?>"></script>
<script src="../yui-editor/js/toolbar.js?bust=<?php echo(mktime()); ?>"></script>
<script src="../yui-editor/js/simple-editor.js?bust=<?php echo(mktime()); ?>"></script>
<script src="../yui-editor/js/editor.js?bust=<?php echo(mktime()); ?>"></script>

<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        win = null,
        defaultBody = 'This is a test of a Panel being displayed over the Editor.' + 
            '<p><a id="editorMediaCenter-addimage" href="#"><img alt="" src="image_add.png"/> Add a new image</a></p>' + 
            '<p><a id="editorMediaCenter-addfile" href="#"><img alt="" src="newspaper_add.png"/> Add a new file</a></p>';

    var myEditor = new YAHOO.widget.Editor('msgpost', {
        height: '300px',
        width: '530px',
        focusAtStart: true,
        dompath: true, //Turns on the bar at the bottom
        animate: true //Animates the opening, closing and moving of Editor windows
    });
    myEditor.on('toolbarLoaded', function() {
        //The Toolbar buttons config
        var config = {
                type: 'push',
                label: 'Open Panel',
                value: 'panel'
        }
        
        //Add the button to the "insertitem" group
        this.toolbar.addButtonToGroup(config, 'insertitem');

        //Handle the button's click
        this.toolbar.on('panelClick', function() {
            myEditor._setDesignMode("Off");
            if (win !== null) {
                win.setBody(defaultBody);
                win.show();
            } else {
                win = new YAHOO.widget.Panel('test', {
                    modal: true,
                    fixedcenter: true,
                    draggable: false,
                    width: '350px'
                });
                win.setHeader('Test Panel');
                win.setBody(defaultBody);
                win.render(document.body);
                win.hideEvent.subscribe(function() {
                    //Just to make sure we didn't loose it
                    this._setDesignMode("On");
                    this._focusWindow();
                }, this, true);

                Event.on(win.body, 'mousedown', function(ev) {
                    var tar = Event.getTarget(ev);
                    if (myEditor._isElement(tar, 'a')) {
                        Event.stopEvent(ev);
                        if (tar.id == 'editorMediaCenter-addimage') {
                            win.setBody('Now Show Add Image Window');
                        } else {
                            win.setBody('Now Show Add File Window');
                        }
                    }
                });
            }
            return false;
        }, this, true);

    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
