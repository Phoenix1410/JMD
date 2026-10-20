<?php $__env->startSection('content'); ?>

<div class="list-grid-nav hstack gap-1 mb-3">
    <div class="selected-action" style="display:inline-block;position:relative;">
        <!-- <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-check-square-o"></i> Bulk Actions</button> -->
        <ul class="dropdown-menu">
            <!-- <li><a class="dropdown-item" href="javascript:void(0)" data-name="delete" title="Delete Selected"><i
                        class="fa fa-trash"></i> Delete Selected</a></li> -->
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="active" title="Active Selected"><i
                        class="fa fa-check"></i> Active Selected</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="inactive" title="Inactive Selected"><i
                        class="fa fa-times"></i> Inactive Selected</a></li>

        </ul>
    </div>
    <!-- <?php if(AdminHelper::isCreate()): ?>
    <a href="<?php echo e(route('getAddStates')); ?>?return_url=<?php echo e(route('getStates')); ?>"
        id="btn_add_new_data" class="btn btn-primary" title="Add Data">
        <i class="fa fa-plus-circle"></i> Add Data
    </a>
    <?php endif; ?> -->
</div>



<div class="card">
    <div class="card-header align-items-center d-flex">
        <div class="p-0 w-100">
            <div class="row align-items-center">
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                    <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="box-tools pull-right w-100">
                        <div class="row justify-content-end">
                            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
                                <form method="get" style="display:inline-block;width: 100%;" action="<?php echo e(route('getStates')); ?>">
                                    <div class="row">

                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="input-group">
                                                <!-- <select name="country" id="country" class="form-control">
                                                    <option value="">Country</option>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($cnt->id); ?>" <?php if(request()->get('country')==$cnt->id): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($cnt->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                </select> -->

                                            </div>
                                        </div>


                                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                            <div class="input-group">
                                                <input type="text" name="q" value="<?php echo e(request()->get('q')); ?>" class="form-control rounded-0 pull-right" placeholder="State Name">
                                                <input type="hidden" name="limit" value="<?php if(request()->get('limit')>0): ?><?php echo e(request()->get('limit')); ?><?php else: ?><?php echo e($limit); ?><?php endif; ?>">
                                                <div class="input-group-btn">
                                                    <?php if(!empty(request()->get('q'))||!empty(request()->get('country'))): ?>
                                                    <button type="button" onclick="location.href='<?php echo e(route('getStates')); ?>'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                                                    <?php endif; ?>
                                                    <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12">
                                <form method="get" id="form-limit-paging" style="display:inline-block"
                                    action="<?php echo e(route('getStates')); ?>">
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
                        </div>
                    </div>
                </div>


                <br style="clear:both">

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- <form id="form-table" method="post" action="<?php echo e(route('getStates')); ?>/action-selected"> -->
                <input type='hidden' name='button_name' value='' />
                <?php echo csrf_field(); ?>
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">
                            <th >#</th>
                            <th ><a href="<?php echo e(AdminHelper::adminpath()); ?>/manage-states?filter_column=name&sorting=<?php echo e((request()->get('filter_column')=='name' && request()->get('sorting')=='asc')?'desc':'asc'); ?>" title="Click to sort ascending">Name &nbsp; <i class="fa fa-sort"></i></a></th>
                          
                            <th >Status</th>
                            <th>Images</th>
                            <th style="text-align:right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($rows) && count($rows)): ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($rows->firstItem() + $key); ?></td>
                            <td><?php echo e($data->name); ?></td>
                            
                           <td>
                                <form action="<?php echo e(route('manage-states.status')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                                <input type="hidden"
                                    name="status"
                                    value="<?php echo e($data->status == '1' ? '0' : '1'); ?>">

                                <button type="submit"
                                        class="btn btn-sm <?php echo e($data->status == '1' ? 'btn-success' : 'btn-danger'); ?>">
                                    <?php echo e($data->status == '1' ? 'Active' : 'Inactive'); ?>

                                </button>
                                </form>
                            </td>
                             <td>
                                <?php if(!empty($data->image)): ?>
                                  <img src="<?php echo e(asset('uploads/states/'.$data->image)); ?>" width="80" />
                                <?php else: ?>
                                    
                                     <img src="https://cdn-icons-png.flaticon.com/512/97/97706.png" width="80" />
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="button_action" style="text-align:right">
                                    <?php if(AdminHelper::isRead()): ?>
                                    <a class="btn btn-sm btn-primary btn-detail" title="Detail Data" href="<?php echo e(route('getStates')); ?>/detail/<?php echo e($data->id); ?>?return_url=<?php echo e(AdminHelper::adminpath()); ?>/states"><i class="fa fa-eye"></i></a>
                                    <?php endif; ?>
                                    <?php if(AdminHelper::isUpdate()): ?>
                                    <a class="btn btn-sm btn-success btn-edit" title="Edit Data" href="<?php echo e(route('getStates')); ?>/edit/<?php echo e($data->id); ?>?return_url=<?php echo e(AdminHelper::adminpath()); ?>/states"><i class="fa fa-pencil"></i></a>
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
                                    t.isConfirmed?location.href='<?php echo e(route('getStates')); ?>/delete/<?php echo e($data->id); ?>':'' });">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center"><i class="fa fa-search"></i> No Data Avaliable</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            <!-- </form> -->
            <!--END FORM TABLE-->
            <!-- <div class="col-md-4"><span class="pull-right">Total rows
                    : 1 to 3 of 3</span></div> -->

        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <span>Total rows : <?php echo e($rows->total()); ?></span>
            </div>
            <div class="col-md-8">
                <div class="pull-right"><?php echo $rows->withQueryString()->links('pagination::bootstrap-4'); ?> </div>
            </div>
        </div>
    </div>


</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#country').select2();


    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/states/index.blade.php ENDPATH**/ ?>