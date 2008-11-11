<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Layout Manager and Links</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/assets/skins/sam/skin.css">     
</head>
<body class="yui-skin-sam">

<div id="right1">
    <b>Right 1</b>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper.</p>

    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper.</p>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse justo nibh, pharetra at, adipiscing ullamcorper.</p>
</div>
<div id="left1">
    <div id="camera">
        </div>

</div>
<div id="center1">
  <a href="http://www.bbcnews.com">click here</a>
    <div id="breadCrumb"></div>

</div>
<div id="innerLeft2">
    <div id="resultDatatable"></div>

</div>

<div id="innerRight2">
    hi right

</div>
<div id="innerCenter2">

   <div id="ddTarget" class="yui-navset">
    <ul class="yui-nav">
        <li class="selected"><a href="#tab1"><em>Where to buy</em></a></li>
        <li><a href="#tab2"><em>Product details</em></a></li>
        <!-- li><a href="#tab3"><em>Tab Three Label</em></a></li-->
    </ul>           
    <div class="yui-content">
        <div id="tab1"><p><span id="purchaseInfo"></span></p></div>
        <div id="tab2"><p><span id="productDetails"></span></p></div>
        <!-- div id="tab3"><p>Tab Three Content</p></div-->
    </div>
</div>


<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/resize/resize-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/layout/layout-beta-min.js"></script> 
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var layout = new YAHOO.widget.Layout({
            units: [
                { position: 'top', height: 30, body: 'top1'},
                { position: 'right',width: 180,  body: 'right1' },
                 { position: 'bottom', height: 50, body: 'bottom1' },
                { position: 'left', width: 200, body: 'left1'},
                 { position: 'center', body: 'center1' }
            ]
        });
        //Listen for the render event
        layout.on('render', function() {
            //Now give the top unit a zindex to make it and it's menus go above the other units
            layout.getUnitByPosition('top').setStyle('zIndex', 1);
            //Create the menu
            var el = layout.getUnitByPosition('center').body;
            //var el = layout.getUnitByPosition('center').get('wrap');
        var layout2 = new YAHOO.widget.Layout(el, {
            parent: layout,
            units: [
                { position: 'top',  height: 30, gutter: '2px' },
                { position: 'right', header: 'Right 2', width: 200, resize: false, proxy: false, body: 'innerRight2', collapse: false},
                { position: 'left',  width: 500, resize: false, proxy: false, body: 'innerLeft2', collapse: false },
                { position: 'center', body: 'innerCenter2', gutter: '2px', scroll: false }
            ]
        });
        layout2.render();
       });
       layout.render();
   
    });

})();


</script>
</body>
</html>
