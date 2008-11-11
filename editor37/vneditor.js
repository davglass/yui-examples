//////////////////////////////////////////
//    Yahoo script Editot implementation
//////////////////////////////////////////
(function() {
    var popup = 'none',
        myEditor = null;

        var Dom = YAHOO.util.Dom,
            Event = YAHOO.util.Event;

        var myConfig = {
            height: '300px',
            width: '540px',
            animate: true,
            dompath: true,
            focusAtStart: true
        };

        myEditor = new YAHOO.widget.Editor('editor', myConfig);
        myEditor.on('toolbarLoaded', function() { 
            var testVN = {
                type:  'push', 
                label: 'Insert VN', 
                value: 'insertVN',
                menu: function() {
                    var menu = new YAHOO.widget.Overlay('insertVN', {
                        width: '210px',
                        height: '220px',
                        xy: [-9000,-90000],
                        visible: false
                    });
                }()
            };

            myEditor.toolbar.addButtonToGroup(testVN, 'insertitem');
            myEditor.toolbar.on('insertVNClick', function(ev) {
                if (popup == 'none') {
                    popup = 'block';
                } else {
                    popup = 'none';
                }
                Dom.setStyle('drag2', 'display', popup);
            }, myEditor, true);

            Event.on('table1', 'mousedown', function(ev) {
                var tar = Event.getTarget(ev);
                if (tar && tar.tagName && (tar.tagName.toLowerCase() == 'td') && (tar.innerHTML != '')) {
                    Event.stopEvent(ev);
                    myEditor._focusWindow();
                    myEditor.execCommand('inserthtml', tar.innerHTML);
                }
            });
        });
        myEditor.render();
})();
