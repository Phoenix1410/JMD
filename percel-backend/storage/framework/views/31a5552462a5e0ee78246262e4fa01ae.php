<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
            <div class="card-header card-primary">
                <i class="fa fa-cog"></i> <?php echo e($page_title); ?>

            </div>
            <div class="card-body">
                <form method="post" id="form" enctype="multipart/form-data" action="<?php echo e(route('postSaveProfile')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group mb-3">
                            <label class="label-setting">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?php echo e((old('name')?old('name'):(!empty($row)?$row->name:''))); ?>" required>
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
                        </div>                                               
                        <div class="form-group mb-3">
                            <label class="label-setting">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" value="<?php echo e((old('email')?old('email'):(!empty($row)?$row->email:''))); ?>" required>
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
                        </div>

                        <div class="form-group mb-3 position-relative">
    <label for="passwordInput" class="form-label">Password</label>

    <input 
        type="password"
        class="form-control"
        name="password"
        id="passwordInput"
        value="<?php echo e(old('password')); ?>"
        placeholder="Password"
    >

    <!-- Toggle Button -->
    <span 
       id="toggleIcon"
        style="position:absolute; right:10px; top:38px; cursor:pointer;"
    >
        👁️
    </span>

    <p class="text-muted">
        <em>* Leave blank if do not want to change password.</em>
    </p>

    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="text-danger mt-1">
            <strong><?php echo e($message); ?></strong>
        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

                        <div class="form-group mb-3">
                            <label class="label-setting">Photo</label>                           
                            <?php if(!empty($row->photo) && (Storage::exists($row->photo) || file_exists(public_path($row->photo)))): ?>
                            <div class="prev-img-thumb"><img src="<?php echo e(asset($row->photo)); ?>"></div>
                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                            <p><a class="btn btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->photo); ?>"><i class="fa fa-download"></i> Download </a>
                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="<?php echo e(AdminHelper::adminpath()); ?>/delete-image?image=<?php echo e($row->photo); ?>&&id=<?php echo e($row->id); ?>&&column=photo&table=admin_users"><i class="fa fa-ban"></i> Delete </a></p>
                            <?php else: ?>
                            <input type="file" name="photo" accept="image/*" class="form-control">
                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                            <?php $__errorArgs = ['photo'];
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
                            <?php endif; ?>              
                        </div>
                        
                    </div><!-- /.box-body -->
                    <div class="card-footer">
                        <div class="pull-right">
                            <input type="submit" name="submit" value="Save" class="btn btn-success">
                        </div>
                    </div><!-- /.box-footer-->
                </form>
            </div>
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("passwordInput");
    const icon = document.getElementById("toggleIcon");

    icon.addEventListener("click", function () {
        input.type = input.type === "password" ? "text" : "password";
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/profile/add.blade.php ENDPATH**/ ?>