/* Gutter Plugin */
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    YAHOO.gutter = function(editor) {
        return {
            status: false,
            gutter: null,
            editor: editor,
            id: null,
            createGutter: function() {
                this.id = this.editor.get('id') + '_gutter';
                this.gutter = new YAHOO.widget.Overlay(this.id, {
                    height: '425px',
                    width: '300px',
                    context: [this.editor.get('element_cont').get('element'), 'tl', 'tr'],
                    position: 'absolute',
                    visible: false
                });
                Dom.addClass(this.gutter.element, 'yui-gutter');
                this.gutter.hideEvent.subscribe(function() {
                    this.editor.toolbar.deselectButton('flickr');
                    Dom.setStyle(this.id, 'visibility', 'visible');                
                    var anim = new YAHOO.util.Anim(this.id, {
                        width: {
                            from: 300,
                            to: 0
                        },
                        opacity: {
                            from: 1,
                            to: 0
                        }
                    }, 1);
                    anim.onComplete.subscribe(function() {  
                        Dom.setStyle(this.id, 'visibility', 'hidden');
                        this.editor.toolbar.deselectButton('flickr');
                    }, this, true);
                    anim.animate();
                }, this, true);
                this.gutter.showEvent.subscribe(function() {
                    editor.toolbar.selectButton('flickr');
                    this.gutter.cfg.setProperty('context', [this.editor.get('element_cont').get('element'), 'tl', 'tr']);
                    Dom.setStyle(this.gutter.element, 'width', '0px');
                    var anim = new YAHOO.util.Anim(this.id, {
                        width: {
                            from: 0,
                            to: 300
                        },
                        opacity: {
                            from: 0,
                            to: 1
                        }
                    }, 1);
                    anim.animate();
                }, this, true);
                var warn = '';
                if (this.editor.browser.webkit || this.editor.browser.opera) {
                    warn = this.editor.STR_IMAGE_COPY;
                }
                this.gutter.setBody('<h2>Flickr Image Search</h2><label for="' + this.editor.get('id') + '-flickr_search">Tag:</label><input type="text" value="" id="' + this.editor.get('id') + '-flickr_search"><div id="' + this.editor.get('id') + '-flickr_results" class="yui-flickr-results"><p>Enter flickr tags into the box above, separated by commas. Be patient, this example my take a few seconds to get the images..</p></div>' + warn);
                this.gutter.render(document.body);
            },
            open: function() {
                Dom.get(this.editor.get('id') + '-flickr_search').value = '';
                YAHOO.log('Show Gutter', 'info', 'example');
                this.gutter.show();
                this.status = true;
            },
            close: function() {
                YAHOO.log('Close Gutter', 'info', 'example');
                this.gutter.hide();
                this.status = false;
            },
            toggle: function() {
                if (this.status) {
                    this.close();
                } else {
                    this.open();
                }
            }
        }
    }
 
    
    YAHOO.namespace('FlickrEditor');

    YAHOO.FlickrEditor = function(id, config) {
        this.editor = new YAHOO.widget.Editor(id, config);

        this.editor.on('toolbarLoaded', function() {
            this.gutter = new YAHOO.gutter(this);

            var flickrConfig = {
                    type: 'push',
                    label: 'Insert Flickr Image',
                    value: 'flickr'
            }
           
            this.toolbar.addButtonToGroup(flickrConfig, 'insertitem');

            this.toolbar.on('flickrClick', function(ev) {
                YAHOO.log('flickrClick: ' + YAHOO.lang.dump(ev), 'info', 'example');
                this._focusWindow();
                if (ev && ev.img) {
                    YAHOO.log('We have an image, insert it', 'info', 'example');
                    //To abide by the Flickr TOS, we need to link back to the image that we just inserted
                    var html = '<a href="' + ev.url + '"><img src="' + ev.img + '" title="' + ev.title + '"></a>';
                    this.execCommand('inserthtml', html);
                }
                this.gutter.toggle();
            }, this, true);
            this.gutter.createGutter();
        }, this.editor, true);
        this.editor.on('afterRender', this._createAC, this, true);
        return this.editor;
    };
    YAHOO.FlickrEditor.prototype._createAC = function() {
        var id = this.editor.get('id');
        Event.onAvailable(id + '-flickr_search', function() {
            Event.on(id + '-flickr_results', 'mousedown', function(ev) {
                Event.stopEvent(ev);
                var tar = Event.getTarget(ev);
                if (tar.tagName.toLowerCase() == 'img') {
                    if (tar.getAttribute('fullimage', 2)) {
                        YAHOO.log('Found an image, insert it..', 'info', 'example');
                        var img = tar.getAttribute('fullimage', 2),
                            title = tar.getAttribute('fulltitle'),
                            owner = tar.getAttribute('fullowner'),
                            url = tar.getAttribute('fullurl');
                        this.toolbar.fireEvent('flickrClick', { type: 'flickrClick', img: img, title: title, owner: owner, url: url });
                    }
                }
            }, this.editor, true);
            var oACDS = new YAHOO.widget.DS_XHR("flickr_proxy.php",
                ["photo", "title", "id", "owner", "secret", "server"]);
            this.ac_ds = oACDS;
            oACDS.scriptQueryParam = "tags";
            oACDS.responseType = YAHOO.widget.DS_XHR.TYPE_XML;
            oACDS.maxCacheEntries = 0;
            oACDS.scriptQueryAppend = "method=flickr.photos.search";

            // Instantiate AutoComplete
            var oAutoComp = new YAHOO.widget.AutoComplete(id + '-flickr_search',id + '-flickr_results', oACDS);
            this.ac = oAutoComp;
            oAutoComp.autoHighlight = false;
            oAutoComp.alwaysShowContainer = true; 
            oAutoComp.formatResult = function(oResultItem, sQuery) {
                // This was defined by the schema array of the data source
                var sTitle = oResultItem[0];
                var sId = oResultItem[1];
                var sOwner = oResultItem[2];
                var sSecret = oResultItem[3];
                var sServer = oResultItem[4];
                var urlPart = 'http:/'+'/static.flickr.com/' + sServer + '/' + sId + '_' + sSecret;
                var sUrl = urlPart + '_s.jpg';
                var lUrl = urlPart + '_m.jpg';
                var fUrl = 'http:/'+'/www.flickr.com/photos/' + sOwner + '/' + sId;
                var sMarkup = '<img src="' + sUrl + '" fullimage="' + lUrl + '" fulltitle="' + sTitle + '" fullid="' + sOwner + '" fullurl="' + fUrl + '" class="yui-ac-flickrImg" title="Click to add this image to the editor"><br>';
                return (sMarkup);
            };
        }, this, true);
    };
    YAHOO.FlickrEditor.prototype.render = function() {
        this.editor.render();
    };


})();
