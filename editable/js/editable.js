(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    editable = {
        config: {
            class_name: 'editable'
        },
        init: function() {
            this.clicked = false;
            this.contents = false;
            this.input = false;
            
            var _items = Dom.getElementsByClassName(this.config.class_name);
            Event.addListener(_items, 'dblclick', editable.dbl_click, editable, true);
        },
        dbl_click: function(ev) {
            var tar = Event.getTarget(ev);
            if (!tar) {
                return;
            }
            if (tar.tagName && (tar.tagName.toLowerCase() == 'input')) {
                return false;
            }
            this.check();
            this.clicked = tar;
            this.contents = this.clicked.innerHTML;
            this.make_input();
        },
        make_input: function() {
            this.input = Dom.generateId();

            new_input = document.createElement('input');
            new_input.setAttribute('type', 'text');
            new_input.setAttribute('id', this.input);
            new_input.value = this.contents;
            new_input.setAttribute('size', this.contents.length);
            new_input.className = 'editable_input';

            this.clicked.innerHTML = '';
            this.clicked.appendChild(new_input);
            new_input.select();
            Event.addListener(new_input, 'blur', editable.check, editable, true);
        },
        clear_input: function() {
            if (this.input) {
                if (Dom.get(this.input).value.length > 0) {
                    this.clean_input();
                    this.contents_new = Dom.get(this.input).value;
                    this.clicked.innerHTML = this.contents_new;
                } else {
                    this.contents_new = '[removed]'
                    this.clicked.innerHTML = this.contents_new;
                }
            }
            this.callback();
            this.clicked = false;
            this.contents = false;
            this.input = false;
        },
        clean_input: function() {
            checkText   = new String(Dom.get(this.input).value);
            regEx1      = /\"/g;
            checkText       = String(checkText.replace(regEx1, ''));
            Dom.get(this.input).value = checkText;
        },
        check: function(ev) {
            if (this.clicked) {
                this.clear_input();
            }
        },
        callback: function() {
        }
    }
})();

