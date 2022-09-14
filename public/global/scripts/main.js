 
    
function formatterNumber(input){
    input = input.toString(); 
    return input.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
    
function getWeekOfMonth(yearSelected, monthSelected){ 
    var arrWeek = [];
    var week = 0;
    var friday = moment()
        .startOf("month")
        .year(yearSelected)
        .month(monthSelected)
        .day("Friday"); 
    if (friday.date() > 7) friday.add(7,'d');
    var month = friday.month();
    while(month === friday.month()){
        week++;
        arrWeek.push("Week "+week+" ("+friday.date().toString()+" "+monthSelected +")"); 
        friday.add(7,'d');
    }
    return arrWeek; 
}

 