<?php $__env->startSection('content'); ?>
<!-- <script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script> -->
<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p><a title="Main Module" href="<?php echo e(route('getManageCMS')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage CMS</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 



            <div class="card-body">
            	<form action="<?php echo e(route('postUpdateCms', $row->id)); ?>" method="post" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getManageCMS')); ?>">
            	<div class="row">

            		
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Page Title <span class="text-danger" title="This field is required"></span></label>
					        <input type="text" title="Page Title" class="form-control" name="page_title" value="<?php echo e((old('page_title'))?old('page_title'):$row->page_title); ?>" placeholder="Page Title" required readonly>					        
					        <?php $__errorArgs = ['page_title'];
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

            		


            		<div class="col-md-6">
            			<!-- <div class="mb-3 ">
					        <label class="form-label">Featured Image</label>
					        <input type="file" class="form-control" name="image" accept="image/*">					        
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
					        <p class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 5MB.</p>
					    </div> -->  
					     <div class="form-group mb-3">
                            <label class="label-setting">Featured Image</label>                            
                            <?php if(!empty($row->featured_image) && (Storage::exists($row->featured_image) || file_exists(public_path($row->featured_image)))): ?>
                            <div class="prev-img-thumb"><img src="<?php echo e(asset($row->featured_image)); ?>"></div>
                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->featured_image); ?>"><i class="fa fa-download"></i> Download </a>
                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="<?php echo e(AdminHelper::adminpath()); ?>/delete-image?image=<?php echo e($row->featured_image); ?>&&id=<?php echo e($row->id); ?>&&column=featured_image&table=cms_pages"><i class="fa fa-ban"></i> Delete </a></p>
                            <?php else: ?>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control" >
                            <div class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 2MB.</div>  
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
                            <?php endif; ?>                   
                        </div>            			
            		</div>
            		

            		

            		<div class="col-md-12">
            			<div class="mb-3 ">
					        <label class="form-label">Page Content <span class="text-danger" title="This field is required">*</span></label>
					        <textarea name="page_content" class="form-control" id="description">					        	
					        	<?php echo e((old('page_content'))?old('page_content'):$row->page_content); ?>


					        </textarea>				        
					        <?php $__errorArgs = ['page_content'];
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

            		
            		
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Meta Title <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Meta Title" class="form-control" name="meta_title" value="<?php echo e((old('meta_title'))?old('meta_title'):$row->meta_title); ?>" placeholder="Meta Title" required>					        
					        <?php $__errorArgs = ['meta_title'];
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
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Meta Keywords</label>
					        <input type="text" title="Meta Keywords" class="form-control" name="meta_keywords" value="<?php echo e((old('meta_keywords'))?old('meta_keywords'):$row->meta_keywords); ?>">						        
					        <?php $__errorArgs = ['meta_keywords'];
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
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Meta Description</label>
					        <textarea name="meta_description" class="form-control" rows="3"><?php echo e((old('meta_description'))?old('meta_description'):$row->meta_description); ?></textarea>					        
					        <?php $__errorArgs = ['meta_description'];
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
            	
            		<input type="hidden" name="status" value="1">
            		
            	</div>
            	<div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                            	<a href="<?php echo e(route('getManageCMS')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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
<?php $__env->startPush('bottom'); ?>
<script type="text/javascript">
	$(document).ready(function() {
	

	CKEDITOR.replace( 'description',{
	  	allowedContent : true,
	  	versionCheck: false
	});


	

	});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/cms_management/edit.blade.php ENDPATH**/ ?>