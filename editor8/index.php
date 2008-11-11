<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Full Screen</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
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
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Full Screen</a></h1></div>
    <div id="bd">
        <p>Click the collapse button on the editor's toolbar to launch full screen mode..</p>
        <textarea id="editor">This is some test text.. </textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        //myEditor = null,
        full = false,
        defaults = {};

        YAHOO.widget.Toolbar.prototype.STR_COLLAPSE = 'Full Screen Mode';
        myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '522px',
            dompath: true,
            animate: true
        });
        myEditor.on('toolbarLoaded', function() {
            myEditor.toolbar.on('toolbarCollapsed', function() {
                //Cancel the default action
                Dom.setStyle(this.toolbar.get('cont'), 'display', 'block');
                if (full === false) {
                    full = true; //Make it full screen
                    this.get('element_cont').setStyle('zIndex', '99999'); //For Safari
                    this.get('element_cont').setStyle('position', 'absolute');
                    this.get('element_cont').setStyle('top', '0');
                    this.get('element_cont').setStyle('left', '0');
                    this.get('element_cont').setStyle('width', Dom.getClientWidth() + 'px');
                    this.get('element_cont').setStyle('height', Dom.getClientHeight() + 'px');
                    Dom.setStyle(this.get('iframe').get('parentNode'), 'height', '100%');
                    Dom.setStyle(this.get('element_cont').get('firstChild'), 'height', '89%');
                } else {
                    full = false; //Make it normal again
                    this.get('element_cont').setStyle('position', 'static');
                    this.get('element_cont').setStyle('top', '');
                    this.get('element_cont').setStyle('left', '');
                    this.get('element_cont').setStyle('width', defaults.width);
                    this.get('element_cont').setStyle('height', '');
                    Dom.setStyle(this.get('iframe').get('parentNode'), 'height', defaults.height);
                    Dom.setStyle(this.get('element_cont').get('firstChild'), 'height', '');
                }
            }, myEditor, true);
        });
        myEditor.on('afterRender', function() {
            defaults.height = myEditor.get('height');
            defaults.width = myEditor.get('width');
        });
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
        //myEditor = null,
        full = false,
        defaults = {};
        YAHOO.widget.Toolbar.prototype.STR_COLLAPSE = 'Full Screen Mode';
        myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '522px',
            dompath: true,
            animate: true
        });
        myEditor.on('toolbarLoaded', function() {
            myEditor.toolbar.on('toolbarCollapsed', function() {
                //Cancel the default action
                Dom.setStyle(this.toolbar.get('cont'), 'display', 'block');
                if (full === false) {
                    full = true; //Make it full screen
                    this.get('element_cont').setStyle('zIndex', '99999'); //For Safari
                    this.get('element_cont').setStyle('position', 'absolute');
                    this.get('element_cont').setStyle('top', '0');
                    this.get('element_cont').setStyle('left', '0');
                    this.get('element_cont').setStyle('width', Dom.getClientWidth() + 'px');
                    this.get('element_cont').setStyle('height', Dom.getClientHeight() + 'px');
                    Dom.setStyle(this.get('iframe').get('parentNode'), 'height', '100%');
                    Dom.setStyle(this.get('element_cont').get('firstChild'), 'height', '89%');
                } else {
                    full = false; //Make it normal again
                    this.get('element_cont').setStyle('position', 'static');
                    this.get('element_cont').setStyle('top', '');
                    this.get('element_cont').setStyle('left', '');
                    this.get('element_cont').setStyle('width', defaults.width);
                    this.get('element_cont').setStyle('height', '');
                    Dom.setStyle(this.get('iframe').get('parentNode'), 'height', defaults.height);
                    Dom.setStyle(this.get('element_cont').get('firstChild'), 'height', '');
                }
            }, myEditor, true);
        });
        myEditor.on('afterRender', function() {
            defaults.height = myEditor.get('height');
            defaults.width = myEditor.get('width');
        });
        myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
