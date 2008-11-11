<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Tab/Shift+Tab</title>
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Tab/Shift+Tab</a></h1></div>
    <div id="bd">
    <p>This example shows how to override the <code>_handleKeyDown</code> method to trap the tab key.</p>
    <form>
    <p><label for="demo1">Test 1:</label> <input type="text" id="demo1" name="demo1" value=""></p>
    <textarea id="editor" rows="10" cols="100"></textarea>
    <p><label for="demo2">Test 2:</label> <input type="text" id="demo2" name="demo2" value=""></p>
    </form>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px'
    });
    //Backup the original key handler
    myEditor.__handleKeyDown = myEditor._handleKeyDown;
    //Override the original method
    myEditor._handleKeyDown = function(ev) {
        //Check for Tab key
        if (ev && ev.keyCode && (ev.keyCode === 9)) {
            if (ev.shiftKey) { //Back
                Dom.get('demo1').focus(); //Focus the previous element
            } else { //Next
                Dom.get('demo2').focus(); //Focus the next element
            }
        } else {
            //Apply the original key handler
            this.__handleKeyDown.apply(this, arguments);
        }
    };
    myEditor.render();

    Event.onDOMReady(function() {
        Dom.get('demo1').focus();
    });

    dp.SyntaxHighlighter.HighlightAll('code');
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
<script type="text/javascript" src="editor.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px'
    });
    //Backup the original key handler
    myEditor.__handleKeyDown = myEditor._handleKeyDown;
    //Override the original method
    myEditor._handleKeyDown = function(ev) {
        //Check for Tab key
        if (ev && ev.keyCode && (ev.keyCode === 9)) {
            if (ev.shiftKey) { //Back
                Dom.get('demo1').focus(); //Focus the previous element
            } else { //Next
                Dom.get('demo2').focus(); //Focus the next element
            }
        } else {
            //Apply the original key handler
            this.__handleKeyDown.apply(this, arguments);
        }
    };
    myEditor.render();

    Event.onDOMReady(function() {
        Dom.get('demo1').focus();
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
