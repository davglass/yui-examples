<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: ImageCropper reset patch</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: ImageCropper reset patch</a></h1></div>
    <div id="bd">
        <img id="yui_img" src="yui.jpg" width="500" height="333">
        <p><input type="button" id="reset" value="Reset Cropper"></p>
        <h2>The Source</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;


    var crop = new YAHOO.widget.ImageCropper('yui_img', {
        initialXY: [20, 20],
        keyTick: 5,
        shiftKeyTick: 50
    });

    Event.on('reset', 'click', function() {
        this._resize.destroy();
        this._resizeEl.parentNode.removeChild(this._resizeEl);
        this._createResize();
        this._setConstraints();
    }, crop, true);
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/resize/resize-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/imagecropper/imagecropper-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;


    var crop = new YAHOO.widget.ImageCropper('yui_img', {
        initialXY: [20, 20],
        keyTick: 5,
        shiftKeyTick: 50
    });

    Event.on('reset', 'click', function() {
        this._resize.destroy();
        this._resizeEl.parentNode.removeChild(this._resizeEl);
        this._createResize();
        this._setConstraints();
    }, crop, true);
    

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
