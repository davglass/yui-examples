<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: External Data</title>
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: External Data</a></h1></div>
    <div id="bd">
    <p></p>
    <form method="get" action="#" id="form0">
        <textarea id="data" rows="10" cols="50"></textarea>
        <br>
        <button id="plain">Insert Plain</button>
        <button id="blue">Insert Blue</button>
        <button id="red">Insert Red</button>
    </form>
<form method="post" action="#" id="form1">
<textarea id="editor" name="editor" rows="20" cols="75"></textarea>
</form>
    
    <h2>The Code</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    var myConfig = {
        height: '300px',
        width: '530px',
        animate: true,
        dompath: true,
        focusAtStart: true
    };

    var myEditor = new YAHOO.widget.Editor('editor', myConfig);
    myEditor.render();

    Event.onDOMReady(function() {
        Event.on(['plain', 'red', 'blue'], 'click', function(e) {
            var html = false,
                tar = Event.getTarget(e);
            Event.stopEvent(e);
            if (Dom.get('data').value) {
                html = Dom.get('data').value;
            }
            if (html) {
                myEditor._focusWindow();
                if (tar.id != 'plain') {
                    html = '<span style="color: ' + tar.id + '">' + html + '</span>';
                }
                myEditor.execCommand('inserthtml', html);
            }
        })
    });
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/editor/editor-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    var myConfig = {
        height: '300px',
        width: '530px',
        animate: true,
        dompath: true,
        focusAtStart: true
    };

    var myEditor = new YAHOO.widget.Editor('editor', myConfig);
    myEditor.render();

    Event.onDOMReady(function() {
        Event.on(['plain', 'red', 'blue'], 'click', function(e) {
            var html = false,
                tar = Event.getTarget(e);
            Event.stopEvent(e);
            if (Dom.get('data').value) {
                html = Dom.get('data').value;
            }
            if (html) {
                myEditor._focusWindow();
                if (tar.id != 'plain') {
                    html = '<span style="color: ' + tar.id + '">' + html + '</span>';
                }
                myEditor.execCommand('inserthtml', html);
            }
        })
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
