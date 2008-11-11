<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Menu 2 TreeView - Prototype</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.0/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" href="menu2tree.css" type="text/css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #bd {
            position: relative;
        }
	</style>
</head>
<body>
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Menu 2 TreeView - Prototype</a></h1></div>
    <div id="bd">
<div id="productsandservices" class="yuimenu">
            <div class="bd">
                <ul class="first-of-type">
                    <li class="yuimenuitem"><a href="http://communication.yahoo.com">Communication</a>
                        <div id="communication" class="yuimenu">
                            <div class="bd">
                                <ul>
                                    <li class="yuimenuitem"><a href="http://360.yahoo.com">360&#176;</a></li>
                                    <li class="yuimenuitem"><a href="http://alerts.yahoo.com">Alerts</a></li>
                                    <li class="yuimenuitem"><a href="http://avatars.yahoo.com">Avatars</a></li>
                                    <li class="yuimenuitem"><a href="http://groups.yahoo.com">Groups</a></li>
                                    <li class="yuimenuitem"><a href="http://promo.yahoo.com/broadband/">Internet Access</a></li>
                                    <li class="yuimenuitem">PIM
                                        <div id="pim" class="yuimenu">
                                            <div class="bd">
                                                <ul class="first-of-type">
                                                    <li class="yuimenuitem"><a href="http://mail.yahoo.com">Yahoo! Mail</a></li>
                                                    <li class="yuimenuitem"><a href="http://addressbook.yahoo.com">Yahoo! Address Book</a></li>
                                                    <li class="yuimenuitem"><a href="http://calendar.yahoo.com">Yahoo! Calendar</a></li>
                                                    <li class="yuimenuitem"><a href="http://notepad.yahoo.com">Yahoo! Notepad</a></li>
                                                </ul>            
                                            </div>
                                        </div>                    
                                    </li>
                                    <li class="yuimenuitem"><a href="http://members.yahoo.com">Member Directory</a></li>
                                    <li class="yuimenuitem"><a href="http://messenger.yahoo.com">Messenger</a></li>
                                    <li class="yuimenuitem"><a href="http://mobile.yahoo.com">Mobile</a></li>
                                    <li class="yuimenuitem"><a href="http://photos.yahoo.com">Photos</a></li>
                                </ul>
                            </div>
                        </div>                    
                    </li>
                    <li class="yuimenuitem"><a href="http://shopping.yahoo.com">Shopping</a>
                        <div id="shopping" class="yuimenu">
                            <div class="bd">                    
                                <ul>
                                    <li class="yuimenuitem"><a href="http://auctions.shopping.yahoo.com">Auctions</a></li>
                                    <li class="yuimenuitem"><a href="http://autos.yahoo.com">Autos</a></li>
                                    <li class="yuimenuitem"><a href="http://classifieds.yahoo.com">Classifieds</a></li>
                                    <li class="yuimenuitem"><a href="http://shopping.yahoo.com/b:Flowers%20%26%20Gifts:20146735">Flowers &#38; Gifts</a></li>
                                    <li class="yuimenuitem"><a href="http://points.yahoo.com">Points</a></li>
                                    <li class="yuimenuitem"><a href="http://realestate.yahoo.com">Real Estate</a></li>
                                    <li class="yuimenuitem"><a href="http://travel.yahoo.com">Travel</a></li>
                                    <li class="yuimenuitem"><a href="http://wallet.yahoo.com">Wallet</a></li>
                                    <li class="yuimenuitem"><a href="http://yp.yahoo.com">Yellow Pages</a></li>
                                </ul>
                            </div>
                        </div>                    
                    </li>
                    <li class="yuimenuitem"><a href="http://entertainment.yahoo.com">Entertainment</a>
                        <div id="entertainment" class="yuimenu">
                            <div class="bd">                    
                                <ul>
                                    <li class="yuimenuitem"><a href="http://fantasysports.yahoo.com">Fantasy Sports</a></li>
                                    <li class="yuimenuitem"><a href="http://games.yahoo.com">Games</a></li>
                                    <li class="yuimenuitem"><a href="http://www.yahooligans.com">Kids</a></li>
                                    <li class="yuimenuitem"><a href="http://music.yahoo.com">Music</a></li>
                                    <li class="yuimenuitem"><a href="http://movies.yahoo.com">Movies</a></li>
                                    <li class="yuimenuitem"><a href="http://music.yahoo.com/launchcast">Radio</a></li>
                                    <li class="yuimenuitem"><a href="http://travel.yahoo.com">Travel</a></li>
                                    <li class="yuimenuitem"><a href="http://tv.yahoo.com">TV</a></li>
                                </ul>                    
                            </div>
                        </div>                                        
                    </li>
                    <li class="yuimenuitem">Information
                        <div id="information" class="yuimenu">
                            <div class="bd">                                        
                                <ul>
                                    <li class="yuimenuitem"><a href="http://downloads.yahoo.com">Downloads</a></li>
                                    <li class="yuimenuitem"><a href="http://finance.yahoo.com">Finance</a></li>
                                    <li class="yuimenuitem"><a href="http://health.yahoo.com">Health</a></li>
                                    <li class="yuimenuitem"><a href="http://local.yahoo.com">Local</a></li>
                                    <li class="yuimenuitem"><a href="http://maps.yahoo.com">Maps &#38; Directions</a></li>
                                    <li class="yuimenuitem"><a href="http://my.yahoo.com">My Yahoo!</a></li>
                                    <li class="yuimenuitem"><a href="http://news.yahoo.com">News</a></li>
                                    <li class="yuimenuitem"><a href="http://search.yahoo.com">Search</a></li>
                                    <li class="yuimenuitem"><a href="http://smallbusiness.yahoo.com">Small Business</a></li>
                                    <li class="yuimenuitem"><a href="http://weather.yahoo.com">Weather</a></li>
                                </ul>                    
                            </div>
                        </div>                                        
                    </li>
                </ul>            
            </div>
    </div>
<div id="ft">&nbsp;</div>
</div>



<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/logger/logger-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/container/container_core-min.js"></script> 
<!--script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/menu/menu-min.js"></script--> 
<script type="text/javascript" src="menu-debug.js"></script>
<script type="text/javascript" src="treemenu.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

YAHOO.example.onMenuReady = function(p_oEvent) {
    // Instantiate and render the menu bar and corresponding submenus
    var oMenu = new YAHOO.widget.Menu("productsandservices", {
        position: 'static',
        visible: true,
        lazyload: false,
        autosubmenudisplay: false,
        clicktohide: false
    });
    oMenu.render();

}
// Initialize and render the menu bar when it is available
YAHOO.util.Event.onContentReady("productsandservices", YAHOO.example.onMenuReady);

YAHOO.log = function(str) {
    console.log(str);
}


</script>
</body>
</html>
