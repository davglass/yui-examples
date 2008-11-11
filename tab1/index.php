<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: TabView with DragDrop Tabs</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../css/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
    p, h2 {
        margin: 1em;
    }
    #demo {
        width: 450px;
        margin: 1em;
    }
    #demo ul.yui-nav {
        zoom: 1;
    }
    #demo ul.yui-nav:after {
       display: block;
       clear: both;
       visibility: hidden;
       content: '.';
       height: 0;
    }
 
    #demo ul.yui-nav li {
        float: left;
        cursor: pointer;
        display: block;
        padding: .25em;
        border-top: 1px solid black;
        border-right: 1px solid black;
        border-left: 1px solid black;
        margin: .25em .25em -1px .25em;
    }

    #demo ul.yui-nav li.selected {
        background-color: #ccc;
    }

    #demo ul.yui-nav li a {
        text-decoration: none;
        color: black;
    }

    #demo div.yui-content {
        border: 1px solid black;
        height: 250px;
        background-color: #ccc;
    }
    
    #demo div.yui-content div {
        display: none;
    }

	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: TabView with DragDrop Tabs</a></h1></div>
    <div id="bd">
        <h2>Native TabView with SortableList attached</h2>
        <p>This is an example of the YUI TabView widget with my SortableList widget attached.</p>
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li class="selected">Tab One Label</li>
                <li>Tab Two Label</li>
                <li>Tab Three Label</li>
            </ul>            
            <div class="yui-content">
                <div><p>Tab One Content</p></div>
                <div><p>Tab Two Content</p></div>
                <div><p>Tab Three Content</p></div>
            </div>
        </div>
        <h2>The HTML Code for the TabView</h2>
        <textarea name="code" class="HTML">
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li class="selected">Tab One Label</li>
                <li>Tab Two Label</li>
                <li>Tab Three Label</li>
            </ul>            
            <div class="yui-content">
                <div><p>Tab One Content</p></div>
                <div><p>Tab Two Content</p></div>
                <div><p>Tab Three Content</p></div>
            </div>
        </div>
        </textarea>
        <h2>The Javascript Code for the TabView and the SortableList</h2>
        <textarea name="code" class="JScript">
var myTabs = null;
var myList = null;

function init() {
    myTabs = myTabs = new YAHOO.widget.TabView('demo');
    nav = $D.getElementsByClassName('yui-nav', 'ul', $('demo'))[0];
    myList = new YAHOO.widget.SortableList(nav);
    myList.init();
}

$E.addListener(window, 'load', init);       
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>


<script type="text/javascript" src="../js/yui-012.js"></script>
<script type="text/javascript" src="../js/tabview-min.js"></script>
<script type="text/javascript" src="../tools/tools-min.js"></script>
<script type="text/javascript" src="../js/effects-min.js"></script>
<script src="../js/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="../sortable/sortable.js"></script>
<script type="text/javascript">
var myTabs = null;
var myList = null;

function init() {
    myTabs = myTabs = new YAHOO.widget.TabView('demo');
    nav = $D.getElementsByClassName('yui-nav', 'ul', $('demo'))[0];
    myList = new YAHOO.widget.SortableList(nav);
    myList.init();

    dp.SyntaxHighlighter.HighlightAll('code'); 
}

$E.addListener(window, 'load', init);

</script>
</body>
</html>
