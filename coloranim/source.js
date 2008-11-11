(function() {
	var Dom = YAHOO.util.Dom,
	    Event = YAHOO.util.Event;

	var getCSSClass = function() {
		var mysheet, mystyle, myrule, cssStyle = {}, mmm = 0;
		for(var iii = 2; iii < document.styleSheets.length; iii++) {
			if(document.styleSheets[iii].rules && YAHOO.env.ua.webkit === 0){
					mysheet = document.styleSheets[iii];
                    try {
                        for(mmm = 0; mmm < mysheet.rules.length; mmm++) {
                            mystyle = mysheet.rules[mmm];
                            cssStyle[mystyle.selectorText] = {};
                            for(myrule in mystyle.style) {
                                cssStyle[mystyle.selectorText][myrule] = mystyle.style[myrule];
                            }
                        }
                    } catch (e) {
                }
			} else {
				mysheet = document.styleSheets[iii];
                try {
                    for(mmm = 0; mmm < mysheet.cssRules.length; mmm++) {
                        mystyle = mysheet.cssRules[mmm];
                        cssStyle[mystyle.selectorText] = {};
                        myrule = mystyle.style;
                        for(var nnn = 0; nnn < mystyle.style.length; nnn++) {
                            cssStyle[mystyle.selectorText][myrule[nnn]] = myrule.getPropertyValue(myrule.item(nnn));
                        }
                    }
                } catch (e2) {
                }
			}
		}
		return cssStyle;
	};

	var prepareValues = function(attributes) {
		var cssStyle = getCSSClass(), to = '', what = {}, newAttributes = {};
		for(var rule in cssStyle[attributes.CSSClass.to]) {
            
            to = cssStyle[attributes.CSSClass.to][rule];
            switch (rule) {
                case 'background-color':
                case 'backgroundColor':
                    what.backgroundColor = {};
                    what.backgroundColor.to = to;
                    break;
                case 'color':
                    what.color = {};
                    what.color.to = to;
                    break;
                case 'borderTopColor':
                case 'border-top-color':
                    what.borderTopColor = {};
                    what.borderTopColor.to = to;
                    break;
                case 'borderRightColor':
                case 'border-right-color':
                    what.borderRightColor = {};
                    what.borderRightColor.to = to;
                    break;
                case 'borderBottomColor':
                case 'border-bottom-color':
                    what.borderBottomColor = {};
                    what.borderBottomColor.to = to;
                    break;
                case 'borderLeftColor':
                case 'border-left-color':
                    what.borderLeftColor = {};
                    what.borderLeftColor.to = to;
                    break;
                case 'width':
                    what.width = {};
                    what.width.to = to.match(/^\d*/);
                    what.width.unit = to.match(/px|em|pt|%/);
                    break;
                case 'height':
                    what.height = {};
                    what.height.to = to.match(/^\d*/);
                    what.height.unit = to.match(/px|em|pt|%/);
                    break;
                case 'top':
                    what.top = {};
                    what.top.to = to.match(/^\d*/);
                    what.top.unit = to.match(/px|em|pt|%/);
                    break;
                case 'left':
                    what.left = {};
                    what.left.to = to.match(/^\d*/);
                    what.left.unit = to.match(/px|em|pt|%/);
                    break;
            }

		}
		return what;
	};

    YAHOO.example.CSSClassTest = {
            init: function() {
                Event.on("switchColorwbb", "click", this.switch2wbb);
                Event.on("switchColorbww", "click", this.switch2bww);
            },
            
            switch2wbb: function() {
                Dom.get('switchColorbww').disabled = false;
                Dom.get('switchColorwbb').disabled = true;
                var attributes = {
                    CSSClass: { to : '.wbb' }
                };
                attributes = prepareValues(attributes);
                var anim = new YAHOO.util.ColorAnim(Dom.get('css_target'), attributes); 
                anim.animate();
                var anim2 = new YAHOO.util.Anim(Dom.get('css_target'), attributes);
                anim2.animate();
            },
            
            switch2bww: function() {
                Dom.get('switchColorbww').disabled = true;
                Dom.get('switchColorwbb').disabled = false;
                var attributes = {
                    CSSClass: { to : '.bww' }
                };
                attributes = prepareValues(attributes);
                var anim = new YAHOO.util.ColorAnim(Dom.get('css_target'), attributes); 
                anim.animate();
            }
    };

    Event.onDOMReady(YAHOO.example.CSSClassTest.init, YAHOO.example.CSSClassTest, true);
})();
