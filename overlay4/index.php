<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Overlay Problem</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( ../css/container_assets/container.css );
        @import url( style.css );
        #myPanel { margin: 2em; visibility: hidden; }
        #myPanel .bd {  padding: .5em; }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
<div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Overlay Problem</a></h1></div>
<div id="bd">


<div id="myPanel">  
  <div class="hd">Test Header</div>  
  <div class="bd"></div>  
  <div class="ft"></div>  
</div>  


<a href="#" onclick="myPanel.show();">Show Graph</a>


<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript">

myPanel = new YAHOO.widget.Panel("myPanel", { close:true, draggable: true } );
  myPanel.setHeader("Revenue By Month");
  myPanel.setBody("<center><img src=\"graph.png\"><br/><a href=\"javascript:myPanel.hide();\">Close</a></center>");
myPanel.cfg.setProperty("draggable", true);
myPanel.cfg.setProperty("close", true);


</script>
</body>
</html>
