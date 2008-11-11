<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Font Size Select List</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-fontsize2 {
            width: 70px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Font Size Select List</a></h1></div>
    <div id="bd">
        <p>This example is in response to <a href="https://sourceforge.net/tracker/index.php?func=detail&aid=1851180&group_id=165715&atid=836479">Feature Request #1851180</a></p>
        <textarea id="editor">
        This is a <span style="font-size: 21px;">test</span>. This is a test. This is a <span style="font-size: 26px;">test</span>. This is a test. This is a test. This is a test. 
        </textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    //The sizes to map to the names
    var sizes = {
        'X-Small': 9,
        'Small': 11,
        'Normal': 13,
        'Large': 21,
        'X-Large': 26
    };

    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '563px',
        height: '300px'
    });
    //Change the default toolbar button for fontsize to a new one.
    myEditor._defaultToolbar.buttons[0].buttons[1] = {
        type: 'select', label: 'Normal', value: 'fontsize2', disabled: true,
            menu: [
                { text: 'X-Small' },
                { text: 'Small' },
                { text: 'Normal' },
                { text: 'Large' },
                { text: 'X-Large' }
            ]
    };
    //Override the _handleFontSize method with our own
    myEditor._handleFontSize = function(o) {
        var button = this.toolbar.getButtonById(o.button.id);
        var value = o.button.value; //The selected value
        var out = sizes[value]; //The pixel size
        button.set('label', value);
        this._updateMenuChecked('fontsize2', value);
        this.execCommand('fontsize', out + 'px');
        this.STOP_EXEC_COMMAND = true;
    };
    //Add this button to the _disabled array so it turns on and off with selections
    myEditor._disabled[myEditor._disabled.length] = 'fontsize2';
    //Now update the status of the button to reflect the style of the current element.
    //Not sure what you would do if you ran into an element with a size that is not in our list.
    //Maybe we add a method to round the size to the proper size??
    myEditor.on('afterNodeChange', function() {
        var elm = this._getSelectedElement(),
            button = this.toolbar.getButtonByValue('fontsize2'),
            label = 'Normal';

        if (!this._isElement(elm, 'body') && !this._isElement(elm, 'img')) {
            this.toolbar.enableButton('fontsize2');
            var fs = parseInt(Dom.getStyle(elm, 'fontSize'),10);
            for (var i in sizes) {
                if (fs == sizes[i]) {
                    label = i;
                    break;
                }
            }
            button.set('label', label);
        } else {
            button.set('label', label);
        }
    }, myEditor, true);
    //Setup our new listener
    myEditor.on('editorContentLoaded', function() {
        this.toolbar.on('fontsize2Click', function(o) {
            this._handleFontSize(o);
        }, this, true);
        
    }, myEditor, true);
    myEditor.render();

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/editor/editor-beta-min.js"></script> 
<script type="text/javascript" src="patch.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    //The sizes to map to the names
    var sizes = {
        'X-Small': 9,
        'Small': 11,
        'Normal': 13,
        'Large': 21,
        'X-Large': 26
    };

    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '563px',
        height: '300px'
    });
    //Change the default toolbar button for fontsize to a new one.
    myEditor._defaultToolbar.buttons[0].buttons[1] = {
        type: 'select', label: 'Normal', value: 'fontsize2', disabled: true,
            menu: [
                { text: 'X-Small' },
                { text: 'Small' },
                { text: 'Normal' },
                { text: 'Large' },
                { text: 'X-Large' }
            ]
    };
    //Override the _handleFontSize method with our own
    myEditor._handleFontSize = function(o) {
        var button = this.toolbar.getButtonById(o.button.id);
        var value = o.button.value; //The selected value
        var out = sizes[value]; //The pixel size
        button.set('label', value);
        this._updateMenuChecked('fontsize2', value);
        this.execCommand('fontsize', out + 'px');
        this.STOP_EXEC_COMMAND = true;
    };
    //Add this button to the _disabled array so it turns on and off with selections
    myEditor._disabled[myEditor._disabled.length] = 'fontsize2';
    //Now update the status of the button to reflect the style of the current element.
    //Not sure what you would do if you ran into an element with a size that is not in our list.
    //Maybe we add a method to round the size to the proper size??
    myEditor.on('afterNodeChange', function() {
        var elm = this._getSelectedElement(),
            button = this.toolbar.getButtonByValue('fontsize2'),
            label = 'Normal';

        if (!this._isElement(elm, 'body') && !this._isElement(elm, 'img')) {
            this.toolbar.enableButton('fontsize2');
            var fs = parseInt(Dom.getStyle(elm, 'fontSize'),10);
            for (var i in sizes) {
                if (fs == sizes[i]) {
                    label = i;
                    break;
                }
            }
            button.set('label', label);
        } else {
            button.set('label', label);
        }
    }, myEditor, true);
    //Setup our new listener
    myEditor.on('editorContentLoaded', function() {
        this.toolbar.on('fontsize2Click', function(o) {
            this._handleFontSize(o);
        }, this, true);
        
    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
