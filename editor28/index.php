
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>

<!-- Skin CSS file -->  
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">   
   
<!-- Utility Dependencies -->  
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>    
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/element/element-beta-min.js"></script>    
  
<!-- Needed for Menus, Buttons and Overlays used in the Toolbar -->  
<script src="http://yui.yahooapis.com/2.3.1/build/container/container_core-min.js"></script>  
<script src="http://yui.yahooapis.com/2.3.1/build/menu/menu-min.js"></script>  
<script src="http://yui.yahooapis.com/2.3.1/build/button/button-beta-min.js"></script>  
   
<!-- Source file for Rich Text Editor-->  
<script src="http://yui.yahooapis.com/2.3.1/build/editor/editor-beta-min.js"></script>

<script type="text/javascript">
var myEditor = new YAHOO.widget.Editor('msgpost', {
    height: '300px',
    width: '600px',
    dompath: false,
    handleSubmit: true,
    animate: true,
    toolbar: {
        titlebar: 'Text Editor',
        buttons: [
            { group: 'textstyle', label: 'Text Style Options',
                buttons: [
                    { type: 'push', label: 'Bold', value: 'bold' },
                    { type: 'separator' },
                    { type: 'push', label: 'Italic', value: 'italic' },
                    { type: 'separator' },
                    { type: 'push', label: 'Underline', value: 'underline' },
                    { type: 'separator' }                    
                    
                ]
            }
        ]
    }
});
myEditor.render();

</script>

</head>

<body class="yui-skin-sam">
<?php
if ($_POST['msgpost']) {
    echo('<p>Editor Posted..</p>');
}
?>
<form name="message" id="message" action="index.php" method="POST">
<textarea name="msgpost" id="msgpost" cols="100" rows="10">
    
</textarea>
<input type="submit" name="submitIt" id="submitIt" value="submit reply">
</form>
</body>
</html>
