<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getManageCity')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage City</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="<?php echo e(route('postAddCity')); ?>" method="post" enctype="multipart/form-data"> 
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getManageCity')); ?>">
            	<div class="row">

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">City Name(English) <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Title" class="form-control" name="city_name" id="city_name" value="<?php echo e(old('city_name')); ?>" required>                          
                            <?php $__errorArgs = ['city_name'];
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
                            <label for="title" class="form-label">City Name(French) <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Title" class="form-control" name="city_name_fr" id="city_name_fr" value="<?php echo e(old('city_name_fr')); ?>" required>                          
                            <?php $__errorArgs = ['city_name_fr'];
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
                            <label for="title" class="form-label">City Name(Arabic) <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Title" class="form-control" name="city_name_ar" id="city_name_ar" value="<?php echo e(old('city_name_ar')); ?>" required>                          
                            <?php $__errorArgs = ['city_name_ar'];
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
                            <label for="title" class="form-label">Country <span class="text-danger" title="This field is required">*</span></label>
                            <select name="country_id" class="form-control" required>
                                <option value="">Select Country</option>
                                <?php if(!empty($countries)): ?>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->country_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>                          
                            <?php $__errorArgs = ['country_id'];
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
                            <label for="Nameinput" class="form-label">Status<span class="text-danger" title="This field is required">*</span></label>
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1" <?php echo e((old('status') && old('status')==1)?'selected':''); ?>>Active</option>
                                <option value="0" <?php echo e((old('status') && old('status')==0)?'selected':''); ?>>Inactive</option>
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
                            	<a href="<?php echo e(route('getManageCity')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                                <input type="submit" name="submit" value="Save & Add More" class="btn btn-primary">
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/city/add.blade.php ENDPATH**/ ?>