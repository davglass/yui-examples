/**
 * @author SGrimshaw
 */
YAHOO.namespace("YAHOO.example.Stubbs");

YAHOO.example.Stubbs.init = function() {
	// Set up the layout.
	var layout = new YAHOO.widget.Layout(
		{
			units: [
				{ 
					position: 'top', 
					body: 'hd', 
					height: 70, 
					gutter: '5px' 
				},
				{ 
					position: 'left', 
					id: 'sidebar',
                    body: 'sidebar_layout',
					width: 200, 
					maxWidth: 200,
					resize: true,
					collapse: true, 
					gutter: '0px 5px',
					header: 'Sidebar' 
				},
				{ 
					position: 'center', 
					body: 'content-panel'
				}
			]
		}
	);

	layout.on('render', function() {

        var sidebarLayout = new YAHOO.widget.Layout(layout.getUnitByPosition('left').body, {
            units: [
                { 
                    position: 'bottom',
                    body: 'menu',
                    height: 50
                },
                {
                    position: 'center',
                    body: 'nav'
                }
                ],
            parent: layout
        });
                
        sidebarLayout.render();

    });
    
	layout.render();
	
};

YAHOO.util.Event.on(window, 'load', YAHOO.example.Stubbs.init);

