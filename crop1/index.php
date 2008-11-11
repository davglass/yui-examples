<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: ImageCropper bug</title>
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: ImageCropper Bug</a></h1></div>
    <div id="bd">
        <p>This patch fixes an <a href="http://developer.yahoo.com/yui/imagecropper/">ImageCropper</a> issue, where the ImageCropper fails to resize the crop mask properly.</p>
        <img src="yui.jpg" id="yui_img" height="333" width="500">
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
var crop = new YAHOO.widget.ImageCropper('yui_img');
crop.on('resizeEvent', function() {
    this._resizeMaskEl.style.height = Math.floor(this._resize._cache.height) + 'px';
    this._resizeMaskEl.style.width = Math.floor(this._resize._cache.width) + 'px';
}, crop, true);       
</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/resize/resize-beta.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/imagecropper/imagecropper-beta.js"></script>

<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var crop = new YAHOO.widget.ImageCropper('yui_img');
    crop.on('resizeEvent', function() {
        this._resizeMaskEl.style.height = Math.floor(this._resize._cache.height) + 'px';
        this._resizeMaskEl.style.width = Math.floor(this._resize._cache.width) + 'px';
    }, crop, true);

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
