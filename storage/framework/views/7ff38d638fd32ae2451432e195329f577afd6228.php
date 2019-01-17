<?php $__env->startSection('title'); ?> <?php echo e('Admin Login'); ?>  @parent  <?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
<div class="login-bg">
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xxl">
        <a class="navbar-brand block" href="#">
            <img src="<?php echo e(URL::asset('assets/admin/images/logo.png')); ?>" class="" alt="">
            <span class="textLogo"> Chilled </span>
        </a> 
        <section id="signIn" class="panel panel-default bg-white m-t-lg animated fadeInUp">
            <header class="panel-heading text-center"> 
                <strong>Change Password</strong> 
            </header>
            <form action="<?php echo e(url('admin/user/change-password')); ?>" id="admin_login" class="panel-body wrapper-lg admin_login" method="post">
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


                <div class="form-group"> 
                    <label>Current Password</label> 
                    <div class="">
                        <input type="password" value="" class="form-control tb-big band_name" name="old_password" autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group"> 
                    <label>New Password</label> 
                    <div class="">
                        <input type="password" value="" class="form-control tb-big band_name" name="password" 
                        autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group"> 
                    <label>Confirm Password</label> 
                    <div class="">
                        <input type="password" value="" autocomplete="new-password" class="form-control tb-big band_name" name="password_confirmation">
                    </div>
                </div>

                <button type="submit" class="btn btn-s-md bg-green">Done</button>
                <button type="button" class="btn btn-s-md bg-green m-l-10"  onclick="window.location ='<?php echo e(url("auth/login")); ?>'">Cancel</button>


            </form>
        </section>


    </div>
</section>
<!-- footer --> 
<footer id="footer">
    <div class="text-center padder">
        <p> <small></small> </p>
    </div>
</footer>
<?php $__env->startSection('admin.layout.footer'); ?>
</div>
<script>$('html').addClass('bg-green');</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>