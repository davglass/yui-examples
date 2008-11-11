(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    //Initialize the Editor instance
    var editor = new YAHOO.widget.SimpleEditor('editor', {
        width: '533px',
        height: '300px'
    });
    //Render the editor
    editor.render();

    var button = new YAHOO.widget.Button({
        label: 'Strip Hrefs',
        container: 'button_cont'
    });
    button.on('click', function() {
        //Disabled the editor for effect and to keep the user from editing
        editor.set('disabled', true);
        //Save out the HTML to the textarea so we can grab it.
        editor.saveHTML();
        //Using setTimeout for the disabled effect, not really needed.
        setTimeout(function() {
            //Get the HTML from the saveHTML call above
            var html = editor.get('textarea').value;
            //Run a couple of regexes on the html
            html = html.replace(/<a([^>]*)>/gi, '');
            html = html.replace(/<\/a>/gi, '');
            //Put the content back into the editor
            editor.setEditorHTML(html);
            //Enable the editor
            editor.set('disabled', false);
        }, 2000);
    });

})();

