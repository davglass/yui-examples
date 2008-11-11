/**
 * Set up a basic object
 */
o = function()
{

}

o.prototype.prop = "NARF!";

/**
 * Add a prototype function to the object.
 */
o.prototype.init = function()
{
	var oMenuButton = new YAHOO.widget.Button( "menubuttonsrc", 
	        {  
	            type: "split",  
	            menu: "menuoptions"/*,
				onclick: {
						fn: function(a, b, c) {
								alert("NARF!!");
							}
					}*/
	        } 
	    );
oMenuButton.on('click', function() {
	alert("NARF!!");
});
		
	oMenuButton.getMenu().clickEvent.subscribe(
		function(a, b, c) {
				alert("FERT!!!");
			});
}

i = new o();

// Call the function once the page has loaded.
YAHOO.util.Event.on(window, "load", i.init, i, true);
