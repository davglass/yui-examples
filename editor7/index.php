<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Dirty Change</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #editor_container {
            margin: 1em;
        }
        #bd {
            position: relative;
        }
        #data {
            height: 350px;
            width: 350px;
            top: 50px;
            right: 25px;
            position: absolute;
            border: 1px solid black;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Dirty Change</a></h1></div>
    <div id="bd">
        <textarea id="editor">This is some test text.. </textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = null,
        timer = null;

        var update = function(ev) {
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(function() {
                Dom.get('data').innerHTML = myEditor.cleanHTML();
            }, 100);
        };

        myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '522px',
            dompath: true,
            animate: true
        });
        myEditor.on('afterNodeChange', update);
        myEditor.on('editorKeyDown', update);
        myEditor.render();
})();
        </textarea>
        <div id="data"></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/tabview/tabview-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/button/button-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/editor/editor-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = null,
        timer = null;

        var update = function(ev) {
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(function() {
                Dom.get('data').innerHTML = myEditor.cleanHTML();
            }, 100);
        };

        myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '522px',
            dompath: true,
            animate: true
        });
        myEditor.on('afterNodeChange', update);
        myEditor.on('editorKeyDown', update);
        myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
