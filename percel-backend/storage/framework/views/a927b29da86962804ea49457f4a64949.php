<?php $__env->startSection('content'); ?>

<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p>
    <a title="Back" href="<?php echo e(route('joblist')); ?>">
        <i class="fa fa-chevron-circle-left"></i> Back To Job Listings
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
</div>

<div class="card-body">

<form action="<?php echo e(route('postAddjoblist')); ?>" method="post">
<?php echo csrf_field(); ?>

<div class="row">

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Job Title <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="title"
                   value="<?php echo e(old('title')); ?>"
                   placeholder="Enter Job Title"
                   required>

            <?php $__errorArgs = ['title'];
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

    <!-- 
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Designation <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="designation"
                   value="<?php echo e(old('designation')); ?>"
                   placeholder="Enter Designation"
                   required>

            <?php $__errorArgs = ['designation'];
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
    </div> -->

    
 <div class="col-md-3">
    <div class="mb-3">
        <label class="form-label">Min Experience (Years)</label>
        <input type="number"
               class="form-control"
               name="min_experience"
               value="<?php echo e(old('min_experience')); ?>"
               min="0"
               placeholder="0">
    </div>
</div>

<div class="col-md-3">
    <div class="mb-3">
        <label class="form-label">Max Experience (Years)</label>
        <input type="number"
               class="form-control"
               name="max_experience"
               value="<?php echo e(old('max_experience')); ?>"
               min="0"
               placeholder="5">
    </div>
</div>

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Location <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="location"
                   value="<?php echo e(old('location')); ?>"
                   placeholder="Enter Job Location"
                   required>

            <?php $__errorArgs = ['location'];
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

    
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">
                Job Description 
            </label>

            <textarea name="description"
                      id="description_editor"
                      class="form-control"
                      rows="6"><?php echo old('description'); ?></textarea>

            <?php $__errorArgs = ['description'];
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
    <!-- status -->
     <div class="col-md-4">
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

<div class="row">
    <div class="col-md-12">

        <a href="<?php echo e(route('joblist')); ?>"
           class="btn btn-secondary">
           Back
        </a>

        <button type="submit"
                class="btn btn-primary">
            Save
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
    CKEDITOR.replace('description_editor', {
        allowedContent: true,
        versionCheck: false
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/beta/admin/resources/views/admin/joblisting/add.blade.php ENDPATH**/ ?>