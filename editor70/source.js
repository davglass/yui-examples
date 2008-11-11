(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        out = Dom.get('out');

    var editor = new YAHOO.widget.Editor('editor', {
        height: '300px',
        width: '650px',
        dompath: true
    });
    editor.on('cleanHTML', function(e) {
        var html = e.html;


        html = html.replace(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi,"[url=$1]$2[/url]");
        html = html.replace(/<span style=\"color: ?(.*?);\">(.*?)<\/span>/gi,"[color=$1]$2[/color]");
        html = html.replace(/<font.*?color=\"(.*?)\".*?>(.*?)<\/font>/gi,"[color=$1]$2[/color]");
        html = html.replace(/<span style=\"font-size:(.*?);\">(.*?)<\/span>/gi,"[size=$1]$2[/size]");
        html = html.replace(/<span style=\"font-family:(.*?);\">(.*?)<\/span>/gi,"[font=$1]$2[/font]");
        html = html.replace(/<span  style=\"font-family:(.*?);\">(.*?)<\/span>/gi,"[font=$1]$2[/font]");
        html = html.replace(/<font>(.*?)<\/font>/gi,"$1");
        html = html.replace(/<img.*?src=\"(.*?)\".*?>/gi,"[img]$1[/img]");
        html = html.replace(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");

        html = html.replace(/<\/li>/gi,"");
        html = html.replace(/<li>/gi,"[*]");
        html = html.replace(/<ul>/gi,"[list]");
        html = html.replace(/<\/ul>/gi,"[/list]");
        html = html.replace(/<ol>/gi,"[list type=A]");
        html = html.replace(/<\/ol>/gi,"[/list]");


        html = html.replace(/<\/(strong|b)>/gi,"[/b]");
        html = html.replace(/<(strong|b).*?>/gi,"[b]");
        html = html.replace(/<\/(em|i)>/gi,"[/i]");
        html = html.replace(/<(em|i).*?>/gi,"[i]");
        html = html.replace(/<\/u>/gi,"[/u]");
        html = html.replace(/<span style=\"text-decoration: ?underline;\">(.*?)<\/span>/gi,"[u]$1[/u]");
        html = html.replace(/<span style=\"font-weight: ?bold;\">(.*?)<\/span>/gi,"[b]$1[/b]");
        html = html.replace(/<u.*?>/gi,"[u]");
        html = html.replace(/<blockquote[^>]*>/gi,"[quote]");
        html = html.replace(/<\/blockquote>/gi,"[/quote]");

        html = html.replace(/<br \/>/gi,"\n");
        html = html.replace(/<br\/>/gi,"\n");
        html = html.replace(/<br>/gi,"\n");
        html = html.replace(/<p.*?>/gi,"");
        html = html.replace(/<\/p>/gi,"\n");
        html = html.replace(/&nbsp;/gi," ");
        html = html.replace(/&quot;/gi,"\"");
        html = html.replace(/&lt;/gi,"<");
        html = html.replace(/&gt;/gi,">");
        html = html.replace(/&amp;/gi,"&");


        out.value = html;
    });
    editor.render();

    var button = new YAHOO.widget.Button('saveOut');
    button.on('click', function() {
        editor.cleanHTML();
        Dom.setStyle(out, 'display', 'block');
    });
})();
