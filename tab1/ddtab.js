
YAHOO.tabViewDD = function(elm) {
    this.elm = $(elm);
    this.tab = myTabs = new YAHOO.widget.TabView(elm);
    this.nav = $D.getElementsByClassName('yui-nav', 'ul', this.elm)[0];
    this.list = new YAHOO.widget.SortableList(this.nav);
    this.list.init();
}

