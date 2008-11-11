<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Editor Example</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <style type="text/css">
  /* NOT PART OF THE ORGINIAL PAGE */
  body { font-size:small; font-family:Verdana, sans-serif; background: #eef;}
  form { background:#fff; position:relative;display:block;margin:0 auto; width:600px;}
  pre { border:1px solid #ccc; background:#eee; padding:5px;}
  pre .comment { color:darkgreen; }
  pre .break { background:yellow;color:black; }
  #explain { width:600px; font-familiy:Georgia, serif;position:relative; margin:0 auto; }
  /* NOT PART OF THE ORGINIAL PAGE */
  </style>
  <script type="text/javascript" src="http://robballou.com/app/js/MochiKit/MochiKit.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/admin.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/SortTables-min.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/Grunt-min.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/dragdrop/dragdrop-min.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/animation/animation-min.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/event/event-min.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/utilities/utilities.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/container/container-min.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/menu/menu-min.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/button/button-beta-min.js"></script>
  <script type="text/javascript" src="http://robballou.com/app/js/yui/build/editor/editor-beta-min.js"></script>
  <script type="text/javascript">
  var editor = true

  /*=========================================================================
    Initialize the editor
  =========================================================================*/
  if(typeof(Grunt.widgets) == "undefined"){ Grunt.widgets = {} }

  YAHOO.util.Event.addListener(window, 'load', function(){
    /*
      Create the RTE editor
    */
    Grunt.widgets.editor = new YAHOO.widget.Editor('contentArea', {
      height: '300px',
      width: '498px',
      dompath: true,
      animate: true,
      markup: "xhtml",
      removeLinkBreaks:false,
      // CSS for the iFrame that is used by the editor
      css: 'body { background:#fff;font:normal 11px/1.25em Verdana,sans-serif; padding:1em; }span.yui-tag-a {color: blue; text-decoration: underline;}span.yui-tag-blockquote {margin: 1em; display: block;}span.yui-tag-indent {margin-left: 1em; display: block;}.warning-localfile {border-bottom: 1px dashed red !important;}h1 {font-size:1.3em;}h2 {font-size:1.1em;color:#666}table {border-top:1px dotted #ccc;border-right:1px dotted #ccc;}td {border-left:1px dotted #ccc;border-bottom:1px dotted #ccc;}th{background:#eee;font-weight:bold;}',
      toolbar: {
        titlebar: 'Content Editor',
        buttons: [
          { type: 'push', label: 'Save', value: 'save' },
          { type: 'separator' },
          { type: 'push', label: 'Bold', value: 'bold' },
          { type: 'push', label: 'Italic', value: 'italic' },
          { type: 'push', label: 'Underline', value: 'underline' },
          { type: 'separator' },
          { type: 'push', label: 'Unordered List', value:'insertunorderedlist' },
          { type: 'push', label: 'Ordered List', value:'insertorderedlist' },
          { type: 'separator' },
          { type: 'push', label: 'Link', value: 'createlink', disabled: true },
          { type: 'select', label: 'Heading', value: 'header', disabled: true,
            menu: [
              { text: 'Paragraph', checked: true},
              { text: 'Header' },
              { text: 'Subheader' }
            ]
          },
          { type: 'separator' },
          { type: 'push', label: 'Add Media', value: 'media' }
        ]
      }
    })
    // END RTE creation

    // init the media center module
    Grunt.widgets.editor.mediaCenter = new YAHOO.widget.Module("editorMediaCenter", { visible: false, iframe: true })

    Grunt.widgets.editor.mediaCenter.render()

    //----------------------------------------------------------------------
    // METHODS
    //----------------------------------------------------------------------

    /*
      filterHTML()

      Editor HTML filters. Currently this adds some linebreaks automatically
    */
    Grunt.widgets.editor.filterHTML = function(){
      log('filterHTML()')
      this.saveHTML()
      html = YAHOO.lang.trim($('contentArea').value)

      // add line breaks to the end of a paragraph
      html = html.replace(/<\/p>/gi, "</p>\n\n")
      // add a line break to the end of a br
      html = html.replace(/<br\s?\/>/gi, "<br />\n");
      // remove redundant line breaks
      html = html.replace(/\n{3,}/gi, "\n\n")

      // save the html back to the editor
      html = YAHOO.lang.trim(html)
      if(html == '<p>'){ html = '' }
      // remove trailing line breaks
      while(html.substring(html.length - 6) == '<br />'){
        html = YAHOO.lang.trim(html.substring(0, html.length - 6))
      }
      this.get('textarea').value = html
      this.setEditorHTML(this.get('textarea').value)
    }

    /*
      addedFile()

      An image has been added to the page. We need to add the code for the image
      to the content area and update the editor.
    */
    Grunt.widgets.editor.addedFile = function(file, label, id, fileType, fileSize){
      // remove the iframe - we don't need it anymore
      removeElement('addfile')

      // make sure we have the latest changes in the textarea
      var e = Grunt.widgets.editor
      e.saveHTML()

      // update the textarea with the IMG code
      e.get('textarea').value = toHTML(
        A({href: file, target: "_blank", 'class': 'grunt-file grunt-file-'+ fileType, id: 'file-'+ id}, 
          SPAN({'class': 'grunt-file-label'}, label),
          SPAN({'class': 'grunt-file-metadata'}, 
            " (", 
            SPAN({'class': 'grunt-file-metaFileType'}, fileType),
            ", ",
            SPAN({'class': 'grunt-file-metaFileSize'}, fileSize),
            ")"
          )
        )) + e.get('textarea').value

      // update the editor and hide the media panel
      e.setEditorHTML(e.get('textarea').value)
      e.toggleMedia()
    }

    /*
      addedImage()

      An image has been added to the page. We need to add the code for the image
      to the content area and update the editor.
    */
    Grunt.widgets.editor.addedImage = function(image, id){
      // remove the iframe - we don't need it anymore
      removeElement('addimage')

      // make sure we have the latest changes in the textarea
      var e = Grunt.widgets.editor
      e.saveHTML()

      // update the textarea with the IMG code
      e.get('textarea').value = toHTML(IMG({src: image, alt: "", id: "image-"+id})) + e.get('textarea').value

      // update the editor and hide the media panel
      e.setEditorHTML(e.get('textarea').value)
      e.toggleMedia()

      // add a notice message
      this.setMessage('notice', 'The image has been added.');
    }

    /*
      setMessage()

      Set the page's notice/error message

      Params:
        - type: notice/error
        - message
    */
    Grunt.widgets.editor.setMessage = function(t, msg){
      if(!$('messages')){ return }
      replaceChildNodes('messages',
        DIV({'class':t}, msg)
      )
    }

    /*
      toggleEditor()

      Show or hide the RTE editor. When the editor is hidden the plain text source
      is shown.
    */
    Grunt.widgets.editor.toggleEditor = function(){
      if(editor){
        // --------------------------------------------
        // show HTML
        Grunt.widgets.editor.save()

        // create the animation for the editor
        var a = new YAHOO.util.Anim(
          Grunt.widgets.editor.get('element_cont').get('firstChild'),
          { opacity: { from:1, to:0 } }, .25, YAHOO.util.Easing.easeOut
        )

        // change the button text
        var s = $('showHTML')
        for(var i=0;i<s.childNodes.length;i++){
          if(s.childNodes[i].nodeName == 'SPAN'){
            replaceChildNodes(s.childNodes[i], ' Show Editor')
            break
          }
        }

        // hide the media center if necessary
        if(Grunt.widgets.editor.mediaCenterVisible){ Grunt.widgets.editor.toggleMedia() }

        // setup the onComplete event so that it will switch the editor and textarea
        a.onComplete.subscribe(function(){
          var e = Grunt.widgets.editor
          e.get('element_cont').removeClass('yui-editor-container')
          with(YAHOO.util.Dom){
            setStyle(e.get('element_cont').get('firstChild'), 'position', 'absolute')
            setStyle(e.get('element_cont').get('firstChild'), 'top', '-9999px')
            setStyle(e.get('element_cont').get('firstChild'), 'left', '-9999px')
            setStyle(e.get('textarea'), 'display', 'block')
            setStyle(e.get('element'), 'visibility', 'visible')
            setStyle(e.get('element'), 'top', '')
            setStyle(e.get('element'), 'left', '')
            setStyle(e.get('element'), 'position', 'static')
          }
          editor = false
        })

        // make the transition
        a.animate()
      }
      else {
        // --------------------------------------------
        // show editor
        var e = Grunt.widgets.editor

        // update the editor
        e.setEditorHTML(e.get('textarea').value)
        e.get('element_cont').addClass('yui-editor-container')

        // change the button text
        var s = $('showHTML')
        for(var i=0;i<s.childNodes.length;i++){
          if(s.childNodes[i].nodeName == 'SPAN'){
            replaceChildNodes(s.childNodes[i], ' Show HTML')
          }
        }

        // show the editor
        with(YAHOO.util.Dom){
          setStyle(e.get('element_cont').get('firstChild'), 'position', 'static')
          setStyle(e.get('element_cont').get('firstChild'), 'top', '0')
          setStyle(e.get('element_cont').get('firstChild'), 'left', '0')
          setStyle(e.get('textarea'), 'display', 'none')
          setStyle(e.get('element'), 'visibility', 'hidden')
          setStyle(e.get('element'), 'top', '-9999px')
          setStyle(e.get('element'), 'left', '-9999px')
          setStyle(e.get('element'), 'position', 'absolute')
        }

        // reanimate the editor back into place
        var a = new YAHOO.util.Anim(
          e.get('element_cont').get('firstChild'),
          { opacity: { from:0, to:1 } }, .25, YAHOO.util.Easing.easeOut
        )
        a.onComplete.subscribe(function(){
          Grunt.widgets.editor._setDesignMode('on')
          editor = true
        })
        a.animate()
      }
      return false
    }

    Grunt.widgets.editor.mediaCenterVisible = false

    Grunt.widgets.editor.toggleMedia = function() {
        if (!this.mediaCenterVisible) {
          // show the media center
          //this._setDesignMode('off');
          alert(this._getDoc().title);
          this._getDoc().designMode = 'Off';
          alert(this._getDoc().title);
          this.mediaCenter.show();
          // this.mediaCenterVisible = true
        } else {
          // hide the media center
          // this.mediaCenter.hide()
          // this._setDesignMode('on')
          // this.mediaCenterVisible = false
        }
    };

    /*
    */
    Grunt.widgets.editor.showAddFileForm = function(e){
      log('showAddFileForm')
      YAHOO.util.Event.stopEvent(e)
      //hideElement('editorMediaCenter-controls')
      //appendChildNodes('editorMediaCenter', createDOM('iframe', {id: 'addfile', 'class': 'editorMediaCenter-iframe', src: 'addFile/'}))
    }

    /*
    */
    Grunt.widgets.editor.showAddImageForm = function(e){
      YAHOO.util.Event.stopEvent(e)
      hideElement('editorMediaCenter-controls')
      appendChildNodes('editorMediaCenter', 
        createDOM('iframe', {id: 'addimage', 'class': 'editorMediaCenter-iframe', src: 'addImage/'}),
        P({id:'editorMediaCenter-controls2'}, A({href:'', id:'editorMediaCenter-control-back'}, '« Back'))
      )
    }

    // update which buttons are disabled by default
    Grunt.widgets.editor._disabled[Grunt.widgets.editor._disabled.length] = 'header'

    // update the editor toolbar
    Grunt.widgets.editor.on('toolbarLoaded', function(){

      // --------------------------------------------
      // save button
      this.toolbar.on('saveClick', function(o) {
        this.save()
        $('contentAreaForm').submit()
      }, Grunt.widgets.editor, true)

      // --------------------------------------------
      // header button
      this.toolbar.on('headerClick', function(o) {
        var sel = this._getSelection()
        switch(o.button.value){
        case 'Paragraph':
          this.execCommand('inserthtml', '<p>'+sel+'</p>')
          break
        case 'Header':
          this.execCommand('inserthtml', '<h1>'+sel+'</h1>')
          break
        case 'Subheader':
          this.execCommand('inserthtml', '<h2>'+sel+'</h2>')
          break
        }
      }, Grunt.widgets.editor, true);

      // --------------------------------------------
      // media button
      this.toolbar.on('mediaClick', function(o){
        this.toggleMedia();
        return false;
      }, this, true);

    })

    /*
      save()
    */
    Grunt.widgets.editor.save = function(){
      Grunt.widgets.editor.filterHTML()
      Grunt.widgets.editor.saveHTML() 
    }

    // render the editor
    Grunt.widgets.editor.render()

    // =======================================================
    // EVENT REGISTRATION

    // register the onclick event for the show HTML element
    YAHOO.util.Event.addListener('showHTML', 'click', function(e){ 
      Grunt.widgets.editor.toggleEditor()
      YAHOO.util.Event.stopEvent(e)
    })
    YAHOO.util.Event.addListener('editorMediaCenter-addimage', 'click', Grunt.widgets.editor.showAddImageForm)
    YAHOO.util.Event.addListener('editorMediaCenter-addfile', 'click', Grunt.widgets.editor.showAddFileForm)
  });
  </script>

  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css" />
  <link rel="stylesheet" type="text/css" href="http://robballou.com/app/css/newAdmin.css" />
  <style>
  #contentArea_toolbar, .yui-editor-editable-container, #contentArea_dompath { border-left:0; border-right: 0; }
  #contentArea_dompath { position:relative;top:6px;border-bottom:0}
  .yui-skin-pnmg .yui-editor-container .yui-editor-editable-container { border-style:none}
  .yui-toolbar-subcont { margin-top:4px;}
  #yui-editor-panel_c { z-index:50}

    .yui-skin-sam .yui-toolbar-container .yui-push-button, .yui-skin-sam .yui-toolbar-container .yui-color-button, .yui-skin-sam .yui-toolbar-container .yui-menu-button {
        float: left;
    }

  </style>
  
</head>
<body class="yui-skin-sam"><a name="top"></a>
  <div id="explain">
    <h1>Notes</h1>
    <p>This page demonstrates an issue that I am having with the YUI RTE. If you click the last button on the editor (I'm not sure why the buttons are laid out the way they are) in IE 6,
      the editor will load it self into the iframe.</p>
      
    <h2>Code notes</h2>
    <p>Pressing the add media button triggers the <code>Grunt.widgets.editor.toggleMedia()</code> method.</p>
    
<pre>
  Grunt.widgets.editor.toggleMedia = function(){
    if(!this.mediaCenterVisible){
      <span class="comment">// show the media center</span>
      this.mediaCenter.show()
      <span class="break">this._setDesignMode('off')</span>
      <span class="comment">// this.mediaCenterVisible = true</span>
    }
    else {
      <span class="comment">// hide the media center
      // this.mediaCenter.hide()
      // this._setDesignMode('on')
      // this.mediaCenterVisible = false</span>
    }
  }  
</pre>
    <p>If you comment out the highlighted line, <a href="editor2.php">this behavior does not occur</a>.</p>

  </div>
  <form action="" method="post">
    <div id="editorTools"><a href="" id="showHTML" title="Toggle between the editor and HTML view"><img src="http://robballou.com/app/images/icons_silk/page_white_code.png" alt="Show HTML" /><span> Show HTML</span></a></div>
    <textarea name="contentArea" id="contentArea" rows="8" cols="40"></textarea>
    <div id="editorMediaCenter">
      <div id="editorMediaCenter-controls">
        <p><a href="" id="editorMediaCenter-addimage" class="editorMediaCenter-button"><img src="http://robballou.com/app/images/icons_silk/image_add.png" alt="" /> <span class="label">Add a new image</span></a></p>
        <p><a href="" id="editorMediaCenter-addfile" class="editorMediaCenter-button"><img src="http://robballou.com/app/images/icons_silk/newspaper_add.png" alt="" /> <span class="label">Add a new file</span></a></p>
      </div>
    </div>
  </form>
</body>
</html>
