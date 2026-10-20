<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
            <div class="card-header card-primary">
                <i class="fa fa-cog"></i> <?php echo e($page_title); ?>

            </div>
            <div class="card-body">
                <form method="post" id="form" enctype="multipart/form-data" action="<?php echo e(route('postSaveComissionSettings')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group mb-3">
                            <label class="label-setting">Site commission for sellers who are selling own product<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="commission_own_product" value="<?php echo e((old('commission_own_product')?old('commission_own_product'):(!empty($row)?$row->commission_own_product:''))); ?>" required>
                            <?php $__errorArgs = ['commission_own_product'];
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
                            <label class="label-setting">Site commission for sellers who are selling iMart product<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="commission_imart_product" value="<?php echo e((old('commission_imart_product')?old('commission_imart_product'):(!empty($row)?$row->commission_imart_product:''))); ?>" required>
                            <?php $__errorArgs = ['site_title'];
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/settings/commission.blade.php ENDPATH**/ ?>