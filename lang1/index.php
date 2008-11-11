 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: isFunction Failures</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #results {
            width: 300px;
            border: 1px solid black;
            background-color: #ccc;
        }
        #results span {
            display: block;
            border-bottom: 1px solid black;
            margin-bottom: 3px;
        }
        #results span.failed {
            color: red;
            font-weight: bold;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: isFunction failures</a></h1></div>
    <div id="bd">
        <p>Testing isFunction in A-Grade Browsers, all browsers fail at least one of these tests.</p>
        <p>This test suite compliments of jQuery..</p>
        <div id="results"><span></span></div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script src="http://developer.yahoo.com/yui/assets/dpSyntaxHighlighter.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var test = function(t, r, str) {
        var re = Dom.get('results');
        var p = document.createElement('span');
        p.innerHTML = r + ' :: ' + str;
        var v = true;
        if (t !== r) {
            v = false;
        }
        if (v) {
            p.className = 'passed';
        } else {
            p.className = 'failed';
        }
        re.insertBefore(p, re.firstChild);
    }

    var isFunction = YAHOO.lang.isFunction;

        
        test(false, isFunction(), "No Value" );
        test(false, isFunction( null ), "null Value" );
        test(false, isFunction( undefined ), "undefined Value" );
        test(false, isFunction( "" ), "Empty String Value" );
        test(false, isFunction( 0 ), "0 Value" );

        // Check built-ins
        // Safari uses "(Internal Function)"
        test(true, isFunction(String), "String Function("+String+")" );
        test(true, isFunction(Array), "Array Function("+Array+")" );
        test(true, isFunction(Object), "Object Function("+Object+")" );
        test(true, isFunction(Function), "Function Function("+Function+")" );

        // When stringified, this could be misinterpreted
        var mystr = "function";
        test(false, isFunction(mystr), "Function String" );

        // When stringified, this could be misinterpreted
        var myarr = [ "function" ];
        test(false, isFunction(myarr), "Function Array" );

        // When stringified, this could be misinterpreted
        var myfunction = { "function": "test" };
        test(false, isFunction(myfunction), "Function Object" );

        // Make sure normal functions still work
        var fn = function(){};
        test(true, isFunction(fn), "Normal Function" );

        var obj = document.createElement("object");

        // Firefox says this is a function
        test(false, isFunction(obj), "Object Element (FF Fails this)" );

        // IE says this is an object
        test(true, isFunction(obj.getAttribute), "getAttribute Function (IE Fails this)" );

        var nodes = document.body.childNodes;
        // Safari says this is a function
        test(false, isFunction(nodes), "childNodes Property (Safari & Opera Fail this" );

        var first = document.body.firstChild;

        // Normal elements are reported ok everywhere
        test(false, isFunction(first), "A normal DOM Element" );
        var input = document.createElement("input");
        input.type = "text";
        document.body.appendChild( input );

        // IE says this is an object
        test(true, isFunction(input.focus), "A default function property (IE Fails this)" );

        document.body.removeChild( input );
        var a = document.createElement("a");
        a.href = "some-function";
        document.body.appendChild( a );

        // This serializes with the word 'function' in it
        test(false, isFunction(a), "Anchor Element" );

        document.body.removeChild( a );




    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
