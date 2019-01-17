@extends('admin.layout.default_layout')
@section('title') {{{ 'Users List' }}} @parent @stop {{-- Content --}}
@section('content')

<!--BEGIN PAGE WRAPPER-->
<section class="vbox">
    @include('admin.layout.menu_header')
    <section>
        <section class="hbox stretch">
            <!-- .aside --> 
            @include('admin.layout.sidebar')
            <!-- /.aside --> 
            <section id="content"> 
                <section class="vbox"> 
                    <!-- Page Heading -->
                    <header class="header bg-white b-b b-light"> 
                        <p><strong>User Profile</strong></p>
                        <ul class="breadcrumb pull-right mr-t-7"> 
                           <li><a href="{{url('admin/user')}}"><i class="fa fa-home"></i> Home</a></li> 
                           <li class="active">User Profile</li>
                        </ul>
                    </header> 
                    <!-- End of Page Heading -->     

                    <section class="scrollable wrapper w-f"> 
                        <div class="main-container">

                                <div class="row">
                                    <div class="panel-body"> 
                                        <div class="form-group"> 
                                            <label><strong>Name</strong></label> <span>{{$userObj->name}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Name of the Avatar</strong></label>  <span>{{$userObj->avatar_name}}</span>
                                        </div>
                                       <div class="form-group"> 
                                            <label><strong>Gender</strong></label>
                                            <span>
                                                @if($userObj->gender == 1) 
                                                    Male
                                               @elseif($userObj->gender == 2)
                                               Female
                                                @else
                                                   
                                                @endif
                                            </span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Country</strong></label>  <span>{{$userObj->country_name}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Mobile Number</strong></label>  <span>{{$userObj->mobile_number}}</span>
                                        </div>
                                         
                                        <div class="form-group"> 
                                            <label><strong>Relationship Status</strong></label>
                                            <span>
                                                <?php 
                                                $statusArray = array('0' => 'None','1' => 'Single','2' => 'In a Relationship','3' => 'Engaged','4' => 'Married','5' => 'In a civil union','6' => 'In a domestic partnership','7' => 'In an open relationship','8' => 'It’s Complicated','9' => 'Seperated','10' => 'Divorced','11' => 'Widowed');
                                                foreach($statusArray as $key=>$value){
                                                    if($key ==$userObj->relationship_status){
                                                        echo $value; 
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Email Id</strong></label>  <span>{{$userObj->email}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>About Me</strong></label>  <span>{{$userObj->user_bio}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Likes</strong></label>  <span>{{$userObj->like}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Dislikes</strong></label>  <span>{{$userObj->dislike}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Date of Birth</strong></label>  <span>{{$userObj->date_of_birth}}</span>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="form-group"> 
                                            <label><strong>Number of Good Answer</strong></label>  <span>---</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Status</strong></label>  
                                            <span>
                                                @if($userObj->status == 1) 
                                                    Pending
                                                @elseif($userObj->status == 2)
                                                    Active
                                                @else
                                                    De-active
                                                @endif
                                            </span>
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="form-group"> 
                                    <div class="custom-file-input">
                                        <a href="{{URL::previous()}}" class="btn btn-s-md green-button">Back</a>
                                       
                                    </div>
                                </div>
                        </div>
                        <div class="mar-b-40"></div>
                    </section>

                </section> 
            </section>
        </section>
    </section>
</section>
<!-- /#page-wrapper -->
<!--END PAGE WRAPPER-->
@section('admin.layout.footer')
<!--<script src="{{URL::asset('admin-panel/assets/js/user-list.js')}}"></script>-->
@stop
@stop
