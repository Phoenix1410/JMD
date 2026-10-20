<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getAdminUsers')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="<?php echo e(route('postAddSaveAdminUser')); ?>" method="post" enctype="multipart/form-data"> 
        	<?php echo csrf_field(); ?>
        	<input type="hidden" name="return_url" value="<?php echo e(route('getAdminUsers')); ?>">
        	<div class="mb-3 ">
                <label for="name" class="form-label">Name <span class="text-danger" title="This field is required">*</span></label>
                <input type="text" title="Name" class="form-control" name="name" id="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Name" required>                          
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
            <div class="mb-3 ">
                <label for="email" class="form-label">Email <span class="text-danger" title="This field is required">*</span></label>
                <input type="email" title="Email" class="form-control" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="Enter Email" required>                          
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
            <div class="mb-3 ">
                <label for="password" class="form-label">Password <span class="text-danger" title="This field is required">*</span></label>
                <input type="password" title="Password" class="form-control" name="password" id="password" value="<?php echo e(old('email')); ?>" placeholder="Enter Password" required>                          
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
            <div class="mb-3 ">
                <label for="privilege" class="form-label">Privilege <span class="text-danger" title="This field is required">*</span></label>
                <select name="privilege" id="privilege" class="form-control" required>
                    <option value="">Select a Privilege</option>
                    <?php if(!empty($privileges)): ?>
                    <?php $__currentLoopData = $privileges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privilege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($privilege->id); ?>"><?php echo e($privilege->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
                <?php $__errorArgs = ['privilege'];
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
            <div class="mb-3 ">
                <label for="status" class="form-label">Status <span class="text-danger" title="This field is required">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="">Select a Status</option>                    
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
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
        	<div class="row g-3">
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                        	<a href="<?php echo e(route('getAdminUsers')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/admin_users/add.blade.php ENDPATH**/ ?>