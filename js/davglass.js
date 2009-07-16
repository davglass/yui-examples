YAHOO.davglass = {
    init: function() {
        this.bd = $('bd');
        this.menu = $T.create('div', { id: 'yui_menu' }, 
        [
            $T.create('ul', [
                $T.create('li', [$T.create('a', { href: '/', title: 'Home' }, 'Home')]),
                $T.create('li', [$T.create('a', { href: '/files/yui/tools/', title: 'Tools' }, 'Tools')]),
                $T.create('li', [$T.create('a', { href: '/files/yui/effects/', title: 'Effects' }, 'Effects')]),
                $T.create('li', [$T.create('a', { href: '/files/yui/dhtmlforms/', title: 'DHTMLForms' }, 'DHTMLForms')]),
                $T.create('li', [$T.create('a', { href: '/files/yui/sortable/', title: 'Sortable List' }, 'Sortable List')]),
                $T.create('li', [$T.create('a', { href: '/files/yui/', title: 'More Code Samples' }, 'Code Samples')])//,
//                $T.create('li', [$T.create('a', { href: '/files/yui/docs/', title: 'Docs' }, 'Docs')])
            ])
        ]
        );
        this.bd.insertBefore(this.menu, this.bd.firstChild);

        var s = document.createElement('script');
        s.setAttribute('type', 'text/javascript');
        s.setAttribute('src', 'http://track3.mybloglog.com/js/jsserv.php?mblID=2006122110102837');
        document.body.appendChild(s);
    }
}
$E.onAvailable('bd', YAHOO.davglass.init);

