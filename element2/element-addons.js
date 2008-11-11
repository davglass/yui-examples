(function() {
    /**
    * @class ElementAddon
    * @module element-addon
    * @description Addon methods for the Element Utility. Adds getXY, getX, getY, setXY, setX, setY and getRegion
    */
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        /**
        * @method getXY
        * @description Passthrough to Dom.getXY
        * @return Array = XY of the element
        */
        YAHOO.util.Element.prototype.getXY = function() {
            return Dom.getXY(this.get('element'));
        };
        /**
        * @method getX
        * @description Passthrough to Dom.getX
        * @return Number = X of the element
        */
        YAHOO.util.Element.prototype.getX = function() {
            return Dom.getX(this.get('element'));
        };
        /**
        * @method getY
        * @description Passthrough to Dom.getY
        * @return Number = Y of the element
        */
        YAHOO.util.Element.prototype.getY = function() {
            return Dom.getY(this.get('element'));
        };
        /**
        * @method setXY
        * @description Passthrough to Dom.setXY
        * @param Array xy The xy to set the element to.
        */
        YAHOO.util.Element.prototype.setXY = function(xy) {
            return Dom.getXY(this.get('element'), xy);
        };
        /**
        * @method setX
        * @description Passthrough to Dom.setX
        * @param Number x The x to set on the element
        */
        YAHOO.util.Element.prototype.setX = function(x) {
            return Dom.setX(this.get('element'), [x, null]);
        };
        /**
        * @method setY
        * @description Passthrough to Dom.setY
        * @param Number y The y to set on the element
        */
        YAHOO.util.Element.prototype.setY = function(y) {
            return Dom.getY(this.get('element'), [null, y]);
        };
        /**
        * @method getRegion
        * @description Passthrough to Dom.getRegion
        * @return Object The region of the element
        */
        YAHOO.util.Element.prototype.getRegion = function() {
            return Dom.getRegion(this.get('element'));
        };
        YAHOO.register('element-addon', YAHOO.util.Element, { version: '1.0', build: '5' });
})();
