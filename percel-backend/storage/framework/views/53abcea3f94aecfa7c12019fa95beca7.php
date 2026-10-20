
<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
            <div class="card-header card-primary">
                <i class="fa fa-cog"></i> <?php echo e($page_title); ?>

            </div>
            <div class="card-body">
                <form method="post" id="form" enctype="multipart/form-data" action="<?php echo e(route('postAddSaveBattleroom')); ?>">
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
                            <label class="label-setting">Short Description<span class="text-danger">*</span></label>
                            <textarea name="short_description" class="form-control" rows="3" required><?php echo e((old('short_description')?old('short_description'):(!empty($row)?$row->short_description:''))); ?></textarea>
                            <?php $__errorArgs = ['short_description'];
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
                            <label class="label-setting">Image 1</label>
                            <input type="file" name="image1" accept="image/*" class="form-control">
                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                            <?php $__errorArgs = ['image1'];
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
                            <?php if(!empty($row->image1) && (Storage::exists($row->image1) || file_exists(public_path($row->image1)))): ?>
                            <div class="prev-img-thumb"><img src="<?php echo e(asset($row->image1)); ?>"></div>
                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image1=<?php echo e($row->image1); ?>"><i class="fa fa-download"></i> Download </a>
                            </p>
                            <?php endif; ?>                   
                        </div>
                        <div class="form-group mb-3">
                            <label class="label-setting">Image 2</label>
                            <input type="file" name="image2" accept="image/*" class="form-control">
                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                            <?php $__errorArgs = ['image2'];
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
                            <?php if(!empty($row->image2) && (Storage::exists($row->image2) || file_exists(public_path($row->image2)))): ?>
                            <div class="prev-img-thumb"><img src="<?php echo e(asset($row->image2)); ?>"></div>
                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image2=<?php echo e($row->image2); ?>"><i class="fa fa-download"></i> Download </a>
                            </p>
                            <?php endif; ?>                   
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="label-setting">List 1</label>
                                    <input type="text" class="form-control" name="list1" value="<?php echo e((old('list1')?old('list1'):(!empty($row)?$row->list1:''))); ?>">
                                    <?php $__errorArgs = ['list1'];
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="label-setting">List 2</label>
                                    <input type="text" class="form-control" name="list2" value="<?php echo e((old('list2')?old('list2'):(!empty($row)?$row->list2:''))); ?>">
                                    <?php $__errorArgs = ['list2'];
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="label-setting">List 3</label>
                                    <input type="text" class="form-control" name="list3" value="<?php echo e((old('list3')?old('list3'):(!empty($row)?$row->list3:''))); ?>">
                                    <?php $__errorArgs = ['list3'];
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
                            </div>                        
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="label-setting">List 4</label>
                                    <input type="text" class="form-control" name="list4" value="<?php echo e((old('list4')?old('list4'):(!empty($row)?$row->list4:''))); ?>">
                                    <?php $__errorArgs = ['list4'];
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
                            </div>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/apperance/battleroom.blade.php ENDPATH**/ ?>