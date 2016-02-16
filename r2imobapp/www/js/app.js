"use strict";
//DB component
var db = function() {
    var initDB = function() {
        console.log('init DB');
    };
    return {
        init: function () {
            //run initApp function
            initDB();
        }
    };
}();
// Application component
var app = function() {
    //OT Object
    var otObject;
    //
    var deviceReadyDeferred;
    var jqmReadyDeferred;
    //app events
    var applicationDidFinishLoading = function() {
      console.log('applicationDidFinishLoading');
        db.init();
    };
    var devicePluginsDidLoad = function() {
        console.log('devicePluginsDidLoad');
        deviceReadyDeferred.resolve();
    };
    //core functions
    var initEvents = function() {
        deviceReadyDeferred = $.Deferred();
        jqmReadyDeferred = $.Deferred();

        document.addEventListener('deviceready', devicePluginsDidLoad, false);

        //Event indicating that jQuery Mobile has finished loading
        $(document).on( "mobileinit", function() {

            console.log('mobileinit')
            jqmReadyDeferred.resolve();
        });

        //When both device cordova plugins & jqm are loaded
        $.when(deviceReadyDeferred, jqmReadyDeferred).then(applicationDidFinishLoading);
    };
    var initApp = function() {
        console.log('init app');

        initEvents();
    };
    return {
        otObject:otObject,
        init: function () {
            //run initApp function
            initApp();
        }
    };
}();

app.init();