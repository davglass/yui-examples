<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: </title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">

<div id="layoutDiv" height="100%" width="100%"></div>
<div id="bottom1"><p>Lorem ipsum </p></div>
<div id="right1"><p>Lorem ipsum </p></div>

<!-- div with the swf file -->
<div id="selector">
    <div style="height:500px">
        <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="320" HEIGHT="240" id="Yourfilename" ALIGN="">
          <PARAM NAME="movie" VALUE="Yourfilename.swf"/>
          <PARAM NAME="quality" VALUE="high"/>
          <PARAM NAME="bgcolor" VALUE="#333399"/>
          <EMBED src="http://mediacast.sun.com/users/kmikami50/media/xmltools.swf" quality="high" bgcolor="#333399" WIDTH="320" HEIGHT="240" NAME="Yourfilename" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
        </OBJECT>
    </div>
</div>


<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/resize/resize-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/layout/layout-beta-min.js"></script> 
<script type="text/javascript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
   
    function initLayout() {
        var layout = new YAHOO.widget.Layout('layoutDiv', {
            height: 1500,
            minWidth: 1000,
            units: [
                { position: 'right', header: 'Right', height: 500, width: 300, resize: true, gutter: '2px 5px', footer: 'Footer', collapse: true, scroll: true, body: 'right1', maxWidth: 400 },
                { position: 'bottom', header: 'Bottom', height: 1000, resize: true, body: 'bottom1', gutter: '5px', collapse: true },
                { position: 'center', height: 500, width: 500, scroll: true, resize: true, body: 'selector', gutter: '2px 5px', collapse: true, collapseSize: 50, maxWidth: 500 }
            ]
        });
        layout.render();
    }

    Event.onDOMReady(initLayout);

})();

</script>
</body>
</html>
