<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: ColorAnim Class Extension (using stylesheets)</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #bd {
            position: relative;
        }
        .bww {
            position: absolute;
            background-color: #000000;
            color: #FFFFFF;
            border: 1px solid #FFFFFF;
            height: 125px;
            width: 125px;
            left: 125px;
            top: 125px;
          }
        .wbb {
            position: absolute;
            background-color: #FFFFFF;
            color: #000000;
            border:1px solid #000000;
            height: 175px;
            width: 175px;
            left: 275px;
            top: 275px;
        }
        #thecode {
            margin-top: 300px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: ColorAnim Class Extension (using stylesheets)</a></h1></div>
    <div id="bd">
    <p>This example was provided by: Viktor Rennert - kakar0to (at) yahoo (dot) com</p>
<div id="user_actions">
  <button id="switchColorwbb">Switch Color WBB</button>
  <button id="switchColorbww" disabled>Switch Color BWW</button>
</div>

<div id="css_target" class="bww">Test</div>
    <h2 id="thecode">The Javascript</h2>
    <textarea name="code" class="JScript"><? include('source.js'); ?></textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="source.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;



    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
