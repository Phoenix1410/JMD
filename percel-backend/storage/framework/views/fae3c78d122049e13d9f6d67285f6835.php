<?php $__env->startSection('content'); ?>

<div class="list-grid-nav hstack gap-1 mb-3">

    <a href="<?php echo e(route('addofficetype')); ?>" 
        class="btn btn-primary" title="Add Office Type">
        <i class="fa fa-plus-circle"></i> Add Office Type
    </a>

</div>

<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>

        <div class="box-tools pull-right">

            
            <form method="get" style="display:inline-block;width: 250px;"
                action="<?php echo e(route('officetype')); ?>">

                <div class="input-group">
                    <input type="text" name="q" 
                        value="<?php echo e(request()->get('q')); ?>"
                        class="form-control rounded-0"
                        placeholder="Search Office Type">

                    <div class="input-group-btn">
                        <?php if(request()->get('q')): ?>
                        <button type="button"
                            onclick="location.href='<?php echo e(route('officetype')); ?>'"
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
                action="<?php echo e(route('officetype')); ?>">

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
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Office Type</th>
                        <th>Status</th>
                        <th width="170">Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php if($rows->count()): ?>
                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($rows->firstItem() + $key); ?></td>

                        <td><?php echo e($row->type_name); ?></td>

                        
                        <td>
                            <form action="<?php echo e(route('postUpdateofficetype',$row->id)); ?>"
                                  method="POST">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" 
                                       name="type_name" 
                                       value="<?php echo e($row->type_name); ?>">

                                <input type="hidden"
                                       name="status"
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
                                href="<?php echo e(route('getDetailofficetype',$row->id)); ?>">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-success"
                                href="<?php echo e(route('getEditofficetype',$row->id)); ?>">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <a class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure to delete?')"
                                href="<?php echo e(route('deleteManageofficetype',$row->id)); ?>">
                                <i class="fa fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            No Data Available
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <span>Total rows : <?php echo e($rows->total()); ?></span>
            </div>

            <div class="col-md-8 text-end">
                <?php echo $rows->withQueryString()->links('pagination::bootstrap-4'); ?>

            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/officetype/index.blade.php ENDPATH**/ ?>