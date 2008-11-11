(function() {
        YAHOO.widget.SimpleEditor.prototype._handleFormSubmit = function(ev) {
            YAHOO.util.Event.stopEvent(ev);
            YAHOO.log('Button: ' + this._formButtonClicked.id, 'info', 'SimpleEditor');
            this.saveHTML();
            var form = this.get('element').form;
            var tar = this._formButtonClicked || false;
            var self = this;

            window.setTimeout(function() {
                YAHOO.util.Event.removeListener(form, 'submit', self._handleFormSubmit);
                if (YAHOO.env.ua.ie) {
                    form.fireEvent("onsubmit");
                    //Added disabled check
                    if (tar && !tar.disabled) {
                        tar.click();
                    }
                } else {  // Gecko, Opera, and Safari
                    //Added disabled check
                    if (tar && !tar.disabled) {
                        tar.click();
                    } else {
                        var oEvent = document.createEvent("HTMLEvents");
                        oEvent.initEvent("submit", true, true);
                        form.dispatchEvent(oEvent);
                        if (YAHOO.env.ua.webkit) {
                            if (YAHOO.lang.isFunction(form.submit)) {
                                form.submit();
                            }
                        }
                    }
                }
            }, 200);
            
        };
})();
