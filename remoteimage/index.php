<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Remote Image URL from Javascript</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/calendar/assets/calendar.css"> 
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #status {
            background-color: #ccc;
            border: 1px solid black;
            margin: 1em;
            height: 50px;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Remote Image URL from Javascript</a></h1></div>
    <div id="bd">
        <p>Loaded style sheet from:<br>
        <code>http://yui.yahooapis.com/2.2.2/build/calendar/assets/calendar.css</code></p>
        <div id="status"></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    dp.SyntaxHighlighter.HighlightAll('code');
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        status = null;

    Event.on(window, 'load', function() {
        status = Dom.get('status');
        var div = document.createElement('div');
        div.className = 'yui-calendar';
        div.style.position = 'absolute';
        div.style.top = '-9999px';
        div.style.left = '-9999px';

        var div2 = document.createElement('div');
        div2.className = 'calnavleft';
        div.appendChild(div2);

        document.body.appendChild(div);

        status.innerHTML = 'Remote URL: ' + parseURL(Dom.getStyle(div2, 'background-image'));
    });

    function parseURL(url) {
        url = url.replace('url(', '').replace(')', '').replace(/"/g, '');
        return url;
    }

})()

</script>
</body>
</html>
