(function() {
var Dom = YAHOO.util.Dom,
    Event = YAHOO.util.Event;

        YAHOO.widget.Editor.prototype._renderCreateLinkWindow = function() {
                var str = '<label for="' + this.get('id') + '_createlink_url"><strong>' + this.STR_LINK_URL + ':</strong> <input type="text" name="' + this.get('id') + '_createlink_url" id="' + this.get('id') + '_createlink_url" value=""></label>';
                str += '<label for="' + this.get('id') + '_createlink_target"><strong>&nbsp;</strong><input type="checkbox" name="' + this.get('id') + '_createlink_target" id="' + this.get('id') + '_createlink_target" value="_blank" class="createlink_target"> ' + this.STR_LINK_NEW_WINDOW + '</label>';
                str += '<label for="' + this.get('id') + '_createlink_title"><strong>' + this.STR_LINK_TITLE + ':</strong> <input type="text" name="' + this.get('id') + '_createlink_title" id="' + this.get('id') + '_createlink_title" value=""></label>';
                
                var body = document.createElement('div');
                body.innerHTML = str;

                var unlinkCont = document.createElement('div');
                unlinkCont.className = 'removeLink';
                var unlink = document.createElement('a');
                unlink.href = '#';
                unlink.innerHTML = this.STR_LINK_PROP_REMOVE;
                unlink.title = this.STR_LINK_PROP_REMOVE;
                Event.on(unlink, 'click', function(ev) {
                    Event.stopEvent(ev);
                    this.unsubscribeAll('afterExecCommand');
                    this.execCommand('unlink');
                    this.closeWindow();
                }, this, true);
                unlinkCont.appendChild(unlink);
                body.appendChild(unlinkCont);
                
                this._windows.createlink = {};
                this._windows.createlink.body = body;
                body.style.display = 'none';
                this.get('panel').editor_form.appendChild(body);
                this.fireEvent('windowCreateLinkRender', { type: 'windowCreateLinkRender', panel: this.get('panel'), body: body });
                return body;
        };


})();
