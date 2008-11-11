<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: YAHOO.util.Element</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            border: 1px solid black;
            margin: 2em;
            width: 350px;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: YAHOO.util.Element</a></h1></div>
    <div id="bd">
        <div id="demo">
        <p>This is a test.</p>
        <p>This is a test.</p>
        <p>This is a test.</p>
        </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>

<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="event-debug.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/dom/dom-min.js"></script> 
<script type="text/javascript" src="element-beta-debug.js"></script> 
<script type="text/javascript">


YAHOO.namespace('dav');

YAHOO.dav = function() {
    return {
        init: function() {
            console.log('init function fired');
            console.log(this);
            element.on('click', function() { console.log('clicked'); console.log(this); });
        },
        click: function() {
            console.log('click fired');
            console.log(this);
        },
        toString: function() {
            return 'YAHOO.dav';
        }
    }
}();

var element = new YAHOO.util.Element('demo');
console.log(element);
element.on('contentReady', YAHOO.dav.init, YAHOO.dav, true);


</script>
</body>
</html>
