<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Listeners</title>
    <style type="text/css" media="screen">
        body {
            font-family: verdana;
        }
        #container {
            height: 250px;
            width: 450px;
            background-color: green;
            border: 1px solid black;
        }
        #container2 {
            margin: 2em;
            background-color: #ccc;
            border: 1px solid black;
        }
        #container2 table {
            border: 1px solid red;
            margin: 1em;
        }
	</style>
</head>
<body>
<h1>YUI: Listeners</h1>
<p><a href="http://groups.yahoo.com/group/ydn-javascript/message/4411">In response to this YDN Post</a>. EventListener propigation is a tricky subject. This example simply shows 2 ways how to stop an event.</p>
<pre>
    function fnCallback(ev) {
        var tar = YAHOO.util.Event.getTarget(ev);
        //You can do it this way
        if (tar && tar.id && tar.id == 'container2') {
            YAHOO.util.Dom.get('logs').innerHTML += 'MouseOver: (' + tar.id + ')&lt;br&gt;';
        }
    }

    YAHOO.util.Event. addListener('container2', 'mouseover', fnCallback);
    //Or this way
    //YAHOO.util.Event. addListener('table', 'mouseover', function(ev) { YAHOO.util.Event.stopEvent(ev); });

</pre>
<div id="container">
    Container
    <div id="container2">
        Container2
        <table id="table">
        <tr>
            <td id="td_one">one</td>
            <td id="td_two">two</td>
            <td id="td_three">three</td>
        </tr>
        </table>
    </div>
    </div>
<div id="logs">
</div>

<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/calendar-min.js"></script>
<script type="text/javascript">
    function fnCallback(ev) {
        var tar = YAHOO.util.Event.getTarget(ev);
        //You can do it this way
        if (tar && tar.id && tar.id == 'container2') {
            YAHOO.util.Dom.get('logs').innerHTML += 'MouseOver: (' + tar.id + ')<br>';
        }
    }

    YAHOO.util.Event. addListener('container2', 'mouseover', fnCallback);
    //Or this way
    //YAHOO.util.Event. addListener('table', 'mouseover', function(ev) { YAHOO.util.Event.stopEvent(ev); });
</script>
</body>
</html>
