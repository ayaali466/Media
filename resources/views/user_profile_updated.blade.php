@extends('layouts.app')
@section('title','Hospital')
@section('styles')
<link rel="stylesheet" href="{{ url('/user/css/user_profile_updated.css') }}">
<link rel="stylesheet" href="{{ url('/css/logo_image_edit.css') }}">
<style>

</style>
@endsection

@section('content')

        @if($errors->any())
        <div class="alert alert-danger mb-0">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
    <!-- ------------------ Start Content ------------------- -->
    <div class="grid">
        <div class="row m-0">
            <div class="col-md-3 col-sm-12 pl-1">
                <!-- category -->
                <nav class="profile_sidebar pt-3">

                    <div class="profile_sidebar_head text-center">
                        @php
                            $logo = auth()->user()->photo;
                            if(isset($logo))
                                $path =  auth()->user()->photo;
                            else
                                $path = "photo1.png";
                        @endphp
                        <img src='{{ url("/user/img/$path") }}' alt="Profile Photo" class="image-cover2 mr-2">
                        <h3>{{ auth()->user()->name }}</h3>
                    </div>

                    <ul class="profile_sidebar_ul">
                        <li class="profile_sidebar_li showed" id="li_general_info">
                            <a href="javascript:" class="profile_sidebar_ul_li_a">
                                <i class="fas fa-info-circle"></i>General Information</a>
                        </li>

                        <li class="profile_sidebar_li" id="li_medical_info">
                            <a href="javascript:" class="profile_sidebar_ul_li_a">
                                <i class="fas fa-comment-medical"></i>Medical Information</a>
                        </li>

                        <li class="profile_sidebar_li" id="li_edit_profile_logo">
                            <a href="javascript:" class="profile_sidebar_ul_li_a">
                            <i class="fas fa-image"></i>Edit Photo</a>
                        </li>
                        <li class="profile_sidebar_li" id="li_edit_profile">
                            <a href="javascript:" class="profile_sidebar_ul_li_a">
                                <i class="fas fa-edit"></i>Edit Profile</a>
                        </li>
                        <li class="profile_sidebar_li" id="li_delete_profile">
                            <a href="javascript:" class="profile_sidebar_ul_li_a">
                                <i class="fas fa-edit"></i>Delete Profile</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-9 col-sm-12 my-5 pr-0" id="general_info">
                <table class="table table-striped ">    
                    <tbody>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">National ID</th>
                            <td>{{ auth()->user()->national_id }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Gender</th>
                            @php
                                $gender =  auth()->user()->gender;
                            @endphp
                            <td><?= ($gender)? 'Male':'Female' ?></td>
                        </tr>
                            <th scope="row">Address</th>
                            <td>{{ auth()->user()->address }}</td>
                        </tr>
                            <th scope="row">Phone</th>
                            <td>{{ auth()->user()->mobile_number }}</td>
                        </tr>
                            <th scope="row">Emengency Phone</th>
                            <td>{{ auth()->user()->emenrgency_number }}</td>
                        </tr>
                            <th scope="row">DaTe Of Birth</th>
                            <td>{{ auth()->user()->birth_date }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <!-- <img src="pp.jpg" alt=""> -->
            </div>
            <!-- Test -->
            <div class="col-md-9 col-sm-12 my-5 pr-0" id="medical_info">
                <table class="table table-striped">    
                    <tbody class="">
                        <tr>
                            <th scope="row">Blood Type</th>
                            <td>{{ $Blood_type_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Treatments</th>
                            <td>
                                <ul class="list-unstyled h4">
                                    @foreach($treatments as $one)
                                        <li>{{ $one->name }}
                                        <a href="{{ route('userProfile.delete_treatment', $one->id) }}">
                                        
                                        <i class="fas fa-trash-alt  text-danger" style="font-size: 20px;"></i>
                                        </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Diseases</th>
                            <td>
                                <ul class="list-unstyled h4">
                                    @foreach($diseases as $one)
                                        <li>{{ $one->name }}
                                        <a href="{{ route('userProfile.delete_disease', $one->id) }}">
                                        <i class="fas fa-trash-alt  text-danger" style="font-size: 20px;"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Medical Reports</th>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach($reports as $one)
                                        <li>
                                            <a href='{{ url("/user/files/$one->report_file") }}'>{{ $one->report_name }}</a>
                                            <a href="{{ route('userProfile.delete_report', $one->id) }}">
                                                <i class="fas fa-times ml-2"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <!-- Add Disease -->
                <form method="POST" action="{{route('userProfile.add_disease')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row justify-content-center mx-0">
                        <div class="col-md-8 offset-md-0 col-sm-8 offset-sm-2"><!-- -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-bomb"></i> </span>
                                </div>
                                <input name="disease" class="name form-control" placeholder="Disease Name" type="text">
                            </div>
                        </div>

                        <div class="form-group col-md-4  col-sm-12"><!--  -->
                            <button type="submit" name="submit" class="btn btn-signInUp btn-block">Add</button>
                        </div>
                    <!-- form-group// -->
                    </div>

                </form>
                <!-- Add Treatment -->
                <form method="POST" action="{{route('userProfile.add_treatment')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row justify-content-center mx-0">
                        <div class="col-md-8 offset-md-0 col-sm-8 offset-sm-2"><!-- -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-pills"></i> </span>
                                </div>
                                <input name="treatment" class="name form-control" placeholder="Treatment Name" type="text">
                            </div>
                        </div>

                        <div class="form-group col-md-4  col-sm-12"><!--  -->
                            <button type="submit" name="submit" class="btn btn-signInUp btn-block">Add</button>
                        </div>
                        <!-- form-group// -->
                    </div>

                </form>

                
                <form method="POST" action="{{route('userProfile.add_report')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row justify-content-center mx-0">
                        <div class="col-md-4 offset-md-0 col-sm-8 offset-sm-2"><!-- -->
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-file"></i> </span>
                                </div>
                                <input name="report_name" class="name form-control" placeholder="Report Name" type="text">
                            </div>
                        </div>

                        <div class=" col-md-4 offset-md-0 col-sm-8 offset-sm-2">
                            <div class="custom-file mb-3">
                            <input type="file" class="imageprofile custom-file-input" id="laboratory_profileImage" name="report">
                            <label class="custom-file-label" for="laboratory_profileImage">* Medical Report</label>
                            </div>
                        </div>

                        <div class="col-md-4 offset-md-0 col-sm-8 offset-sm-2"><!--  -->
                            <button type="submit" name="submit" class="btn btn-signInUp btn-block">Upload</button>
                        </div>
                            <!-- form-group// -->
                    </div>

                </form>

                
            </div>

            <div class="col-md-9 col-sm-12 pr-0" id="edit_profile_logo">
                <div class="container">
                    <!------------------------------- Edit Profile Photo ------------------------------->

                    <!------------------------------- Start Of Form ------------------------------->
                    <form method="POST" action="{{route('userProfile.update_user_photo')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row justify-content-center mx-0 mb-5">
                        
                        <!------------------------------- Logo Image ------------------------------->
                        <div class="Image_edit col-12">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input name="photo" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                    <!-- That Contain Edit Icon usgin after-->
                                </div>
                                <div class="avatar-preview">
                                    @php
                                    $logo = auth()->user()->photo;
                                    if(isset($logo))
                                        $path = "user/img/$logo";
                                    else
                                        $path = "img/photo1.png";
                                    @endphp
                                    <div id="imagePreview" style = <?= "\"background-image: url("?> {{ url("$path") }}<?=");\""?>>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!------------------------------- Submit Button ------------------------------->
                        <div class="form-group col-4">
                            <!-- offset-3 col-6 -->
                            <!-- disabled -->
                            <button type="submit" name="submit" class="btn btn-signInUp btn-block">Edit</button>
                        </div> <!-- form-group// -->
                        </div>

                    </form>

                    <!------------------------------- End Of Form ------------------------------->
                </div>
                    <!-- <img src="pp.jpg" alt=""> -->
            </div>

            <div class="col-md-9 col-sm-12 pr-0 my-5 " id="edit_profile">
                <form  action="{{route('userProfile.edit_profile')}}" 
                        method="POST" class="ValidationForm" enctype="multipart/form-data">
                        @csrf 
                    <div class="row mt-5 mx-0">
                        <!------------------------------- User Name ------------------------------->
                        <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-user"></i> </span>
                                </div>

                                <input name="name" class="username form-control" placeholder="patient name" type="text" 
                                value="{{ auth()->user()->name }}">

                            </div> <!-- form-group Name -->
                            <div class="alert alert-danger custom-alert d-none">
                                Error Message
                            </div>
                        </div>

                        <!------------------------------- Email ------------------------------->
                        <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-envelope"></i> </span>
                                </div>
                                <input name="email" class="email form-control" placeholder="Email" type="email" 
                                value="{{ auth()->user()->email }}">
                            </div> <!-- form-group Name -->
                            <div class="alert alert-danger custom-alert d-none">
                                Error Message
                            </div>
                        </div>
                        <!------------------------------- User Birth date ------------------------------->
                        <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-calendar-alt"></i> </span>
                                </div>
                                <input name="BD" class="username form-control" placeholder="Birth Date" type="date" 
                                value="{{ auth()->user()->birth_date }}">
                            </div> <!-- form-group Name -->
                            <div class="alert alert-danger custom-alert d-none">
                                Error Message
                            </div>
                        </div>
                        
                        <!------------------------------- Blood type ------------------------------->
                        <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-tint"></i> </span>
                                </div>
                                <select class="custom-select selected-governorate" name="blood_type_id">
                                    <option value="0" disabled selected>Choose Blood Type</option>
                                    @foreach($All_bloods as $one)
                                    @if(auth()->user()->blood_type_id == $one->id)
                                    <option value="{{$one->id}}" selected>{{$one->blood_type}}</option>
                                    @else
                                    <option value="{{$one->id}}">{{$one->blood_type}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="alert alert-danger custom-alert d-none">
                                You Must choose value, if there no updates choose Zero.
                            </div>
                        </div>
                        <!------------------------------- Phone Number ------------------------------->
                        <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-phone"></i> </span>
                                </div>
                                <input name="phone" class="email form-control" placeholder="Phone Number" type="number" 
                                value="{{ auth()->user()->mobile_number }}">
                            </div> <!-- form-group Name -->
                            <div class="alert alert-danger custom-alert d-none">
                                Error Message
                            </div>
                        </div>
                        <!-------------------------------emergency phone number ------------------------------->
                        <div class=" col-md-6 offset-md-0 col-sm-8 offset-sm-2">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-phone"></i> </span>
                                </div>
                                <input name="Ephone" class="email form-control" placeholder="Emergency Phone Number" type="number" 
                                value="{{ auth()->user()->emenrgency_number }}">
                            </div> <!-- form-group Name -->
                            <div class="alert alert-danger custom-alert d-none">
                                Error Message
                            </div>
                        </div>
                        <!-------------------------------address ------------------------------->
                        <div class=" col-md-6 offset-md-3 col-sm-8 offset-sm-2">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 2.5rem;"> <i class="fa fa-envelope"></i> </span>
                                </div>
                                <input name="address" class="email form-control" placeholder="address" type="text"
                                value="{{ auth()->user()->address }}">
                            </div> <!-- form-group Name -->
                            <div class="alert alert-danger custom-alert d-none">
                                Error Message
                            </div>
                        </div>
                        <!------------------------------- Submit Button ------------------------------->
                        <div class="form-group offset-md-4 col-md-4">
                            <button type="submit" name="submit" class="btn btn-signInUp btn-block">edit</button>
                        </div> <!-- form-group// -->

                    </div>
                </form>
            </div>

            <div class="col-md-9 col-sm-12 pr-0 my-5 mt-5 pt-5 " id="delete_profile" style="display:none;">
                <div class="container">
                    <!------------------------------- Edit Profile Photo ------------------------------->

                    <!------------------------------- Start Of Form ------------------------------->
                    <form method="POST" action="{{route('userProfile.delete_profile')}}" class="ValidationForm" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row justify-content-center mx-0">
                            <div class="col-md-12 offset-md-0 col-sm-8 offset-sm-2">
                        
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 2.5rem;"> <i class="fas fa-bomb text-danger"></i> </span>
                                    </div>
                                    <lable class="name form-control text-info" > Are you Sure you want to Permanently delete your Account</lable>
                                </div>
                            </div>

                        <!------------------------------- Submit Button ------------------------------->

                            <div class="form-group col-md-4  col-sm-12"><!--  -->
                                <button type="submit" name="submit" class="btn btn-danger btn-block">Yes</button>
                            </div>
                    <!-- form-group// -->
                        </div>
                    </form>
                    <!------------------------------- End Of Form ------------------------------->
                </div>
            </div>


        </div>
    </div>
    @endsection
    <!-- ------------------ End Content ------------------- -->

    
@section('scrollingIcon')
  <li><a class="scroll-to-top" scroll-to-top-time="2000"><i class="fa fa-arrow-circle-up"></i></a></li>
@endsection
@section('scripts')
<script src="{{ url('/user/js/user_profile_updated.js') }}"></script>
<script src="{{ url('/js/logo_image_edit.js') }}"></script>
@endsection