(function() {
    YAHOO.util.Resize.prototype.__handleMouseUp = YAHOO.util.Resize.prototype._handleMouseUp;
    YAHOO.util.Resize.prototype._handleMouseUp = function(ev) {
        this.__handleMouseUp(ev);
        this.fireEvent('endResize', { ev: 'endResize', target: this, height: this._cache.height, width: this._cache.width, top: this._cache.top, left: this._cache.left });        
    };
})();
