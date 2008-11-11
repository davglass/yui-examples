<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Bug #1857235</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Bug #1857235</a></h1></div>
    <div id="bd">
        <p>This <a href="patch-min.js">patch file</a> fixes this <a href="https://sourceforge.net/tracker/?func=detail&atid=836476&aid=1857235&group_id=165715">reported issue</a>.</p>
        <textarea id="editor">
        <span style="background-color: #0080ff;">Some text</span>
        </textarea>
        <div id="buttonHolder"></div>

        <textarea id="result" style="height: 300px; width: 500px;">
        </textarea>

        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/editor/editor-beta-min.js"></script> 
<script type="text/javascript" src="patch-min.js"></script>        
        </textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px',
        height: '300px'
    });
    myEditor.render();

    var button = new YAHOO.widget.Button({
        label: 'Save HTML',
        value: 'save',
        container: 'buttonHolder'
    });
    button.on('click', function() {
        myEditor.saveHTML();
        Dom.get('result').value = myEditor.get('textarea').value;
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/editor/editor-beta-min.js"></script> 
<script type="text/javascript" src="patch.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px',
        height: '300px'
    });
    myEditor.render();

    var button = new YAHOO.widget.Button({
        label: 'Save HTML',
        value: 'save',
        container: 'buttonHolder'
    });
    button.on('click', function() {
        myEditor.saveHTML();
        Dom.get('result').value = myEditor.get('textarea').value;
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
