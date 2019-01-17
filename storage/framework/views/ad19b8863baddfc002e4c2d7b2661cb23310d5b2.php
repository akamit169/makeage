<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0 "); // Proxies.
?>

<!DOCTYPE html>
<html lang="en" class='app'>
<head>
    <?php echo $__env->make('admin.layout.header_include', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script>
         var SITE_URL = "<?php echo e(url('')); ?>";
    </script>
</head>
<body class="" onunload="" >
    <!-- loading Html -->
    <div class="loading-overpay">
        <div class="loading">
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
            <div class="loading-bar"></div>
        </div>
    </div>
    <!-- loading Html -->
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldContent('admin.layout.footer'); ?>
    <?php echo $__env->make('admin.layout.footer_include', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('scriptjs'); ?>
</body>
</html>