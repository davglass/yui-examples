<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
  <title>nest layout test</title>

  <!-- YUI -->
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css">
  <!-- Skin CSS files resize.css must load before layout.css -->
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/resize.css">
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/assets/skins/sam/layout.css">
  <!-- Utility Dependencies -->
  <script src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js" type="text/javascript"></script>
  <script src="http://yui.yahooapis.com/2.6.0/build/dragdrop/dragdrop-min.js" type="text/javascript"></script>
  <script src="http://yui.yahooapis.com/2.6.0/build/element/element-beta-min.js" type="text/javascript"></script>
  <!-- Optional Animation Support-->
  <script src="http://yui.yahooapis.com/2.6.0/build/animation/animation-min.js" type="text/javascript"></script>
  <!-- Optional Resize Support -->
  <script src="http://yui.yahooapis.com/2.6.0/build/resize/resize-min.js" type="text/javascript"></script>
  <!-- Source file for the Layout Manager -->
  <script src="http://yui.yahooapis.com/2.6.0/build/layout/layout-debug.js" type="text/javascript"></script>
</head>
<body class="yui-skin-sam">
  <div id="leftmenu"><p> this is left menu </p></div>
  <div id="top2"><p> this is top 2 </p></div>
  <div id="bottom2"><p> this is bottom 2 </p></div>
  <div id="center2"><p> this is center 2 </p></div>
 
  <script type="text/javascript">
  (function() {
    YAHOO.util.Event.onDOMReady(function() {
      var layoutFull = new YAHOO.widget.Layout({
        units: [
          {position: 'left', width: 200, body: 'leftmenu'},
          {position: 'center', body: ''}
        ]
      });
     
      layoutFull.on('render', function() {
        var el = layoutFull.getUnitByPosition('center').body;
        var layoutInner = new YAHOO.widget.Layout(el , {
          parent: layoutFull,
          units: [
            {position: 'top', height: 200, body: 'top2'},
            {position: 'bottom', height: 60, body: 'bottom2'},
            {position: 'center', body: 'center2'}
          ]
        });
        layoutInner.render();
      });
     
      layoutFull.render();
    });
  })();
  </script>
</body>
</html>

