<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Test</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset/reset-min.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/fonts/fonts-min.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/container/assets/container.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/button/assets/button.css">
    <script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/container/container-min.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/dragdrop/dragdrop-min.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/animation/animation-min.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/element/element-beta-min.js"></script> 
    <script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/logger/logger.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/button/button-beta-min.js"></script> 
    <script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/connection/connection-min.js"></script>
</head>
<body>
<form>
<div id="btncancel"></div>
</form>
<script type='text/javascript'>
var YUI_btncancel = new YAHOO.widget.Button('btncancel', { label:'Cancel', type:'button'});
console.log(YUI_btncancel);
YUI_btncancel.addListener('click',function(o) {alert("here");});
</script>

</body>
</html>
