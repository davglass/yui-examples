(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        counter = 1,
        dds = {};

    var button = new YAHOO.widget.Button({
        label: 'Add Text',
        value: 'addtext',
        container: 'buttons'
    });
    button.on('click', function() {
        var div = document.createElement('div');
        div.innerHTML = 'Some text here';
        div.className = 'text';
        div.id = Dom.generateId();
        Dom.get('play').appendChild(div);
        var resize = new YAHOO.util.Resize(div, {
            status: true,
            proxy: true,
            animate: true
        });
        dds[div.id] = new YAHOO.example.DDRegion(div, '', { cont: 'play' });
        resize.on('resize', function() {
            dds[this.get('id')].unreg();
            dds[this.get('id')] = new YAHOO.example.DDRegion(this.get('element'), '', { cont: 'play' });
        }, resize, true);
    });

    var button2 = new YAHOO.widget.Button({
        label: 'Add Image',
        value: 'addimage',
        container: 'buttons'
    });
    button2.on('click', function() {
        if (counter > 5) {
            counter = 1;
        }
        var img = document.createElement('img');
        img.id = Dom.generateId();
        img.setAttribute('src', 'Photo' + counter + '.jpg');
        Dom.get('play').appendChild(img);
        dds[img.id] = new YAHOO.example.DDRegion(img, '', { cont: 'play' });
        counter++;
    });

    var button3 = new YAHOO.widget.Button({
        label: 'Save',
        value: 'save',
        container: 'buttons'
    });
    button3.on('click', function() {
        button.set('disabled', true);
        button2.set('disabled', true);

        for (var i in dds) {
            if (dds[i] && dds[i].unreg) {
                dds[i].unreg();
                delete dds[i];
            }
        }
        var rs = YAHOO.util.Resize._instances;
        for (var r in rs) {
            var tar = rs[r].get('element');
            if (tar.className != 'text') {
                var xy = Dom.getXY(rs[r].getWrapEl());
            }
            rs[r].destroy();
            if (tar.className != 'text') {
                Dom.setXY(tar, xy);
            }
        }

        var panel = new YAHOO.widget.Panel('show', {
            width: '800px',
            modal: true,
            fixedcenter: true,
            draggable: false
        });
        panel.setHeader('Image Saved State');
        panel.setBody('<div id="play_show">' + Dom.get('play').innerHTML + '</div>');
        panel.render(document.body);
    });


    Event.on('play', 'dblclick', function(ev) {
        var tar = Event.getTarget(ev);
        if (YAHOO.util.Selector.test(tar, '#play div.text')) {
            var r = YAHOO.util.Resize.getResizeById(tar.id);
            r.destroy();
            
            Dom.setStyle('edit', 'display', 'block');
            Dom.get('editor').value = tar.innerHTML;
            Dom.get('editor').select();
            Dom.get('editor').focus();
            var xy = Dom.getXY(tar);
            Dom.setXY('edit', xy);
            var blur = function() {
                tar.innerHTML = Dom.get('editor').value;
                Event.removeListener('editor', 'blur', blur);
                Dom.setStyle('edit', 'display', 'none');
                var resize = new YAHOO.util.Resize(tar, {
                    status: true,
                    proxy: true,
                    animate: true
                });
                resize.on('resize', function() {
                    dds[this.get('id')].unreg();
                    dds[this.get('id')] = new YAHOO.example.DDRegion(this.get('element'), '', { cont: 'play' });
                }, resize, true);
            };
            Event.on('editor', 'blur', blur);
        }
        if (YAHOO.util.Selector.test(tar, '#play img')) {
            if (dds[tar.id]) {
                dds[tar.id].unreg();
                delete dds[tar.id];
                var resize = new YAHOO.util.Resize(tar, {
                    knobHandles: true,
                    handles: 'all',
                    status: true,
                    proxy: true,
                    animate: true
                });
            } else {
                var r = YAHOO.util.Resize.getResizeById(tar.id);
                var xy = Dom.getXY(r.getWrapEl());
                r.destroy();
                Dom.setXY(tar, xy);
                dds[tar.id] = new YAHOO.example.DDRegion(tar, '', { cont: 'play' });
            }
        }
    });

})();
