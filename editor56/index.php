<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: IM Test</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #im {
            border: 1px solid black;
            background-color: #F4F5EB;
            width: 500px;
            margin: 2em;
            position: relative;
            padding-bottom: 10px;
        }
        #im textarea {
            visibility: hidden;
        }
        #im .yui-toolbar-container {
            background-color:transparent;
        }
        #im .yui-toolbar-container .yui-toolbar-subcont {
            border: none;
        }
        #im .yui-editor-container {
            border: none;
        }
        #im .yui-editor-editable-container {
            border: 1px solid #808080;
            margin-left: 80px;
        }
        #avatar {
            height: 75px;
            width: 75px;
            border: 1px solid #808080;
            border-right: none;
            background-color: #ccc;
            position: absolute;
            left: 5px;
            bottom: 10px;
        }
        #avatar img {
            height: 75px;
            width: 75px;
        }
        #send {
            height: 75px;
            width: 70px;
            position: absolute;
            right: 0;
            bottom: 12px;
            _bottom: 10px;
        }
        #send_button {
            height: 75px;
            width: 65px;
            display: block;
        }
        #send_button .first-child {
            height: 75px;
            *width: 67px;
            _width: 65px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: IM Test</a></h1></div>
    <div id="bd">
        <div id="im">
            <div id="avatar"><img src="http://us.i1.yimg.com/us.yimg.com/i/identity/nopic_192.gif"></div>
            <div id="send"></div>
            <textarea id="message"></textarea>
        </div>

        <h2>The HTML</h2>
        <textarea name="code" class="HTML">
        <div id="im">
            <div id="avatar"><img src="http://us.i1.yimg.com/us.yimg.com/i/identity/nopic_192.gif"></div>
            <div id="send"></div>
            &lt;textarea id="message"&gt;&lt;/textarea&gt;
        </div>
        </textarea>

        <h2>The CSS</h2>
        <textarea name="code" class="CSS">
        #im {
            border: 1px solid black;
            background-color: #F4F5EB;
            width: 500px;
            margin: 2em;
            position: relative;
            padding-bottom: 10px;
        }
        #im textarea {
            visibility: hidden;
        }
        #im .yui-toolbar-container {
            background-color:transparent;
        }
        #im .yui-toolbar-container .yui-toolbar-subcont {
            border: none;
        }
        #im .yui-editor-container {
            border: none;
        }
        #im .yui-editor-editable-container {
            border: 1px solid #808080;
            margin-left: 80px;
        }
        #avatar {
            height: 75px;
            width: 75px;
            border: 1px solid #808080;
            border-right: none;
            background-color: #ccc;
            position: absolute;
            left: 5px;
            bottom: 10px;
        }
        #send {
            height: 75px;
            width: 70px;
            position: absolute;
            right: 0;
            bottom: 12px;
            _bottom: 10px;
        }
        #send_button {
            height: 75px;
            width: 65px;
            display: block;
        }
        #send_button .first-child {
            height: 75px;
            *width: 67px;
            _width: 65px;
        }
        </textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.SimpleEditor('message', {
        height: '75px',
        width: '350px',
        extracss: 'body { font-family: Comic Sans MS; }',
        toolbar: {
            titlebar: false,
            grouplabels: false,
            buttons: [
                { group: 'fontstyle', label: 'Font Name and Size',
                    buttons: [
                        { type: 'select', label: 'Comic Sans MS', value: 'fontname',
                            menu: [
                                { text: 'Arial' },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS', checked: true },
                                { text: 'Courier New' },
                                { text: 'Lucida Console' },
                                { text: 'Tahoma' },
                                { text: 'Times New Roman' },
                                { text: 'Trebuchet MS' },
                                { text: 'Verdana' }
                            ]
                        },
                        { type: 'separator' },
                        { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true }
                    ]
                },
                { type: 'separator' },
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true }
                        
                    ]
                }
            ]
            
        }
    });
    editor.on('toolbarLoaded', function() {
        this.toolbar.on('fontnameClick', function(o) {
            if (!this._hasSelection()) {
                var button = o.button;
                this._createCurrentElement('span', {
                    fontFamily: button.value
                });
                var el = this.currentElement[0];
                if (this.browser.webkit) {
                    //Little Safari Hackery here..
                    el.innerHTML = '<span class="yui-non">&nbsp;</span>';
                    el = el.firstChild;
                    this._getSelection().setBaseAndExtent(el, 1, el, el.innerText.length);                    
                } else if (this.browser.ie || this.browser.opera) {
                    el.innerHTML = '&nbsp;';
                }
                this._focusWindow();
                this._selectNode(el);
                return false;
            }
        }, this, true);
    });
    editor.on('afterRender', function() {
        Dom.get('im').insertBefore(Dom.get('im').firstChild, this.get('toolbar_cont'));
    });
    editor.on('afterNodeChange', function() {
        this.toolbar.enableButton('fontname');
    });
    editor.render();

    var button = new YAHOO.widget.Button({
        id: 'send_button',
        label: 'Send',
        container: 'send'
    });

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/editor/simpleeditor-beta-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.SimpleEditor('message', {
        height: '75px',
        width: '350px',
        extracss: 'body { font-family: Comic Sans MS; }',
        toolbar: {
            titlebar: false,
            grouplabels: false,
            buttons: [
                { group: 'fontstyle', label: 'Font Name and Size',
                    buttons: [
                        { type: 'select', label: 'Comic Sans MS', value: 'fontname',
                            menu: [
                                { text: 'Arial' },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS', checked: true },
                                { text: 'Courier New' },
                                { text: 'Lucida Console' },
                                { text: 'Tahoma' },
                                { text: 'Times New Roman' },
                                { text: 'Trebuchet MS' },
                                { text: 'Verdana' }
                            ]
                        },
                        { type: 'separator' },
                        { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true }
                    ]
                },
                { type: 'separator' },
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true }
                        
                    ]
                }
            ]
            
        }
    });
    editor.on('toolbarLoaded', function() {
        this.toolbar.on('fontnameClick', function(o) {
            if (!this._hasSelection()) {
                var button = o.button;
                this._createCurrentElement('span', {
                    fontFamily: button.value
                });
                var el = this.currentElement[0];
                if (this.browser.webkit) {
                    //Little Safari Hackery here..
                    el.innerHTML = '<span class="yui-non">&nbsp;</span>';
                    el = el.firstChild;
                    this._getSelection().setBaseAndExtent(el, 1, el, el.innerText.length);                    
                } else if (this.browser.ie || this.browser.opera) {
                    el.innerHTML = '&nbsp;';
                }
                this._focusWindow();
                this._selectNode(el);
                return false;
            }
        }, this, true);
    });
    editor.on('afterRender', function() {
        Dom.get('im').insertBefore(Dom.get('im').firstChild, this.get('toolbar_cont'));
    });
    editor.on('afterNodeChange', function() {
        this.toolbar.enableButton('fontname');
    });
    editor.render();

    var button = new YAHOO.widget.Button({
        id: 'send_button',
        label: 'Send',
        container: 'send'
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
