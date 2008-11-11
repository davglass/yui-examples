(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang,
        Toolbar = YAHOO.widget.Toolbar;

    YAHOO.widget.SimpleEditor.prototype.cleanHTML = function(html) {
        //Start Filtering Output
        //Begin RegExs..
        if (!html) { 
            html = this.getEditorHTML();
        }
        var markup = this.get('markup');
        //Make some backups...
        html = this.pre_filter_linebreaks(html, markup);

        html = html.replace(/<img([^>]*)\/>/gi, '<YUI_IMG$1>');
        html = html.replace(/<img([^>]*)>/gi, '<YUI_IMG$1>');

        html = html.replace(/<input([^>]*)\/>/gi, '<YUI_INPUT$1>');
        html = html.replace(/<input([^>]*)>/gi, '<YUI_INPUT$1>');

        html = html.replace(/<ul([^>]*)>/gi, '<YUI_UL$1>');
        html = html.replace(/<\/ul>/gi, '<\/YUI_UL>');
        html = html.replace(/<blockquote([^>]*)>/gi, '<YUI_BQ$1>');
        html = html.replace(/<\/blockquote>/gi, '<\/YUI_BQ>');

        //Convert b and i tags to strong and em tags
        if ((markup == 'semantic') || (markup == 'xhtml')) {
            html = html.replace(/<i([^>]*)>/gi, '<em$1>');
            html = html.replace(/<\/i>/gi, '</em>');
            html = html.replace(/<b([^>]*)>/gi, '<strong$1>');
            html = html.replace(/<\/b>/gi, '</strong>');
        }
        
        //Case Changing
        html = html.replace(/<font/gi, '<font');
        html = html.replace(/<\/font>/gi, '</font>');
        html = html.replace(/<span/gi, '<span');
        html = html.replace(/<\/span>/gi, '</span>');
        if ((markup == 'semantic') || (markup == 'xhtml') || (markup == 'css')) {
            html = html.replace(new RegExp('<font([^>]*)face="([^>]*)">(.*?)<\/font>', 'gi'), '<span $1 style="font-family: $2;">$3</span>');
            html = html.replace(/<u/gi, '<span style="text-decoration: underline;"');
            html = html.replace(/\/u>/gi, '/span>');
            if (markup == 'css') {
                html = html.replace(/<em([^>]*)>/gi, '<i$1>');
                html = html.replace(/<\/em>/gi, '</i>');
                html = html.replace(/<strong([^>]*)>/gi, '<b$1>');
                html = html.replace(/<\/strong>/gi, '</b>');
                html = html.replace(/<b/gi, '<span style="font-weight: bold;"');
                html = html.replace(/\/b>/gi, '/span>');
                html = html.replace(/<i/gi, '<span style="font-style: italic;"');
                html = html.replace(/\/i>/gi, '/span>');
            }
            html = html.replace(/  /gi, ' '); //Replace all double spaces and replace with a single
        } else {
            html = html.replace(/<u/gi, '<u');
            html = html.replace(/\/u>/gi, '/u>');
        }
        html = html.replace(/<ol([^>]*)>/gi, '<ol$1>');
        html = html.replace(/\/ol>/gi, '/ol>');
        html = html.replace(/<li/gi, '<li');
        html = html.replace(/\/li>/gi, '/li>');
        html = this.filter_safari(html);

        html = this.filter_internals(html);

        html = this.filter_all_rgb(html);

        //Replace our backups with the real thing
        html = this.post_filter_linebreaks(html, markup);

        if (markup == 'xhtml') {
            html = html.replace(/<YUI_IMG([^>]*)>/g, '<img $1/>');
            html = html.replace(/<YUI_INPUT([^>]*)>/g, '<input $1/>');
        } else {
            html = html.replace(/<YUI_IMG([^>]*)>/g, '<img $1>');
            html = html.replace(/<YUI_INPUT([^>]*)>/g, '<input $1>');
        }
        html = html.replace(/<YUI_UL([^>]*)>/g, '<ul$1>');
        html = html.replace(/<\/YUI_UL>/g, '<\/ul>');

        html = this.filter_invalid_lists(html);

        html = html.replace(/<YUI_BQ([^>]*)>/g, '<blockquote$1>');
        html = html.replace(/<\/YUI_BQ>/g, '<\/blockquote>');

        //Trim the output, removing whitespace from the beginning and end
        html = YAHOO.lang.trim(html);

        if (this.get('removeLineBreaks')) {
            html = html.replace(/\n/g, '').replace(/\r/g, '');
            html = html.replace(/  /gi, ' '); //Replace all double spaces and replace with a single
        }
        
        //First empty span
        if (html.substring(0, 6).toLowerCase() == '<span>')  {
            html = html.substring(6);
            //Last empty span
            if (html.substring(html.length - 7, html.length).toLowerCase() == '</span>')  {
                html = html.substring(0, html.length - 7);
            }
        }


        for (var v in this.invalidHTML) {
            if (YAHOO.lang.hasOwnProperty(this.invalidHTML, v)) {
                if (Lang.isObject(v) && v.keepContents) {
                    html = html.replace(new RegExp('<' + v + '([^>]*)>(.*?)<\/' + v + '>', 'gi'), '$1');
                } else {
                    html = html.replace(new RegExp('<' + v + '([^>]*)>(.*?)<\/' + v + '>', 'gi'), '');
                }
            }
        }

        this.fireEvent('cleanHTML', { type: 'cleanHTML', target: this, html: html });

        return html;
    };
})();
