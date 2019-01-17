<?php $__env->startSection('title'); ?> <?php echo e('User List'); ?> @parent  <?php $__env->stopSection(); ?> 
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
                        <p><strong>Users Report</strong></p>
                        <ul class="breadcrumb pull-right mr-t-7"> 
                            <li><a href="<?php echo e(url('admin/user')); ?>"><i class="icon icon-home"></i> Home</a></li> 
                            <li class="active">User Report List</li> 
                        </ul>
                    </header> 
                    <!-- End of Page Heading -->     
                            
                    <section class="scrollable wrapper w-f"> 
                        <div class="main-container padd-bottom-70">
                            <?php if(count($errors) > 0): ?>
                                <!-- Form Error List -->
                                <div class="alert alert-danger">
                                    <strong>Whoops! Something went wrong!</strong>
                                    <br><br>
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </ul>
                                </div>
                            <?php elseif(Session::has('message') && !Session::has('status')): ?>
                                <div class="alert alert-danger text-left">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul><li><?php echo e(Session::get('message')); ?></li></ul>
                                </div>
                            <?php elseif(Session::has('message') && Session::has('status')): ?>
                                <div class="alert alert-success text-left">
                                    <ul><li><?php echo e(Session::get('message')); ?></li></ul>
                                </div>
                            <?php endif; ?>  
                            <section class="">
                                <div class="table-responsive">
                                    <table id="basicDataTable" class="table table-striped b-t margin-0 b-light">
                                        <thead class="custom-head">
                                            <tr>
                                                <th>Id</th>
                                                <th>Reported By Name</th>
                                                <th>Avatar Name</th>
                                                <th>Reported For</th>
                                                <th>Reason</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                            </section>
                        </div>
                    </section>

                </section> 
            </section>
        </section>
    </section>
</section>
<!-- /#page-wrapper -->
<!--END PAGE WRAPPER-->
<?php $__env->startSection('scriptjs'); ?>
<script src="<?php echo e(URL::asset('assets/admin/js/user_report.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>