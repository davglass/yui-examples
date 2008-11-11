<html>
<head>
    <title>YUI: Drag Drop Issue</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #test {
            margin: 2em;
            padding: 1em;
            background-color: #ccc;
        }
        #dd-demo-1 {
            border: 1px solid black;
            padding: 1em;
            background-color: white;
            margin: 1em;
            width: 300px;
            cursor: move;
        }
        #dd-demo-1 input {
            cursor: text;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Drag Drop Form Handling</a></h1></div>
    <div id="bd">
        <p>This example shows the solution to <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/20057">this issue</a>.</p>
        <div id="test"></div>
        <h2>The Code</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;


dv = document.createElement("div");
dv.setAttribute("id", "dd-demo-1");
dv.setAttribute("style", "position:relative;");

tb = document.createElement("input");
tb.setAttribute("id", "tb-1");
tb.setAttribute("type", "text");
tb.setAttribute("value", "something here");
dv.appendChild(tb);
YAHOO.util.Dom.get('test').appendChild(dv);

var dd = new YAHOO.util.DD("dd-demo-1");
//This is the important part
dd.addInvalidHandleId('tb-1');


    dp.SyntaxHighlighter.HighlightAll('code');
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;


dv = document.createElement("div");
dv.setAttribute("id", "dd-demo-1");
dv.setAttribute("style", "position:relative;");

tb = document.createElement("input");
tb.setAttribute("id", "tb-1");
tb.setAttribute("type", "text");
tb.setAttribute("value", "something here");
dv.appendChild(tb);
YAHOO.util.Dom.get('test').appendChild(dv);

var dd = new YAHOO.util.DD("dd-demo-1");
//This is the important part
dd.addInvalidHandleId('tb-1');


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
