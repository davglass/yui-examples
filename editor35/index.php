<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor in TabView (advanced)</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #editor1 {
            visibility: hidden;
            width: 100%;
            height: 400px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor in TabView (advanced)</a></h1></div>
    <div id="bd">
    <p>Example posted for this <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/22425">YDN Javascript thread</a>.</p>
    <p><a href="#thecode">Jump to the code</a></p>
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li class="selected"><a href="#tab1"><em>Editor</em></a></li>
                <li><a href="#tab2"><em>HTML</em></a></li>
            </ul>            
            <div class="yui-content">
                <div>
                    <textarea id="editor1">You <strong>can</strong> <em>edit this</em> text..<br>Then click the HTML tab to edit the HTML.</textarea>
                </div>
                <div><p>Tab Two Content</p></div>
            </div>
        </div>
    
    <h2 id="thecode">The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang;

    var tabView = new YAHOO.widget.TabView('demo'); 
    tabView.on('beforeActiveTabChange', function(ev) {
        var oldTab = ev.prevValue,
            newTab = ev.newValue;

        if (newTab === tabView.get('tabs')[1]) {
            //HTML tab
            myEditor.saveHTML();
            myEditor.hide();
        } else {
            //Editor tab
            myEditor.show();
            myEditor.setEditorHTML(myEditor.get('textarea').value);
        }
    });

    var myEditor = new YAHOO.widget.Editor('editor1', {
        height: '300px',
        width: '530px',
        dompath: true
    });
    myEditor.on('editorContentLoaded', function() {
        //Move the text area to the HTML tab
        var textArea = myEditor.get('textarea');
        Dom.setStyle(textArea, 'left', '');
        Dom.setStyle(textArea, 'top', '');
        Dom.setStyle(textArea, 'position', 'static');
        Dom.setStyle(textArea, 'visibility', 'visible');
    
        var tab = tabView.get('tabs')[1].get('contentEl');
        tab.innerHTML = '';
        tab.appendChild(textArea);
    });
    myEditor.render();

})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/tabview/tabview-min.js"></script> 
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

    var tabView = new YAHOO.widget.TabView('demo'); 
    tabView.on('beforeActiveTabChange', function(ev) {
        var oldTab = ev.prevValue,
            newTab = ev.newValue;

        if (newTab === tabView.get('tabs')[1]) {
            //HTML tab
            myEditor.saveHTML();
            myEditor.hide();
        } else {
            //Editor tab
            myEditor.show();
            myEditor.setEditorHTML(myEditor.get('textarea').value);
        }
    });

    var myEditor = new YAHOO.widget.Editor('editor1', {
        height: '300px',
        width: '530px',
        dompath: true
    });
    myEditor.on('editorContentLoaded', function() {
        //Move the text area to the HTML tab
        var textArea = myEditor.get('textarea');
        Dom.setStyle(textArea, 'left', '');
        Dom.setStyle(textArea, 'top', '');
        Dom.setStyle(textArea, 'position', 'static');
        Dom.setStyle(textArea, 'visibility', 'visible');
    
        var tab = tabView.get('tabs')[1].get('contentEl');
        tab.innerHTML = '';
        tab.appendChild(textArea);
    });
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
