(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        var config1 = {
            width: '550px',
            height: '300px',
            dompath: true,
            animate: true
        };

        var config2 = {
            width: '550px',
            height: '300px',
            dompath: true,
            animate: true
        };

        var showToolbar = function() {
            Dom.setStyle('toolbar_cont1', 'display', 'none');
            Dom.setStyle('toolbar_cont2', 'display', 'none');
            Dom.setStyle(this.get('toolbar_cont').parentNode, 'display', 'block');
        };

        var editor1 = new YAHOO.widget.Editor('editor1', config1);
        editor1._defaultToolbar.titlebar = false;
        editor1.on('afterRender', function() {
            Dom.get('toolbar_cont1').appendChild(this.get('toolbar_cont'));
            /*
            * This logic needs to be more thought out, this is simply a demo
            * You don't want to be calling setStyle on every event
            */
            this.on('editorKeyPress', showToolbar, this, true);
            this.on('editorMouseDown', showToolbar, this, true);
        }, editor1, true);
        editor1.render();

        var editor2 = new YAHOO.widget.Editor('editor2', config2);
        editor2._defaultToolbar.titlebar = false;
        editor2.on('afterRender', function() {
            Dom.get('toolbar_cont2').appendChild(this.get('toolbar_cont'));
            /*
            * This logic needs to be more thought out, this is simply a demo
            * You don't want to be calling setStyle on every event
            */
            this.on('editorKeyPress', showToolbar, this, true);
            this.on('editorMouseDown', showToolbar, this, true);
        }, editor2, true);
        editor2.render();
})();
