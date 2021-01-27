@extends('orgAdmin.layouts.o_app')
@section('title','  Edit Doctor')
@section('styles')
<link rel="stylesheet" href="{{ url('/orgAdmin/css/edit_delete_doctor.css') }}">
<link rel="stylesheet" href="{{ url('/css/dataTables.min.css') }}">
@endsection

@section('content')


        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @if(session()->has('status'))
          <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
        @endif
      <!-- page-content" -->
      <div class="container-fluid">
        <!-- page-content" -->

        <!-- Delete Partener Form -->
        <div class="row">
          <h3 class="text-center h1 col-12">Edit Doctor</h3>
        </div>

        <!-- End Delete Partener Form -->
        <!-- All Parteners -->
        <div class="container my-5">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Department</th>
                    <th>Fees</th>
                    <th>Edit</th>
                    <th>Edit logo</th>
                </tr>
            </thead>
            <tbody>
                  @foreach($doctors as $doctor)
                    <tr>
                      <td>{{ $doctor -> id }}</td>
                      <td>{{ $doctor -> name }}</td>
                      <td>{{ $doctor -> title }}</td>
                      <td>{{ $doctor -> depName }}</td>
                      <td>{{ $doctor -> fees }}</td>
                      <td class="text-center">
                        <a href="{{route('showeditDoctor',['id' => $doctor -> id ])}}"><i class="fas fa-edit" style="font-size: 35px"></i></a>
                      </td>
                      <td class="text-center">
                        <a href="{{route('showeditDoctorLogoImage',['id' => $doctor -> id ])}}"><i class="fas fa-image" style="font-size: 35px"></i></a>
                      </td>
                    </tr>
                  @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Department</th>
                    <th>Fees</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
          </table>

        </div>
      </div>
      <!-- End page-content -->
      <!-- ------------------------------------- -->
  @endsection

  @section('scripts')
  <script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('js/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    $(document).ready(function() {
    $('#example').DataTable();
});
  </script>
  @endsection
