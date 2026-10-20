<?php $__env->startSection('content'); ?>

<p>
    <a title="Back" href="<?php echo e(route('officetype')); ?>">
        <i class="fa fa-chevron-circle-left"></i>
        &nbsp; Back To Office Type List
    </a>
</p>

<div class="row">
<div class="col-lg-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
</div>

<div class="card-body">

<div class="table-responsive">
<table class="table table-striped table-bordered">

<tbody>

    <tr>
        <td width="200"><strong>Office Type Name</strong></td>
        <td><?php echo e($row->type_name); ?></td>
    </tr>

    <tr>
        <td><strong>Status</strong></td>
        <td>
            <?php if($row->status == 1): ?>
                <span class="badge bg-success">Active</span>
            <?php else: ?>
                <span class="badge bg-danger">Inactive</span>
            <?php endif; ?>
        </td>
    </tr>

    <tr>
        <td><strong>Created At</strong></td>
        <td><?php echo e($row->created_at); ?></td>
    </tr>

    <tr>
        <td><strong>Updated At</strong></td>
        <td><?php echo e($row->updated_at); ?></td>
    </tr>

</tbody>
</table>
</div>

<div class="mt-3">
    <a href="<?php echo e(route('officetype')); ?>"
       class="btn btn-secondary">
       Back
    </a>

    <a href="<?php echo e(route('getEditofficetype', $row->id)); ?>"
       class="btn btn-primary">
       Edit
    </a>
</div>

</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/officetype/detail.blade.php ENDPATH**/ ?>