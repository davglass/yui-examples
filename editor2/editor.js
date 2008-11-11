var panels = {};
YAHOO.widget.Editor_Core = {
    instances: [],
    colors: [
      '000000', '111111', '2d2d2d', '434343', '5b5b5b', '737373',
      '8b8b8b', 'a2a2a2', 'b9b9b9', 'd0d0d0', 'e6e6e6', 'ffffff',
      '7f7f00', 'bfbf00', 'ffff00', 'ffff40', 'ffff80', 'ffffbf', 
      '525330', '898a49', 'aea945', 'c3be71', 'e0dcaa', 'fcfae1',
      '407f00', '60bf00', '80ff00', 'a0ff40', 'c0ff80', 'dfffbf',
      '3b5738', '668f5a', '7f9757', '8a9b55', 'b7c296', 'e6ebd5',
      '007f40', '00bf60', '00ff80', '40ffa0', '80ffc0', 'bfffdf',
      '033d21', '438059', '7fa37c', '8dae94', 'acc6b5', 'ddebe2',
      '007f7f', '00bfbf', '00ffff', '40ffff', '80ffff', 'bfffff',
      '033d3d', '347d7e', '609a9f', '96bdc4', 'b5d1d7', 'e2f1f4',
      '00407f', '0060bf', '0080ff', '40a0ff', '80c0ff', 'bfdfff',
      '1b2c48', '385376', '57708f', '7792ac', 'a8bed1', 'deebf6',
      '00007f', '0000bf', '0000ff', '4040ff', '8080ff', 'bfbfff',
      '212143', '373e68', '444f75', '585e82', '8687a4', 'd2d1e1',
      '40007f', '6000bf', '8000ff', 'a040ff', 'c080ff', 'dfbfff',
      '302449', '54466f', '655a7f', '726284', '9e8fa9', 'dcd1df',
      '7f007f', 'bf00bf', 'ff00ff', 'ff40ff', 'ff80ff', 'ffbfff',
      '4a234a', '794a72', '936386', '9d7292', 'c0a0b6', 'ecdae5',
      '7f003f', 'bf005f', 'ff007f', 'ff409f', 'ff80bf', 'ffbfdf',
      '451528', '823857', 'a94a76', 'bc6f95', 'd8a5bb', 'f7dde9',
      '800000', 'c00000', 'ff0000', 'ff4040', 'ff8080', 'ffc0c0',
      '441415', '82393c', 'aa4d4e', 'bc6e6e', 'd8a3a4', 'f8dddd',
      '7f3f00', 'bf5f00', 'ff7f00', 'ff9f40', 'ffbf80', 'ffdfbf',
      '482c1b', '855a40', 'b27c51', 'c49b71', 'e1c4a8', 'fdeee0'
      ],
    fonts: [
        'Arial',
        'Arial Narrow',
        'Arial Black',
        'Comic Sans MS',
        'Courier New',
        'Georgia',
        'System',
        'Times New Roman',
        'Verdana' ],
    fontsizes_convert: {
        '11px': '1',
        '13px': '2',
        '16px': '3',
        '19px': '4',
        '25px': '5',
        '30px': '6',
        '50px': '7'
    },
    fontsizes: [
        '11px',
        '13px',
        '16px',
        '19px',
        '25px',
        '30px',
        '50px'
    ],
    emot_alts: [':)', ':(', ';)', ':D', ';;)',':-/', ':x', ':&quot;&gt;', ':p', ':*',':O', 'X-(', ':&gt;', 'B-)', ':-s','&gt;:)', ':((', ':))', ':|', '/:)','O:)', ':-B', '=;', 'I-)', '8-|',':-&amp;', ':-$', '[-(', ':o)', '8-}', '(:|', '=P~', ':-?', '#-o', '=D&gt;'],
    emots: ['01', '02', '03', '04', '05','06', '07', '08', '09', '10','11', '12', '13', '14', '15','16', '17', '18', '19', '20','21', '22', '23', '24', '25','26', '27', '28', '29', '30','31', '32', '33', '34', '35','37', '39', '40', '47', '50' ]
}

YAHOO.widget.Editor = function(elm, userConfig) {
    this.br = YAHOO.Tools.getBrowserEngine();
    this._timerContent = null;
    this.config = {
        editor: YAHOO.util.Dom.get(elm),
        editorId: YAHOO.widget.Editor_Core.instances.length,
        preText: false,
        menu_status: ['fontface', 'fontsize', 'menu_smiley', 'menu_fontcolor', 'menu_backcolor'],
        events: ['click','dblclick','mousedown','mouseup','keypress','keydown','keyup'],
        disabled: ['anchor', 'unlink', 'forecolor', 'backcolor']
    };

    this.cfg = new YAHOO.util.Config(this);
    this.defaultConfig();
    if (userConfig) {
        this.cfg.applyConfig(userConfig, true);
    }


    this.config.wrapperId = 'yuiEditor_wrapper_' + this.config.editorId;
    panels[this.config.editorId] = {};
    YAHOO.widget.Editor_Core.instances[YAHOO.widget.Editor_Core.instances.length] = this;
    
    // Custom Events
    this.onSave = new YAHOO.util.CustomEvent('onsave', this);
    this.onInit = new YAHOO.util.CustomEvent('oninit', this);
    this.onBeforeRender = new YAHOO.util.CustomEvent('onbeforerender', this);
    this.onAfterRender = new YAHOO.util.CustomEvent('onafterrender', this);
    this.onToolbarClick = new YAHOO.util.CustomEvent('ontoolbarclick', this);
}

