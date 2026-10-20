<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="<?php echo e(route('who-we-are.store')); ?>" method="post" enctype="multipart/form-data" id="addUpdateForm"> 
                <?php echo csrf_field(); ?>
                <input type="hidden" name="return_url" value="<?php echo e(route('who-we-are.index')); ?>">
                <input type="file" name="image" id="finalImage" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Title <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="name" class="form-control" name="title" id="title" value="<?php echo e((!empty(old('title'))?old('title'):$row->title)); ?>" placeholder="Enter Title" required>
                            <p class="text-muted">The title should not exceed 50 characters.</p>
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
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description"><?php echo e((!empty(old('description'))?old('description'):$row->description)); ?></textarea>                      
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
                     <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="vision_statement_title" class="form-label">Vision Statement Title<span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="vision_statement_title" id="vision_statement_title" value="<?php echo e((!empty(old('vision_statement_title'))?old('vision_statement_title'):$row->vision_statement_title)); ?>" placeholder="vision statement title" required>
                            <p class="text-muted">The vision statement should not exceed 300 characters.</p>
                            <?php $__errorArgs = ['vision_statement_title'];
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
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="vision_statement" class="form-label">Vision Statement <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="vision_statement" id="vision_statement" value="<?php echo e((!empty(old('vision_statement'))?old('vision_statement'):$row->vision_statement_content)); ?>" placeholder="Vision Statement" required>
                            <p class="text-muted">The vision statement should not exceed 300 characters.</p>
                            <?php $__errorArgs = ['vision_statement'];
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
                   
                     <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="our_value_title" class="form-label">Our Value Title<span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="our_value_title" id="our_value_title" value="<?php echo e((!empty(old('our_value_title'))?old('our_value_title'):$row->our_value_title)); ?>" placeholder="our value title" required>
                            <p class="text-muted">The vision statement should not exceed 300 characters.</p>
                            <?php $__errorArgs = ['our_value_title'];
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
                     
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="our_value" class="form-label">Our Value <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="our_value" id="our_value" value="<?php echo e((!empty(old('our_value'))?old('our_value'):$row->our_value_content)); ?>" placeholder="Our Value" required>
                            <p class="text-muted">The our value should not exceed 300 characters.</p>
                            <?php $__errorArgs = ['our_value'];
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
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="quality_policy_title" class="form-label">Quality policy title<span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="quality_policy_title" id="quality_policy_title" value="<?php echo e((!empty(old('quality_policy_title'))?old('quality_policy_title'):$row->quality_policy_title)); ?>" placeholder="quality policy title" required>
                            <p class="text-muted">The vision statement should not exceed 300 characters.</p>
                            <?php $__errorArgs = ['quality_policy_title'];
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
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="quality_policy" class="form-label">Quality Policy <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="quality_policy" id="quality_policy" value="<?php echo e((!empty(old('quality_policy'))?old('quality_policy'):$row->quality_policy_content)); ?>" placeholder="Quality Policy" required>   
                            <p class="text-muted">The quality policy should not exceed 300 characters.</p>                       
                            <?php $__errorArgs = ['quality_policy'];
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
                <div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                                <!-- <a href="<?php echo e(route('who-we-are.index')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a> -->
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
<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    

      CKEDITOR.replace( 'description',{
        allowedContent : true,
        versionCheck: false,
         resize_enabled: false 
      });

    
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/who_we_are/index.blade.php ENDPATH**/ ?>