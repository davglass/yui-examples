var richedit = {
    config: {
	height: "150px",
	width: "545px",
	dompath: true,
	animate: true,
	toolbar: { 
	    titlebar: 'Text Editing Tools', 
	    collapse: true,
	    draggable: false,
	    buttons: [{ group: 'textstyle',
			buttons: [ 
                            { type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' }, 
                            { type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' }, 
                            { type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' }, 
                            { type: 'separator' }, 
                            { type: 'push', label: 'Subscript', value: 'subscript', disabled: true }, 
                            { type: 'push', label: 'Superscript', value: 'superscript', disabled: true }]
		      },
                      { type: 'separator' }, 
                      { group: 'alignment',
			buttons: [ 
                            { type: 'push', label: 'Align Left CTRL + SHIFT + [', value: 'justifyleft' },
                            { type: 'push', label: 'Align Center CTRL + SHIFT + |', value: 'justifycenter' },
                            { type: 'push', label: 'Align Right CTRL + SHIFT + ]', value: 'justifyright' },
                            { type: 'push', label: 'Justify', value: 'justifyfull' }]
		      }, 
                      { type: 'separator' }, 
                      { group: 'parastyle',
			buttons: [ 
                            { type: 'select', label: 'Normal', value: 'heading', disabled: true, 
			      menu: [ 
                                  { text: 'Normal', value: 'none', checked: true }, 
                                  { text: 'Header 1', value: 'h1' }, 
                                  { text: 'Header 2', value: 'h2' }, 
                                  { text: 'Header 3', value: 'h3' }, 
                                  { text: 'Header 4', value: 'h4' }, 
                                  { text: 'Header 5', value: 'h5' }, 
                                  { text: 'Header 6', value: 'h6' }]
			    }]
		      },
                      { type: 'separator' },
                      { group: 'indentlist',
			buttons: [ 
                            { type: 'push', label: 'Indent', value: 'indent', disabled: true }, 
                            { type: 'push', label: 'Outdent', value: 'outdent', disabled: true }, 
                            { type: 'push', label: 'Create an Unordered List', value: 'insertunorderedlist' }, 
                            { type: 'push', label: 'Create an Ordered List', value: 'insertorderedlist' }] 
		      },
                      { type: 'separator' },
                      { group: 'insertitem',
			buttons: [
                            { type: 'push', label: 'HTML Link CTRL + SHIFT + L', value: 'createlink', disabled: true },
                            { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                            { type: 'push', label: 'Remove Formatting', value: 'removeformat', disabled: true }]
		      }
		] // End buttons
	}
    },

    initialize: function() {
        this.elements = YAHOO.util.Dom.getElementsByClassName('richTextEditor', 'textarea');
        YAHOO.util.Dom.addClass(document.body, "yui-skin-sam");

        if(this.elements.length > 1) {
            this.editors = [];
            this.beforeRender();
        }
    },
    
    beforeRender: function() {
	for (key in this.elements) {
	    var div = document.createElement("DIV");
	    div.className = "editable";
	    YAHOO.util.Dom.setStyle(div, "width", "320px");
	    YAHOO.util.Dom.setStyle(div, "height", this.config.height);
	    YAHOO.util.Dom.setStyle(div, "border", "1px solid #000");
	    YAHOO.util.Dom.setStyle(div, "padding", "5px");
	    YAHOO.util.Dom.insertBefore(div, this.elements[key]);
	    div.innerHTML = this.elements[key].value;
	    div.id = key+"_editor";
	    this.elements[key].style.display = "none";
	    this.editors.push({ id: div.id,
			editor: null, 
			preview: div, 
			textarea: this.elements[key],
			editing: false,
			scope: this
			});

	    YAHOO.util.Event.addListener(div, "dblclick", this.render, this, true);
	}
    },

    render: function(ev) {
        var activeObj = this.getActiveEditor();
        var obj = this.getClickedEditor(YAHOO.util.Event.getTarget(ev));

        if(activeObj && activeObj.id != obj.id) {
            this.deactivate(activeObj, false);
        }
        if(!obj.editing) {
            var config = {};
            for (i in this.config) {
                config[i] = this.config[i];
            }
            obj.editor = new YAHOO.widget.Editor(obj.textarea, config);
            config = null;
            obj.editing = true;
            obj.editor.render();
            obj.editor.on("toolbarLoaded", this.activate, obj);
        }
    },

    activate: function(ev, obj) {
        obj.editor.toolbar.addListener("toolbarCollapsed", richedit.collapsed, obj);
        obj.preview.style.display = "none";
    },

    deactivate: function(obj, isCollapsed) {
        obj.editor.saveHTML();
        obj.preview.innerHTML = obj.textarea.value;
        if(isCollapsed) obj.preview.style.display = "block";
        obj.editing = false;
        obj.editor.destroy();
    },

    collapsed: function(e, obj) {
	obj.scope.deactivate(obj, true);
    },

    getActiveEditor: function() {
	for (key in this.editors) {
	    if(this.editors[key].editing) return this.editors[key];
	}
	return null;
    },

    getClickedEditor: function(el) {
	for (key in this.editors) {
	    if(this.editors[key].id == el.id) return this.editors[key];
	}
	return null;
    }
};
