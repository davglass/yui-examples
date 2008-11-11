YUI({combine: true, timeout: 10000}).use('dd-constrain', 'dd-proxy', 'dd-drop', function(Y) {

    //Listen for all drop:over events
    Y.DD.DDM.on('drop:over', function(e) {
        //Get a reference to out drag and drop nodes
        var drag = e.drag.get('node'),
            drop = e.drop.get('node');
        
        //Are we dropping on a li node?
        if (drop.get('tagName').toLowerCase() === 'li') {
            //Are we not going up?
            if (!goingUp) {
                drop = drop.get('nextSibling');
            }
            //Add the node to this list
            e.drop.get('node').get('parentNode').insertBefore(drag, drop);
            //Resize this nodes shim, so we can drop on it later.
            e.drop.sizeShim();
        }
    });
    //Listen for all drag:drag events
    Y.DD.DDM.on('drag:drag', function(e) {
        //Get the last y point
        var y = e.target.lastXY[1];
        //is it greater than the lastY var?
        if (y < lastY) {
            //We are going up
            goingUp = true;
        } else {
            //We are going down..
            goingUp = false;
        }
        //Cache for next check
        lastY = y;
    });
    //Listen for all drag:start events
    Y.DD.DDM.on('drag:start', function(e) {
        var drag = e.target;
        //Convert the dragNode to position absolute
        drag.get('dragNode').setStyles({
            position: 'absolute',
            zIndex: 5
        });
        //Just to be safe, prep it's style.
        drag.get('dragNode').setXY(drag.get('node').getXY());
    });
    //Listen for a drag:end events
    Y.DD.DDM.on('drag:end', function(e) {
        var drag = e.target;
        //Put our old styles back
        drag.get('dragNode').setStyles({
            position: 'static',
            top: '',
            left: ''
        });
    });
    //Listen for all drag:drophit events
    Y.DD.DDM.on('drag:drophit', function(e) {
        var drop = e.drop.get('node'),
            drag = e.drag.get('node');

        //if we are not on an li, we must have been dropped on a ul
        if (drop.get('tagName').toLowerCase() !== 'li') {
            if (!drop.contains(drag)) {
                drop.appendChild(drag);
            }
        }
    });
    
    //Static Vars
    var goingUp = false, lastY = 0;

    //Get the list of li's in the lists and make them draggable
    var lis = Y.Node.all('#play ul li');
    lis.each(function(v, k, items) {
        var dd = new Y.DD.Drag({
            node: items.item(k),
            //Turn off proxy and use this item as the proxy.
            dragNode: items.item(k).query('span'),
            moveOnEnd: false,
            constrain2node: '#play',
            target: {
                padding: '0 0 0 20'
            }
        });
    });

    //Create simple targets for the 2 lists..
    var uls = Y.Node.all('#play ul');
    uls.each(function(v, k, items) {
        var tar = new Y.DD.Drop({
            node: items.item(k)
        });
    });
    
});

