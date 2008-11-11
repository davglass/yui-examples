<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Read Only</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-editor-masked {
            display: none;
        }
        #editor {
            visibility: hidden;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Read Only</a></h1></div>
    <div id="bd">
    <button id="toggle">Set Read Only</button>
    <textarea id="editor">
        This is a test<br><strong>Strong Tag</strong> <em>Em Tag</em> <span style="font-weight: bold">Style Bold</span>
        <p class="yui-noedit">This is some test text. And a <a href="#">test link</a>.</p>
        This is a test.<br>
        <span style="text-decoration: underline;">This is a test</span>.<br>
        <font face="Courier New"><u>This</u></font><font face="Courier New"> is</font> <b>some</b> <i id="testId">content</i>... <i class="test"><b class="test1 test2">Test Again</b></i><br>Some more plain text goes here..<br>
        <ol>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ol>
        <a href="http://blog.davglass.com/">This is <b>some</b> more test text.</a> This is some more test text. This is some more test text. This is some more test text.<br>
        <ul>
            <li>List Item</li>
        </ul>
        <font face="Times New Roman">This is some more test text. This is some more <b>test <i>text</i></b></font>. This is some more test text. This is some more test text. This is some more test text. This is some more test text. This is some more test text. This is some more test text. This is some more test text. 
    </textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '650px',
        dompath: true
    });
    editor.readOnly = false;
    editor.on('afterRender', function() {
        var iframe = editor._createIframe();
        iframe.set('id', iframe.get('id') + '_readonly');
        editor.get('iframe').get('parentNode').appendChild(iframe.get('element'));
        editor._readOnlyFrame = iframe;
    });
    editor.toggle = function() {
        if (this.readOnly) {
            button.set('label', 'Set Read Only');
            this.readOnly = false;
            this.set('disabled', false);
            this.show();
            this._readOnlyFrame.setStyle('visibility', 'hidden');
            this.get('iframe').setStyle('visibility', 'visible');
        } else {
            button.set('label', 'Set Editable');
            this.readOnly = true;
            this.set('disabled', true);
            this.hide();
            this.saveHTML();
            this.get('iframe').setStyle('visibility', 'hidden');
            var iframe = this.get('iframe');
            this.set('iframe', this._readOnlyFrame);
            this.get('iframe').setStyle('visibility', 'visible');
            this.get('iframe').setStyle('height', '100%');
            this._setInitialContent();
            this.set('iframe', iframe);
            //TODO, should grab all links here and make them non-clickable..
        }
    };
    editor.render();

    var button = new YAHOO.widget.Button('toggle');
    button.on('click', editor.toggle, editor, true);
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/container/container_core-min.js&2.6.0/build/menu/menu-min.js&2.6.0/build/element/element-beta-min.js&2.6.0/build/button/button-min.js&2.6.0/build/animation/animation-min.js&2.6.0/build/dragdrop/dragdrop-min.js&2.6.0/build/editor/editor-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>

<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '650px',
        dompath: true
    });
    editor.readOnly = false;
    editor.on('afterRender', function() {
        var iframe = editor._createIframe();
        iframe.set('id', iframe.get('id') + '_readonly');
        editor.get('iframe').get('parentNode').appendChild(iframe.get('element'));
        editor._readOnlyFrame = iframe;
    });
    editor.toggle = function() {
        if (this.readOnly) {
            button.set('label', 'Set Read Only');
            this.readOnly = false;
            this.set('disabled', false);
            this.show();
            this._readOnlyFrame.setStyle('visibility', 'hidden');
            this.get('iframe').setStyle('visibility', 'visible');
        } else {
            button.set('label', 'Set Editable');
            this.readOnly = true;
            this.set('disabled', true);
            this.hide();
            this.saveHTML();
            this.get('iframe').setStyle('visibility', 'hidden');
            var iframe = this.get('iframe');
            this.set('iframe', this._readOnlyFrame);
            this.get('iframe').setStyle('visibility', 'visible');
            this.get('iframe').setStyle('height', '100%');
            this._setInitialContent();
            this.set('iframe', iframe);
            //TODO, should grab all links here and make them non-clickable..
        }
    };
    editor.render();



    var button = new YAHOO.widget.Button('toggle');
    button.on('click', editor.toggle, editor, true);

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
