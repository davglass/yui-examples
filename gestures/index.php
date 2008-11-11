<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Mouse Gestures</title>
    <style type="text/css" media="screen">
		@import url( gestures.css );
	</style>
</head>
<body>
<h2>YUI: Mouse Gestures</h2>
<p>I have built a simple prototype of Mouse Gestures in the YUI. I have attached events to the following Mouse Gestures:</p>
<ul>
    <li>Up</li>
    <li>Down</li>
    <li>Left</li>
    <li>Right</li>
    <li>Up Left</li>
    <li>Up Right</li>
    <li>Down Left</li>
    <li>Down Right</li>
</ul>
<p>Go ahead. Click your left mouse button and drag it around 8-)</p>
<p id="demo">Results here</p>




    
<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript" src="../js/create.js"></script>
<script type="text/javascript" src="gestures.js"></script>
<script type="text/javascript">
    var config = {
        'left': test1,
        'right': test2,
        'up': test3,
        'down': test4,
        'upleft': test5,
        'upright': test6,
        'downleft': test7,
        'downright': test8
    }
    YAHOO.widget.Gestures.init(config);
    demoP = YAHOO.util.Dom.get('demo');
    function test1() {
        demoP.innerHTML = 'Mouse Moved Left';
    }
    function test2() {
        demoP.innerHTML = 'Mouse Moved Right';
    }
    function test3() {
        demoP.innerHTML = 'Mouse Moved Up';
    }
    function test4() {
        demoP.innerHTML = 'Mouse Moved Down';
    }
    function test5() {
        demoP.innerHTML = 'Mouse Moved Up and Left';
    }
    function test6() {
        demoP.innerHTML = 'Mouse Moved Up and Right';
    }
    function test7() {
        demoP.innerHTML = 'Mouse Moved Down and Left';
    }
    function test8() {
        demoP.innerHTML = 'Mouse Moved Down and Right';
    }
</script>
</body>
</html>
