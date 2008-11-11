<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: </title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo1, #demo2 {
            height: 150px
            width: 150px;
            background-color: #C0C0C0;
            border: 1px solid black;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: </a></h1></div>
    <div id="bd">
        <div id="demo1">Demo #1</div>
        <div id="demo2">Demo #2</div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        Dom.getBorderSizes = function(el) {
            var s = [];
            s[0] = Dom.getStyle(el, 'borderTopWidth');
            s[1] = Dom.getStyle(el, 'borderRightWidth');
            s[2] = Dom.getStyle(el, 'borderBottomWidth');
            s[3] = Dom.getStyle(el, 'borderLeftWidth');
            return s
        };

    Event.on(document, 'click', function() {
        var s = 'YUI: Border1: ' + Dom.getBorderSizes('demo1') + '\n';
            s += 'YUI: Border2: ' + Dom.getBorderSizes('demo2') + '\n';
            if (Dom.getStyle('demo2', 'border') == '') {
                s += 'New Border Added, Check Again..';
            } else {
                s += 'Directly applied border works, css border doesn\'t';
            }
            alert(s);

            Dom.setStyle('demo2', 'border', '2px solid red');
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
