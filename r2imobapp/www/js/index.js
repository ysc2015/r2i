"use strict";

var deviceReadyDeferred = $.Deferred();
var jqmReadyDeferred = $.Deferred();

$.when(deviceReadyDeferred, jqmReadyDeferred).then(doWhenBothFrameworksLoaded);

document.addEventListener('deviceready', deviceReady, false);

function deviceReady() {
    console.log('deviceReady');
    deviceReadyDeferred.resolve();
    //handling others system events begin

    //event fires when an application is put into the background
    document.addEventListener('pause', onPause, false);
    //event fires when an application is retrieved from the background
    document.addEventListener('resume', onResume, false);
    //event fires when the user presses the back button
    document.addEventListener('backbutton', onBackButton, false);
    //event fires when the user presses the menu button
    document.addEventListener('menubutton', onMenuButton, false);

    //handling others system events end
}
//Events Callbacks
var onPause = function() {
    console.log('pause');
};
var onResume = function() {
    console.log('resume');
};
var onBackButton = function() {
    console.log('backbutton');
};
var onMenuButton = function() {
    console.log('menubutton');
};
//system events end
//Event indicating that jQuery Mobile has finished loading
$( document ).on( "mobileinit", function() {

    console.log('mobileinit');

    jqmReadyDeferred.resolve();
});

function doWhenBothFrameworksLoaded() {
    console.log('both framworks phonegap & jqm are loaded');
}

//Device portrait/landscape orientation event
$( window ).on( "orientationchange", function( event ) {
    console.log('orientationchange');
    console.log( "This device is in " + event.orientation + " mode!" );
});
//Triggered on the page being initialized, after initialization occurs
$('#home').on('pageinit', function() {

    console.log('home pageinit');

});
//Triggered after the page is successfully loaded and inserted into the DOM
$('#home').on('pageload', function() {

    console.log('home pageload');

});
//Triggered on the “toPage” we are transitioning to, before the actual transition animation is kicked off
$('#home').on('pagebeforeshow', function() {

    console.log('home pagebeforeshow');

});
//Triggered on the “toPage” after the transition animation has completed
$('#home').on('pageshow', function() {

    console.log('home pageshow');

});


$(window).bind("load", function() {
    // code here
    console.log('window load');
    $("body").fadeIn(2000);
});

$("body").fadeIn('slow', function() {
    r2iApp.init();
});

$('#guide').on('click', function() {
    console.log(otObject);
    var otObject = r2iApp.getOtObject();
    var ot_coord = {lat:otObject.latitude,long:otObject.longitude};
    launchnavigator.navigate(
        [ot_coord.lat, ot_coord.long],
        null,
        function(){
            console.log("Plugin success");
        },
        function(error){
            console.log("Plugin error: "+ error);
        });
});

$('#carto').on('click', function() {
    var about = window.open("carto/carto.html", "_blank", "location=no");
});

//app
var r2iApp = function() {
    //data begin
    var otObject;
    var getOtObject = function() {
        return otObject;
    };
    var loadFromLocal = function() {
        console.log('loadFromLocal');
        //temp code : test loader dialog
        showLoader('chargement des OT ...');
        setTimeout(function(){
            $.getJSON("datasamples/OT.json", function(data){
                console.log('nombre enr : '+data.length);
                hideLoader();
                var list = $('#listot');

                $.each(data, function(key, val){
                    var ahtml = '<h2>'+val.name+'</h2>';
                    ahtml += '<p><strong>Nombre de chambre : 4</strong></p>';
                    var a = $(document.createElement('a'))
                        .addClass('ui-btn') /*ui-btn-icon-right ui-icon-carat-r*/
                        .html(ahtml);
                    a.href = '#';

                    // save data to element
                    a.data('ot', val);
                    a.click(function() {
                        if(event.handled !== true) // This will prevent event triggering more then once
                        {
                            console.log($(this).data('ot'));
                            //listObject.itemID = elementID; // Save li id into an object, localstorage can also be used, find more about it here: http://stackoverflow.com/questions/14468659/jquery-mobile-document-ready-vs-page-events
                            event.handled = true;

                            //copy
                            otObject = jQuery.extend(true, {}, $(this).data('ot'));
                            console.log(JSON.stringify(otObject));

                            //show popup menu
                            $('#listmenutitle').html('OT :'+otObject.name);
                            $('#addmanchonmenutitle').html('OT :'+otObject.name);
                            $('#addpercussionmenutitle').html('OT :'+otObject.name);
                            $.mobile.changePage($("#menu"), { transition: "slide"});
                        }
                    });
                    var el = $(document.createElement('li'))
                            .addClass('ui-first-child ui-last-child')
                            .attr("id",val.id)
                            .append(a)
                            .appendTo(list)/*#here*/
                            ;
                });

            });
        }, 3000);
    };
    //data end

    //loading dialog begin
    var showLoader = function (txt) {
        window.setTimeout(function(){
            $.mobile.loading( 'show', {
                text: txt,
                textVisible: true,
                theme: 'b',
                html: ""
            });
        }, 1);
    };
    var hideLoader = function () {
        window.setTimeout(function(){
            $.mobile.loading('hide');
        }, 1);
    };
    //loading dialog end

    //Init Application
    var initApp = function() {
        loadFromLocal();
    };
    return {
        getOtObject : getOtObject,
        init: function () {
            //run initApp function
            initApp();
        }
    };
}();
