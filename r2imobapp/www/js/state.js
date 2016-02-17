// Application state component
var state = function() {
    //get connection type
    var getConnectionType = function() {
        var networkState = navigator.connection.type;

        var states = {};
        states[Connection.UNKNOWN]  = 'Unknown connection';
        states[Connection.ETHERNET] = 'Ethernet connection';
        states[Connection.WIFI]     = 'WiFi connection';
        states[Connection.CELL_2G]  = 'Cell 2G connection';
        states[Connection.CELL_3G]  = 'Cell 3G connection';
        states[Connection.CELL_4G]  = 'Cell 4G connection';
        states[Connection.CELL]     = 'Cell generic connection';
        states[Connection.NONE]     = 'No network connection';

        return states[networkState];
    };
    //check if connected & return state (bool)
    var isConnected = function() {
        //TODO test when UNKNOWN
        return (navigator.connection.type != Connection.NONE ? true:false);
    };
    //Callbacks function
    //Online
    var applicationDidEnterOnlineMode = function() {
        console.log('applicationDidEnterOnlineMode');
        if(isConnected()) {
            console.log('connection ok');
            db.updateDB();
        }
        else {
            console.log('no connection');
        }
    };
    //Offline
    var applicationDidEnterOfflineMode = function() {
        console.log('applicationDidEnterOfflineMode');
        if(isConnected())
            console.log('connection ok');
        else
            console.log('no connection');
    };
    //init
    var initState = function() {
        console.log('init state');
        console.log('connection state at init => ' + getConnectionType());
        //add online/offline events listener
        document.addEventListener("online", applicationDidEnterOnlineMode, false);
        document.addEventListener("offline", applicationDidEnterOfflineMode, false);
    };
    return {
        isConnected:isConnected,
        getConnectionType:getConnectionType,
        init: function () {
            //init
            initState();
        }
    };
}();