<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Skinning A YUI Button</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="formelements.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        .buttonContainer {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Skinning a YUI Button</a></h1></div>
    <div id="bd">
        <div id="checkboxbuttonsfromjavascript" class="buttonContainer"></div>
        <div id="radiobuttonsfromjavascript" class="buttonContainer"></div>
        <div id="menubuttonsfromjavascript" class="buttonContainer"></div>
        <textarea name="code" class="HTML">
/* Checkboxes */
.yui-skin-sam .yui-checkbox-button {
    background-image: url( unchecked_box.gif );
    background-position: 0 3px;
    background-repeat: no-repeat;
    border: none;
}
.yui-skin-sam .yui-checkbox-button-checked {
    background-image: url( checked_box.gif );
}

.yui-skin-sam .yui-checkbox-button-checked button {
    color: #000;
}

.yui-skin-sam .yui-checkbox-button .first-child {
    border: none;
    padding-left: 5px;
}


/* Radio Buttons */
.yui-skin-sam .yui-radio-button {
    background-image: url( unchecked_radio.gif );
    background-position: 0 9px;
    background-repeat: no-repeat;
    border: none;
}
.yui-skin-sam .yui-radio-button-checked {
    background-image: url( checked_radio.gif );
}

.yui-skin-sam .yui-radio-button-checked button {
    color: #000;
}

.yui-skin-sam .yui-radio-button .first-child {
    border: none;
    padding-left: 5px;
}
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/button/button-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript">

(function() {
    dp.SyntaxHighlighter.HighlightAll('code');
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        Event.on(window, 'load', function() {
            var oCheckButton9 = new YAHOO.widget.Button({ type: "checkbox", label: "One", id: "checkbutton9", name: "checkboxfield3", value: "1", container: "checkboxbuttonsfromjavascript", checked: true });
            var oCheckButton10 = new YAHOO.widget.Button({ type: "checkbox", label: "Two", id: "checkbutton10", name: "checkboxfield3", value: "2", container: "checkboxbuttonsfromjavascript" });
            var oCheckButton11 = new YAHOO.widget.Button({ type: "checkbox", label: "Three", id: "checkbutton11", name: "checkboxfield3", value: "3", container: "checkboxbuttonsfromjavascript" });
            var oCheckButton12 = new YAHOO.widget.Button({ type: "checkbox", label: "Four", id: "checkbutton12", name: "checkboxfield3", value: "4", container: "checkboxbuttonsfromjavascript" });

            var oButtonGroup3 = new YAHOO.widget.ButtonGroup({ id:  "buttongroup3", name:  "radiofield3", container:  "radiobuttonsfromjavascript" });

            oButtonGroup3.addButtons([
                { label: "Radio 9", value: "Radio 9", checked: true },
                { label: "Radio 10", value: "Radio 10" }, 
                { label: "Radio 11", value: "Radio 11" }, 
                { label: "Radio 12", value: "Radio 12" }
            ]);
        });
})()

</script>
</body>
</html>
