<?php $__env->startSection('content'); ?>

<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p>
    <a title="Back" href="<?php echo e(route('managenewsroll')); ?>">
        <i class="fa fa-chevron-circle-left"></i> Back To News List
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
</div>

<div class="card-body">

<form action="<?php echo e(route('postUpdatenewsroll', $row->id)); ?>" method="post" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<div class="row">

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Heading <span class="text-danger">*</span>
            </label>
            <input type="text"
                   class="form-control"
                   name="heading"
                   value="<?php echo e(old('heading', $row->heading)); ?>"
                   placeholder="Enter News Heading"
                   required>

            <?php $__errorArgs = ['heading'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Author Name</label>
            <input type="text"
                   class="form-control"
                   name="author_name"
                   value="<?php echo e(old('author_name', $row->author_name)); ?>"
                   placeholder="Author Name">

            <?php $__errorArgs = ['author_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Meta Title (SEO)</label>
            <input type="text"
                   class="form-control"
                   name="meta_title"
                   value="<?php echo e(old('meta_title', $row->meta_title)); ?>"
                   placeholder="Meta Title">

            <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number"
                   class="form-control"
                   name="sort"
                   value="<?php echo e(old('sort', $row->sort)); ?>"
                   min="0">

            <?php $__errorArgs = ['sort'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">
                Status <span class="text-danger">*</span>
            </label>

            <select name="status" class="form-control" required>
                <option value="1" <?php echo e(old('status', $row->status) == 1 ? 'selected' : ''); ?>>Active</option>
                <option value="0" <?php echo e(old('status', $row->status) == 0 ? 'selected' : ''); ?>>Inactive</option>
            </select>

            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

	<div class="col-md-6">			
		<div class="form-group mb-3">
                   <label class="label-setting">Featured Image</label>                            
                   <?php if(!empty($row->image) && (Storage::exists($row->image) || file_exists(public_path($row->image)))): ?>
                   <div class="prev-img-thumb"><img src="<?php echo e(asset($row->image)); ?>"></div>
                   <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                   <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->image); ?>"><i class="fa fa-download"></i> Download </a>
                   <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="<?php echo e(AdminHelper::adminpath()); ?>/delete-image?image=<?php echo e($row->image); ?>&&id=<?php echo e($row->id); ?>&&column=image&table=news"><i class="fa fa-ban"></i> Delete </a></p>
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
        <div class="mb-3">
            <label class="form-label">
                Content <span class="text-danger">*</span>
            </label>

            <textarea name="content"
                      id="content_editor"
                      class="form-control"
                      rows="6"><?php echo old('content', $row->content); ?></textarea>

            <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?php echo e(route('managenewsroll')); ?>"
           class="btn btn-secondary">
           Back
        </a>

        <button type="submit"
                class="btn btn-primary">
            Update
        </button>

    </div>
</div>

</form>

</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('bottom'); ?>
<script>
    CKEDITOR.replace('content_editor', {
        allowedContent: true,
        versionCheck: false
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/newsroll/edit.blade.php ENDPATH**/ ?>