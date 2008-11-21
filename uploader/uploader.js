(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
    
    YAHOO.uploader = function(el, stat, preview, field) {
        this.element = Dom.get(el);
        this.status = Dom.get(stat);
        this.preview = Dom.get(preview);
        this.browser = YAHOO.env.ua;
        this.field = field;
        this.init();
    };

    YAHOO.uploader.prototype = {
        init: function() {
            this.wrapper = document.createElement('div');
            this.wrapper.innerHTML = '<form method="post" action="#" enctype="multipart/form-data"><input type="file" size="1" id="' + this.field + '" name="' + this.field + '"></form>';
            this.wrapper.className = 'uploaderButton';
            if (this.browser.ie) {
                this.element.style.zoom = '1';
                this.wrapper.style.zoom = '1';
                this.wrapper.firstChild.style.zoom = '1';
                this.wrapper.firstChild.firstChild.style.zoom = '1';
            }
            Dom.setStyle(this.wrapper.firstChild.firstChild, 'height', parseInt(Dom.getStyle(this.element, 'height'), 10) + ((this.browser.msie) ? 15 : 0) + 'px');
            Dom.setStyle(this.wrapper, 'height', parseInt(Dom.getStyle(this.element, 'height'), 10) + 'px');
            var xy = Dom.getXY(this.element);
            document.body.appendChild(this.wrapper);
            Dom.setXY(this.wrapper, xy);

            if (this.browser.gecko) {
                this.wrapper.firstChild.firstChild.style.right = '-' + Dom.getStyle(this.element, 'width');
                var rect = (this.wrapper.firstChild.firstChild.clientWidth - parseInt(Dom.getStyle(this.element, 'width'), 10));
                this.wrapper.firstChild.firstChild.style.clip = 'rect(auto, auto, auto, ' + rect + 'px)';
                
            }
            if (this.browser.webkit) {
                this.wrapper.style.overflow = 'hidden';
                Event.on(this.element, 'click', function() {
                    this.wrapper.firstChild.firstChild.click();
                }, this, true);
            }
            if (this.browser.ie) {
                this.wrapper.style.overflow = 'hidden';
                this.wrapper.style.width = Dom.getStyle(this.element, 'width');
                this.wrapper.firstChild.firstChild.style.right = '0';
                var rect = (this.wrapper.firstChild.firstChild.clientWidth - parseInt(Dom.getStyle(this.element, 'width'), 10));
                this.wrapper.firstChild.firstChild.style.clip = 'rect(auto, auto, auto, ' + rect + 'px)';
                Dom.setStyle(this.wrapper.firstChild.firstChild, 'opacity', '0');
            }
            if (this.browser.opera) {
                this.wrapper.firstChild.firstChild.style.width = Dom.getStyle(this.element, 'width');
                this.wrapper.firstChild.firstChild.style.left = '-50px';
                //this.wrapper.style.overflow = 'hidden';
                Event.on(this.element, 'click', function() {
                    var xy = Dom.getXY(this.wrapper.firstChild.firstChild);
                    alert(xy);
                    xy[0] = xy[0] + 5;
                    xy[1] = xy[1] + 5;
                    alert(xy);
                    var customEvent = document.createEvent('MouseEvents');
                    customEvent.initMouseEvent('click', true, true, window, 1,
                                     xy[0], xy[1], xy[0], xy[1], 
                                     false, false, false, false, 
                                     0, this.wrapper.firstChild.firstChild);
                    this.wrapper.firstChild.firstChild.dispatchEvent(customEvent);
                    
                    
                }, this, true);
            }
            this.anim = new YAHOO.util.Anim(this.preview, {
                opacity: {
                    to: 1
                }
            }, 1, YAHOO.util.Easing.easeOut);

            Event.on(this.wrapper.firstChild.firstChild, 'change', this._changeEvent, this, true);
        },
        _changeEvent: function() {
            if (confirm('Are you sure you wish to upload ' + this.parseFileName(this.wrapper.firstChild.firstChild.value) + '?')) {
                YAHOO.util.Connect.setForm(this.wrapper.firstChild, true);
                var cObj = YAHOO.util.Connect.asyncRequest('POST', 'upload.php', {
                    success: this._handleGood,
                    failure: this._handleBad,
                    upload: this._handleUpload,
                    scope: this
                });
                Dom.addClass(this.element, 'uploading');
            } else {
                this.wrapper.firstChild.firstChild.value = '';
            }
        },
        _handleGood: function() {
            console.log('good: ', arguments);
        },
        _handleBad: function() {
            console.log('bad: ', arguments);
        },
        _handleUpload: function(o) {
            var data = eval('(' + o.responseText + ')');
            if (data.response.error) {
                this.status.value = data.response.error;
            } else {
                this.status.value = data.response.url;
                this.preview.innerHTML = '<img src="' + data.response.url + '"><p><strong>' + data.response.file + '</strong> <em>' + data.response.size + '</em></p>';
                Dom.setStyle(this.preview, 'opacity', '0');
                this.anim.animate();
                Dom.setStyle(this.preview, 'display', 'block');
            }
            this.wrapper.firstChild.firstChild.value = '';
            Dom.removeClass(this.element, 'uploading');
        },
        parseFileName: function(str) {
            var arr = [], name = str, delim = '\\';
            if (str.indexOf('/') != -1) {
                //Mac & Unix
                delim = '/';
            }
            arr = str.split(delim);
            name = arr[arr.length - 1];
            return name;
        }
    };

})();
