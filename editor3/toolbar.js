
YAHOO.widget.Editor.Toolbar = function(elm, scope) {
    this.element = elm;
    this.scope = ((scope) ? scope : this);
    console.log('Scope: ' + scope);
    this.prefix = 'toolbar_';
    this.buttons = [];
    this.rows = [];
    this.build();
}
YAHOO.widget.Editor.Toolbar.prototype = {
    build: function() {
        console.log('Build');
        this.wrapperId = $D.generateId('', this.prefix);
        this.wrapper = $T.create('table', { id: this.wrapperId, className: 'toolbar_wrapper' }, [
            $T.create('tbody')
        ]);
        $E.addListener(this.wrapper, 'mousedown', this.handleClick, this, true);
        this.onToolClick = new YAHOO.util.CustomEvent('onToolClick', this.scope);
    },
    render: function() {
        this.element = $(this.element);
        console.log('Render: ' + this.element.id);
        for (var r = 0; r < this.rows.length; r++) {
            var tr = $T.create('tr');
            console.log('Create TR: ' + r);
            for (var d = 0; d < this.rows[r].length; d++) {
                console.log('Create TD: ' + this.rows[r][d]);
                tr.appendChild($T.create('td', [this.rows[r][d].element]));
            }
            var main_tr = $T.create('tr', {id : 'toolbar_row' + r}, [
                $T.create('table', [$T.create('tbody', [ tr ])])
            ]);
            this.wrapper.firstChild.appendChild(main_tr);
        }
        this.element.appendChild(this.wrapper);
    },
    addRow: function() {
        console.log('Add Row: ' + this.rows.length);
        this.rows[this.rows.length] = [];
        return (this.rows.length - 1);
    },
    addButton: function(rId, bObj) {
        console.log('Add Button: (' + rId + ') ' + bObj.name);
        this.buttons[this.buttons.length] = bObj;
        if (!this.rows[rId]) {
            this.rows[rId] = [];
        }
        this.rows[rId][this.rows[rId].length] = bObj;
        return bObj;
    },
    handleClick: function(ev) {
        var tar = $E.getTarget(ev);
        if (tar.tagName.toLowerCase() == 'button') {
            var par = tar.parentNode;
            ref = this.getReference(par);
            if (ref != null) {
                if (!ref.disabled) {
                    //Check for other open drops & close them
                    this.closeDrops(ref.element);
                    console.log('Button Clicked: ' + ref);
                    if ($D.hasClass(tar, 'toolbar_split')) {
                        ref.onSplitClick.fire(tar);
                    } else {
                        ref.onButtonClick.fire(tar);
                    }
                    this.onToolClick.fire(ref);
                } else {
                    console.log('Button Disabled..');
                }
            }
        }
        $E.stopEvent(ev);
    },
    closeDrops: function(notEl) {
        var ref = null;
        for (var i = 0; i < this.buttons.length; i++) {
            if (this.buttons[i].dropOpen && (this.buttons[i].element != notEl)) {
                this.buttons[i].hideDrop();
            }
        }
    },
    getReference: function(tar) {
        var ref = null;
        for (var i = 0; i < this.buttons.length; i++) {
            if (tar == this.buttons[i].element) {
                ref = this.buttons[i];
                break;
            }
        }
        return ref;
    },
    toString: function() {
        return 'Toolbar Instance [' + this.element.id + ']';
    }
}

YAHOO.widget.Editor.ToolbarButton = function(name, attrs) {
    this.name = name;
    this.attrs = attrs;
    this.event = attrs.event;
    this.type = attrs.type;
    this.disabled = false;
    this.dropper = false;
    this.dropOpen = false;
    this.dropContent = '<i>Need Content</i>';
    this.dropOpts = {
        width: '150px',
        style: 'border: 1px solid black; position: absolute; background-color: #ccc;',
        closeOnClick: true
    }
    console.log('Create Button: ' + name);
    this.create();
    this.onButtonClick = new YAHOO.util.CustomEvent('onButtonClick', this);
    this.onSplitClick = new YAHOO.util.CustomEvent('onSplitClick', this);
    this.onDropShow = new YAHOO.util.CustomEvent('onDropShow', this);
    this.onDropHide = new YAHOO.util.CustomEvent('onDropHide', this);
    this.onDropClick = new YAHOO.util.CustomEvent('onDropClick', this);
}
YAHOO.widget.Editor.ToolbarButton.prototype = {
    create: function() {
        this.element = $T.create('a', { id: $D.generateId('', 'toolbar_' + this.event), className: 'toolbar_item toolbar_' + this.event, title: this.name }, [
            $T.create('button', { type: 'button', className: 'toolbar_button toolbar_' + this.type }, this.name)
        ]);
        if (this.type.indexOf('split') != -1) {
            this.splitter = $T.create('button', { type: 'button', className: 'toolbar_button toolbar_split' }, '|');
            this.element.appendChild(this.splitter);
        }
    },
    disable: function() {
        $D.addClass(this.element, 'toolbar_disabled');
        this.disabled = true;
    },
    enable: function() {
        $D.removeClass(this.element, 'toolbar_disabled');
        this.disabled = false;
    },
    setDrop: function(content, opts) {
        this.dropContent = content;
        if (opts) {
            for (var i in opts) {
                this.dropOpts[i] = opts[i];
            }
        }
        if (this.splitter) {
            this.onSplitClick.subscribe(this.makeDrop, true);
        } else {
            this.onButtonClick.subscribe(this.makeDrop, true);
        }
    },
    makeDrop: function() {
        console.log(this);
        if (!this.dropper) {
            this.dropper = new YAHOO.widget.Panel($D.generateId('', 'dropper_'), {
                    visible: false,
                    position: 'absolute',
                    width: this.dropOpts.width,
                    zindex: 5000,
                    underlay: 'shadow',
                    draggable: false,
                    close: false,
                    context: [this.element.parentNode.firstChild, 'tl', 'bl']
                }
            );
            this.dropper.setBody(this.dropContent);
            $T.setStyleString(this.dropper.element, this.dropOpts.style);
            this.dropper.render(this.element.parentNode);
            $E.addListener(this.dropper.element, 'click', this.clickDrop, this, true);
        }
        if (this.dropOpen) {
            this.hideDrop();
        } else {
            this.showDrop();
        }
    },
    hideDrop: function() {
        this.dropOpen = false;
        this.dropper.hide();
        this.onDropHide.fire();
    },
    showDrop: function() {
        this.dropOpen = true;
        this.dropper.show();
        this.onDropShow.fire();
    },
    clickDrop: function() {
        console.log('Drop Clicked..');
        if (this.dropOpts.closeOnClick) {
            this.hideDrop();
        }
        this.onDropClick.fire();
    },
    toString: function() {
        return 'Button [' + this.name + ']';
    }
}

YAHOO.widget.Editor.ToolbarSpacer = function() {
    console.log('Create Spacer');
    this.create();
}
YAHOO.widget.Editor.ToolbarSpacer.prototype = {
    create: function() {
        this.element = $T.create('span', { className: 'toolbar_spacer' });
    },
    toString: function() {
        return 'Spacer Element';
    }
}
