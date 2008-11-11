<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <title>Tabbing Test</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/global.css" />
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/container/assets/container.css">     
    <script type="text/javascript" src="scripts/yui.js"></script>
</head>
<body class="template-D">
<div id="primaryTabs">
    <!-- TABS START -->
    <ul class="yui-nav">
        <li class="selected"><a href="#tab1" title="Overview"><img src="images/DiVosta/tabsD-overview.jpg" alt="Overview" /> TEST</a></li>
        <li><a href="#tab2" title="Amenities"><img src="images/DiVosta/tabsD-amenities.jpg" alt="Amenities" /> TEST</a></li>
    </ul>
    <!-- TABS END -->
    <div class="communityInfo">
        <div class="yui-content">
	        <!-- TAB 1 START -->
	        <div id="tab1">
		        <div>content on tab 1 - sparkling white beaches</div>
	        </div>
	        <!-- TAB 1 END -->
	        <!-- TAB 2 START -->
	        <div id="tab2">
		        <div>i am on the second tab</div>
	        </div>

        </div>
    </div>
</div>
<script type="text/javascript">
// YUI SHORTHAND

var YUD = YAHOO.util.Dom;
var YUE = YAHOO.util.Event;
var YUA = YAHOO.util.Anim;

// TABS

YUE.onAvailable('primaryTabs',function() {
	var tabView = new YAHOO.widget.TabView('primaryTabs');
	var tabView = new YAHOO.widget.TabView('amenitiesTabs');
	var tabView = new YAHOO.widget.TabView('aboutAreaTabs');
    
    
	// onload
	var onloadTarget = YUD.getElementsByClassName('yui-nav')[0].getElementsByTagName('LI');
	for (var x=0; x<onloadTarget.length; x++) {
		if (onloadTarget[x].className=='selected') {
			var newTarget = onloadTarget[x].getElementsByTagName('img')[0];
			var newSrc = newTarget.src.replace('.jpg','-on.jpg');
			newTarget.setAttribute('src',newSrc);
		}
	}

	// on click
	var clickTarget = YUD.getElementsByClassName('yui-nav')[0].getElementsByTagName('IMG');
	for (var i=0; i<clickTarget.length; i++) {

		YUE.addListener(clickTarget[i],'click',function(e){

			var target = YUE.getTarget(e);
			for (var j=0; j<clickTarget.length; j++) {
				if (clickTarget[j].src.indexOf('-on.jpg')!=-1){
					var newSrc = clickTarget[j].src.replace('-on.jpg','.jpg');
					clickTarget[j].setAttribute('src',newSrc);
				}
			}
			if (target.src.indexOf('-on.jpg')==-1){
				var newSrc = target.src.replace('.jpg','-on.jpg');
				target.setAttribute('src',newSrc);
			}

		}, this, true);
	}
    
var ttStrings = new Array();

	ttStrings[ttStrings.length] = {
		term:'sparkling white beaches', 
		id:'sparkling', 
		title:'What are sparkling white beaches?', 
		text:'Lots of sand that looks white, usually highly prized for making sand castles. Found mostly in places with beaches.'
	};

	
	//sets containers for tooltips
	YAHOO.namespace('tooltipsContainer');
	
	//Get all the elements of the given classname of the given tag.
	function getElementsByClassName(classname,tag) {
		 if(!tag) tag = "*";
		 var tagEl =  document.getElementsByTagName(tag);
		 var total_tagEl = tagEl.length;
		 var regexp = new RegExp('\\b' + classname + '\\b');
		 var class_items = new Array();
			 for(var i=0;i<total_tagEl;i++) { //Go thru all the links seaching for the class name
			 var this_item = tagEl[i];
			 if(regexp.test(this_item.className)) {
				  class_items.push(this_item);
			 }
		 }
	return class_items;
	}
	
	//grabs content from the tabs container
	function getString() {
		
		var contentText = getElementsByClassName("communityInfo","div");
		//not the cleanest way of doing something
		if(!contentText[1]){
            alert(contentText[0].innerHTML);
			//contentText[0].innerHTML = searchForString(contentText[0].innerHTML);
		} else {
			//contentText[1].innerHTML = searchForString(contentText[1].innerHTML);
		}
	}
	

	//finds strings and wraps them in anchors and spans
	function searchForString(searchString) {
        /*
		for (var i=0;i<ttStrings.length;i++){
			//can't use array syntax in a regex expression so need to assign to variables
			var term = "term" + i;
			term = ttStrings[i].term;
			var linkId = "linkId" + i;
			linkId = ttStrings[i].id;
			var ttTitle = "ttTitle" + i;
			ttTitle = ttStrings[i].title;
			var ttText = "ttText" + i;
			ttText = ttStrings[i].text;
			
			var check = new RegExp(term);
			
			if(check.test(searchString)){
				//can't set the title attribute in the link as it overwrites the tooltip text
				//searchString = searchString.replace(term, '<a href="javascript:void(0)" class="valueHighlight" id="'+linkId+'"><span>'+term+'</span></a>');
				//tool tip functionality
				var ttId = "ttId" + i;
				YAHOO.tooltipsContainer.ttId = new YAHOO.widget.Tooltip(ttId, {width:'200px',context:''+linkId+'',text:'<strong>'+ttTitle+'</strong><br/>'+ttText+''});
			} else {
				break;
			}
		}
        */
		return searchString;
	}
	
	if (YUD.hasClass(document.body,'template-D')||YUD.hasClass(document.body,'template-E')) getString();
});


</script>

</body>
</html>
