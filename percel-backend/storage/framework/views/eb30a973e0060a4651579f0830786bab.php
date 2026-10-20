<?php $__env->startSection('content'); ?>

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

<form action="<?php echo e(route('postUpdateclients',$row->id)); ?>"  method="post" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="id" value="<?php echo e($row->id); ?>">

<div class="row">


<div class="col-md-6">
<div class="mb-3">
<label class="form-label">
Client Title <span class="text-danger">*</span>
</label>

<input type="text"
class="form-control"
name="title"
value="<?php echo e(old('title',$row->title)); ?>"
required>

</div>
</div>



<div class="col-md-6">
<div class="mb-3">
<label class="form-label">
Client Image
</label>

<input type="file"
class="form-control"
name="image"
accept="image/*">

<br>

<?php if($row->image): ?>
<img src="<?php echo e(asset($row->image)); ?>" width="120">
<?php endif; ?>

</div>
</div>



<div class="col-md-6">
<div class="mb-3">

<label class="form-label">
Status
</label>

<select class="form-control" name="status">

<option value="1" <?php echo e($row->status==1 ? 'selected':''); ?>>
Active
</option>

<option value="0" <?php echo e($row->status==0 ? 'selected':''); ?>>
Inactive
</option>

</select>

</div>
</div>

</div>

<div class="row">
<div class="col-md-12">

<a href="<?php echo e(route('manageclient')); ?>" class="btn btn-secondary">
Back
</a>

<button type="submit" class="btn btn-primary">
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/clients/edit.blade.php ENDPATH**/ ?>