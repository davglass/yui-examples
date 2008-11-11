<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: RTE Test</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #editor {
            border: 1px solid black;
            height: 300px;
            width: 300px;
        }

        #editor iframe {
            border: 1px solid red;
            height: 300px;
            width: 300px;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: RTE Test</a></h1></div>
    <div id="bd">
        <div id="editor">
            <!--iframe src="blank.htm" id="editFrame"></iframe-->
        </div>
    </div>
<div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="editor.js"></script> 
<script type="text/javascript">

YAHOO.util.Event.addListener(window, 'load', init);

</script>
</body>
</html>
