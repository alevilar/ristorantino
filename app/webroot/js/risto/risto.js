
var Risto = {
    modelizar: function(obToModelizar){
        
        obToModelizar.timeCreated = function(){
            var d;
            
            var created;
            if (typeof this.created == 'function'){
                created = this.created();
            } else {
                created = this.created;
            }
            if (!created) {
                d = new Date();
            } else {
                d = new Date( mysqlTimeStampToDate(this.created()) );       
            }

            var min =  (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
            return d.getHours()+":"+min;
        }
    }
}




function mysqlTimeStampToDate(timestamp) {
    if (timestamp) {
        //function parses mysql datetime string and returns javascript Date object
        //input has to be in this format: 2007-06-05 15:26:02
        var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
        var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
        return new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
    } else {
        return new Date();
    }
        
}

/**
 * I make a mysql date timestamp
 * @deprecated - Datepicker used instead
 * @param {Object} dateobj - a date
 */
function jsToMySqlTimestamp( dateobj )
{
    var date;
    if ( dateobj ) {
         date = new Date( dateobj );
    } else {
        date = new Date(  );
    }
    
    var yyyy = date.getFullYear();
    var mm = date.getMonth() + 1;
    var dd = date.getDate();
    var hh = date.getHours();
    var min = date.getMinutes();
    var ss = date.getSeconds();
 
	var mysqlDateTime = yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + min + ':' + ss;
 
    return mysqlDateTime;
}