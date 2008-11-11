<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Invalid HTML Filtering</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Invalid HTML Filtering</a></h1></div>
    <div id="bd">
        <p>YUI RTE 2.3.1 has a bug in the _fixNodes method that prevents it from properly filtering invalid HTML.</p>
        <p>The <a href="#thecode">following code snippet</a> fixes this issue.</p>
        <textarea id="msgpost">This is a test</textarea>
        <h2 id="thecode">The Javascript</h2>
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
    myEditor.on('afterNodeChange', function() {
        var doc = this._getDoc(),
            els = [];

        for (var v in this.invalidHTML) {
            if (YAHOO.lang.hasOwnProperty(this.invalidHTML, v)) {
                var tags = doc.body.getElementsByTagName(v);
                if (tags.length) {
                    for (var i = 0; i &lt; tags.length; i++) {
                        els.push(tags[i]);
                    }
                }
            }
        }
        for (var h = 0; h &lt; els.length; h++) {
            if (els[h].parentNode) {
                els[h].parentNode.removeChild(els[h]);
            }
        }
    }, myEditor, true);
    myEditor.render();
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/element/element-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container_core-min.js"></script>     
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
    myEditor.on('afterNodeChange', function() {
        var doc = this._getDoc(),
            els = [];

        for (var v in this.invalidHTML) {
            if (YAHOO.lang.hasOwnProperty(this.invalidHTML, v)) {
                var tags = doc.body.getElementsByTagName(v);
                if (tags.length) {
                    for (var i = 0; i < tags.length; i++) {
                        els.push(tags[i]);
                    }
                }
            }
        }
        for (var h = 0; h < els.length; h++) {
            if (els[h].parentNode) {
                els[h].parentNode.removeChild(els[h]);
            }
        }
    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
