<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Animate Background Position</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            margin: 2em;
            border: 1px solid black;
            height: 120px;
            width: 13px;
            overflow: hidden;
            background: url( hue_bg.png );
            background-position: 0 0;
            background-repeat: no-repeat;
        }
        #holder {
            position: absolute;
            visibility: hidden;
            top: 0;
            left: 0;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Animate Background Position</a></h1></div>
    <div id="bd">
        <p>Click the link below to make the background position of the div animate.</p>
        <p>Basically, this is an animation hack. What I did was create an element ( called holder ) and I am animating the top/left properties of it.</p>
        <p>Then in the onTween event, I am copying the top/left setting of holder's position and setting the background position of the image on the div.</p>
        <div id="demo"></div>
        <a href="#" id="animate">[Animate Background Position]</a>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Anim = YAHOO.util.Anim,
        demo = null,
        animate = null,
        holder = null,
        anim = null,
        attrs = {
            top: 0,
            left: 0
        };

    Event.onDOMReady(function() {
        demo = Dom.get('demo');
        animate = Dom.get('animate');
        Event.on(animate, 'click', function(ev) {
            var top = attrs.top - 80;
            animateBackground(top, 0);
            Event.stopEvent(ev);
        });
        holder = document.createElement('div');
        holder.id = 'holder';
        document.body.appendChild(holder);
        anim = new Anim(holder, {}, .5, YAHOO.util.Easing.bounceOut);
        anim.onTween.subscribe(function() {
            demo.style.backgroundPosition = holder.style.left + ' ' + holder.style.top;
        }, anim, true);
    });

    function animateBackground(top, left) {
        attrs.top = top;
        attrs.left = left;
        anim.attributes = {
            top: {
                to: top
            },
            left: {
                to: left
            }
        }
        anim.animate();
    }
    dp.SyntaxHighlighter.HighlightAll('code');
})()
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Anim = YAHOO.util.Anim,
        demo = null,
        animate = null,
        holder = null,
        anim = null,
        attrs = {
            top: 0,
            left: 0
        };

    Event.onDOMReady(function() {
        demo = Dom.get('demo');
        animate = Dom.get('animate');
        Event.on(animate, 'click', function(ev) {
            var top = attrs.top - 80;
            animateBackground(top, 0);
            Event.stopEvent(ev);
        });
        holder = document.createElement('div');
        holder.id = 'holder';
        document.body.appendChild(holder);
        anim = new Anim(holder, {}, .5, YAHOO.util.Easing.bounceOut);
        anim.onTween.subscribe(function() {
            demo.style.backgroundPosition = holder.style.left + ' ' + holder.style.top;
        }, anim, true);
    });

    function animateBackground(top, left) {
        attrs.top = top;
        attrs.left = left;
        anim.attributes = {
            top: {
                to: top
            },
            left: {
                to: left
            }
        }
        anim.animate();
    }
    dp.SyntaxHighlighter.HighlightAll('code');
})()

</script>
</body>
</html>
