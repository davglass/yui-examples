<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: YAHOO.Tools</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            height: 100px;
            width: 100px;
            border: 1px solid black;
            background-color: #ccc;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: YAHOO.Tools</a></h1></div>
    <div id="bd">
        <div id="demo"></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>


<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/logger/logger-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/yuitest/yuitest-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="tools.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Tool = YAHOO.tool,
        Suite = new Tool.TestSuite('yuisuite'),
        Assert = YAHOO.util.Assert;



    Event.onDOMReady(function() {

        var logger = new Tool.TestLogger(null, { height: '80%' });
            Suite.add( new Tool.TestCase({
                name: 'YAHOO.Tools',

                test_clipStyle: function() {
                    YAHOO.Tools.clipStyle('demo', 'backgroundColor', 'blue');
                    Assert.areEqual(Dom.get('demo')._style._backgroundColor, 'rgb(204, 204, 204)', 'Could not find the clipped style');
                    YAHOO.Tools.unclipStyle('demo', 'backgroundColor');
                    Assert.areEqual(Dom.getStyle('demo', 'backgroundColor'), 'rgb(204, 204, 204)', 'Could not find the clipped style');
                    /*
                    Assert.areEqual(Dom.get('editor_container'), editor.get('element_cont').get('element'), 'Could not find Editors container');
                    Assert.areEqual(Dom.get('editor_toolbar'), editor.toolbar.get('element'), 'Could not find Editors Toolbar');
                    Assert.isInstanceOf(YAHOO.widget.Toolbar, editor.toolbar, 'Could not find Toolbars Instance');
                    Assert.areEqual(Dom.getStyle('editor', 'display'), editor.getStyle('display'), 'Textarea is visible..');
                    Assert.isInstanceOf(YAHOO.widget.Overlay, editor.get('panel'), 'Could not find Overlay Instance');
                    */

                }
                /*
                test_content: function() {
                    var t_data = Dom.get('editor').value;
                    var e_data = editor.getEditorHTML();
                    Assert.areEqual(t_data, e_data, 'Editor data is different than text area');
                }
                */

            })); 
            Tool.TestRunner.add(Suite);

            if (parent && parent != window) {
                YAHOO.tool.TestManager.load();
            } else {
                YAHOO.tool.TestRunner.run();
            }
    }); 
})();


</script>
</body>
</html>
