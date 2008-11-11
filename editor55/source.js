(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        var myEditor = new YAHOO.widget.Editor('editor', {
            height: '300px',
            width: '533px',
            toolbar: {
                collapse: true,
                titlebar: 'Text Editing Tools',
                draggable: false,
                buttons: [
                    { group: 'fontstyle', label: 'Font Name and Size',
                        buttons: [
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
                            { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 75 ], disabled: true }
                        ]
                    },
                    { type: 'separator' },
                    { group: 'textstyle', label: 'Font Style',
                        buttons: [
                            { type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' },
                            { type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' },
                            { type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' },
                            { type: 'separator' },
                            { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                            { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                            
                        ]
                    },
                    { type: 'separator' },
                    { group: 'insertitem', label: 'New Buttons',
                        buttons: [
                            { type: 'push', label: 'Button 1', value: 'button1' },
                            { type: 'push', label: 'Button 2', value: 'button2', disabled: true },
                            { type: 'push', label: 'Button 3', value: 'button3', disabled: true }
                        ]
                    }
                ]
            }
        });
        //Add all the button values to the _disabled object (poorly named, but doesn't meen disabled)
        myEditor._disabled.button2 = true;
        myEditor._disabled.button3 = true;
        //Add buttons 2 and 3 to the always disabled object so they never turn on
        myEditor._alwaysDisabled.button2 = true;
        myEditor._alwaysDisabled.button3 = true;
        //Add button 1 to the always enabled so it never gets disabled
        myEditor._alwaysEnabled.button1 = true;


        myEditor.on('toolbarLoaded', function() {
            //Cache the selected state with some private vars
            var sel1 = false,
                sel2 = false,
                sel3 = false;

            //Listen for the button1 click then activate the other buttons
            this.toolbar.on('button1Click', function() {
                //If the button is selected reverse our logic
                if (this.isSelected('button1')) {
                    sel1 = false;
                    sel2 = false;
                    sel3 = false;
                    this.deselectButton('button1');
                    this.deselectButton('button2');
                    this.deselectButton('button3');
                    this.disableButton('button2');
                    this.disableButton('button3');
                } else {
                    sel1 = true;
                    this.selectButton('button1');
                    this.enableButton('button2');
                    this.enableButton('button3');
                }
                return false;
            });
            //Listen for the button2 click and select itself, since we are returning false we need to manually select the button
            this.toolbar.on('button2Click', function() {
                //If it's selected, reverse our logic
                if (this.isSelected('button2')) {
                    sel2 = false;
                    this.deselectButton('button2');
                } else {
                    sel2 = true;
                    this.selectButton('button2');
                }
                return false;
            });
            //Listen for the button3 click and select itself, since we are returning false we need to manually select the button
            this.toolbar.on('button3Click', function() {
                //If it's selected, reverse our logic
                if (this.isSelected('button3')) {
                    sel3 = false;
                    this.deselectButton('button3');
                } else {
                    sel3 = true;
                    this.selectButton('button3');
                }
                return false;
            });
            //Listen for the afterNodeChange and re-enable/select the buttons that were previously selected
            this.on('afterNodeChange', function() {
                if (sel1) {
                    this.toolbar.selectButton('button1');
                    this.toolbar.enableButton('button2');
                    this.toolbar.enableButton('button3');
                }
                if (sel2) {
                    this.toolbar.selectButton('button2');
                }
                if (sel3) {
                    this.toolbar.selectButton('button3');
                }
            });
        });
        myEditor.render();
})();
