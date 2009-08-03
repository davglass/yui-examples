<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: DragDrop insert</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        
        #play {
            border: 1px solid black;
            width: 500px;
            float: right;
        }

        #play p {
            border: 1px solid green;
            padding: 1em;
            cursor: move;
            z-index: 9999;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: DragDrop Insert</a></h1></div>
    <div id="bd">
        <div id="play">
            <p>#1 This is some test text. This is some test text. This is some test text. This is some test text. </p>
            <p>#2 This is some test text. This is some test text. This is some test text. This is some test text. </p>
            <p>#3 This is some test text. This is some test text. This is some test text. This is some test text. </p>
            <p>#4 This is some test text. This is some test text. This is some test text. This is some test text. </p>
            <p>#5 This is some test text. This is some test text. This is some test text. This is some test text. </p>
        </div>
        <p>Drag one of the text snippets to the right and drop it on the Editor.</p>
        <textarea id="editor">
        </textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Sel = YAHOO.util.Selector;
    
    //Set all dd instances to use the shim so we can drag over the Editor
    YAHOO.util.DDM.useShim = true;

    //Create the Editor instance
    var myEditor = new YAHOO.widget.SimpleEditor('editor', {
        width: '600px',
        height: '300px',
        dompath: true
    });

    //Reset the DD element back to the start position
    var resetDD = function(dd) {
        dd.getDragEl().style.top = '';
        dd.getDragEl().style.left = '';
    };

    //Get the element's HTML and call the inserthtml execCommand
    var handleDrop = function() {
        var html = this.getDragEl().innerHTML;
        myEditor.execCommand('inserthtml', '<p>' + html + '</p>');
        resetDD(this);
    };

    //Reset the dd element when dropped
    var handleInvalidDrop = function() {
        resetDD(this);
    };
    //Wait until after render so we can get the Editors created container
    myEditor.on('afterRender', function() {
        //Get all the <p>tags inside the #play element
        var drags = Sel.query('#play p');
        for (var d = 0; d < drags.length; d++) {
            //Create a new DD instance for each
            var dd = new YAHOO.util.DD(drags[d]);
            //Listen for events
            dd.on('dragDropEvent', handleDrop);
            dd.on('invalidDropEvent', handleInvalidDrop);
        }
        //Create the target for the Editor.
        new YAHOO.util.DDTarget(myEditor.get('element_cont').get('element'));
    });
    //Render the Editor
    myEditor.render();

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/selector/selector-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/editor/simpleeditor-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Sel = YAHOO.util.Selector;
    
    //Set all dd instances to use the shim so we can drag over the Editor
    YAHOO.util.DDM.useShim = true;

    //Create the Editor instance
    var myEditor = new YAHOO.widget.SimpleEditor('editor', {
        width: '600px',
        height: '300px',
        dompath: true
    });

    //Reset the DD element back to the start position
    var resetDD = function(dd) {
        dd.getDragEl().style.top = '';
        dd.getDragEl().style.left = '';
    };

    //Get the element's HTML and call the inserthtml execCommand
    var handleDrop = function() {
        var html = this.getDragEl().innerHTML;
        myEditor.execCommand('inserthtml', '<p>' + html + '</p>');
        resetDD(this);
    };

    //Reset the dd element when dropped
    var handleInvalidDrop = function() {
        resetDD(this);
    };
    //Wait until after render so we can get the Editors created container
    myEditor.on('afterRender', function() {
        //Get all the <p>tags inside the #play element
        var drags = Sel.query('#play p');
        for (var d = 0; d < drags.length; d++) {
            //Create a new DD instance for each
            var dd = new YAHOO.util.DD(drags[d]);
            //Listen for events
            dd.on('dragDropEvent', handleDrop);
            dd.on('invalidDropEvent', handleInvalidDrop);
        }
        //Create the target for the Editor.
        new YAHOO.util.DDTarget(myEditor.get('element_cont').get('element'));
    });
    //Render the Editor
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
