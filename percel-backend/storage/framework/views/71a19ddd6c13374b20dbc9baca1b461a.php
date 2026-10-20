<?php $__env->startSection('content'); ?>

<p>
    <a title="Back" href="<?php echo e(route('joblist')); ?>">
        <i class="fa fa-chevron-circle-left"></i>
        &nbsp; Back To Job Listings
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
        <td width="200"><strong>Job Title</strong></td>
        <td><?php echo e($row->title); ?></td>
    </tr>

    <tr>
        <td><strong>Designation</strong></td>
        <td><?php echo e($row->designation); ?></td>
    </tr>

    <tr>
        <td><strong>Experience</strong></td>
        <td>
            <?php echo e($row->min_experience); ?> - <?php echo e($row->max_experience); ?> Years
        </td>
    </tr>

    <tr>
        <td><strong>Location</strong></td>
        <td><?php echo e($row->location); ?></td>
    </tr>

    <tr>
        <td><strong>Description</strong></td>
        <td><?php echo $row->description; ?></td>
    </tr>

    <tr>
        <td><strong>Created At</strong></td>
        <td><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i A')); ?></td>
    </tr>

   

</tbody>

</table>
</div>

</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/joblisting/detail.blade.php ENDPATH**/ ?>