/**
* @fileoverview Provides the YUI with a script loader.
* @author Dav Glass <dav.glass@yahoo.com>
* @version 0.1 
* @class Provides the YUI with a script loader.
* @constructor
*/
YAHOO.Loader = function() {
    /**
    * Object of scripts to load
    * @private
    * @type Object
    */
    scripts = {};
    /**
    * Object of scripts that have been loaded
    * @private
    * @type Object
    */
    isLoaded = {};
    /**
    * Array of scripts that have been loaded
    * @private
    * @type Array
    */
    transActions = [];
    /**
    * This is a span added to the page to insert the new script tags into.
    * @private
    * @type HTMLElement
    */
    holder = document.createElement('span');
    holder.id = 'yui_loader_holder';
    document.body.appendChild(holder);
    return {
        scripts: scripts,
        isLoaded: isLoaded,
        holder: holder,
        transActions: transActions
    };
}();


/**
* Sucess callback function that is fired after the file is loaded.
* @param {String} fileName The filename passed to add/load method
* @param {Integer} tId The transactionid provided by the Connection Mgr
* @param {String} status The HTTP status returned from the Connection Mgr request
* @param {Object} o The object returned from the Connection Mgr request
*/
YAHOO.Loader.onFileLoad = function(fileName, tId, status, o) {};
/**
* Failure callback function that is fired after the file fails to load.
* @param {String} fileName The filename passed to add/load method
* @param {Integer} tId The transactionid provided by the Connection Mgr
* @param {String} status The HTTP status returned from the Connection Mgr request
* @param {Object} o The object returned from the Connection Mgr request
*/
YAHOO.Loader.onFileFail = function(fileName, tId, status, o) {};
/**
* Private method to request the file via an XHR request.
* @private
* @param {String} name The name of the file that we are requesting with Connection Manager
*/
YAHOO.Loader.insertScript = function(name) {
    if (!this.isLoaded[name]) {
        var _file = name;
        _yuiloader_handler.argument = _file;
        var tmp = YAHOO.util.Connect.asyncRequest('GET', _file, _yuiloader_handler);
        this.transActions[tmp.tId] = _file;
        this.isLoaded[name] = _file;
    }
};
/**
* Private method to add a script tag to the current document and eval the contents.
* @private
* @param {Object} o The object returned by Connection Manager
*/
YAHOO.Loader.insertGood = function(o) {
    this.holder.innerHTML += '<script>' + eval(o.responseText) + '</script>';
    this.onFileLoad(this.transActions[o.tId], o.tId, o.status, o);
};
/**
* Private method to add a script tag to the current document.
* @private
* @param {Object} o The object returned from Connection Manager
*/
YAHOO.Loader.insertBad = function(o) {
    o.fileName = this.transActions[o.tId];
    this.onFileFail(this.transActions[o.tId], o.tId, o.status, o);
};
/**
* Use this to add a script to the script queue
* @param {String/Array} file The file you want to add to the script queue
*/
YAHOO.Loader.add = function(file) {
    if (file instanceof Array) {
        for (var i = 0; i < file.length; i++) {
            this.scripts[files[i]] = file[i];
        }
    } else {
        this.scripts[files] = file;
    }
};
/**
* If no parameter is passed, load all scripts in the script queue, if a file or an array is passed it will load those files.
* @param {Void/String/Array} thisFile The file or array of files to load, if empty it will load all scripts in the script queue
*/
YAHOO.Loader.load = function(thisFile) {
    if (thisFile) {
        if (thisFile instanceof Array) {
            for (var i = 0; i < thisFile.length; i++) {
                this.insertScript(thisFile[i]);
            }
        } else {
            this.insertScript(thisFile);
        }
    } else {
        for (var i in this.scripts) {
            this.insertScript(this.scripts[i]);
        }
    }
};
/**
* Callback Object for Connection Manager Requests
* @private
* @type Object
*/
var _yuiloader_handler = {
    success: YAHOO.Loader.insertGood,
    failure: YAHOO.Loader.insertBad,
    scope: YAHOO.Loader
};

