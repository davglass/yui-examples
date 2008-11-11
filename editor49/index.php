<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Menu Button Click</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #editor {
            visibility: hidden;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Menu Button Click</a></h1></div>
    <div id="bd">
        <p>This example shows how to get the value of a menu button. So select some text in the Editor and the "Layout 1" select box will enable. Then select an option and you will get an alert with the value.</p>
        <form method="post" action="index.php" id="form1">
        <textarea id="editor" rows="20" cols="75">
            Test This.<br>
            Test This.<br>
            Test This.<br>
            Test This.<br>
            Test This.<br>
            Test This.<br>
            Test This.<br>
        </textarea>
        </form>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myConfig = {
        height: '300px',
        width: '655px',
        animate: true,
        dompath: true,
        handleSubmit: true,
        focusAtStart: true
    };

    var myEditor = new YAHOO.widget.SimpleEditor('editor', myConfig);
    myEditor.on('toolbarLoaded', function() {
        var tb = this.toolbar;
        var config = {
            type: 'select', label: 'Layout 1', value: 'layout', disabled: true,
                menu: [
                    { text: 'Layout 1', checked: true },
                    { text: 'Layout 2' },
                    { text: 'Layout 3' },
                    { text: 'Layout 4' },
                    { text: 'Layout 5' },
                    { text: 'Layout 6' },
                    { text: 'Layout 7' }
                ]
        };
        this.toolbar.addButtonToGroup(config, 'insertitem');
        this._disabled[this._disabled.length] = 'layout';
        this.toolbar.on('layoutClick', function(ev) {
            var button = ev.button;
            alert('You Clicked (' + button.menucmd + ') Button: ' + button.value);
        });
    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/selector/selector-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/editor/editor-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myConfig = {
        height: '300px',
        width: '655px',
        animate: true,
        dompath: true,
        handleSubmit: true,
        focusAtStart: true
    };

    var myEditor = new YAHOO.widget.SimpleEditor('editor', myConfig);
    myEditor.on('toolbarLoaded', function() {
        var tb = this.toolbar;
        var config = {
            type: 'select', label: 'Layout 1', value: 'layout', disabled: true,
                menu: [
                    { text: 'Layout 1', checked: true },
                    { text: 'Layout 2' },
                    { text: 'Layout 3' },
                    { text: 'Layout 4' },
                    { text: 'Layout 5' },
                    { text: 'Layout 6' },
                    { text: 'Layout 7' }
                ]
        };
        this.toolbar.addButtonToGroup(config, 'insertitem');
        this._disabled[this._disabled.length] = 'layout';
        this.toolbar.on('layoutClick', function(ev) {
            var button = ev.button;
            alert('You Clicked (' + button.menucmd + ') Button: ' + button.value);
        });
    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
