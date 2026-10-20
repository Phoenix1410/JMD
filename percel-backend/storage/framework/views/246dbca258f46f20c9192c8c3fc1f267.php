<?php $__env->startSection('content'); ?>

<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p>
    <a title="Back" href="<?php echo e(route('manageclient')); ?>">
        <i class="fa fa-chevron-circle-left"></i> Back To Clients
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
</div>

<div class="card-body">

<form action="<?php echo e(route('postAddclients')); ?>" method="post" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<div class="row">

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Client Title <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="title"
                   value="<?php echo e(old('title')); ?>"
                   placeholder="Enter Client Title"
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

    
    <!-- <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Location <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="location"
                   value="<?php echo e(old('location')); ?>"
                   placeholder="Enter Client Location"
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
    </div> -->

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Client Image <span class="text-danger">*</span>
            </label>

            <input type="file"
                   class="form-control"
                   name="image"
                   accept="image/*"
                   required>

            <div class="text-muted">
                Allowed formats: JPG,WEBP, PNG, JPEG (Max 2MB)
            </div>

            <?php $__errorArgs = ['image'];
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
            <label class="form-label">
                Status <span class="text-danger">*</span>
            </label>

            <select class="form-control" name="status" required>
                <option value="">Select Status</option>
                <option value="1" >Active</option>
                <option value="0" >Inactive</option>
            </select>

            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger mt-1">
                <strong><?php echo e($message); ?></strong>
            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <!-- <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">
                Description
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
    </div> -->

</div>

<div class="row">
<div class="col-md-12">

    <a href="<?php echo e(route('manageclient')); ?>"
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/admin/resources/views/admin/clients/add.blade.php ENDPATH**/ ?>