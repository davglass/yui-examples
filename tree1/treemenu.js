YAHOO.widget.Menu.prototype._onParentMenuConfigChange = function(p_sType, p_aArgs, p_oSubmenu) {
    var sPropertyName = p_aArgs[0][0],
        oPropertyValue = p_aArgs[0][1];
    switch(sPropertyName) {
        case "iframe":
        case "constraintoviewport":
        case "hidedelay":
        case "showdelay":
        case "submenuhidedelay":
        case "clicktohide":
        case "effect":
        case "classname":
        case "position":
        case "visible":
            p_oSubmenu.cfg.setProperty(sPropertyName, oPropertyValue);
        break;
    }
    p_oSubmenu.cfg.setProperty('position', 'static');
    p_oSubmenu.cfg.setProperty('xy', [0,0]);
}

YAHOO.widget.Menu.prototype._onParentMenuRender = function(p_sType, p_aArgs, p_oSubmenu) {
    var oParentMenu = p_oSubmenu.parent.parent,
    oConfig = {
        constraintoviewport: oParentMenu.cfg.getProperty("constraintoviewport"),
        xy: [0,0],
        clicktohide: oParentMenu.cfg.getProperty("clicktohide"),
        effect: oParentMenu.cfg.getProperty("effect"),
        showdelay: oParentMenu.cfg.getProperty("showdelay"),
        hidedelay: oParentMenu.cfg.getProperty("hidedelay"),
        submenuhidedelay: oParentMenu.cfg.getProperty("submenuhidedelay"),
        classname: oParentMenu.cfg.getProperty("classname"),
        position: oParentMenu.cfg.getProperty("position"),
        visible: oParentMenu.cfg.getProperty("visible")
    };

    oConfig.position = 'static';
    oConfig.visibility = 'visible';

    if (this.cfg.getProperty("position") == oParentMenu.cfg.getProperty("position")) {
        oConfig.iframe = oParentMenu.cfg.getProperty("iframe");
    }
            
    p_oSubmenu.cfg.applyConfig(oConfig);
    if(!this.lazyLoad) {
        var oLI = this.parent.element;
        if(this.element.parentNode == oLI) {
            this.render();
        } else {
            this.render(oLI);
        }
    }   
}

YAHOO.widget.Menu.prototype.configPosition = function(p_sType, p_aArgs, p_oMenu) {
    var Dom = YAHOO.util.Dom;

    Dom.setStyle(this.element, "position", "static");
    Dom.setStyle(this.element, "display", "none");
    Dom.setStyle(this.element, "visibility", "visible");
}

YAHOO.widget.Menu.prototype.configX = function() {
}
YAHOO.widget.Menu.prototype.configY = function() {
}
YAHOO.widget.Menu.prototype.configXY = function() {
}

