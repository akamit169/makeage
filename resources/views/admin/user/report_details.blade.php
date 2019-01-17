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
                        <p><strong>Report Details</strong></p>
                        <ul class="breadcrumb pull-right mr-t-7"> 
                           <li><a href="{{url('admin/user')}}"><i class="fa fa-home"></i> Home</a></li> 
                           <li class="active">Report Details</li>
                        </ul>
                    </header> 
                    <!-- End of Page Heading -->     

                    <section class="scrollable wrapper w-f"> 
                        <div class="main-container">

                                <div class="row">
                                    <div class="panel-body"> 
                                        <div class="form-group"> 
                                            <label><strong>Reported by</strong></label> <span>{{$userObj->name}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Avatar Name</strong></label> <span>{{$userObj->avatar_name}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Reported For</strong></label> <span>{{$userObj->reported_for}}</span>
                                        </div>
                                        
                                        <div class="form-group"> 
                                            <label><strong>Reported Content</strong></label>  <span>{{$userObj->report_content}}</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Status</strong></label>  
                                            <span>
                                                @if($userObj->reported_user_status == 1) 
                                                    Pending
                                                @elseif($userObj->reported_user_status == 2)
                                                    Active
                                                @else
                                                    De-active
                                                @endif
                                            </span>
                                        </div>
                                        
                                        <div class="form-group"> 
                                            <label><strong>Action</strong></label> 
                                              @if($userObj->reported_user_status == 3) 
                                                  User Already de-active
                                                @else
                                                   <span><a href="{{ url('admin/user/delete-reported-user/'.$userObj->reported_user_id)}}">Delete User</a></span>
                                                @endif
                                            
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
