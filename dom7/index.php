<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Dom.getXY on Fixed Position Elements</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #fixed1, #fixed2 {
            position: fixed;
            height: 100px;
            width: 100px;
            border: 1px solid black;
            background-color: #ccc;
        }
        #play {
            position: absolute;
            top: 200px;
            left: 500px;
            border: 1px solid black;
            background-color: yellow;
            height: 300px;
            width: 500px;
        }
        #davdoc {
            min-height: 1800px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Dom.getXY on Fixed Position Elements</a></h1></div>
    <div id="bd">
        <p>This example gets the XY position of an element with the style position of <code>fixed</code>. Click the document to get the XY of the 2 fixed elements. Then scroll and click again to get an updated position.</p>
        <div id="fixed1">Fixed Element #1</div>
        <div id="play">
            <div id="fixed2">Fixed Element #2</div>
        </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var getFixedXY = function(el) {
        el = Dom.get(el);
        var xy = Dom.getXY(el);
        var l = el.offsetLeft;
        var t = el.offsetTop;
        //For Opera and Webkit
        t = (el.ownerDocument.body.scrollTop + t);

        if (YAHOO.env.ua.gecko) {
            //Gecko needs to get scrollTop on the documentElement
            t = (el.ownerDocument.documentElement.scrollTop + xy[1]);
        }
        
        return 'Top: ' + t + '<br>Left: ' +  l;
    };

    Event.on(document, 'click', function() {
        Dom.get('fixed1').innerHTML = getFixedXY('fixed1');
        Dom.get('fixed2').innerHTML = getFixedXY('fixed2');
    });


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
