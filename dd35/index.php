<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Live Preview</title>

    <!-- JS Dependencies -->
    <script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/dragdrop/dragdrop-min.js"></script>
    <style>
    #context{position: absolute;left: 0;width:99.5%;height:100%;z-index:0;overflow: auto;}
    #creative {position: absolute;left: 40%;top: 40%;z-index: 100; zoom: 1; width: 256px; height: 370px;}
    #adTranslucent {background-color: black;position: absolute;height: 100%;width: 100%;z-index: -50;opacity: .4;filter:alpha(opacity=40);-moz-opacity:0.4;visibility: hidden;}
    #adInstructions {width: 250px;color: #fff;background-color: black;padding: 3px;text-align: center;visibility: hidden;}
    #adContainer {margin: 10px 10px 15px 10px;border: 1px solid #666;}
    .clearBoth {clear: both;}
    #title {background-color: #FFF9DD;border: 1px solid #aaa;padding: 4px 10px;}
    #title .caption {float: right;font-weight: bold;font-size: 11pt;}
    </style>
</head>

<body>
    <div id="title">
        <div class="caption">
            To move your Ad, hover over the image and drag the border area.
        </div>
        <b>Live Preview</b>
        <div id="creativeName"></div>
    </div>
    <iframe id="context" style="height:1000px;"></iframe>
    <div id="creative">
        <div id="adTranslucent" style="background-color:#cc2;"></div>
        <div id="adInstructions">To move, drag border area.</div>
        <div id="adContainer"></div>
    </div>
    <div id="mask"></div>
</body>
<script language="javascript">
var strO = '<img style="border:none" src="http://us.js2.yimg.com/us.yimg.com/i/us/sch/gr3/ngsprt_20080225.png"/>';
</script>
<script type="text/javascript">
var Dom = YAHOO.util.Dom;
var Event = YAHOO.util.Event;

function showDrag(e) {
    Dom.setStyle( "adInstructions", "visibility", "visible" );
    Dom.setStyle( "adTranslucent", "visibility", "visible" );
}

function hideDrag(e) {
    Dom.setStyle( "adInstructions", "visibility", "hidden" );
    Dom.setStyle( "adTranslucent", "visibility", "hidden" );
}
// variable to hold the draggable ad object
var dd;

(function() {
    YAHOO.util.Event.onDOMReady(function() {
        Dom.get( 'context' ).src = "http://search.yahoo.com";

        document.getElementById('creativeName').innerHTML = "Some title"
        document.getElementById('adContainer').innerHTML = strO;


        Event.addListener("creative", "mouseover", showDrag);
        Event.addListener("creative", "mouseout", hideDrag);

        Event.addListener("adContainer", "mouseover", hideDrag);
        Event.addListener("adContainer", "mouseout", showDrag);

        dd = new YAHOO.util.DD("creative");

    });
})();


</script>

</html>
