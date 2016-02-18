// Application component
var app = function() {
    //OT Object
    var otObject;
    //
    var deviceReadyDeferred;
    var jqmReadyDeferred;
    //Callbacks functions
    var applicationDidFinishLoading = function() {
        console.log('applicationDidFinishLoading');
        $.ajax({
            url: 'http://sd-83414.dedibox.fr/r2i/api/mobileApi.php',
            type: 'POST',
            dataType: 'json',
            data: {method : 'get_job_orders'},
            success: function (response) {
                console.log('get_job_orders:success');
                console.log(response);
            },
            error: function (e) {
                console.log('get_job_orders:error');
                console.log(e.responseText);
            }
        });
        state.init();
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

//initialze app on body load(fade anim)
$(window).bind("load", function() {
    // code here
    console.log('window load');
    $("body").fadeIn(1000);
});
app.init();

