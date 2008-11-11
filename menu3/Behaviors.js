function bh_homePage_behaviors_initializeFastPathCatalog(){
    YAHOO.widget.MenuItem.prototype.IMG_ROOT = "javascript/yui/menu/assets/";


    //  Change the path to the submenu indicator images for each menu item

    YAHOO.widget.MenuItem.prototype.SUBMENU_INDICATOR_IMAGE_PATH = "menuarorght8_nrm_1.gif";
    YAHOO.widget.MenuItem.prototype.SELECTED_SUBMENU_INDICATOR_IMAGE_PATH = "menuarorght8_hov_1.gif";
    YAHOO.widget.MenuItem.prototype.DISABLED_SUBMENU_INDICATOR_IMAGE_PATH = "menuarorght8_dim_1.gif";


    //  Change the path to the checkmark images for each menu item

    YAHOO.widget.MenuItem.prototype.CHECKED_IMAGE_PATH = "menuchk8_nrm_1.gif";
    YAHOO.widget.MenuItem.prototype.SELECTED_CHECKED_IMAGE_PATH = "menuchk8_hov_1.gif";
    YAHOO.widget.MenuItem.prototype.DISABLED_CHECKED_IMAGE_PATH = "menuchk8_dim_1.gif";


    // Change the path to the submenu images for each menu bar item

    YAHOO.widget.MenuBarItem.prototype.SUBMENU_INDICATOR_IMAGE_PATH = "menuarodwn8_nrm_1.gif";
    YAHOO.widget.MenuBarItem.prototype.SELECTED_SUBMENU_INDICATOR_IMAGE_PATH = "menuarodwn8_hov_1.gif";
    YAHOO.widget.MenuBarItem.prototype.DISABLED_SUBMENU_INDICATOR_IMAGE_PATH = "menuarodwn8_dim_1.gif";



    YAHOO.example.onMenuBarReady = function(divid) {

        // Instantiate and render the menu bar

        var oMenuBardiv = new YAHOO.widget.MenuBar(divid, { autosubmenudisplay:true, showdelay:250, hidedelay:750, lazyload:true });                
        oMenuBardiv.render();                

    }
    
    YAHOO.log("Rendering fastpath catalogs");
    // Initialize and render the menu bar when it is available in the DOM
	var menubars = document.getElementsByClassName("yuimenubar");
	for(i=0;i<menubars.length;i++){
		YAHOO.log(i + "-" + menubars[i].id);
		YAHOO.example.onMenuBarReady(menubars[i].id);
		YAHOO.log(i + "- executed");
	}
}

function bh_homepage_behaviors_showStaticProgressIndicator(){
	progressIndicator.Static.show();
}

function bh_homepage_behaviors_showDynamicProgressIndicator(){
	if (isEnabled=="true")
		{
		setTimeout("progressIndicator.Dynamic.show()",waitTime);
		}
}

