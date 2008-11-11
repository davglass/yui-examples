<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Flex in Layout Manager Problem</title>
<style type="text/css">
body {
	margin:0;
	padding:0;
}
</style>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css" />


<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/layout.css"/>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/resize.css"/>
<!-- Utility Dependencies -->
<script src="http://yui.yahooapis.com/2.5.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script src="http://yui.yahooapis.com/2.5.0/build/dragdrop/dragdrop-min.js"></script>
<script src="http://yui.yahooapis.com/2.5.0/build/element/element-beta-min.js"></script>
<!-- Optional Animation -->
<script src="http://yui.yahooapis.com/2.5.0/build/animation/animation-min.js"></script>
<!-- Source file for the Resize Utility -->
<script src="http://yui.yahooapis.com/2.5.0/build/resize/resize-beta-min.js"></script>
<!-- Source file for the Layout Manager -->
<script src="http://yui.yahooapis.com/2.5.0/build/layout/layout-beta-min.js"></script> 
<script src="AC_OETags.js" language="javascript"></script>
</head>

<script>
function callFlex()
{
    // This will not work if layout was created and the Flex widget is hosted inside it.
    document.getElementById("flexWidget").Flex_TestExternalInterface("one","two");
}

function initLayout()
{
        layout = new YAHOO.widget.Layout('layoutDiv',
        {
            height: 500,//800,
            //minWidth: 1000,
            units: [
                // Switching these two lines shows the problem.  If the div with flex is shown inside the layout then it cannot be called (callFlex() fails)
                // if it is shown outside of layout then it works properly.
                { position: 'center', header: "I do not work", height: 490, scroll: false, resize: true, body: 'centerDivWithFlex', gutter: '2px 5px', collapse: true, collapseSize: 50, maxWidth: 1000 }
                //{ position: 'center', header: "I do work", height: 490, scroll: false, resize: true, body: 'centerDivWithoutFlex', gutter: '2px 5px', collapse: true, collapseSize: 50, maxWidth: 1000 }
            ]
        });
        //layout.on('render', initFlex);

        layout.render();

}

YAHOO.util.Event.onDOMReady(initLayout); 

</script>
<body class=" yui-skin-sam">
<div id="layoutDiv" height="100%" width="99%"></div>
<div id="centerDivWithoutFlex" height="100%" width="99%">I am center</div>

<div id="centerDivWithFlex" style="height:500px;width:100%">


<script language="JavaScript" type="text/javascript">


var initFlex = function() {
<!--
// -----------------------------------------------------------------------------
// Globals
// Major version of Flash required
var requiredMajorVersion = 9;
// Minor version of Flash required
var requiredMinorVersion = 0;
// Minor version of Flash required
var requiredRevision = 28;
// -----------------------------------------------------------------------------
// -->
<!--
// Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
var hasProductInstall = DetectFlashVer(6, 0, 65);

// Version check based upon the values defined in globals
var hasRequestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

if ( hasProductInstall && !hasRequestedVersion ) {
	// DO NOT MODIFY THE FOLLOWING FOUR LINES
	// Location visited after installation is complete if installation is required
	var MMPlayerType = (isIE == true) ? "ActiveX" : "PlugIn";
	var MMredirectURL = window.location;
    document.title = document.title.slice(0, 47) + " - Flash Player Installation";
    var MMdoctitle = document.title;

	AC_FL_RunContent(
		"src", "playerProductInstall",
		"FlashVars", "MMredirectURL="+MMredirectURL+'&MMplayerType='+MMPlayerType+'&MMdoctitle='+MMdoctitle+"",
		"width", "500",
		"height", "500",
		"align", "middle",
		"id", "flexWidget",
		"quality", "high",
		"bgcolor", "#869ca7",
		"name", "flexWidget",
		"allowScriptAccess","always",
		"type", "application/x-shockwave-flash",
		"pluginspage", "http://www.adobe.com/go/getflashplayer"
	);
} else if (hasRequestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed
	AC_FL_RunContent(
			"src", "TestExternalInterface",
			"width", "500",
			"height", "500",
			"align", "middle",
			"id", "flexWidget",
			"quality", "high",
			"bgcolor", "#869ca7",
			"name", "flexWidget",
			"allowScriptAccess","always",
			"type", "application/x-shockwave-flash",
			"pluginspage", "http://www.adobe.com/go/getflashplayer"
	);
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = 'Alternate HTML content should be placed here. '
  	+ 'This content requires the Adobe Flash Player. '
   	+ '<a href=http://www.adobe.com/go/getflash/>Get Flash</a>';
    document.write(alternateContent);  // insert non-flash content
  }
};
// -->
</script>

</div>

<button onclick="callFlex();">Click me</button>
</body>
</html>

