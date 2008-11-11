(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        layout = null;

    Event.onDOMReady(function() {
        layout = new YAHOO.widget.Layout({
            units: [
                { position: 'top', header: 'Top', body: 'This is the top unit', height: 70 },
                { position: 'right', header: 'Right', body: 'This is the right unit', width: 200},
                { position: 'bottom', header: 'Bottom', body: 'This is the bottom unit', height: 70 },
                { position: 'left', id: 'left', width: 200, scroll: true },
                { position: 'center', body: 'This is the center unit'},
            ]
        });
        layout.on('render', function() {
            /*
            * Set the left unit to collapse: true
            * We are setting it after render so we can use the custom units HTML markup.
            */
            layout.getUnitByPosition('left').set('collapse', true);
        });
        layout.render();
    });

    Event.on('hideLeft', 'click', function(ev) {
        Event.stopEvent(ev);
        layout.getUnitByPosition('left').collapse();
    });

})();
