(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Layout = YAHOO.widget.Layout,
        Lang = YAHOO.lang,
        LayoutUnit = YAHOO.widget.LayoutUnit;

        YAHOO.widget.LayoutUnit.prototype.initAttributes = function(attr) {
            YAHOO.widget.LayoutUnit.superclass.initAttributes.call(this, attr);

            /**
            * @private
            * @attribute wrap
            * @description A reference to the wrap element
            * @type HTMLElement
            */
            this.setAttributeConfig('wrap', {
                value: attr.wrap || null,
                method: function(w) {
                    if (w) {
                        var id = Dom.generateId(w);
                        LayoutUnit._instances[id] = this;
                    }
                }
            });
            /**
            * @attribute grids
            * @description Set this option to true if you want the LayoutUnit to fix the first layer of YUI CSS Grids (margins)
            * @type Boolean
            */
            this.setAttributeConfig('grids', {
                value: attr.grids || false
            });
            /**
            * @private
            * @attribute top
            * @description The current top positioning of the Unit
            * @type Number
            */
            this.setAttributeConfig('top', {
                value: attr.top || 0,
                validator: Lang.isNumber,
                method: function(t) {
                    if (!this._collapsing) {
                        this.setStyle('top', t + 'px');
                    }
                }
            });
            /**
            * @private
            * @attribute left
            * @description The current left position of the Unit
            * @type Number
            */
            this.setAttributeConfig('left', {
                value: attr.left || 0,
                validator: Lang.isNumber,
                method: function(l) {
                    if (!this._collapsing) {
                        this.setStyle('left', l + 'px');
                    }
                }
            });

            /**
            * @attribute minWidth
            * @description The minWidth parameter passed to the Resize Utility
            * @type Number
            */
            this.setAttributeConfig('minWidth', {
                value: attr.minWidth || false,
                validator: YAHOO.lang.isNumber
            });

            /**
            * @attribute maxWidth
            * @description The maxWidth parameter passed to the Resize Utility
            * @type Number
            */
            this.setAttributeConfig('maxWidth', {
                value: attr.maxWidth || false,
                validator: YAHOO.lang.isNumber
            });

            /**
            * @attribute minHeight
            * @description The minHeight parameter passed to the Resize Utility
            * @type Number
            */
            this.setAttributeConfig('minHeight', {
                value: attr.minHeight || false,
                validator: YAHOO.lang.isNumber
            });

            /**
            * @attribute maxHeight
            * @description The maxHeight parameter passed to the Resize Utility
            * @type Number
            */
            this.setAttributeConfig('maxHeight', {
                value: attr.maxHeight || false,
                validator: YAHOO.lang.isNumber
            });

            /**
            * @attribute height
            * @description The height of the Unit
            * @type Number
            */
            this.setAttributeConfig('height', {
                value: attr.height,
                validator: Lang.isNumber,
                method: function(h) {
                    if (!this._collapsing) {
                        this.setStyle('height', h + 'px');
                    }
                }
            });

            /**
            * @attribute width
            * @description The width of the Unit
            * @type Number
            */
            this.setAttributeConfig('width', {
                value: attr.width,
                validator: Lang.isNumber,
                method: function(w) {
                    if (!this._collapsing) {
                        this.setStyle('width', w + 'px');
                    }
                }
            });
            /**
            * @attribute position
            * @description The position (top, right, bottom, left or center) of the Unit in the Layout
            * @type {String}
            */
            this.setAttributeConfig('position', {
                value: attr.position
            });
            /**
            * @attribute gutter
            * @description The gutter that we should apply to the parent Layout around this Unit. Supports standard CSS markup: (2 4 0 5) or (2) or (2 5)
            * @type String
            */
            this.setAttributeConfig('gutter', {
                value: attr.gutter || 0,
                validator: YAHOO.lang.isString,
                method: function(gutter) {
                    var p = gutter.split(' ');
                    if (p.length) {
                        this._gutter.top = parseInt(p[0], 10);
                        if (p[1]) {
                            this._gutter.right = parseInt(p[1], 10);
                        } else {
                            this._gutter.right = this._gutter.top;
                        }
                        if (p[2]) {
                            this._gutter.bottom = parseInt(p[2], 10);
                        } else {
                            this._gutter.bottom = this._gutter.top;
                        }
                        if (p[3]) {
                            this._gutter.left = parseInt(p[3], 10);
                        } else if (p[1]) {
                            this._gutter.left = this._gutter.right;
                        } else {
                            this._gutter.left = this._gutter.top;
                        }
                    }
                }
            });
            /**
            * @attribute parent
            * @description The parent Layout that we are assigned to
            * @type {Object} YAHOO.widget.Layout
            */
            this.setAttributeConfig('parent', {
                writeOnce: true,
                value: attr.parent || false,
                method: function(p) {
                    if (p) {
                        p.on('resize', this.resize, this, true);
                    }

                }
            });
            /**
            * @attribute collapseSize
            * @description The pixel size of the Clip that we will collapse to
            * @type Number
            */
            this.setAttributeConfig('collapseSize', {
                value: attr.collapseSize || 25,
                validator: YAHOO.lang.isNumber
            });
            /**
            * @attribute duration
            * @description The duration to give the Animation Utility when animating the opening and closing of Units
            */
            this.setAttributeConfig('duration', {
                value: attr.duration || 0.5
            });
            /**
            * @attribute easing
            * @description The Animation Easing to apply to the Animation instance for this unit.
            */
            this.setAttributeConfig('easing', {
                value: attr.easing || ((YAHOO.util && YAHOO.util.Easing) ? YAHOO.util.Easing.BounceIn : 'false')
            });
            /**
            * @attribute animate
            * @description Use animation to collapse/expand the unit
            * @type Boolean
            */
            this.setAttributeConfig('animate', {
                value: ((attr.animate === false) ? false : true),
                validator: function() {
                    var anim = false;
                    if (YAHOO.util.Anim) {
                        anim = true;
                    }
                    return anim;
                },
                method: function(anim) {
                    if (anim) {
                        this._anim = new YAHOO.util.Anim(this.get('element'), {}, this.get('duration'), this.get('easing'));
                    } else {
                        this._anim = false;
                    }
                }
            });
            /**
            * @attribute header
            * @description The text to use as the Header of the Unit
            */
            this.setAttributeConfig('header', {
                value: attr.header || false,
                method: function(txt) {
                    if (txt === false) {
                        //Remove the footer
                        if (this.header) {
                            Dom.addClass(this.body, 'yui-layout-bd-nohd');
                            this.header.parentNode.removeChild(this.header);
                            this.header = null;
                        }
                    } else {
                        if (!this.header) {
                            var header = this.getElementsByClassName('yui-layout-hd', 'div')[0];
                            if (!header) {
                                header = this._createHeader();
                            }
                            this.header = header;
                        }
                        var h = this.header.getElementsByTagName('h2')[0];
                        if (!h) {
                            h = document.createElement('h2');
                            this.header.appendChild(h);
                        }
                        h.innerHTML = txt;
                        if (this.body) {
                            Dom.removeClass(this.body, 'yui-layout-bd-nohd');
                        }
                    }
                    this.fireEvent('contentChange', { target: 'header' });
                }
            });
            /**
            * @attribute proxy
            * @description Use the proxy config setting for the Resize Utility
            * @type Boolean
            */
            this.setAttributeConfig('proxy', {
                writeOnce: true,
                value: ((attr.proxy === false) ? false : true)
            });
            /**
            * @attribute body
            * @description The content for the body. If we find an element in the page with an id that matches the passed option we will move that element into the body of this unit.
            */
            this.setAttributeConfig('body', {
                value: attr.body || false,
                method: function(content) {
                    if (!this.body) {
                        var body = this.getElementsByClassName('yui-layout-bd', 'div')[0];
                        if (body) {
                            this.body = body;
                        } else {
                            body = document.createElement('div');
                            body.className = 'yui-layout-bd';
                            this.body = body;
                            this.get('wrap').appendChild(body);
                        }
                    }
                    if (!this.header) {
                        Dom.addClass(this.body, 'yui-layout-bd-nohd');
                    }
                    Dom.addClass(this.body, 'yui-layout-bd-noft');


                    var el = null;
                    if (Lang.isString(content)) {
                        el = Dom.get(content);
                    } else if (content && content.tagName) {
                        el = content;
                    }
                    if (el) {
                        var id = Dom.generateId(el);
                        LayoutUnit._instances[id] = this;
                        this.body.appendChild(el);
                    } else {
                        this.body.innerHTML = content;
                    }

                    this._cleanGrids();

                    this.fireEvent('contentChange', { target: 'body' });
                }
            });

            /**
            * @attribute footer
            * @description The content for the footer. If we find an element in the page with an id that matches the passed option we will move that element into the footer of this unit.
            */
            this.setAttributeConfig('footer', {
                value: attr.footer || false,
                method: function(content) {
                    if (content === false) {
                        //Remove the footer
                        if (this.footer) {
                            Dom.addClass(this.body, 'yui-layout-bd-noft');
                            this.footer.parentNode.removeChild(this.footer);
                            this.footer = null;
                        }
                    } else {
                        if (!this.footer) {
                            var ft = this.getElementsByClassName('yui-layout-ft', 'div')[0];
                            if (!ft) {
                                ft = document.createElement('div');
                                ft.className = 'yui-layout-ft';
                                this.footer = ft;
                                this.get('wrap').appendChild(ft);
                            } else {
                                this.footer = ft;
                            }
                        }
                        var el = null;
                        if (Lang.isString(content)) {
                            el = Dom.get(content);
                        } else if (content && content.tagName) {
                            el = content;
                        }
                        if (el) {
                            this.footer.appendChild(el);
                        } else {
                            this.footer.innerHTML = content;
                        }
                        Dom.removeClass(this.body, 'yui-layout-bd-noft');
                    }
                    this.fireEvent('contentChange', { target: 'footer' });
                }
            });
            /**
            * @attribute close
            * @description Adds a close icon to the unit
            */
            this.setAttributeConfig('close', {
                value: attr.close || false,
                method: function(close) {
                    //Position Center doesn't get this
                    if (this.get('position') == 'center') {
                        return false;
                    }
                    if (!this.header) {
                        this._createHeader();
                    }
                    var c = Dom.getElementsByClassName('close', 'div', this.header)[0];
                    if (close) {
                        if (!c) {
                            c = document.createElement('div');
                            c.className = 'close';
                            this.header.appendChild(c);
                            Event.on(c, 'click', this.close, this, true);
                        }
                        c.title = this.STR_CLOSE;
                    } else if (c) {
                        Event.purgeElement(c);
                        c.parentNode.removeChild(c);
                    }
                    this._configs.close.value = close;
                    this.set('collapse', this.get('collapse')); //Reset so we get the right classnames
                }
            });

            /**
            * @attribute collapse
            * @description Adds a collapse icon to the unit
            */
            this.setAttributeConfig('collapse', {
                value: attr.collapse || false,
                method: function(collapse) {
                    //Position Center doesn't get this
                    if (this.get('position') == 'center') {
                        return false;
                    }
                    if (!this.header) {
                        this._createHeader();
                    }
                    var c = Dom.getElementsByClassName('collapse', 'div', this.header)[0];
                    if (collapse) {
                        if (!c) {
                            c = document.createElement('div');
                            this.header.appendChild(c);
                            Event.on(c, 'click', this.collapse, this, true);
                        }
                        c.title = this.STR_COLLAPSE;
                        c.className = 'collapse' + ((this.get('close')) ? ' collapse-close' : '');
                    } else if (c) {
                        Event.purgeElement(c);
                        c.parentNode.removeChild(c);
                    }
                }
            });
            /**
            * @attribute scroll
            * @description Adds a class to the unit to allow for overflow: auto, default is overflow: hidden
            */

            this.setAttributeConfig('scroll', {
                value: attr.scroll || false,
                method: function(scroll) {
                    if ((scroll === false) && !this._collapsed) { //Removing scroll bar
                        if (this.body) {
                            if (this.body.scrollTop > 0) {
                                this._lastScrollTop = this.body.scrollTop;
                            }
                        }
                    }
                    
                    if (scroll) {
                        this.addClass('yui-layout-scroll');
                        if (this._lastScrollTop > 0) {
                            if (this.body) {
                                this.body.scrollTop = this._lastScrollTop;
                            }
                        }
                    } else {
                        this.removeClass('yui-layout-scroll');
                    }
                }
            });
            /**
            * @attribute hover
            * @description Config option to pass to the Resize Utility
            */
            this.setAttributeConfig('hover', {
                writeOnce: true,
                value: attr.hover || false,
                validator: YAHOO.lang.isBoolean
            });
            /**
            * @attribute resize
            * @description Should a Resize instance be added to this unit
            */

            this.setAttributeConfig('resize', {
                value: attr.resize || false,
                validator: function(r) {
                    if (YAHOO.util && YAHOO.util.Resize) {
                        return true;
                    }
                    return false;
                },
                method: function(resize) {
                    if (resize && !this._resize) {
                        //Position Center doesn't get this
                        if (this.get('position') == 'center') {
                            return false;
                        }
                        var handle = false; //To catch center
                        switch (this.get('position')) {
                            case 'top':
                                handle = 'b';
                                break;
                            case 'bottom':
                                handle = 't';
                                break;
                            case 'right':
                                handle = 'l';
                                break;
                            case 'left':
                                handle = 'r';
                                break;
                        }

                        this.setStyle('position', 'absolute'); //Make sure Resize get's a position
                        
                        if (handle) {
                            this._resize = new YAHOO.util.Resize(this.get('element'), {
                                proxy: this.get('proxy'),
                                hover: this.get('hover'),
                                status: false,
                                autoRatio: false,
                                handles: [handle],
                                minWidth: this.get('minWidth'),
                                maxWidth: this.get('maxWidth'),
                                minHeight: this.get('minHeight'),
                                maxHeight: this.get('maxHeight'),
                                height: this.get('height'),
                                width: this.get('width'),
                                setSize: false,
                                wrap: false
                            });
                            
                            this._resize._handles[handle].innerHTML = '<div class="yui-layout-resize-knob"></div>';

                            if (this.get('proxy')) {
                                var proxy = this._resize.getProxyEl();
                                proxy.innerHTML = '<div class="yui-layout-handle-' + handle + '"></div>';
                            }
                            this._resize.on('startResize', function(ev) {
                                this._lastScroll = this.get('scroll');
                                this.set('scroll', false);
                                if (this.get('parent')) {
                                    this.get('parent').fireEvent('startResize');
                                    var c = this.get('parent').getUnitByPosition('center');
                                    this._lastCenterScroll = c.get('scroll');
                                    c.set('scroll', false);
                                }
                                this.fireEvent('startResize');
                            }, this, true);
                            this._resize.on('resize', function(ev) {
                                this.set('height', ev.height);
                                this.set('width', ev.width);
                                this.set('scroll', this._lastScroll);
                                if (this.get('parent')) {
                                    var c = this.get('parent').getUnitByPosition('center');
                                    c.set('scroll', this._lastCenterScroll);
                                }
                            }, this, true);
                        }
                    } else {
                        if (this._resize) {
                            this._resize.destroy();
                        }
                    }
                }
            });
            
        };
})();
