(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        getHeight = function(elm) {
        var clipped = false,
            _vis = '',
            _pos = '';
        if (elm.style.display == 'none') {
            clipped = true;
            _pos = Dom.getStyle(elm, 'position');
            _vis = Dom.getStyle(elm, 'visiblity');
            Dom.setStyle(elm, 'position', 'absolute');
            Dom.setStyle(elm, 'visiblity', 'hidden');
            Dom.setStyle(elm, 'display', 'block');
        }
        var height = elm.offsetHeight;
        if (height == 'auto') {
            //This is IE, let's fool it
            Dom.setStyle(elm, 'zoom', '1');
            height = elm.clientHeight;
        }
        if (clipped) {
            Dom.setStyle(elm, 'display', 'none');
            Dom.setStyle(elm, 'visiblity', _vis);
            Dom.setStyle(elm, 'position', _pos);
        }
        //Strip the px from the style
        return parseInt(height, 10);
    };

    var myTabs = new YAHOO.widget.TabView('tabs');

    myTabs.addListener('activeTabChange', function(info) {
        var newTab = info.newValue;
        var newTabCont = newTab.get('contentEl');
        if (newTabCont.parentNode != newTab.get('parentNode')) {
            newTabCont.parentNode.removeChild(newTabCont);
            newTab.appendChild(newTabCont);
        }
    });
    myTabs.set('activeIndex', 2);
    myTabs.contentTransition = function(newTab, oldTab) {
        if ( newTab.anim && newTab.anim.isAnimated() ) {
            newTab.anim.stop(true);
        }

        var newTabCont = newTab.get('contentEl');
        if (newTabCont.parentNode != newTab.get('parentNode')) {
            newTabCont.parentNode.removeChild(newTabCont);
            newTab.appendChild(newTabCont);
        }
        
        var newHeight = getHeight(newTab.get('contentEl'));
        var oldHeight = getHeight(oldTab.get('contentEl'));
        Dom.setStyle(newTab.get('contentEl'), 'height', 0);
        newTab.set('contentVisible', true);
        newTab.anim = newTab.anim || new YAHOO.util.Anim( newTab.get('contentEl'), {}, .5);
        newTab.anim.attributes.height = { from: 0, to: newHeight };
        var hideContent = function() {
            oldTab.set('contentVisible', false);
            Dom.setStyle(oldTab.get('contentEl'), 'height', oldHeight + 'px');
            oldTab.anim.onComplete.unsubscribe(hideContent);
        };
        oldTab.anim = oldTab.anim || new YAHOO.util.Anim( oldTab.get('contentEl'), {},  .5);
        oldTab.anim.onComplete.subscribe(hideContent, this, true);
        oldTab.anim.attributes.height = { to: 0 };
        oldTab.anim.animate();
        newTab.anim.animate();
    };
})();

