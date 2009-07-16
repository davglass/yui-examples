(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        editing = null;
    
    YAHOO.log('Setup a stripped down config for the editor', 'info', 'example');
    var myConfig = {
        height: '150px',
        width: '380px',
        animate: true,
        toolbar: {
            titlebar: 'My Editor',
            limitCommands: true,
            collapse: true,
            buttons: [
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold', value: 'bold' },
                        { type: 'push', label: 'Italic', value: 'italic' },
                        { type: 'push', label: 'Underline', value: 'underline' },
                        { type: 'separator' },
                        { type: 'select', label: 'Arial', value: 'fontname', disabled: true,
                            menu: [
                                { text: 'Arial', checked: true },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS' },
                                { text: 'Courier New' },
                                { text: 'Lucida Console' },
                                { text: 'Tahoma' },
                                { text: 'Times New Roman' },
                                { text: 'Trebuchet MS' },
                                { text: 'Verdana' }
                            ]
                        },
                        { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                }
            ]
        }
    };

    YAHOO.log('Override the prototype of the toolbar to use a different string for the collapse button', 'info', 'example');
    YAHOO.widget.Toolbar.prototype.STR_COLLAPSE = 'Click to close the editor.';
    YAHOO.log('Create the Editor..', 'info', 'example');
    myEditor = new YAHOO.widget.Editor('editor', myConfig);
    myEditor.on('toolbarLoaded', function() {
        YAHOO.log('Toolbar is loaded, add a listener for the toolbarCollapsed event', 'info', 'example');
        this.toolbar.on('toolbarCollapsed', function() {
            YAHOO.log('Toolbar was collapsed, reposition and save the editors data', 'info', 'example');
            Dom.setXY(this.get('element_cont').get('element'), [-99999, -99999]);
            Dom.removeClass(this.toolbar.get('cont').parentNode, 'yui-toolbar-container-collapsed');
            myEditor.saveHTML();
            editing.innerHTML = myEditor.get('element').value;
            editing = null;
        }, myEditor, true);
    }, myEditor, true);
    myEditor.render();

    Event.on('editable_cont', 'dblclick', function(ev) {
        var tar = Event.getTarget(ev);
        while(tar.id != 'editable_cont') {
            if (Dom.hasClass(tar, 'editable')) {
                YAHOO.log('An element with the classname of editable was double clicked on.', 'info', 'example');
                if (editing !== null) {
                    YAHOO.log('There is an editor open, save its data before continuing..', 'info', 'example');
                    myEditor.saveHTML();
                    //Changed to value because of textarea
                    editing.value = myEditor.get('element').value;
                }
                YAHOO.log('Get the XY position of the Element that was clicked', 'info', 'example');
                var xy = Dom.getXY(tar);
                YAHOO.log('Set the Editors HTML with the elements innerHTML', 'info', 'example');
                //Changed to value because of textarea
                myEditor.setEditorHTML(tar.value);
                YAHOO.log('Reposition the editor with the elements xy', 'info', 'example');
                Dom.setXY(myEditor.get('element_cont').get('element'), xy);
                editing = tar;
            }
            tar = tar.parentNode;
        }
    });

})();

