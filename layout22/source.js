(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    Event.onDOMReady(function() {
        var layout = new YAHOO.widget.Layout({
            units: [
                { position: 'top', height: 50, body: 'top1', header: 'Top', gutter: '5px' },
                { position: 'right', header: 'Right', width: 300, gutter: '5px', footer: 'Footer', scroll: true, body: 'right1' },
                { position: 'bottom', header: 'Bottom', height: 100, body: 'bottom1', gutter: '5px' },
                { position: 'left', header: 'Left', width: 200, resize: true, body: 'left1', gutter: '5px', collapse: true, close: true, collapseSize: 8, scroll: true, animate: false },
                { position: 'center', body: 'center1' }
            ]
        });
        layout.on('render', function() {
            var left = this.getUnitByPosition('left'),
                collapse1 = document.createElement('div'),
                collapse2,
                //Accessing a private here..
                handle = left._resize._handles.r;
                
                collapse1.className = 'collapse-gutter';
                collapse1.title = left.STR_COLLAPSE;

                collapse2 = collapse1.cloneNode(true);
                collapse1.className += ' collapse-gutter1';
                collapse2.className += ' collapse-gutter2';

                handle.appendChild(collapse1);
                handle.appendChild(collapse2);

                Event.on([collapse1, collapse2], 'click', function(e) {
                    Event.stopEvent(e);
                    left.collapse();
                });
            
        });
        layout.render();
    });


})();
