<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Vim Syntax and AutoComplete (v0.1)</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2, ul {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Vim Syntax and AutoComplete (v0.1)</a></h1></div>
    <div id="bd">
    <p>Here are a couple of files to make working with the YUI in vim/gvim a little easier.</p>
    <p>Currently the only supported methods are: YAHOO, YAHOO.util, YAHOO.util.Dom, YAHOO.util.Event, YAHOO.util.CustomEvent, YAHOO.util.Anim &amp; YAHOO.Tools</p>
    <h2>Files</h2>
    <ul>
        <li><a href="javascript.vim">Syntax File</a></li>
        <li><a href="javascriptcomplete.vim">AutoComplete File</a></li>
    </ul>
    <h2>Install Instructions</h2>
    <p>I'm not going to give full instructions, because if you are using vim you should know where these files go 8-)</p>
    <p>Place the <code>javascript.vim</code> file in the <code>syntax</code> directory. And place the <code>javascriptcomplete.vim</code> file in the <code>autoload</code> directory.</p>
    <h2>Enable Code Completion</h2>
    <p>In your .vimrc file place this line:<br>
    <code>autocmd FileType javascript set omnifunc=javascriptcomplete#CompleteJS</code></p>
    <h2>Using Code Completion</h2>
    <p>From Insert mode, hit the following keys to use code completion.<br><code>ctrl + X, ctrl + O</code></p>
    <h2>Screenshot</h2>
    <p><img src="./shot.jpg" alt="screenshot"></p>
    </div>
    <div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="../js/yui-012.js"></script>
<script type="text/javascript" src="../js/tools-min.js"></script>
<script type="text/javascript" src="../js/effects-min.js"></script>
<script src="../js/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">


function init() {
}

$E.addListener(window, 'load', init);

</script>
</body>
</html>
