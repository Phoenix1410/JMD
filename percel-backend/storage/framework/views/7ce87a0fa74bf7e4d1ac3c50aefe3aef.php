<?php $__env->startSection('content'); ?>

<div class="card">

<div class="card-header align-items-center d-flex">

    <h4 class="card-title mb-0 flex-grow-1">
        <?php echo e($page_title); ?>

    </h4>

    <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">

        
        <form method="get"
              style="display:inline-block;width: 290px;"
              action="<?php echo e(route('managecontactus')); ?>">

            <div class="input-group">

                <input type="text"
                       name="q"
                       value="<?php echo e(request()->get('q')); ?>"
                       class="form-control rounded-0 pull-right"
                       placeholder="Search name, email or phone">

                <div class="input-group-btn">

                    <?php if(!empty(request()->get('q'))): ?>
                    <button type="button"
                            onclick="location.href='<?php echo e(route('managecontactus')); ?>'"
                            title="Reset"
                            class="btn rounded-0 btn-warning">
                        <i class="fa fa-ban"></i>
                    </button>
                    <?php endif; ?>

                    <button type="submit"
                            class="btn rounded-0 btn-primary me-2">
                        <i class="fa fa-search"></i>
                    </button>

                </div>

            </div>

        </form>

        
        <form method="get"
              id="form-limit-paging"
              style="display:inline-block"
              action="<?php echo e(route('managecontactus')); ?>">

            <?php $limits =[5,10,20,25,50,100,200]; ?>

            <div class="input-group">

                <select onchange="$('#form-limit-paging').submit()"
                        name="limit"
                        style="width:56px;"
                        class="form-control input-sm">

                    <?php $__currentLoopData = $limits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lmt); ?>" <?php echo e(($lmt==$limit)?'selected':''); ?>>
                            <?php echo e($lmt); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

            </div>

        </form>

    </div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table align-middle table-nowrap table-hover mb-0">

<thead class="table-blue">

<tr>
    <th width="5%">#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Submitted at</th>
    <th width="10%">Status</th>
    <th width="10%" style="text-align:right">Action</th>
</tr>

</thead>

<tbody>

<?php if(!empty($rows) && count($rows)): ?>

<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr>

<td>
    <?php echo e($rows->firstItem() + $key); ?>

</td>

<td>
    <?php echo e($row->name); ?>

</td>

<td>
    <?php echo e($row->email); ?>

</td>

<td>
    <?php echo e($row->phone); ?>

</td>
<td>
<?php echo e(\Carbon\Carbon::parse($row->created_at)->timezone('Asia/Kolkata')->format('d-m-Y h:i A')); ?>

</td>


<td>

<form action="<?php echo e(route('postUpdatecontactus',$row->id)); ?>" method="POST">
<?php echo csrf_field(); ?>

<input type="hidden"
       name="status"
       value="<?php echo e($row->status == '1' ? '0' : '1'); ?>">

<button type="submit"
        class="btn btn-sm <?php echo e($row->status == '1' ? 'btn-success' : 'btn-danger'); ?>">
    <?php echo e($row->status == '1' ? 'Active' : 'Inactive'); ?>

</button>

</form>

</td>

<td style="text-align:right">

<a href="<?php echo e(route('managecontactusdetails',$row->id)); ?>"
   class="btn btn-sm btn-primary"
   title="View">
    <i class="fa fa-eye"></i>
</a>

</td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>

<tr>
<td colspan="6" style="text-align:center">
    <i class="fa fa-search"></i> No Data Available
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

<div class="row m-3">

<div class="col-md-9">
    <span>Total rows : <?php echo e($rows->total()); ?></span>
</div>

<div class="col-md-3 text-end">
    <?php echo $rows->withQueryString()->links('pagination::bootstrap-4'); ?>

</div>

</div>

</div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/beta/admin/resources/views/admin/contactus/index.blade.php ENDPATH**/ ?>