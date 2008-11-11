(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        layout = null,
        layout2 = null;

    Event.onDOMReady(function() {
        layout = new YAHOO.widget.Layout({
            units: [
                { position: 'top', header: 'Top', body: 'This is the top unit', height: 70 },
                { position: 'right', header: 'Right', body: 'This is the right unit', width: 200},
                { position: 'bottom', header: 'Bottom', body: 'This is the bottom unit', height: 70 },
                { position: 'left', header: 'Left', body: 'This is the left unit', width: 200, scroll: true },
                { position: 'center', body: '' },
            ]
        });
        layout.on('render', function() {
            var el = layout.getUnitByPosition('center').get('wrap');
            layout2 = new YAHOO.widget.Layout(el, {
                units: [
                    { position: 'top', header: 'Top', body: 'This is the top unit', height: 70 },
                    { position: 'right', header: 'Right', body: 'This is the right unit', width: 200},
                    { position: 'bottom', header: 'Bottom', body: 'This is the bottom unit', height: 70 },
                    { position: 'left', header: 'Left', body: 'This is the left unit', width: 200, scroll: true },
                    { position: 'center', body: '<p>This is the center unit.</p><p><a href="#" id="killLayout">Destroy this layout</a></p>' },
                ]
            });
            layout2.on('render', function() {
                Event.on('killLayout', 'click', function(ev) {
                    Event.stopEvent(ev);
                    layout2.destroy();
                    var center = layout.getUnitByPosition('center');
                    //Put the wrap back into the center unit
                    center.get('element').appendChild(center.get('wrap'));
                    //Add a body element back in
                    center.get('wrap').innerHTML = '<div class="yui-layout-bd yui-layout-bd-noft">This is new HTML after the destroy is called.</div>';
                    //Set the .body reference to the new element
                    center.body = center.get('wrap').firstChild;
                    //Add a header
                    center.set('header', 'New Header Added');
                    //Resize the layout to give it sizes..
                    layout.resize();
                });
            });
            layout2.render();
        });
        layout.render();
    });
})();
