<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>YUI Editor</title>   
        <link href="http://yui.yahooapis.com/2.5.0/build/assets/skins/sam/skin.css" rel="stylesheet" type="text/css" />
    <style>
    .yui-skin-sam .yui-toolbar-container .yui-toolbar-inserticon span.yui-toolbar-icon {
        background-image: url( icon-info.gif );
        background-position: 1px 0px;
    }
    .yui-skin-sam .yui-toolbar-container .yui-button-inserticon-selected span.yui-toolbar-icon {
        background-image: url( icon-info.gif );
    background-position: 1px 0px;
    }
    #testYUIButton {
        border: thick groove;
        height: 150;
        width: 150;
        background-color: grey;
        display: none;
    }
</style>
</head>
<body>
<form name="myForm" id="myForm" action="" class="_coop_" method="post">
    <div class="yui-skin-sam">
        <textarea name="msgpost" id="myTextEditor" cols="50" rows="10"></textarea>
        <!-- ToolBar buttons markup -->
        <div id="testYUIButton">
            <input type="text" value="testing" name="test" id="test" />
            <input type="button" value="insert" onClick="doInsert()" name="testButton" id="testButton">
        </div>
    </div>    
    <input type="hidden" name="_postBack" value="true">
    <input type="hidden" name="_postForm" value="myForm">
</form>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.0/build/element/element-beta-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.0/build/animation/animation-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.0/build/container/container_core-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.0/build/menu/menu-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.0/build/button/button-min.js"></script>
<script type="text/javascript" language="javascript" src="http://yui.yahooapis.com/2.5.0/build/editor/editor-beta-min.js"></script>
<script type="text/javascript" language="javascript">
var menu = null;
var myTextEditor_editor = new YAHOO.widget.Editor('myTextEditor', {  toolbar: {
            titlebar: '',
            buttons: [
                {
                group: 'MyNewGroup',
                label: 'This will help!',
                buttons: [

            //Setup the config for the new "test label" button
            {
                type: 'push', //Using a standard push button
                label: 'test label', //The name/title of the button
                value: 'inserticon', //The "Command" for the button           
                menu: function() {
                    //Create the Overlay instance we are going to use for the menu           
                    menu = new YAHOO.widget.Overlay('inserticon', {
                        width: '150px',
                        height: '150px',
                        visible: false
                    });
                    menu.setBody(document.getElementById('testYUIButton'));
                    menu.beforeShowEvent.subscribe(function() {
                        // set the display and visiblity of the button content
                        document.getElementById('testYUIButton').style.display = 'block';
                        //toggleVisibility(document.getElementById('testYUIButton'));
                       
                        //Set the context to the bottom left corner of the Insert Icon button
                        menu.cfg.setProperty('context', [
                            myTextEditor_editor.toolbar.getButtonByValue('inserticon').get('element'),
                            'tl',
                            'bl'
                        ]);
                    });       
                    menu.render(document.body);
                    //return the Overlay instance here               
                    return menu;
                }() //This fires the function right now to return the Overlay Instance to the menu property.
            }
            ]
                }
            ]}});


myTextEditor_editor.render();
</script>
<script type="text/javascript" language="javascript" src="/sos5/share/js/jquery/jquery.js"></script>

<script language="javascript" type="text/javascript">
function doInsert() {
    buttonValue = YAHOO.util.Dom.get('test').value;
    myTextEditor_editor.execCommand('insertHTML',YAHOO.util.Dom.get('test').value);
    YAHOO.util.Dom.get('test').value = '';
    menu.hide();
    //toggleVisibility(document.getElementById('testYUIButton'));
}
</script>

</body>
</html>
