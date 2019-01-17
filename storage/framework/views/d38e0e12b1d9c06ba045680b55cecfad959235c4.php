<?php $__env->startSection('title'); ?> <?php echo e('Admin Dashboard'); ?>  @parent  <?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
<section class="vbox">
    <?php echo $__env->make('admin.layout.menu_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section>
        <section class="hbox stretch">
            <!-- .aside --> 
            <?php echo $__env->make('admin.layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- /.aside --> 
            <section id="content"> 
                <section class="vbox"> 
                    <header class="header bg-white b-b b-light"> 
                        <p><strong>Welcome to oms</strong></p>
<!--                        <ul class="breadcrumb pull-right mr-t-7"> 
                            <li><a href="javascript:void(0);"><i class="icon icon-home"></i> Home</a></li> 
                            <li class="active"> <i class="icon icon-change-password"></i>Statistics</li> 
                        </ul>-->
                    </header>
                    
                    <section class="scrollable wrapper w-f"> 
                        <div class="row">
<!--                            <div class="col-sm-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading head-bg-white text-center font-bold">Hours of music uploaded to date</header>
                                    <div class="panel-body text-center">
                                        <div class="stat-show"> 
                                            <span class="icon icon-to-date f-85"></span>
                                            <span class="dateTime" ></span>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-sm-6">
                                <section class="panel panel-default">
                                    <header class="panel-heading head-bg-white text-center font-bold">New  flagged requests</header>
                                    <div class="panel-body text-center">
                                        <div class="stat-show"> 
                                            <span class="icon icon-flag "></span>
                                            <span title=""></span>
                                            <div class="btn-full">
                                                <a class="btn btn-s-md bg-green btn-rounded" href="">view flagged items</a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>-->

                        </div>
                        <div class="mar-b-40"></div>
                    </section>
                    
                    <footer class="footer bg-white b-t b-light"> <p></p> </footer>

                </section> 
            </section>
        </section>
    </section>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>