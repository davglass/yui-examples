<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Animation Again</title>
    <style type="text/css" media="screen">
        body {
            font-family: verdana;
        }
        #test1 {
            height: 150px;
            width: 150px;
            margin: 15px;
            position: absolute;
            top: 150px;
            left: 150px;
            border: 1px solid black;
            background-color: #ccc;
        }
	</style>
</head>
<body>
<h1>YUI: Animation Sequences Again</h1>
<p>This is an example of swapping listeners and chaining Animation Sequences. Click on the box below, then when the animation is finished, click it again.<em>Updated code per <a href="http://groups.yahoo.com/group/ydn-javascript/message/4405">Matt Sweeney's suggestion</a></em></p>
<div id="test1" class="testclass1">Test Item 1</div>

<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/calendar-min.js"></script>
<script type="text/javascript">
var attributes = {
    width: { to: 300 },
    height: { to: 300 },
    top: { to: 300 },
    left: { to: 300 },
};

var attributes2 = {
    width: { to: 150 },
    height: { to: 150 },
    top: { to: 150 },
    left: { to: 150 },
};

var isExpanded = false;
var myAnim = new YAHOO.util.Anim('test1', attributes);

myAnim.onComplete. subscribe(
   function() {
      isExpanded = !isExpanded;
      this.attributes = (isExpanded) ? attributes2 : attributes;
   }
);

YAHOO.util.Event.addListener('test1', 'click', myAnim.animate, myAnim, true);
</script>
</body>
</html>
