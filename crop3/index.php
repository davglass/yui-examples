<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Image Cropper: Multiple Image Croppers Per Page</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Image Cropper: Multiple Image Croppers Per Page</a></h1></div>
    <div id="bd">
    <h2>Cropper #1</h2>
    <img src="yui.jpg" id="yui_img" height="333" width="500"> 
    <h2>Cropper #2</h2>
    <img src="yui.jpg" id="yui_img2" height="333" width="500">

    <h2>The HTML</h2>
    <textarea name="code" class="HTML">
    <h2>Cropper #1</h2>
    <img src="yui.jpg" id="yui_img" height="333" width="500"> 
    <h2>Cropper #2</h2>
    <img src="yui.jpg" id="yui_img2" height="333" width="500">
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
    var crop = new YAHOO.widget.ImageCropper('yui_img');

    var crop2 = new YAHOO.widget.ImageCropper('yui_img2', {
        initialXY: [20, 20],
        initHeight: (Dom.get('yui_img2').height / 2),
        initWidth: (Dom.get('yui_img2').width / 2),
        keyTick: 5,
        shiftKeyTick: 50        
    });
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/resize/resize-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/imagecropper/imagecropper-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var crop = new YAHOO.widget.ImageCropper('yui_img');

    var crop2 = new YAHOO.widget.ImageCropper('yui_img2', {
        initialXY: [20, 20],
        initHeight: (Dom.get('yui_img2').height / 2),
        initWidth: (Dom.get('yui_img2').width / 2),
        keyTick: 5,
        shiftKeyTick: 50        
    });


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
