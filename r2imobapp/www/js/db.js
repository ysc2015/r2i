"use strict";
//DB component
var db = function() {
    //test function
    var testFromDb = function() {
        console.log('testFromDb');
    };
    //used for test drop
    var drop = true;
    //db instance
    var db = null;
    //db name
    var dbName = 'r2istt';
    //events variables
    var jobOrdersTableCreatedDeferred;
    var jobRoomsTableCreatedaDeferred;
    var muffsTableCreatedaDeferred;
    var percussionsTableCreatedaDeferred;
    //create job_orders table
    var createJobOrdersTable = function() {
        console.log('createJobOrdersTable');

        //create job_orders table if not exists
        var sql='';
        sql +=(drop?'DROP TABLE job_orders;':'');
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS job_orders';
        sql +='(';
        sql +='job_order_id INTEGER PRIMARY KEY AUTOINCREMENT ,';//[ NULL | NOT NULL ]
        sql +='srv_job_order_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='job_title VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='job_desc VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';
        //table index
        sql +='CREATE INDEX IF NOT EXISTS job_orders_idx ON job_orders (srv_job_order_id);';

        db.executeSql(sql, [], function (res) {
            console.log('createJobOrdersTable success');
            console.log(res);
            jobOrdersTableCreatedDeferred.resolve();
            selectJobOrders();
        }, function(error) {
            console.log('CREATE error: ' + error.message);
        });
    };
    //create job_rooms table
    var createJobRoomsTable = function() {
        console.log('createJobRoomsTable');

        //create job_rooms table if not exists
        var sql='';
        sql +=(drop?'DROP TABLE job_rooms;':'');
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS job_rooms';
        sql +='(';
        sql +='job_room_id INTEGER PRIMARY KEY AUTOINCREMENT ,';//[ NULL | NOT NULL ]
        sql +='srv_job_room_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='job_order_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='latitude VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='longitude VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';
        //table index
        sql +='CREATE INDEX IF NOT EXISTS job_rooms_idx ON job_rooms (srv_job_room_id);';

        db.executeSql(sql, [], function (res) {
            console.log('createJobRoomsTable success');
            console.log(res);
            jobRoomsTableCreatedaDeferred.resolve();
            selectJobRooms();
        }, function(error) {
            console.log('CREATE error: ' + error.message);
        });
    };
    //create muffs table : manchons
    var createMuffsTable = function() {
        console.log('createMuffsTable');

        //create muffs table if not exists
        var sql='';
        sql +=(drop?'DROP TABLE muffs;':'');
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS muffs';
        sql +='(';
        sql +='muff_id INTEGER PRIMARY KEY AUTOINCREMENT,';//[ NULL | NOT NULL ]
        sql +='srv_muff_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='muff_info VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';
        //table index
        sql +='CREATE INDEX IF NOT EXISTS muffs_idx ON muffs (srv_muff_id);';

        db.executeSql(sql, [], function (res) {
            console.log('createMuffsTable success');
            console.log(res);
            muffsTableCreatedaDeferred.resolve();
            selectMuffs();
        }, function(error) {
            console.log('CREATE error: ' + error.message);
        });
    };
    //create percussions table
    var createPercussionsTable = function() {
        console.log('createPercussionsTable');

        //create muffs table if not exists
        var sql='';
        sql +=(drop?'DROP TABLE percussions;':'');
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS percussions';
        sql +='(';
        sql +='percussion_id INTEGER PRIMARY KEY AUTOINCREMENT,';//[ NULL | NOT NULL ]
        sql +='srv_percussion_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='percussion_info VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';
        //table index
        //TODO make sql statments apart
        sql +='CREATE INDEX IF NOT EXISTS percussions_idx ON percussions (srv_percussion_id);';

        db.executeSql(sql, [], function (res) {
            console.log('createPercussionsTable success');
            console.log(res);
            percussionsTableCreatedaDeferred.resolve();
            //insertSamplesDataForPercussion();
        }, function(error) {
            console.log('CREATE error: ' + error.message);
        });
    };
    //CRUD function
    //select job_orders
    var selectJobOrders = function() {
        console.log('selectJobOrders');
        db.executeSql("SELECT * FROM job_orders", [], function (res) {
            console.log('selectJobOrders res =>');
            console.log(res);
        }, function(error) {
            console.log('SELECT error: ' + error.message);
        });
    };
    //select job_rooms
    var selectJobRooms = function() {
        console.log('selectJobRooms');
        db.executeSql("SELECT * FROM job_rooms", [], function (res) {
            console.log('selectJobRooms res =>');
            console.log(res);
        }, function(error) {
            console.log('SELECT error: ' + error.message);
        });
    };
    //select muffs
    var selectMuffs = function() {
        console.log('selectMuffs');
        db.executeSql("SELECT * FROM muffs", [], function (res) {
            console.log('selectMuffs res =>');
            console.log(res);
        }, function(error) {
            console.log('SELECT error: ' + error.message);
        });
    };
    //insert samples data for percussion
    //TODO delete this
    var insertSamplesDataForPercussion = function() {
        console.log('insertSamplesDataForPercussion');
        db.executeSql("INSERT INTO percussions (srv_percussion_id, percussion_info, flag) VALUES (?,?,?)", [1,'infos1','update'], function (res) {
            console.log('insertSamplesDataForPercussion success');
            selectPercussions();
        }, function(error) {
            console.log('INSERT error: ' + error.message);
        });
    };
    //select percussions
    var selectPercussions = function() {
        console.log('selectPercussions');
        db.executeSql("SELECT * FROM percussions", [], function (res) {
            console.log('selectPercussions res =>');
            console.log(res);
        }, function(error) {
            console.log('SELECT error: ' + error.message);
        });
    };
    //update DB
    var updateDB = function() {
        console.log('updateDB');
    };
    //Callbacks functions
    //database open success
    var dbOpenSuccess = function() {
        console.log('dbOpenSuccess');
        jobOrdersTableCreatedDeferred = $.Deferred();
        jobRoomsTableCreatedaDeferred = $.Deferred();
        muffsTableCreatedaDeferred = $.Deferred();
        percussionsTableCreatedaDeferred = $.Deferred();
        createJobOrdersTable();
        createJobRoomsTable();
        createMuffsTable();
        createPercussionsTable();
        //When db finish all init process
        $.when(jobOrdersTableCreatedDeferred, jobRoomsTableCreatedaDeferred, muffsTableCreatedaDeferred, percussionsTableCreatedaDeferred)
            .then(databaseDidFinishInitializing);
    };
    //database open error
    var dbOpenError = function() {
        console.log('dbOpenError');
    };
    //database finish initializing
    var databaseDidFinishInitializing = function() {
        console.log('databaseDidFinishInitializing');
        if(state.isConnected()) {
            updateDB();
        }
    };
    var initDB = function() {
        console.log('init DB');
        //create database if not exists
        db = window.sqlitePlugin.openDatabase({name: dbName, location: 1}, dbOpenSuccess, dbOpenError);
    };
    return {
        testFromDb:testFromDb,
        updateDB:updateDB,
        init: function () {
            //init DB
            initDB();
        }
    };
}();