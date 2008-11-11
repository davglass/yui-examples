/**
* @fileoverview Sinple Rich Text Editor for the YUI.
* @author Dav Glass <dav.glass@yahoo.com>
* @version 0.0.1
* @class Editor.
* @requires YAHOO
* @requires YAHOO.util.Dom
* @requires YAHOO.util.Event
* @requires YAHOO.Tools
*
* @constructor
* @class Editor.
*/
YAHOO.widget.Editor = function() {}
YAHOO.widget.Editor = {
    br: YAHOO.Tools.getBrowsers(),
    dialog: null,
    config: {
        _timerContent: null,
        editor: false,
        preText: false,
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
        emots: ['01', '02', '03', '04', '05','06', '07', '08', '09', '10','11', '12', '13', '14', '15','16', '17', '18', '19', '20','21', '22', '23', '24', '25','26', '27', '28', '29', '30','31', '32', '33', '34', '35','37', '39', '40', '47', '50' ],
        menu_status: ['fontface', 'fontsize', 'menu_smiley', 'menu_fontcolor', 'menu_backcolor'],
        events: ['click','dblclick','mousedown','mouseup','keypress','keydown','keyup'],
        disabled: ['anchor', 'unlink', 'forecolor', 'backcolor']
    }
}
/**
* Converts a textarea to a Rich Text Editor
* @param {String} txtArea ID of the HTML Text Area to convert
*/
YAHOO.widget.Editor.init = function(txtArea) {
    this.config.editor = YAHOO.util.Dom.get(txtArea);
    if (!this.config.editor) {
        alert('Error, no form field');
        return false;
    }
    if (this.config.editor.value) {
        this.config.preText = this.config.editor.value;
    }
    this._createControls();
    setTimeout(YAHOO.widget.Editor._setup, 5000);
    var str = '';
    for (var i in this.br) {
        str += i + ': ' + this.br[i] + '<br>';
    }
    debug(str);
    if (this.br.msie) {
        //MSIE HACK
        document.execCommand("BackgroundImageCache", false, true);
    }

}
/**
* Assignes all the listeners
*/
YAHOO.widget.Editor._assignListeners = function() {
    var as = YAHOO.util.Dom.getElementsBy(function(elm) {
        if (elm.id.substring(0, 8) == 'toolbar_') {
            return true;
        } else {
            return false;
        }
    }, 'span', 'toolbar_1');
    var arr = [];
    for (var i = 0; i < as.length; i++) {
        //if ((as[i].id != 'toolbar_forecolor') && (as[i].id != 'toolbar_backcolor') && (as[i].id != 'toolbar_smiley') && (as[i].id != 'toolbar_anchor')) {
        if ((as[i].id != 'toolbar_forecolor') && (as[i].id != 'toolbar_backcolor') && (as[i].id != 'toolbar_smiley')) {
            arr[arr.length] = as[i].id;
        }
    }
    //Toolbar Listeners
    YAHOO.util.Event.addListener(arr, 'mousedown', YAHOO.widget.Editor._execCommand, YAHOO.widget.Editor, true);

    //Popups
    //YAHOO.util.Event.addListener('toolbar_anchor', 'mousedown', YAHOO.widget.Editor._showDialog, YAHOO.widget.Editor, true);
    
    //Menus
    YAHOO.util.Event.addListener('toolbar_forecolor', 'mousedown', YAHOO.widget.Editor._showMenu, YAHOO.widget.Editor, true);
    YAHOO.util.Event.addListener('toolbar_backcolor', 'mousedown', YAHOO.widget.Editor._showMenu, YAHOO.widget.Editor, true);
    YAHOO.util.Event.addListener('toolbar_smiley', 'mousedown', YAHOO.widget.Editor._showMenu, YAHOO.widget.Editor, true);
    
    //DropDowns
    YAHOO.util.Event.addListener('fontface_select', 'mousedown', YAHOO.widget.Editor._showSelect, YAHOO.widget.Editor, true);
    YAHOO.util.Event.addListener('fontsize_select', 'mousedown', YAHOO.widget.Editor._showSelect, YAHOO.widget.Editor, true);

    //iFrame Doc
    for (i in this.config.events) {
        YAHOO.util.Event.addListener(this._doc(), this.config.events[i], YAHOO.widget.Editor._nodeChange, YAHOO.widget.Editor, true);
    }
}
/**
* Changes the toolbar to reflect the editor state
* @param {Array} arr Array of toolbar settings to disable/enable/select
*/
YAHOO.widget.Editor._updateToolbar = function(arr) {
    var one = YAHOO.util.Dom.get('toolbar_1').getElementsByTagName('span');
    var sel = this._getSelection();
    
    //YAHOO.util.Dom.replaceClass(one, 'yui_button_sel', 'yui_button');
    for (var i = 0; i < one.length; i++) {
        if (YAHOO.util.Dom.hasClass(one[i], 'yui_button_sel')) {
            YAHOO.util.Dom.replaceClass(one[i], 'yui_button_sel', 'yui_button');
        }
    }

    if (arr.length) {
        for (var i = 0; i < arr.length; i++) {
            if (YAHOO.util.Dom.get('toolbar_' + arr[i])) {
                if (!YAHOO.util.Dom.hasClass('toolbar_' + arr[i], 'yui_button_sel')) {
                    YAHOO.util.Dom.replaceClass('toolbar_' + arr[i], 'yui_button', 'yui_button_sel');
                }
            }
        }
    }
    if (sel != '') {
        for (var i = 0; i < this.config.disabled.length; i++) {
            if (YAHOO.util.Dom.hasClass('toolbar_' + this.config.disabled[i], 'yui_button_disable')) {
                YAHOO.util.Dom.replaceClass('toolbar_' + this.config.disabled[i], 'yui_button_disable', 'yui_button');
            }
        }
    } else {
        for (var i = 0; i < this.config.disabled.length; i++) {
            if (!YAHOO.util.Dom.hasClass('toolbar_' + this.config.disabled[i], 'yui_button_disable')) {
                YAHOO.util.Dom.replaceClass('toolbar_' + this.config.disabled[i], 'yui_button_sel', 'yui_button_disable');
                YAHOO.util.Dom.replaceClass('toolbar_' + this.config.disabled[i], 'yui_button', 'yui_button_disable');
            }
        }
    }
}
/**
* Handles changes to the IFRAME
* @param {Object} ev Event object
*/
YAHOO.widget.Editor._nodeChange = function(ev) {
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
    YAHOO.util.Dom.get('fontface_select').innerHTML = ((name) ? name : 'Verdana');

    //FontSize
    var size = parseInt(this._doc().queryCommandValue('FontSize'));
    if (size) {
        debug('Set Size: ' + size);
        debug('this.config.fontsizes_convert[' + size + 'px]: ' + this.config.fontsizes_convert[size + 'px']);
        YAHOO.util.Dom.get('fontsize_select').innerHTML = ((this.config.fontsizes_convert[size + 'px']) ? this.config.fontsizes_convert[size + 'px'] : '2');
    }
    
    this._updateToolbar(actions);

}
/**
* Changes the Font state
* @param {Object} ev Event object
*/
YAHOO.widget.Editor._changeFont = function(ev) {
    //debug('_changeFont().. fired');
    var tar = YAHOO.util.Event.getTarget(ev).parentNode.parentNode;
    //debug('Target : ' + YAHOO.util.Event.getTarget(ev).parentNode.parentNode);
    if (tar.id == 'fontsize') {
        //debug('Target ParentNode: ' + YAHOO.util.Event.getTarget(ev).parentNode);
        //debug('Target ParentNode.style: ' + YAHOO.util.Event.getTarget(ev).parentNode.style.fontSize);
        var font = YAHOO.Tools.removeQuotes(YAHOO.util.Event.getTarget(ev).parentNode.style.fontSize);
        /*
        for (var i = 0; i < this.config.fontsizes.length; i++) {
            if (this.config.fontsizes[i] == font) {
                font = i + 1;
                break;
            }
        }
        */
        var action = 'FontSize';
        tar.parentNode.firstChild.innerHTML = this.config.fontsizes_convert[font];
    } else {
        var font = YAHOO.Tools.removeQuotes(YAHOO.util.Event.getTarget(ev).parentNode.style.fontFamily);
        debug('Selected Font: ' + font);
        var action = 'FontName';
        tar.parentNode.firstChild.innerHTML = font;
    }
    
    
    this._showSelect('', tar);
    
    //Change Font
    if (this.br.msie && (action == 'FontSize')) {
        //MSIE HACK
        font = this.config.fontsizes_convert[font];
    }
    this._execCommand('', action, font);
    
    YAHOO.util.Event.stopEvent(ev);
}
/**
* Hides a drop down menu
* @param {String} state The display state of the menu
* @param {HTMLElement} tar The Element target
*/
YAHOO.widget.Editor._hideMenus = function(state, tar) {
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
YAHOO.widget.Editor._showSelect = function(ev, tar) {
    if (ev) {
        var tar = YAHOO.util.Event.getTarget(ev).parentNode.getElementsByTagName('ul')[0];
    }
    var state = YAHOO.util.Dom.getStyle(tar, 'display');
    
    this._hideMenus(state, tar);
    
    as = tar.getElementsByTagName('a');
    
    for (var i = 0; i < as.length; i++) {
        if (state == 'none') {
            YAHOO.util.Event.addListener(as[i], 'mousedown', YAHOO.widget.Editor._changeFont, YAHOO.widget.Editor, true);
        } else {
            YAHOO.util.Event.removeListener(as[i], 'mousedown', YAHOO.widget.Editor._changeFont);
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
YAHOO.widget.Editor._changeColor = function(ev) {
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
YAHOO.widget.Editor._insertEmot = function(ev) {
    var tar = YAHOO.util.Event.getTarget(ev);
    var img = tar.src;
    this._showMenu('', tar.parentNode.parentNode);
    this._execCommand('', 'InsertImage', img);
}
/**
* STUB
*/
YAHOO.widget.Editor._handleDialog = function(obj) {
    debug('Saved....' + this.getData().url);
    this.hide();
}
/**
* STUB
*/
YAHOO.widget.Editor._showDialog = function(ev, tar) {
    var tar = YAHOO.util.Event.getTarget(ev);
    debug(tar.id);
    if (!YAHOO.util.Dom.get('yuiEditor_dialog')) {
        var tmp = YAHOO.util.Dom.create('div', { id: 'yuiEditor_dialog' }, [
            YAHOO.util.Dom.create('div', { className: 'hd' }, 'Add a Link'),
            YAHOO.util.Dom.create('div', { className: 'bd' }, 'Body goes here'),
            YAHOO.util.Dom.create('div', { className: 'ft' })
        ]);
        document.body.appendChild(tmp);
    }
    if (!this.dialog) {
        this.dialog = new YAHOO.widget.Dialog('yuiEditor_dialog');
        this.dialog.cfg.setProperty('close', true);
        this.dialog.cfg.setProperty('module', true);
        this.dialog.cfg.setProperty('fixedcenter', true);
        this.dialog.cfg.setProperty('visible', true);
        var handleCancel = function() {
            this.hide();
        }
        var myButtons = [ { text:"Submit", handler: this._handleDialog },
              { text:"Cancel", handler:handleCancel, isDefault:true } ];

        this.dialog.cfg.queueProperty("buttons", myButtons);

        this.dialog.render();
    }
    this.dialog.setBody('<div>URL<input type="text" name="url" id="url"></div>');
    this.dialog.show();
    debug(this.dialog);
    YAHOO.util.Event.stopEvent(ev);
}
/**
* Show a list menu (colors/icons)
* @param {Object} ev The Event object
* @param {HTMLElement} tar The Target of the event
*/
YAHOO.widget.Editor._showMenu = function(ev, tar) {
    if (ev) {
        var tar = YAHOO.util.Event.getTarget(ev).parentNode.getElementsByTagName('ul')[0];
    }
    if (!ev && !tar) {
        return false;
    }
    var state = YAHOO.util.Dom.getStyle(tar, 'display');
    
    this._hideMenus(state, tar);
    if (tar.parentNode && YAHOO.util.Dom.hasClass(tar.parentNode, 'yui_button_disable')) {
        return false;
    }
    
    if (tar && tar.id && (tar.id == 'menu_smiley')) {
        //Smilies
        imgs = tar.getElementsByTagName('img');
        if (state == 'none') {
            YAHOO.util.Event.addListener(imgs, 'mousedown', YAHOO.widget.Editor._insertEmot, YAHOO.widget.Editor, true);
        } else {
            YAHOO.util.Event.removeListener(imgs, 'mousedown', YAHOO.widget.Editor._insertEmot);
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
            YAHOO.util.Event.addListener(lis, 'mousedown', YAHOO.widget.Editor._changeColor, YAHOO.widget.Editor, true);
        } else {
            YAHOO.util.Event.removeListener(lis, 'mousedown', YAHOO.widget.Editor._changeColor);
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
YAHOO.widget.Editor._createToolbar = function() {
    tbar = [ YAHOO.util.Dom.create('div', { style : 'clear: both'}),
        YAHOO.util.Dom.create('div',
        { id: 'toolbar_1' },
        [
            YAHOO.util.Dom.create('div', { style : 'clear: both'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_new', title: 'New', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_bold', title: 'Bold', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_italic', title: 'Italic', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_underline', title: 'Underline', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', { className: 'yui_spacer'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_justifyleft', title: 'Left Align', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_justifycenter', title: 'Left Center', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_justifyright', title: 'Right Center', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', { className: 'yui_spacer'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_anchor', title: 'Anchor', className: 'yui_button_disable'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_unlink', title: 'Unlink', className: 'yui_button_disable'}),
            YAHOO.util.Dom.create('span', { className: 'yui_spacer'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_ul', title: 'Unordered List', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_ol', title: 'Ordered List', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', { className: 'yui_spacer'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_indent', title: 'Indent', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', {id: 'toolbar_outdent', title: 'Outdent', className: 'yui_button'}),
            YAHOO.util.Dom.create('span', { className: 'yui_spacer'}),

            YAHOO.util.Dom.create('div', {className: 'yui_buttonholder'}, [
                YAHOO.util.Dom.create('button', {id: 'toolbar_smiley', title: 'Insert Smiley', className: 'yui_button', type: 'button' }),
                YAHOO.util.Dom.create('ul', {id: 'menu_smiley', className: 'toolbar_drop', style: 'display: none'},
                    function() {
                        var _arr_smiles = [];
                        for (var i = 0; i < YAHOO.widget.Editor.config.emots.length; i++) {
                            _arr_smiles[_arr_smiles.length] = YAHOO.util.Dom.create('li', [
                                YAHOO.util.Dom.create('img', {src: YAHOO.widget.Editor._makeEmot(i)})
                            ]);
                        }
                        return _arr_smiles;
                    }()
                )]
            ),
            YAHOO.util.Dom.create('div', {className: 'yui_buttonholder'}, [
                YAHOO.util.Dom.create('button', {id: 'toolbar_forecolor', title: 'Text Color', className: 'yui_button_disable', type: 'button' }),
                YAHOO.util.Dom.create('ul', {id: 'menu_forecolor', className: 'toolbar_drop', style: 'display: none;'},
                    function() {
                        var _arr_colors = [];
                        for (var i = 0; i < YAHOO.widget.Editor.config.colors.length; i++) {
                            _arr_colors[_arr_colors.length] = YAHOO.util.Dom.create('li', {className: 'color_' + YAHOO.widget.Editor.config.colors[i], style: 'background-color: #' + YAHOO.widget.Editor.config.colors[i]});
                        }
                        return _arr_colors;
                    }()
                )]
            ),
            YAHOO.util.Dom.create('div', {className: 'yui_buttonholder'}, [
                YAHOO.util.Dom.create('button', {id: 'toolbar_backcolor', title: 'Background Color', className: 'yui_button_disable', type: 'button' }),
                YAHOO.util.Dom.create('ul', {id: 'menu_backcolor', className: 'toolbar_drop', style: 'display: none'},
                    function() {
                        var _arr_colors = [];
                        for (var i = 0; i < YAHOO.widget.Editor.config.colors.length; i++) {
                            _arr_colors[_arr_colors.length] = YAHOO.util.Dom.create('li', {className: 'color_' + YAHOO.widget.Editor.config.colors[i], style: 'background-color: #' + YAHOO.widget.Editor.config.colors[i]});
                        }
                        return _arr_colors;
                    }()
                )]
            ),
            YAHOO.util.Dom.create('div', { style : 'clear: both'})
        ]
    ),
        YAHOO.util.Dom.create('div',
            { id: 'toolbar_2' },
            [
                YAHOO.util.Dom.create('div', {className: 'yui_listholder'}, [
                    YAHOO.util.Dom.create('button', {className: 'yui_buttonlist', id : 'fontface_select', type: 'button' }, 'Verdana'),
                    YAHOO.util.Dom.create('ul', { id: 'fontface', style: 'display: none'}, 
                        function() {
                            var arr = [];
                            for (var i = 0; i < YAHOO.widget.Editor.config.fonts.length; i++) {
                                arr[arr.length] = YAHOO.util.Dom.create('li', { className: 'font', style: 'font-family: ' + YAHOO.widget.Editor.config.fonts[i]}, [YAHOO.util.Dom.create('a', YAHOO.widget.Editor.config.fonts[i])]);
                            }
                            return arr;
                        }()
                    )
                ]),
                YAHOO.util.Dom.create('div', {className: 'yui_listholder'}, [
                    YAHOO.util.Dom.create('button', {className: 'yui_buttonlist', id : 'fontsize_select', type: 'button' }, '2'),
                    YAHOO.util.Dom.create('ul', { id: 'fontsize', style: 'display: none'}, 
                        function() {
                            var arr = [];
                            for (var i = 0; i < YAHOO.widget.Editor.config.fontsizes.length; i++) {
                                arr[arr.length] = YAHOO.util.Dom.create('li', { className: 'fontsize', style: 'font-size: ' + YAHOO.widget.Editor.config.fontsizes[i]}, [YAHOO.util.Dom.create('a', [ function() { return document.createTextNode(i + 1);}()])]);
                            }
                            return arr;
                        }()
                    )
                ])
            ]
        ),
        YAHOO.util.Dom.create('div', { style : 'clear: both'})
    ];
    //Need to add addListernet to YAHOO.util.Dom.create();
    return tbar;
}
/**
* Make the URL for the Emot Icon
* @param {String} id The string ID of the emoticon
*/
YAHOO.widget.Editor._makeEmot = function(id) {
    return 'http://us.i1.yimg.com/us.yimg.com/i/mesg/tsmileys2/' + YAHOO.widget.Editor.config.emots[id]+'.gif';
}
/**
* Get the current selection in the editor
* @return {Object} selection The string ID of the emoticon
*/
YAHOO.widget.Editor._getSelection = function() {
    if (this._doc().selection) {
        return this._doc().selection;
    }
    return this._window().getSelection();
}
/**
* Save Callback
*/
YAHOO.widget.Editor.save = function() {
    this.config.editor.value = this._doc().body.innerHTML;
    this.config.editor.style.display = 'block';
}
/**
* Clear the doc of the Editor
*/
YAHOO.widget.Editor.clearDoc = function() {
    this._doc().body.innerHTML = '';
}
/**
* Fire the execCommand on the document
* @param {Object} ev The Event Object
* @param {String} action The action to take (fontsize, backcolor, bold...)
* @param {String} value The value of the action (1, #fff, bold)
*/
YAHOO.widget.Editor._execCommand = function(ev, action, value) {
    if (ev) {
        var tar = YAHOO.util.Event.getTarget(ev);
        var action = tar.id.replace('toolbar_', '');
        YAHOO.util.Dom.replaceClass(tar.id, 'yui_button', 'yui_button_sel');
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
            value = prompt('Please enter a URL: ', 'http://');
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
            action = 'InsertOrderedList';
        case 'ul':
            if (!action) {
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
        this._doc().execCommand(action, false, value);
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
YAHOO.widget.Editor._setEditorStyle = function(stat) {
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
YAHOO.widget.Editor._createControls = function() {
    this.config.wrapper = YAHOO.util.Dom.create('div', { id: 'yuiEditor_wrapper'});
    this.config.editor.style.display = 'none';
    this.config.editor.parentNode.replaceChild(this.config.wrapper, this.config.editor);
    this.config.wrapper.appendChild(this.config.editor);
    _tmp = YAHOO.util.Dom.create('div',
            [
            YAHOO.util.Dom.create('div',
                {
                    id: 'yuiEditor_toolbar'
                },
                this._createToolbar()
            ),
            this._createIframe()
            ]
        );
    this.config.wrapper.appendChild(_tmp);
    this.config.toolbar = YAHOO.util.Dom.get('yuiEditor_toolbar');
}
/**
* Prep the Editor for designMode
*/
YAHOO.widget.Editor._setup = function() {
    YAHOO.widget.Editor._doc().designMode = "on";
    YAHOO.widget.Editor._assignListeners();
    YAHOO.widget.Editor._setContent(YAHOO.widget.Editor.config.preText);
    //YAHOO.widget.Editor._setStyles();
}
/**
* Set the Document Styles
*/
YAHOO.widget.Editor._setStyles = function() {
    this._doc().body.style.padding = '2px';
    this._doc().body.style.margin = '0';
    this._doc().body.style.fontFamily = 'Verdana';
    this._doc().body.style.fontSize = '12px';
    hideWait();
}
/**
* Set the Document's default content
* @param {String} str String to prep the document with
*/
YAHOO.widget.Editor._setContent = function(str) {
    if ((typeof YAHOO.widget.Editor._doc() == 'object') && YAHOO.widget.Editor._doc().body) {
        if (!str) {
            str = YAHOO.widget.Editor.config.preText;
        }
        YAHOO.widget.Editor._doc().body.innerHTML = str;
        YAHOO.widget.Editor._setStyles();
        if (YAHOO.widget.Editor.config._timerContent) {
            clearTimeout(YAHOO.widget.Editor.config._timerContent);
        }
    } else {
        this.config._timerContent = setTimeout(YAHOO.widget.Editor._setContent, 500);
    }
}
/**
* Get the Document of the IFRAME
* @returns {Object} Document Object
*/
YAHOO.widget.Editor._doc = function() {
    return this.config.ifrm.contentWindow.document;
}
/**
* Get the Window of the IFRAME
* @returns {Object} Window Object
*/
YAHOO.widget.Editor._window = function() {
    return this.config.ifrm.contentWindow;
}
/**
* Create the IFRAME
* @returns {HTMLElement} The HTML element of the created IFRAME
*/
YAHOO.widget.Editor._createIframe = function() {
    ifrm = YAHOO.util.Dom.create('iframe', {
        id:'yuiEditor',
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
        style: 'border: 1px solid black;'
        }
    );
    this.config.ifrm = ifrm;
    return ifrm;
}

/**
* Shows the Wait panel on Editor Load
*/
function showWait() {
	waitPanel = new YAHOO.widget.Panel("wait", { width: "240px", fixedcenter: true, underlay: "shadow", iframe: true, close: false, draggable: false,  modal: true, effect: {effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5} });
	waitPanel.setHeader("Loading, please wait...");
	waitPanel.setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");   
	waitPanel.render(YAHOO.util.Dom.get('yuiEditor_wrapper'));
    waitPanel.showMaskEvent.subscribe(fixMask, waitPanel, true);
}
/**
* Hides the Wait panel on Editor Load
*/
function hideWait() {
    waitPanel.hide();
}

YAHOO.util.Event.onAvailable('yuiEditor_wrapper', showWait);

/**
* Fixes the Mask to load it over a DIV instead of the Body
*/
function fixMask() {
	if (this.mask) {
        var cover = YAHOO.util.Dom.get('yuiEditor_wrapper');
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
    var cover = YAHOO.util.Dom.get('yuiEditor_wrapper');
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
function debug(str) {
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
