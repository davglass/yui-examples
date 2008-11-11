function bh_initializeListener(){
}

function bh_initializeListenerLoad(){
bh_homePage_behaviors_initializeFastPathCatalog();
YAHOO.util.Event.on('newProducts','submit',bh_homepage_behaviors_showStaticProgressIndicator);
YAHOO.util.Event.on('accesoriesForm','submit',bh_homepage_behaviors_showStaticProgressIndicator);
YAHOO.util.Event.on('importForm','submit',bh_homepage_behaviors_showDynamicProgressIndicator);
bh_homepage_mapping_subscribeInteractiveControls();
}

YAHOO.util.Event.onDOMReady(bh_initializeListenerLoad); 

function bh_homepage_mapping_subscribeInteractiveControls(){
	var re = new RegExp("(browseProductCatalog|launchNIConfigSession).wss");
	var elements = document.getElementsByTagName("a");
	for(i=0;i<elements.length;i++){
  		if ((elements[i].href).match(re)) 
  		{
		YAHOO.util.Event.addListener(elements[i], "click", bh_homepage_behaviors_showStaticProgressIndicator);
		}
	}
}