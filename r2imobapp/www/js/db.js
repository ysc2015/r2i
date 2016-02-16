"use strict";
//DB component
var db = function() {
    //db instance
    var db = null;
    //db name
    var dbName = 'r2istt';
    //create job_orders table
    var createJobOrdersTable = function() {
        console.log('createJobOrdersTable');

        //create job_orders table if not exists
        var sql='';
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS job_orders';
        sql +='(';
        sql +='job_order_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='job_title VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='job_desc VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';
        //table index
        sql +='CREATE INDEX IF NOT EXISTS job_orders_idx ON job_orders (job_order_id);';

        db.executeSql(sql, [], function (res) {
            console.log('createJobOrdersTable success');
            console.log(res);
        }, function(error) {
            console.log('CREATE error: ' + error.message);
        });
    };
    //create job_rooms table
    var createJobRoomsTable = function() {
        console.log('createJobRoomsTable');

        //create job_rooms table if not exists
        var sql='';
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS job_rooms';
        sql +='(';
        sql +='job_room_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='job_order_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='latitude VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='longitude VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';
        //table index
        sql +='CREATE INDEX IF NOT EXISTS job_rooms_idx ON job_rooms (job_room_id);';

        db.executeSql(sql, [], function (res) {
            console.log('createJobRoomsTable success');
            console.log(res);
        }, function(error) {
            console.log('CREATE error: ' + error.message);
        });
    };
    //create muffs table : manchons
    var createMuffsTable = function() {
        console.log('createMuffsTable');

        //create muffs table if not exists
        var sql='';
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS muffs';
        sql +='(';
        sql +='muff_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='muff_info VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';
        //table index
        sql +='CREATE INDEX IF NOT EXISTS muffs_idx ON muffs (muff_id);';

        db.executeSql(sql, [], function (res) {
            console.log('createMuffsTable success');
            console.log(res);
        }, function(error) {
            console.log('CREATE error: ' + error.message);
        });
    };
    //create percussions table
    var createPercussionsTable = function() {
        console.log('createPercussionsTable');

        //create muffs table if not exists
        var sql='';
        //table scheme
        sql +='CREATE TABLE IF NOT EXISTS percussions';
        sql +='(';
        sql +='percussion_id INTEGER ,';//[ NULL | NOT NULL ]
        sql +='percussion_info VARCHAR ,';//[ NULL | NOT NULL ]
        sql +='flag VARCHAR ';//[ NULL | NOT NULL ]
        sql +=');';
        //table index
        sql +='CREATE INDEX IF NOT EXISTS percussions_idx ON percussions (percussion_id);';

        db.executeSql(sql, [], function (res) {
            console.log('createPercussionsTable success');
            console.log(res);
        }, function(error) {
            console.log('CREATE error: ' + error.message);
        });
    };
    //Callbacks functions
    var dbOpenSuccess = function() {
        console.log('dbOpenSuccess');
        createJobOrdersTable();
        createJobRoomsTable();
        createMuffsTable();
        createPercussionsTable();
    };
    var dbOpenError = function() {
        console.log('dbOpenError');
    };
    var initDB = function() {
        console.log('init DB');
        //create database if not exists
        db = window.sqlitePlugin.openDatabase({name: dbName, location: 1}, dbOpenSuccess, dbOpenError);
    };
    return {
        init: function () {
            //run initApp function
            initDB();
        }
    };
}();