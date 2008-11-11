<?php
    $station = (($_GET['station']) ? $_GET['station'] : 'USCA1116');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Get and Pipes - Example 1</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #weather {
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: 0px 0px;
            width: 500px;
            height: 75px;
            color: #2647A0;
            border: 1px solid #808080;
            position: relative;
        }

        #weather h3 {
            margin-left: 55px;
        }

        #weather span {
            display: block;
            width: 125px;
            height: 40px;
            margin-top: .35em;
        }
        #weather span.current {
            float: left;
            margin-left: 55px;
        }
        #weather span.next,
        #weather span.after {
            display: inline;
            width: auto;
            height: auto;
            float: left;
        }
        
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Get and Pipes - Example 1</a></h1></div>
    <div id="bd">
        <p>The <a href="http://pipes.yahoo.com/pipes/pipe.info?_id=cnZFI_rR3BGvnn8h8ivLAg">Pipe</a> I created, pulls in this URL: <code>http://xml.weather.yahoo.com/forecastrss?p=USCA1116&u=f</code> and
        parses the RSS feed into some useable JSON data. Then returns an object from the <code>description</code> data that we will use to build the weather module below.</p>
        <p><strong>Note:</strong> This pipe doesn't return anything from the browser, it returns data when you get it as JSON.</p>
        <div id="weather">
            <h3></h3>
            <span class="current"></span>
            <span class="next"></span>
            <span class="after"></span>
        </div>
        <p class="tag"></p>
        <p>Try these other feeds too..</p>
        <ul>
            <li><a href="?station=USCA0027">Anaheim, CA</a></li>
            <li><a href="?station=USNY0996">New York, NY</a></li>
            <li><a href="?station=USFL0316">Miami, FL</a></li>
            <li><a href="?station=USNV0049">Las Vegas, NV</a></li>
        </ul>

        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Sel = YAHOO.util.Selector,
        Get = YAHOO.util.Get;

    YAHOO.namespace('GetExample');

    //The callback from the Get request
    YAHOO.GetExample.getWeather = function(r) {
        //The data array is in here..
        var data = r.value.items[1].content;
        //Get the URL from the HTML <img tag
        var img = data[0].content.substring(10);
        img = img.substring(0, (img.length - 3));
        //Use Selector to get our em and innerHTML the current conditions
        Sel.query('#weather span.current', '', true)[0].innerHTML = data[2].content;
        //Update the title with the title returned from the feed
        Sel.query('#weather h3', '', true)[0].innerHTML = r.value.items[0].content;
        //Update the next with tomorrow's forecast
        Sel.query('#weather span.next', '', true)[0].innerHTML = data[5].content;
        //Update the after with the day afters forecast
        Sel.query('#weather span.after', '', true)[0].innerHTML = data[6].content;
        //Update the tagline to link back to Yahoo! Weather.
        Sel.query('p.tag', '', true)[0].innerHTML = data[8].content;
        //Set the background image on the div to the image we got back..
        Dom.setStyle('weather', 'background-image', 'url( ' + img + ' )');
    };

    Event.onDOMReady(function() {
        //Use Get to fetch the Pipe data, requesting a JSON view and a callback of YAHOO.GetExample.getWeather
        Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=cnZFI_rR3BGvnn8h8ivLAg&_render=json&_callback=YAHOO.GetExample.getWeather&station=<?php echo($station); ?>');
    });
})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/selector/selector-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/get/get-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Sel = YAHOO.util.Selector,
        Get = YAHOO.util.Get;

    YAHOO.namespace('GetExample');

    //The callback from the Get request
    YAHOO.GetExample.getWeather = function(r) {
        //The data array is in here..
        var data = r.value.items[1].content;
        //Get the URL from the HTML <img tag
        var img = data[0].content.substring(10);
        img = img.substring(0, (img.length - 3));
        //Use Selector to get our em and innerHTML the current conditions
        Sel.query('#weather span.current', '', true)[0].innerHTML = data[2].content;
        //Update the title with the title returned from the feed
        Sel.query('#weather h3', '', true)[0].innerHTML = r.value.items[0].content;
        //Update the next with tomorrow's forecast
        Sel.query('#weather span.next', '', true)[0].innerHTML = data[5].content;
        //Update the after with the day afters forecast
        Sel.query('#weather span.after', '', true)[0].innerHTML = data[6].content;
        //Update the tagline to link back to Yahoo! Weather.
        Sel.query('p.tag', '', true)[0].innerHTML = data[8].content;
        //Set the background image on the div to the image we got back..
        Dom.setStyle('weather', 'background-image', 'url( ' + img + ' )');
    };

    Event.onDOMReady(function() {
        //Use Get to fetch the Pipe data, requesting a JSON view and a callback of YAHOO.GetExample.getWeather
        Get.script('http:/'+'/pipes.yahoo.com/pipes/pipe.run?_id=cnZFI_rR3BGvnn8h8ivLAg&_render=json&_callback=YAHOO.GetExample.getWeather&station=<?php echo($station); ?>');
    });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
