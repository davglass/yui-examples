<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Dom: getXY rounding bug patch</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            height: 100px;
            width: 100px;
            position: relative;
            top: 45px;
            left: 200px;
            border: 1px solid black;
            background-color: #ccc;
        }
        #code {
            margin-top: 100px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Dom: getXY rounding bug patch</a></h1></div>
    <div id="bd">
        <div id="results"></div>
        <div id="demo"></div>
        <h2 id="code">Path Code</h2>
        <p>Place this code <strong>after</strong> the include for utilities.</p>
        <textarea name="code" class="JScript">
    YAHOO.util.Dom._getXY = YAHOO.util.Dom.getXY;
    YAHOO.util.Dom.getXY = function() {
        var xy = YAHOO.util.Dom._getXY.apply(this, arguments);
        return [Math.round(xy[0]), Math.round(xy[1])];
    };
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var xy = YAHOO.util.Dom.getXY('demo');
    var res = YAHOO.util.Dom.get('results');
    var p = document.createElement('p');
    p.innerHTML = 'getXY Before Patch: [' + xy[0] + ',' + xy[1] + ']';
    res.appendChild(p);

    YAHOO.util.Dom._getXY = YAHOO.util.Dom.getXY;
    YAHOO.util.Dom.getXY = function() {
        var xy = YAHOO.util.Dom._getXY.apply(this, arguments);
        return [Math.round(xy[0]), Math.round(xy[1])];
    };

    var xy = YAHOO.util.Dom.getXY('demo');
    var p = document.createElement('p');
    p.innerHTML = 'getXY After Patch: [' + xy[0] + ',' + xy[1] + ']';
    res.appendChild(p);
    
    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
