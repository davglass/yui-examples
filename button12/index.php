<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: </title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: </a></h1></div>
    <div id="bd">
        <textarea id="msgpost"></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/editor/editor-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('msgpost', {
        height: '200px',
        width: '385px',
        dompath: false,
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
                        { type: 'select', label: '1 Arial', value: 'fontname', disabled: true,
                            menu: [
                                { text: '1 Arial', checked: true },
                                { text: '2 Arial Black' },
                                { text: '3 Comic Sans MS' },
                                { text: '4 Comic Sans MS' },
                                { text: '5 Courier New' },
                                { text: '6 Lucida Console' },
                                { text: '7 Tahoma' },
                                { text: '8 Times New Roman' },
                                { text: '9 Trebuchet MS' },
                                { text: '10 Verdana' },
                                { text: '11 Verdana' },
                                { text: '12 Arial Black' },
                                { text: '13Comic Sans MS' },
                                { text: '14 Comic Sans MS' },
                                { text: '15 Courier New' },
                                { text: '16 Lucida Console' },
                                { text: '17 Tahoma' },
                                { text: '18 Times New Roman' },
                                { text: '19 Trebuchet MS' },
                                { text: '20 Verdana' },
                                { text: '21 Verdana' },
                                { text: '22 Arial Black' },
                                { text: '23 Comic Sans MS' },
                                { text: '24 Comic Sans MS' },
                                { text: '25 Courier New' },
                                { text: '26 Lucida Console' },
                                { text: '27 Tahoma' },
                                { text: '28 Times New Roman' },
                                { text: '29 Trebuchet MS' },
                                { text: '30 Verdana' },
                                { text: '31 Verdana' },
                                { text: '32 Arial Black' },
                                { text: '33 Comic Sans MS' },
                                { text: '34 Comic Sans MS' },
                                { text: '35 Courier New' },
                                { text: '36 Lucida Console' },
                                { text: '37 Tahoma' },
                                { text: '38 Times New Roman' },
                                { text: '39 Trebuchet MS' },
                                { text: '40 Verdana' }
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
    });
    myEditor.render();



    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
