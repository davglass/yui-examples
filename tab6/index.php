<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: TabView Flicker and TabView inside TabView</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            width: 450px;
            margin: 1em;
        }
        #demo2 {
            width: 400px;
            margin: 1em;
        }
        ul.yui-nav {
            zoom: 1;
        }
        ul.yui-nav:after {
           display: block;
           clear: both;
           visibility: hidden;
           content: '.';
           height: 0;
        }
     
        ul.yui-nav li {
            float: left;
            cursor: pointer;
            display: block;
            padding: .25em;
            border: 1px solid black;
            margin: .25em .25em -1px .25em;
            background-color: #fff;
        }

        ul.yui-nav li.selected {
            background-color: #ccc;
            border-bottom: 1px solid #ccc;
        }

        ul.yui-nav li a {
            text-decoration: none;
            color: black;
        }

        div.yui-content {
            border: 1px solid black;
            height: 250px;
            background-color: #ccc;
        }

        #demo2 div.yui-content {
            height: 150px;
        }
        
        div.yui-content div {
            display: none;
        }

        #demo2 div.yui-content, #demo2 {
            display: block;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: TabView Flicker and TabView inside TabView</a></h1></div>
    <div id="bd">
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li class="selected">Tab One Label</li>
                <li>Tab Two Label</li>
                <li>Tab Three Label</li>
            </ul>            
            <div class="yui-content">
                <div><p>Tab One Content</p></div>
                <div><p>Tab Two Content</p></div>
                <div>
                <p>
                <div id="demo2" class="yui-navset">
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
                </p></div>
            </div>
        </div>
        <h2>The CSS</h2>
        <textarea name="code" class="XML">
        div.yui-content div {
            display: none;
        }

        #demo2 div.yui-content, #demo2 {
            display: block;
        }
        </textarea>
        <h2>The HTML</h2>
        <textarea name="code" class="XML">
        <div id="demo" class="yui-navset">
            <ul class="yui-nav">
                <li class="selected">Tab One Label</li>
                <li>Tab Two Label</li>
                <li>Tab Three Label</li>
            </ul>            
            <div class="yui-content">
                <div><p>Tab One Content</p></div>
                <div><p>Tab Two Content</p></div>
                <div>
                <p>
                <div id="demo2" class="yui-navset">
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
                </p></div>
            </div>
        </div>
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/tabview/tabview-min.js"></script> 
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">

(function() {
    var tabView = new YAHOO.widget.TabView('demo');
    var tabView2 = new YAHOO.widget.TabView('demo2');

    dp.SyntaxHighlighter.HighlightAll('code'); 
})()

</script>
</body>
</html>
