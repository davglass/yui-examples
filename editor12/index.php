<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor in Multiple Tabs</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-editor-container {
            position: absolute;
            top: -9999px;
            left: -9999px;
            z-index: 999; /* So Safari behaves */
        }
        #editor {
            visibility: hidden;
            position: absolute;
        }
        .yui-content {
            height: 270px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor in Multiple Tabs</a></h1></div>
    <div id="bd">
        <p>This example shows how to use one editor to edit the content of several TabView tabs.</p>
        <p><a href="thecode">Jump to the code</a></p>
        <div id="tabs"></div>
        <textarea id="editor">This is a test</textarea>
        <h2 id="thecode">The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        editing = false;

    var myTabs = new YAHOO.widget.TabView("tabs");

    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab1',
        label: 'Tab One Label',
        content: '<p>Tab One Content - This content will not have an editor<p>',
        active: true
    }));
    
    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab2',
        label: 'Tab Two Label',
        content: '<p>Tab <i>Two Content</i> - This content will have an editor</p>'
    }));
    
    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab3',
        label: 'Tab Three Label',
        content: '<p><b>Tab Three</b> Content - This content will have an editor</p>'
    }));

    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab4',
        label: 'Tab Four Label',
        content: '<p><u>Tab Four</u> Content - This content will have an editor</p>'
    }));

    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab5',
        label: 'Tab Five Label',
        content: '<p><b>Tab <i>Five</i></b> Content - This content will have an editor</p>'
    }));
	

    myTabs.on('activeTabChange', function(ev) {
        if (editing) {
            myEditor.saveHTML(); 
            editing.innerHTML = myEditor.get('element').value; 
        }
        if (ev.newValue.get('id') == 'tab1') {
            Dom.setXY(myEditor.get('element_cont').get('element'), [-9000, -9000]);
        } else {
            var tar = ev.newValue.get('contentEl');
            editing = tar;
            var xy = Dom.getXY(tar);
            myEditor.setEditorHTML(tar.innerHTML);
            Dom.setXY(myEditor.get('element_cont').get('element'), xy);
        }
    });
    
    var myConfig = {
        height: '150px',
        width: '380px',
        animate: true,
        toolbar: {
            titlebar: 'My Editor',
            collapse: true,
            buttons: [
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold', value: 'bold' },
                        { type: 'push', label: 'Italic', value: 'italic' },
                        { type: 'push', label: 'Underline', value: 'underline' },
                        { type: 'separator' },
                        { type: 'select', label: 'Arial', value: 'fontname', disabled: true,
                            menu: [
                                { text: 'Arial', checked: true },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS' },
                                { text: 'Courier New' },
                                { text: 'Lucida Console' },
                                { text: 'Tahoma' },
                                { text: 'Times New Roman' },
                                { text: 'Trebuchet MS' },
                                { text: 'Verdana' }
                            ]
                        },
                        { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                }
            ]
        }
    };
    
    var myEditor = new YAHOO.widget.Editor('editor', myConfig);
    myEditor.render();
    
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/tabview/tabview-min.js"></script>	
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
        editing = false;

    var myTabs = new YAHOO.widget.TabView("tabs");
	
    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab1',
        label: 'Tab One Label',
        content: '<p>Tab One Content - This content will not have an editor<p>',
        active: true
    }));
    
    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab2',
        label: 'Tab Two Label',
        content: '<p>Tab <i>Two Content</i> - This content will have an editor</p>'
    }));
    
    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab3',
        label: 'Tab Three Label',
        content: '<p><b>Tab Three</b> Content - This content will have an editor</p>'
    }));

    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab4',
        label: 'Tab Four Label',
        content: '<p><u>Tab Four</u> Content - This content will have an editor</p>'
    }));

    myTabs.addTab( new YAHOO.widget.Tab({
        id: 'tab5',
        label: 'Tab Five Label',
        content: '<p><b>Tab <i>Five</i></b> Content - This content will have an editor</p>'
    }));

    myTabs.on('activeTabChange', function(ev) {
        if (editing) {
            myEditor.saveHTML(); 
            editing.innerHTML = myEditor.get('element').value; 
        }
        if (ev.newValue.get('id') == 'tab1') {
            Dom.setXY(myEditor.get('element_cont').get('element'), [-9000, -9000]);
        } else {
            var tar = ev.newValue.get('contentEl');
            editing = tar;
            var xy = Dom.getXY(tar);
            myEditor.setEditorHTML(tar.innerHTML);
            Dom.setXY(myEditor.get('element_cont').get('element'), xy);
        }
    });
    
    var myConfig = {
        height: '150px',
        width: '380px',
        animate: true,
        toolbar: {
            titlebar: 'My Editor',
            collapse: true,
            buttons: [
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold', value: 'bold' },
                        { type: 'push', label: 'Italic', value: 'italic' },
                        { type: 'push', label: 'Underline', value: 'underline' },
                        { type: 'separator' },
                        { type: 'select', label: 'Arial', value: 'fontname', disabled: true,
                            menu: [
                                { text: 'Arial', checked: true },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS' },
                                { text: 'Courier New' },
                                { text: 'Lucida Console' },
                                { text: 'Tahoma' },
                                { text: 'Times New Roman' },
                                { text: 'Trebuchet MS' },
                                { text: 'Verdana' }
                            ]
                        },
                        { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                }
            ]
        }
    };
    
    var myEditor = new YAHOO.widget.Editor('editor', myConfig);
    myEditor.render();
    

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
