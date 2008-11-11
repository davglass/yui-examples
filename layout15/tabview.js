(function() {
		
		var Event = YAHOO.util.Event;
		var Dom = YAHOO.util.Dom;		
        	var Sel = YAHOO.util.Selector;
        	
        	 
        	 
		var layout2 = new YAHOO.widget.Layout(layout.getUnitByPosition('center').get('wrap'), {		    				               
			     					parent:layout,
			     					width: layout.getSizes().center.w,
                                    height: layout.getSizes().center.h,
			     					units:[
			     					    { position: 'top', height: '320px',width:'930px',body:'top2'},
			     				    	    { position: 'center',height:'200px',width:'930px',body:'center2'}
			     			    	  ]
			      	
			      	});	    
			      	
		
		 
		
		layout2.render();
        
	

        	
        	//Create a tabview
        	
        	
        	
				var tabViewOne = new YAHOO.widget.TabView();
				
				//Add tab one
				tabViewOne.addTab( new YAHOO.widget.Tab({
				
				label:'Home',
				content:'',
				active: true,
				id:'home'
				}));
				
				//Add tab two
				tabViewOne.addTab( new YAHOO.widget.Tab({
			
				label:'Products',
				content:'',
				id:'products'
				}));
				
				
				tabViewOne.addTab( new YAHOO.widget.Tab({
					
				label:'Technology',
				content:'',
				id:'technology'
				}));
				
				tabViewOne.addTab( new YAHOO.widget.Tab({
				
				label:'Contact Us',
				content:'<div id="layoutContact"> </div>',
				id:'contactus'
				}));
				
				tabViewOne.addTab( new YAHOO.widget.Tab({
								
				label:'Case Study',
				content:'<table id="navigation"><tr ><td class="pad" ><img src="res/tpincopy.png"/></td><td valign="top"><a href="#">Automated Retail Processes Case Study </a></td> <td class="pad"><img src="res/pdf.gif"/></td> </tr> <tr> <td class="pad"><img src="res/tpincopy.png"/></td> <td class="pad"> <a href="#">Data Synchronization Techniques<br/></a> </td> <td class="pad"><img src="res/pdf.gif"/></td> </tr> <tr> <td class="pad"><img src="res/tpincopy.png"/></td> <td class="pad"><a href="#">Articles</a> </td> </tr></table> ',
				id:'casestudy'
				}));
				
				tabViewOne.addTab( new YAHOO.widget.Tab({
						
				label:'Site Map',
				content:'<div id="sitemaparea"><a href="#" id="homeclick">Home</a><br/><a href="#" id="prodclick">Product</a><br/><a href="#" id="techclick">Technology</a><br/><a href="#" id="contactclick">Contact Us</a></div>',
				id:'sitemap'
				}));
				
				
				
				
				var elTop2 = Dom.get('tabviewone');				
				tabViewOne.appendTo(elTop2);	
		
				
				
				var setMap = function(e)
						{
							YAHOO.util.Event.preventDefault(e); 
							
							
							var elTarget = YAHOO.util.Event.getTarget(e);	
								while (elTarget.id != "sitemaparea") {
								
									//alert(elTarget.nodeName);
									if(elTarget.id.toLowerCase() == "homeclick") {
									
										tabViewOne.set('activeTab',tabViewOne.getTab(0));						
										break;
									} 
									if(elTarget.id.toLowerCase() == "prodclick") 
									{
										tabViewOne.set('activeTab',tabViewOne.getTab(1));						
										break;
										
									}
									if(elTarget.id.toLowerCase() == "techclick") 
									{
										tabViewOne.set('activeTab',tabViewOne.getTab(2));						
										break;
															
									}
									if(elTarget.id.toLowerCase() == "contactclick") 
									{
										tabViewOne.set('activeTab',tabViewOne.getTab(3));						
										break;
															
									}
									else
										{elTarget = elTarget.parentNode;}
						}
							
							
				}
				
				Event.on("sitemaparea", "click",setMap);
				
				
				
		
		
				var tabViewTwo = new YAHOO.widget.TabView();
								
								//Add tab one
								tabViewTwo.addTab( new YAHOO.widget.Tab({
								
								label:'News & Event',
								content:'<table><tr><td width="700px"><div id="newstable"></div></td><td valign="bottom"><div id="mypaginator"></div></td></tr></table>',
								active: true,
								id:'newsevent'
								}));
												
				var elCenter2 = Dom.get('tabviewtwo');
				tabViewTwo.appendTo(elCenter2);
		
		
		
		
		
		
		
		
		var myCustomFormatter = function(elCell, oRecord, oColumn, oData) {
			
		YAHOO.util.Dom.addClass(elCell, "icon");		
		elCell.innerHTML = '&nbsp;<img src="res/chk.jpg"/>';
		};	
		
		
		// Add the custom formatter to the shortcuts
		YAHOO.widget.DataTable.Formatter.myCustom =myCustomFormatter;
			
		var myColumnDefs = [
		            {key:"icon", formatter:"myCustom"},
		            {key:"news"},
		            {key:"image",formatter:YAHOO.widget.DataTable.formatLink}
		            
		                        
		        ];
		
		        var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.newsinfo);
		        
		        myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
		        
		        myDataSource.responseSchema = {
		            
		            fields: [   
		             	
		             		{key:"news"},
		             		{key:"description"},
		             		{key:"image"}
		             	]

		            
		        };
		        
		        		
		 	var oConfigs = {
		                paginator:  new YAHOO.widget.Paginator({
						    containers: ['mypaginator'],
						    pageLinks:3,
						    rowsPerPage: 3 ,						    
						    totalRecords: 7,
						    template: " <center>{PageLinks}</center>"
					})		                
        		};
        		
		        var myDataTable = new YAHOO.widget.DataTable("newstable",myColumnDefs, myDataSource,oConfigs);
		               
		        
		        var myPanel = new YAHOO.widget.Panel("resizablepanel", {
								width:"600px",
								visible:false,
								constraintoviewport:true,
								draggable:true
								
							});
											
			//var elCenter = YAHOO.widget.LayoutUnit.getLayoutUnitById('center2');
									
			myPanel.setHeader("Wayward: Latest News");
			myPanel.setBody('<div id="newsSlider"></div><div class="newsFeeds" id="newsArea"><div class="feedData">No spectrum for MVNOs: TraiMobile virtual network operators will have to purchase air-time on wholesale basis from mobile operators to provide services to customers...</div></div>');
			myPanel.render(document.body);
						
			
			myDataTable.subscribe("linkClickEvent", function(oArgs){
			
			    Event.preventDefault(oArgs.event); 
			    var oRecord = this.getRecord(oArgs.target);
						                 
					myPanel.show();
			               //alert(YAHOO.lang.dump(oRecord.getData("description")));
			               
			               var elNewsFeeds = document.getElementById("newsArea");
			               
			               elNewsFeeds.innerHTML='<div class="feedData">'+YAHOO.lang.dump(oRecord.getData("description"))+'</div>';	               
						                 
            		});
			    
		        
		          var s = 500, f = 93;		           
		          var d = document.getElementById("newsSlider");		           
			  d.innerHTML = '<h3>Adjust font and article size</h3><div id="slider-bg" tabindex="-1" title="Adjust font and article size"><div id="slider-thumb"><img src="res/thumb-n.gif"></div></div>' ;
			  
		
			   
			 //Give the Slider a little UI update when mousing over it..
			 
			 Event.on(d, 'mouseover', function() {
			        Dom.addClass(this, 'over');
			       });
			 
			 Event.on(d, 'mouseout', function() {
			        Dom.removeClass(this, 'over');
                              });
			
			
			var slider = YAHOO.widget.Slider.getHorizSlider('slider-bg', 'slider-thumb', 0, 200);
			
			
			slider.subscribe('change', function(o) {
						
				//On change we will change the width and the font-size of the newsFeed div
			            Dom.setStyle(Sel.query('.newsFeeds'), 'font-size', (f + (o / 3)) + '%');
			            Dom.setStyle(Sel.query('.newsFeeds'), 'width', (s + (o * 2)) + 'px');
			     });	
			     
			     
			     	
			     
        
		 var layout3= new YAHOO.widget.Layout('layoutContact', {
		                     height: 250,
		                     width: 930,
		                     units: [
		                         
		                         { position: 'left', width: 430, body: '<div class="t"><div class="b"><div class="l"><div class="r"><div class="bl"><div class="br"><div class="tl"><div class="tr"><div class="para"><table><tr><td><b>Wayward Brothers Technologies</b></td></tr><tr><td height="6px"></td></tr><tr><td>102,Setellite Street,Ahmedabad,<br/>Gujarat,India</td></tr><tr><td>091-079-XXXXXXX</td></tr><br/></table><table><tr><td></td></tr><tr><td ><b>Contact Us:</b></td></tr><tr><td></td></tr><tr><td>Name:</td> <td><input type="text"/></td></tr><tr><td valign="top">Email:</td> <td><input type="text"/></td></tr><tr><td valign="top">Company:</td> <td><input type="text"/></td></tr><tr><td valign="top">Message:</td> <td><textarea></textarea></td><td valign="bottom"><div id="send"></div></td></tr></table></div></div></div></div></div></div></div></div></div>' ,id:'left'},
		                         { position: 'center',body: 'Center',id:'center'}
		                     ]
		                 });
		layout3.render();	
		
		
		
		
		//var elCenter = Dom.get("center");
		
		//elCenter.innerHTML='<div class="bd"><div id="mapone"></div></div>';
		
		
	
		
		var oSubmitButton= new YAHOO.widget.Button({ 
		                                type: "submit", 
		                                label: "Send", 
		                                id: "submitbutton",
		                                container:"send"
		                                
                                 });
        
   		
	
		
}) (); // End 
