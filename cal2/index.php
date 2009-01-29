<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Calendar Text Input</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">

    <style type="text/css" media="screen">
        #cal1Container {
            position: absolute;
            display: none;
        }
        p, #cal1Container {
            margin: 1em;
        }
        textarea {
            width: 100%;
        }
        #cal1Container {
            z-index: 500;
        }
        .dp-highlighter {
            z-index: 1;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar attached to Text Input</a></h1></div>
    <div id="bd">
        <p>Here is an example on how to attach a popup calendar to a text input. Just place your cursor in the text box & the calendar will appear.</p>
        <form method="get" action="index.php">
            Select Date: <input type="text" name="cal1Date1" id="cal1Date1" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date1']) ? urldecode($_GET['cal1Date1']) : '') ?>" /><br>
            Select Date: <input type="text" name="cal1Date2" id="cal1Date2" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date2']) ? urldecode($_GET['cal1Date2']) : '') ?>" /><br>
            Select Date: <input type="text" name="cal1Date3" id="cal1Date3" autocomplete="off" size="35" value="<?php echo(($_GET['cal1Date3']) ? urldecode($_GET['cal1Date3']) : '') ?>" /><br>
            <input type="submit" value="Submit" />
        </form>
        <div id="cal1Container"></div>
        <br clear="all">
        <h2>The HTML/PHP</h2>
        <textarea name="code" class="HTML">
<form method="get" action="index.php">
Select Date:
<input type="text" name="cal1Date" id="cal1Date" autocomplete="off" size="35" value="&lt;?php echo(($_GET['cal1Date']) ? urldecode($_GET['cal1Date']) : '') ?&gt;" />
<input type="submit" value="Submit" />
</form>
<div id="cal1Container"></div>
        </textarea>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript"><?php include('cal2.js'); ?></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>

<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/calendar/calendar-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="cal2.js"></script>
</body>
</html>
