
YAHOO.widget.SimpleEditor = function(elm) {
    this.editor = new YAHOO.widget.Editor(elm, {});

    console.log('Toolbar: ' + this.editor.config.toolbarId);
    console.log('Editor: ' + this.editor);
    this.tbar = new YAHOO.widget.Editor.Toolbar(this.editor.config.toolbarId, this.editor);
    this.trow = this.tbar.addRow();
    this.tbar.addButton(this.trow, new YAHOO.widget.Editor.ToolbarButton('Bold', { event: 'bold', type: 'icontext'}));
    this.tbar.addButton(this.trow, new YAHOO.widget.Editor.ToolbarButton('Italic', { event: 'italic', type: 'icontext'}));
    this.tbar.addButton(this.trow, new YAHOO.widget.Editor.ToolbarButton('Underline', { event: 'underline', type: 'icontext'}));
    this.tbar.addButton(this.trow, new YAHOO.widget.Editor.ToolbarSpacer());
    
    this.editor.registerToolbar(this.tbar);
}

YAHOO.widget.SimpleEditor.prototype = {
    render: function() {
        this.editor.render();
    }
}
