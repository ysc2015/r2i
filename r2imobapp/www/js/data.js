"use strict";
//Data component
var data = function() {
    //used for test drop
    var drop = true;
    //db instance
    var db = null;
    //db name
    var dbName = 'r2istt';
    //events variables
    var roomsListTableCreatedDeferred;
    var roomPicsTableCreatedaDeferred;
    //update DB
    var updateDB = function() {
        console.log('updateDB');
    };
    var checkUpdate = function() {
        console.log('checkUpdate');
        $.ajax({
            url: 'http://sd-83414.dedibox.fr/r2i/api/mobileApi.php',
            type: 'POST',
            data: {method : 'check_update'},
            success: function(response){
                console.log('check_update:success');
                console.log(response);
            },
            error: function (xhr, ajaxOptions, thrownError){
                //alert('Error !!'++ xhr.statusText);

                //alert(thrownError);
                $('#output_test').html('<h2>Error !!!!: ' + xhr.statusText +'</h2>'+thrownError );
            }
        });
    };
    //crud functions
    //create rooms_list table
    var createRoomsListTable = function() {
        console.log('createRoomsListTable');

        //create rooms_list table if not exists
        var sql='';
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS rooms_list';
        sql +='(';
        sql +='room_id INTEGER PRIMARY KEY ,';//[ NULL | NOT NULL ]
        sql +='REF_CHAMBR VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='VILLET VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='SOUS_PROJET VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='REF_NOTE VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='CODE_CH1 VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='CODE_CH2 VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='GPS VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';

        db.transaction(function(tx) {
            //drop if needed
            if(drop) db.executeSql("DROP TABLE IF EXISTS rooms_list");
            //create table structure
            db.executeSql(sql);
        }, function(e) {
            console.log('Transaction creation rooms_list error: ' + e.message);
        }, function() {
            console.log('Transaction creation rooms_list finished !');
            roomsListTableCreatedDeferred.resolve();
        });
    };
    //create room_pics table
    var createRoomPicsTable = function() {
        console.log('createRoomPicsTable');

        //create rooms_list table if not exists
        var sql='';
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS room_pics';
        sql +='(';
        sql +='room_pic_id INTEGER PRIMARY KEY AUTOINCREMENT ,';//[ NULL | NOT NULL ]
        sql +='room_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='latitude VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='longitude VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='altitude VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='accuracy VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='altitudeAccuracy VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='heading VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='speed VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='timestamp VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='imageTabURI VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='imageSrvURL VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';

        db.transaction(function(tx) {
            //drop if needed
            if(drop) db.executeSql("DROP TABLE IF EXISTS room_pics");
            //create table structure
            db.executeSql(sql);
        }, function(e) {
            console.log('Transaction creation room_pics error: ' + e.message);
        }, function() {
            console.log('Transaction creation room_pics finished !');
            roomPicsTableCreatedaDeferred.resolve();
        });
    };
    //CRUD function
    //select rooms_list
    var selectRoomsList = function() {
        console.log('selectRoomsList');
        db.executeSql("SELECT * FROM rooms_list", [], function (res) {
            console.log('selectRoomsList res =>');
            console.log(res);
        }, function(error) {
            console.log('SELECT rooms_list error: ' + error.message);
        });
    };
    //select room_pics
    var selectRoomPics = function() {
        console.log('selectRoomPics');
        db.executeSql("SELECT * FROM room_pics", [], function (res) {
            console.log('selectRoomPics res =>');
            console.log(res);
        }, function(error) {
            console.log('SELECT room_pics error: ' + error.message);
        });
    };
    //Callbacks functions
    //database open success
    var dbOpenSuccess = function() {
        console.log('dbOpenSuccess');
        roomsListTableCreatedDeferred = $.Deferred();
        roomPicsTableCreatedaDeferred = $.Deferred();
        createRoomsListTable();
        createRoomPicsTable();
        //When db finish all init process
        $.when(roomsListTableCreatedDeferred, roomPicsTableCreatedaDeferred)
            .then(databaseDidFinishInitializing);
    };
    //database open error
    var dbOpenError = function() {
        console.log('dbOpenError');
    };
    //database finish initializing
    var databaseDidFinishInitializing = function() {
        console.log('databaseDidFinishInitializing');
        selectRoomsList();
        selectRoomPics();

        checkUpdate();
    };
    var initDB = function() {
        console.log('init Data');
        //create database if not exists else open it
        db = window.sqlitePlugin.openDatabase({name: dbName, location: 1}, dbOpenSuccess, dbOpenError);
    };
    return {
        checkUpdate:checkUpdate,
        init: function () {
            //init DB
            initDB();
        }
    };
}();