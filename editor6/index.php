<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Example</title>
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
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Another Editor Example</a></h1></div>
    <div id="bd">
        <p>This example shows how to create an element from a selection and then modify that newly created element.</p>
        <textarea id="editor">This is some test text.. Highlight some text and hit Ctrl + 2 (The number two)</textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = null;

        myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '522px',
            dompath: true,
            animate: true
        });
        myEditor.on('editorKeyDown', function(ev) {
            if (((ev.ev.keyCode == 82) || (ev.ev.keyCode == 98)) && (ev.ev.ctrlKey)) {
                this._createCurrentElement('span');
                var el = this.currentElement[0];
                var _span1 = this._getDoc().createElement('span');
                _span1.innerHTML = '&Dagger;_';
                _span1.className = 'subfield-delimiter';
                var _span2 = this._getDoc().createElement('span');
                _span2.innerHTML = el.innerHTML;
                _span2.className = 'subfield';
                el.innerHTML = '';
                el.appendChild(_span1);
                el.appendChild(_span2);
                alert('Now you can access that element via, myEditor.currentElement[0]');
            }
            
        }, myEditor, true);
        myEditor.render();
})();
        </textarea>
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
        myEditor = null;

        myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '522px',
            dompath: true,
            animate: true
        });
        myEditor.on('editorKeyDown', function(ev) {
            if (((ev.ev.keyCode == 82) || (ev.ev.keyCode == 98)) && (ev.ev.ctrlKey)) {
                this._createCurrentElement('span');
                var el = this.currentElement[0];
                var _span1 = this._getDoc().createElement('span');
                _span1.innerHTML = '&Dagger;_';
                _span1.className = 'subfield-delimiter';
                var _span2 = this._getDoc().createElement('span');
                _span2.innerHTML = el.innerHTML;
                _span2.className = 'subfield';
                el.innerHTML = '';
                el.appendChild(_span1);
                el.appendChild(_span2);
                alert('Now you can access that element via, myEditor.currentElement[0]');
            }
            
        }, myEditor, true);
        myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
