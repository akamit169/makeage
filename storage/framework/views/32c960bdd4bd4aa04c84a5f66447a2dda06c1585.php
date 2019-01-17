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
                        <p><strong>Report Details</strong></p>
                        <ul class="breadcrumb pull-right mr-t-7"> 
                           <li><a href="<?php echo e(url('admin/user')); ?>"><i class="fa fa-home"></i> Home</a></li> 
                           <li class="active">Report Details</li>
                        </ul>
                    </header> 
                    <!-- End of Page Heading -->     

                    <section class="scrollable wrapper w-f"> 
                        <div class="main-container">

                                <div class="row">
                                    <div class="panel-body"> 
                                        <div class="form-group"> 
                                            <label><strong>Reported by</strong></label> <span><?php echo e($userObj->name); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Avatar Name</strong></label> <span><?php echo e($userObj->avatar_name); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Reported For</strong></label> <span><?php echo e($userObj->reported_for); ?></span>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group"> 
                                            <label><strong>Reported Content</strong></label>  <span><?php echo e($userObj->report_content); ?></span>
                                        </div>
                                        <div class="form-group"> 
                                            <label><strong>Status</strong></label>  
                                            <span>
                                                <?php if($userObj->reported_user_status == 1): ?> 
                                                    Pending
                                                <?php elseif($userObj->reported_user_status == 2): ?>
                                                    Active
                                                <?php else: ?>
                                                    De-active
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        
                                        <div class="form-group"> 
                                            <label><strong>Action</strong></label> 
                                              <?php if($userObj->reported_user_status == 3): ?> 
                                                  User Already de-active
                                                <?php else: ?>
                                                   <span><a href="<?php echo e(url('admin/user/delete-reported-user/'.$userObj->reported_user_id)); ?>">Delete User</a></span>
                                                <?php endif; ?>
                                            
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