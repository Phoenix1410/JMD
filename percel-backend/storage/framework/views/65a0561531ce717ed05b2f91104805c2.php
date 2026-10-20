<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>

        <div class="box-tools pull-right">

            
            <form method="get" style="display:inline-block;width: 250px;"
                action="<?php echo e(route('jobPosts')); ?>">

                <div class="input-group">
                    <input type="text" name="q" 
                        value="<?php echo e(request()->get('q')); ?>"
                        class="form-control rounded-0"
                        placeholder="Search Applicant / Email">

                    <div class="input-group-btn">
                        <?php if(request()->get('q')): ?>
                        <button type="button"
                            onclick="location.href='<?php echo e(route('jobPosts')); ?>'"
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
                action="<?php echo e(route('jobPosts')); ?>">

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

                        <th>
                            <a href="<?php echo e(route('jobPosts')); ?>?filter_column=applicant_name&sorting=<?php echo e(request()->get('sorting')=='asc'?'desc':'asc'); ?>">
                                Applicant Name <i class="fa fa-sort"></i>
                            </a>
                        </th>

                        <th>Email</th>
                        <th>Phone</th>
                        <th>Description</th>
                        <th>CV</th>

                        <th>
                            <a href="<?php echo e(route('jobPosts')); ?>?filter_column=created_at&sorting=<?php echo e(request()->get('sorting')=='asc'?'desc':'asc'); ?>">
                                Applied At <i class="fa fa-sort"></i>
                            </a>
                        </th>
                        <th width="120">Action</th>

                    </tr>
                </thead>

                <tbody>

                <?php if($rows->count()): ?>

                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                        <td><?php echo e($rows->firstItem() + $key); ?></td>

                        <td><?php echo e($row->applicant_name); ?></td>

                        <td><?php echo e($row->email); ?></td>

                        <td><?php echo e($row->phone_number); ?></td>

                       <td><?php echo e($row->description ? Str::limit($row->description,50) : '--'); ?></td>

                        
                        <td>

                            <?php if($row->cv): ?>

                                <a href="<?php echo e(asset($row->cv)); ?>" 
                                   class="btn btn-sm btn-primary"
                                   download>

                                   <i class="fa fa-download"></i> Download

                                </a>

                            <?php else: ?>

                                -

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php echo e(\Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i A')); ?>


                        </td>
                        <td>
                            <a href="<?php echo e(route('getDetailjobPosts',$row->id)); ?>"
                            class="btn btn-sm btn-info">
                            <i class="fa fa-eye"></i> View
                            </a>
                        </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>

                    <tr>
                        <td colspan="7" class="text-center">
                            No Applications Found
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/admin/resources/views/admin/jobposts/index.blade.php ENDPATH**/ ?>