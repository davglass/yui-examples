(function() {
    
    //Create the Dav namespace
    YAHOO.namespace('Dav');

    //Create the Dav object
    var Dav = function() {
    };
    
    //Give is a method
    Dav.prototype = {
        foo: function() {
            //This is called from the example page
            var bd = YAHOO.util.Dom.get('bd');
            var div = document.createElement('div');
            div.innerHTML = 'Dav was loaded via YUILoader and is now working..';
            YAHOO.util.Dom.setStyle(div, 'height', '40px');
            YAHOO.util.Dom.setStyle(div, 'width', '200px');
            YAHOO.util.Dom.setStyle(div, 'border', '1px solid black');
            YAHOO.util.Dom.setStyle(div, 'background-color', 'blue');
            YAHOO.util.Dom.setStyle(div, 'color', 'white');
            bd.insertBefore(div, bd.firstChild);
        }
    };
    
    //Make YAHOO.Dav point to the new class
    YAHOO.Dav = Dav;

})();
//Now the important part, register the file with the YAHOO object
YAHOO.register("dav", YAHOO.Dav, {version: "2.5.2", build: "10"});
