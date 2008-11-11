<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<!--aggregate file path for reset-fonts-grids.css--> 
		<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css">
		
		
		<script>
			YAHOO_config = {
				load: {
					require: ['container', 'menu', 'tabview'],
					onLoadComplete: function(loader) {
						YAHOO.util.Event.onAvailable("basicmenu", function() {
							var oMenu = new YAHOO.widget.Menu("basicmenu2", { visible: true, clicktohide: false });
							oMenu.addItems([
							        { text: "Yahoo! Mail", url: "http://mail.yahoo.com" },
							        { text: "Yahoo! Address Book", url: "http://addressbook.yahoo.com" },
							        { text: "Yahoo! Calendar", url: "http://calendar.yahoo.com" },
							        { text: "Yahoo! Notepad",  url: "http://notepad.yahoo.com" }
							
							    ]);
							
							oMenu.render('basicmenu');
						});
					}
				}
			};
		</script>
		
		<!-- JavaScript files -->
		<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/yuiloader/yuiloader-beta-min.js"></script>
		
		
	</head>
	
	<body class="yui-skin-sam">
		<div id="doc2" class="yui-t2">
			<div id='hd'>
				<img src='http://dev.cutiecloth.com/resources/images/CutieClothLogo150x106.png' />
			</div>
		
	<div id='bd'>
		<div id="yui-main">
			<div class="yui-b">
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
			</div>
		</div>

		<!-- the unwrapped div.yui-b takes a fixed width and alignment based on the class of the top-level containing node -->
		<div class="yui-b">
						<div id='basicmenu'>
				
			</div>
		</div>
		
	</div>

			<div id='ft'>
				
			</div>
		</div>
	</body>
</html>
