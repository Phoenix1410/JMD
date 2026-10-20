
<?php $__env->startSection('content'); ?>

<div class="list-grid-nav hstack gap-1 mb-3">
    <?php if(AdminHelper::isCreate()): ?>
    <a href="<?php echo e(route('getAddSupplier')); ?>?return_url=<?php echo e(route('getManageSupplier')); ?>"
        id="btn_add_new_data" class="btn btn-primary" title="Add Data">
        <i class="fa fa-plus-circle"></i> Add Data
    </a>
   <?php endif; ?>
   <a href="<?php echo e(route('exportSupplier')); ?>"
        id="btn_add_new_data" class="btn btn-primary" title="Add Data">
        <i class="fa fa-download"></i> Export
    </a>
</div>



<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
        <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">   

            <form method="get" style="display:inline-block;width: 290px;"
                action="<?php echo e(route('getManageSupplier')); ?>">
                <div class="input-group">
                    <input type="text" name="q" value="<?php echo e(request()->get('q')); ?>" class="form-control rounded-0 pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <?php if(!empty(request()->get('q'))): ?>
                        <button type="button" onclick="location.href='<?php echo e(route('getManageSupplier')); ?>'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                        <?php endif; ?>
                        <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>


            <form method="get" id="form-limit-paging" style="display:inline-block"
                action="<?php echo e(route('getManageSupplier')); ?>">
                <?php $limis =[5,10,20,25,50,100,200]; ?>
                <div class="input-group">
                    <select onchange="$('#form-limit-paging').submit()" name="limit" style="width: 56px;"
                        class="form-control input-sm">
                        <?php $__currentLoopData = $limis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lmt); ?>" <?php echo e(($lmt==$limit)?'selected':''); ?>><?php echo e($lmt); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </form>

        </div>

        <br style="clear:both">

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form id="form-table" method="post" action="<?php echo e(route('getManageSupplier')); ?>/action-selected">
                <input type='hidden' name='button_name' value=''/>
                <?php echo csrf_field(); ?>                
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">
                            <th width="3%"><input type="checkbox" id="checkall"></th>
                            <th width="auto"><a href="<?php echo e(route('getManageSupplier')); ?>?filter_column=name&sorting=<?php echo e((request()->get('filter_column')=='name' && request()->get('sorting')=='asc')?'desc':'asc'); ?>" title="Click to sort">Name &nbsp; <i class="fa fa-sort"></i></a></th>
                            <th width="auto"><a href="<?php echo e(route('getManageSupplier')); ?>?filter_column=email&sorting=<?php echo e((request()->get('filter_column')=='email' && request()->get('sorting')=='asc')?'desc':'asc'); ?>" title="Click to sort">Email &nbsp; <i class="fa fa-sort"></i></a></th>
                            <th width="auto"><a href="<?php echo e(route('getManageSupplier')); ?>?filter_column=phone_number&sorting=<?php echo e((request()->get('filter_column')=='phone_number' && request()->get('sorting')=='asc')?'desc':'asc'); ?>" title="Click to sort">Phone Number &nbsp; <i class="fa fa-sort"></i></a></th>
                            <th width="auto"><a href="<?php echo e(route('getManageSupplier')); ?>?filter_column=created_at&sorting=<?php echo e((request()->get('filter_column')=='created_at' && request()->get('sorting')=='asc')?'desc':'asc'); ?>" title="Click to sort">Created At &nbsp; <i class="fa fa-sort"></i></a></th>
                            <th width="auto" style="text-align:right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($rows) && count($rows)): ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><input type="checkbox" class="checkbox" name="checkbox[]" value="<?php echo e($data->id); ?>"></td>
                            <td><?php echo e($data->name); ?></td>                            
                            <td><?php echo e($data->email); ?></td>
                            <td><?php echo e($data->phone_number); ?></td>
                            <td><?php echo e(date('d-m-Y', strtotime($data->created_at))); ?></td>
                            <td>
                                <div class="button_action" style="text-align:right">
                                 <?php if(AdminHelper::isRead()): ?>
                                <a class="btn btn-sm btn-primary btn-detail" title="Detail Data" href="<?php echo e(route('getDetailSupplier', $data->id)); ?>?return_url=<?php echo e(route('getManageSupplier')); ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; ?>
                                <?php if(AdminHelper::isUpdate()): ?>
                                <a class="btn btn-sm btn-success btn-edit" title="Edit Data" href="<?php echo e(route('getEditSupplier', $data->id)); ?>?return_url=<?php echo e(route('getManageSupplier')); ?>"><i class="fa fa-pencil"></i></a>
                                <?php endif; ?>           

                                <?php if(AdminHelper::isDelete()): ?>
                                <a class="btn btn-sm btn-warning btn-delete" title="Delete" href="javascript:;" onclick="Swal.fire({
                                    title: 'Are you sure ?',   
                                    text: 'You will not be able to recover this record data!',  
                                    icon: 'warning',
                                    showCancelButton: !0,
                                    confirmButtonText: 'Yes, delete it!',
                                    cancelButtonText: 'No, cancel!',
                                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                                    buttonsStyling: !1,
                                    showCloseButton: !0,
                                }).then(function (t) {
                                    t.isConfirmed?location.href='<?php echo e(route('deleteSupplier', $data->id)); ?>':'' });">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <?php endif; ?>
                                

                                </div>
                            </td>
                        </tr>                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align:center"><i class="fa fa-search"></i> No Data Avaliable</td>
                        </tr>
                        <?php endif; ?>                        
                    </tbody>
                </table>

            </form>
            <!--END FORM TABLE-->           
            <!-- <div class="col-md-4"><span class="pull-right">Total rows
                    : 1 to 3 of 3</span></div> -->

        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <span>Total rows : <?php echo e($rows->total()); ?></span>
            </div>          
            <div class="col-md-8"> <div class="pull-right"><?php echo $rows->withQueryString()->links('pagination::bootstrap-4'); ?> </div></div>         
        </div>
    </div>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/supplier/index.blade.php ENDPATH**/ ?>