YAHOO.PT = {};

//YAHOO.util.DDM.mode = YAHOO.util.DDM.INTERSECT; 

YAHOO.PT.Friends = function( isDraggable, lists ) {
    this.lists    = lists;
    this.elements = {};

    var _this = this;

    for ( var i = 0; i < lists.length; i++ ) {
        var el = YAHOO.util.Dom.get(lists[i]);
        if ( el ) {
            lis = el.getElementsByTagName('li');
            //for ( var j = 0; j < el.childNodes.length; j++ ) {
            for ( var j = 0; j < lis.length; j++ ) {
                //var child = el.childNodes[j];
                var child = lis[j];
                    if ( isDraggable )
                        new YAHOO.PT.FriendList(child);
                    YAHOO.util.Event.addListener(child, "mousedown",
                        function(e, o) { _this.highlightFriend(e, o) }, child);
            }
        }
    }
}

YAHOO.PT.Friends.prototype.highlightFriend = function(e, target) {
    while ( target.tagName != "LI" && target.parentNode )
        target = target.parentNode;
    if ( !target ) return;
    if ( YAHOO.util.Dom.hasClass(target, "highlight") ) {
        delete this.elements[target.id];
        YAHOO.util.Dom.removeClass(target, "highlight");
    } else {
        this.elements[target.id] = target;
        YAHOO.util.Dom.addClass(target, "highlight");
    }
};

YAHOO.PT.Friends.prototype.highlightedFriends = function() {
    var ary = new Array();
    for ( id in this.elements ) {
        ary.push(id.split('_')[1]);
    }
    return ary;
}

YAHOO.PT.Friends.prototype.clearHighlightedFriends = function() {
    var list = this.elements;
    for ( id in list ) {
        this.highlightFriend(false, list[id] );
    }
}

YAHOO.PT.Friends.prototype.serialize = function(delim) {
    if ( !this.lists ) return '';
    var list = new Array();
    for ( var i = 0; i < this.lists.length; i++ ) {
        var el = YAHOO.util.Dom.get(this.lists[i]);
        if ( el ) {
            for ( var j = 0; j < el.childNodes.length; j++ ) {
                var child = el.childNodes[j];
                /* FIXME: This is extremely limited... */
                list.push(child.id.split('_')[1]);
            }
        }
    }
    return list.join(delim || ',');
}

YAHOO.PT.Friends.prototype.serializeToForm = function(delim) {
alert("Serializing to form...");
    if ( !this.lists ) return '';
    for ( var i = 0; i < this.lists.length; i++ ) {
        var dest = YAHOO.util.Dom.get(this.lists[i] + "Serialized");
        if ( dest ) {
            var list = new Array();
            var el = YAHOO.util.Dom.get(this.lists[i]);
            if ( el ) {
                for ( var j = 0; j < el.childNodes.length; j++ ) {
                    var child = el.childNodes[j];
                    /* FIXME: This is extremely limited... */
                    list.push(child.id.split('_')[1]);
                }
            }
            dest.value = list.join(delim || ',');
        }
    }
}

YAHOO.PT.FriendList = function(id) {
    if ( id ) {
        this.init(id);
        this.initFrame();
    }
    var s = this.getDragEl().style;
    s.borderColor     = "transparent";
    s.backgroundColor = "#f6f6e5";
    s.opacity         = 0.76;
    s.filter          = "alpha(opacity=76)";
};
YAHOO.extend(YAHOO.PT.FriendList, YAHOO.util.DDProxy);

YAHOO.PT.FriendList.prototype.startDrag = function(x, y) {
    var dragEl  = this.getDragEl();
    var clickEl = this.getEl();

    dragEl.style.border = "1px solid blue";
};

YAHOO.PT.FriendList.prototype.onDrag = function(e, id) {

};

YAHOO.PT.FriendList.prototype.endDrag = function(e) {

};

YAHOO.PT.FriendList.prototype.onDragOver = function(e, id) {
    var el;
    if ( "string" == typeof id ) {
        /* Ask manager what it is  exactly */
        el = YAHOO.util.DDM.getElement(id);
    } else {
        el = YAHOO.util.DDM.getBestMatch(id).getEl(); /* Guess */
    }

    var mid = YAHOO.util.DDM.getPosY(el) + ( Math.floor(el.offsetTop / 2));

    if ( YAHOO.util.Event.getPageY(e) < mid ) {
        var p = el.parentNode;
        var el2 = this.getEl();
        /* Moving between lists, we must take the first (non-self) item and
         * swap
        */
        if ( p.id != el2.parentNode.id ) {
            var p2 = el2.parentNode;
            /* Moving to the top friends */
            if ( p.id == "topFriends" ) {
                alert("Welcome to the club");
            }
            /* Moving away from the top friends */
            else {
                var c = p.getElementsByTagName("LI")[0];
                p.removeChild(c);
                p2.appendChild(c);
            }
            //el2.parentNode.insertBefore(p.firstChild, el2);
        }
        p.insertBefore(el2, el);
    }
};

YAHOO.PT.FriendList.prototype.onDragEnter = function(e, id) {
    this.getDragEl().style.border = "1px solid #449629";
};

YAHOO.PT.FriendList.prototype.onDragOut = function(e, id) {
    this.getDragEl().style.border = "1px solid #964428";
};


YAHOO.PT.FriendList.prototype.toString = function() {
    return this.id.split('_')[-1];
};

