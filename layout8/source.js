(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var layout = new YAHOO.widget.Layout({
            units: [
                { position: 'top', height: 80, body: 'top1'},
                { position: 'right',width: 300,  body: 'right1' },
                { position: 'bottom', height: 50, body: 'bottom1' },
                { position: 'left', width: 300, body: 'left1'  },
                { position: 'center', body: 'center1' }
            ]
        });
        //Listen for the render event
        layout.on('render', function() {
            //Now give the top unit a zindex to make it and it's menus go above the other units
            layout.getUnitByPosition('top').setStyle('zIndex', 1);
            //Create the menu
            productsMenu();
       });
       layout.render();
      
      
     
    });


})();

            /*
                 Initialize and render the MenuBar when its elements are ready
                 to be scripted.
            */

function productsMenu() {
                /*
                    This code is from this example:
                    http://developer.yahoo.com/yui/examples/menu/topnavfromjs.html
                */

                /*
                     Instantiate a MenuBar:  The first argument passed to the
                     constructor is the id of the element in the page
                     representing the MenuBar; the second is an object literal
                     of configuration properties.
                */

                var oMenuBar = new YAHOO.widget.MenuBar("productsandservices", {
                                                            autosubmenudisplay: true,
                                                            hidedelay: 750,
                                                            lazyload: false });
                                                          
             

                /*
                     Define an array of object literals, each containing
                     the data necessary to create a submenu.
                */

                var aSubmenuData = [
              
                    {
                        id: "communication",
                        itemdata: [
                            { text: "360", url: "http://360.yahoo.com" },
                            { text: "Alerts", url: "http://alerts.yahoo.com" },
                            { text: "Avatars", url: "http://avatars.yahoo.com" },
                            { text: "Groups", url: "http://groups.yahoo.com " },
                            { text: "Internet Access", url: "http://promo.yahoo.com/broadband" },
                            {
                                text: "PIM",
                                submenu: {
                                            id: "pim",
                                            itemdata: [
                                                { text: "Yahoo! Mail", url: "http://mail.yahoo.com" },
                                                { text: "Yahoo! Address Book", url: "http://addressbook.yahoo.com" },
                                                { text: "Yahoo! Calendar",  url: "http://calendar.yahoo.com" },
                                                { text: "Yahoo! Notepad", url: "http://notepad.yahoo.com" }
                                            ]
                                        }
                          
                            },
                            { text: "Member Directory", url: "http://members.yahoo.com" },
                            { text: "Messenger", url: "http://messenger.yahoo.com" },
                            { text: "Mobile", url: "http://mobile.yahoo.com" },
                            { text: "Flickr Photo Sharing", url: "http://www.flickr.com" },
                        ]
                    },

                    {
                        id: "shopping",
                        itemdata: [
                            { text: "Auctions", url: "http://auctions.shopping.yahoo.com" },
                            { text: "Autos", url: "http://autos.yahoo.com" },
                            { text: "Classifieds", url: "http://classifieds.yahoo.com" },
                            { text: "Flowers & Gifts", url: "http://shopping.yahoo.com/b:Flowers%20%26%20Gifts:20146735" },
                            { text: "Real Estate", url: "http://realestate.yahoo.com" },
                            { text: "Travel", url: "http://travel.yahoo.com" },
                            { text: "Wallet", url: "http://wallet.yahoo.com" },
                            { text: "Yellow Pages", url: "http://yp.yahoo.com" }                  
                        ]  
                    },
                  
                    {
                        id: "entertainment",
                        itemdata: [
                            { text: "Fantasy Sports", url: "http://fantasysports.yahoo.com" },
                            { text: "Games", url: "http://games.yahoo.com" },
                            { text: "Kids", url: "http://www.yahooligans.com" },
                            { text: "Music", url: "http://music.yahoo.com" },
                            { text: "Movies", url: "http://movies.yahoo.com" },
                            { text: "Radio", url: "http://music.yahoo.com/launchcast" },
                            { text: "Travel", url: "http://travel.yahoo.com" },
                            { text: "TV", url: "http://tv.yahoo.com" }            
                        ]
                    },
                  
                    {
                        id: "information",
                        itemdata: [
                            { text: "Downloads", url: "http://downloads.yahoo.com" },
                            { text: "Finance", url: "http://finance.yahoo.com" },
                            { text: "Health", url: "http://health.yahoo.com" },
                            { text: "Local", url: "http://local.yahoo.com" },
                            { text: "Maps & Directions", url: "http://maps.yahoo.com" },
                            { text: "My Yahoo!", url: "http://my.yahoo.com" },
                            { text: "News", url: "http://news.yahoo.com" },
                            { text: "Search", url: "http://search.yahoo.com" },
                            { text: "Small Business", url: "http://smallbusiness.yahoo.com" },
                            { text: "Weather", url: "http://weather.yahoo.com" }
                        ]
                    }                  
                ];


                /*
                     Subscribe to the "beforerender" event, adding a submenu
                     to each of the items in the MenuBar instance.
                */

                oMenuBar.subscribe("beforeRender", function () {

                    if (this.getRoot() == this) {

                        this.getItem(0).cfg.setProperty("submenu", aSubmenuData[0]);
                        this.getItem(1).cfg.setProperty("submenu", aSubmenuData[1]);
                        this.getItem(2).cfg.setProperty("submenu", aSubmenuData[2]);
                        this.getItem(3).cfg.setProperty("submenu", aSubmenuData[3]);

                    }

                });

                /*
                     Call the "render" method with no arguments since the
                     markup for this MenuBar instance is already exists in
                     the page.
                */
                oMenuBar.render(); 
              
                }   

