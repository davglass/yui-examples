<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: YUI Docs in AIR</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #get {
            margin: 2em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: YUI Docs in AIR</a></h1></div>
    <div id="bd">
        <p>This little app will let you do a quick search of the YUI docs offline in a small window. Now you can lookup YUI docs anywhere at anytime.</p>
        <div id="get"></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script language="JavaScript" type="text/javascript">
var requiredMajorVersion = 9;
var requiredMinorVersion = 0;
var requiredRevision = 115;
</script>
<script type="text/javascript" src="../air1/AC_RunActiveContent.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

var hasReqestedVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);

// Check to see if the version meets the requirements for playback
if (hasReqestedVersion) {
	// if we've detected an acceptable version
	// embed the Flash Content SWF when all tests are passed

	AC_FL_RunContent(
		'codebase','http:/'+'/fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab',
		'width','217',
		'height','180',
		'id','badge',
		'align','middle',
		'src','badge',
		'quality','high',
		'bgcolor','#FFFFFF',
		'name','badge',
		'allowscriptaccess','all',
		'pluginspage','http:/'+'/www.macromedia.com/go/getflashplayer',
		'flashvars','appname=YUI%20AIR%20Docs&appurl=http:/'+'/blog.davglass.com/files/yui/air3/YUIAIRDocs.air&airversion=1.0&imageurl=docs.jpg',
		'movie','badge' ); //end AC code

} else {  // Flash Player is too old or we can't detect the plugin
	var str = '<table id="AIRDownloadMessageTable"><tr><td>Download <a href="YUIAIRDocs.air">My Application</a> now.<br /><br /><span id="AIRDownloadMessageRuntime">This application requires the <a href="';
	
	var platform = 'unknown';
	if (typeof(window.navigator.platform) != undefined) {
		platform = window.navigator.platform.toLowerCase();
		if (platform.indexOf('win') != -1) {
			platform = 'win';
		} else if (platform.indexOf('mac') != -1) {
			platform = 'mac';
        }
	}
	
	if (platform == 'win') {
		str += 'http:/'+'/airdownload.adobe.com/air/win/download/1.0/AdobeAIRInstaller.exe';
	} else if (platform == 'mac') {
		str += 'http:/'+'/airdownload.adobe.com/air/mac/download/1.0/AdobeAIR.dmg';
	} else {
	    str += 'http:/'+'/www.adobe.com/go/getair/';
    }
		
	str += '">Adobe&#174;&nbsp;AIR&#8482; runtime</a>.</span></td></tr></table>';

    Dom.get('get').innerHTML = str;
}
    dp.SyntaxHighlighter.HighlightAll('code');
})();



</script>
</body>
</html>
