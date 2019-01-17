<?php $__env->startSection('title'); ?> <?php echo e('Admin Login'); ?>  @parent  <?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
<div class="login-bg">
<section id="content" class="">
    <div class="container aside-xxl">
        <a class="navbar-brand block" href="#">
            <span class="textLogo">Chilled</span>
        </a> 
        <section id="signIn" class="panel panel-default bg-white m-t-lg animated fadeInUp">
            <header class="panel-heading text-center"> 
                <strong>Sign in</strong> 
            </header>
            <form action="<?php echo e(url('auth/login')); ?>" id="admin_login" class="panel-body wrapper-lg admin_login" method="post">
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
                    <label class="control-label">Email</label>
                    <input type="hidden" name="user_type" value="<?php echo e(config('constants.USER_TYPE.admin')); ?>" />
                    <input type="email" name="email" id="login_email" required="true" placeholder="Please enter email" class="form-control input-lg login_email"> 
                </div>
                <div class="form-group"> 
                    <label class="control-label">Password</label> 
                    <input type="password" name="password" required="true" id="password" placeholder="Please enter password" class="form-control input-lg" autocomplete="new-password"> 
                </div>
            
                <a href="<?php echo e(url('admin/user/forget-password')); ?>" class="pull-right m-t-xs">
                    <small>Forgot password?</small>
                </a> 
                <button type="submit" class="btn btn-s-md btn-login ">
                    <b>Sign in</b>
                </button>
            </form>
        </section>


    </div>
</section>
<!-- footer --> 
<footer id="footer">
    <div class="text-center padder">
        <p> <small>2017 © Chilled</small> </p>
    </div>
</footer>
<?php $__env->startSection('admin.layout.footer'); ?>
</div>
<!--<script src="<?php echo e(URL::asset('/assets/admin/js/login.js')); ?>"></script> -->
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>