<?php
    if ($_GET['content'] == 'false') {
    } else {
        header('Content-type: application/xhtml+xml');
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:risb="http://steeplesoft.com/yuisf">
<head>
    <title>YUI: Button Widget and XHTML page</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"/> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css"/>     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css"/>
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Button Widget and XHTML page</a></h1></div>
    <div id="bd">
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/button/button-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var _button = new YAHOO.widget.Button({
        id: 'xhtml_button',
        label: 'XHTML Button',
        value: 'one',
        container: 'bd'
    });
        

    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
