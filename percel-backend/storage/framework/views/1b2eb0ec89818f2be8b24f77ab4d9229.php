
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form id="form-table" method="post" action="<?php echo e(route('getManageHowitworks')); ?>/action-selected">
                <input type='hidden' name='button_name' value=''/>
                <?php echo csrf_field(); ?>                
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">                            
                            <th>Title</th>
                            <th>Image</th>                            
                            <th width="auto" style="text-align:right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($row)): ?>                        
                        <tr>
                            <td><?php echo e($row->title); ?></td>                           
                            <td><?php if($row->image!=''): ?><img src="<?php echo e(asset($row->image)); ?>" width="50px" height="50px"> <?php else: ?> N\A  <?php endif; ?></td>
                            <td>
                                <div class="button_action" style="text-align:right">
                                <a class="btn btn-sm btn-info btn-edit" title="Steps" href="<?php echo e(route('getStepHowitwork', $row->id)); ?>">Steps</a>
                                <a class="btn btn-sm btn-success btn-edit" title="Edit Data" href="<?php echo e(route('getEditHowitwork', $row->id)); ?>?return_url=<?php echo e(route('getManageHowitworks')); ?>"><i class="fa fa-pencil"></i></a>
                                </div>
                            </td>
                        </tr>                        
                        <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center"><i class="fa fa-search"></i> No Data Avaliable</td>
                        </tr>
                        <?php endif; ?>                        
                    </tbody>
                </table>

            </form>
            <!--END FORM TABLE-->           
            <!-- <div class="col-md-4"><span class="pull-right">Total rows
                    : 1 to 3 of 3</span></div> -->

        </div>
    </div>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/apperance/how_it_work.blade.php ENDPATH**/ ?>