<?php $__env->startSection('content'); ?>

<p>
    <a title="Back" href="<?php echo e(route('managebranches')); ?>">
        <i class="fa fa-chevron-circle-left"></i> Back To Branches
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header">
    <h4 class="card-title"><?php echo e($page_title); ?></h4>
</div>

<div class="card-body">

<div class="row">

    <div class="col-md-6 mb-3">
        <label class="fw-bold">Branch Name</label>
        <p><?php echo e($row->branch_name ?? '-'); ?></p>
    </div>

    <div class="col-md-6 mb-3">
        <label class="fw-bold">Branch Code</label>
        <p><?php echo e($row->branch_code ?? '-'); ?></p>
    </div>

    <div class="col-md-12 mb-3">
        <label class="fw-bold">Address</label>
        <p><?php echo e($row->address ?? '-'); ?></p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">State</label>
        <p><?php echo e($row->state_name ?? '-'); ?></p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Contact Person</label>
        <p><?php echo e($row->contact_person ?? '-'); ?></p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Pincode</label>
        <p><?php echo e($row->pincode ?? '-'); ?></p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Phone</label>
        <p><?php echo e($row->phone ?? '-'); ?></p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Email</label>
        <p><?php echo e($row->email ?? '-'); ?></p>
    </div>

    <div class="col-md-2 mb-3">
        <label class="fw-bold">Sort Order</label>
        <p><?php echo e($row->sort ?? 0); ?></p>
    </div>

    <div class="col-md-2 mb-3">
        <label class="fw-bold">Status</label>
        <p>
            <?php if($row->status == "1"): ?>
                <span class="badge bg-success">Active</span>
            <?php else: ?>
                <span class="badge bg-danger">Inactive</span>
            <?php endif; ?>
        </p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Created At</label>
        <p><?php echo e($row->created_at ?? '-'); ?></p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Updated At</label>
        <p><?php echo e($row->updated_at ?? '-'); ?></p>
    </div>

</div>

<div class="mt-3">
    <a href="<?php echo e(route('managebranches')); ?>" class="btn btn-secondary">
        Back
    </a>

  
</div>

</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/branches/detail.blade.php ENDPATH**/ ?>