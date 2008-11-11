<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Local Combo Handler</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2, blockquote {
            margin: 1em;
        }
        pre {
            border: 1px solid #ddd;
            background-color: #efefef;
            padding: .5em;
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Local Combo Handler</a></h1></div>
    <div id="bd">
        <p><strong>Note:</strong> Before I start, it should be noted that my server is not under my control so I can't tweak it to serve these files faster. So the examples may load a little slow.</p>
        <p>This guide will help you install a local combo handler instance that will work with YUI 2.6.0.</p>
        <p>We will be using an Open Source project called <a href="http://code.google.com/p/minify/">Minify</a> to handle our combo files.</p>
        <blockquote>
        Minify is a PHP5 app that can combine multiple CSS or Javascript files, compress their contents (i.e. removal of unnecessary whitespace/comments), and serve the results with HTTP encoding (gzip/deflate) and headers that allow optimal client-side caching. This helps you follow several of Yahoo!'s <a rel="nofollow" href="http://developer.yahoo.com/performance/index.html#rules">Rules for High Performance Web Sites</a>.
        </blockquote>
        <h2>Setup Minify</h2>
        <p>First we need to download the minify source <a href="http://code.google.com/p/minify/downloads/list">here</a> and unzip it. You will see a list of files and directories like this:</p>
<pre>
HISTORY.txt
LICENSE.txt
README.txt
UPGRADING.txt
min/
min_unit_tests/
</pre>
        <p>We need to move the <code>min</code> directory to the root of the webserver and rename it <code>combo</code>.</p>
<pre>
sudo mv min /var/www/combo
</pre>
        <p>Now edit the default config file and change a few options:</p>
<pre>
vim /var/www/combo/config.php
</pre>
        <p>Update the following options:</p>
<textarea name="code" class="PHP">
$min_cachePath = '/tmp'; //Sets a directory to store the cached files
$min_enableBuilder = false; //We don't want people getting to the builder
$min_serveOptions['maxAge'] = 180000; //Set the range for a re-cache high
$min_serveOptions['minApp']['maxFiles'] = 30; //Bump up the default files
//Add the following line to keep minify from compressing the javascript since -min files
//are already compressed.
$min_serveOptions['minifiers']['application/x-javascript'] = '';
</textarea>
        <p>Now <code>minify</code> should be installed and operational.</p>

        <h2>Setup the library code</h2>
        <p>First create a place in the webroot to store your library files:</p>
<pre>
sudo mkdir /var/www/lib
</pre>
        <p>Now download the YUI <a href="http://developer.yahoo.com/yui/download">2.6.0 release here</a> and unzip it. You will see a list of files like this:</p>
<pre>
README
as-docs/
as-src/
assets/
build/
docs/
examples/
index.html
tests/
</pre>
        <p>Now create a directory under <code>lib<code> called <code>2.6.0</code>.</p>
<pre>
sudo mkdir /var/www/lib/2.6.0
</pre>
        <p>Now move the <code>build</code> directory inside the <code>lib/2.6.0</code> directory.</p>

        <h2>Setting up YUILoader</h2>
        <p>Now configure the YUILoader to fetch it's files from the local combo handler instead of the default one.</p>
        <p>First load the local copy of the YUILoader from our webroot.</p>
<textarea name="code" class="HTML">
<script type="text/javascript" src="/libs/2.6.0/build/yuiloader/yuiloader.js"></script>
</textarea>
        <p>The final step is to configure YUILoader use the local combo handler.</p>
        <p>There are 3 main options that need to be configured: <code>comboBase, filter and skin</code></p>
        <p><code>comboBase</code>: This needs to be set to the local handler: <code>/combo/?b=libs&amp;f=</code></p>
        <p><code>filter</code>: YUILoader uses an &amp; to separate the URL pieces, but minify expects a , so we need to apply a filter that replaces all &amp; characters with a ,</p>
        <p><code>skin</code>: This is needed for skinning, minify has a tough time with relative file paths in a CSS file, this option tells YUILoader to rollup skin files. This way we get the full skin with good relative paths.</p>
        <h2>Example config</h2>
<textarea name="code" class="JScript">
// Instantiate and configure Loader:
var loader = new YAHOO.util.YUILoader({
    require: ["button"],
    comboBase: '/combo/?b=libs&f=',
    loadOptional: true,
    filter: {
        'searchExp': /&2/g, 
        'replaceStr': ",2"
    },
    skin: {
        defaultSkin: 'sam', 
        base: 'assets/skins/',
        path: 'skin.css',
        rollup: 1
    },
    onSuccess: function() {
        //Files are loaded..
    },
    timeout: 10000,
    combine: true
});

loader.insert();
</textarea>


        <h2>Example Page</h2>
        <!--a href="yui3.php">YUI 3 - PR2</a><br-->
        <p><a href="yui2.php">Page loading YUI 2.6.0 from a local handler</a></p>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
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
