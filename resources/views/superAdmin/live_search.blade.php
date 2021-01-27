@extends('superAdmin.layouts.master')
@section('title', 'Delete Partner')
@section('css')
<link rel="stylesheet" href="{{ url('/css/request_loading.css') }}">
@endsection
@section('js')
<script >
$(document).ajaxSend(function() {
    // Show loading when request sended
    $("#loading_untill_request_done").fadeIn(300);　
});

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

             // Remove Loading when repone come
             setTimeout(function() {
                  $("#loading_untill_request_done").fadeOut(300);
              }, 0);
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


</script>
@endsection
@section('content')

        <!-- Loading Untill Request Done -->
        <div id="loading_untill_request_done">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <!-- End Loading Untill Request Done -->

@if(session("success"))
       <div class=" alert alert-info text-center">
       {{session("success")}}
       </div>
      @endif
<div class="row mt-5">
        <h3 class="text-center h1 mt-5 col-12">All Parteners</h3>
        <div class="col-md-6 col-lg-4 col-sm-8 mx-auto mt-3">
            
              <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-user"></i> </span>
                 </div>

     <input type="text" name="search" id="search"  class="form-control" placeholder="Name Or Email"    />
      </div>


          </div>
      </div>

<div class="table-responsive">
  <h3 align="center">Total Results <span id="total_records"></span></h3>  <!-- under span tag here will display all filtered data-->
 
  @if(session("status"))
       <div class=" alert alert-info text-center">
       {{session("status")}}
       </div>
      @endif
      <div class="container">
        <table  class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">email</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

  <tbody>

  </tbody>

  </table>
</div>
@endsection


