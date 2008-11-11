<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Animation</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yui-toolbar-container, .yui-skin-sam .yui-editor-container .dompath {
            visibility: hidden;
        }
        .yui-skin-sam .yui-editor-container {
            border: none;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Animation</a></h1></div>
    <div id="bd">
    <p>In response <a href="http://webkit.org/demos/editingToolbar/">to this post</a></p>
    <p><a href="#thecode">The Code</a></p>
    <textarea id="editor">
    Morbi vitae erat. Cras sem lorem, porta ut, aliquam id, porta sed, velit. Pellentesque scelerisque erat rhoncus nulla. Integer pulvinar, est ut congue elementum, urna sapien blandit nibh, in lobortis turpis metus eget dolor. Cras tristique vulputate sapien. Integer tincidunt elit adipiscing orci.

Nulla facilisi. In in velit. Sed varius turpis sed pede. Aliquam at libero. Nunc a nibh. Nulla ullamcorper. Proin aliquet quam tempor metus. Mauris fermentum turpis vel metus. Integer tincidunt tortor eget tellus. Vivamus vel augue at metus rhoncus aliquet. Vivamus mi tellus, auctor sed, porta eu, mattis vel, ipsum. Phasellus vulputate vulputate risus. Integer tincidunt, dolor at dapibus vulputate, quam libero commodo elit, et feugiat odio felis vitae eros. Vestibulum sapien. Praesent sollicitudin nibh eu dui. Cras convallis tincidunt pede. Phasellus pellentesque metus in nulla. Praesent euismod scelerisque diam. Morbi erat turpis, lobortis in, consequat nec, lacinia sed, enim. Curabitur nisl nisl, consectetuer ac, eleifend a, condimentum vel, sem. 
    </textarea>
    <h2 id="thecode">The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myConfig = {
        height: '300px',
        width: '530px',
        dompath: true,
        animate: true,
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
                        { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                }
            ]
        }
    };    
   var on = false;

    var turnOff = function() {
        on = false;
        this.on('editorMouseDown', turnOn, this);
        Dom.setStyle(this.get('element_cont').get('element'), 'border', 'none');
        var anim = new YAHOO.util.Anim(this.get('toolbar_cont'), {
            opacity: {
                from: 1,
                to: 0
            }
        }, .5, YAHOO.util.Easing.EaseOut);
        anim.onComplete.subscribe(function() {
            this.on('editorMouseDown', turnOn, this);
        }, this, true);
        var anim2 = new YAHOO.util.Anim(this.dompath, {
            opacity: {
                from: 1,
                to: 0
            }
        }, .5, YAHOO.util.Easing.EaseOut);
        anim.animate();
        anim2.animate();
    };
    var turnOn = function() {
        on = true;
        Dom.setStyle(this.get('toolbar_cont'), 'opacity', '0');
        Dom.setStyle(this.get('toolbar_cont'), 'visibility', 'visible');
        Dom.setStyle(this.dompath, 'opacity', '0');
        Dom.setStyle(this.dompath, 'visibility', 'visible');
        var anim = new YAHOO.util.Anim(this.get('toolbar_cont'), {
            opacity: {
                from: 0,
                to: 1
            }
        }, .5, YAHOO.util.Easing.EaseOut);
        anim.onComplete.subscribe(function() {
            Dom.setStyle(this.get('element_cont').get('element'), 'border', '1px solid #808080');
            this.unsubscribe('editorMouseDown', turnOn, this);
        }, this, true);
        var anim2 = new YAHOO.util.Anim(this.dompath, {
            opacity: {
                from: 0,
                to: 1
            }
        }, .5, YAHOO.util.Easing.EaseOut);
        anim.animate();
        anim2.animate();
    };


    myEditor = new YAHOO.widget.Editor('editor', myConfig);
    myEditor.on('editorContentLoaded', function() {
        var win = this._getWindow();
        Event.on(win, 'blur', turnOff, this, true);
        Event.on(this._getDoc(), 'blur', turnOff, this, true);
    }, myEditor, true);
    myEditor.on('editorMouseDown', turnOn, myEditor, true);
    myEditor.render();

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
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myConfig = {
        height: '300px',
        width: '530px',
        dompath: true,
        animate: true,
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
                        { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                }
            ]
        }
    };    
   var on = false;

    var turnOff = function() {
        on = false;
        this.on('editorMouseDown', turnOn, this);
        Dom.setStyle(this.get('element_cont').get('element'), 'border', 'none');
        var anim = new YAHOO.util.Anim(this.get('toolbar_cont'), {
            opacity: {
                from: 1,
                to: 0
            }
        }, .5, YAHOO.util.Easing.EaseOut);
        anim.onComplete.subscribe(function() {
            this.on('editorMouseDown', turnOn, this);
        }, this, true);
        var anim2 = new YAHOO.util.Anim(this.dompath, {
            opacity: {
                from: 1,
                to: 0
            }
        }, .5, YAHOO.util.Easing.EaseOut);
        anim.animate();
        anim2.animate();
    };
    var turnOn = function() {
        on = true;
        Dom.setStyle(this.get('toolbar_cont'), 'opacity', '0');
        Dom.setStyle(this.get('toolbar_cont'), 'visibility', 'visible');
        Dom.setStyle(this.dompath, 'opacity', '0');
        Dom.setStyle(this.dompath, 'visibility', 'visible');
        var anim = new YAHOO.util.Anim(this.get('toolbar_cont'), {
            opacity: {
                from: 0,
                to: 1
            }
        }, .5, YAHOO.util.Easing.EaseOut);
        anim.onComplete.subscribe(function() {
            Dom.setStyle(this.get('element_cont').get('element'), 'border', '1px solid #808080');
            this.unsubscribe('editorMouseDown', turnOn, this);
        }, this, true);
        var anim2 = new YAHOO.util.Anim(this.dompath, {
            opacity: {
                from: 0,
                to: 1
            }
        }, .5, YAHOO.util.Easing.EaseOut);
        anim.animate();
        anim2.animate();
    };


    myEditor = new YAHOO.widget.Editor('editor', myConfig);
    myEditor.on('editorContentLoaded', function() {
        var win = this._getWindow();
        Event.on(win, 'blur', turnOff, this, true);
        Event.on(this._getDoc(), 'blur', turnOff, this, true);
    }, myEditor, true);
    myEditor.on('editorMouseDown', turnOn, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
