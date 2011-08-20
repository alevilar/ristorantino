
var Risto = {
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
