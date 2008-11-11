<html>
  <head>
    <!-- Skin CSS file -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/skin.css">
    <!-- Utility Dependencies -->
    <script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
    <script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/element/element-beta-min.js"></script>
    <!-- Needed for Menus, Buttons and Overlays used in the Toolbar -->
    <script src="http://yui.yahooapis.com/2.6.0/build/container/container_core-min.js"></script>
    <!-- Source file for Rich Text Editor-->
    <script src="http://yui.yahooapis.com/2.6.0/build/editor/simpleeditor-min.js"></script>
    <script>
      var Dom = YAHOO.util.Dom,
      Event = YAHOO.util.Event;

      var myConfig = {
        width: '350px',
        height: '180px',
        handleSubmit: false,
        markup: 'css',
        toolbar: {
          titlebar: '',  
          buttons: [  
            { group: 'textstyle', label: 'Font Style',  
              buttons: [  
                { type: 'push', label: 'Bold', value: 'bold' },  
                { type: 'push', label: 'Italic', value: 'italic' },  
                { type: 'push', label: 'Underline', value: 'underline' }
              ]
            }
          ]
        }
      };

      var myEditor = new YAHOO.widget.SimpleEditor('comment', myConfig);
      myEditor.render();

      function doRenderHTML() {
        myEditor.saveHTML();
        var html = myEditor.get('element').value;
        alert(html);
      }
</script>
</head>
<body class="yui-skin-sam">
<form method="post" action="" id="form1" onsubmit="doRenderHTML();return false;">
    <textarea rows="10" cols="40" name="comment" id="comment">hello</textarea>
</textarea>
<input type="submit">
</form>
</body>
</html>
