<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop Proxy - Select Element</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop Proxy - Select Element</a></h1></div>
    <div id="bd">
        <p>This code fixes the issue with dragging a DDProxy over a select element.</p>
        <select></select>
        <div id='dd' style='width:100px; height:100px; background:black;'></div>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    YAHOO.util.DDProxy.prototype._createFrame = YAHOO.util.DDProxy.prototype.createFrame;
    YAHOO.util.DDProxy.prototype.createFrame = function() {
        this._createFrame.apply(this, arguments);
        var div = this.getDragEl();
        if (YAHOO.env.ua.ie) {
            //Only needed for Internet Explorer
            var ifr = document.createElement('iframe');
            ifr.setAttribute('src', 'javascript:false;');
            ifr.setAttribute('scrolling', 'no');
            ifr.setAttribute('frameborder', '0');
            div.insertBefore(ifr, div.firstChild);
            YAHOO.util.Dom.setStyle(ifr, 'height', '100%');
            YAHOO.util.Dom.setStyle(ifr, 'width', '100%');
            YAHOO.util.Dom.setStyle(ifr, 'position', 'absolute');
            YAHOO.util.Dom.setStyle(ifr, 'top', '0');
            YAHOO.util.Dom.setStyle(ifr, 'left', '0');
            YAHOO.util.Dom.setStyle(ifr, 'opacity', '0');
            YAHOO.util.Dom.setStyle(ifr, 'zIndex', '-1');
            YAHOO.util.Dom.setStyle(ifr.nextSibling, 'zIndex', '2');
        }
    };


    (new YAHOO.util.DDProxy('dd')).endDrag = function() {
        alert(YAHOO.lang.dump(arguments));
    };

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

    YAHOO.util.DDProxy.prototype._createFrame = YAHOO.util.DDProxy.prototype.createFrame;
    YAHOO.util.DDProxy.prototype.createFrame = function() {
        this._createFrame.apply(this, arguments);
        var div = this.getDragEl();
        if (YAHOO.env.ua.ie) {
            //Only needed for Internet Explorer
            var ifr = document.createElement('iframe');
            ifr.setAttribute('src', 'javascript:false;');
            ifr.setAttribute('scrolling', 'no');
            ifr.setAttribute('frameborder', '0');
            div.insertBefore(ifr, div.firstChild);
            YAHOO.util.Dom.setStyle(ifr, 'height', '100%');
            YAHOO.util.Dom.setStyle(ifr, 'width', '100%');
            YAHOO.util.Dom.setStyle(ifr, 'position', 'absolute');
            YAHOO.util.Dom.setStyle(ifr, 'top', '0');
            YAHOO.util.Dom.setStyle(ifr, 'left', '0');
            YAHOO.util.Dom.setStyle(ifr, 'opacity', '0');
            YAHOO.util.Dom.setStyle(ifr, 'zIndex', '-1');
            YAHOO.util.Dom.setStyle(ifr.nextSibling, 'zIndex', '2');
        }
    };


    (new YAHOO.util.DDProxy('dd')).endDrag = function() {
        alert(YAHOO.lang.dump(arguments));
    };


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
