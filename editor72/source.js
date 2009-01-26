(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    var editor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '600px',
        dompath: true
    });
    editor.on('windowCreateLinkRender', function() {
        var body = this._windows.createlink.body;
        var label1 = document.createElement('label');
        label1.innerHTML = '<strong>Wiki Link:</strong>'+
                            '<input type="text" id="' +
                            this.get('id')+'_wikilink_url" name="wikilink_url" size="10" style="width: 200px" value="" />'+
                            '</label>';
        var label2 = document.createElement('label');
        label2.innerHTML = '<strong>Wiki Category:</strong><div id="dropDownMenu_' + this.get('id') + '"></div></label>';
        var _elem = Dom.get(this.get('id') + '_createlink_url');
        Dom.insertBefore(label1, _elem.parentNode);
        Dom.insertBefore(label2, _elem.parentNode);
        //This stops the menu's A's from bubbling the click
        Event.on("dropDownMenu_" + editor.get('id'), 'click', function(ev) {
            Event.stopEvent(ev);
        });
        
    });
    editor.on('afterOpenWindow', function(args) {
        if (args.win.name == 'createlink') {
            //CreateLink panel was opened, update the Menu..
            createDropDownMenu();
        }
    });
    editor.render();

    function createDropDownMenu(namespaces) {
        if (Dom.get("dropDownMenu_" + editor.get('id'))) {
            //Wipe the old button
            Dom.get("dropDownMenu_" + editor.get('id')).innerHTML = '';
        }
               
        //fake namespaces array
        var namespaces = [
            { name: 'Dav #1' },
            { name: 'Dav #2' },
            { name: 'Dav #3' },
            { name: 'Dav #4' },
            { name: 'Dav #5' },
            { name: 'Dav #6' }
        ];

        var menuItems = [];
        for (var i = 0, len = namespaces.length; i < len; ++i) {
            var m = namespaces[i];
            menuItems[i] = {
                text: m.name,
                value: m.name
            };
        }
           
        var dropDownMenu = new YAHOO.widget.Button({
            type: "menu",
            label:"default",
            name: "menuItems",
            menu: menuItems,
            container: "dropDownMenu_" + editor.get('id')
        });
        
        dropDownMenu.getMenu().mouseUpEvent.subscribe(function(ev, args) {
            Event.stopEvent(args[0]);
            dropDownMenu.set("label", args[1].cfg.getProperty("text"));
            dropDownMenu._hideMenu();
        });
    }

})();
