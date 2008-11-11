<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: IE6 Button Isse</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/menu/assets/menu.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/button/assets/button.css"> 
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: IE6 Button Issue</a></h1></div>
    <div id="bd">
        
    </div>
<div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/button/button-beta-min.js"></script> 
<script type="text/javascript">
_button = new YAHOO.widget.Button({
    id: 'davTest',
    label: 'Test One',
    type: 'menubutton',
    menu: [
        { text: 'Test 1', value: '1' },
        { text: 'Test 2', value: '1' },
        { text: 'Test 3', value: '1' },
        { text: 'Test 4', value: '1' },
    ],
    container: 'bd'
});

_div = document.createElement('div');
_div.id = 'buttonTester';
YAHOO.util.Dom.setStyle(_div, 'position', 'relative');
YAHOO.util.Dom.get('bd').appendChild(_div);

_button2 = new YAHOO.widget.Button({
    id: 'davTest2',
    label: 'Test Two',
    type: 'menubutton',
    menu: [
        { text: 'Test 1', value: '1' },
        { text: 'Test 2', value: '1' },
        { text: 'Test 3', value: '1' },
        { text: 'Test 4', value: '1' },
    ],
    container: _div
});
</script>
</body>
</html>
