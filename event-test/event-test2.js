(function() {
var Dom = YAHOO.util.Dom,
    Event = YAHOO.util.Event,
    Lang = YAHOO.lang;

    var Store = function() {
        return {
            _data: null,
            set: function(attr, value) {
                if (!this._data) {
                    this._data = {};
                }
                this._data[attr] = value;
            }
        }
    };

    var Test = function(el, config) {
        var oConfig = {
            element: el,
            attributes: config || {}
        };


        Test.superclass.constructor.call(this, oConfig.element, oConfig.attributes);    

        this.store = new Store();
        this.control = new Control(this, this.store);
        this.control.init();
    };
    YAHOO.extend(Test, YAHOO.util.Element, {
        init: function(p_oElement, p_oAttributes) {
            Test.superclass.init.call(this, p_oElement, p_oAttributes);
        },
        initAttributes: function(attr) {
            Test.superclass.initAttributes.call(this, attr);
            
            this.setAttributeConfig('title', {
                validator: YAHOO.lang.isString,
                method: function(title) {
                    this.get('element').title = title;
                }
            });

            for (var i = 1; i < 31; i++) {
                this.setAttributeConfig('attr' + i, {
                    validator: YAHOO.lang.isBoolean,
                    value: false
                });
            }
        }
    });

    var Control = function(widget, store) {
        this.widget = widget;
        this.store = store;
    };

    Control.prototype = {
        init: function() {
            for (var i = 1; i < 31; i++) {
                this.widget.on('attr' + i + 'Change', function(ev) {
                    this.store.set(ev.type.replace('Change', ''), ev.newValue);
                }, this, true);
            }
        }
    };

    YAHOO.Test = Test;

})();
