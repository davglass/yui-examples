<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Edit in place</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Edit in place</a></h1></div>
    <div id="bd">
<p>Double click on any item that says it's editable.</p>
<ul id="example">
    <li class="editable">Test Editable Item #1</li>
    <li>Test Non-Editable Item #2</li>
    <li class="editable">Test Editable Item #3</li>
    <li>Test Non-Editable Item #4</li>
    <li class="editable">Test Editable Item #5</li>
</ul>
<p>
This is a test of a non-editable P tag. 
This is a test of a non-editable P tag. 
This is a test of a non-editable P tag. 
This is a test of a non-editable P tag. 
This is a test of a non-editable P tag. 
This is a test of a non-editable P tag.
<hr>
<span class="editable">This is a test of an editable SPAN tag.</span>
</p>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="js/editable.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    /*
        Override the default class
        editable.config.class_naame = 'MYCLASSNAME';
        Setup a custom callback function i.e. for AJAX Request
        editable.callback = function() { alert('CallBack: ' + editable.contents_new); };
    */
    
    Event.onAvailable('example', editable.init, editable, true);
})();

</script>
</body>
</html>
