<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Menu Button Values</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Menu Button Values</a></h1></div>
    <div id="bd">
        <p>This example show how to get the value of the menu item that was clicked, when the menu is generated in HTML.</p>
        <div>   
            <input type="submit" id="menubutton1" name="menubutton1_button" value="Options">
            <select id="menubutton1select" name="menubutton1select">
                <option  onclick="window.location('http://www.msnbc.com');" value="0">Refresh Queue</option>
                <option value="1">Transfer Document</option>
                <option value="2">Split Document</option>               
                <option value="3">Delete Document</option>
                <option value="4">Email Notification</option>
                <option value="5">Print Barcodes</option>
            </select>
        </div>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var oMenuButton1 = new YAHOO.widget.Button("menubutton1", {
                                        type: "menu",
                                        menu: "menubutton1select" });

    oMenuButton1.getMenu().clickEvent.subscribe(function(ev, args) {
        //The key here is srcElement, it's a link back to the original option element
        var opt = args[1].srcElement;
        alert('You clicked: ' + opt.innerHTML + ' (' + opt.value + ')');
    });
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/button/button-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var oMenuButton1 = new YAHOO.widget.Button("menubutton1", {
                                        type: "menu",
                                        menu: "menubutton1select" });

    oMenuButton1.getMenu().clickEvent.subscribe(function(ev, args) {
        //The key here is srcElement, it's a link back to the original option element
        var opt = args[1].srcElement;
        alert('You clicked: ' + opt.innerHTML + ' (' + opt.value + ')');
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
