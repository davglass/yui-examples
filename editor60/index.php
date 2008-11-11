<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Colorpicker Menu</title>
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Colorpicker Menu</a></h1></div>
    <div id="bd">
    <p>This patch is for <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/30379">this thread</a>.</p>
    <textarea id="editor"></textarea>
    <h2>The Code</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    //The new setter for the disabled config
    var patch = function(disabled) {
        if (disabled) {
            this.addClass('yui-button-disabled');
            this.addClass('yui-' + this.get('type') + '-button-disabled');
            //This is the fixed code
            if (this.get('type') == 'color') {
                this.get('menu').hide();
            }
        } else {
            this.removeClass('yui-button-disabled');
            this.removeClass('yui-' + this.get('type') + '-button-disabled');
        }
        if (this.get('type') == 'menu') {
            this._button.disabled = disabled;
        }
    };

    var myEditor = new YAHOO.widget.SimpleEditor('editor', {
        height: '300px',
        width: '533px'
    });
    //Wait for the toolbar to load so we can override some methods
    myEditor.on('toolbarLoaded', function() {
        //Get the color button
        var fc = this.toolbar.getButtonByValue('forecolor');
        //replace the method with the patched one
        fc._configs.disabled.method = patch;

        //Get the back color
        var bc = this.toolbar.getButtonByValue('backcolor');
        //replace the method with the patched one
        bc._configs.disabled.method = patch;
    }, myEditor, true);
    myEditor.render();
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/editor/editor-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    //The new setter for the disabled config
    var patch = function(disabled) {
        if (disabled) {
            this.addClass('yui-button-disabled');
            this.addClass('yui-' + this.get('type') + '-button-disabled');
            //This is the fixed code
            if (this.get('type') == 'color') {
                this.get('menu').hide();
            }
        } else {
            this.removeClass('yui-button-disabled');
            this.removeClass('yui-' + this.get('type') + '-button-disabled');
        }
        if (this.get('type') == 'menu') {
            this._button.disabled = disabled;
        }
    };

    var myEditor = new YAHOO.widget.SimpleEditor('editor', {
        height: '300px',
        width: '533px'
    });
    //Wait for the toolbar to load so we can override some methods
    myEditor.on('toolbarLoaded', function() {
        //Get the color button
        var fc = this.toolbar.getButtonByValue('forecolor');
        //replace the method with the patched one
        fc._configs.disabled.method = patch;

        //Get the back color
        var bc = this.toolbar.getButtonByValue('backcolor');
        //replace the method with the patched one
        bc._configs.disabled.method = patch;
    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
