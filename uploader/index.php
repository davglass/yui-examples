<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Image Uploader</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }

        .uploaderButton {
            position: absolute;
            opacity: 0;
        }
        .uploaderButton input {
            font-size: 300%;
            position: absolute;
            top: 0;
            display: inline;
            cursor: pointer;
        }
        
        #demo1, #demo2 {
            width: 380px;
            height: 30px;
        }
        #up1, #up2 {
            height: 15px;
            width: 17px;
            border: 1px solid black;
            background-color: #f2f2f2;
            background-image: url( browse.gif );
            background-repeat: no-repeat;
            padding: 2px;
            cursor: pointer;
            display: block;
            float: right;
        }
        #src1, #src2 {
            width: 350px;
        }
        #preview1, #preview2 {
            border: 1px solid black;
            margin: 10px;
            /*float: left;*/
            display: none;
        }
        .uploading {
            background-image: url( progress.gif ) !important;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Image Uploader Prototype</a></h1></div>
    <div id="bd">
        <div id="demo1">
            <span id="up1"></span>
            <input type="text" id="src1" size="50">
        </div>

        <div id="demo2">
            <span id="up2"></span>
            <input type="text" id="src2" size="50">
        </div>

        <div id="preview1"></div>
        <div id="preview2"></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="uploader.js"></script>
<script type="text/javascript">

YAHOO.util.Event.on(window, 'load', function() {
    var up1 = new YAHOO.uploader('up1', 'src1', 'preview1', 'loader1');
    var up2 = new YAHOO.uploader('up2', 'src2', 'preview2', 'loader2');
});

</script>
</body>
</html>
