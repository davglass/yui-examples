<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Button: Menu Button in scrolled container</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #play {
            height: 200px;
            width: 200px;
            overflow: auto;
            position: relative;
        }
        #play .inner {
            height: 600px;
        }
        #play .inner .cont {
            border: 1px solid blue;
            height: 75px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Button: Menu Button in scrolled container</a></h1></div>
    <div id="bd">
    <div id="play">
        <div class="inner">
            <div class="cont" id="cont1"></div>
            <div class="cont" id="cont2"></div>
            <div class="cont" id="cont3"></div>
            <div class="cont" id="cont4"></div>
            <div class="cont" id="cont5"></div>
        </div>
    </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script> 
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        var Menu = [
            { text: "one", value: 1 },
            { text: "two", value: 2 },
            { text: "three", value: 3 }
        ];
        
        new YAHOO.widget.Button({ type: "menu", label: "one", name: "mymenubutton1", menu: Menu, container: "cont1", focusmenu: false });
        new YAHOO.widget.Button({ type: "menu", label: "one", name: "mymenubutton2", menu: Menu, container: "cont2", focusmenu: false });
        new YAHOO.widget.Button({ type: "menu", label: "one", name: "mymenubutton3", menu: Menu, container: "cont3", focusmenu: false });
        new YAHOO.widget.Button({ type: "menu", label: "one", name: "mymenubutton3", menu: Menu, container: "cont4", focusmenu: false });
        new YAHOO.widget.Button({ type: "menu", label: "one", name: "mymenubutton3", menu: Menu, container: "cont5", focusmenu: false });
        
})();

</script>
</body>
</html>
