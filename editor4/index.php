<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor inside a TabView</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-content {
            height: 450px;
        }
        .yui-content textarea {
            visibility: hidden;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor inside of a TabView Control</a></h1></div>
    <div id="bd">
        <p><a href="#theCode">Skip to the code</a> - This example show's <strong>a</strong> way to get the YUI Rich Text Editor to workm inside of a TabView control.</p>
        <p>It should be noted that this is an expensive way to go about this, since it must recreate the editor everytime the tab that contains it is opened.</p>
        <div id="demo"></div>
        <h2 id="theCode">The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        myEditor = null,
        myTabs = null,
        editorTab = null;

        //Create the TabView control..
        myTabs = new YAHOO.widget.TabView("demo");
	    
        //Add the first tab
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab 1',
            content: '<p>Tab One Content</p>',
            active: true
        }));
        
        //Add the editor tab
        editorTab = new YAHOO.widget.Tab({
            label: 'Tab 2',
            content: '&lt;textarea id="editor"&gt;This is some test text to be loaded in the editor.&lt;/textarea&gt;'
        });

        myTabs.addTab(editorTab);
        
        //Add the third tab
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab 3',
            content: '<p>Tab Three Content</p>'
        }));
        
        //On the activeTabChange event
        myTabs.on('activeTabChange', function(ev) {
            //If myEditor is defined, then destroy it, we are on another tab
            if (myEditor) {
                myEditor.destroy();
                myEditor = null;
            }
            //If the tab we are changing to is the editorTab from above, setup the Editor
            if (ev.newValue == editorTab) {
                myEditor = new YAHOO.widget.Editor('editor', {
                    height: '300px',
                    width: '522px'
                });
                //Give the editor's window focus after the content is loaded..
                myEditor.on('editorContentLoaded', myEditor._focusWindow);
                //Render the editor
                myEditor.render();
            }
        });
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
        myEditor = null,
        myTabs = null,
        editorTab = null;

        myTabs = new YAHOO.widget.TabView("demo");
	
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab 1',
            content: '<p>Tab One Content</p>',
            active: true
        }));
        

        editorTab = new YAHOO.widget.Tab({
            label: 'Tab 2',
            content: '<textarea id="editor">This is some test text to be loaded in the editor.</textarea>'
        });

        myTabs.addTab(editorTab);
        
        myTabs.addTab( new YAHOO.widget.Tab({
            label: 'Tab 3',
            content: '<p>Tab Three Content</p>'
        }));
        
        myTabs.on('activeTabChange', function(ev) {
            if (myEditor) {
                myEditor.destroy();
                myEditor = null;
            }
            if (ev.newValue == editorTab) {
                myEditor = new YAHOO.widget.Editor('editor', {
                    height: '300px',
                    width: '522px'
                });
                myEditor.on('editorContentLoaded', myEditor._focusWindow);
                myEditor.render();
            }
        });


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
