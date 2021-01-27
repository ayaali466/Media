
function fetch_hospital_data(query= "") //this function will return hospital data if query argument is equal to zero but if it contain some value will return fill data
{
    $.ajax({
        url:"{{route('live_search.action')}}",
        method:"GET",
        data:{query:query}, //will send query variable to server
        dataType:"json",
        success:function(data)
        { //call back function will called when request successfully recive data from server
            $("tbody").html(data.table_data);//table data variable //this code will display hospital data on html table form
            $("#total_records").text(data.total_data); //this will display total number of  records under span id total records on web page
        }
    })
}
$(document).ready(function(){
fetch_hospital_data(); //to call function

$(document).on("keyup","#search",function(){
   var query=$(this).val();
    fetch_hospital_data(query); //this function will filter hospital data according to query variable
});

});

