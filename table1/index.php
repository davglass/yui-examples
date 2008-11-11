<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Table with DragDrop Columns</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #wrap {
            margin: 2em;
            zoom: 1;
        }
        table {
            border: 1px solid black;
            zoom: 1;
        }
        table td {
            border: 1px solid #ccc;
        }
        table th {
            padding: 3px;
            border: 1px solid #ccc;
        }
        table td.hidden, table th.hidden {
            opacity: 0.5;
        }
        .pointer {
            width: 5px;
            background-color: red;
            position: absolute;
        }
        #table0 th {
            cursor: move;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Table with DragDrop Columns</a></h1></div>
    <div id="bd">
        <div id="wrap">
            <table id="table0">
                <col style="background-color: yellow;"></col>
                <col></col>
                <col style="background-color: yellow;"></col>
                <col></col>
                <col style="background-color: yellow;"></col>
                <col></col>
                <col style="background-color: yellow;"></col>
                <col></col>
                <col style="background-color: yellow;"></col>
                <col></col>
                <thead>
                    <tr>
                        <th>Head 1</th>
                        <th>Head 2</th>
                        <th>Head 3</th>
                        <th>Head 4</th>
                        <th>Head 5</th>
                        <th>Head 6</th>
                        <th>Head 7</th>
                        <th>Head 8</th>
                        <th>Head 9</th>
                        <th>Head 10</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1 - 1</td><td>2 - 1</td><td>3 - 1</td><td>4 - 1</td><td>5 - 1</td><td>6 - 1</td><td>7 - 1</td><td>8 - 1</td><td>9 - 1</td><td>10 - 1</td></tr>
                </tbody>
            </table>
            <table id="table1">
                <col style="background-color: yellow;"></col>
                <col></col>
                <col style="background-color: yellow;"></col>
                <col></col>
                <col style="background-color: yellow;"></col>
                <col></col>
                <col style="background-color: yellow;"></col>
                <col></col>
                <col style="background-color: yellow;"></col>
                <col></col>
                <thead>
                    <tr>
                        <th>Head 1</th>
                        <th>Head 2</th>
                        <th>Head 3</th>
                        <th>Head 4</th>
                        <th>Head 5</th>
                        <th>Head 6</th>
                        <th>Head 7</th>
                        <th>Head 8</th>
                        <th>Head 9</th>
                        <th>Head 10</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/dragdrop/dragdrop-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript" src="cols.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;



    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
