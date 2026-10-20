<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='generator' content=''/>
    <meta name='robots' content='noindex,nofollow'/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset(AdminHelper::getSetting('favicon'))); ?>">

    <link href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('assets/admin/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('assets/admin/css/app.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo e(asset('assets/admin/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />

</head>
<body>

<div class="auth-page-wrapper pt-1 pt-md-5">
        <!-- auth page content -->
        <div class="auth-page-content pt-0 pt-md-3">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-2">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <?php $logo = AdminHelper::getSetting('logo'); ?>
                                    <!-- <p class="mt-3 fs-15 fw-medium"><?php echo e(AdminHelper::getSetting('appname')); ?></p> -->
                                    <?php if(!empty($logo)): ?>
                                    <div class="adminlogo">
                                        <img src="<?php echo e(asset(AdminHelper::getSetting('logo'))); ?>">
                                    </div>
                                    <?php else: ?>
                                    <p class="mt-3 fs-15 fw-medium"><?php echo e(AdminHelper::getSetting('appname')); ?></p>
                                    <?php endif; ?>
                                    <h5 class="text-primary">Forgot Password?</h5>                                   
                                    <p>Enter your email and instructions will be sent to you!</p>
                                </div>

                                <?php if( Session::get('message') != '' ): ?>
                                    <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                        <?php echo e(Session::get('message')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(Session::has('error')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(Session::get('error')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(Session::has('success')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(Session::get('success')); ?>

                                    </div>
                                <?php endif; ?>
                                <div class="p-2">
                                    <form action="<?php echo e(route('postForgot')); ?>" method="post">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
                                        <div class="mb-4">
                                            <input type="email" class="form-control" id="email" name='email' placeholder="Enter Email">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Submit</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                                <div class="mt-4 text-center">
                                    <p class="mb-0 forgottext">Try login again ? <a href='<?php echo e(route("getLogin")); ?>' class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?php echo e(asset('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>        
    <script src="<?php echo e(asset('assets/admin/libs/feather-icons/feather.min.js')); ?>"></script>
</body>

</html><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/auth/forgot.blade.php ENDPATH**/ ?>