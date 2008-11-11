<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Rich Text Editor for Wordpress Plugin</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Rich Text Editor for Wordpress Plugin</a></h1></div>
    <div id="bd">
    <p><strong>Update (12.05.07)</strong> - Updated the plugin to YUI Version 2.4.0. Fixed a couple of bugs and switched the comment editor over to the new SimpleEditor (for lighter pages), also minimized all internal JS scripts as well.</p>
    <p><strong>Update (09.25.07)</strong> - Updated the plugin to YUI Version 2.3.1. Fixed a couple of bugs and added support for not rendering the Editor if a highend mobile phone is detected.</p>
    <p>I have created a Wordpress plugin to replace the default Rich Text Editor in Wordpress with the newly released <a href="http://developer.yahoo.com/yui/editor/">YUI Rich Text Editor</a></p>
    <p><strong>Note:</strong> This plugin has only been tested on Wordpress versions 2.0.3 and 2.1.</p>
    <h2>Demo the plugin</h2>
    <p>You can demo the plugin here: <a href="http://rte.davglass.com/" target="_blank">http://rte.davglass.com</a></p>
    <p>The comments feature of the plugin has been activated, you can test the post editor by logging in with the username and password of: <code>rte</code></p>
    <p>Please be nice with the posts and the comments or I will have to turn off the demo.</p>
    <h2>Installing the Plugin</h2>
    <p>First download the plugin from here: <a href="wp-yui-rte.tar.gz">wp-yui-rte.tar.gz</a></p>
    <p>Next, unpack it under your Wordpress plugins directory. <code>/wp-content/plugins</code></p>
    <p>Now, log into your blog and click on the Plugins tab.</p>
    <p>Click the <strong>Activate</strong> link next to the newly installed plugin.</p>
    <p>Now click on the Users tab.</p>
    <p>Check the box next to "Use the visual rich editor when writing" on this page.</p>
    <p>You should now have the new YUI Rich Text Editor when you write a post.</p>
    <h2 id="fixhtml">Fixing the Allowed HTML in WordPress</h2>
    <p>By Default WordPress is a little strict on their allowed HTML. To fix this, add the following PHP to the bottom of your <code>wp-config.php</code> file.</p>
    <textarea name="code" class="PHP">
define('CUSTOM_TAGS', true);

	$allowedposttags = array ('address' => array (), 
        //Begin Changes for YUI Rich Text Editor
        'em' => array ('style' => array('background-color', 'color', 'text-align')),
        'strong' => array ('style' => array('background-color', 'color', 'text-align')), 
        'span' => array ('style' => array('background-color', 'color', 'text-align')), 
        'p' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'div' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'a' => array ('href' => array (), 'title' => array (), 'rel' => array (), 'rev' => array (), 'target' => array(), 'name' => array ()),
        'font' => array ('color' => array (), 'face' => array (), 'size' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h1' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h2' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h3' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h4' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h5' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'h6' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 

        'img' => array ('alt' => array (), 'align' => array (), 'border' => array (), 'height' => array (), 'hspace' => array (), 'longdesc' => array (),
            'vspace' => array (), 'src' => array (), 'width' => array (), 'title' => array(),
            'style' => array('border', 'padding')
        ), 
        'li' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'sub' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'sup' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'u' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'ul' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'ol' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        //End Changes for YUI Rich Text Editor

        'abbr' => array ('title' => array ()), 
        'acronym' => array ('title' => array ()), 
        'b' => array (), 
        'big' => array (), 
        'blockquote' => array ('cite' => array ()), 
        'br' => array (), 
        'button' => array ('disabled' => array (), 'name' => array (), 'type' => array (), 'value' => array ()), 'caption' => array ('align' => array ()), 
        'code' => array (), 
        'col' => array ('align' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array (), 'width' => array ()), 
        'del' => array ('datetime' => array ()), 
        'dd' => array (), 
        'dl' => array (), 
        'dt' => array (), 
        'fieldset' => array (), 
        'form' => array ('action' => array (), 'accept' => array (), 'accept-charset' => array (), 'enctype' => array (), 'method' => array (), 'name' => array (), 'target' => array ()),
        'hr' => array ('align' => array (), 
        'noshade' => array (), 'size' => array (), 'width' => array ()), 
        'i' => array (), 
        'ins' => array ('datetime' => array (), 'cite' => array ()), 
        'kbd' => array (), 
        'label' => array ('for' => array ()), 
        'legend' => array ('align' => array ()), 
        'pre' => array ('width' => array ()), 
        'q' => array ('cite' => array ()), 
        's' => array (), 
        'strike' => array (), 
        'table' => array ('align' => array (), 'bgcolor' => array (), 'border' => array (), 'cellpadding' => array (), 'cellspacing' => array (), 'rules' => array (), 'summary' => array (), 'width' => array ()), 
        'tbody' => array ('align' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array ()), 
        'td' => array ('abbr' => array (), 'align' => array (), 'axis' => array (), 'bgcolor' => array (), 'char' => array (), 'charoff' => array (), 'colspan' => array (), 'headers' => array (), 'height' => array (), 'nowrap' => array (), 'rowspan' => array (), 'scope' => array (), 'valign' => array (), 'width' => array ()),
        'textarea' => array ('cols' => array (), 'rows' => array (), 'disabled' => array (), 'name' => array (), 'readonly' => array ()), 
        'tfoot' => array ('align' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array ()), 
        'th' => array ('abbr' => array (), 'align' => array (), 'axis' => array (), 'bgcolor' => array (), 'char' => array (), 'charoff' => array (), 'colspan' => array (), 'headers' => array (), 'height' => array (), 'nowrap' => array (), 'rowspan' => array (), 'scope' => array (), 'valign' => array (), 'width' => array ()), 
        'thead' => array ('align' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array ()),
        'title' => array (), 'tr' => array ('align' => array (), 'bgcolor' => array (), 'char' => array (), 'charoff' => array (), 'valign' => array ()), 'tt' => array (),
        'var' => array () 
    );

	$allowedtags = array (
        'b' => array (), 
        'blockquote' => array ('cite' => array ()),
	    'code' => array (),
	    'i' => array (),
        'strike' => array (), 

        //Begin Changes for YUI Rich Text Editor
        'em' => array ('style' => array('background-color', 'color', 'text-align')),
        'strong' => array ('style' => array('background-color', 'color', 'text-align')), 
        'span' => array ('style' => array('background-color', 'color', 'text-align')), 
        'p' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'a' => array ('href' => array (), 'title' => array (), 'rel' => array (), 'rev' => array (), 'target' => array(), 'name' => array ()),
        'div' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'font' => array ('color' => array (), 'face' => array (), 'size' => array (), 'style' => array('background-color', 'color', 'text-align')), 
        'u' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'li' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'u' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'ul' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align')),
        'ol' => array ('align' => array (), 'style' => array('background-color', 'color', 'text-align'))
        //End Changes for YUI Rich Text Editor
	);
    </textarea>
    <h2>Activating the Rich Text Editor for comments</h2>
    <p>Click on the Plugin tab, then click on Plugin Editor.</p>
    <p>Now click on the WP YUI Rich Text Editor link on the right side of the page.</p>
    <p>Change this line:</p>
    <textarea name="code" class="PHP">
    $rte_comments = false;
    </textarea>
    <p>To this: </p>
    <textarea name="code" class="PHP">
    $rte_comments = true;
    </textarea>
    <h2>Post Screenshot</h2>
    <img src="post.jpg">
    <h2>Comments Screenshot</h2>
    <img src="comments.jpg">
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
