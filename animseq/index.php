<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Animation Sequence</title>
    <style type="text/css" media="screen">
        body {
            font-family: verdana;
        }
        #test1 {
            height: 150px;
            width: 150px;
            margin: 15px;
            position: absolute;
        }
        .testclass1 {
            border: 2px solid black;
            background-color: #ccc;
            font-size: 11px;
        }
        .testclass2 {
            border: 2px solid blue;
            background-color: yellow;
            font-size: 40px;
        }
	</style>
</head>
<body>
<h1>YUI: Animation Sequences</h1>
<p>One thing I have noticed about the YUI Animation libs, is that if you assign 2 movements to the same item &amp; animate them, the resulting animation is not what is expected.</p>
<p>The object of these examples is to show how to make animation sequences, e.g. how to animate an object in two different ways one after another. This is how I want the animation to occur: 
As it moves, I want the DIV get smaller, then at some point change the DIV's class and have the DIV start getting bigger. Also, It needed to do this as it was moving across the screen. 
    Here I have 2 examples, one is the code I expected to work (example 1), the other is how to make work (example 2).<br><br>
    <a href="" id="demo1">Example 1</a> - <a href="" id="demo2">Example 2</a> - <a href="./" id="resetExamples">Reset</a>
</p>
<div id="test1" class="testclass1">Test Item 1</div>

<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/calendar-min.js"></script>
<script type="text/javascript">

function example1(ev) {
    var attributes = {
        width: { to: 50 },
        height: { to: 50 },
        top: { to: 300 },
        left: { to: 300 },
        opacity: { to: .25 },
        fontSize: { from: 100, to: 10, unit: '%' }
    };

    var myAnim = new YAHOO.util.Anim('test1', attributes);
    myAnim.onComplete.subscribe(move);
    myAnim.animate();
    YAHOO.util.Dom.replaceClass('test1', 'testclass1', 'testclass2');
    var attributes2 = {
        width: { to: 250 },
        height: { to: 250 },
        top: { to: 350 },
        left: { to: 575 },
        opacity: { to: 1 },
        fontSize: { from: 10, to: 100, unit: '%' }
    };

    var myAnim2 = new YAHOO.util.Anim('test1', attributes2);
    myAnim2.animate();

    YAHOO.util.Event.stopEvent(ev);
}
function example2(ev) {
    var attributes = {
        width: { to: 50 },
        height: { to: 50 },
        top: { to: 300 },
        left: { to: 200 },
        opacity: { to: .25 },
        fontSize: { from: 100, to: 10, unit: '%' }
    };

    var myAnim = new YAHOO.util.Anim('test1', attributes);
    myAnim.onComplete.subscribe(move);
    myAnim.animate();

    YAHOO.util.Event.stopEvent(ev);
}
function move() {
    YAHOO.util.Dom.replaceClass('test1', 'testclass1', 'testclass2');
    var attributes2 = {
        width: { to: 250 },
        height: { to: 250 },
        top: { to: 150 },
        left: { to: 500 },
        opacity: { to: 1 },
        fontSize: { from: 10, to: 100, unit: '%' }
    };

    var myAnim2 = new YAHOO.util.Anim('test1', attributes2);
    myAnim2.animate();
}

YAHOO.util.Event.addListener('demo1', 'click', example1);
YAHOO.util.Event.addListener('demo2', 'click', example2);
</script>
</body>
</html>
