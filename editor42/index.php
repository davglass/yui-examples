<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor SpellCheck Example</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-spellcheck span.yui-toolbar-icon {
            background-image: url( spellcheck.gif );
            background-position: 1px 0px;
            top: 1px;
            left: 4px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-spellcheck-selected span.yui-toolbar-icon {
            background-image: url( spellcheck.gif );
            background-position: 1px 0px;
            top: 1px;
            left: 4px;
        }
        .yui-spellcheck-list {
            cursor: pointer;
        }
        .yui-skin-sam .yui-editor-panel .yui-spellcheck-list li {
            padding-left: 5px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor SpellCheck Example</a></h1></div>
    <div id="bd">
        <p>I don't have aspell or pspell on my server, so this is a static example of how to do spell checking with the Editor.</p>
        <p>Currently the only 2 misspellings supported by this checker is <code>Thsi</code> and <code>tset</code>.</p>
        <p>You will need to provide the backend spell check server (of your choice) and modify this code in the proper places (commented).</p>
        <textarea id="editor">
        Thsi is a tset.<br>
        Thsi is a tset.<br>
        Thsi is a tset.
        </textarea>
        <h2>The Javascript</h2>
        <p><a href="spellcheck.js">Link to the full source file.</a></p>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/editor/editor-min.js"></script>
<script type="text/javascript" src="spellcheck.js"></script>

<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
