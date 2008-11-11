/**
* @fileoverview Provides the YUI with several built-in effect combinations.
* @author Dav Glass <dav.glass@yahoo.com>
* @version 0.5 
* @class Provides the YUI with several built-in effect combinations.
* @requires YAHOO.util.Dom
* @requires YAHOO.util.Anim
*/
/**
* @version 0.5 
* @class Provides the YUI with several built-in effect combinations.<br>
* All effects now support a Custom Event called onEffectComplete.<br>
* They all now support a new option called delay. If delay is set to true the effect will not immediately execute.<br>
* You can then call eff.animate(); to animate it later. This way you can delay the execuation & bind an onEffectComplete subscriber<br>
* Then animate the effect.
* @constructor
*/
YAHOO.widget.Effects = function() {
    this.options.DELAY = false;
}
/**
* This effect makes the object expand & dissappear.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1<br>
* )</code>
* @return Animation Object
* @type Object
*/
YAHOO.widget.Effects.Puff = function(inElm, opts) {
    var start_elm = YAHOO.util.Dom.get(inElm);
    /**
    * DOM manipulation...
    * @type HTMLElement
    */
    var elm = start_elm.cloneNode(true);
    start_elm.parentNode.replaceChild(elm, start_elm);
    YAHOO.widget.Effects.Hide(start_elm);
    
    /**
    * Current location on the page
    * @type Array
    */
    var xy = YAHOO.util.Dom.getXY(elm);
    /**
    * Get the Height
    * @type Integer
    */
    var h = parseInt(YAHOO.util.Dom.getStyle(elm, 'height'));
    /**
    * Get the Width
    * @type Integer
    */
    var w = parseInt(YAHOO.util.Dom.getStyle(elm, 'width'));
    
    /**
    * One and a Half Times Bigger than it is
    */
    var nh = ((h / 2) + h);
    var nw = ((w / 2) + w);
    /**
    * Adjust position based on the new height and width
    */
    var nto = ((nh - h) / 2);
    var nlo = ((nw - w) / 2);
    var nt = xy[1] - nto;
    var nl = xy[0] - nlo;
    
    /**
    * Position needs to be absolute, so the new Height & Width will work
    */
    YAHOO.util.Dom.setStyle(elm, 'position', 'absolute');
    
    var attributes = {
        top: { to: nt },
        left: { to: nl },
        width: { to: nw },
        height: { to: nh },
        opacity: { from: 1, to: 0 }
    };
    
    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);

    var puff = new YAHOO.util.Anim(elm, attributes, secs, ease);
    puff.onComplete.subscribe(function() {
        var elm = this.getEl();
        /**
        * Replace the "cloned" element so we can put the original back with display:none set from above
        */
        elm.parentNode.replaceChild(start_elm, elm);
    });
    puff.animate();
    
    return puff;
}
/**
* This effect makes the object dissappear with display none.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @constructor
*/
YAHOO.widget.Effects.Hide = function(inElm) {
    var elm = YAHOO.util.Dom.get(inElm);
    YAHOO.util.Dom.setStyle(elm, 'display', 'none');
    YAHOO.util.Dom.setStyle(elm, 'visibility', 'hidden');
}
/**
* This effect makes the object Appear with display block.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @constructor
*/
YAHOO.widget.Effects.Show = function(inElm) {
    var elm = YAHOO.util.Dom.get(inElm);
    YAHOO.util.Dom.setStyle(elm, 'display', 'block');
    YAHOO.util.Dom.setStyle(elm, 'visibility', 'visible');
}
/**
* @constructor
* This effect makes the object fade & disappear.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1<br>
*   delay: true (Delays execuation)<br>
* )</code>
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.Fade = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    var attributes = {
        opacity: { from: 1, to: 0 }
    };
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);

    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);
    var delay = ((opts && opts.delay) ? opts.delay : false);

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        YAHOO.widget.Effects.Hide(elm);
        this.onEffectComplete.fire();
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.Fade.prototype.animate = function() {
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object fade & appear.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 3<br>
*   delay: true (Delays execuation)<br>
* )</code>
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.Appear = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    YAHOO.util.Dom.setStyle(elm, 'opacity', '0');
    YAHOO.widget.Effects.Show(elm);
    var attributes = {
        opacity: { from: 0, to: 1 }
    };
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);
    
    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 3);
    var delay = ((opts && opts.delay) ? opts.delay : false);

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        this.onEffectComplete.fire();
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.Appear.prototype.animate = function() {
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object act like a window blind and retract.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1<br>
*   delay: true (Delays execuation)<br>
*   bind: (string) bottom<br>
* )</code><br>
* Setting the bind option will make the element "blind up/rise" from the bottom.
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.BlindUp = function(inElm, opts) {
    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);
    var delay = ((opts && opts.delay) ? opts.delay : false);
    var elm = YAHOO.util.Dom.get(inElm);
    elm._height = YAHOO.util.Dom.getStyle(elm, 'height');
    elm._opts = opts;
    this.element = elm;
    YAHOO.util.Dom.setStyle(elm, 'overflow', 'hidden');
    var attributes = {
        height: { to: 0 }
    };
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);
    if (!delay) {
        this.prepStyle();
    }

    if (opts && opts.bind && (opts.bind == 'bottom')) {
        var attributes = {
            height: { from: 0, to: parseInt(elm._height)},
            top: { from: +(parseInt(elm._height)), to: 0 }
        };
    }

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        if (elm._opts && elm._opts.bind && (elm._opts.bind == 'bottom')) {
            YAHOO.util.Dom.setStyle(elm, 'top', '');
        } else {
            YAHOO.widget.Effects.Hide(elm);
            YAHOO.util.Dom.setStyle(elm, 'height', elm._height);
        }
        this.onEffectComplete.fire();
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.BlindUp.prototype.prepStyle = function() {
    if (this.element._opts && this.element._opts.bind && (this.element._opts.bind == 'bottom')) {
        YAHOO.util.Dom.setStyle(this.element, 'height', '0px');
        YAHOO.util.Dom.setStyle(this.element, 'top', this.element._height);
    }
    YAHOO.widget.Effects.Show(this.element);
}
YAHOO.widget.Effects.BlindUp.prototype.animate = function() {
    this.prepStyle();
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object act like a window blind opening.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1<br>
*   delay: true (Delays execuation)<br>
*   bind: (string) bottom<br>
* )</code><br>
* Setting the bind option will make the element "blind down" from top to bottom.
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.BlindDown = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    var elmH = parseInt(YAHOO.util.Dom.getStyle(elm, 'height'));
    elm._opts = opts;
    elm._height = YAHOO.util.Dom.getStyle(elm, 'height');
    this.element = elm;
    YAHOO.util.Dom.setStyle(elm, 'overflow', 'hidden');
    var attributes = {
        height: { from: 0, to: elmH }
    };
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);

    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);
    var delay = ((opts && opts.delay) ? opts.delay : false);

    if (opts && opts.bind && (opts.bind == 'bottom')) {
        var attributes = {
            height: { to: 0, from: parseInt(elmH)},
            top: { to: +(parseInt(elmH)), from: 0 }
        };
    }
    if (!delay) {
        this.prepStyle();
    }

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    if (opts && opts.bind && (opts.bind == 'bottom')) {
        this.effect.onComplete.subscribe(function() {
            YAHOO.widget.Effects.Hide(elm);
            YAHOO.util.Dom.setStyle(elm, 'top', '');
            YAHOO.util.Dom.setStyle(elm, 'height', elm._height);
            this.onEffectComplete.fire();
        }, this, true);
    } else {
        this.effect.onComplete.subscribe(function() {
            this.onEffectComplete.fire();
        }, this, true);
    }
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.BlindDown.prototype.prepStyle = function() {
    if (this.element._opts && this.element._opts.bind && (this.element._opts.bind == 'bottom')) {
    } else {
        YAHOO.util.Dom.setStyle(this.element, 'height', '0px');
    }
    YAHOO.widget.Effects.Show(this.element);
}
YAHOO.widget.Effects.BlindDown.prototype.animate = function() {
    this.prepStyle();
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object slide open from the right.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1<br>
*   delay: true (Delays execuation)<br>
*   bind: (string) right<br>
* )</code><br>
* Setting the bind option will make the element "blind right" from right to left (it will be attached to the right side).
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.BlindRight = function(inElm, opts) {
    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);
    var delay = ((opts && opts.delay) ? opts.delay : false);
    var elm = YAHOO.util.Dom.get(inElm);
    var elmW = YAHOO.util.Dom.getStyle(elm, 'width');
    elm._width = elmW;
    elm._opts = opts;
    elmW = parseInt(elmW);
    this.element = elm;
    YAHOO.util.Dom.setStyle(elm, 'overflow', 'hidden');
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);

    YAHOO.widget.Effects.Show(elm);
    var attributes = {
        width: { from: 0, to: elmW }
    };
    if (!delay) {
        this.prepStyle();
    }

    if (opts && opts.bind && (opts.bind == 'right')) {
        var attributes = {
            width: { to: 0 },
            left: { from: 0, to: elmW }
        };
    }
    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    if (opts && opts.bind && (opts.bind == 'right')) {
        this.effect.onComplete.subscribe(function() {
            YAHOO.widget.Effects.Hide(elm);
            YAHOO.util.Dom.setStyle(elm, 'width', elm._width);
            YAHOO.util.Dom.setStyle(elm, 'left', '');
            elm._width = null;
            this.onEffectComplete.fire();
        }, this, true);
    } else {
        this.effect.onComplete.subscribe(function() {
            this.onEffectComplete.fire();
        }, this, true);
    }
    if (!delay) {
        this.effect.animate();
    }
}
YAHOO.widget.Effects.BlindRight.prototype.prepStyle = function() {
    if (this.element._opts && this.element._opts.bind && (this.element._opts.bind == 'right')) {
    } else {
        YAHOO.util.Dom.setStyle(this.element, 'width', '0');
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.BlindRight.prototype.animate = function() {
    this.prepStyle();
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object slide closed from the left.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1<br>
*   delay: true (Delays execuation)<br>
*   bind: (string) right<br>
* )</code><br>
* Setting the bind option will make the element "blind left" from left to right (it will be attached to the right side).
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.BlindLeft = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    var elmW = YAHOO.util.Dom.getStyle(elm, 'width');
    elm._width = elmW;
    this.element = elm;
    this.element._opts = opts;
    YAHOO.util.Dom.setStyle(elm, 'overflow', 'hidden');
    var attributes = {
        width: { to: 0 }
    };
    
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);

    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);
    var delay = ((opts && opts.delay) ? opts.delay : false);

    if (opts && opts.bind && (opts.bind == 'right')) {
        if (!delay) {
            this.prepStyle();
        }
        var attributes = {
            width: { from: 0, to: parseInt(elmW) },
            left: { from: parseInt(elmW), to: 0 }
        };
    }
    
    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    if (opts && opts.bind && (opts.bind == 'right')) {
        this.effect.onComplete.subscribe(function() {
            this.onEffectComplete.fire();
        }, this, true);
    } else {
        this.effect.onComplete.subscribe(function() {
            YAHOO.widget.Effects.Hide(elm);
            YAHOO.util.Dom.setStyle(elm, 'width', elm._width);
            YAHOO.util.Dom.setStyle(elm, 'left', '');
            elm._width = null;
            this.onEffectComplete.fire();
        }, this, true);
    }
    if (!delay) {
        this.effect.animate();
    }
}
YAHOO.widget.Effects.BlindLeft.prototype.prepStyle = function() {
    if (this.element._opts && this.element._opts.bind && (this.element._opts.bind == 'right')) {
        YAHOO.widget.Effects.Hide(this.element);
        YAHOO.util.Dom.setStyle(this.element, 'width', '0px');
        YAHOO.widget.Effects.Show(this.element);
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.BlindLeft.prototype.animate = function() {
    this.prepStyle();
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object appear to fold up.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1,<br>
*   delay: true (Delays execuation)<br>
*   to: 5,<br>
* )</code>
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.Fold = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    elm._to = 5;
    YAHOO.util.Dom.setStyle(elm, 'overflow', 'hidden');
    YAHOO.widget.Effects.Show(elm);
    elm._height = YAHOO.util.Dom.getStyle(elm, 'height');
    elm._width = YAHOO.util.Dom.getStyle(elm, 'width');
    this.done = false;

    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);
    var delay = ((opts && opts.delay) ? opts.delay : false);
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);

    if (opts && opts.to) {
        elm._to = opts.to;
    }
    
    var attributes = {
        height: { to: elm._to }
    };

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        if (this.done) {
            YAHOO.widget.Effects.Hide(elm);
            YAHOO.util.Dom.setStyle(elm, 'height', elm._height);
            YAHOO.util.Dom.setStyle(elm, 'width', elm._width);
            this.onEffectComplete.fire();
        } else {
            this.done = true;
            this.effect.attributes = { width: { to: 0 }, height: { from: elm._to, to: elm._to } }
            this.effect.animate();
        }
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.Fold.prototype.animate = function() {
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object shake from Right to Left.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: .25,<br>
*   delay: true (Delays execuation)<br>
*   offset: 10,<br>
*   maxcount: 5<br>
* )</code>
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.ShakeLR = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    elm._offSet = 10;
    elm._maxCount = 5;
    elm._counter = 0;
    elm._elmPos = YAHOO.util.Dom.getXY(elm);
    var attributes = {
        left: { to:  ( - elm._offSet) }
    };

    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);

    if (opts && opts.offset) {
        elm._offSet = opts.offset;
    }
    if (opts && opts.maxcount) {
        elm._maxCount = opts.maxcount;
    }
    
    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : .25);
    var delay = ((opts && opts.delay) ? opts.delay : false);

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        if (this.done) {
            this.onEffectComplete.fire();
        } else {
            if (elm._counter < elm._maxCount) {
                elm._counter++;
                if (elm._left) {
                    elm._left = null;
                    this.effect.attributes = { left: { to: ( - elm._offSet) } }
                } else {
                    elm._left = true;
                    this.effect.attributes = { left: { to: elm._offSet } }
                }
                this.effect.animate();
            } else {
                this.done = true;
                elm._left = null;
                elm._counter = null;
                this.effect.attributes = { left: { to: 0 } }
                this.effect.animate();
            }
        }
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.ShakeLR.prototype.animate = function() {
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object shake from Top to Bottom.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: .25,<br>
*   delay: true (Delays execuation)<br>
*   offset: 10,<br>
*   maxcount: 5<br>
* )</code>
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.ShakeTB = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    elm._offSet = 10;
    elm._maxCount = 5;
    elm._counter = 0;
    elm._elmPos = YAHOO.util.Dom.getXY(elm);
    var attributes = {
        top: { to:  ( - elm._offSet) }
    };

    if (opts && opts.offset) {
        elm._offSet = opts.offset;
    }
    if (opts && opts.maxcount) {
        elm._maxCount = opts.maxcount;
    }

    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);
    
    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : .25);
    var delay = ((opts && opts.delay) ? opts.delay : false);

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        if (this.done) {
            this.onEffectComplete.fire();
        } else {
            if (elm._counter < elm._maxCount) {
                elm._counter++;
                if (elm._left) {
                    elm._left = null;
                    this.effect.attributes = { top: { to: ( - elm._offSet) } }
                } else {
                    elm._left = true;
                    this.effect.attributes = { top: { to: elm._offSet } }
                }
                this.effect.animate();
            } else {
                this.done = true;
                elm._left = null;
                elm._counter = null;
                this.effect.attributes = { top: { to: 0 } }
                this.effect.animate();
            }
        }
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.ShakeTB.prototype.animate = function() {
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object drop from sight.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1,<br>
*   delay: true (Delays execuation)<br>
* )</code>
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.Drop = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    var elmH = parseInt(YAHOO.util.Dom.getStyle(elm, 'height'));
    var attributes = {
        top: { from: 0, to: elmH },
        opacity: { from: 1, to: 0 }
    };
    
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);

    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeIn);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);
    var delay = ((opts && opts.delay) ? opts.delay : false);

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        YAHOO.widget.Effects.Hide(elm);
        YAHOO.util.Dom.setStyle(elm, 'top', 0);
        YAHOO.util.Dom.setStyle(elm, 'opacity', 1);
        this.onEffectComplete.fire();
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.Drop.prototype.animate = function() {
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object flash on and off.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: .25,<br>
*   delay: true (Delays execuation)<br>
*   maxcount: 9<br>
* )</code>
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.Pulse = function(inElm, opts) {
    var elm = YAHOO.util.Dom.get(inElm);
    elm._counter = 0;
    elm._maxCount = 9;
    var attributes = {
        opacity: { from: 1, to: 0 }
    };

    if (opts && opts.maxcount) {
        elm._maxCount = opts.maxcount;
    }
    
    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);

    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeIn);
    var secs = ((opts && opts.seconds) ? opts.seconds : .25);
    var delay = ((opts && opts.delay) ? opts.delay : false);

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        if (this.done) {
            this.onEffectComplete.fire();
        } else {
            if (elm._counter < elm._maxCount) {
                elm._counter++;
                if (elm._on) {
                    elm._on = null;
                    this.effect.attributes = { opacity: { to: 0 } }
                } else {
                    elm._on = true;
                    this.effect.attributes = { opacity: { to: 1 } }
                }
                this.effect.animate();
            } else {
                this.done = true;
                elm._on = null;
                elm._counter = null;
                this.effect.attributes = { opacity: { to: 1 } }
                this.effect.animate();
            }
        }
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.Pulse.prototype.animate = function() {
    this.effect.animate();
}
/**
* @constructor
* This effect makes the object shrink from sight.
* @param {String/HTMLElement} inElm HTML element to apply the effect to
* @param {Object} options Pass in an object of options for this effect, you can choose the Easing and the Duration
* <code> <br>var options = (<br>
*   ease: YAHOO.util.Easing.easeOut,<br>
*   seconds: 1,<br>
*   delay: true (Delays execuation)<br>
* )</code>
* @return Effect Object (Acess anmiation object via this.effect)
* @type Object
*/
YAHOO.widget.Effects.Shrink = function(inElm, opts) {
    var start_elm = YAHOO.util.Dom.get(inElm);
    var elm = start_elm.cloneNode(true);
    start_elm.parentNode.replaceChild(elm, start_elm);
    YAHOO.widget.Effects.Hide(start_elm);
    
    var h = parseInt(YAHOO.util.Dom.getStyle(elm, 'height'));
    var w = parseInt(YAHOO.util.Dom.getStyle(elm, 'width'));
    YAHOO.util.Dom.setStyle(elm, 'overflow', 'hidden');

    /**
    * Custom Event fired after the effect completes
    * @type Object
    */
    this.onEffectComplete = new YAHOO.util.CustomEvent('oneffectcomplete', this);
    
    var ease = ((opts && opts.ease) ? opts.ease : YAHOO.util.Easing.easeOut);
    var secs = ((opts && opts.seconds) ? opts.seconds : 1);
    var delay = ((opts && opts.delay) ? opts.delay : false);
    
    var attributes = {
        width: { to: 0 },
        height: { to: 0 },
        fontSize: { from: 100, to: 0, unit: '%' },
        opacity: { from: 1, to: 0 }
    };

    /**
    * YUI Animation Object
    * @type Object
    */
    this.effect = new YAHOO.util.Anim(elm, attributes, secs, ease);
    this.effect.onComplete.subscribe(function() {
        elm.parentNode.replaceChild(start_elm, elm);
        this.onEffectComplete.fire();
    }, this, true);
    if (!delay) {
        this.effect.animate();
    }
}
/**
* Fires off the embedded Animation.
*/
YAHOO.widget.Effects.Shrink.prototype.animate = function() {
    this.effect.animate();
}
/**
* @deprecated
* Effect is depreciated due to the introduction of onEffectComplete<br>
* This can now bw accomplished via:<br><pre>
*   eff = new YAHOO.widget.Effects.BlindUp('demo1', { delay: true });<br>
*   eff.onEffectComplete.subscribe(function() {<br>
*       eff2 = new YAHOO.widget.Effects.BlindRight('demo1', { delay: true });<br>
*       eff2.onEffectComplete.subscribe(function() {<br>
*           eff3 = new YAHOO.widget.Effects.BlindDown('demo1', { delay: true });<br>
*           eff3.onEffectComplete.subscribe(function() {<br>
*               eff4 = new YAHOO.widget.Effects.Drop('demo1', { delay: true });<br>
*               eff4.animate();<br>
*           });<br>
*           eff3.animate();<br>
*       });<br>
*       eff2.animate();<br>
*   });</pre>
*/
YAHOO.widget.Effects.Batch = function(effects, opts) {
    //Removed
}

