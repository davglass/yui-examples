<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Split Button on Hover</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Split Button on Hover</a></h1></div>
    <div id="bd">
<input type="submit" id="splitbutton1" name="splitbutton1_button" value="Split Button 1">
<select id="splitbutton1select" name="splitbutton1select" multiple>
    <option value="0">One</option>
    <option value="1">Two</option>
    <option value="2">Three</option>                
</select>
    <h2>The HTML</h2>
    <textarea name="code" class="HTML">
<input type="submit" id="splitbutton1" name="splitbutton1_button" value="Split Button 1">
<select id="splitbutton1select" name="splitbutton1select" multiple>
    <option value="0">One</option>
    <option value="1">Two</option>
    <option value="2">Three</option>                
</select>
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        var oSplitButton1 = new YAHOO.widget.Button("splitbutton1", {
            type: "split",
            menu: "splitbutton1select"
        });
        oSplitButton1.on('mouseover', function(ev) {
            var tar = Event.getTarget(ev);
            this._showMenu(ev);
        });

})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/button/button-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        var oSplitButton1 = new YAHOO.widget.Button("splitbutton1", {
            type: "split",
            menu: "splitbutton1select"
        });
        oSplitButton1.on('mouseover', function(ev) {
            var tar = Event.getTarget(ev);
            this._showMenu(ev);
        });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
