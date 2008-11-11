/**
* @fileoverview Provides the YUI with DHTML form elements
* @author Dav Glass <dav.glass@yahoo.com>
* @version 0.1 
* @class Provides the YUI with DHTML form elements.
* @constructor
* @requires YAHOO.util.Dom
* @requires YAHOO.util.Anim
* @requires YAHOO.util.Event
* @requires YAHOO.widget.Overlay
* @requires YAHOO.Tools
*/
YAHOO.DHTMLForms = function() {
    return {
        currentZindex: 9000,
        selects: [],
        currentOpen: false,
        closeOthers: function() {
            console.log('closeOthers fired...');
            if (this.currentOpen) {
                console.log('Select Open: ' + this.currentOpen);
                this.selects[this.currentOpen].activate();
            }
        }
    }
}();
/**
* @constructor
* DHTML select box.
* @param {String/HTMLElement} elmName HTML element to convert to DHTML
* @param {Object} config Options to pass (not implimented yet)
* @return Object reference
* @type Object
*/
YAHOO.DHTMLForms.SelectBox = function(elmName, config) {
    this.config = {
        open: false
    };
    this.element = $(elmName);
    this.fieldType = 'select';
    if (!this.element) {
        return false;
    }
    /**
    * Custom Event
    * @type Object
    */
    this.onSelect = new YAHOO.util.CustomEvent('onselect', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onShow = new YAHOO.util.CustomEvent('onshow', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onHide = new YAHOO.util.CustomEvent('onhide', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onDestroy = new YAHOO.util.CustomEvent('ondestroy', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onDrawError = new YAHOO.util.CustomEvent('ondrawerror', this);
}
/**
* Renders the Select Box.
*/

YAHOO.DHTMLForms.SelectBox.prototype.render = function() {
    console.log('Render: ' + this.element);
    this.element._rendered = true;
    this.id = (YAHOO.DHTMLForms.selects.length);
    YAHOO.DHTMLForms.selects[YAHOO.DHTMLForms.selects.length] = this;

    this.wrapperid = 'yui_wrap_' + this.element.id;
    this.topcontid = 'yui_' + this.element.id;
    this.topid = 'yui_top_' + this.element.id;
    this.menuid = 'yui_menu_' + this.element.id;
    console.log('this.wrapperid: ' + this.wrapperid);
    console.log('this.topcontid: ' + this.topcontid);
    console.log('this.topid: ' + this.topid);
    console.log('this.menuid: ' + this.menuid);
    var sel = this.element.options.selectedIndex;
    var selValue = this.element.options[this.element.options.selectedIndex].innerHTML;

    var div = $T.create('div', { id: this.wrapperid }, [
        $T.create('div', { id: this.topcontid, className: 'yui_select' }, [
            $T.create('a', { id: this.topid, href: '#' }, selValue),
            $T.create('div', { id: this.menuid, className: 'yui_selectlist', style: 'visibility: hidden; position: absolute;' }, [
                $T.create('ul',
                    function(me, sel) {
                        var arr = [];
                        var ops = me.element.getElementsByTagName('option');
                        for (var i = 0; i < ops.length; i++) {
                            arr[arr.length] = $T.create('li', { name: i, className: ((i == sel) ? ' selected' : '')}, [
                                $T.create('a', ops[i].innerHTML)
                            ]);
                        }
                        me.config.lis = arr;
                        return arr;
                    } (this, sel)
                )
            ])
        ])
    ]);
    this.element.parentNode.insertBefore(div, this.element);
    div.appendChild(this.element);
    this.config.container = new YAHOO.widget.Overlay(this.menuid, { 
        visible: false,
        context: [this.topcontid, 'tl', 'bl']/*,
        effect: {
            effect: YAHOO.widget.Effects.ContainerEffect.BlindUpDown,
            duration: 1
        }*/
        });
    this.config.container.render(document.body);
    this.config.select = new YAHOO.widget.Overlay(this.topcontid, { 
        visible: true,
        context: [this.element, 'tl', 'tl']/*,
        height: $D.getStyle(this.menuid, 'height'),
        width: $D.getStyle(this.menuid, 'width')
        */
        });
    this.config.select.render(document.body);
    $D.setStyle(this.element, 'visibility', 'hidden');
    
    $E.addListener(this.topcontid, 'click', this.activate, this, true);
    $E.addListener(this.config.lis, 'click', this.select, this, true);
}
/**
* Destroys the element.
*/
YAHOO.DHTMLForms.SelectBox.prototype.destroy = function() {
    if (this.element._rendered) {
        this.element._rendered = false;
        this.config.container.destroy();
        this.config.select.destroy();
        $D.setStyle(this.element, 'visibility', 'visible');
        this.onDestroy.fire();
    }
}
/**
* Throws an error message for this field 
*/
YAHOO.DHTMLForms.SelectBox.prototype.drawError = function(str) {
    console.log('drawError: ' + str);
    $D.addClass([this.element, this.topcontid], 'yui_error');
    this.onDrawError.fire();
}
/**
* Clears the error message for this field 
*/
YAHOO.DHTMLForms.SelectBox.prototype.clearError = function() {
    $D.removeClass([this.element, this.topcontid], 'yui_error');
    this.onDrawError.fire();
}
/**
* Menu Activation
*/
YAHOO.DHTMLForms.SelectBox.prototype.activate = function(ev) {
    console.log('Activate..' + $D.getStyle(this.menuid, 'height'));
    if (this.config.open) {
        this.onHide.fire();
        YAHOO.DHTMLForms.currentOpen = false;
        this.config.container.hide();
        this.config.open = false;
        $E.removeListener(document, 'keyup', this._keyPress);
    } else {
        this.onShow.fire();
        YAHOO.DHTMLForms.closeOthers();
        YAHOO.DHTMLForms.currentZindex++;
        this.config.container.cfg.setProperty('context', [this.topcontid, 'tl', 'bl']);
        this.config.container.cfg.setProperty('zIndex', YAHOO.DHTMLForms.currentZindex);

        YAHOO.DHTMLForms.currentOpen = this.id;
        this.config.container.show();
        this.config.open = true;
        $E.addListener(document, 'keyup', this._keyPress, this, true);
        this.config.start_item = this.element.options.selectedIndex;
    }
    if (ev) {
        $E.stopEvent(ev);
    }
}
/**
* Menu Item Select
*/
YAHOO.DHTMLForms.SelectBox.prototype.select = function(ev, tar) {
    var tar = ((!ev) ? tar : $E.getTarget(ev));
    var selected = tar.parentNode.getAttribute('name');
    console.log('Select..' + selected);
    $(this.element).options.selectedIndex = selected;

    $D.replaceClass(this.config.lis, 'selected', '');

    var data = document.createTextNode(tar.innerHTML);
    $(this.topid).innerHTML = '';
    $(this.topid).appendChild(data);
    $D.addClass(tar.parentNode, 'selected');
    if (ev) {
        this.activate();
        $E.stopEvent(ev);
    }
    this.onSelect.fire();
}
/**
* Handle KeyPress
* @private
*/
YAHOO.DHTMLForms.SelectBox.prototype._keyPress = function(ev) {
    var tar = $(this.menuid);
    var key_code = ev.keyCode;
    console.log('Keypress..' + key_code);
    switch (key_code) {
        case 40: //Key Down
            this._selectMove('down');
            break;  
        case 38: //Key Up
            this._selectMove('up');
            break;
        case 13: //Enter
            this.activate();
            break;
        case 27: //Escape
            var lis = this.config.lis;
            var this_tar = null;
            for (var i = 0; i < lis.length; i++) {
                if (lis[i].getAttribute('name') == this.config.start_item) {
                    this_tar = lis[i].firstChild;
                    break;
                }
            }
            if (this_tar) {
                this.select('', this_tar);
            }
            this.activate();
            break;
    }
}
/**
* Handle Move Element
* @private
*/
YAHOO.DHTMLForms.SelectBox.prototype._selectMove = function(dir) {
    var tar = $(this.menuid);
    var cur_choice = $(this.topid).innerHTML;
    var lis = this.config.lis;
    var new_selected = false;
    for (var i = 0; i < lis.length; i++) {
        if (lis[i]) {
            if (lis[i].firstChild) {
                if (lis[i].firstChild.innerHTML == cur_choice) {
                    if (dir == 'up') {
                        if ((i - 1) >= 0) {
                            if (lis[i - 1]) {
                                new_selected = lis[i - 1];
                                break;
                            }
                        }
                    } else {
                        if (lis[i + 1]) {
                            new_selected = lis[i + 1];
                            break;
                        }
                    }
                }
            }
        }
    }
    if (new_selected) {
        var data = document.createTextNode(new_selected.firstChild.innerHTML);
        $(this.topid).innerHTML = '';
        $(this.topid).appendChild(data);
        $D.replaceClass(this.config.lis, 'selected', '');
        $D.addClass(new_selected, 'selected');
        this.select('', new_selected.firstChild);
    }
}
/**
* @constructor
* DHTML Editable text input/text area.
* @param {String/HTMLElement} elmName HTML element to convert to DHTML
* @param {String} eventType The event to trigger the edit [click (default), dblclick]
* @return Object reference
* @type Object
*/
YAHOO.DHTMLForms.TextInput = function(elmName, eventType) {
    this.config = {
        eventType: ((eventType) ? eventType : 'click')
    };
    this.element = $(elmName);
    this.fieldType = this.element.tagName.toLowerCase();
    if (this.fieldType == 'input') {
        this.fieldType = this.element.getAttribute('type').toLowerCase()
    }
    /**
    * Custom Event
    * @type Object
    */
    this.onBlur = new YAHOO.util.CustomEvent('onblur', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onFocus = new YAHOO.util.CustomEvent('onfocus', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onDestroy = new YAHOO.util.CustomEvent('ondestroy', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onDrawError = new YAHOO.util.CustomEvent('ondrawerror', this);
}
/**
* Render the DHTML Element
*/
YAHOO.DHTMLForms.TextInput.prototype.render = function() {
    this.element._rendered = true;
    console.log('TextInput.render()');
    this.wrapperid = 'yui_wrap_' + this.element.id;
    this.topcontid = 'yui_' + this.element.id;

    console.log('this.wrapperid: ' + this.wrapperid);
    console.log('this.topcontid: ' + this.topcontid);
    var div = $T.create('div', { id: this.wrapperid }, [
        $T.create('div', { id: this.topcontid, style: ((this.fieldType == 'textarea') ? 'overflow: auto;' : 'overflow: hidden;'), className: 'yui_textinput' })
    ]);
    this.element.parentNode.insertBefore(div, this.element);
    div.appendChild(this.element);
    $D.addClass(this.element, 'ytextinput');
    
    this.config.container = new YAHOO.widget.Overlay(this.topcontid, {
        visible: true,
        context: [this.element, 'tl', 'tl'],
        height: $D.getStyle(this.element, 'height'),
        width: $D.getStyle(this.element, 'width'),
        iframe: true/*,
        effect: {
            effect: YAHOO.widget.Effects.ContainerEffect.BlindUpDown,
            duration: 1
        }*/
    });
    if (this.element.value) {
        var value = this._fixData();
        this.config.container.setBody(value);
    }
    this.config.container.render(document.body);
    $D.setStyle(this.element, 'visibility', 'hidden');

    $E.addListener(this.topcontid, this.config.eventType, this._handleClick, this, true);
}
/**
* Destroys the Element
*/
YAHOO.DHTMLForms.TextInput.prototype.destroy = function() {
    if (this.element._rendered) {
        this.element._rendered = false;
        if (this.config.container) {
            this.config.container.destroy();
        }
        $D.setStyle(this.element, 'visibility', 'visible');
        this.onDestroy.fire();
    }
}
/**
* Throws an error message for this field 
*/
YAHOO.DHTMLForms.TextInput.prototype.drawError = function(str) {
    console.log('drawError: ' + str);
    $D.addClass([this.element, this.topcontid], 'yui_error');
    this.onDrawError.fire();
}
/**
* Clears the error message for this field 
*/
YAHOO.DHTMLForms.TextInput.prototype.clearError = function() {
    $D.removeClass([this.element, this.topcontid], 'yui_error');
    this.onDrawError.fire();
}
/**
* Handle Click
* @private
*/
YAHOO.DHTMLForms.TextInput.prototype._handleClick = function(ev) {
    this.onFocus.fire();
    console.log('Clicked');
    $E.stopEvent(ev);
    this.config.container.hide();
    $D.setStyle(this.element, 'visibility', 'visible');
    $E.addListener(this.element, 'blur', this._handleBlur, this, true);
    this.element.focus();
}
/**
* Fixes the data. Text/Password Inputs have double quotes removed (")<br>
* Password fields update the container with (*) instead of the content of the input
* @private
*/
YAHOO.DHTMLForms.TextInput.prototype._fixData = function() {
    switch (this.fieldType) {
        case 'textarea':
            var value = this.element.value;
            break;
        case 'password':
            var value = $T.stringRepeat('*', this.element.value.length);
            break;
        default:
            var value = $T.removeQuotes(this.element.value);
            this.element.value = value;
            break;
    }
    return value;
}
/**
* Handle blur event
* @private
*/
YAHOO.DHTMLForms.TextInput.prototype._handleBlur = function(ev) {
    this.onBlur.fire();
    var value = this._fixData();
    this.config.container.setBody(value);
    this.config.container.show();
    $D.setStyle(this.element, 'visibility', 'hidden');
}
/**
* @constructor
* DHTML Check Box.
* @param {String/HTMLElement} elmName HTML element to convert to DHTML
* @return Object reference
* @type Object
*/
YAHOO.DHTMLForms.CheckBox = function(elmName) {
    this.config = {
    };
    this.element = $(elmName);
    this.fieldType = 'checkbox';
    /**
    * Custom Event
    * @type Object
    */
    this.onFocus = new YAHOO.util.CustomEvent('onfocus', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onDestroy = new YAHOO.util.CustomEvent('ondestroy', this);
}
/**
* Render the checkbox
*/
YAHOO.DHTMLForms.CheckBox.prototype.render = function() {
    this.element._rendered = true;
    console.log('CheckBox.render(): ' + this.element.id);
    this.wrapperid = 'yui_wrap_' + this.element.id;
    this.topcontid = 'yui_' + this.element.id;

    console.log('this.wrapperid: ' + this.wrapperid);
    console.log('this.topcontid: ' + this.topcontid);
    var div = $T.create('div', { id: this.topcontid, className: 'yui_checkbox' });
    document.body.appendChild(div);
    $D.addClass(this.element, 'ycontrol');

    this.config.container = new YAHOO.widget.Overlay(this.topcontid, {
        visible: true,
        context: [this.element, 'tl', 'tl'],
        iframe: true/*,
        height: $D.getStyle(this.element, 'height'),
        width: $D.getStyle(this.element, 'width')*/
    });
    this.config.container.render(document.body);
    if (this.element.checked) {
        $D.addClass(this.topcontid, 'yui_checkbox_checked');
    }
    //$D.setStyle(this.element, 'visibility', 'hidden');
    $E.addListener([this.element, this.topcontid], 'click', this._handleClick, this, true);
}
/**
* Destroy the checkbox
*/

YAHOO.DHTMLForms.CheckBox.prototype.destroy = function() {
    if (this.element._rendered) {
        this.element._rendered = false;
        this.config.container.destroy();
        $D.setStyle(this.element, 'visibility', 'visible');
        $D.removeClass(this.element, 'ycontrol');
        this.onDestroy.fire();
    }
}
/**
* Handle click event
* @private
*/
YAHOO.DHTMLForms.CheckBox.prototype._handleClick = function(ev) {
    console.log('CheckBox::_handleClick(): ' + this.element.checked);
    this.onFocus.fire();
    if ($E.getTarget(ev).id == this.topcontid) {
        this.element.checked = ((this.element.checked) ? false : true);
    }
    if (this.element.checked) {
        $D.addClass(this.topcontid, 'yui_checkbox_checked');
    } else {
        $D.removeClass(this.topcontid, 'yui_checkbox_checked');
    }
}
/**
* @constructor
* DHTML Radio Buttons.
* @param {Array} elmArr An array of HTML elements to convert to DHTML
* @return Object reference
* @type Object
*/
YAHOO.DHTMLForms.RadioButtons = function(elmArr) {
    this.config = {
        container: []
    };
    this.fieldType = 'radio';
    this.elements = $(elmArr);
    this.element = {};
    this.topcontid = [];
    /**
    * Custom Event
    * @type Object
    */
    this.onFocus = new YAHOO.util.CustomEvent('onfocus', this);
    /**
    * Custom Event
    * @type Object
    */
    this.onDestroy = new YAHOO.util.CustomEvent('ondestroy', this);
}
/**
* Render the Radio Buttons
*/
YAHOO.DHTMLForms.RadioButtons.prototype.render = function() {
    console.log('RadioButtons.render(): ' + this.elements);
    $D.addClass(this.elements, 'ycontrol');
    this.element._rendered = true;

    for (var i = 0; i < this.elements.length; i++) {
        this.topcontid[i] = 'yui_' + this.elements[i].id;
        this.elements[i]._rendered = true;
        console.log('this.topcontid[' + i + ']: ' + this.topcontid[i]);

        var div = $T.create('div', { id: this.topcontid[i], className: 'yui_radiobutton' });
        document.body.appendChild(div);

        this.config.container[i] = new YAHOO.widget.Overlay(this.topcontid[i], {
            visible: true,
            context: [this.elements[i], 'tl', 'tl'],
            iframe: true/*,
            height: $D.getStyle(this.elements, 'height'),
            width: $D.getStyle(this.element, 'width')*/
        });
        this.config.container[i].render(document.body);
        if (this.elements[i].checked) {
            $D.addClass(this.topcontid[i], 'yui_radiobutton_checked');
        }
        $E.addListener(this.topcontid[i], 'click', this._handleClick, this, true);
    }
    //$D.setStyle(this.elements, 'visibility', 'hidden');
    $E.addListener(this.elements, 'click', this._handleClick, this, true);
}
/**
* Destroy the Radio Buttons
*/
YAHOO.DHTMLForms.RadioButtons.prototype.destroy = function() {
    for (var i = 0; i < this.config.container.length; i++) {
        if (this.elements[i]._rendered) {
            this.config.container[i].destroy();
            this.elements[i]._rendered = false;
        }
    }
    if (this.element._rendered) {
        this.element._rendered = false;
        $D.setStyle(this.elements, 'visibility', 'visible');
        $D.removeClass(this.elements, 'ycontrol');
        this.onDestroy.fire();
    }
}
/**
* Handle click event
* @private
*/
YAHOO.DHTMLForms.RadioButtons.prototype._handleClick = function(ev) {
    console.log('RadioButton::_handleClick()');
    this.onFocus.fire();
    //reset all to unchecked
    $D.removeClass(this.topcontid, 'yui_radiobutton_checked');
    for (var i = 0; i < this.elements.length; i++) {
        console.log('Checking: ' + this.elements[i].id + ' (' + this.elements[i].checked + ')');
        if ($E.getTarget(ev).id == this.topcontid[i]) {
            this.elements[i].checked = true;
        }
        if (this.elements[i].checked == true) {
            $D.addClass(this.topcontid[i], 'yui_radiobutton_checked');
        }
    }
}
/**
* @constructor
* Convert all elements of the Form to DHTML Elements.
* @param {String/HTMLElement} elmName HTML element of the form to convert to DHTML
* @return Array of Object references
* @type Array
*/
YAHOO.DHTMLForms.Form = function(elmName) {
    this.config = {
        fields: []
    };
    this.element = $(elmName);
    this.getElements();
    /**
    * Custom Event
    * @type Object
    */
    this.onDestroy = new YAHOO.util.CustomEvent('ondestroy', this);
}
/**
* Renders all of the form elements
*/
YAHOO.DHTMLForms.Form.prototype.render = function() {
    console.log('Form.render(): ' + this.element.id);
    for (var i = 0; i < this.config.fields.length; i++) {
        if (!this.config.fields[i].element._rendered) {
            this.config.fields[i].render();
        }
    }
}
/**
* Renders a form object by type
* @private
*/
YAHOO.DHTMLForms.Form.prototype._renderType = function(elType) {
    console.log('Form._renderType(' + elType + ')');
    for (var i = 0; i < this.config.fields.length; i++) {
        console.log(this.config.fields[i].fieldType);
        if (this.config.fields[i].fieldType == elType) {
            if (!this.config.fields[i].element._rendered) {
                this.config.fields[i].render();
            }
        }
    }
}
/**
* Renders all Select Boxes in the form
*/
YAHOO.DHTMLForms.Form.prototype.renderSelectBoxes = function() {
    console.log('Form.renderSelectBoxes()');
    this._renderType('select');
}
/**
* Renders all CheckBoxes in the form
*/
YAHOO.DHTMLForms.Form.prototype.renderCheckBoxes = function() {
    console.log('Form.renderCheckBoxes()');
    this._renderType('checkbox');
}
/**
* Renders all Radio Buttons in the form
*/
YAHOO.DHTMLForms.Form.prototype.renderRadioButtons = function() {
    console.log('Form.renderRadioButtons()');
    this._renderType('radio');
}
/**
* Renders all Text Inputs in the form
*/
YAHOO.DHTMLForms.Form.prototype.renderTextInputs = function() {
    console.log('Form.renderTextInputs()');
    this._renderType('text');
    this._renderType('textarea');
    this._renderType('password');
}
/**
* Renders all Text Inputs (type TEXT) in the form
*/
YAHOO.DHTMLForms.Form.prototype.renderTextInputsOnly = function() {
    console.log('Form.renderTextInputsOnly()');
    this._renderType('text');
}
/**
* Renders all Text Inputs (type TEXTAREA) in the form
*/
YAHOO.DHTMLForms.Form.prototype.renderTextAreas = function() {
    console.log('Form.renderTextAreas()');
    this._renderType('textarea');
}
/**
* Renders all Text Inputs (type PASSWORD) in the form
*/
YAHOO.DHTMLForms.Form.prototype.renderPasswords = function() {
    console.log('Form.renderPasswords()');
    this._renderType('password');
}
/**
* Destroys all elements of the form
*/
YAHOO.DHTMLForms.Form.prototype.destroy = function() {
    for (var i = 0; i < this.config.fields.length; i++) {
        this.config.fields[i].destroy();
    }
    this.onDestroy.fire();
}
/**
* Detroys form objects by type
* @private
*/
YAHOO.DHTMLForms.Form.prototype._destroyType = function(elType) {
    console.log('Form._destroyType(' + elType + ')');
    for (var i = 0; i < this.config.fields.length; i++) {
        console.log(this.config.fields[i].fieldType);
        if (this.config.fields[i].fieldType == elType) {
            this.config.fields[i].destroy();
        }
    }
}
/**
* Destroys all Select Boxes in the form
*/
YAHOO.DHTMLForms.Form.prototype.destroySelectBoxes = function() {
    console.log('Form.destroySelectBoxes()');
    this._destroyType('select');
}
/**
* Destroys all CheckBoxes in the form
*/
YAHOO.DHTMLForms.Form.prototype.destroyCheckBoxes = function() {
    console.log('Form.destroyCheckBoxes()');
    this._destroyType('checkbox');
}
/**
* Destroys all Radio Buttons in the form
*/
YAHOO.DHTMLForms.Form.prototype.destroyRadioButtons = function() {
    console.log('Form.destroyRadioButtons()');
    this._destroyType('radio');
}
/**
* Destroys all Text Inputs in the form
*/
YAHOO.DHTMLForms.Form.prototype.destroyTextInputs = function() {
    console.log('Form.destroyTextInputs()');
    this._destroyType('text');
    this._destroyType('textarea');
    this._destroyType('password');
}
/**
* Destroys all Text Inputs (type TEXT) in the form
*/
YAHOO.DHTMLForms.Form.prototype.destroyTextInputsOnly = function() {
    console.log('Form.destroysTextInputsOnly()');
    this._destroyType('text');
}
/**
* Destroys all Text Inputs (type TEXTAREA) in the form
*/
YAHOO.DHTMLForms.Form.prototype.destroyTextAreas = function() {
    console.log('Form.destroyTextAreas()');
    this._destroyType('textarea');
}
/**
* Destroys all Text Inputs (type PASSWORD) in the form
*/
YAHOO.DHTMLForms.Form.prototype.destroyPasswords = function() {
    console.log('Form.destroyPasswords()');
    this._destroyType('password');
}
/**
* Get all elements of the form and convert them to DHTML
* @private
*/
YAHOO.DHTMLForms.Form.prototype.getElements = function() {
    console.log('Form.getElements()');
    console.log('Select Boxes..');
    this.selects = this.element.getElementsByTagName('select');
    for (var i = 0; i < this.selects.length; i++) {
        var newSelect = new YAHOO.DHTMLForms.SelectBox(this.selects[i]);
        this.config.fields[this.config.fields.length] = newSelect;
    }
    console.log('Form Inputs..');
    this.inputs = this.element.getElementsByTagName('input');
    for (var i = 0; i < this.inputs.length; i++) {
        switch (this.inputs[i].getAttribute('type').toLowerCase()) {
            case 'text':
            case 'password':
                console.log('Form Inputs (Text)..' + this.inputs[i].id);
                var newTextInput = new YAHOO.DHTMLForms.TextInput(this.inputs[i]);
                this.config.fields[this.config.fields.length] = newTextInput;
                break;
            case 'checkbox':
                console.log('Form Inputs (Checkbox)..' + this.inputs[i].id);
                var newCheckBox = new YAHOO.DHTMLForms.CheckBox(this.inputs[i]);
                this.config.fields[this.config.fields.length] = newCheckBox;
                break;
        }
    }
    console.log('Text Areas..');
    this.textareas = this.element.getElementsByTagName('textarea');
    for (var i = 0; i < this.textareas.length; i++) {
        var newTextArea = new YAHOO.DHTMLForms.TextInput(this.textareas[i]);
        this.config.fields[this.config.fields.length] = newTextArea;
    }
    console.log('Radio Buttons..');
    this.radios = {};
    for (var i = 0; i < this.inputs.length; i++) {
        var type = this.inputs[i].getAttribute('type').toLowerCase();
        if (type == 'radio') {
            var name = this.inputs[i].getAttribute('name');
            if (!this.radios[name]) {
                this.radios[name] = [];
            }
            this.radios[name][this.radios[name].length] = this.inputs[i].id;
        }
    }
    for (var i in this.radios) {
        console.log('Radio Group: ' + i);
        var newRadioSet = new YAHOO.DHTMLForms.RadioButtons(this.radios[i]);
        this.config.fields[this.config.fields.length] = newRadioSet;
    }
}
//REMOVE - NASTY MSIE HOLDER
if (!console) {
    var console = {
        log: function(str) {
            /*
            var p = document.createElement('p');
            p.innerHTML = str;
            document.body.appendChild(p);
            */
        }
    }
}

