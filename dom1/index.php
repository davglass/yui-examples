<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Dom + IE Issue</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Dom + IE Issue</a></h1></div>
    <div id="bd">
    </div>
<div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="yahoo.js"></script> 
<script type="text/javascript" src="dom-debug.js"></script> 
<script type="text/javascript">

var config = {
    basic: 'Config Object'
}

var el = YAHOO.util.Dom.get(config);
if (el) {
    YAHOO.util.Dom.get('bd').innerHTML = 'Found el [' + el + ']';
} else {
    YAHOO.util.Dom.get('bd').innerHTML = 'el FAILED [' + el + ']';
}
</script>
</body>
</html>
