<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor - IE over SSL</title>
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor - IE over SSL</a></h1></div>
    <div id="bd">
    <textarea id="editor">
    You can edit this text..
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang;

    YAHOO.widget.SimpleEditor.prototype._createIframe = function() {
            var ifrmDom = document.createElement('iframe');
            ifrmDom.id = this.get('id') + '_editor';
            var config = {
                border: '0',
                frameBorder: '0',
                marginWidth: '0',
                marginHeight: '0',
                leftMargin: '0',
                topMargin: '0',
                allowTransparency: 'true',
                width: '100%'
            };
            for (var i in config) {
                if (Lang.hasOwnProperty(config, i)) {
                    ifrmDom.setAttribute(i, config[i]);
                }
            }
            var isrc = 'javascript:;';
            if (this.browser.ie) {
                isrc = 'about:blank';
            }
            ifrmDom.setAttribute('src', isrc);
            var ifrm = new YAHOO.util.Element(ifrmDom);
            return ifrm;
        };

    var myEditor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '530px',
        dompath: true
    });
    
    myEditor.render();
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
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang;

    YAHOO.widget.SimpleEditor.prototype._createIframe = function() {
            var ifrmDom = document.createElement('iframe');
            ifrmDom.id = this.get('id') + '_editor';
            var config = {
                border: '0',
                frameBorder: '0',
                marginWidth: '0',
                marginHeight: '0',
                leftMargin: '0',
                topMargin: '0',
                allowTransparency: 'true',
                width: '100%'
            };
            for (var i in config) {
                if (Lang.hasOwnProperty(config, i)) {
                    ifrmDom.setAttribute(i, config[i]);
                }
            }
            var isrc = 'javascript:;';
            if (this.browser.ie) {
                isrc = 'about:blank';
            }
            ifrmDom.setAttribute('src', isrc);
            var ifrm = new YAHOO.util.Element(ifrmDom);
            return ifrm;
        };

    var myEditor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '530px',
        dompath: true
    });
    
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
