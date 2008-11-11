<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
	<title>Test YUI Layout Manager</title>
	<!-- Skin CSS file -->
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/layout.css">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/resize.css">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.0/build/container/assets/skins/sam/container.css">
	<style type="text/css">
		body {
			margin:0;
			padding:0;
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 100%;
		}
		
		h1 {
			text-align: center;
		}	
	</style>

	<!-- Utility Dependencies -->
	<script src="http://yui.yahooapis.com/2.5.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
	<script src="http://yui.yahooapis.com/2.5.0/build/dragdrop/dragdrop-min.js"></script> 
	<script src="http://yui.yahooapis.com/2.5.0/build/element/element-beta-min.js"></script> 
	<!-- Optional Animation -->
	<script src="http://yui.yahooapis.com/2.5.0/build/animation/animation-min.js"></script> 
	<!-- Source file for the Resize Utility -->
	<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/resize/resize-beta-min.js"></script>

	<!-- Source file for the Layout Manager -->
	<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/layout/layout-beta-min.js"></script>
	<script type="text/javascript" src="http://yui.yahooapis.com/2.5.0/build/container/container-min.js"></script>
	<script type="text/javascript">
		function startTime()
		{
			var today=new Date();
			var h=today.getHours();
			var m=today.getMinutes();
			var s=today.getSeconds();
			// add a zero in front of numbers<10
			m=checkTime(m);
			s=checkTime(s);
			document.getElementById('time').innerHTML=h+":"+m+":"+s;
			var t=setTimeout('startTime()',500);
		}
		
		function checkTime(i)
		{
			if (i<10)
			{
				i="0" + i;
			}
			return i;
		}
	</script>
</head>

<body class="yui-skin-sam">
<div id="hdr"><h1>This is a test</h1></div>
<div id="lhs"><p>The menu will go here</p></div>

<div id="center1"><h1>This is the center area</h1>
	<div id="panel1">
		<div class="hd" style="text-align:center;color:red">Test Panel</div>
		<div class="bd"></div>
		<div class="ft"><div id="time" style="text-align:center;font-weight:bold;font-size:150%;"></div></div>
	</div>
</div>
<script type="text/javascript" src="source.js"></script>
</body>
</html>
