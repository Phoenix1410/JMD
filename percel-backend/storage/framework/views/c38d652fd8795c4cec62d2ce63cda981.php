<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(AdminHelper::adminpath()); ?>/slider"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Home Page Slider</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="<?php echo e(route('postAddSlider')); ?>" method="post" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(AdminHelper::adminpath()); ?>/slider">
            	<div class="row">
            		<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="title" class="form-label">Title <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="name" class="form-control" name="title" id="title" value="<?php echo e(old('title')); ?>" placeholder="Enter Image Name" required>					        
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
					        <p class="text-muted"></p>
					    </div>            			
            		</div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Short Description <span class="text-danger" title="This field is required">*</span></label>
                            <textarea title="name" class="form-control" name="short_description" id="short_description"  placeholder="Enter Image Description" rows="3" required> <?php echo e(old('short_description')); ?></textarea>                          
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
                            <p class="text-muted"></p>
                        </div>                      
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Image <span class="text-danger" title="This field is required">*</span></label>
                            <input type="file" title="image" class="form-control" name="image" id="image" accept="image/*" required>                            
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
                            <p class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 2MB. Please use 1920 × 760 px dimension for better view.</p>
                        </div>                      
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="Nameinput" class="form-label">Select Status<span class="text-danger" title="This field is required">*</span></label>
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
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
                    </div>
            		
            	</div>
            	<div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                            	<a href="<?php echo e(AdminHelper::adminpath()); ?>/slider" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/slider/add.blade.php ENDPATH**/ ?>