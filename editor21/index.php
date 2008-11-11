<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Editor Symbols</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
        #entityMenu {
            background-color: #fff;
            width: 100px;
            overflow: hidden;
            border: 1px solid #000;
            zoom: 1;
        }
        #entityMenu:after { display: block; clear: both; visibility: hidden; content: '.'; height: 0;}
        #entityMenu a {
            height: 19px;
            width: 19px;
            display: block;
            float: left;
            margin: 3px;
            border: 1px solid #fff;
            color: #000;
            text-decoration: none;
            text-align: center;
        }
        #entityMenu a:hover {
            border: 1px solid black;
            background-color: #f2f2f2;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Editor Symbols</a></h1></div>
    <div id="bd">
    <p>This example is in response <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/20164">to this thread</a>.</p>
    <p><a href="#thecode">The Code</a></p>
    <textarea id="editor">
    This is some test text.<br>
    This is some test text.<br>
    This is some test text.<br>
    This is some test text.<br>
    This is some test text.<br>
    This is some test text.<br>
    This is some test text.<br>
    This is some test text.<br>
    </textarea>
    <h2 id="thecode">The Javascript</h2>
    <textarea name="code" class="JScript">
(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    //some of the entities to insert/display
    var entities = ['&fnof;', '&Alpha;', '&Beta;', '&Gamma;', '&Delta;','&Epsilon;', '&Zeta;', '&Eta;', '&Theta;', '&Iota;'];

    //editor toolbar ...
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
       
    var myConfig = {
        height: (screen.height-260) + 'px',
        width: '530px',
        dompath: true,
        animate: true
        };    
   
        // event handling for entity's overlay
        Event.onAvailable('entityMenu', function() {
            Event.on('entityMenu', 'click', function(ev) {
                var tar = YAHOO.util.Event.getTarget(ev);
                var entity = '';
                if (tar.tagName.toLowerCase() == 'a') {
                    entity = tar.innerHTML;
                }
                var _button = this.toolbar.getButtonByValue('insertentity'); 
                this.toolbar.fireEvent('insertentityClick', { type: 'insertentityClick', icon: entity});
                _button._menu.hide();
                Event.stopEvent(ev);
            }, myEditor, true);
        });
   
    var myEditor = new YAHOO.widget.Editor('editor', myConfig);
    // init of entity's overlay
    myEditor.on('toolbarLoaded', function() {
        var entityConfig = {
            type: 'push', //Using a standard push button
            label: 'Sonderzeichen einfügen', //The name/title of the button
            value: 'insertentity', //The "Command" for the button
            menu: function() {
                //Create the Overlay instance we are going to use for the menu
                var menu = new YAHOO.widget.Overlay('insertentity', {
                    visible: false
                });
                var estr = '';
                for (var b = 0; b < entities.length; b++) {
                    estr += '<a href="#">' + entities[b] + '</a>';
                }
                //Setting the body of the container to our list of images.
                menu.setBody('<div id="entityMenu">' + estr + '</div>');
                menu.beforeShowEvent.subscribe(function() {
                    //Set the context to the bottom left corner of the Insert Icon button 
                    menu.cfg.setProperty('context', [
                        myEditor.toolbar.getButtonByValue('insertentity').get('element'),
                        'tl',
                        'bl'
                    ]);
                });      
                menu.render(document.body);
                menu.element.style.visibility = 'hidden';
                //return the Overlay instance here               
                return menu;
            }() //This fires the function right now to return the Overlay Instance to the menu property..           
        };
        //Add the new button to the Toolbar Group called insertitem.
     
        myEditor.toolbar.addButtonToGroup(entityConfig, 'insertitem');

        myEditor.toolbar.on('insertentityClick', function(ev) {
            var icon = '';
            this._focusWindow();
            if (ev.icon) {
                icon = ev.icon;
            }
            this.execCommand('inserthtml', icon);
            return false;
        }, myEditor, true);
    }, myEditor, true);
    myEditor.render();
})();
    </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/button/button-beta-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/editor/editor-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    //some of the entities to insert/display
    var entities = ['&fnof;', '&Alpha;', '&Beta;', '&Gamma;', '&Delta;','&Epsilon;', '&Zeta;', '&Eta;', '&Theta;', '&Iota;'];

    //editor toolbar ...
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;
       
    var myConfig = {
        height: (screen.height-260) + 'px',
        width: '530px',
        dompath: true,
        animate: true
        };    
   
        // event handling for entity's overlay
        Event.onAvailable('entityMenu', function() {
            Event.on('entityMenu', 'click', function(ev) {
                var tar = YAHOO.util.Event.getTarget(ev);
                var entity = '';
                if (tar.tagName.toLowerCase() == 'a') {
                    entity = tar.innerHTML;
                }
                var _button = this.toolbar.getButtonByValue('insertentity'); 
                this.toolbar.fireEvent('insertentityClick', { type: 'insertentityClick', icon: entity});
                _button._menu.hide();
                Event.stopEvent(ev);
            }, myEditor, true);
        });
   
    var myEditor = new YAHOO.widget.Editor('editor', myConfig);
    // init of entity's overlay
    myEditor.on('toolbarLoaded', function() {
        var entityConfig = {
            type: 'push', //Using a standard push button
            label: 'Sonderzeichen einfügen', //The name/title of the button
            value: 'insertentity', //The "Command" for the button
            menu: function() {
                //Create the Overlay instance we are going to use for the menu
                var menu = new YAHOO.widget.Overlay('insertentity', {
                    visible: false
                });
                var estr = '';
                for (var b = 0; b < entities.length; b++) {
                    estr += '<a href="#">' + entities[b] + '</a>';
                }
                //Setting the body of the container to our list of images.
                menu.setBody('<div id="entityMenu">' + estr + '</div>');
                menu.beforeShowEvent.subscribe(function() {
                    //Set the context to the bottom left corner of the Insert Icon button 
                    menu.cfg.setProperty('context', [
                        myEditor.toolbar.getButtonByValue('insertentity').get('element'),
                        'tl',
                        'bl'
                    ]);
                });      
                menu.render(document.body);
                menu.element.style.visibility = 'hidden';
                //return the Overlay instance here               
                return menu;
            }() //This fires the function right now to return the Overlay Instance to the menu property..           
        };
        //Add the new button to the Toolbar Group called insertitem.
     
        myEditor.toolbar.addButtonToGroup(entityConfig, 'insertitem');

        myEditor.toolbar.on('insertentityClick', function(ev) {
            var icon = '';
            this._focusWindow();
            if (ev.icon) {
                icon = ev.icon;
            }
            this.execCommand('inserthtml', icon);
            return false;
        }, myEditor, true);
    }, myEditor, true);
    myEditor.render();

    dp.SyntaxHighlighter.HighlightAll('code');
})();

</script>
</body>
</html>
