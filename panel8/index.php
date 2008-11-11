<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
		<script type="text/javascript" src="http://www.expotv.com/js/utils/common.js"></script> 
		<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container-min.js"></script> 
		<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/connection/connection-min.js"></script> 
		<script type="text/javascript">
			if (!console)
			{
				var console = {};
				console.log = function()
				{
					return false;
				}
			}
		</script>	
		
		<script type="text/javascript">
			EXPOTV.WishListHandler = new function()
			{
				console.log("enter WishListHandler");
				var self = this;
				this.dialog = new YAHOO.widget.Dialog("wishlist",
														{ 
															visible: false, 
														  	width: "394px",
															height: "auto",
															zIndex: 10,
														  	context: ["target", "tl", "tl"],
															underlay: "shadow"																	  
														}
													  );
				this.dialog.setHeader("head");
				this.dialog.setBody("body");
				this.dialog.setFooter("footer");										 
														 
				this.init = function()
				{
					console.log("enter init");
					self.dialog.render(document.body);
					//self.dialog.configX("x", ["20px"], self.dialog);
					//calling self.dialog.cfg.setProperty("x", 20); here will fail in Firefox
					//self.dialog.cfg.setProperty("x", 20);
				}
				
				this.showDialog = function()
				{
					console.log("enter showDialog");
					//calling self.dialog.cfg.setProperty("x", 20); here will work in Firefox
					self.dialog.show();											  
				}
				
				/************* custom events ******************/
				this.onRender = function()
				{
					console.log("enter onRender");
					//calling self.dialog.cfg.setProperty("x", 20); here will fail in Firefox
					self.dialog.cfg.setProperty("context", []);
					self.dialog.cfg.setProperty("x", 20);
				}
				
				this.dialog.renderEvent.subscribe(this.onRender);
				
				this.onBeforeShow = function()
				{
					console.log("enter onBeforeShow");
					//self.dialog.cfg.setProperty("x", 20);
				}
				
				this.dialog.beforeShowEvent.subscribe(this.onBeforeShow);
				
				this.onHide = function()
				{
					console.log("enter onHide");	
				}
								
				this.dialog.hideEvent.subscribe(this.onHide);
				
				this.test = function()
				{
					self.dialog.cfg.setProperty("visible", false);	
				}
				
				
			}
			
			YAHOO.util.Event.onDOMReady(EXPOTV.WishListHandler.init, true);
		</script>

		<style type="text/css">
			#wishlist_c {
			    position: absolute;
				z-index: 2;
				}
			
			#wishlist_c #wishlist {
				background-color: #F00;
				position: relative;
				overflow: hidden;
				z-index: 2;
				}	
			
			#wishlist_c.shadow .underlay {
				position: absolute;
				top: 5px;
			    bottom: -5px;
			    right: -5px;
			    left: 5px;
			    background-color: #000;
			    opacity: .20;
			    filter: alpha(opacity=20);  /* For IE */
				}
				
			#wishlist .container-close {
				font-size: 2px;
				position: absolute;
			    top: 0px;
			    right: 0px;
			    z-index: 6;
			    height: 12px;
			    width: 12px;
				margin:0px;
    			padding:0px;
			    background-color: #00F;
			    cursor: pointer;
			    visibility: inherit;
				}
				
			#wishlist form {
				display: block;
				height: 0px;
				background-color: #0F0;
				overflow: hidden;
				margin: 0px;
				padding: 0px;				
				}		
			
			#wrapper {
				margin-top: 0px;
				top: 10px;
				}
				
			#target {
				float: left;
				height: 200px;
				width: 300px;
				background-color: #0FF;
				margin-left: 200px;
				margin-bottom: 200px;
				display: inline;
				}
						
		</style>
	</head>
	<body>
		<a href="#" onclick="EXPOTV.WishListHandler.showDialog(); return false;">show dialog</a>
		<a href="#" onclick="EXPOTV.WishListHandler.test(); return false;">test</a>
		<div id="target">
			my target
		</div>

	</body>
</html> 
