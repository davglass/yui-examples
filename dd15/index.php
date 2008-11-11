<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: DragDrop inside scrolled parent</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #demo {
            height: 200px;
            overflow: auto;
            width: 150px;
            border: 1px solid black;
        }
        li.dragging {
            background-color: #f2f2f2;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: DragDrop inside scrolled parent</a></h1></div>
    <div id="bd">
        <p>This is a prototype of DragDrop running inside a scrolled parent.</p>
        <p><a href="thecode">Jump to the code</a></p>
        <div id="demo">
        <ul>
            <?php
                for ($i = 1; $i <= 50; $i++) {
                    echo('<li id="scroll-'.$i.'">Test #'.$i.'</li>'."\n");
                }
            ?>
        </ul>
        </div>
        <h2>The Javascript</h2>
        <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        var scroll = function(id, sGroup, config) {
            scroll.superclass.constructor.apply(this, arguments);
            this.scrollParent = Dom.get(config.scroll);
            this.scrollHeight = this.scrollParent.scrollHeight;
            this.clientHeight = this.scrollParent.clientHeight;
            this.xy = Dom.getXY(this.scrollParent);
            this.setYConstraint();
        };
        YAHOO.extend(scroll, YAHOO.util.DDProxy, {
            goingUp: false,
            lastY: 0,
            overFlow: 5,
            dragger: null,
            scrollInt: null,
            scrollBy: 0,
            onDragOver: function(ev, id) {
                var tar = Dom.get(id);
                if (tar.tagName.toLowerCase() == 'li') {
                    if (tar.id != this.getEl().id) {
                        if (this.goingUp) {
                            tar.parentNode.insertBefore(this.getEl(), tar);
                        } else {
                            tar.parentNode.insertBefore(this.getEl(), tar.nextSibling);
                        }
                    }
                }
            },
            onDrag: function(ev) {
                var y = Event.getPageY(ev);

                if (y < this.lastY) { 
                    this.goingUp = true; 
                } else if (y > this.lastY) { 
                    this.goingUp = false; 
                } 

                this.lastY = y;

                var pageY = Event.getPageY(ev),
                    ch = this.getEl().clientHeight,
                    scrollTop = false;

                this.scrollBy =  ((ch * 2) + this.overFlow);

                if (this.goingUp) {
                    var deltaTop = this.xy[1] + (ch + this.overFlow);
                    if (pageY < deltaTop) {
                        scrollTop = this.scrollParent.scrollTop - this.scrollBy;
                    }
                } else {
                    var deltaBottom = this.clientHeight + this.xy[1] - (ch + this.overFlow);
                    if ((pageY > deltaBottom)) {
                        scrollTop = this.scrollParent.scrollTop + this.scrollBy;
                    }
                }
                this.scrollTo(scrollTop);
            },
            scrollTo: function(scrollTop) {
                this.currentScrollTop = scrollTop;
                if (this.scrollInt) {
                    clearInterval(this.scrollInt);
                }
                if (scrollTop) {
                    var self = this;
                    this.scrollInt = setInterval(function() {
                        if ((self.currentScrollTop < 0) || (self.currentScrollTop > self.scrollHeight)) {
                            clearInterval(self.scrollInt);
                        }
                        self.scrollParent.scrollTop = self.currentScrollTop;
                        YAHOO.util.DragDropMgr.refreshCache();
                        if (self.goingUp) {
                            self.currentScrollTop = self.currentScrollTop - self.scrollBy;
                        } else {
                            self.currentScrollTop = self.currentScrollTop + self.scrollBy;
                        }
                    }, 10);
                }
            },
            onDragDrop: function() {
                Dom.removeClass(this.dragger, 'dragging');
                if (this.scrollInt) {
                    clearInterval(this.scrollInt);
                }
            },
            endDrag: function() {
                Dom.removeClass(this.dragger, 'dragging');
                this.dragger.style.position = '';
                this.dragger.style.top = '';
                this.dragger.style.left = '';
                if (this.scrollInt) {
                    clearInterval(this.scrollInt);
                }
            }
        });


        var lis = Dom.get('demo').getElementsByTagName('li');
        for (var i = 0; i < lis.length; i++) {
            new YAHOO.util.DDTarget(lis[i]);
        }

        Event.on('demo', 'mousedown', function(ev) {
            var tar = Event.getTarget(ev);
            if (tar.tagName.toLowerCase() == 'li') {
                Dom.addClass(tar, 'dragging');
                var dd = new scroll(tar, '', { scroll: 'demo' });
                dd.handleMouseDown(ev);
                dd.dragger = tar;
            }
        });

})();
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

        var scroll = function(id, sGroup, config) {
            scroll.superclass.constructor.apply(this, arguments);
            this.scrollParent = Dom.get(config.scroll);
            this.scrollHeight = this.scrollParent.scrollHeight;
            this.clientHeight = this.scrollParent.clientHeight;
            this.xy = Dom.getXY(this.scrollParent);
            this.setYConstraint();
        };
        YAHOO.extend(scroll, YAHOO.util.DDProxy, {
            goingUp: false,
            lastY: 0,
            overFlow: 5,
            dragger: null,
            scrollInt: null,
            scrollBy: 0,
            onDragOver: function(ev, id) {
                var tar = Dom.get(id);
                if (tar.tagName.toLowerCase() == 'li') {
                    if (tar.id != this.getEl().id) {
                        if (this.goingUp) {
                            tar.parentNode.insertBefore(this.getEl(), tar);
                        } else {
                            tar.parentNode.insertBefore(this.getEl(), tar.nextSibling);
                        }
                    }
                }
            },
            onDrag: function(ev) {
                var y = Event.getPageY(ev);

                if (y < this.lastY) { 
                    this.goingUp = true; 
                } else if (y > this.lastY) { 
                    this.goingUp = false; 
                } 

                this.lastY = y;

                var pageY = Event.getPageY(ev),
                    ch = this.getEl().clientHeight,
                    scrollTop = false;

                this.scrollBy =  ((ch * 2) + this.overFlow);

                if (this.goingUp) {
                    var deltaTop = this.xy[1] + (ch + this.overFlow);
                    if (pageY < deltaTop) {
                        scrollTop = this.scrollParent.scrollTop - this.scrollBy;
                    }
                } else {
                    var deltaBottom = this.clientHeight + this.xy[1] - (ch + this.overFlow);
                    if ((pageY > deltaBottom)) {
                        scrollTop = this.scrollParent.scrollTop + this.scrollBy;
                    }
                }
                this.scrollTo(scrollTop);
            },
            scrollTo: function(scrollTop) {
                this.currentScrollTop = scrollTop;
                if (this.scrollInt) {
                    clearInterval(this.scrollInt);
                }
                if (scrollTop) {
                    var self = this;
                    this.scrollInt = setInterval(function() {
                        if ((self.currentScrollTop < 0) || (self.currentScrollTop > self.scrollHeight)) {
                            clearInterval(self.scrollInt);
                        }
                        self.scrollParent.scrollTop = self.currentScrollTop;
                        YAHOO.util.DragDropMgr.refreshCache();
                        if (self.goingUp) {
                            self.currentScrollTop = self.currentScrollTop - self.scrollBy;
                        } else {
                            self.currentScrollTop = self.currentScrollTop + self.scrollBy;
                        }
                    }, 10);
                }
            },
            onDragDrop: function() {
                Dom.removeClass(this.dragger, 'dragging');
                if (this.scrollInt) {
                    clearInterval(this.scrollInt);
                }
            },
            endDrag: function() {
                Dom.removeClass(this.dragger, 'dragging');
                this.dragger.style.position = '';
                this.dragger.style.top = '';
                this.dragger.style.left = '';
                if (this.scrollInt) {
                    clearInterval(this.scrollInt);
                }
            }
        });


        var lis = Dom.get('demo').getElementsByTagName('li');
        for (var i = 0; i < lis.length; i++) {
            new YAHOO.util.DDTarget(lis[i]);
        }

        Event.on('demo', 'mousedown', function(ev) {
            var tar = Event.getTarget(ev);
            if (tar.tagName.toLowerCase() == 'li') {
                Dom.addClass(tar, 'dragging');
                var dd = new scroll(tar, '', { scroll: 'demo' });
                dd.handleMouseDown(ev);
                dd.dragger = tar;
            }
        });

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