YAHOO.widget.Editor.prototype.defaultConfig = function() {
    // Add properties //
    this.cfg.addProperty('showwait', { value:true });
    this.cfg.addProperty('toolbar', { value: 
    [
        ['new','bold','italic','underline', 'spacer', 'justifyleft', 'justifycenter', 'justifyright', 'spacer', 'anchor', 'unlink', 'spacer', 'ul', 'ol', 'spacer', 'indent', 'outdent', 'spacer', ''],
        ['fontface', 'fontsize']
    ]});
}

YAHOO.widget.Editor.prototype.render = function() {
    this.onBeforeRender.fire();
    debug('Rendering: ' + this.config.editor.id + ' (Inst#: ' + this.config.editorId + ')');
    if (this.cfg.getProperty('showwait')) {
        debug('Wait shown by config');
        YAHOO.util.Event.onAvailable(this.config.wrapperId, showWait);
    } else {
        debug('Wait skipped by config');
    }
    if (!this.config.editor) {
        alert('Error, no form field');
        return false;
    }
    if (this.config.editor.value) {
        this.config.preText = this.config.editor.value;
    }
    this._createControls();
    setTimeout('YAHOO.widget.Editor_Core.instances[' + this.config.editorId + ']._setup()', 5000);
    if (this.br.msie) {
        //MSIE HACK
        document.execCommand("BackgroundImageCache", false, true);
    }

    this.onAfterRender.fire();
}
/**
* Assignes all the listeners
*/
YAHOO.widget.Editor.prototype._assignListeners = function() {
    var tb = YAHOO.util.Event.addListener('toolbar_1_' + this.config.editorId, 'mousedown', this._execCommand, this, true);
   debug('ToolBar Listener: ' + tb);

    //Popups
    YAHOO.util.Event.addListener('toolbar_anchor_' + this.config.editorId, 'mousedown', this._showDialog, this, true);
    
    //Menus
    YAHOO.util.Event.addListener('toolbar_forecolor_' + this.config.editorId, 'mousedown', this._showMenu, this, true);
    YAHOO.util.Event.addListener('toolbar_backcolor_' + this.config.editorId, 'mousedown', this._showMenu, this, true);
    YAHOO.util.Event.addListener('toolbar_smiley_' + this.config.editorId, 'mousedown', this._showMenu, this, true);
    
    //DropDowns
    var dd1 = YAHOO.util.Event.addListener('fontface_select_' + this.config.editorId, 'mousedown', this._showSelect, this, true);
   debug('DropDown1: ' + dd1);
    YAHOO.util.Event.addListener('fontsize_select_' + this.config.editorId, 'mousedown', this._showSelect, this, true);

    //iFrame Doc
    for (i in this.config.events) {
        YAHOO.util.Event.addListener(this._doc(), this.config.events[i], this._nodeChange, this, true);
    }
}
/**
* Changes the toolbar to reflect the editor state
* @param {Array} arr Array of toolbar settings to disable/enable/select
*/
YAHOO.widget.Editor.prototype._updateToolbar = function(arr) {
    var one = YAHOO.util.Dom.get('toolbar_1_' + this.config.editorId).getElementsByTagName('span');
    var sel = this._getSelection();
    
    for (var i = 0; i < one.length; i++) {
        if (YAHOO.util.Dom.hasClass(one[i], 'yui_button_sel')) {
            YAHOO.util.Dom.replaceClass(one[i], 'yui_button_sel', 'yui_button');
        }
    }

    if (arr.length) {
        for (var i = 0; i < arr.length; i++) {
            if (YAHOO.util.Dom.get('toolbar_' + arr[i] + '_' + this.config.editorId)) {
                if (!YAHOO.util.Dom.hasClass('toolbar_' + arr[i] + '_' + this.config.editorId, 'yui_button_sel')) {
                    YAHOO.util.Dom.replaceClass('toolbar_' + arr[i] + '_' + this.config.editorId, 'yui_button', 'yui_button_sel');
                }
            }
        }
    }
    if (sel != '') {
        for (var i = 0; i < this.config.disabled.length; i++) {
            if (YAHOO.util.Dom.hasClass('toolbar_' + this.config.disabled[i] + '_' + this.config.editorId, 'yui_button_disable')) {
                YAHOO.util.Dom.replaceClass('toolbar_' + this.config.disabled[i] + '_' + this.config.editorId, 'yui_button_disable', 'yui_button');
            }
        }
    } else {
        for (var i = 0; i < this.config.disabled.length; i++) {
            if (!YAHOO.util.Dom.hasClass('toolbar_' + this.config.disabled[i] + '_' + this.config.editorId, 'yui_button_disable')) {
                YAHOO.util.Dom.replaceClass('toolbar_' + this.config.disabled[i] + '_' + this.config.editorId, 'yui_button_sel', 'yui_button_disable');
                YAHOO.util.Dom.replaceClass('toolbar_' + this.config.disabled[i] + '_' + this.config.editorId, 'yui_button', 'yui_button_disable');
            }
        }
    }
}
/**
* Handles changes to the IFRAME
* @param {Object} ev Event object
*/
YAHOO.widget.Editor.prototype._nodeChange = function(ev) {
    var tar = YAHOO.util.Event.getTarget(ev, 1);
    var proc = true;
    var actions = [];
    var sel = this._getSelection();
    var tag = tar.tagName.toLowerCase();

    //Lists
    switch (tag) {
        case 'b':
        case 'strong':
            actions[actions.length] = 'bold';
            break;
        case 'i':
        case 'em':
            actions[actions.length] = 'italic';
            break;
        case 'u':
            actions[actions.length] = 'underline';
            break;
        case 'li':
            actions[actions.length] = tar.parentNode.tagName.toLowerCase();
            var str = 'List: ' + tar.parentNode.tagName.toLowerCase();
            break;
    }

    //Bold
    if (tar.style.fontWeight) {
        if (tar.style.fontWeight == 'bold') {
            actions[actions.length] = 'bold';
        }
    }
    
    //Italic
    if (tar.style.fontStyle) {
        if (tar.style.fontStyle == 'italic') {
            actions[actions.length] = 'italic';
        }
    }
    
    //Underline
    if (tar.style.textDecoration) {
        if (tar.style.textDecoration == 'underline') {
            actions[actions.length] = 'underline';
        }
    }
    
    //Alignment
    actions[actions.length] = 'justify' + this._doc().queryCommandValue('justifycenter');
    
    //FontName
    var name = this._doc().queryCommandValue('FontName');
    YAHOO.util.Dom.get('fontface_select_' + this.config.editorId).innerHTML = ((name) ? name : 'Verdana');

    //FontSize
    var size = parseInt(this._doc().queryCommandValue('FontSize'));
    if (!size) {
        size = 2;
    }
    //debug('Set Size: ' + size);
    YAHOO.util.Dom.get('fontsize_select_' + this.config.editorId).innerHTML = size;
    
    this._updateToolbar(actions);

}
/**
* Changes the Font state
* @param {Object} ev Event object
*/
YAHOO.widget.Editor.prototype._changeFont = function(ev) {
    debug('_changeFont().. fired');
    var tar = YAHOO.util.Event.getTarget(ev).parentNode.parentNode;
   debug('Target : ' + tar.id);
    if (tar.id == 'menu_fontsize_' + this.config.editorId) {
       debug('Target ParentNode: ' + YAHOO.util.Event.getTarget(ev).parentNode);
       debug('Target ParentNode.style: ' + YAHOO.util.Event.getTarget(ev).parentNode.style.fontSize);
        var font = YAHOO.Tools.removeQuotes(YAHOO.util.Event.getTarget(ev).parentNode.style.fontSize);
        var action = 'FontSize';
        tar.parentNode.firstChild.innerHTML = YAHOO.widget.Editor_Core.fontsizes_convert[font];
    } else {
        var font = YAHOO.Tools.removeQuotes(YAHOO.util.Event.getTarget(ev).parentNode.style.fontFamily);
       debug('Selected Font: ' + font);
        var action = 'FontName';
        tar.parentNode.firstChild.innerHTML = font;
    }
    
    
    this._showSelect('', tar);
    
    //Change Font
    //if (this.br.msie && (action == 'FontSize')) {
    if (action == 'FontSize') {
        //MSIE HACK
        font = YAHOO.widget.Editor_Core.fontsizes_convert[font];
    }
    this._execCommand('', action, font);
    
    YAHOO.util.Event.stopEvent(ev);
}
/**
* Hides a drop down menu
* @param {String} state The display state of the menu
* @param {HTMLElement} tar The Element target
*/
YAHOO.widget.Editor.prototype._hideMenus = function(state, tar) {
    if (state == 'none') {
        //opening, hide others
        for (var i in this.config.menu_status) {
            if (this.config.menu_status[i] == true) {
                this.config.menu_status[i] = false;
                YAHOO.util.Dom.setStyle(i, 'display', 'none');
            }
        }
        if (tar) {
            this.config.menu_status[tar.id] = true;
        }
    } else {
        if (tar) {
            this.config.menu_status[tar.id] = false;
        }
    }
}
/**
* Shows a DHTML SELECT drop down menu
* @param {Object} ev The Event object
* @param {HTMLElement} tar The Element target
*/
YAHOO.widget.Editor.prototype._showSelect = function(ev, tar) {
    if (ev) {
        var tar = YAHOO.util.Event.getTarget(ev).parentNode.getElementsByTagName('ul')[0];
    }
   debug('Target: _showSelect: ' + tar);
    var state = YAHOO.util.Dom.getStyle(tar, 'display');
    
    this._hideMenus(state, tar);
    
    as = tar.getElementsByTagName('a');
    
    for (var i = 0; i < as.length; i++) {
        if (state == 'none') {
            YAHOO.util.Event.addListener(as[i], 'mousedown', this._changeFont, this, true);
        } else {
            YAHOO.util.Event.removeListener(as[i], 'mousedown', this._changeFont);
        }
    }
    
    YAHOO.util.Dom.setStyle(tar, 'display', ((state == 'block') ? 'none' : 'block'));
       
    if (ev) {
        YAHOO.util.Event.stopEvent(ev);
    }
}
/**
* Change the color
* @param {Object} ev The Event object
*/
YAHOO.widget.Editor.prototype._changeColor = function(ev) {
    var tar = YAHOO.util.Event.getTarget(ev);
    var color = '#' + tar.className.substring(6);
    var action = tar.parentNode.id.substring(5);

    this._execCommand('', action, color);

    
    this._showMenu('', tar.parentNode);
    if (ev) {
        YAHOO.util.Event.stopEvent(ev);
    }
}
/**
* Insert an Emot Icon
* @param {Object} ev The Event object
*/
YAHOO.widget.Editor.prototype._insertEmot = function(ev) {
    var tar = YAHOO.util.Event.getTarget(ev);
    var img = tar.src;
    this._showMenu('', tar.parentNode.parentNode);
    this._execCommand('', 'InsertImage', img);
}
/**
* handle the dialog's callback
*/
YAHOO.widget.Editor.prototype._handleDialog = function(ev) {
    //NEEDS WORK
    debug('Saved....(' + this.id + ')');
    var url = YAHOO.util.Dom.get(this.id).getElementsByTagName('input')[0].value;
    // Fix some URL issues...
    if ((url.indexOf('@') != -1) && (url.indexOf('mailto') == -1)) {
        //Email Address
        url = 'mailto:' + url;
    } else if ((url.indexOf('://') == -1) && (url.indexOf('@') == -1) && (url.indexOf('#') == -1)) {
        //Web Address
        url = 'http://' + url;
    }
    debug('URL: ' + url);
    debug('Editor: ' + this._editorId);
    YAHOO.widget.Editor_Core.instances[this._editorId]._execCommand('', 'anchor', url);
    this.hide();
    YAHOO.util.Event.stopEvent(ev);
}
/**
* Show the Dialog
*/
YAHOO.widget.Editor.prototype._showDialog = function(ev, tar) {
    var tar = YAHOO.util.Event.getTarget(ev);
    debug('Event ID: ' + tar.id);
    if (YAHOO.util.Dom.hasClass(tar, 'yui_button_disable')) {
        debug('Dialog stopped.. Item Disabled');
    } else {
        if (!panels[this.config.editorId][tar.id]) {
            var handleCancel = function() {
                this.hide();
            }
            var myButtons = [ { text:"Add Link", handler: this._handleDialog },
                  { text:"Cancel", handler:handleCancel, isDefault:true } ];

            panels[this.config.editorId][tar.id] = new YAHOO.widget.Dialog('yuiEditor_dialog_' + tar.id, {
                close: true,
                fixedcenter: true,
                visible: true,
                postmethod: 'none',
                buttons: myButtons,
                underlay: "shadow",
                iframe: true,
                modal: true,
                module: true,
                effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5}
            });
            panels[this.config.editorId][tar.id]._editorId = this.config.editorId;

        }
        panels[this.config.editorId][tar.id].setHeader('Add a Link');
        panels[this.config.editorId][tar.id].setBody('<div>URL: <input type="text" name="url" id="url"></div>');
        panels[this.config.editorId][tar.id].render(YAHOO.util.Dom.get(this.config.wrapperId));
        panels[this.config.editorId][tar.id].show();
        panels[this.config.editorId][tar.id].showMaskEvent.subscribe(fixMask, panels[this.config.editorId][tar.id], true);
        debug(panels[this.config.editorId][tar.id]);
    }
    YAHOO.util.Event.stopEvent(ev);
}
/**
* Show a list menu (colors/icons)
* @param {Object} ev The Event object
* @param {HTMLElement} tar The Target of the event
*/
YAHOO.widget.Editor.prototype._showMenu = function(ev, tar) {
    if (ev) {
        var tar = YAHOO.util.Event.getTarget(ev).parentNode.getElementsByTagName('ul')[0];
    }
    if (!ev && !tar) {
        return false;
    }
    var state = YAHOO.util.Dom.getStyle(tar, 'display');
    
    this._hideMenus(state, tar);
    if (tar.parentNode && tar.parentNode.firstChild && YAHOO.util.Dom.hasClass(tar.parentNode.firstChild, 'yui_button_disable')) {
        return false;
    }
    
    if (tar && tar.id && (tar.id == 'menu_smiley_' + this.config.editorId)) {
        //Smilies
        imgs = tar.getElementsByTagName('img');
        if (state == 'none') {
            YAHOO.util.Event.addListener(imgs, 'mousedown', this._insertEmot, this, true);
        } else {
            YAHOO.util.Event.removeListener(imgs, 'mousedown', this._insertEmot);
        }
    } else {
        //Colors
        var lis = YAHOO.util.Dom.getElementsBy(function(elm) {
            if (elm.className.substring(0, 6) == 'color_') {
                return true;
            } else {
                return false;
            }
        }, 'li', tar);
        if (state == 'none') {
            YAHOO.util.Event.addListener(lis, 'mousedown', this._changeColor, this, true);
        } else {
            YAHOO.util.Event.removeListener(lis, 'mousedown', this._changeColor);
        }
    }
    YAHOO.util.Dom.setStyle(tar, 'display', ((state == 'block') ? 'none' : 'block'));
    if (ev) {
        YAHOO.util.Event.stopEvent(ev);
    }
}
/**
* Create the editors Toolbar
*/
YAHOO.widget.Editor.prototype._createToolbar = function() {

    var tb = this.cfg.getProperty('toolbar');
    debug(tb);
    /*
    tbar = [];
    tbar[tbar.length] = YAHOO.util.Dom.create('div', { style : 'clear: both'});
    for (var i = 0; i < tb.length; i++) {
        debug('Create Toolbar: #' + (i+1));
        tbar[tbar.length] = YAHOO.util.Dom.create('div', { id: 'toolbar_' + (i + 1) + '_' + this.config.editorId }, [
            YAHOO.util.Dom.create('div', { style : 'clear: both'}),
        ]);
    }
    */
    tbar = [ YAHOO.util.Dom.create('div', { style : 'clear: both'}),
        YAHOO.util.Dom.create('div',
        { id: 'toolbar_1_' + this.config.editorId },
        [
            YAHOO.util.Dom.create('div', { style : 'clear: both'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_new_' + this.config.editorId, title: 'New', className: 'new yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_bold_' + this.config.editorId, title: 'Bold', className: 'bold yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_italic_' + this.config.editorId, title: 'Italic', className: 'italic yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_underline_' + this.config.editorId, title: 'Underline', className: 'underline yui_button'}),
            YAHOO.util.Dom.create('span', {className: 'yui_spacer'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_justifyleft_' + this.config.editorId, title: 'Left Align', className: 'justifyleft yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_justifycenter_' + this.config.editorId, title: 'Left Center', className: 'justifycenter yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_justifyright_' + this.config.editorId, title: 'Right Center', className: 'justifyright yui_button'}),
            YAHOO.util.Dom.create('span', {className: 'yui_spacer'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_anchor_' + this.config.editorId, title: 'Anchor', className: 'anchor yui_button_disable'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_unlink_' + this.config.editorId, title: 'Unlink', className: 'unlink yui_button_disable'}),
            YAHOO.util.Dom.create('span', {className: 'yui_spacer'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_ul_' + this.config.editorId, title: 'Unordered List', className: 'ul yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_ol_' + this.config.editorId, title: 'Ordered List', className: 'ol yui_button'}),
            YAHOO.util.Dom.create('span', {className: 'yui_spacer'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_indent_' + this.config.editorId, title: 'Indent', className: 'indent yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_outdent_' + this.config.editorId, title: 'Outdent', className: 'outdent yui_button'}),
            YAHOO.util.Dom.create('span', {className: 'yui_spacer'}),

            YAHOO.util.Dom.create('div', {className: 'yui_buttonholder'}, [
                YAHOO.util.Dom.create('button', {id: 'toolbar_smiley_' + this.config.editorId, title: 'Insert Smiley', className: 'toolbar_smiley yui_button', type: 'button' }),
                YAHOO.util.Dom.create('ul', {id: 'menu_smiley_' + this.config.editorId, className: 'menu_smiley toolbar_drop', style: 'display: none'},
                    function() {
                        var _arr_smiles = [];
                        for (var i = 0; i < YAHOO.widget.Editor_Core.emots.length; i++) {
                            _arr_smiles[_arr_smiles.length] = YAHOO.util.Dom.create('li', [
                                YAHOO.util.Dom.create('img', {src: YAHOO.widget.Editor_Core._makeEmot(i)})
                            ]);
                        }
                        return _arr_smiles;
                    }()
                )]
            ),
            YAHOO.util.Dom.create('div', {className: 'yui_buttonholder'}, [
                YAHOO.util.Dom.create('button', {id: 'toolbar_forecolor_' + this.config.editorId, title: 'Text Color', className: 'toolbar_forecolor yui_button_disable', type: 'button' }),
                YAHOO.util.Dom.create('ul', {id: 'menu_forecolor_' + this.config.editorId, className: ' menu_forecolor toolbar_drop', style: 'display: none;'},
                    function() {
                        var _arr_colors = [];
                        for (var i = 0; i < YAHOO.widget.Editor_Core.colors.length; i++) {
                            _arr_colors[_arr_colors.length] = YAHOO.util.Dom.create('li', {className: 'color_' + YAHOO.widget.Editor_Core.colors[i], style: 'background-color: #' + YAHOO.widget.Editor_Core.colors[i]});
                        }
                        return _arr_colors;
                    }()
                )]
            ),
            YAHOO.util.Dom.create('div', {className: 'yui_buttonholder'}, [
                YAHOO.util.Dom.create('button', {id: 'toolbar_backcolor_' + this.config.editorId, title: 'Background Color', className: 'toolbar_backcolor yui_button_disable', type: 'button' }),
                YAHOO.util.Dom.create('ul', {id: 'menu_backcolor', className: 'menu_backcolor toolbar_drop', style: 'display: none'},
                    function() {
                        var _arr_colors = [];
                        for (var i = 0; i < YAHOO.widget.Editor_Core.colors.length; i++) {
                            _arr_colors[_arr_colors.length] = YAHOO.util.Dom.create('li', {className: 'color_' + YAHOO.widget.Editor_Core.colors[i], style: 'background-color: #' + YAHOO.widget.Editor_Core.colors[i]});
                        }
                        return _arr_colors;
                    }()
                )]
            ),
            YAHOO.util.Dom.create('div', { style : 'clear: both'})
        ]
    ),
        YAHOO.util.Dom.create('div',
            { id: 'toolbar_2_' + this.config.editorId },
            [
                YAHOO.util.Dom.create('div', {className: 'yui_listholder'}, [
                    YAHOO.util.Dom.create('button', {className: 'fontface_select yui_buttonlist', id : 'fontface_select_' + this.config.editorId, type: 'button' }, 'Verdana'),
                    YAHOO.util.Dom.create('ul', { id: 'menu_fontface_' + this.config.editorId, className: 'menu_fontface', style: 'display: none'}, 
                        function() {
                            var arr = [];
                            for (var i = 0; i < YAHOO.widget.Editor_Core.fonts.length; i++) {
                                arr[arr.length] = YAHOO.util.Dom.create('li', { className: 'font', style: 'font-family: ' + YAHOO.widget.Editor_Core.fonts[i]}, [YAHOO.util.Dom.create('a', YAHOO.widget.Editor_Core.fonts[i])]);
                            }
                            return arr;
                        }()
                    )
                ]),
                YAHOO.util.Dom.create('div', {className: 'yui_listholder'}, [
                    YAHOO.util.Dom.create('button', {className: 'fontsize_select yui_buttonlist', id : 'fontsize_select_' + this.config.editorId, type: 'button' }, '2'),
                    YAHOO.util.Dom.create('ul', { id: 'menu_fontsize_' + this.config.editorId,  className: 'menu_fontsize', style: 'display: none'}, 
                        function() {
                            var arr = [];
                            for (var i = 0; i < YAHOO.widget.Editor_Core.fontsizes.length; i++) {
                                arr[arr.length] = YAHOO.util.Dom.create('li', { className: 'fontsize', style: 'font-size: ' + YAHOO.widget.Editor_Core.fontsizes[i]}, [YAHOO.util.Dom.create('a', [ function() { return document.createTextNode(i + 1);}()])]);
                            }
                            return arr;
                        }()
                    )
                ])
            ]
        ),
        YAHOO.util.Dom.create('div', { style : 'clear: both'})
    ];

    //Need to add addListerners to YAHOO.util.Dom.create();
    return tbar;
}
/**
* Make the URL for the Emot Icon
* @param {String} id The string ID of the emoticon
*/
YAHOO.widget.Editor_Core._makeEmot = function(id) {
    return 'http://us.i1.yimg.com/us.yimg.com/i/mesg/tsmileys2/' + YAHOO.widget.Editor_Core.emots[id]+'.gif';
}
/**
* Get the current selection in the editor
* @return {Object} selection The string ID of the emoticon
*/
YAHOO.widget.Editor.prototype._getSelection = function() {
    if (this._doc().selection) {
        return this._doc().selection;
    }
    return this._window().getSelection();
}
/**
* Save Callback Custom Event
*/
YAHOO.widget.Editor.prototype.save = function() {
    this.config.editor.value = this._doc().body.innerHTML;
    this.config.editor.style.display = 'block';
    this.onSave.fire();
}
/**
* Clear the doc of the Editor
*/
YAHOO.widget.Editor.prototype.clearDoc = function() {
    this._doc().body.innerHTML = '';
}
/**
* Fire the execCommand on the document
* @param {Object} ev The Event Object
* @param {String} action The action to take (fontsize, backcolor, bold...)
* @param {String} value The value of the action (1, #fff, bold)
*/
YAHOO.widget.Editor.prototype._execCommand = function(ev, action, value) {
    this._window().focus();
    debug('Window Focus..');
    if (ev) {
        var tar = YAHOO.util.Event.getTarget(ev);
        if (tar.tagName.toLowerCase() != 'div') {
            var action = tar.id.replace('toolbar_', '');
            debug('Incoming Action: ' + action);
            if (action.indexOf('_')) {
               debug('Modding Action: ' + action.indexOf('_'));
               debug('Offset: ' + action.substring(0, action.indexOf('_')));
                action = action.substring(0, action.indexOf('_'));
            }
            YAHOO.util.Dom.replaceClass(tar.id, 'yui_button', 'yui_button_sel');
        }
    }
   debug('First Value: ' + value); 
   debug('Action: ' + action); 
    if (!value) {
        var value = this._getSelection();
    }
    this._window().focus();
    
    //try {this._doc().execCommand('styleWithCSS', false, true);} catch (ex) {}
    this._setEditorStyle(false);
    var useStyle = false;
    switch (action) {
        case 'new':
            if (confirm('Are you sure you want to clear the current document?')) {
                this.clearDoc();
            }
            action = false;
            break;
        case 'save':
            this.save();
            action = false;
            break;
        case 'anchor':
            action = 'createlink';
            //value = prompt('Please enter a URL: ', 'http://');
            if (!value) {
                action = false;
            }
            //return false;
            break;
        case 'forecolor':
            //value = prompt('Please enter a color (hex or text): ', '');
            if (!value) {
                action = false;
            }
            break;
        case 'backcolor':
            if (this.br.msie || this.br.safari) {
            } else {
                useStyle = true;
                action = 'HiliteColor';
            }
            break;

            //value = prompt('Please enter a color (hex or text): ', '');
            if (!value) {
                action = false;
            }
            break;
        case 'ol':
        case 'ul':
            if (action == 'ol') {
                action = 'InsertOrderedList';
            } else {
                action = 'InsertUnorderedList';
            }
            var tag = (action == "InsertUnorderedList") ? "ul" : "ol";
            if (this.br.safari) {
                //this.execCommand("mceInsertContent", false, "<" + tag + "><li>&nbsp;</li><" + tag + ">");
            }
            break;
        case 'b':
        case 'i':
        case 'u':
            //useStyle = true;
            break;
    }
    if (action) {
       debug('Action: ' + action); 
       debug('Value: ' + value);
       debug('useStyle: ' + useStyle);
        if (useStyle) {
            this._setEditorStyle(true);
        }
        try {
            this._window().focus();
            this._doc().execCommand(action, false, value);
        } catch (e) {
            debug('execCommand FAILED');
        }
    } else {
       debug('No Action');
    }
    this._window().focus();
    
    if (ev) {
        //Stop Click Event
        YAHOO.util.Event.stopEvent(ev);
    }
}
/**
* Set the editor to use CSS instead of HTML
* @param {Booleen} stat True/False
*/
YAHOO.widget.Editor.prototype._setEditorStyle = function(stat) {
    try {
        this._doc().execCommand('useCSS', false, !stat);
    } catch (ex) {
       debug('useCSS failed: ' + ex);
    }
    try {
        this._doc().execCommand('styleWithCSS', false, stat);
    } catch (ex) {
       debug('styleWithCSS failed: ' + ex);
    }
}
/**
* Create the wrapper around the editor and toolbar
*/
YAHOO.widget.Editor.prototype._createControls = function() {
    this.config.wrapper = YAHOO.util.Dom.create('div', { id: this.config.wrapperId, className: 'yuiEditor_wrapper' });
    this.config.editor.style.display = 'none';
    this.config.editor.parentNode.replaceChild(this.config.wrapper, this.config.editor);
    this.config.wrapper.appendChild(this.config.editor);
    _tmp = YAHOO.util.Dom.create('div',
            [
            YAHOO.util.Dom.create('div',
                {
                    id: 'yuiEditor_toolbar_' + this.config.editorId,
                    className: 'yuiEditor_toolbar'
                },
                this._createToolbar()
            ),
            this._createIframe()
            ]
        );
    this.config.wrapper.appendChild(_tmp);
    this.config.toolbar = YAHOO.util.Dom.get('yuiEditor_toolbar_' + this.config.editorId);
}
/**
* Prep the Editor for designMode
*/
YAHOO.widget.Editor.prototype._setup = function() {
    this._doc().designMode = "on";
    this._assignListeners();
    this._setContent(this.config.preText);
    //YAHOO.widget.Editor._setStyles();
}
/**
* Set the Document Styles
*/
YAHOO.widget.Editor.prototype._setStyles = function() {
    this._doc().body.style.padding = '2px';
    this._doc().body.style.margin = '0';
    this._doc().body.style.fontFamily = 'Verdana';
    this._doc().body.style.fontSize = '12px';
    hideWait(this.config.wrapperId);
}
/**
* Set the Document's default content
* @param {String} str String to prep the document with
*/
YAHOO.widget.Editor.prototype._setContent = function(str) {
    if ((typeof this._doc() == 'object') && this._doc().body) {
        if (!str) {
            str = this.config.preText;
        }
        this._doc().body.innerHTML = str;
        this._setStyles();
        if (this._timerContent) {
            clearTimeout(this._timerContent);
        }
    } else {
        this._timerContent = setTimeout('YAHOO.widget.Editor_Core.instances[' + this.config.editorId + ']._setContent()', 500);
    }
}
/**
* Get the Document of the IFRAME
* @returns {Object} Document Object
*/
YAHOO.widget.Editor.prototype._doc = function() {
    return this.config.ifrm.contentWindow.document;
}
/**
* Get the Window of the IFRAME
* @returns {Object} Window Object
*/
YAHOO.widget.Editor.prototype._window = function() {
    return this.config.ifrm.contentWindow;
}
/**
* Create the IFRAME
* @returns {HTMLElement} The HTML element of the created IFRAME
*/
YAHOO.widget.Editor.prototype._createIframe = function() {
    ifrm = YAHOO.util.Dom.create('iframe', {
        id:'yuiEditor_' + this.config.editorId,
        border: '0',
        frameborder: '0',
        marginwidth: '0',
        marginheight: '0',
        leftmargin: '0',
        topmargin: '0',
        allowtransparency: 'true',
        height: '250',
        width: '98%',
        src: 'blank.htm',
        className: 'yuiEditor'
        }
    );
    this.config.ifrm = ifrm;
    return ifrm;
}

/**
* Shows the Wait panel on Editor Load
*/
function showWait() {
    var editorId = this.id.substring(18);
   debug('EditorID: ' + editorId);
    panels[editorId]['wait'] = new YAHOO.widget.Panel("wait_" + YAHOO.widget.Editor_Core.instances[editorId].config.wrapperId, { width: "240px", fixedcenter: true, underlay: "shadow", iframe: true, close: false, draggable: false,  modal: true, effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5} });
	panels[editorId]['wait'].setHeader("Loading, please wait...");
	panels[editorId]['wait'].setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");   
	panels[editorId]['wait'].render(YAHOO.util.Dom.get(YAHOO.widget.Editor_Core.instances[editorId].config.wrapperId));
    panels[editorId]['wait'].showMaskEvent.subscribe(fixMask, panels[editorId]['wait'], true);
}
/**
* Hides the Wait panel on Editor Load
*/
function hideWait(editorId) {
    var editorId = editorId.substring(18);
   debug('hideWait: ' + editorId);
    panels[editorId]['wait'].hide();
}


/**
* Fixes the Mask to load it over a DIV instead of the Body
*/
function fixMask() {
	if (this.mask) {
        var coverId = this.element.parentNode.id;
       debug('fixMask: ' + coverId);
        var cover = YAHOO.util.Dom.get(coverId);
        var xy = YAHOO.util.Dom.getXY(cover);
        var height = YAHOO.util.Dom.getStyle(cover, 'height');
        if (isNaN(height)) {
            height = 315 + 'px';
        }
        this.mask.style.height = height;
        this.mask.style.width = YAHOO.util.Dom.getStyle(cover, 'width');
        YAHOO.util.Dom.setXY(this.mask, xy);
	}
}

/**
* Override the Overlay's center function to allow for fixMask to work
*/
YAHOO.widget.Overlay.prototype.center = function() {
	var scrollX = 0;
	var scrollY = 0;
    var coverId = this.element.parentNode.id;
   debug('Overlay.center: ' + coverId);
    var cover = YAHOO.util.Dom.get(coverId);
    var coverXY = YAHOO.util.Dom.getXY(cover);

	var viewPortWidth = parseInt(YAHOO.util.Dom.getStyle(cover, 'width'));
	var viewPortHeight = parseInt(YAHOO.util.Dom.getStyle(cover, 'height'));
    if (isNaN(viewPortHeight)) {
        viewPortHeight = 315;
    }

	var elementWidth = this.element.offsetWidth;
	var elementHeight = this.element.offsetHeight;

	var x = ((viewPortWidth / 2) - (parseInt(elementWidth) / 2) + scrollX) + coverXY[0];
	var y = ((viewPortHeight / 2) - (parseInt(elementHeight) / 2) + scrollY) + coverXY[1];
    
	this.element.style.left = (parseInt(x) + "px");
	this.element.style.top = (parseInt(y) + "px");
	this.syncPosition();
	this.cfg.refireEvent("iframe");
};


/**
* Generic Debug Function
*/
debug = function (str) {
    var holder = YAHOO.util.Dom.get('debug_holder');
    if (holder) {
        var p = document.createElement('p');
        p.innerHTML = str;
        if (holder.firstChild) {
            holder.insertBefore(p, holder.firstChild);
        } else {
            holder.appendChild(p);
        }
    }
}

/*
YAHOO.widget.Dialog.prototype.registerForm = function() {
    var form = this.element.getElementsByTagName("FORM")[0];

    if (!form) {
        // We couldn't find a form, lets see if there is a form around the panel
        var allForms = document.getElementsByTagName('form');
        for (var i = 0; i < allForms.length; i++) {
            debug('Checking: ' + allForms[i].id);
            if (YAHOO.util.Dom.isAncestor(allForms[i], this.element)) {
                debug('Found a form, use it: ' + allForms[i].id);
                form = allForms[i];
                allForms = null;
                break;
            }
        }
        if (!form) {
            var formHTML = "<form name=\"frm_" + this.id + "\" action=\"\"></form>";
            this.body.innerHTML += formHTML;
            form = this.element.getElementsByTagName("FORM")[0];
        }
    }

    this.firstFormElement = function() {
        for (var f=0;f<form.elements.length;f++ ) {
            var el = form.elements[f];
            if (el.focus) {
                if (el.type && el.type != "hidden") {
                    return el;
                    break;
                }
            }
        }
        return null;
    }();

    this.lastFormElement = function() {
        for (var f=form.elements.length-1;f>=0;f-- ) {
            var el = form.elements[f];
            if (el.focus) {
                if (el.type && el.type != "hidden") {
                    return el;
                    break;
                }
            }
        }
        return null;
    }();

    this.form = form;
    debug('ThisForm: ' + this.form);

    if (this.cfg.getProperty("modal") && this.form) {

        var me = this;
        
        var firstElement = this.firstFormElement || this.firstButton;
        if (firstElement) {
            this.preventBackTab = new YAHOO.util.KeyListener(firstElement, { shift:true, keys:9 }, {fn:me.focusLast, scope:me, correctScope:true} );
            this.showEvent.subscribe(this.preventBackTab.enable, this.preventBackTab, true);
            this.hideEvent.subscribe(this.preventBackTab.disable, this.preventBackTab, true);
        }

        var lastElement = this.lastButton || this.lastFormElement;
        if (lastElement) {
            this.preventTabOut = new YAHOO.util.KeyListener(lastElement, { shift:false, keys:9 }, {fn:me.focusFirst, scope:me, correctScope:true} );
            this.showEvent.subscribe(this.preventTabOut.enable, this.preventTabOut, true);
            this.hideEvent.subscribe(this.preventTabOut.disable, this.preventTabOut, true);
        }
    }
}
*/
