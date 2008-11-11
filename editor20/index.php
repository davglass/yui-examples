<?php
if ($_GET['doctype']) {
    echo('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">'."\n");
}
?>
<html>
<head>
    <title>YUI: Editor: SourceForge Bug #1804028</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #bd p a {
            color: black;
        }
        #bd p a.selected {
            font-weight: bold;
            color: green;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: SourceForge Bug #1804028</a></h1></div>
    <div id="bd">
        <p>YUI RTE fix for SourceForge Bug #1804028.</p>
        <p><a href="#thecode">The Code</a></p>
        <p><a href="?doctype=1"<?= (($_GET['doctype'] && !$_GET['fix']) ? ' class="selected"' : '')?>>With DOCTYPE set &amp; no fix</a></p>
        <p><a href="?doctype=1&fix=1"<?= (($_GET['doctype'] && $_GET['fix']) ? ' class="selected"' : '')?>>With DOCTYPE set &amp; with fix</a></p>
        <p><a href="?doctype=0"<?= ((!$_GET['doctype'] && !$_GET['fix']) ? ' class="selected"' : '')?>>With No DOCTYPE set &amp; no fix</a></p>
        <p><a href="?doctype=0&fix=1"<?= ((!$_GET['doctype'] && $_GET['fix']) ? ' class="selected"' : '')?>>With No DOCTYPE set &amp; with fix</a></p>
        <textarea id="msgpost">This is a test</textarea>
        <h2 id="thecode">The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('msgpost', {
        <?php
            if (!$_GET['doctype']) {
                if ($_GET['fix']) {
                    ?>
html: '<html><head><title>{TITLE}</title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><base href="' + this._baseHREF +
            '"><style>{CSS}</style><style>{HIDDEN_CSS}</style></head><body onload="document.body._rteLoaded = true;">{CONTENT}</body></html>',
                    <?php
                }
            }
        ?>

        height: '300px',
        width: '535px',
        dompath: true, //Turns on the bar at the bottom
        animate: true //Animates the opening, closing and moving of Editor windows
    });
    myEditor.render();

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/element/element-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container_core-min.js"></script>     
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/menu/menu-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/button/button-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/editor/editor-beta-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('msgpost', {
        <?php
            if (!$_GET['doctype']) {
                if ($_GET['fix']) {
                    ?>
        html: '<html><head><title>{TITLE}</title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><base href="' + this._baseHREF + '"><style>{CSS}</style><style>{HIDDEN_CSS}</style></head><body onload="document.body._rteLoaded = true;">{CONTENT}</body></html>',
                    <?php
                }
            }
        ?>
        height: '300px',
        width: '535px',
        dompath: true, //Turns on the bar at the bottom
        animate: true //Animates the opening, closing and moving of Editor windows
    });
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');

})();

</script>
</body>
</html>