/**
* @class
* This is a namespace call, nothing here to see.
* @constructor
*/
YAHOO.widget.Effects.ContainerEffect = function() {
}
/**
* @constructor
* Container Effect:<br>
*   Show: BlindUp (binded)<br>
*   Hide: BlindDown (binded)<br>
* @return Container Effect Object
* @type Object
*/
YAHOO.widget.Effects.ContainerEffect.BlindUpDownBinded = function(overlay, dur) {
    var bupdownbinded = new YAHOO.widget.ContainerEffect(overlay, { attributes: { effect: 'BlindUp', opts: { bind: 'bottom' } }, duration: dur }, { attributes: { effect: 'BlindDown', opts: { bind: 'bottom'} }, duration: dur }, overlay.element, YAHOO.widget.Effects.Container);
    bupdownbinded.init();
    return bupdownbinded;
}
/**
* @constructor
* Container Effect:<br>
*   Show: BlindUp<br>
*   Hide: BlindDown<br>
* @return Container Effect Object
* @type Object
*/
YAHOO.widget.Effects.ContainerEffect.BlindUpDown = function(overlay, dur) {
    var bupdown = new YAHOO.widget.ContainerEffect(overlay, { attributes: { effect: 'BlindDown' }, duration: dur }, { attributes: { effect: 'BlindUp' }, duration: dur }, overlay.element, YAHOO.widget.Effects.Container );
    bupdown.init();
    return bupdown;
}
/**
* @constructor
* Container Effect:<br>
*   Show: BlindLeft (binded)<br>
*   Hide: BlindRight (binded)<br>
* @return Container Effect Object
* @type Object
*/
YAHOO.widget.Effects.ContainerEffect.BlindLeftRightBinded = function(overlay, dur) {
    var bleftrightbinded = new YAHOO.widget.ContainerEffect(overlay, { attributes: { effect: 'BlindLeft', opts: {bind: 'right'} }, duration: dur }, { attributes: { effect: 'BlindRight', opts: { bind: 'right' } }, duration: dur }, overlay.element, YAHOO.widget.Effects.Container );
    bleftrightbinded.init();
    return bleftrightbinded;
}
/**
* @constructor
* Container Effect:<br>
*   Show: BlindLeft<br>
*   Hide: BlindRight<br>
* @return Container Effect Object
* @type Object
*/
YAHOO.widget.Effects.ContainerEffect.BlindLeftRight = function(overlay, dur) {
    var bleftright = new YAHOO.widget.ContainerEffect(overlay, { attributes: { effect: 'BlindRight' }, duration: dur }, { attributes: { effect: 'BlindLeft' } , duration: dur }, overlay.element, YAHOO.widget.Effects.Container );
    bleftright.init();
    return bleftright;
}
/**
* @constructor
* Container Effect:<br>
*   Show: BlindRight<br>
*   Hide: BlindFold<br>
* @return Container Effect Object
* @type Object
*/
YAHOO.widget.Effects.ContainerEffect.BlindRightFold = function(overlay, dur) {
    var brightfold = new YAHOO.widget.ContainerEffect(overlay, { attributes: { effect: 'BlindRight' }, duration: dur }, { attributes: { effect: 'Fold' }, duration: dur }, overlay.element, YAHOO.widget.Effects.Container );
    brightfold.init();
    return brightfold;
}
/**
* @constructor
* Container Effect:<br>
*   Show: BlindLeft (binded)<br>
*   Hide: BlindFold<br>
* @return Container Effect Object
* @type Object
*/
YAHOO.widget.Effects.ContainerEffect.BlindLeftFold = function(overlay, dur) {
    var bleftfold = new YAHOO.widget.ContainerEffect(overlay, { attributes: { effect: 'BlindLeft', opts: { bind: 'right' } }, duration: dur }, { attributes: { effect: 'Fold' }, duration: dur }, overlay.element, YAHOO.widget.Effects.Container );
    bleftfold.init();
    return bleftfold;
}

