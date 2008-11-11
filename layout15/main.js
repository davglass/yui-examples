
(function() { 
	

    var loader = new YAHOO.util.YUILoader({   
            //Get these modules            
            
            require:['reset-fonts-grids', 'utilities', 'resize', 'button','layout','tabview','imageloader','container','datatable','dragdrop','button','slider','selector'],
            filter: 'DEBUG',
            rollup: true,
            onSuccess:function() {
    		YAHOO.util.Get.css('res/mainpage.css');
              YAHOO.util.Event.onDOMReady(function(){
    		var Dom = YAHOO.util.Dom;
    
               layout = new YAHOO.widget.Layout('page',{
                	height:Dom.getClientHeight(),
                	width:930,
                       units: [
                           { position: 'top', height: '120px', body: 'top1',width:930},    
    		      	   { position: 'center', body: 'center1',width:930 }
                    ]
                  }); // End of Layout
    
    
    	      layout.on('resize', function() {
    
    	        layout.set('height',Dom.getClientHeight());
    	      });//End of resize
    
    
    	      layout.on('render',function(){
    	      
    	         	      		
    	      		window.setTimeout(function() {
    	      		
    	      		YAHOO.util.Get.script('data.js?bust=' + (new Date()).getTime());		           
			        YAHOO.util.Get.script('tabview.js?bust=' + (new Date()).getTime());		            	    		
    
			}, 0);
    	      	
    	      		YAHOO.util.Dom.setStyle(document.body, 'visibility', 'visible');
    	      		
    	      		setTimeout(function() {
			     layout.resize();
                	}, 1000);
                	
                	var elTop = document.getElementById('top1');
			elTop.innerHTML='<img src="res/finalnew.png"/>';
    
                	
                	
    
    	      });//End of Layout render
    	      
    
    	      layout.render();
    	      
    
    	      });// End of DOM
    	      
    	      
    	      }// End of OnSuccess
    
    
    
    	}); // End of loader
    
       
    	loader.insert();
})();
