<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Image Editor (like) Example</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #play, #play_show {
            height: 224px;
            width: 720px;
            background-image: url( background.jpg );
            border: 1px solid black;
            position: relative;
        }
        #play img, #play div.text,
        #play_show img, #play_show div.text {
            position: absolute;
            z-index: 1;
            cursor: move;
            height: 75px;
            width: 100px;
            border: 1px solid black;
        }
        #play_show img, #play_show div.text {
            border: none;
        }
        #play .yui-resize img {
            cursor: default;
        }
        #edit {
            display: none;
            height: 50px;
            width: 200px;
            position: absolute;
            background-color: white;
            border: 1px solid black;
            z-index: 999;
        }
        #edit textarea {
            height: 100%;
            width: 100%;
            border: none;
        }
        #buttons {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Image Editor (like) example</a></h1></div>
    <div id="bd">
        <p>This example combines the following examples:
            <ul>
                <li><a href="http://developer.yahoo.com/yui/examples/dragdrop/dd-region.html">Drag and Drop: Staying in a Region</a></li>
                <li><a href="http://developer.yahoo.com/yui/examples/dragdrop/dd-ontop.html">Drag & Drop: Drag and Drop with the Dragged Element on Top</a></li>
                <li><a href="http://developer.yahoo.com/yui/examples/resize/simple_resize.html">Resize Utility: Simple Resize</a></li>
                <li><a href="http://developer.yahoo.com/yui/examples/resize/eightway_resize.html">Resize Utility: 8-way Element Resize</a></li>
                <li><a href="http://blog.davglass.com/files/yui/editable/">A modified version of my Editable example</a></li>
            </ul>
        </p>
        <div id="edit"><textarea id="editor"></textarea></div>
        <div id="play"></div>
        <div id="buttons"></div>
        <div id="out"></div>
        <p><strong>Instructions:</strong></p>
        <p>Click the <code>Add Text</code> button to add some dynamic text in a resizable container. Double Click the text to edit it.</p>
        <p>Click the <code>Add Image</code> button to add an image from my server. Double Click that image to toggle the ability to resize.</p>
        <p>The only issue that I did not tackle in this example is that you can resize the element to make it "escape" from the bounding box.</p>
        <h2>The Javascript</h2>
        <a href="source.js">source.js file</a> - <a href="region.js">region.js file</a>
        <textarea name="code" class="JScript"><?php include('source.js'); ?></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/selector/selector-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/resize/resize-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/button/button-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="region.js"></script>
<script type="text/javascript" src="source.js"></script>
<script type="text/javascript">

(function() {

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
