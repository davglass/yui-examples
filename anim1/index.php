<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Safari Animation</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/yuicss.css" type="text/css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
    p, h2 {
        margin: 1em;
    }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Safari Animation</a></h1></div>
    <div id="bd">
        <div id="wtf" style="background:#ddeeff;border:1px solid #c3daf9;padding:20px;position:absolute;left:45%;top:45%;">Click to Highlight</div>
    </div>
    <div id="ft">&nbsp;</div>
</div>

<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/yahoo-dom-event_2.1.1.js"></script> 
<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/animation_2.1.1.js"></script>
<script type="text/javascript">

YAHOO.util.Event.on('wtf', 'click', function(){
        
        var anim = new YAHOO.util.ColorAnim('wtf', {
            backgroundColor: {to: 'ddeeff', from: 'ffff9c'}
        }, .75, YAHOO.util.Easing.easeNone);
        
        anim.onComplete.subscribe(function(ev, data){
            var endTime = new Date();
            alert('Duration: ' + anim.duration + '\nAnimation: ' + data);
        }, this, true);
        
        var start = new Date();
        anim.animate(); 
    });



</script>
</body>
</html>
