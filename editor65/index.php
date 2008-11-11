<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
    <title>Example rich text editor</title>

    <!-- Sam Skin CSS -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/container/assets/skins/sam/container.css">
    <!-- OPTIONAL: You only need the YUI Button CSS if you're including YUI Button, mentioned below. -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/button/assets/skins/sam/button.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/resize/assets/skins/sam/resize.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/skin.css">

<!-- Include Yahoo Global Object, Dom Collection, Event Utility, Element
Utility, Connection Manager, Drag & Drop Utility and Animation Utility -->
    <script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/utilities/utilities.js"></script>
    <!-- Slider source file -->
    <script src="http://yui.yahooapis.com/2.5.2/build/slider/slider-min.js" ></script>
<!-- OPTIONAL: YUI Button (these 2 files only required if you want
SimpleDialog to use YUI Buttons, instead of HTML Buttons) -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/resize/resize-beta.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container-min.js"></script>
<script src="http://yui.yahooapis.com/2.5.2/build/editor/simpleeditor-beta-min.js"></script>


<script>
function initAddEventDialog() {
    // Define various event handlers for Dialog
    var handleSubmit = function() {
        var startDate = trim(this.getData().startDate);
        var endDate = trim(this.getData().endDate);
        if (endDate == ""){
            endDate = null;
        }
        this.hide();
        //this.submit();
    };

    var handleCancel = function() {
        this.cancel();

    };

    var handleClose = function() {
        this.cancel();
    };

    var handleSuccess = function(o) {
        var response = o.responseText;
        response = response.split("<!")[0];
        alert("response" + resonse);
    };

    var handleFailure = function(o) {
        alert("Submission failed: " + o.status);
    };

    // Instantiate the Dialog
    var examplePanel = document.getElementById("examplePanel");
    var addEventDialog = new YAHOO.widget.Dialog("addEventDialog", {
        width : "650px",
        zIndex : 10002,
        draggable : true,
        close : true,
        x : examplePanel.offsetLeft,
        y : examplePanel.offsetTop,
        visible : false,
        constraintoviewport : false,
        buttons: [
            { text:"Add Event", handler:handleSubmit, isDefault:true },
            { text:"Cancel", handler:handleCancel }
        ],
        effect: [
            { effect:YAHOO.widget.ContainerEffect.FADE,duration:0.5 }
        ]
    });

    // Validate the entries in the form to require that both first and lastname are entered
    addEventDialog.validate = function() {
        var data = this.getData();
        if (data.title == "" || data.startDate == "") {
            alert("Please enter title and start date.");
            return false;
        } else {
            return true;
        }
    };

    // Wire up the success and failure handlers
    addEventDialog.callback = {
        success: handleSuccess,
        failure: handleFailure
    };

    //DAV - Add show and hide for the Editor
    addEventDialog.showEvent.subscribe(function() {
        myEditor.show();
    });
    addEventDialog.hideEvent.subscribe(function() {
        myEditor.hide();
    });

    // Render the Dialog
    addEventDialog.render();


    YAHOO.util.Event.addListener("showEditor", "click", addEventDialog.show, addEventDialog, true);
    YAHOO.util.Event.addListener("hideEditor", "click", addEventDialog.hide, addEventDialog, true);

    var myEditor = new YAHOO.widget.SimpleEditor('ev_form_description', {
        height: '180px',
        width: '540px',
        dompath: false,
        focusAtStart: true
    });
    //DAV - Hide the Editor after render 
    myEditor.on('afterRender', myEditor.hide);
    myEditor.render();

}

function onLoad(){
    initAddEventDialog();
}


</script>

</head>
<body onload="onLoad();" class=" yui-skin-sam">

<p>
<div id="examplePanel" >

