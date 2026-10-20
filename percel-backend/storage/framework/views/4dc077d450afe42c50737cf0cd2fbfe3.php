<?php $__env->startSection('content'); ?>

<p>
    <a title="Back" href="<?php echo e(route('managecontactus')); ?>">
        <i class="fa fa-chevron-circle-left"></i> Back To Contact List
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header d-flex align-items-center">
    <h4 class="card-title mb-0 flex-grow-1">
        <?php echo e($page_title); ?>

    </h4>
</div>

<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered table-striped">
    <tbody>

        <tr>
            <th width="20%">Name</th>
            <td><?php echo e($row->name); ?></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><?php echo e($row->email); ?></td>
        </tr>

        <tr>
            <th>Phone</th>
            <td><?php echo e($row->phone); ?></td>
        </tr>

        <tr>
            <th>Message</th>
            <td style="white-space: pre-line;">
                <?php echo e($row->message); ?>

            </td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                <?php if($row->status == '1'): ?>
                    <span class="badge bg-success">Active</span>
                <?php else: ?>
                    <span class="badge bg-danger">Inactive</span>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <th>Submitted At</th>
            <td><?php echo e(\Carbon\Carbon::parse($row->created_at)->timezone('Asia/Kolkata')->format('d-m-Y h:i A')); ?></td>
        </tr>

    </tbody>
</table>
</div>

<div class="mt-3">
    <a href="<?php echo e(route('managecontactus')); ?>"
       class="btn btn-secondary">
        Back
    </a>
</div>

</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/admin/resources/views/admin/contactus/detail.blade.php ENDPATH**/ ?>