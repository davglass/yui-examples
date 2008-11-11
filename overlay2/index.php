<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Overlay with rounded corners & a knob</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/container/assets/container.css">    
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" type="text/css" href="style.css">    
    <style>
        #spacer {
            height: 200px;
        }
    </style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Overlay with rounded corners & a knob</a></h1></div>

    <div id="bd">
<div id="dlg">
    <span class="corner_tr"></span>
    <span class="corner_tl"></span>
    <span class="corner_br"></span>
    <span class="corner_bl"></span>
    <span class="knob"></span>
    <div class="bd">
        This is a test. 
        This is a test. 
        This is a test. 
        This is a test. 
        This is a test. 
    </div>
</div>
<div id="spacer"></div>
<h2>The HTML</h2>
<textarea name="code" class="HTML">
<div id="dlg">
    <span class="corner_tr"></span>
    <span class="corner_tl"></span>
    <span class="corner_br"></span>
    <span class="corner_bl"></span>
    <span class="knob"></span>
    <div class="bd">
        This is a test. 
        This is a test. 
        This is a test. 
        This is a test. 
        This is a test. 
    </div>
</div>
</textarea>
<h2>The Javascript</h2>
<textarea name="code" class="JScript">
(function() {
    var Event = YAHOO.util.Event,
        panel = null;

    Event.onDOMReady(function() {
        panel = new YAHOO.widget.Overlay('dlg', {
            visible: true,
            height: '150px',
            width: '250px',
            xy: [100, 100]
        });
        panel.render(document.body);
	});

    dp.SyntaxHighlighter.HighlightAll('code');

})();
</textarea>
<h2>The CSS</h2>
<textarea name="code" class="HTML">
<?php
include('style.css');
?>
</textarea>

</div>
<div id="ft">&nbsp;</div>
</div>

<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">
(function() {
    var Event = YAHOO.util.Event,
        panel = null;

    Event.onDOMReady(function() {
        panel = new YAHOO.widget.Overlay('dlg', {
            visible: true,
            height: '150px',
            width: '250px',
            xy: [100, 100]
        });
        panel.render(document.body);
	});

    dp.SyntaxHighlighter.HighlightAll('code');

})();
</script>
</body>
</html>
