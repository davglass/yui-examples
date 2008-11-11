<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Toolbar Button Example</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/menu/assets/menu.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/button/assets/button.css"> 
    <style type="text/css" media="screen">
        #toolbar {
            border: 1px solid black;
            margin: 2em 0;
            padding: .25em .1em;
            background-image: url(toolbarbackground.gif);
        }

        #button_1 .first-child {
            background:url(button1.gif) left center no-repeat;
        }

        #button_2 .first-child {
            background:url(button2.gif) left center no-repeat;
        }

        #button_3 .first-child {
            background:url(button3.gif) left center no-repeat;
        }

        #button_4 .first-child {
            background:url(button4.gif) left center no-repeat;
        }

        #button_1 .first-child button, 
        #button_2 .first-child button {
            padding-left: 2.5em;
        }
        
        #button_3 .first-child button,
        #button_4 .first-child button {
            padding-left: 2em;
        }



        p {
            padding: .25em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Toolbar Button Example</a></h1></div>
    <div id="bd">
        <p>Using the <a href="http://developer.yahoo.com/yui/button">new button control</a>, here is an example menu bar similar to the one used in the <a href="http://mail.yahoo.com/">Yahoo! Mail Beta</a></p>
        <p><b>Update: </b> I patched my example with <a href="http://yuiblog.com/sandbox/yui/v220/examples/button/example01.php">Todd's example here</a></p>
        <h2>The Toolbar</h2>
        <div id="toolbar"></div>
        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/menu/assets/menu.css"> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/button/assets/button.css"> 

<div id="toolbar"></div>

<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/button/button-beta-min.js"></script> 

        </textarea>
        <h2>The CSS</h2>
        <textarea name="code" class="HTML">
#toolbar {
    border: 1px solid black;
    margin: 2em 0;
    padding: .25em .1em;
    background-image: url(toolbarbackground.gif);
}

#button_1 .first-child {
    background:url(button1.gif) left center no-repeat;
}

#button_2 .first-child {
    background:url(button2.gif) left center no-repeat;
}

#button_3 .first-child {
    background:url(button3.gif) left center no-repeat;
}

#button_4 .first-child {
    background:url(button4.gif) left center no-repeat;
}

#button_1 .first-child button, 
#button_2 .first-child button {
    padding-left: 2.5em;
}

#button_3 .first-child button,
#button_4 .first-child button {
    padding-left: 2em;
}
</textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
var replyMenu = [
    { text: 'reply to sender', value: 'reply' },
    { text: 'reply to all', value: 'replytoall' }
];

var optionsMenu = [
    { text: 'Test Option 1', value: '1' },
    { text: 'Test Option 2', value: '2' },
    { text: 'Test Option 3', value: '3' },
    { text: 'Test Option 4', value: '4' },
    { text: 'Test Option 5', value: '5' }
];

var oButton1 = new YAHOO.widget.Button({
    id: "button_1", 
    type: "splitbutton", 
    label: "Reply", 
    container: "toolbar",
    menu: replyMenu
});

var oButton2 = new YAHOO.widget.Button({
    id: "button_2", 
    type: "button", 
    label: "Forward", 
    container: "toolbar" 
});

var oButton3 = new YAHOO.widget.Button({
    id: "button_3", 
    type: "button", 
    label: "Print", 
    container: "toolbar" 
});

var oButton4 = new YAHOO.widget.Button({
    id: "button_4", 
    type: "button", 
    label: "Spam", 
    container: "toolbar" 
});

var oButton5 = new YAHOO.widget.Button({
    id: "button_5", 
    type: "menubutton", 
    label: "Options", 
    container: "toolbar",
    menu: optionsMenu
});
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
    
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/button/button-beta-min.js"></script> 
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
var replyMenu = [
    { text: 'reply to sender', value: 'reply' },
    { text: 'reply to all', value: 'replytoall' }
];

var optionsMenu = [
    { text: 'Test Option 1', value: '1' },
    { text: 'Test Option 2', value: '2' },
    { text: 'Test Option 3', value: '3' },
    { text: 'Test Option 4', value: '4' },
    { text: 'Test Option 5', value: '5' }
];

var oButton1 = new YAHOO.widget.Button({
    id: "button_1", 
    type: "splitbutton", 
    label: "Reply", 
    container: "toolbar",
    menu: replyMenu
});

var oButton2 = new YAHOO.widget.Button({
    id: "button_2", 
    type: "button", 
    label: "Forward", 
    container: "toolbar" 
});

var oButton3 = new YAHOO.widget.Button({
    id: "button_3", 
    type: "button", 
    label: "Print", 
    container: "toolbar" 
});

var oButton4 = new YAHOO.widget.Button({
    id: "button_4", 
    type: "button", 
    label: "Spam", 
    container: "toolbar" 
});

var oButton5 = new YAHOO.widget.Button({
    id: "button_5", 
    type: "menubutton", 
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

