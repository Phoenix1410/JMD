<?php $__env->startSection('content'); ?>
<!-- <script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script> -->
<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p><a title="Main Module" href="<?php echo e(route('getIndexEmailTemplate')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Email Templates</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="<?php echo e(route('postUpdateEmailTemplate', $row->id)); ?>" method="post" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getIndexEmailTemplate')); ?>">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Name <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Page Title" class="form-control" name="name" value="<?php echo e((old('name'))?old('name'):$row->name); ?>" placeholder="Name" required >					        
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
            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label class="form-label">Slug <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Page Title" class="form-control" name="slug" value="<?php echo e((old('slug'))?old('slug'):$row->slug); ?>" placeholder="Template Slug" required readonly>					        
					        <?php $__errorArgs = ['slug'];
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
					        <label class="form-label">Subject <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Page Title" class="form-control" name="subject" value="<?php echo e((old('subject'))?old('subject'):$row->subject); ?>" placeholder="Subject" required >					        
					        <?php $__errorArgs = ['subject'];
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
					        <label class="form-label">Content</label>
					        <textarea name="content" class="form-control" id="description"><?php echo (old('content'))?old('content'):$row->content; ?></textarea>				        
					        <?php $__errorArgs = ['content'];
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
					        <label class="form-label">Description <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="Description" class="form-control" name="description" value="<?php echo e((old('description'))?old('description'):$row->description); ?>" placeholder="Description" required >					        
					        <?php $__errorArgs = ['description'];
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
					        <label class="form-label">From Name <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="From Name " class="form-control" name="from_name" value="<?php echo e((old('from_name'))?old('from_name'):$row->from_name); ?>" placeholder="From Name" required>					        
					        <?php $__errorArgs = ['from_name'];
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
					        <label class="form-label">From Email<span class="text-danger" title="This field is required">*</span></label>
					        <input type="email" title="From Email" class="form-control" name="from_email" value="<?php echo e((old('from_email'))?old('from_email'):$row->from_email); ?>">						        
					        <?php $__errorArgs = ['from_email'];
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
					        <label class="form-label">CC Email</label>
					        <input type="email" title="From Email" class="form-control" name="cc_email" value="<?php echo e((old('cc_email'))?old('cc_email'):$row->cc_email); ?>">						        
					        <?php $__errorArgs = ['cc_email'];
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
                            	<a href="<?php echo e(route('getIndexEmailTemplate')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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
	  /*$('#description').summernote({
	  	height: 300,
	  	placeholder: 'Type here...'
	  });*/

	  CKEDITOR.replace( 'description',{
	  	allowedContent : true,
	  	versionCheck: false
	  });

	  /*ClassicEditor
		.create( document.querySelector( '#description' ) )
	.catch( error => {
		console.error( error );
	} );*/

	});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/email_tempate_manage/edit.blade.php ENDPATH**/ ?>