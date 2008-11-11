(function() {
    var Dom = YAHOO.util.Dom,
    Event = YAHOO.util.Event;
    
    /**
    * The Bacon Utility allows you to cook bacon on any HTML element.
    * @module bacon
    */     
    /**
    * This class provides the ability to cook bacon.
    * @class Bacon
    * @extends Element
    * @constructor
    */
    var Bacon = function(el, attrs) {
        if (!attrs) {
            attrs = {};
        }
        Bacon.superclass.constructor.call(this, el, attrs);
    };

    var proto = {
        /**
        * @method cook
        * @description An override method for extending this class to maybe fry eggs too.
        */
        cook: function() {},
        /**
        * @method fryBacon
        * @description Start frying the bacon
        */
        fryBacon: function() {
            Dom.addClass(this.get('element'), 'show-bacon');
            soundManager.play('bacon');
            this.fireEvent('baconStart');
        },
        /**
        * @method stopFryBacon
        * @description Stop frying the bacon, it's done already
        */
        stopFryBacon: function() {
            Dom.removeClass(this.get('element'), 'show-bacon');
            soundManager.pause('bacon');
            this.fireEvent('baconDone');
        },
        /**
        * @private
        * @method _over
        * @description Called on mouseover to start cooking the bacon
        */
        _over: function() {
            this.fryBacon();
        },
        /**
        * @private
        * @method _out
        * @description Called on mouseout to stop cooking the bacon
        */
        _out: function() {
            this.stopFryBacon();
        },
        /**
        * @private
        * @method init
        * @description Standard Element Init method.
        */
        init: function() {
            Bacon.superclass.init.apply(this, arguments);

            Event.on(this.get('element'), 'mouseover', this._over, this, true);
            Event.on(this.get('element'), 'mouseout', this._out, this, true);
            this.fireEvent('baconReady');
        }
    }
    
    /**
    * @event baconReady
    * @description Event fired when the bacon is ready for cooking.
    * @param {Event} ev The event.
    */
    /**
    * @event baconStart
    * @description The event letting you know that the bacon is cooking
    * @param {Event} ev The event.
    */
    /**
    * @event baconDone
    * @description The event letting you know that the bacon is done cooking
    * @param {Event} ev The event.
    */


    YAHOO.extend(Bacon, YAHOO.util.Element, proto);
    
    /*
    * Load the SoundManger plugin and prep the sound file.
    */
    soundManager.url = './';
    soundManager.debugMode = false;
    soundManager.onload = function() {
      soundManager.createSound('bacon','./bacon.mp3');
    }
    //Make us global
    YAHOO.util.Bacon = Bacon;
    YAHOO.register('bacon', YAHOO.util.Bacon, { version: '1.0', build: '20' });
})();