<div id="eventDetailPanel" style="font-size: 12px; position :
relative">
<div id="eventDetailHeader" class="hd">Panel header</div>
<div id="eventDetailBody" class="bd">
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
Suspendisse nulla. Fusce mauris massa, rutrum eu, imperdiet ut, placerat
at, nunc. Vestibulum consequat ligula ut lacus. Nulla nec pede. Fusce
consequat, augue et eleifend ornare, nibh mi dapibus lorem, ut lacinia
turpis eros at eros. Proin laoreet. Cum sociis natoque penatibus et magnis
dis parturient montes, nascetur ridiculus mus. Nulla velit. Fusce id sem
sit amet felis porta mollis. Aliquam erat volutpat. Etiam tortor. Donec dui
felis, pretium quis, vulputate et, molestie non, nisi.</p>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
Suspendisse nulla. Fusce mauris massa, rutrum eu, imperdiet ut, placerat
at, nunc. Vestibulum consequat ligula ut lacus. Nulla nec pede. Fusce
consequat, augue et eleifend ornare, nibh mi dapibus lorem, ut lacinia
turpis eros at eros. Proin laoreet. Cum sociis natoque penatibus et magnis
dis parturient montes, nascetur ridiculus mus. Nulla velit. Fusce id sem
sit amet felis porta mollis. Aliquam erat volutpat. Etiam tortor. Donec dui
felis, pretium quis, vulputate et, molestie non, nisi.</p>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
Suspendisse nulla. Fusce mauris massa, rutrum eu, imperdiet ut, placerat
at, nunc. Vestibulum consequat ligula ut lacus. Nulla nec pede. Fusce
consequat, augue et eleifend ornare, nibh mi dapibus lorem, ut lacinia
turpis eros at eros. Proin laoreet. Cum sociis natoque penatibus et magnis
dis parturient montes, nascetur ridiculus mus. Nulla velit. Fusce id sem
sit amet felis porta mollis. Aliquam erat volutpat. Etiam tortor. Donec dui
felis, pretium quis, vulputate et, molestie non, nisi.</p>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
Suspendisse nulla. Fusce mauris massa, rutrum eu, imperdiet ut, placerat
at, nunc. Vestibulum consequat ligula ut lacus. Nulla nec pede. Fusce
consequat, augue et eleifend ornare, nibh mi dapibus lorem, ut lacinia
turpis eros at eros. Proin laoreet. Cum sociis natoque penatibus et magnis
dis parturient montes, nascetur ridiculus mus. Nulla velit. Fusce id sem
sit amet felis porta mollis. Aliquam erat volutpat. Etiam tortor. Donec dui
felis, pretium quis, vulputate et, molestie non, nisi.</p>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
Suspendisse nulla. Fusce mauris massa, rutrum eu, imperdiet ut, placerat
at, nunc. Vestibulum consequat ligula ut lacus. Nulla nec pede. Fusce
consequat, augue et eleifend ornare, nibh mi dapibus lorem, ut lacinia
turpis eros at eros. Proin laoreet. Cum sociis natoque penatibus et magnis
dis parturient montes, nascetur ridiculus mus. Nulla velit. Fusce id sem
sit amet felis porta mollis. Aliquam erat volutpat. Etiam tortor. Donec dui
felis, pretium quis, vulputate et, molestie non, nisi.</p>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
Suspendisse nulla. Fusce mauris massa, rutrum eu, imperdiet ut, placerat
at, nunc. Vestibulum consequat ligula ut lacus. Nulla nec pede. Fusce
consequat, augue et eleifend ornare, nibh mi dapibus lorem, ut lacinia
turpis eros at eros. Proin laoreet. Cum sociis natoque penatibus et magnis
dis parturient montes, nascetur ridiculus mus. Nulla velit. Fusce id sem
sit amet felis porta mollis. Aliquam erat volutpat. Etiam tortor. Donec dui
felis, pretium quis, vulputate et, molestie non, nisi.</p>
</div>
<div class="ft"></div>
</div>

</div>
<div><button id="showEditor">show Editor</button><button
id="hideEditor">Hide Editor</button></div>
</p>


<div id="addEventDialog" style="visibility:hidden; font-size: 12px;
position : relative">
<div class="hd" style="font-size : 13px">Create a new event:</div>
<div class="bd">
<form name="eventForm" action="" method="post">

<table cellpadding="3px" >
<tr>
<td valign="top">Title</td>
<td><input id="ev_form_title" name="title" value=" Another new event"
size="59" type="text"></td>
</tr>
<tr valign="top">
<td>Start Date</td>
<td><input id="ev_form_startDate" name="startDate" value="Jun 28 2006
12:00:00" type="text"><br>
Examples: "Jun 28 2006 00:00:00" </td>
</tr>
<tr>
<td valign="top">End Date</td>
<td><input id="ev_form_endDate" name="endDate" type="text"></td>
</tr>
<tr>
<td valign="top">Description</td>
<td><textarea id="ev_form_description" name="description" rows="8"
cols="45">something in the textarea</textarea>
</td>
</tr>


</table>
</form>
</div>
</div>
</body>
</html> 
