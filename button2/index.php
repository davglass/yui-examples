<html>
<head>
<title>Test</title>
<!-- Loading box -->
<link rel="stylesheet" type="text/css" href="http://www.freewebs.com/jcyui/yui/build/reset/reset.css">
<link rel="stylesheet" type="text/css" href="http://www.freewebs.com/jcyui/yui/build/fonts/fonts.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/container/assets/container.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/button/assets/button.css">
<link rel="stylesheet" type="text/css" href="http://www.freewebs.com/jcyui/yui-ext/resources/css/yui-ext.css">
<link rel="stylesheet" type="text/css" href="http://www.freewebs.com/jcyui/css/habom.css">
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/yahoo/yahoo-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/dom/dom-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://www.freewebs.com/jcyui/yui/build/element/element-beta.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/logger/logger-min.js"></script>
<script type="text/javascript" src="http://www.freewebs.com/jcyui/yui/build/button/button-beta.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/animation/animation-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/connection/connection-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/container/container-min.js"></script>
<script type="text/javascript" src="http://www.freewebs.com/jcyui/yui-ext/yui-ext.js"></script>

<script type="text/javascript">

function MakeRequest(pcCall,pcTarget) {
   var el = getEl(pcTarget);
   var mgr = el.getUpdateManager();
   mgr.loadScripts = true;
   mgr.update(pcCall);
}

function makeButton() {
    var oPushButton7 = new YAHOO.widget.Button({ label:"Add", id:"pushbutton7", type:"submit", container:"pushtest"});
}

</script>
</head>

<body>

<div id="container">
    <div id="btntest">
        <a href="javascript:MakeRequest('regtest.htm','btntest2')">Register</a>
    </div>
    <div id="btntest2"></div>
</div>

</body>
</html>
