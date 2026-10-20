<?php $__env->startSection('content'); ?>

<p>
    <a title="Back" href="<?php echo e(route('officetype')); ?>">
        <i class="fa fa-chevron-circle-left"></i> Back To Office Type List
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
</div>

<div class="card-body">

<form action="<?php echo e(route('postUpdateofficetype', $row->id)); ?>" method="post">
<?php echo csrf_field(); ?>

<div class="row">

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Office Type Name <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="type_name"
                   value="<?php echo e(old('type_name', $row->type_name)); ?>"
                   placeholder="Enter Office Type"
                   required>

            <?php $__errorArgs = ['type_name'];
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
                <option value="1" <?php echo e(old('status', $row->status) == 1 ? 'selected' : ''); ?>>
                    Active
                </option>
                <option value="0" <?php echo e(old('status', $row->status) == 0 ? 'selected' : ''); ?>>
                    Inactive
                </option>
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

</div>

<div class="row">
    <div class="col-md-12">

        <a href="<?php echo e(route('officetype')); ?>"
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/officetype/edit.blade.php ENDPATH**/ ?>