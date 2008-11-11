<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>ISDC Training - Planner Tool</title>

	<!-- Our own style sheets. Attention: Can be overriden by Yahoo's sheets (below). We don't want to mess with their scripts, thats why.-->
	<link rel="stylesheet" type="text/css" href="include/nomargin.css" />
	<style>
		#container{
			padding:5px;
		}
	</style>
	
	<!-- Yahoo! UI ---------------------------------------------------------------- -->
	<!-- We use the Y!UI framework for fancy and easy UI stuff. This is their code: -->
	<!-- Dependencies -->
	<!-- Sam Skin CSS for TabView -->
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/fonts/fonts-min.css" />
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/tabview/assets/skins/sam/tabview.css">

	<!-- JavaScript Dependencies for Tabview: -->
	<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
	<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/element/element-beta-min.js"></script>

	<!-- OPTIONAL: Connection (required for dynamic loading of data) -->
	<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/connection/connection-min.js"></script>

	<!-- Source file for TabView -->
	<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/tabview/tabview-min.js"></script>

</head>

<body class=" yui-skin-sam">
	<!-- Main container for the web site. Does not change, changes are individual per internal pane.-->
	<div id="container">
		<h2 class="first">ISDC Training | Planner Tool</h2>
		<!-- Here we have, in fact, the Tabs for the web-app. look for the code you want in the files specified as dataSrc. -->
	</div>

	<script type="text/javascript">
	(function() {
		var tabView = new YAHOO.widget.TabView();

		tabView.addTab( new YAHOO.widget.Tab({
			label: 'Learn',
			dataSrc: 'learn.html',
			cacheData: false,
			active: true
		}));

		tabView.addTab( new YAHOO.widget.Tab({
			label: 'Plan',
			dataSrc: 'dummy.html',
			cacheData: false
		}));

		tabView.addTab( new YAHOO.widget.Tab({
			label: 'Admin',
			dataSrc: 'dummy.html',
			cacheData: false
		}));

		tabView.appendTo('container');
	})();
	</script>

</body>
</html>
