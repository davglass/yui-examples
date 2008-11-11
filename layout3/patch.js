(function() {
YAHOO.widget.Layout.prototype._setSides = function(set) {
    YAHOO.log('Setting side units', 'info', 'Layout');
    var h1 = ((this._top) ? this._top.get('height') : 0),
        h2 = ((this._bottom) ? this._bottom.get('height') : 0),
        h = this._sizes.doc.h,
        w = this._sizes.doc.w;
    set = ((set === false) ? false : true);

    this._sizes.top = {
        h: h1, w: ((this._top) ? w : 0),
        t: 0
    };
    this._sizes.bottom = {
        h: h2, w: ((this._bottom) ? w : 0)
    };
    
    var newH = (h - (h1 + h2));

    this._sizes.left = {
        h: newH, w: ((this._left) ? this._left.get('width') : 0)
    };
    this._sizes.right = {
        h: newH, w: ((this._right) ? this._right.get('width') : 0),
        l: ((this._right) ? (w - this._right.get('width')) : 0),
        t: this._sizes.top.h
    };
    
    if (this._right && set) {
        if (this._top) {
            this._right.set('top', this._sizes.right.t);
        }
        if (!this._right._collapsing) { 
            this._right.set('left', this._sizes.right.l);
        }
        this._right.set('height', this._sizes.right.h, true);
    }
    if (this._left) {
        this._sizes.left.l = 0;
        if (this._top) {
            this._sizes.left.t = this._sizes.top.h;
            if (set) {
                this._left.set('top', this._sizes.top.h);
            }
        }
        if (set) {
            this._left.set('height', this._sizes.left.h, true);
            this._left.set('left', 0);
        }
    }
    if (this._bottom) {
        this._sizes.bottom.t = this._sizes.top.h + this._sizes.left.h;
        if (set) {
            this._bottom.set('top', this._sizes.bottom.t);
            this._bottom.set('width', this._sizes.bottom.w, true);
        }
    }
    if (this._top) {
        if (set) {
            this._top.set('width', this._sizes.top.w, true);
        }
    }
    YAHOO.log('Setting sizes: (' + YAHOO.lang.dump(this._sizes) + ')', 'info', 'Layout');
    this._setCenter(set);
};
})();
