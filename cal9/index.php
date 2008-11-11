<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Calendar w/ Drag & Drop</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .yui-skin-sam .yui-calcontainer .title {
            cursor: move;
        }
        #code {
            position: relative;
            margin-top: 300px;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Calendar w/ Drag & Drop</a></h1></div>
    <div id="bd">
    <p>This example shows how to add Drag &amp; Drop to a Calendar Control.</p>
    <div id="cal2Container"></div>
    <div id="code">
        <h2>The Code</h2>
        <textarea name="code" class="JScript">
            YAHOO.namespace("disco.calendar");

            YAHOO.disco.calendar.init = function() { 
                var navConfig = {
                    strings : {
                        month: "Choose Month",
                        year: "Enter Year",
                        submit: "OK",
                        cancel: "Cancel",
                        invalidYear: "Please enter a valid year"
                    },
                    monthFormat: YAHOO.widget.Calendar.SHORT,
                    initialFocus: "year"
                };
                
                var cal2 = new YAHOO.widget.Calendar("cal2Container", {navigator:navConfig});
                cal2.cfg.setProperty("close", true);
                cal2.renderEvent.subscribe(function() {
                    //Get the title so we can set the drag handle
                    var title = YAHOO.util.Dom.getElementsByClassName('title', 'div', cal2.oDomContainer)[0];
                    //On render setup the DD instance
                    var dd = new YAHOO.util.DD("cal2Container");
                    //Set the handle to the title, so we drag by it..
                    dd.setHandleElId(title);
                });
                
                cal2.render();
                
            }

            YAHOO.util.Event.onDOMReady(YAHOO.disco.calendar.init);
        </textarea>
        </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/calendar/calendar-min.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        YAHOO.namespace("disco.calendar");

        YAHOO.disco.calendar.init = function() { 
            var navConfig = {
                strings : {
                    month: "Choose Month",
                    year: "Enter Year",
                    submit: "OK",
                    cancel: "Cancel",
                    invalidYear: "Please enter a valid year"
                },
                monthFormat: YAHOO.widget.Calendar.SHORT,
                initialFocus: "year"
            };
            
            var cal2 = new YAHOO.widget.Calendar("cal2Container", {navigator:navConfig});
            cal2.cfg.setProperty("close", true);
            cal2.renderEvent.subscribe(function() {
                //Get the title so we can set the drag handle
                var title = YAHOO.util.Dom.getElementsByClassName('title', 'div', cal2.oDomContainer)[0];
                //On render setup the DD instance
                var dd = new YAHOO.util.DD("cal2Container");
                //Set the handle to the title, so we drag by it..
                dd.setHandleElId(title);
            });
            
            cal2.render();
            
        }

        YAHOO.util.Event.onDOMReady(YAHOO.disco.calendar.init);


    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
