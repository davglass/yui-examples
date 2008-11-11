<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Image Browser</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        #davdoc {
            min-width: 500px;
        }
        #images p {
            float: left;
            padding: 3px;
            margin: 3px;
            border: 1px solid black;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="bd">
        <p>Click an image to place it in the Editor.</p>
        <div id="images">
            <p><img src="pics/Photo1.jpg" title="Click me"></p>
            <p><img src="pics/Photo2.jpg" title="Click me"></p>
            <p><img src="pics/Photo3.jpg" title="Click me"></p>
            <p><img src="pics/Photo4.jpg" title="Click me"></p>
            <p><img src="pics/Photo5.jpg" title="Click me"></p>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = window.opener.YAHOO.widget.EditorInfo.getEditorById('msgpost');
        //Get a reference to the editor on the other page
    
    //Add a listener to the parent of the images
    Event.on('images', 'click', function(ev) {
        var tar = Event.getTarget(ev);
        //Check to see if we clicked on an image
        if (tar && tar.tagName && (tar.tagName.toLowerCase() == 'img')) {
            //Focus the editor's window
            myEditor._focusWindow();
            //Fire the execCommand for insertimage
            myEditor.execCommand('insertimage', tar.getAttribute('src', 2));
            //Close this window
            window.close();
        }
    });
})();
</script>
</body>
</html>
