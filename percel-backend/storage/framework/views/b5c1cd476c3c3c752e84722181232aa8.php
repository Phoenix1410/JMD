<?php $__env->startSection('content'); ?>

<div class="list-grid-nav hstack gap-1 mb-3">
    <div class="selected-action" style="display:inline-block;position:relative;">
     <!--    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-check-square-o"></i> Bulk Actions</button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="delete" title="Delete Selected"><i
                        class="fa fa-trash"></i> Delete Selected</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="active" title="Active Selected"><i
                        class="fa fa-check"></i> Active Selected</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="inactive" title="Inactive Selected"><i
                        class="fa fa-times"></i> Inactive Selected</a></li>

        </ul> -->
    </div>

   <!--    <a href="<?php echo e(route('addEmailTemplate')); ?>?return_url=<?php echo e(route('getIndexEmailTemplate')); ?>"
        id="btn_add_new_data" class="btn btn-primary" title="Add Data">
        <i class="fa fa-plus-circle"></i> Add Data
    </a> -->

</div>
<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
        <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">   

            <form method="get" style="display:inline-block;width: 290px;"
                action="<?php echo e(route('getIndexEmailTemplate')); ?>">
                <div class="input-group">
                    <input type="text" name="q" value="<?php echo e(request()->get('q')); ?>" class="form-control rounded-0 pull-right" placeholder="Search">

                    <div class="input-group-btn">
                    	<?php if(!empty(request()->get('q'))): ?>
                        <button type="button" onclick="location.href='<?php echo e(route('getIndexEmailTemplate')); ?>'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                        <?php endif; ?>
                        <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>


            <form method="get" id="form-limit-paging" style="display:inline-block"
                action="<?php echo e(route('getIndexEmailTemplate')); ?>">
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
            <form id="form-table" method="post" action="<?php echo e(route('getIndexEmailTemplate')); ?>/action-selected">
                <input type='hidden' name='button_name' value=''/>
                <?php echo csrf_field(); ?>                
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">
                            <th width="3%">#</th>
                            <th width="auto"><a href="<?php echo e(route('getIndexEmailTemplate')); ?>?filter_column=name&sorting=<?php echo e((request()->get('filter_column')=='name' && request()->get('sorting')=='asc')?'desc':'asc'); ?>" title="Click to sort ascending">Name &nbsp; <i class="fa fa-sort"></i></a></th>
                            <th width="auto"><a href="<?php echo e(route('getIndexEmailTemplate')); ?>?filter_column=subject&sorting=<?php echo e((request()->get('filter_column')=='subject' && request()->get('sorting')=='asc')?'desc':'asc'); ?>" title="Click to sort ascending">Subject &nbsp; <i class="fa fa-sort"></i></a></th>
                            <th width="auto" style="text-align:right">Template</th>
                            <th width="auto" style="text-align:right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php if(!empty($rows) && count($rows)): ?>
                    	<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($rows->firstItem() + $key); ?></td>
                            <!-- <td><input type="checkbox" class="checkbox" name="checkbox[]" value="<?php echo e($data->id); ?>"></td> -->
                            <td><?php echo e($data->name); ?></td>
                            <td><?php echo e($data->subject); ?></td>
                             <td><?php echo e($data->slug); ?></td>
                          
                            <td>
                                <div class="button_action" style="text-align:right"><a class="btn btn-sm btn-primary btn-detail" title="Detail Data" href="<?php echo e(route('getIndexEmailTemplate')); ?>/detail/<?php echo e($data->id); ?>?return_url=<?php echo e(route('getIndexEmailTemplate')); ?>"><i class="fa fa-eye"></i></a>

                                <a class="btn btn-sm btn-success btn-edit" title="Edit Data" href="<?php echo e(route('getIndexEmailTemplate')); ?>/edit/<?php echo e($data->id); ?>?return_url=<?php echo e(route('getIndexEmailTemplate')); ?>"><i class="fa fa-pencil"></i></a>

                                <!-- <a class="btn btn-sm btn-warning btn-delete" title="Delete" href="javascript:;" onclick="Swal.fire({
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
				                    t.isConfirmed?location.href='<?php echo e(AdminHelper::adminpath()); ?>/manage-cms/delete/<?php echo e($data->id); ?>':'' });">
				                    <i class="fa fa-trash"></i>
				                </a> -->

                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                        	<td colspan="5" style="text-align:center"><i class="fa fa-search"></i> No Data Avaliable</td>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/email_tempate_manage/index.blade.php ENDPATH**/ ?>