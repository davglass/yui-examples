<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Event Bubbling</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            list-style-type: disc;
            border: 1px solid black;
            width: 300px;
            padding: 1em;
            margin: 2em;
        }
        #demo li {
            margin-left: 20px;
            border: 1px solid green;
            width: 75%;
        }
        #status {
            border: 1px solid red;
            color: red;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Event Bubbling</a></h1></div>
    <div id="bd">
        <p>This is a good example of the usefulness of Event Bubbling.</p>
        <div id="status">Click one of the li's</div>
        <ul id="demo">
            <li class="test1">Text #1</li>
            <li class="test2">Text #2</li>
            <li class="test3">Text #3</li>
            <li class="test4">Text #4</li>
        </ul>
        <a href="#" id="addLI">[Add another list item]</a>
        <h2>The HTML</h2>
        <textarea class="HTML" name="code">
<div id="status">Click one of the li's</div>
<ul id="demo">
    <li class="test1">Text #1</li>
    <li class="test2">Text #2</li>
    <li class="test3">Text #3</li>
    <li class="test4">Text #4</li>
</ul>
<a href="#" id="addLI">[Add another list item]</a>
        </textarea>
        <h2>The Javascript</h2>
        <textarea class="JScript" name="code">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        Event.on(window, 'load', function() {
            var liCount = Dom.get('demo').getElementsByTagName('li').length;
            Event.on('demo', 'click', function(ev) {
                var tar = Event.getTarget(ev);
                if (tar.tagName.toLowerCase() == 'li') {
                    Dom.get('status').innerHTML = 'You clicked on LI (' + tar.className + '): ' + tar.innerHTML;
                } else {
                    Dom.get('status').innerHTML = 'Click one of the li\'s';
                }
            });
            Event.on('addLI', 'click', function(ev) {
                liCount++;
                var li = document.createElement('LI');
                li.className = 'test' + liCount;
                li.innerHTML = 'Text #' + liCount;
                Dom.get('demo').appendChild(li);
                Dom.get('status').innerHTML = 'New LI Added, now click it..';
                Event.stopEvent(ev);
            });
        });
})()
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        Event.on(window, 'load', function() {
            var liCount = Dom.get('demo').getElementsByTagName('li').length;
            Event.on('demo', 'click', function(ev) {
                var tar = Event.getTarget(ev);
                if (tar.tagName.toLowerCase() == 'li') {
                    Dom.get('status').innerHTML = 'You clicked on LI (' + tar.className + '): ' + tar.innerHTML;
                } else {
                    Dom.get('status').innerHTML = 'Click one of the li\'s';
                }
            });
            Event.on('addLI', 'click', function(ev) {
                liCount++;
                var li = document.createElement('LI');
                li.className = 'test' + liCount;
                li.innerHTML = 'Text #' + liCount;
                Dom.get('demo').appendChild(li);
                Dom.get('status').innerHTML = 'New LI Added, now click it..';
                Event.stopEvent(ev);
            });
        });

    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
