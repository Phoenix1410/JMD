
<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
            <div class="card-header card-primary">
                <i class="fa fa-cog"></i> <?php echo e($page_title); ?>

            </div>
            <div class="card-body">
                <form method="post" id="form" enctype="multipart/form-data" action="<?php echo e(route('postAddSaveHomebanner')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group mb-3">
                            <label class="label-setting">Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" value="<?php echo e((old('title')?old('title'):(!empty($row)?$row->title:''))); ?>" required>
                            <?php $__errorArgs = ['title'];
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
                            <label class="label-setting">Sub Title<span class="text-danger">*</span></label>
                            <textarea name="sub_title" class="form-control" rows="3" required><?php echo e((old('sub_title')?old('sub_title'):(!empty($row)?$row->sub_title:''))); ?></textarea>
                            <?php $__errorArgs = ['sub_title'];
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
                            <label class="label-setting">Image</label>
                            <input type="file" name="image" accept="image/*" class="form-control">
                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                            <?php $__errorArgs = ['image'];
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
                            <?php if(!empty($row->image) && (Storage::exists($row->image) || file_exists(public_path($row->image)))): ?>
                            <div class="prev-img-thumb"><img src="<?php echo e(asset($row->image)); ?>"></div>
                            <!-- <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p> -->
                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->image); ?>"><i class="fa fa-download"></i> Download </a>
                            <!-- <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="<?php echo e(AdminHelper::adminpath()); ?>/delete-image?image=<?php echo e($row->logo); ?>&&id=<?php echo e($row->id); ?>&&column=logo&table=admin_settings"><i class="fa fa-ban"></i> Delete </a> -->
                            </p>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/apperance/home_banner.blade.php ENDPATH**/ ?>