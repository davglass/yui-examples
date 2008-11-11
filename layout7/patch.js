(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang;

        YAHOO.widget.Layout.prototype._setupElements = function() {
            this._doc = this.getElementsByClassName('yui-layout-doc')[0];
            if (!this._doc) {
                this._doc = document.createElement('div');
                this.get('element').appendChild(this._doc);
            }
            this._createUnits();
            this._setBodySize();
            Dom.addClass(this._doc, 'yui-layout-doc');
        };

        YAHOO.widget.Layout.prototype.destroy = function() {
            var par = this.get('parent');
            if (par) {
                par.removeListener('resize', this.resize, this, true);
            }
            Event.removeListener(window, 'resize', this.resize, this, true);

            this.unsubscribeAll();
            
            this._units = {};
            this._units.center = this._center;
            this._units.top = this._top;
            this._units.bottom = this._bottom;
            this._units.left = this._left;
            this._units.right = this._right;

            for (var u in this._units) {
                if (Lang.hasOwnProperty(this._units, u)) {
                    if (this._units[u]) {
                        this._units[u].destroy(true);
                    }
                }
            }

            Event.purgeElement(this.get('element'));
            this.get('parentNode').removeChild(this.get('element'));

            delete YAHOO.widget.Layout._instances[this.get('id')];
            //Brutal Object Destroy
            for (var i in this) {
                if (Lang.hasOwnProperty(this, i)) {
                    this[i] = null;
                    delete this[i];
                }
            }
            if (par) {
                par.resize();
            }
            
        };

        YAHOO.widget.LayoutUnit.prototype.destroy = function(force) {
            if (this._resize) {
                this._resize.destroy();
            }
            var par = this.get('parent');

            this.setStyle('display', 'none');
            if (this._clip) {
                this._clip.parentNode.removeChild(this._clip);
                this._clip = null;
            }

            if (!force) {
                par.removeUnit(this);
            }

            Event.purgeElement(this.get('element'));
            this.get('parentNode').removeChild(this.get('element'));

            delete YAHOO.widget.LayoutUnit._instances[this.get('id')];
            //Brutal Object Destroy
            for (var i in this) {
                if (Lang.hasOwnProperty(this, i)) {
                    this[i] = null;
                    delete this[i];
                }
            }
        
            return par;
        };
})();
