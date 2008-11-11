<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Javascript Private Var</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Javascript Private Var</a></h1></div>
    <div id="bd">
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
        (function(){
            ClassBase = function(){
                var _foo = null;
                var _bar = null;
            };
        }());

        (function(){

            ClassA = function(evt){
                this._evt = evt;
                ClassA.superclass.constructor.call(this);
            }

            YAHOO.extend(ClassA, ClassBase, {
                _evt: null,
                getEvt: function() {
                    alert("ClassA: " + this._evt);
                }
            })
        }());

        (function(){

            ClassB = function(evt){
                ClassB.superclass.constructor.call(this, evt);
            }

            YAHOO.extend(ClassB, ClassA, {
                foobar: function() {
                    this.getEvt();
                }
            })
        }());

        YAHOO.util.Event.addListener(window, "load", function() {
            var b = new ClassB("one");
            var b2 = new ClassB("two");

            b.getEvt();
            b.foobar();

            b2.getEvt();
            b2.foobar();
        });

        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

        (function(){
            ClassBase = function(){
                var _foo = null;
                var _bar = null;
            };
        }());

        (function(){

            ClassA = function(evt){
                this._evt = evt;
                ClassA.superclass.constructor.call(this);
            }

            YAHOO.extend(ClassA, ClassBase, {
                _evt: null,
                getEvt: function() {
                    alert("ClassA: " + this._evt);
                }
            })
        }());

        (function(){

            ClassB = function(evt){
                ClassB.superclass.constructor.call(this, evt);
            }

            YAHOO.extend(ClassB, ClassA, {
                foobar: function() {
                    this.getEvt();
                }
            })
        }());

        YAHOO.util.Event.addListener(window, "load", function() {
            var b = new ClassB("one");
            var b2 = new ClassB("two");

            b.getEvt();
            b.foobar();

            b2.getEvt();
            b2.foobar();
        });



(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
