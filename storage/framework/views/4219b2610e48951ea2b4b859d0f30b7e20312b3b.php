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
                        <p><strong>Change Password</strong></p>
                        <ul class="breadcrumb pull-right mr-t-7"> 
                           <li><a href="<?php echo e(url('admin/user')); ?>"><i class="fa fa-home"></i> Home</a></li> 
                           <li class="active">Change Password</li>
                        </ul>
                    </header> 
                    <!-- End of Page Heading -->     

                    <section class="scrollable wrapper w-f"> 
                        <div class="main-container">
                            <form action="<?php echo e(url('admin/user/change-password-by-dasboard')); ?>" id="admin_login" class="stream-form change_password" method="post">


                                <?php echo csrf_field(); ?>

                                <?php if(isset($errors) && $errors->any()): ?>
                                <div class="alert alert-danger alert-dismissable server-error alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$message): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <label class="error-msg">* <?php echo e($message); ?></label><br/>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </div>
                                <?php elseif(Session::has('status')): ?>
                                <div class="alert alert-danger alert-dismissable server-error alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    <label class="text-success"><?php echo e(Session::get('status')); ?></label><br/>
                                </div>
                                <?php endif; ?>



                                <?php if(Session::get('error_msg')): ?> 
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    <?php echo e(Session::get('error_msg')); ?>

                                </div>
                                <?php elseif(Session::get('success_msg')): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Success !</h4>
                                    <?php echo e(Session::get('success_msg')); ?>

                                </div>
                                <?php endif; ?> 

                                <div class="row">
                                    <div class="panel-body"> 
                                        <div class="form-group"> 
                                            <label>Current Password</label> 
                                            <div class="">
                                                <input type="password" value=""  autocomplete="new-password" class="form-control tb-big band_name" name="old_password">
                                            </div>
                                        </div>
                                        <div class="form-group"> 
                                            <label>New Password</label> 
                                            <div class="">
                                                <input type="password" autocomplete="new-password" value="" class="form-control tb-big band_name" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group"> 
                                            <label>Confirm Password</label> 
                                            <div class="">
                                                <input type="password" autocomplete="new-password" value="" class="form-control tb-big band_name" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group"> 
                                    <div class="custom-file-input">
                                        <button type="submit" class="btn btn-s-md green-button">Save</button>
                                       
                                    </div>
                                </div>
                            </form>

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