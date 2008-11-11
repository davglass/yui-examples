(function() {
var Dom = YAHOO.util.Dom,
    Event = YAHOO.util.Event;

    YAHOO.widget.Editor.prototype._renderPanel = function() {
        var panel = new YAHOO.widget.Overlay(this.get('id') + this.EDITOR_PANEL_ID, {
                width: '300px',
                iframe: true,
                visible: false,
                underlay: 'none',
                draggable: false,
                close: false
            });
        this.set('panel', panel);

        this.get('panel').setBody('---');
        this.get('panel').setHeader(' ');
        this.get('panel').setFooter(' ');


        var body = document.createElement('div');
        body.className = this.CLASS_PREFIX + '-body-cont';
        for (var b in this.browser) {
            if (this.browser[b]) {
                Dom.addClass(body, b);
                break;
            }
        }
        Dom.addClass(body, ((YAHOO.widget.Button && (this._defaultToolbar.buttonType == 'advanced')) ? 'good-button' : 'no-button'));

        var _note = document.createElement('h3');
        _note.className = 'yui-editor-skipheader';
        _note.innerHTML = this.STR_CLOSE_WINDOW_NOTE;
        body.appendChild(_note);
        var form = document.createElement('form');
        form.setAttribute('method', 'GET');
        panel.editor_form = form;

        Event.on(form, 'submit', function(ev) {
            Event.stopEvent(ev);
        }, this, true);
        body.appendChild(form);
        var _close = document.createElement('span');
        _close.innerHTML = 'X';
        _close.title = this.STR_CLOSE_WINDOW;
        _close.className = 'close';
        
        Event.on(_close, 'click', this.closeWindow, this, true);

        var _knob = document.createElement('span');
        _knob.innerHTML = '^';
        _knob.className = 'knob';
        panel.editor_knob = _knob;

        var _header = document.createElement('h3');
        panel.editor_header = _header;
        _header.innerHTML = '<span></span>';

        panel.setHeader(' '); //Clear the current header
        panel.appendToHeader(_header);
        _header.appendChild(_close);
        _header.appendChild(_knob);
        panel.setBody(' '); //Clear the current body
        panel.setFooter(' '); //Clear the current footer
        panel.appendToBody(body); //Append the new DOM node to it

        Event.on(panel.element, 'click', function(ev) {
            Event.stopPropagation(ev);
        });

        var fireShowEvent = function() {
            //panel.bringToTop();
        };
        panel.showEvent.subscribe(fireShowEvent, this, true);
        panel.renderEvent.subscribe(function() {
            this._renderInsertImageWindow();
            this._renderCreateLinkWindow();
            this.fireEvent('windowRender', { type: 'windowRender', panel: panel });
        }, this, true);

        if (this.DOMReady) {
            //Render to the element_cont so we can skin it better
            this.get('panel').render(this.get('element_cont').get('element'));
            Dom.addClass(this.get('panel').element, 'yui-editor-panel');
        } else {
            Event.onDOMReady(function() {
                //Render to the element_cont so we can skin it better
                this.get('panel').render(this.get('element_cont').get('element'));
                Dom.addClass(this.get('panel').element, 'yui-editor-panel');
            }, this, true);
        }
        this.get('panel').showEvent.subscribe(function() {
            YAHOO.util.Dom.setStyle(this.element, 'display', 'block');
        });
        return this.get('panel');
    };

})();
