<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop: Portal</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #play {
            height: 500px;
            width: 500px;
            border: 1px solid black;
        }
        .mod {
            height: 100px;
            width: 100px;
            border: 1px solid black;
            background-color: #ccc;
            float: left;
            margin: 5px;
            cursor: move;
        }
        #vis {
            border: 1px solid green;
            float: left;
            margin: 5px;
            display: none;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop: Portal</a></h1></div>
    <div id="bd">
        <div id="play">
            <div class="mod">Module #1</div>
            <div class="mod">Module #2</div>
            <div class="mod">Module #3</div>
            <div class="mod">Module #4</div>
            <div class="mod">Module #5</div>
            <div class="mod">Module #6</div>
            <div class="mod">Module #7</div>
            <div class="mod">Module #8</div>
            <div class="mod">Module #9</div>
            <div class="mod">Module #10</div>
            <div class="mod">Module #11</div>
            <div class="mod">Module #12</div>
            <div class="mod">Module #13</div>
        </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        el = null;

    
    Event.onDOMReady(function() {
        el = document.createElement('div');
        el.id = 'vis';
        document.body.appendChild(el);

        var alignEl = function() {
            Dom.setStyle(el, 'height', this.getEl().clientHeight + 'px');
            Dom.setStyle(el, 'width', this.getEl().clientWidth + 'px');
            this.getEl().parentNode.insertBefore(el, this.getEl().nextSibling);
            Dom.setStyle(this.getEl(), 'display', 'none');
            Dom.setStyle(el, 'display', 'block');
        };

        var _handleOver = function(args) {
            var over = Dom.get(args.info);
            over.parentNode.insertBefore(el, over);
        };

        var _handleDrop = function(args) {
            var drop = Dom.get(args.info);
            var dragEl = this.getEl();
            Dom.setStyle(el, 'display', 'none');
            dragEl.parentNode.insertBefore(dragEl, drop);
        };

        var _handleEnd = function(args) {
            var dragEl = this.getEl();
            Dom.setStyle(dragEl, 'display', 'block');
            Dom.setStyle(dragEl, 'top', '');
            Dom.setStyle(dragEl, 'left', '');
        };
        var _handleInvalid = function(args) {
            Dom.setStyle(el, 'display', 'none');
            var dragEl = this.getEl();
            Dom.setStyle(dragEl, 'display', 'block');
            Dom.setStyle(dragEl, 'top', '');
            Dom.setStyle(dragEl, 'left', '');
        };

        var mods = Dom.getElementsByClassName('mod', 'div');
        for (var i = 0; i <= mods.length; i++) {
            var dd = new YAHOO.util.DDProxy(mods[i]);
            dd.on('b4StartDragEvent', alignEl);
            dd.on('dragOverEvent', _handleOver);
            dd.on('dragDropEvent', _handleDrop);
            dd.on('mouseUpEvent', _handleEnd);
            dd.on('invalidDropEvent', _handleInvalid);
        }
    });


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
