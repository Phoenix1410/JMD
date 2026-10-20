<?php $__env->startSection('content'); ?>

<div class="list-grid-nav hstack gap-1 mb-3">

    <a href="<?php echo e(route('addbranches')); ?>" 
        class="btn btn-primary" title="Add Branch">
        <i class="fa fa-plus-circle"></i> Add Branch
    </a>

</div>
<div class="card mb-3">
    <div class="card-header">
        <b>Upload Branch CSV</b>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('uploadBranchCsv')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-4">
                    <label>Select State</label>
                    <select name="state_id" class="form-control" required>
                        <option value="">--Select State--</option>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Upload CSV</label>
                    <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                </div>
                <div class="col-md-4 mt-4">
                    <button class="btn btn-success">
                        Upload CSV
                    </button>
                    <a href="<?php echo e(route('downloadBranchSample')); ?>"
                       class="btn btn-info">
                        Download Sample
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
        <div class="box-tools pull-right">
            
            <form method="get" style="display:inline-block;width: 515px;"
                action="<?php echo e(route('managebranches')); ?>">
                <input type="hidden" name="limit" value="<?php echo e(request()->get('limit')); ?>">
                <div class="input-group">
                   <div class="select-box mx-2">
                    <select name="state_id" class="form-control custom-select" >
                        <option value="">--Select State--</option>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($state->id); ?>"
                            <?php echo e($selectedstate && $state->id == $selectedstate->id ? 'selected' : ''); ?>>
                            <?php echo e($state->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                    <input type="text" name="q" 
                        value="<?php echo e(request()->get('q')); ?>"
                        class="form-control rounded-0"
                        placeholder="Search Branch">
                    <div class="input-group-btn">
                        <?php if(request()->get('q') ||request()->get('state_id')): ?>
                        <button type="button"
                            onclick="location.href='<?php echo e(route('managebranches')); ?>'"
                            class="btn btn-warning rounded-0">
                            <i class="fa fa-ban"></i>
                        </button>
                        <?php endif; ?>

                        <button type="submit"
                            class="btn btn-primary rounded-0">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            
            <form method="get" id="form-limit-paging"
                style="display:inline-block"
                action="<?php echo e(route('managebranches')); ?>">
               
                <input type="hidden" name="state_id" value="<?php echo e(request()->get('state_id')); ?>">
                 <input type="hidden" name="q" value="<?php echo e(request()->get('q')); ?>">
                <?php $limits =[5,10,20,25,50,100]; ?>
                <select onchange="$('#form-limit-paging').submit()"
                        name="limit"
                        class="form-control input-sm"
                        style="width:80px; display:inline-block;">

                    <?php $__currentLoopData = $limits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lmt); ?>"
                            <?php echo e(($lmt==$limit)?'selected':''); ?>>
                            <?php echo e($lmt); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

            </form>

        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table align-middle table-bordered table-hover">
              <thead class="table-blue">
                 <tr>
                    <th>#</th>
                    <th >
                    <a href="<?php echo e(request()->fullUrlWithQuery([
                    'filter_column'=>'b.branch_code',
                    'sorting'=> (request('filter_column')=='b.branch_code' && request('sorting')=='asc')?'desc':'asc'
                    ])); ?>">
                    Branch Code
                    <i class="fa <?php echo e((request('filter_column')=='b.branch_code' && request('sorting')=='asc') ? 'fa-sort-up' : 'fa-sort-down'); ?>"></i>
                    </a>
                    </th>

                    <th>
                    Branch Name
                    </th>

                    <th>
                    State
                    </th>

                    <th>
                    Phone
                    </th>

                    <th>Address</th>

                    <th>
                    Email
                    </th>
                    <th>Status</th>
                    <th width="170">Action</th>
                 </tr>
                </thead>

                <tbody>
                <?php if($rows->count()): ?>
                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($rows->firstItem() + $key); ?></td>
                        <td ><?php echo e($row->branch_code); ?></td>
                        <td><?php echo e($row->branch_name); ?></td>
                        <td><?php echo e($row->state_name ?? '-'); ?></td>
                        <td><?php echo e($row->phone); ?></td>
                        <td><?php echo e($row->address); ?></td>
                        <td><?php echo e($row->email_address); ?></td>
                        
                        <td>
                            <form action="<?php echo e(route('manage-branches.status')); ?>"
                                  method="POST">
                                <?php echo csrf_field(); ?>

                                
                                <input type="hidden" name="id" value="<?php echo e($row->id); ?>">
                                <input type="hidden" name="status"
                                       value="<?php echo e($row->status == 1 ? 0 : 1); ?>">

                                <button type="submit"
                                    class="btn btn-sm 
                                    <?php echo e($row->status == 1 ? 'btn-success' : 'btn-danger'); ?>">
                                    <?php echo e($row->status == 1 ? 'Active' : 'Inactive'); ?>

                                </button>
                            </form>
                        </td>

                        <td>

                            <a class="btn btn-sm btn-primary"
                                href="<?php echo e(route('getDetailbranches',$row->id)); ?>">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-success"
                                href="<?php echo e(route('getEditbranches',$row->id)); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <a class="btn btn-sm btn-danger"
                                onclick="event.preventDefault(); 
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: 'You will not be able to recover this record!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, delete it!',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location.href = this.href;
                                    }
                                });"
                                href="<?php echo e(route('deleteManagebranches',$row->id)); ?>">
                                <i class="fa fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">
                            No Data Available
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>

        <div class="row mt-3">
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/branches/index.blade.php ENDPATH**/ ?>