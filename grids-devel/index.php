<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: CSS Grid Builder</title>
    <link rel="stylesheet" href="http://developer.yahoo.com/yui/build/reset-fonts-grids/reset-fonts-grids-min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://developer.yahoo.com/yui/docs/assets/dpSyntaxHighlighter.css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/lib/common/widgets/2/container/css/container_2.1.0.css">
    <style>
#hd, #bd, #ft { border: 1px solid black; }
#hd h1 { font-size: 120%; }
#bd { min-height: 350px; }
#bd p { border: 2px solid red; min-height: 300px; padding: .25em; }
body { position: relative; }
.bd { text-align: left; }
.mask { z-index: 6000; }
#toolBoxHolder { visibility: hidden; }
#toolBoxHolder fieldset { border: 1px solid #ccc; padding: .5em; margin: .5em 0; }
#toolBoxHolder p { padding-bottom: .25em }
button { margin: .5em; border: 1px solid black; background-color: #eee; font-size: 80%; cursor: pointer; *cursor: hand; }
#showSlider { position: relative; }
#sliderbg { background-image: url( http://developer.yahoo.com/yui/examples/slider/img/horizBg.png ); background-repeat: repeat-x; background-position: -99px 5px; position: relative; top: 15px; height: 50px; width: 218px; }
#sliderthumb { position: absolute; }
#custom-doc { margin:auto;text-align:left; }
#sliderValue { border: 1px solid #ccc; }
    </style>
</head>
<body>
<div id="doc" class="yui-t2">
    <div id="hd"><h1>YUI: CSS Grid Builder</h1></div>
    <div id="bd">
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.</p>
    </div>
    <div id="ft">Footer is here.</div>
</div>


<div id="toolBoxHolder">
    <div class="hd">Toobox</div>
    <div class="bd">
    <form id="grids">
        <fieldset>
            <legend>Body Size:</legend>
            <select id="which_doc">
                <option value="doc">750px</option>
                <option value="doc2">950px</option>
                <option value="doc3">100%</option>
                <option value="custom-doc" id="customDoc">Custom</option>
            </select>
        </fieldset>
        <fieldset>
            <legend>Body Columns:</legend>
            <select id="which_grid">
                <option value="yui-t7">No Columns</option>
                <option value="yui-t1">Sidebar left 160px</option>
                <option value="yui-t2">Sidebar left 180px</option>
                <option value="yui-t3">Sidebar left 300px</option>
                <option value="yui-t4">Sidebar right 180px</option>
                <option value="yui-t5">Sidebar right 240px</option>
                <option value="yui-t6">Sidebar right 300px</option>
            </select>
        </fieldset>
        <fieldset>
            <legend>Split Content:</legend>
            <span>
                <p>Row:<br>
                    <select id="splitBody0">
                        <option value="1">1 Column (100)</option>
                        <option value="2">2 Column (50/50)</option>
                        <option value="7">2 Column (66/33)</option>
                        <option value="8">2 Column (33/66)</option>
                        <option value="9">2 Column (75/25)</option>
                        <option value="10">2 Column (25/75)</option>
                        <option value="3">3 Column (33/33/33)</option>
                        <option value="5">3 Column (50/25/25)</option>
                        <option value="6">3 Column (25/25/50)</option>
                        <option value="4">4 Column (25/25/25/25)</option>
                    </select>
                </p>
            </span>
            <button type="button" id="addRow">Add Another Row</button>
        </fieldset>
        <button type="button" id="setHeader">Set Header Content</button><br>
        <button type="button" id="setFooter">Set Footer Content</button><br>
        <button type="button" id="show_code">Show Code</button><br>
        <button type="button" id="resetBuilder">Reset</button><br>
        <button type="button" id="about">About</button><br>
    </form>
    </div>
    <div class="ft"></div>
</div>
<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/utilities_2.1.0.js"></script> 
<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/widgets/2/container/container_2.1.0.js"></script>

<script type="text/javascript" src="../js/tools-min.js"></script>
<script type="text/javascript" src="http://developer.yahoo.com/yui/build/slider/slider-min.js" ></script></head>
<script src="http://developer.yahoo.com/yui/docs/assets/dpSyntaxHighlighter.js"></script>
<!--script type="text/javascript" src="grids-min.js"></script-->
<script type="text/javascript" src="gridbuilder.js"></script>
<script type="text/javascript">
var toolBox = null;

/* Frame Buster  */
if (top != self) top.location.href = location.href;

function init() {
    toolBox = new YAHOO.widget.Dialog('toolBoxHolder', {
            close: false,
            visible: false,
            x: '5',
            y: '5',
            zindex: 5000
        }
    );
    toolBox.render(document.body);
    toolBox.show();
    YAHOO.CSSGridBuilder.init();
}

$E.addListener(window, 'load', init);

</script>
</body>
</html>
