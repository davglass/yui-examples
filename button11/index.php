<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Multiple Color Picker Buttons</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.0/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
    /*
        Set the "zoom" property to "normal" since it is set to "1" by the 
        ".example-container .bd" rule in yui.css and this causes a Menu
        instance's width to expand to 100% of the browser viewport.
    */
    
    div.yuimenu .bd {
    
        zoom: normal;
    
    }

    #button-container {
    
        padding: .5em;
    
    }

    #color-picker-button button {
    
        outline: none;  /* Safari */
        line-height: 1.5;

    }


    /*
        Style the Button instance's label as a square whose background color 
        represents the current value of the ColorPicker instance.
    */

    #current-color-1, 
    #current-color-2 ,
    #current-color-3 {

        display: block;
        display: inline-block;
        *display: block;    /* For IE */
        margin-top: .5em;
        *margin: .25em 0;    /* For IE */
        width: 1em;
        height: 1em;
        overflow: hidden;
        text-indent: 1em;
        background-color: #fff;
        white-space: nowrap;
        border: solid 1px #000;

    }


    /* Hide default colors for the ColorPicker instance. */

    #color-picker-container .yui-picker-controls,
    #color-picker-container .yui-picker-swatch,
    #color-picker-container .yui-picker-websafe-swatch {
    
        display: none;
    
    }


    /*
        Size the body element of the Menu instance to match the dimensions of 
        the ColorPicker instance.
    */
            
    #color-picker-menu .bd {

        width: 220px;    
        height: 190px;
    
    }
        
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Multiple Color Picker Buttons</a></h1></div>
    <div id="bd">
<div id="button-container1"><label for="color-picker-button1">Color: </label></div>
<input type="text" name="hex1" id="hex1">

<div id="button-container2"><label for="color-picker-button2">Color: </label></div>
<input type="text" name="hex2" id="hex2">

<div id="button-container3"><label for="color-picker-button3">Color: </label></div>
<input type="text" name="hex3" id="hex3">
 
 <h2>The Javascript</h2>
 <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

function createCP(idcount)
{
    YAHOO.util.Event.onContentReady("button-container"+idcount, function () {
        function onButtonOption() {
            /*
                Create an empty body element for the Menu instance in order to 
                reserve space to render the ColorPicker instance into.
            */
            oColorPickerMenu.setBody("&#32;");
            oColorPickerMenu.body.id = "color-picker-container"+idcount;
            // Render the Menu into the Button instance's parent element
            oColorPickerMenu.render(this.get("container"));
            /*
                 Create a new ColorPicker instance, placing it inside the body 
                 element of the Menu instance.
            */
            var oColorPicker = new YAHOO.widget.ColorPicker(oColorPickerMenu.body.id, {
                                    showcontrols: false,
                                    images: {
                                        PICKER_THUMB: "http://yui.yahooapis.com/2.4.1/build/colorpicker/assets/picker_thumb.png",
                                        HUE_THUMB: "http://yui.yahooapis.com/2.4.1/build/colorpicker/assets/hue_thumb.png"
                                    }
                                });
            // Align the Menu to its Button
            oColorPickerMenu.align();
            /*
                Add a listener for the ColorPicker instance's "rgbChange" event
                to update the background color and text of the Button's 
                label to reflect the change in the value of the ColorPicker.
            */
            oColorPicker.on("rgbChange", function (p_oEvent) {
                var sColor = "#" + this.get("hex");
                //UPDATED CODE HERE
                YAHOO.util.Dom.setStyle("current-color-" + idcount, "backgroundColor", sColor);
                YAHOO.util.Dom.get("current-color-" + idcount).innerHTML = "Current color is " + sColor;
				YAHOO.util.Dom.get("hex"+idcount).value = sColor;
            });
            // Remove this event listener so that this code runs only once
            this.unsubscribe("option", onButtonOption);
        }
        // Create a Menu instance to house the ColorPicker instance
        var oColorPickerMenu = new YAHOO.widget.Menu("color-picker-menu"+idcount);
        // Create a Button instance of type "split"
        var oButton = new YAHOO.widget.Button({ 
                                            type: "split", 
                                            id: "color-picker-button"+idcount, 
                                            //UPDATED CODE HERE
                                            label: "<em id=\"current-color-" + idcount + "\">Current color is #FFFFFF.</em>", 
                                            menu: oColorPickerMenu, 
                                            container: this });
        /*
            Add a listener for the "option" event.  This listener will be
            used to defer the creation the ColorPicker instance until the 
            first time the Button's Menu instance is requested to be displayed
            by the user.
        */
        oButton.on("option", onButtonOption);
    });
}
	createCP(1); createCP(2); createCP(3);

})();
 </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/utilities/utilities.js"></script>

<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/slider/slider.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/colorpicker/colorpicker-beta.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/container/container_core.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/menu/menu.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/button/button.js"></script>

<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

function createCP(idcount)
{
    YAHOO.util.Event.onContentReady("button-container"+idcount, function () {
        function onButtonOption() {
            /*
                Create an empty body element for the Menu instance in order to 
                reserve space to render the ColorPicker instance into.
            */
            oColorPickerMenu.setBody("&#32;");
            oColorPickerMenu.body.id = "color-picker-container"+idcount;
            // Render the Menu into the Button instance's parent element
            oColorPickerMenu.render(this.get("container"));
            /*
                 Create a new ColorPicker instance, placing it inside the body 
                 element of the Menu instance.
            */
            var oColorPicker = new YAHOO.widget.ColorPicker(oColorPickerMenu.body.id, {
                                    showcontrols: false,
                                    images: {
                                        PICKER_THUMB: "http://yui.yahooapis.com/2.4.1/build/colorpicker/assets/picker_thumb.png",
                                        HUE_THUMB: "http://yui.yahooapis.com/2.4.1/build/colorpicker/assets/hue_thumb.png"
                                    }
                                });
            // Align the Menu to its Button
            oColorPickerMenu.align();
            /*
                Add a listener for the ColorPicker instance's "rgbChange" event
                to update the background color and text of the Button's 
                label to reflect the change in the value of the ColorPicker.
            */
            oColorPicker.on("rgbChange", function (p_oEvent) {
                var sColor = "#" + this.get("hex");
                //UPDATED CODE HERE
                YAHOO.util.Dom.setStyle("current-color-" + idcount, "backgroundColor", sColor);
                YAHOO.util.Dom.get("current-color-" + idcount).innerHTML = "Current color is " + sColor;
				YAHOO.util.Dom.get("hex"+idcount).value = sColor;
            });
            // Remove this event listener so that this code runs only once
            this.unsubscribe("option", onButtonOption);
        }
        // Create a Menu instance to house the ColorPicker instance
        var oColorPickerMenu = new YAHOO.widget.Menu("color-picker-menu"+idcount);
        // Create a Button instance of type "split"
        var oButton = new YAHOO.widget.Button({ 
                                            type: "split", 
                                            id: "color-picker-button"+idcount, 
                                            //UPDATED CODE HERE
                                            label: "<em id=\"current-color-" + idcount + "\">Current color is #FFFFFF.</em>", 
                                            menu: oColorPickerMenu, 
                                            container: this });
        /*
            Add a listener for the "option" event.  This listener will be
            used to defer the creation the ColorPicker instance until the 
            first time the Button's Menu instance is requested to be displayed
            by the user.
        */
        oButton.on("option", onButtonOption);
    });
}
	createCP(1); createCP(2); createCP(3);



    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
