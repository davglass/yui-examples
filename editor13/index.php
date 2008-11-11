<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Image Browser</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #msgpost_container span.yui-toolbar-insertimage, #msgpost_container span.yui-toolbar-insertimage span.first-child {
            border-color: blue;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Image Browser</a></h1></div>
    <div id="bd">
        <p><a href="#thecode">Jump to the code</a></p>
        <p>This example will show how to open an "Image Browser" for the YUI Rich Text Editor.</p>
        <p><strong>Note</strong>: The "Image Browser" window will probably be blocked by your popup blocker.</p>
        <p>Now, click on the "Insert Image" icon (the one outlined in blue) to see the "Image Browser" window.</p>
        <textarea id="msgpost">This is a test</textarea>
        <h2 id="thecode">The Javascript on this Page</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        win = null;

    var myEditor = new YAHOO.widget.Editor('msgpost', {
        height: '300px',
        width: '522px',
        dompath: true, //Turns on the bar at the bottom
        animate: true //Animates the opening, closing and moving of Editor windows
    });
    myEditor.on('toolbarLoaded', function() {
        //When the toolbar is loaded, add a listener to the insertimage button
        this.toolbar.on('insertimageClick', function() {
            //Get the selected element
            var _sel = this._getSelectedElement();
            //If the selected element is an image, do the normal thing so they can manipulate the image
            if (_sel && _sel.tagName && (_sel.tagName.toLowerCase() == 'img')) {
                //Do the normal thing here..
            } else {
                //They don't have a selected image, open the image browser window
                win = window.open('files.php', 'IMAGE_BROWSER', 'left=20,top=20,width=500,height=500,toolbar=0,resizable=0,status=0');
                if (!win) {
                    //Catch the popup blocker
                    alert('Please disable your popup blocker!!');
                }
                //This is important.. Return false here to not fire the rest of the listeners
                return false;
            }
        }, this, true);
    }, myEditor, true);
    myEditor.on('afterOpenWindow', function() {
        //When the window opens, disable the url of the image so they can't change it
        Dom.get('insertimage_url').disabled = true;
    }, myEditor, true);
    myEditor.render();

})();
</textarea>
        <h2>The Javascript in the new Window</h2>
        <textarea name="code" class="JScript">
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
</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container-min.js"></script>	
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/menu/menu-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/button/button-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/editor/editor-beta-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        win = null;

    var myEditor = new YAHOO.widget.Editor('msgpost', {
        height: '300px',
        width: '522px',
        dompath: true, //Turns on the bar at the bottom
        animate: true //Animates the opening, closing and moving of Editor windows
    });
    myEditor.on('toolbarLoaded', function() {
        //When the toolbar is loaded, add a listener to the insertimage button
        this.toolbar.on('insertimageClick', function() {
            //Get the selected element
            var _sel = this._getSelectedElement();
            //If the selected element is an image, do the normal thing so they can manipulate the image
            if (_sel && _sel.tagName && (_sel.tagName.toLowerCase() == 'img')) {
                //Do the normal thing here..
            } else {
                //They don't have a selected image, open the image browser window
                win = window.open('files.php', 'IMAGE_BROWSER', 'left=20,top=20,width=500,height=500,toolbar=0,resizable=0,status=0');
                if (!win) {
                    //Catch the popup blocker
                    alert('Please disable your popup blocker!!');
                }
                //This is important.. Return false here to not fire the rest of the listeners
                return false;
            }
        }, this, true);
    }, myEditor, true);
    myEditor.on('afterOpenWindow', function() {
        //When the window opens, disable the url of the image so they can't change it
        Dom.get('insertimage_url').disabled = true;
    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
