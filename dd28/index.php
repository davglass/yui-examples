<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop Extend Example</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
    #play {
        position: relative;
        height: 150px;
    }
    #drop1, #drop2 {
        height: 100px;
        width: 50%;
        border: 1px solid black;
        background-color: #F2F2F2;
        position: relative;
        float:right;
    }
    #drag1, #drag2 {
        height: 50px;
        width: 50px;
        border: 1px solid black;
        background-color: yellow;
        position: relative;
        cursor: pointer;
    }
    #drag1 {
        top: 50px;
        left: 125px;
    }
    #drag2 {
        top: 150px;
        left: 125px;
    }
        
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop Extend Example</a></h1></div>
    <div id="bd">
        <div id="play">
            <div id="drop1">Category 1</div>
            <div id="drop2">Category 2</div>
            <div id="drag1">Card 1</div>
            <div id="drag2">Card 2</div>
        </div>
    
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

	var card1 = null, card2 = null, cat1 = null, cat2 = null;


    YAHOO.WheelerDD = function() {
        YAHOO.WheelerDD.superclass.constructor.apply(this, arguments);
        this.isTarget = false;
    };

    YAHOO.extend(YAHOO.WheelerDD, YAHOO.util.DD, {
        startDrag: function() {
		    Dom.setStyle(this.getEl(), 'z-index', '999');
        },
        endDrag: function() {
		    Dom.setStyle(this.getEl(), 'z-index', '1');
        },
        onDragEnter: function(e, id) {
		    Dom.setStyle(id, 'borderColor', 'red');
        },
        onDragDrop: function(e, id) {
		    Dom.setStyle(id, 'borderColor', 'black');
        },
        onDragOut: function(e, id) {
		    Dom.setStyle(id, 'borderColor', 'black');
        }
    });

	card1 = new YAHOO.WheelerDD('drag1');
	card2 = new YAHOO.WheelerDD('drag2');
    
    //define the targets
	cat1 = new YAHOO.util.DDTarget('drop1');
	cat2 = new YAHOO.util.DDTarget('drop2');


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
