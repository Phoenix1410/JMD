<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>Admin - <?php echo e(AdminHelper::getSetting('appname')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
     <link rel="icon" type="image/ico" sizes="32x32" href="<?php echo e(asset(config('settings.favicon'))); ?>"> 
    

    <!-- Layout config Js -->
    <!-- <script src="admin/js/layout.js"></script> -->
    <!-- Sweet Alert css-->
    <link href="<?php echo e(asset('assets/admin/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo e(asset('assets/admin/font-awesome/css')); ?>/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="<?php echo e(asset('assets/admin/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!--select2 css-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!--Timepicker css-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <!--datepicker css--->
     <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- App Css-->
    <link href="<?php echo e(asset('assets/admin/css/app.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo e(asset('assets/admin/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--Select2 Js-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!--datepicker js-->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php echo $__env->make('admin::partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('admin::partial.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="vertical-overlay"></div>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">                            
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"><?php echo e((!empty($page_title))?$page_title:Session::get('appname')); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo e(AdminHelper::adminPath()); ?>">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?php echo e((!empty($page_title))?$page_title:Session::get('appname')); ?></li>
                                    </ol>
                                </div>
                                <?php /*@endif*/ ?>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                                                                      
                    <?php if(Session('success')): ?>                      
                    <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show" role="alert">
                        <i class="fa fa-check label-icon"></i>
                        <?php echo e(Session('success')); ?>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    <?php if(Session('error')): ?>                        
                        <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
                        <i class="fa fa-exclamation-triangle label-icon"></i>
                        <?php echo e(Session('error')); ?>

                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>

            <?php echo $__env->make('admin::partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <?php echo $__env->make('admin::partial.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('bottom'); ?>
</body>
</html><?php /**PATH /var/www/html/p7/rmm_food_products/app/Providers/../../resources/views/admin/layouts/admin_template.blade.php ENDPATH**/ ?>