(function() {

    YAHOO.util.Event.on('load', 'click', function() {
        var loader = new YAHOO.util.YUILoader({
            //We have to set the base globally, so you can't use loader to load YUI from our servers
            base: './',
            //Require my dav module
            require: ['dav'],
            //onSuccess, do something
            onSuccess: function() {
                var dav = new YAHOO.Dav();
                dav.foo();
            }
        });
        //Add the moduleInfo for the dav module
        loader.moduleInfo.dav = {
            //Path to dav.js file
            path: 'dav.js',
            //What do I require?
            requires: ['dom', 'event'],
            //Type of file, JS or CSS
            type: 'js'
        };
        //Insert
        loader.insert();


    });
})();

