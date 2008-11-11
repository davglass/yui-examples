<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Sticky Dialog</title>
    <link rel="stylesheet" href="http://us.js2.yimg.com/us.js.yimg.com/lib/common/css/reset-fonts-grids_2.1.2.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" href="http://us.js2.yimg.com/us.js.yimg.com/lib/common/widgets/2/container/css/container_2.1.2.css" type="text/css">
    <style type="text/css" media="screen">

        p {
            padding: .25em;
        }
        #testPanel {
            position: absolute;
            visibility: hidden;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Sticky Dialog</a></h1></div>
    <div id="bd">
        <textarea name="code" class="JScript">
var myPanel = null;
function init() {
    var thisX = (parseInt(YAHOO.util.Dom.getClientWidth()) - 252);
    myPanel = new YAHOO.widget.Dialog('testPanel', {
        visible: false,
        close: true,
        height: '150px',
        width: '250px',
        x: thisX,
        y: 200
    });
    myPanel.render(document.body);
    myPanel.show();
}

function fixResize() {
    var thisX = (parseInt(YAHOO.util.Dom.getClientWidth()) - 252);
    myPanel.cfg.setProperty('x', thisX);
}

YAHOO.util.Event.addListener(window, 'load', init);
YAHOO.util.Event.addListener(window, 'resize', fixResize);
        </textarea>
        <div id="testPanel">
            <div class="hd">My Test Dialog</div>
            <div class="bd">
                <p>This is some content.</p>
                <p>This is some content.</p>
                <p>This is some content.</p>
                <p>This is some content.</p>
            </div>
        </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
    
<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/utilities_2.1.2.js"></script>
<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/widgets/2/container/container_2.1.2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
var myPanel = null;
function init() {
    var thisX = (parseInt(YAHOO.util.Dom.getClientWidth()) - 252);
    myPanel = new YAHOO.widget.Dialog('testPanel', {
        visible: false,
        close: true,
        height: '150px',
        width: '250px',
        x: thisX,
        y: 200
    });
    myPanel.render(document.body);
    myPanel.show();
    dp.SyntaxHighlighter.HighlightAll('code'); 
}

function fixResize() {
    var thisX = (parseInt(YAHOO.util.Dom.getClientWidth()) - 252);
    myPanel.cfg.setProperty('x', thisX);
}

YAHOO.util.Event.addListener(window, 'load', init);
YAHOO.util.Event.addListener(window, 'resize', fixResize);
</script>
</body>
</html>

