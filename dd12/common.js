(function() {
	// Define all variables
	var	Event = YAHOO.util.Event,
		 	Dom = YAHOO.util.Dom,
			DragDrop = YAHOO.util.DragDropMgr,
			LayerPanel = null,
			LayerItems = null,
			ElementCount = 0,
			ElementArray = new Array(),
			Container = YAHOO.namespace("example.container");

/**
 * @author GAME FACE
 */
	
	var manageEvents = {
		newText: function() {
			manageElements.addNewElementList("Text: " + (ElementCount + 1));
		},
		newImage: function() {
			
		}
	}
	
	var manageElements = {
		addNewElementList: function(type) {
			
			ElementCount++;
			
			var newElement = document.createElement( 'li' );
			newElement.appendChild( document.createTextNode( type ) );
			newElement.id = "l_" + ElementCount;
			
			LayerItems.appendChild( newElement );
			//new YAHOO.util.DDProxy( newElement );
			new YAHOO.example.DDList( newElement );
		}
	}
	
	// Initiate Everything
	function init(o) {
		LayerPanel = Dom.get("layerPanel");
		LayerItems = Dom.get("layerItems");
		
		Container.layerPanel = new YAHOO.widget.Panel("layerPanel",
																	{	visible:true,
																		constraintoviewport:true,
                                                                        xy: [150, 150],
                                                                        width: '150px',
																		close:false
																	} );
		
		Event.on("linkAddText", "click", manageEvents.newText);
		Event.on("linkAddImage", "click", manageEvents.newImage);
		
		Container.layerPanel.render( );
		
	}
	
	YAHOO.example.DDList = function(id, sGroup, config) {
		YAHOO.example.DDList.superclass.constructor.call( this, id, sGroup, config );
	
	    this.logger = this.logger || YAHOO;
        this.logger.log('DDList constructor');


	    var el = this.getDragEl();
	    Dom.setStyle( el, "opacity", 0.67); // The proxy is slightly transparent
	
	};
	
	YAHOO.extend(YAHOO.example.DDList, YAHOO.util.DDProxy, {
	    goingUp: false,
	    lastY: 0,
	    startDrag: function(x, y) {
			this.logger.log(this.id + " startDrag");
	
	        // make the proxy look like the source element
	        var dragEl = this.getDragEl( );
	        var clickEl = this.getEl( );
	        Dom.setStyle( clickEl, "visibility", "hidden" );
	
	        dragEl.innerHTML = clickEl.innerHTML;
	
	        Dom.setStyle( dragEl, "color", Dom.getStyle(clickEl, "color" ) );
	        Dom.setStyle( dragEl, "backgroundColor", Dom.getStyle( clickEl, "backgroundColor" ) );
	        Dom.setStyle( dragEl, "border", "2px solid gray" );
	    },
	
	    endDrag: function( e ) {
			  
			  this.logger.log( this.id + " endDrag" );
			  
			  var srcEl = this.getEl();
	        var proxy = this.getDragEl();
	
	        // Show the proxy element and animate it to the src element's location
	        Dom.setStyle( proxy, "visibility", "" );
	        var a = new YAHOO.util.Motion( 
	            proxy, { 
	                points: { 
	                    to: Dom.getXY( srcEl )
	                }
	            }, 
	            0.2, 
	            YAHOO.util.Easing.easeOut
	        );
	        var proxyid = proxy.id;
	        var thisid = this.id;
	
	        // Hide the proxy and show the source element when finished with the animation
	        a.onComplete.subscribe( function( ) {
	                Dom.setStyle( proxyid, "visibility", "hidden" );
	                Dom.setStyle( thisid, "visibility", "" );
	            });
	        a.animate();
	    },
	
	    onDragDrop: function( e, id ) {
				
	        this.logger.log( this.id + " onDragDrop" );
			  
			  // If there is one drop interaction, the li was dropped either on the list,
	        // or it was dropped on the current location of the source element.
	        if ( DragDrop.interactionInfo.drop.length === 1 ) {
	            
					// The position of the cursor at the time of the drop (YAHOO.util.Point)
	            var pt = DragDrop.interactionInfo.point; 
	
	            // The region occupied by the source element at the time of the drop
	            var region = DragDrop.interactionInfo.sourceRegion; 
	
	            // Check to see if we are over the source element's location.  We will
	            // append to the bottom of the list once we are sure it was a drop in
	            // the negative space (the area of the list without any list items)
	            if (!region.intersect( pt )) {
						 
						 this.logger.log( this.id + " if(!region.intersect(pt))" );
						 
						 var destEl = Dom.get( id );
	                var destDD = DragDrop.getDDById(id);
	                destEl.appendChild(this.getEl());
	                destDD.isEmpty = false;
	                DragDrop.refreshCache();
	            }
	        }
	    },
	
	    onDrag: function( e ) {
				
				this.logger.log( this.id + " onDrag" );
				
	        // Keep track of the direction of the drag for use during onDragOver
	        var y = Event.getPageY( e );
	
	        if ( y < this.lastY ) {
	            this.goingUp = true;
	        } else if ( y > this.lastY ) {
	            this.goingUp = false;
	        }
	
	        this.lastY = y;
	    },
	
	    onDragOver: function(e, id) {
	        
			  this.logger.log(this.id + " onDragOver");
			  var srcEl = this.getEl();
	        var destEl = Dom.get(id);
				
	        // We are only concerned with list items, we ignore the dragover
	        // notifications for the list.
	        if (destEl.nodeName.toLowerCase() == "li") {
	            var orig_p = srcEl.parentNode;
	            var p = destEl.parentNode;
	
	            if ( this.goingUp ) {
	                p.insertBefore(srcEl, destEl); // insert above
	            } else {
	                p.insertBefore(srcEl, destEl.nextSibling); // insert below
	            }
					
	            DragDrop.refreshCache();
	        }
	    }
	});
	
	Event.onDOMReady( init );
})();
