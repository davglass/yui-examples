<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>YUI: Toolbar Issue</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css"> 
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">     
    <link rel="stylesheet" href="http://blog.davglass.com/wp-content/themes/davglass/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/css/dpsyntax-min-11.css">
    <style type="text/css" media="screen">
        p, h2 {
            margin: 1em;
        }
	</style>
</head>
<body class="yui-skin-sam">
<div id="davdoc" class="yui-t7">
    <div id="hd"><h1 id="header"><a href="http://blog.davglass.com/">YUI: Toolbar Issue</a></h1></div>
    <div id="bd">
        <form name="ad_create_4" id="ad_create_4" action="http://localhost/etreproprio.com/myspace/ad/update/4/14131" method="post" class="user_form">
        <textarea name="content" id="content" rows="15" cols="50" class="required"></textarea>
        <br />
        <button type="submit" id="submit_form" />Valider</button>
        </form>
        <h2>The Work Around</h2>
        <textarea name="code" class="JScript">
    // Fix the Toolbar Issue
    ad_editor.on('toolbarLoaded', function() {
        this.toolbar._colorPicker = {
            _button: null
        };
    }, ad_editor, true);
        </textarea>
    </div>
    <div id="ft">&nbsp;</div>
</div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/utilities/utilities.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container_core-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/menu/menu-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/button/button-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/editor/editor-beta-min.js"></script> 
<script src="http://us.js2.yimg.com/us.js.yimg.com/i/ydn/yuiweb/js/dpsyntax-min-2.js"></script>
<script type="text/javascript" src="../js/toolseffects-min.js"></script>
<script type="text/javascript" src="../js/davglass.js"></script>
<script type="text/javascript">

//(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

// The editor
var ad_editor, base_url = 'unkown', ad_home_id = 1;

/**
* editor_init
*
* initialize yui editor
*/
function editor_init() {
    // Create the editor
    ad_editor = new YAHOO.widget.SimpleEditor('content', {
        height: '500px',
        width: '480px',
        focusAtStart: true,
        handleSubmit: true,
        toolbar: {
            collapse: false,
            titlebar: 'Description de mon bien',
            draggable: false,
            buttons: [
                {
                    group: 'textstyle', label: ' ',
                    buttons: [
                        { type: 'push', label: 'Gras', value: 'bold' },
                        { type: 'push', label: 'Italique', value: 'italic' },
                        { type: 'push', label: 'Souligné', value: 'underline' }
                    ]
                },
                { type: 'separator' },
                { group: 'insert_item', label: ' ',
                    buttons: [
                        {
                            type: 'push',
                            label: 'Insérer une photo',
                            value: 'insert_photo',
                            menu: function() {
                                var menu = new YAHOO.widget.Overlay('insert_photo', {
                                    width: '400px',
                                    height: '300px',
                                    visible: false
                                });
                                

                                var str = '';
                                
                                str += '<h2>Insérer une photo depuis mon disquedur</h2>';
                                str += '<h3>Format png, jpg ou gif, taille maximum 2Mo</h3>';
                                str += '<br /><br />';
                                str += '<form name="upload_photo_form" id="upload_photo_form" action="' + base_url + 'myspace/media/' + ad_home_id + '/upload_post" method="post" class="" enctype="multipart/form-data">';
                                str += '<input name="photo" id="photo" type="file" size="10" class=" file mime_type-image_png_gif_jpeg max_filesize-2MB" value="" />';
                                str += '<br /><br />';
                                str += '<input type="submit" name="upload_photo_submit" id="upload_photo_submit" value="Valider"/>';
                                str += '<input name="form_id" id="form_id" type="hidden" value="188284" /></form>';
                                str += '<br /><br />';
                                str += '<div id="form_upload_status"></div>';

                                //Setting the body of the container to our list of images.
                                menu.setBody('<div id="insert_photo_menu">' + str + '</div>');
                                
                                // Attach menu to the button
                                menu.beforeShowEvent.subscribe(function() {
                                    menu.cfg.setProperty('context', [
                                        ad_editor.toolbar.getButtonByValue('insert_photo').get('element'),
                                        'tl', 'bl'
                                    ]);
                                });
                                

                                menu.render(document.body);
                                menu.element.style.visibility = 'hidden';
                                return menu;
                            }()
                        }
                    ]
                }
            ]
        }
    });

    // Fix the Toolbar Issue
    ad_editor.on('toolbarLoaded', function() {
        this.toolbar._colorPicker = {
            _button: null
        };

    }, ad_editor, true);

    // Render the editor
    ad_editor.render();

    // Add listener to upload_photo form
    YAHOO.util.Event.on('upload_photo_form', 'submit', upload_photo);
}



function upload_photo(e) {

    // Stop form submission
    YAHOO.util.Event.stopEvent(e);
   
    // Show progress indicator to user
    YAHOO.util.Dom.get('form_upload_status').innerHTML  = "Merci depatienter pendant le transfert de votre photo.";
    YAHOO.util.Dom.get('form_upload_status').innerHTML += '<br />' + "L'opération peut durer quelques minutes si votre photo est grande.";
    YAHOO.util.Dom.get('form_upload_status').innerHTML += '<br />' + '<img src="' + base_url + 'app/img/ajax/loading_animation_liferay.gif" alt="envoi en cours">';
   
    // the second argument of setForm is crucial, which tells Connection Manager this is a file upload form
    YAHOO.util.Connect.setForm('upload_photo_form', true);
       
    var upload_handler = {
        upload: function(o) {

            // Process response
            if (o.responseText == 'bad') {
                alert('Le fichier n\'est pas une image correcte.\nLe type doit être png, jpeg ou gif et la taille inférieure à 2MB');
            } else {
                ad_editor.execCommand('inserthtml', o.responseText);
            }
   
            // Deselect insert_photo button
            ad_editor.toolbar.deselectButton('insert_photo');

            // Hide insert_photo Overlay
            var insert_photo_button = ad_editor.toolbar.getButtonByValue('insert_photo');
            insert_photo_button.getMenu().hide();
            //insert_photo_button._menu.hide();

            //ad_editor.toolbar.getButtonByValue('insert_photo')._menu.hide();
            // Hide progress indicator
            YAHOO.util.Dom.get('form_upload_status').innerHTML = "";
        }
    };

    // Make ajax call
    YAHOO.util.Connect.asyncRequest('POST', base_url  + 'myspace/media/' + ad_home_id +  '/upload_post', upload_handler);
}

    YAHOO.util.Event.onDOMReady(editor_init);


    dp.SyntaxHighlighter.HighlightAll('code');
//})();

</script>
</body>
</html>
