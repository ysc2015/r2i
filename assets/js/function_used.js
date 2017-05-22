/**
 * Created by fadil on 16/05/17.
 */
var weekday = new Array(7);
weekday[0] =  "sunday";
weekday[1] = "monday";
weekday[2] = "tuesday";
weekday[3] = "wednesday";
weekday[4] = "thursday";
weekday[5] = "friday";
weekday[6] = "saturday";


Date.prototype.addDays = function(days) {
    var z = 0;
    var n = '';
    var date_to_return = new Date() ;
    var dat = new Date(this.valueOf());
    for(var j=1; j <= days; j++ ){
        dat.setDate(dat.getDate() + days);
        n = weekday[dat.getDay()];
        if(n == "saturday" || n == "sunday") {
            z++;
        }
    }
    var daystoadd = days + z;
    date_to_return = new Date(this.valueOf());
    date_to_return.setDate(date_to_return.getDate() + daystoadd);
    var jour = (date_to_return.getDate() < 10) ? "0"+date_to_return.getDate() : date_to_return.getDate();
    var mois = ((date_to_return.getMonth() + 1) < 10) ? "0"+(date_to_return.getMonth() + 1) : (date_to_return.getMonth() + 1);
    return date_to_return.getFullYear()+"-"+mois+"-"+jour;
}