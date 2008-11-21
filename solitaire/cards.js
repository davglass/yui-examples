
YAHOO.widget.Solitaire = {
    config: {
        board: YAHOO.util.Dom.get('gameboard'),
        dealer: YAHOO.util.Dom.get('dealer'),
        cardup: 28,
        _marker: ['A','2','3','4','5','6','7','8','9','10','J','Q','K'],
        _shuffled: new Array(52),
        cards: {
            hearts: [],
            spades: [],
            diamonds: [],
            clubs: [],
        },
        pos: {
            row1: YAHOO.util.Dom.get('play_holder1'),
            row2: YAHOO.util.Dom.get('play_holder2'),
            row3: YAHOO.util.Dom.get('play_holder3'),
            row4: YAHOO.util.Dom.get('play_holder4'),
            row5: YAHOO.util.Dom.get('play_holder5'),
            row6: YAHOO.util.Dom.get('play_holder6'),
            row7: YAHOO.util.Dom.get('play_holder7'),
            top1: YAHOO.util.Dom.get('done_holder1'),
            top2: YAHOO.util.Dom.get('done_holder2'),
            top3: YAHOO.util.Dom.get('done_holder3'),
            top4: YAHOO.util.Dom.get('done_holder4'),
        },
        dealt: {
            row1: [],
            row2: [],
            row3: [],
            row4: [],
            row5: [],
            row6: [],
            row7: [],
            top1: [],
            top2: [],
            top3: [],
            top4: [],
            play: [],
        }
    },
    _buildDeck: function() {
        var card = 1;
        for (var i = 0; i < this.config._marker.length; i++) {
            this.config.cards.hearts[i] = this.config._marker[i];
            this.config.cards.spades[i] = this.config._marker[i];
            this.config.cards.diamonds[i] = this.config._marker[i];
            this.config.cards.clubs[i] = this.config._marker[i];
        }
    },
    init: function() {
        this._buildDeck();
        this._shuffle();
        this.deal();
        YAHOO.util.Event.addListener(this.config.dealer, 'click', YAHOO.widget.Solitaire.dealCard, YAHOO.widget.Solitaire, true);
        new YAHOO.util.DDTarget(this.config.pos.top1);
        new YAHOO.util.DDTarget(this.config.pos.top2);
        new YAHOO.util.DDTarget(this.config.pos.top3);
        new YAHOO.util.DDTarget(this.config.pos.top4);
    },
    dealCard: function(ev) {
        xy = YAHOO.util.Dom.getXY('dealt');
        //YAHOO.util.Dom.setXY(this.config._shuffled[this.config.cardup].id, xy);
        YAHOO.util.Dom.setStyle(this.config._shuffled[this.config.cardup].id, 'z-index', '999');
        var args = {
            opacity: { to: 1 },
            top: { to: xy[1] },
            left: { to: xy[0] },
            height: { to: 75 },
            width: { to: 50 },
        }
        var myAnim = new YAHOO.util.Anim(this.config._shuffled[this.config.cardup].id, args, 1, YAHOO.util.Easing.easeOut);
        myAnim.animate();
        
        this.config.cardup++;
        if (!this.config._shuffled[this.config.cardup]) {
            this.config.cardup = 28;
        }
        YAHOO.util.Event.stopEvent(ev);
    },
    deal: function() {
        var index = 0;
        for (var i = 1; i < 8; i++) {
            row = eval('this.config.dealt.row' + i);
            pos = eval('this.config.pos.row' + i);
            for (var j = 1; j < i + 1; j++) {
                row[row.length] = this.config._shuffled[index];
                if (j == i) {
                    this.config._shuffled[index].face = 'up';
                }
                this.drawCard(this.config._shuffled[index]);
                //Set Position
                xy = YAHOO.util.Dom.getXY(pos);
                xy[1] = (parseInt(xy[1]) + ((j - 1) * 20));
                xy[0] = (parseInt(xy[0]) + (j - 1));
                YAHOO.util.Dom.setXY(this.config._shuffled[index].id, xy);
                this.config._shuffled[index].drag = new YAHOO.util.DDProxy(this.config._shuffled[index].id); 
                index++;
            }
        }
        for (var i = index; i < this.config._shuffled.length; i++) {
            this.config._shuffled[i].face = 'up';
            this.drawCard(this.config._shuffled[i]);
            this.config.dealt.play[i] = this.config._shuffled[index];
            this.config._shuffled[i].drag = new YAHOO.util.DDProxy(this.config._shuffled[i].id);
            YAHOO.util.Dom.setStyle(this.config._shuffled[i].id, 'opacity', '0');
            YAHOO.util.Dom.setStyle(this.config._shuffled[i].id, 'height', '1px');
            YAHOO.util.Dom.setStyle(this.config._shuffled[i].id, 'width', '1px');
            YAHOO.util.Dom.setXY(this.config._shuffled[i].id, [0,0]);
        }
    },
    drawCard: function(card) {
        if (card.face == 'down') {
            var _card = YAHOO.util.Dom.create('div', {id: card.id, className: 'card'}, [
                YAHOO.util.Dom.create('span', {className: 'face_down'})
            ]);
        } else {
            var _card = YAHOO.util.Dom.create('div', {id: card.id, className: 'card ' + card.color }, [
                YAHOO.util.Dom.create('span', {className: 'face_up' + ' ' + card.suit }, card.value.toUpperCase())
            ]);
        }
        document.body.appendChild(_card);
    },
    _shuffle: function() {
        this.config._shuffled = new Array();
        var tmp = new Array();
        var tmp2 = new Array(52);
        
        for (var s in this.config.cards) {
            for (var c in this.config.cards[s]) {
                tmp[tmp.length] = [s, this.config.cards[s][c]];
            }
        }

        for (var i = 0; i < 52; i++) {
            tmp2[i] = tmp[i] % 52;
        }

        for (var i = 0; i < 52; i++) {
            tmp2[i] = i;
        }
        var _top = Math.floor(Math.random() * 20);
        if (_top == 0) {
            var _top = Math.floor(Math.random() * 20);
        }
        //randomly shuffle the cards from 1 to 20 times!!
        for (var i = 0; i < _top; i++) {
            tmp2 = this._rand(tmp2);
        }
        for (var i = 0; i < 52; i++) {
            this.config._shuffled[i] = new YAHOO.widget.PlayingCard(tmp[tmp2[i]]);
        }
    },
    _rand: function(arr) {
        //Shuffle the cards
        for (var _i = 0; _i < 52; _i++) {
            var __i = Math.floor(Math.random() * 52);
            var ___i = arr[_i];
            arr[_i] = arr[__i];
            arr[__i] = ___i;
        }
        return arr;
    }
}

YAHOO.widget.PlayingCard = function(arr) {
    var _suit = arr[0];
    var _black = ((_suit == 'spades' || _suit == 'clubs') ? true : false);
    var _red = ((_suit == 'diamonds' || _suit == 'hearts') ? true : false);
    var _value = arr[1];
    var _pos = 0;
    var _face = 'down';
    
    return {
        id: _suit + '_' + _value,
        suit: _suit,
        black: _black,
        red: _red,
        color: ((_red) ? 'red' : 'black'),
        value: _value,
        position: _pos,
        face: _face,
    }
}

YAHOO.widget.Solitaire.init();
