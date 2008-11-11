<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Drag Drop Example</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            position: relative;
            border: 1px solid black;
            background-color: #ccc;
            margin: 2em;
        }
        #outer {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            position:relative;
            background-color: #fff;
            margin: 1em;
        }
        #inner {
            width: 200px;
            height: 200px;
            border: 1px solid black;
            position: relative;
            left: 50px;
            top: 50px;
        }
        #drag {
            width:100px;
            height:100px;
            border:1px solid black;
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: move;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Drag Drop Example</a></h1></div>
    <div id="bd">
    <div id="demo">
        <div id="outer">
            #outer
            <div id="inner">#inner</div>
        </div>
        <div id="drag">Drag Me</div>
    </div>
    <h2>The HTML</h2>
    <textarea name="code" class="HTML">
<div id="outer">
    #outer
    <div id="inner">#inner</div>
</div>
<div id="drag">Drag Me</div></textarea>
    <h2>The CSS</h2>
    <textarea name="code" class="HTML">
#demo {
    position: relative;
    border: 1px solid black;
    background-color: #ccc;
    margin: 2em;
}
#outer {
    width: 300px;
    height: 300px;
    border: 1px solid black;
    position:relative;
    background-color: #fff;
    margin: 1em;
}
#inner {
    width: 200px;
    height: 200px;
    border: 1px solid black;
    position: relative;
    left: 50px;
    top: 50px;
}
#drag {
    width:100px;
    height:100px;
    border:1px solid black;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: move;
}</textarea>
    <h2>The Javascript</h2>
    <textarea name="code" class="JScript">
function init() {
    new YAHOO.util.DDTarget('inner', 'test');
    new YAHOO.util.DDTarget('outer', 'test');

    a = new YAHOO.util.DDProxy('drag', 'test');
    a.onDrag = function() {
        this.dropped = false;
        this.dropTarget = null;
    }

    a.onDragOver = function(e, id) {
         var target = YAHOO.util.Dom.get(id);
         if (!this.dropTarget) {
             this.dropTarget = target;
         }
         YAHOO.util.Dom.setStyle(target, 'border', '1px solid red');
    }

    a.onDragOut = function(e, id) {
         var target = YAHOO.util.Dom.get(id);
         YAHOO.util.Dom.setStyle(target, 'border', '1px solid black');
    }
    a.onDragDrop = function(e, id) {
        if(this.dropped) {
            return;
        }
        if (this.dropTarget) {
            this.dropTarget.appendChild(YAHOO.util.Dom.get(this.id));
            this.dropped = true;
        }
    }
    a.endDrag = function(e, id) {
        YAHOO.util.Dom.setStyle(this.element, 'left', '0px');
        YAHOO.util.Dom.setStyle(this.element, 'top', '0px');
    }
}

YAHOO.util.Event.addListener(window, 'load', init);</textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/utilities/utilities.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

function init() {
    new YAHOO.util.DDTarget('inner', 'test');
    new YAHOO.util.DDTarget('outer', 'test');

    a = new YAHOO.util.DDProxy('drag', 'test');
    a.onDrag = function() {
        this.dropped = false;
        this.dropTarget = null;
    }

    a.onDragOver = function(e, id) {
         var target = YAHOO.util.Dom.get(id);
         if (!this.dropTarget) {
             this.dropTarget = target;
         }
         YAHOO.util.Dom.setStyle(target, 'border', '1px solid red');
    }

    a.onDragOut = function(e, id) {
         var target = YAHOO.util.Dom.get(id);
         YAHOO.util.Dom.setStyle(target, 'border', '1px solid black');
    }
    a.onDragDrop = function(e, id) {
        if(this.dropped) {
            return;
        }
        if (this.dropTarget) {
            this.dropTarget.appendChild(YAHOO.util.Dom.get(this.id));
            this.dropped = true;
        }
    }
    a.endDrag = function(e, id) {
        YAHOO.util.Dom.setStyle(this.element, 'left', '0px');
        YAHOO.util.Dom.setStyle(this.element, 'top', '0px');
    }
    dp.SyntaxHighlighter.HighlightAll('code');
}

YAHOO.util.Event.addListener(window, 'load', init);

</script>
</body>
</html>
