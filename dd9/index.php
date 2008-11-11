<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: </title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #dd1 {
            margin: 2em;
            height: 100px;
            width: 100px;
            border: 1px solid black;
            background-color: blue;
            color: white;
            position: absolute;
            top: 300px;
            left: 200px;
        }
        #testFrame {
            position: absolute;
            top: 50px;
            left: 50px;
            border: 1px solid black;
        }
        #dd2 {
            height: 100px;
            width: 100px;
            border: 1px solid black;
            background-color: red;
            color: white;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="bd">
    <iframe src="test.htm" id="testFrame" height="250" width="250" border="1"></iframe>
    <div id="dd1">Drag Me into the frame</div>
    </div>
    <div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="ddtest.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
