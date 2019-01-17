<?php $__env->startSection('title'); ?> <?php echo e('Users List'); ?> @parent  <?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>

<!--BEGIN PAGE WRAPPER-->
<section class="vbox">
    <?php echo $__env->make('admin.layout.menu_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section>
        <section class="hbox stretch">
            <!-- .aside --> 
            <?php echo $__env->make('admin.layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- /.aside --> 
            <section id="content"> 
                <section class="vbox"> 
                    <!-- Page Heading -->
                    <header class="header bg-white b-b b-light"> 
                        <p><strong>User Profile</strong></p>
                        <ul class="breadcrumb pull-right mr-t-7"> 
                           <li><a href="<?php echo e(url('admin/user')); ?>"><i class="fa fa-home"></i> Home</a></li> 
                           <li class="active">User Profile</li>
                        </ul>
                    </header> 
                    <!-- End of Page Heading -->     

                    <section class="scrollable wrapper w-f"> 
                        <div class="main-container">

                                <div class="row">
                                    <div class="panel-body"> 
                                        <div class="form-group"> 
                                            <label><strong>Name</strong></label> <span><?php echo e($userObj->name); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Name of the Avatar</strong></label>  <span><?php echo e($userObj->avatar_name); ?></span>
                                        </div>
                                       <div class="form-group"> 
                                            <label><strong>Gender</strong></label>
                                            <span>
                                                <?php if($userObj->gender == 1): ?> 
                                                    Male
                                               <?php elseif($userObj->gender == 2): ?>
                                               Female
                                                <?php else: ?>
                                                   
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Country</strong></label>  <span><?php echo e($userObj->country_name); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Mobile Number</strong></label>  <span><?php echo e($userObj->mobile_number); ?></span>
                                        </div>
                                         
                                        <div class="form-group"> 
                                            <label><strong>Relationship Status</strong></label>
                                            <span>
                                                <?php 
                                                $statusArray = array('1' => 'Single','2' => 'Married','3' => 'Engaged');
                                                foreach($statusArray as $key=>$value){
                                                    if($key ==$userObj->relationship_status){
                                                        echo $value; 
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Email Id</strong></label>  <span><?php echo e($userObj->email); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>About Me</strong></label>  <span><?php echo e($userObj->user_bio); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Likes</strong></label>  <span><?php echo e($userObj->like); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Dislikes</strong></label>  <span><?php echo e($userObj->dislike); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Date of Birth</strong></label>  <span><?php echo e($userObj->date_of_birth); ?></span>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="form-group"> 
                                            <label><strong>Number of Good Answer</strong></label>  <span>---</span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Status</strong></label>  
                                            <span>
                                                <?php if($userObj->status == 1): ?> 
                                                    Pending
                                                <?php elseif($userObj->status == 2): ?>
                                                    Active
                                                <?php else: ?>
                                                    De-active
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="form-group"> 
                                    <div class="custom-file-input">
                                        <a href="<?php echo e(URL::previous()); ?>" class="btn btn-s-md green-button">Back</a>
                                       
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
<?php $__env->startSection('admin.layout.footer'); ?>
<!--<script src="<?php echo e(URL::asset('admin-panel/assets/js/user-list.js')); ?>"></script>-->
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>