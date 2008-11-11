var cfmenuIT = new Object();

cfmenuIT.newWindow = new Object();

cfmenuIT.ResetMenuItems = function(oMenu)
{
	var href = null;

	if (oMenu && oMenu.show)
	{
		var menu = oMenu;
	}
	else
	{
		var menus = YAHOO.widget.MenuManager.getMenus();

		for (var key in menus)
		{
			if (key.substr(0, 6).toLowerCase() == "cmsit_")
			{
				var menu = YAHOO.widget.MenuManager.getMenu(key);
				cfmenuIT.ResetMenuItems(menu);
			}
		}

		return;
	}

	menu.show();

	var menuItems = menu.getItems();

	for (var i = 0; i < menuItems.length; i++)
	{
		href = menuItems[i].cfg.getProperty("url").toLowerCase().split(":");
		
		if (href[0] == "cfmenuit")
		{
			var menuItem = YAHOO.util.Dom.get(menuItems[i].id);
			menuItems[i].cfg.setProperty("url", "#", true);
			menuItem.href = new Object();
			menuItem.href = href[1];
			menuItem.windowOptions = new Object();
			menuItem.windowOptions = href[2];
			menuItem.onclick = function() { return cfmenuIT.OpenNewWindow(this); };
			
			menuItems[i]._oAnchor.href = href[1];
			//menuItems[i]._oAnchor.windowOptions = new Object();
			//menuItems[i]._oAnchor.windowOptions = href[2];
			menuItems[i]._oAnchor.onclick = function() { return false; };
		}


		if (menuItems[i]._oSubmenu != null)
		{
			cfmenuIT.ResetMenuItems(menuItems[i]._oSubmenu);	
		}
	}
	
	if (oMenu && oMenu.show && oMenu.parent) menu.hide();
}

cfmenuIT.OpenNewWindow = function(a)
{
	this.newWindow = window.open(a.href, "_blank", a.windowOptions);
	setTimeout("cfmenuIT.newWindow.focus();", 200);
	return false;
}

YAHOO.util.Event.addListener(window, "load", cfmenuIT.ResetMenuItems);