
<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getManageStaff')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Staffs</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="<?php echo e(route('postUpdateStaff', $row->id)); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getManageStaff')); ?>">
            	<div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="name" class="form-label">Name <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Name" class="form-control" name="name" id="name" value="<?php echo e((old('name'))?old('name'):$row->name); ?>" placeholder="Enter Name" required>                          
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>                      
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="email" class="form-label">Email <span class="text-danger" title="This field is required">*</span></label>
                            <input type="email" title="Email" class="form-control" name="email" id="email" value="<?php echo e((old('email'))?:$row->email); ?>" placeholder="Enter Email" required>                          
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>                      
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="password" class="form-label"> Password <span class="text-danger" title="This field is required"></span></label>
                            <input type="password" title="Password" class="form-control" name="password" id="password" maxlength="13" value="" placeholder="Enter password" autocomplete="new-password">                          
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>                      
                    </div>
                    <div class="col-md-12">
                        <div class="mb-6 ">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1" <?php echo e($row->status=='1'?'selected':''); ?>>Active</option>
                                <option value="0" <?php echo e($row->status=='0'?'selected':''); ?>>Inactive</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>                      
                    </div>



                </div>
            	<div class="row g-3">
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                        	<a href="<?php echo e(route('getManageStaff')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        	<input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            	</form>
            </div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/staff/edit.blade.php ENDPATH**/ ?>