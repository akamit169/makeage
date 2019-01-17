<?php $__env->startSection('title'); ?> <?php echo e('Forgot Password'); ?>  @parent  <?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
<div class="login-bg">
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xxl">
        <a class="navbar-brand block" href="#">

            <span class="textLogo">oms</span>
        </a> 


        <section id="forgotPassword" class="panel panel-default bg-white m-t-lg animated fadeInUp">
            <header class="panel-heading text-center"> <strong>Forgot password?</strong> </header>
            <form action="<?php echo e(url('admin/user/email')); ?>" id="admin-forgot-password" class="panel-body wrapper-lg admin-forgot-password" method="post">
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

                <input type="hidden" name="role" id="role" class="role" value="2" />
                <div class="form-group"> 
                    <label class="control-label">Email</label> 
                    <input type="email" name="email" id="forgot-email" placeholder="Please enter email" class="form-control input-lg forgot-email"> 
                </div>
                <a href="<?php echo e(url('auth/login')); ?>" class="pull-right m-t-xs">
                    <small>Back</small>
                </a> 
                <button type="submit" class="btn btn-s-md btn-login" id="forgot-password">
                    <b>Send</b>
                </button>
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
<!--<script src="<?php echo e(URL::asset('admin-panel/assets/js/login.js')); ?>"></script>-->
<script>$('html').addClass('bg-green');</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>