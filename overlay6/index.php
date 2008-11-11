<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Safari clodeNode fix</title>
    <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/reset-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/fonts-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/files/yui/css/grids-min.css" type="text/css">
            <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <style type="text/css" media="screen">
        @import url( ../css/container_assets/container.css );
        @import url( style.css );
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Panel - cloneNode fix.</a></h1></div>

    <div id="bd">
    <h1>YUI Panel Test</h1>
    <p>Panel div is after this</p>

    <div id="myPanel">
      <div class="hd">This is my panel</div>
      <div id="panelBody" class="bd">
        <script type="text/javascript">
            document.write('<p>dynamic content</p>');
        </script>
      </div>
      <div class="ft"></div>
    </div>

    <p>Panel div is before this</p>

</div>
<div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="../js/yahoo-min.js"></script>
<script type="text/javascript" src="../js/dom-min.js"></script>
<script type="text/javascript" src="../js/event-min.js"></script>
<script type="text/javascript" src="../js/animation-min.js"></script>
<script type="text/javascript" src="../js/dragdrop-min.js"></script>
<script type="text/javascript" src="../js/container-min.js"></script>
<script type="text/javascript">
       var myPanel2;

       function init() {
         myPanel2 = new YAHOO.widget.Panel("myPanel", {visible:true, x:200, y:100});
         myPanel2.render();
       }

       YAHOO.util.Event.addListener(window, "load", init);


YAHOO.widget.Panel.prototype.buildWrapper = function() {
    /*
    var elementParent = this.element.parentNode;
    // THIS IS WHAT WAS BREAKING SAFARI..
    var elementClone = this.element.cloneNode(true);
    this.innerElement = elementClone;
    this.innerElement.style.visibility = "inherit";

    YAHOO.util.Dom.addClass(this.innerElement, YAHOO.widget.Panel.CSS_PANEL);

    var wrapper = document.createElement("DIV");
    wrapper.className = YAHOO.widget.Panel.CSS_PANEL_CONTAINER;
    wrapper.id = elementClone.id + "_c";
    
    wrapper.appendChild(elementClone);
    
    if (elementParent) {
        elementParent.replaceChild(wrapper, this.element);
    }
    */
    var elementParent = this.element.parentNode;
    this.innerElement = this.element;
    this.innerElement.style.visibility = "inherit";

    YAHOO.util.Dom.addClass(this.innerElement, YAHOO.widget.Panel.CSS_PANEL);

    var wrapper = document.createElement("DIV");
    wrapper.className = YAHOO.widget.Panel.CSS_PANEL_CONTAINER;
    wrapper.id = this.element.id + "_c";
    
    
    if (elementParent) {
        elementParent.replaceChild(wrapper, this.element);
        wrapper.appendChild(this.element);
    }
    this.element = wrapper;

    // Resynchronize the local field references

    var childNodes = this.innerElement.childNodes;
    if (childNodes) {
        for (var i=0;i<childNodes.length;i++) {
            var child = childNodes[i];
            switch (child.className) {
                case YAHOO.widget.Module.CSS_HEADER:
                    this.header = child;
                    break;
                case YAHOO.widget.Module.CSS_BODY:
                    this.body = child;
                    break;
                case YAHOO.widget.Module.CSS_FOOTER:
                    this.footer = child;
                    break;
            }
        }
    }

    this.initDefaultConfig(); // We've changed the DOM, so the configuration must be re-tooled to get the DOM references right
}


</script>
</body>
</html>
