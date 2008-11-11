<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Toolbar Button Example</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        #toolbar {
            border: 1px solid black;
            margin: 2em 0;
            padding: .25em .1em;
            background: url(http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/sprite.png) repeat-x scroll 0 0;
        }

        #button_reply .first-child {
            background:url(button1.gif) left center no-repeat;
        }

        #button_forward .first-child {
            background:url(button2.gif) left center no-repeat;
        }

        #button_print .first-child {
            background:url(button3.gif) left center no-repeat;
        }

        #button_spam .first-child {
            background:url(button4.gif) left center no-repeat;
        }

        #button_reply .first-child button, 
        #button_forward .first-child button {
            padding-left: 2.5em;
        }
        
        #button_print .first-child button,
        #button_spam .first-child button {
            padding-left: 2em;
        }

        #toolbar .yui-button, #toolbar .yui-button .first-child {
            border-color: transparent;
        }
        #toolbar .yui-button-hover, #toolbar .yui-button-hover .first-child {
            border-color: #808080;
        }
        #toolbar .yui-button {
            background: none;
        }
        #toolbar .yui-button-hover {
            background:transparent url(http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/sprite.png) repeat-x scroll 0 -1300px;
        }

        p {
            padding: .25em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Toolbar Button Example</a></h1></div>
    <div id="bd">
        <p>Using the <a href="http://developer.yahoo.com/yui/button">new button control</a>, here is an example menu bar similar to the one used in the <a href="http://mail.yahoo.com/">Yahoo! Mail Beta</a></p>
        <p><strong>Update: </strong> This example was updated to 2.3.0, the 2.2.2 version <a href="index-2.2.php">can be seen here</a>.</p>
        <h2>The Toolbar</h2>
        <div id="toolbar"></div>
        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
<link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
<body class="yui-skin-sam">
<div id="toolbar"></div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/button/button-beta-min.js"></script> 
        </textarea>
        <h2>The CSS</h2>
        <textarea name="code" class="CSS">
        #toolbar {
            border: 1px solid black;
            margin: 2em 0;
            padding: .25em .1em;
            background: url(http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/sprite.png) repeat-x scroll 0 0;
        }

        #button_reply .first-child {
            background:url(button1.gif) left center no-repeat;
        }

        #button_forward .first-child {
            background:url(button2.gif) left center no-repeat;
        }

        #button_print .first-child {
            background:url(button3.gif) left center no-repeat;
        }

        #button_spam .first-child {
            background:url(button4.gif) left center no-repeat;
        }

        #button_reply .first-child button, #button_forward .first-child button {
            padding-left: 2.5em;
        }
        
        #button_print .first-child button, #button_spam .first-child button {
            padding-left: 2em;
        }

        #toolbar .yui-button, #toolbar .yui-button .first-child {
            border-color: transparent;
        }
        #toolbar .yui-button-hover, #toolbar .yui-button-hover .first-child {
            border-color: #808080;
        }
        #toolbar .yui-button {
            background: none;
        }
        #toolbar .yui-button-hover {
            background:transparent url(http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/sprite.png) repeat-x scroll 0 -1300px;
        }
        </textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
var replyMenu = [
    { text: 'reply to sender', value: 'reply', id: 'reply' },
    { text: 'reply to all', value: 'replytoall', id: 'replyall' }
];

var optionsMenu = [
    { text: 'Test Option 1', value: '1' },
    { text: 'Test Option 2', value: '2' },
    { text: 'Test Option 3', value: '3' },
    { text: 'Test Option 4', value: '4' },
    { text: 'Test Option 5', value: '5' }
];

var oButton1 = new YAHOO.widget.Button({
    id: "button_reply", 
    type: "split", 
    label: "Reply", 
    container: "toolbar",
    menu: replyMenu
});

var oButton2 = new YAHOO.widget.Button({
    id: "button_forward", 
    type: "push", 
    label: "Forward", 
    container: "toolbar" 
});

var oButton3 = new YAHOO.widget.Button({
    id: "button_print", 
    type: "push", 
    label: "Print", 
    container: "toolbar" 
});

var oButton4 = new YAHOO.widget.Button({
    id: "button_spam", 
    type: "push", 
    label: "Spam", 
    container: "toolbar" 
});

var oButton5 = new YAHOO.widget.Button({
    id: "button_options", 
    type: "menu", 
    label: "Options", 
    container: "toolbar",
    menu: optionsMenu
});
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
    
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/button/button-beta-min.js"></script> 
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
var replyMenu = [
    { text: 'reply to sender', value: 'reply', id: 'reply' },
    { text: 'reply to all', value: 'replytoall', id: 'replyall' }
];

var optionsMenu = [
    { text: 'Test Option 1', value: '1' },
    { text: 'Test Option 2', value: '2' },
    { text: 'Test Option 3', value: '3' },
    { text: 'Test Option 4', value: '4' },
    { text: 'Test Option 5', value: '5' }
];

var oButton1 = new YAHOO.widget.Button({
    id: "button_reply", 
    type: "split", 
    label: "Reply", 
    container: "toolbar",
    menu: replyMenu
});

var oButton2 = new YAHOO.widget.Button({
    id: "button_forward", 
    type: "push", 
    label: "Forward", 
    container: "toolbar" 
});

var oButton3 = new YAHOO.widget.Button({
    id: "button_print", 
    type: "push", 
    label: "Print", 
    container: "toolbar" 
});

var oButton4 = new YAHOO.widget.Button({
    id: "button_spam", 
    type: "push", 
    label: "Spam", 
    container: "toolbar" 
});

var oButton5 = new YAHOO.widget.Button({
    id: "button_options", 
    type: "menu", 
    label: "Options", 
    container: "toolbar",
    menu: optionsMenu
});

function init() {
    dp.SyntaxHighlighter.HighlightAll('code'); 
}

YAHOO.util.Event.addListener(window, 'load', init);
</script>
</body>
</html>

