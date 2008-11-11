<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop iFrame</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #dragMe {
            border: 1px solid black;
            width: 75px;
            height: 75px;
            background-color: #ccc;
            cursor: move;
            position: absolute;
            left: 400px;
            top: 200px;
        }

        #bd {
            position: relative;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop iFrame</a></h1></div>
    <div id="bd">
        <h2>Proxy Element Issue (in Internet Explorer)</h2>
        <p>If the proxy element has no background-color, then it is considered to the "transparent" by Internet Explorer. Since it is "transparent" then the events pass through it to the iframe below. So creating a "fake" div inside the proxy element and giving it a background-color, then setting it to an opacity of 0, it appears to not be there, however IE still thinks that it is so the events never pass through.</p>
        <iframe src="blank.htm" height="200" width="200" id="myFrame" style="border: 1px solid black; margin: 2em;"></iframe>
        <div id="dragMe">Drag Me!<br>Over the iFrame</div>
        <textarea class="JScript" name="code">
var _dd = null;
function init() {
    _dd = new YAHOO.util.DDProxy('dragMe');
}

YAHOO.util.Event.on(window, 'load', init);

YAHOO.util.DDProxy.prototype.createFrame = function() {
    var self = this;
    var body = document.body;

    if (!body || !body.firstChild) {
        setTimeout( function() { self.createFrame(); }, 50 );
        return;
    }

    var div = this.getDragEl();

    if (!div) {
        div    = document.createElement("div");
        div.id = this.dragElId;
        var s  = div.style;

        s.position   = "absolute";
        s.visibility = "hidden";
        s.cursor     = "move";
        s.border     = "2px solid #aaa";
        s.zIndex     = 999;
        s.height     = '25px';
        s.width      = '25px';

        var _data = document.createElement('div');
        YAHOO.util.Dom.setStyle(_data, 'height', '100%');
        YAHOO.util.Dom.setStyle(_data, 'width', '100%');
        /**
        * If the proxy element has no background-color, then it is considered to the "transparent" by Internet Explorer.
        * Since it is "transparent" then the events pass through it to the iframe below.
        * So creating a "fake" div inside the proxy element and giving it a background-color, then setting it to an
        * opacity of 0, it appears to not be there, however IE still thinks that it is so the events never pass through.
        */
        YAHOO.util.Dom.setStyle(_data, 'background-color', '#ccc');
        YAHOO.util.Dom.setStyle(_data, 'opacity', '0');
        div.appendChild(_data);
        

        // appendChild can blow up IE if invoked prior to the window load event
        // while rendering a table.  It is possible there are other scenarios 
        // that would cause this to happen as well.
        body.insertBefore(div, body.firstChild);
    }
}
</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
var _dd = null;
function init() {
    _dd = new YAHOO.util.DDProxy('dragMe');
    dp.SyntaxHighlighter.HighlightAll('code'); 

}

YAHOO.util.Event.on(window, 'load', init);


YAHOO.util.DDProxy.prototype.createFrame = function() {
    var self = this;
    var body = document.body;

    if (!body || !body.firstChild) {
        setTimeout( function() { self.createFrame(); }, 50 );
        return;
    }

    var div = this.getDragEl();

    if (!div) {
        div    = document.createElement("div");
        div.id = this.dragElId;
        var s  = div.style;

        s.position   = "absolute";
        s.visibility = "hidden";
        s.cursor     = "move";
        s.border     = "2px solid #aaa";
        s.zIndex     = 999;
        s.height     = '25px';
        s.width      = '25px';

        var _data = document.createElement('div');
        YAHOO.util.Dom.setStyle(_data, 'height', '100%');
        YAHOO.util.Dom.setStyle(_data, 'width', '100%');
        /**
        * If the proxy element has no background-color, then it is considered to the "transparent" by Internet Explorer.
        * Since it is "transparent" then the events pass through it to the iframe below.
        * So creating a "fake" div inside the proxy element and giving it a background-color, then setting it to an
        * opacity of 0, it appears to not be there, however IE still thinks that it is so the events never pass through.
        */
        YAHOO.util.Dom.setStyle(_data, 'background-color', '#ccc');
        YAHOO.util.Dom.setStyle(_data, 'opacity', '0');
        div.appendChild(_data);
        

        // appendChild can blow up IE if invoked prior to the window load event
        // while rendering a table.  It is possible there are other scenarios 
        // that would cause this to happen as well.
        body.insertBefore(div, body.firstChild);
    }
}


</script>
</body>
</html>
