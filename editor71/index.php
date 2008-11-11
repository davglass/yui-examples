<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: SimpleEditor href attribute</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #out {
            display: none;
            height: 400px;
            width: 80%;
            margin: 2em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: SimpleEditor href attribute</a></h1></div>
    <div id="bd">
    <p>In response to this <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/39298">YDN-Javascript Post</a></p>
    <p>Enter some text, create a link then click the Clean HTML button.</p>
    <p><button id="saveOut">Clean HTML</button></p>
    <textarea id="editor">
    </textarea>
    <textarea id="out">
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.SimpleEditor('editor', {
        height: '300px',
        width: '600px',
        dompath: true
    });
    editor.on('toolbarLoaded', function() {
        editor.toolbar.on('createlinkClick', function() {
            editor.on('afterExecCommand', function() {
                var a = editor.currentElement[0];
                if (a) {
                    a.setAttribute('rel', 'shadowbox');
                }
            });
        });
    });
    editor.render();

    var button = new YAHOO.widget.Button('saveOut');
    button.on('click', function() {
        var html = editor.saveHTML();
        Dom.get('out').value = html;
        Dom.setStyle('out', 'display', 'block');
    });

})();
    </textarea>

    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/container/container_core-min.js&2.6.0/build/menu/menu-min.js&2.6.0/build/element/element-beta-min.js&2.6.0/build/button/button-min.js&2.6.0/build/animation/animation-min.js&2.6.0/build/dragdrop/dragdrop-min.js&2.6.0/build/editor/simpleeditor-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="source.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.SimpleEditor('editor', {
        height: '300px',
        width: '600px',
        dompath: true
    });
    editor.on('toolbarLoaded', function() {
        editor.toolbar.on('createlinkClick', function() {
            editor.on('afterExecCommand', function() {
                var a = editor.currentElement[0];
                if (a) {
                    a.setAttribute('rel', 'shadowbox');
                }
            });
        });
    });
    editor.render();

    var button = new YAHOO.widget.Button('saveOut');
    button.on('click', function() {
        var html = editor.saveHTML();
        Dom.get('out').value = html;
        Dom.setStyle('out', 'display', 'block');
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