/**
* @constructor
* Container Effect:<br>
*   Show: BlindDown<br>
*   Hide: BlindDrop<br>
* @return Container Effect Object
* @type Object
*/
YAHOO.widget.Effects.ContainerEffect.BlindDownDrop = function(overlay, dur) {
    var bdowndrop = new YAHOO.widget.ContainerEffect(overlay, { attributes: { effect: 'BlindDown' }, duration: dur }, { attributes: { effect: 'Drop' }, duration: dur }, overlay.element, YAHOO.widget.Effects.Container );
    bdowndrop.init();
    return bdowndrop;
}

/**
* @constructor
* Container Effect:<br>
*   Show: BlindUp (binded)<br>
*   Hide: BlindDrop<br>
* @return Container Effect Object
* @type Object
*/
YAHOO.widget.Effects.ContainerEffect.BlindUpDrop = function(overlay, dur) {
    var bupdrop = new YAHOO.widget.ContainerEffect(overlay, { attributes: { effect: 'BlindUp', opts: { bind: 'bottom' } }, duration: dur }, { attributes: { effect: 'Drop' }, duration: dur }, overlay.element, YAHOO.widget.Effects.Container );
    bupdrop.init();
    return bupdrop;
}

/**
* @class
* This is a wrapper function to convert my YAHOO.widget.Effect into a YAHOO.widget.ContainerEffects object
* @constructor
* @return Animation Effect Object
* @type Object
*/
YAHOO.widget.Effects.Container = function(el, attrs, dur) {
    var opts = { delay: true };
    if (attrs.opts) {
        for (var i in attrs.opts) {
            opts[i] = attrs.opts[i];
        }
    }
    //var eff = eval('new YAHOO.widget.Effects.' + attrs.effect + '("' + el.id + '", {delay: true' + opts + '})');
    var func = eval('YAHOO.widget.Effects.' + attrs.effect);
    var eff = new func(el, opts);
    
    /**
    * Empty event handler to make ContainerEffects happy<br>
    * May try to attach them to my effects later
    * @type Object
    */
    eff.onStart = new YAHOO.util.CustomEvent('onstart', this);
    /**
    * Empty event handler to make ContainerEffects happy<br>
    * May try to attach them to my effects later
    * @type Object
    */
    eff.onTween = new YAHOO.util.CustomEvent('onstart', this);
    /**
    * Empty event handler to make ContainerEffects happy<br>
    * May try to attach them to my effects later
    * @type Object
    */
    eff.onComplete = new YAHOO.util.CustomEvent('onstart', this);
    return eff;
}
