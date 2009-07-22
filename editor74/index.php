<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor: Insert Code</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yui-toolbar-container .yui-toolbar-insertcode span.yui-toolbar-icon {
            background-image: url( html_editor.gif );
            background-position: 0 1px;
            left: 5px;
        }
        .yui-skin-sam .yui-toolbar-container .yui-button-insertcode-selected span.yui-toolbar-icon {
            background-image: url( html_editor.gif );
            background-position: 0 1px;
            left: 5px;
        }
        .yui-toolbar-group-insertitem {
            *width: auto;
        }
        #newcode {
            height: 90%;
            width: 100%;
        }
        
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor: Insert Code</a></h1></div>
    <div id="bd">
        <p>Adding formatted code to the Editor.</p>
        <textarea id="editor">
        </textarea>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        panel = null;

    //Create the Editor instance
    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px',
        height: '300px',
        dompath: true,
        //Add extra css to style <code> elements
        extracss: 'code { white-space: pre; border: 1px solid #ccc; display: block; }'
    });
    myEditor.on('toolbarLoaded', function() {
        //Create the Button
        var codeConfig = {
            type: 'push', label: 'Insert HTML Code', value: 'insertcode'
        };
        YAHOO.log('Create the (editcode) Button', 'info', 'example');
        this.toolbar.addButtonToGroup(codeConfig, 'insertitem');
        
        //The button was clicked
        myEditor.toolbar.on('insertcodeClick', function() {
            //Insert a temp node to interact with, note the ID
            myEditor.execCommand('inserthtml', '<code id="insertcode"></code>');
            //Disable the Editor
            myEditor.set('disabled', true);
            //show the panel
            panel.show();
            //Stop the event
            return false;
        });
        //The button in the Panel
        Event.on('newcode-button', 'click', function() {
            //Hide the panel
            panel.hide();
            //Get the contents of the textarea
            var html = Dom.get('newcode').value;
            //Get the <code> tag that was inserted from the insertcode click
            var code = myEditor._getDoc().getElementById('insertcode');
            //Set the innerHTML to that of the textarea's content
            code.innerHTML = html;
            //REMOVE THE ID, important so we can do it again
            code.id = '';
            //Reset the edit area
            Dom.get('newcode').value = 'Add Code Here';
            //Enable the Editor
            myEditor.set('disabled', false);
        });
    }, myEditor, true);
    myEditor.render();
    
    //Create a panel to show the Edit Window
    panel = new YAHOO.widget.Panel('code', {
        height: '400px',
        width: '400px',
        fixedcenter: true,
        visible: false,
        close: false,
        modal: true
    });
    //Set the Header
    panel.setHeader('Insert Code');
    //Add some content
    panel.setBody('&lt;textarea id="newcode"&gt;Add Code Here&lt;/textarea&gt;<br><input type="button" id="newcode-button" value="Insert Code">');
    panel.render(document.body);

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/container/container-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/editor/editor-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        panel = null;

    //Create the Editor instance
    var myEditor = new YAHOO.widget.Editor('editor', {
        width: '530px',
        height: '300px',
        dompath: true,
        //Add extra css to style <code> elements
        extracss: 'code { white-space: pre; border: 1px solid #ccc; display: block; }'
    });
    myEditor.on('toolbarLoaded', function() {
        //Create the Button
        var codeConfig = {
            type: 'push', label: 'Insert HTML Code', value: 'insertcode'
        };
        YAHOO.log('Create the (editcode) Button', 'info', 'example');
        this.toolbar.addButtonToGroup(codeConfig, 'insertitem');
        
        //The button was clicked
        myEditor.toolbar.on('insertcodeClick', function() {
            //Insert a temp node to interact with, note the ID
            myEditor.execCommand('inserthtml', '<code id="insertcode"></code>');
            //Disable the Editor
            myEditor.set('disabled', true);
            //show the panel
            panel.show();
            //Stop the event
            return false;
        });
        //The button in the Panel
        Event.on('newcode-button', 'click', function() {
            //Hide the panel
            panel.hide();
            //Get the contents of the textarea
            var html = Dom.get('newcode').value;
            //Get the <code> tag that was inserted from the insertcode click
            var code = myEditor._getDoc().getElementById('insertcode');
            //Set the innerHTML to that of the textarea's content
            code.innerHTML = html;
            //REMOVE THE ID, important so we can do it again
            code.id = '';
            //Reset the edit area
            Dom.get('newcode').value = 'Add Code Here';
            //Enable the Editor
            myEditor.set('disabled', false);
        });
    }, myEditor, true);
    myEditor.render();
    
    //Create a panel to show the Edit Window
    panel = new YAHOO.widget.Panel('code', {
        height: '400px',
        width: '400px',
        fixedcenter: true,
        visible: false,
        close: false,
        modal: true
    });
    //Set the Header
    panel.setHeader('Insert Code');
    //Add some content
    panel.setBody('<textarea id="newcode">Add Code Here</textarea><br><input type="button" id="newcode-button" value="Insert Code">');
    panel.render(document.body);

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
