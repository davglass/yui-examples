<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Overlay Footer</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/container/assets/container.css"> 
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #test {
            height: 200px;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Overlay setFooter</a></h1></div>
    <div id="bd">
        <div id="test"></div>
        <textarea name="code" class="JScript">
    YAHOO.util.Event.on(window, 'load', function() {
        panel = new YAHOO.widget.Overlay('testPanel', { visible: true, width: '200px' });
        panel.setBody('This is a test');
        panel.render(YAHOO.util.Dom.get('test'));
        
        panel.setHeader('Header -- Works');
        panel.setFooter('Footer -- Works');


        panel2 = new YAHOO.widget.Overlay('testPanel2', { visible: true, width: '200px', x: 400 });
        panel2.setBody('This is a test');
        panel2.setHeader('Header');
        panel2.setFooter('Footer');
        panel2.render(YAHOO.util.Dom.get('test'));
        
        panel2.setHeader('Header -- Works');
        panel2.setFooter('Footer -- Works');

        panel3 = new YAHOO.widget.Panel('testPanel3', { visible: true, width: '200px', y: 200 });
        panel3.setBody('This is a test');
        panel3.render(YAHOO.util.Dom.get('test'));
        
        panel3.setHeader('Header -- Works');
        panel3.setFooter('Footer -- Works');


        panel4 = new YAHOO.widget.Panel('testPanel4', { visible: true, width: '200px', y: 200, x: 400 });
        panel4.setBody('This is a test');
        panel4.setHeader('Header');
        panel4.setFooter('Footer');
        panel4.render(YAHOO.util.Dom.get('test'));
        
        panel4.setHeader('Header -- Works');
        panel4.setFooter('Footer -- Works');
    });
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/container/container-min.js"></script> 
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {

    YAHOO.util.Event.on(window, 'load', function() {
        panel = new YAHOO.widget.Overlay('testPanel', { visible: true, width: '200px' });
        panel.setBody('This is a test');
        panel.render(YAHOO.util.Dom.get('test'));
        
        panel.setHeader('Header -- Works');
        panel.setFooter('Footer -- Works');


        panel2 = new YAHOO.widget.Overlay('testPanel2', { visible: true, width: '200px', x: 400 });
        panel2.setBody('This is a test');
        panel2.setHeader('Header');
        panel2.setFooter('Footer');
        panel2.render(YAHOO.util.Dom.get('test'));
        
        panel2.setHeader('Header -- Works');
        panel2.setFooter('Footer -- Works');

        panel3 = new YAHOO.widget.Panel('testPanel3', { visible: true, width: '200px', y: 200 });
        panel3.setBody('This is a test');
        panel3.render(YAHOO.util.Dom.get('test'));
        
        panel3.setHeader('Header -- Works');
        panel3.setFooter('Footer -- Works');


        panel4 = new YAHOO.widget.Panel('testPanel4', { visible: true, width: '200px', y: 200, x: 400 });
        panel4.setBody('This is a test');
        panel4.setHeader('Header');
        panel4.setFooter('Footer');
        panel4.render(YAHOO.util.Dom.get('test'));
        
        panel4.setHeader('Header -- Works');
        panel4.setFooter('Footer -- Works');
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
