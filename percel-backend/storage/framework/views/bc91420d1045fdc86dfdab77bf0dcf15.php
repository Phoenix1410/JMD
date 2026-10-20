<?php $__env->startSection('content'); ?>

<div class="list-grid-nav hstack gap-1 mb-3">
    <div class="selected-action" style="display:inline-block;position:relative;">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-check-square-o"></i> Bulk Actions</button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="active" title="Active Selected"><i
                        class="fa fa-check"></i> Active Selected</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="inactive" title="Inactive Selected"><i
                        class="fa fa-times"></i> Inactive Selected</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" data-name="stock_update" title="Update Stock"><i
                        class="fa fa-refresh"></i> Update Stock</a></li>
          <!-- <li><a class="dropdown-item" href="javascript:void(0)" data-name="add-featured" title="Add Featured Selected"><i
                        class="fa fa-check"></i> Add Featured Selected</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="remove-featured" title="Remove Featured Selected"><i
                        class="fa fa-times"></i> Remove Featured Selected</a></li>  -->
            <!-- <li><a class="dropdown-item text-danger" href="javascript:void(0)" data-name="delete" title="Delete Selected"><i
                        class="fa fa-trash"></i> Delete Selected</a></li> -->
        </ul>
    </div>
    <?php if(AdminHelper::isCreate()): ?>
    <a href="<?php echo e(route('getAddProduct')); ?>?return_url=<?php echo e(route('getProducts')); ?>"
        id="btn_add_new_data" class="btn btn-primary" title="Add Data">
        <i class="fa fa-plus-circle"></i> Add Data
    </a>
    <?php endif; ?>
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fa fa-file-excel-o"></i> Import Data</a>
    <!-- The Modal -->
    <div class="modal" id="importModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Import Data</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <?php if(Session::has('error')): ?>
                <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
                <i class="fa fa-exclamation-triangle label-icon"></i>
                <?php echo e(Session::get('error')); ?>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <a href="<?php echo e(asset('download/Product_item_sample.xls')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download Sample</a>
            <form action="<?php echo e(route('importProductItems')); ?>" method="post" enctype="multipart/form-data" id="importForm">
                <?php echo csrf_field(); ?>
                <div class="form-group mt-3">
                    <label>Upload Excel</label>
                    <input type="file" name="import_data" class="form-control" required>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary" id="uploadBtn">Upload</button>
                </div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
</div>



<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
        <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">   

            <form method="get" style="display:inline-block;width: 390px;"
                action="<?php echo e(route('getProducts')); ?>">
                <div class="input-group">
                    <?php if(AdminHelper::isSuperadmin()): ?>
                    <select name="supplier" class="form-control">
                        <option value="">Select Supplier</option>
                        <?php if(!empty($suppliers)): ?>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($supplier->id); ?>" <?php echo e((!empty(request()->get('supplier')) && request()->get('supplier')==$supplier->id)?'selected':''); ?>><?php echo e($supplier->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <?php endif; ?>
                    <input type="text" name="q" value="<?php echo e(request()->get('q')); ?>" class="form-control rounded-0 pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <?php if(!empty(request()->get('q'))): ?>
                        <button type="button" onclick="location.href='<?php echo e(route('getProducts')); ?>'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                        <?php endif; ?>
                        <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>


            <form method="get" id="form-limit-paging" style="display:inline-block"
                action="<?php echo e(route('getProducts')); ?>">
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
            <form id="form-table" method="post" action="<?php echo e(route('getProducts')); ?>/action-selected">
                <input type='hidden' name='button_name' value=''/>
                <?php echo csrf_field(); ?>                
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">
                            <th width="3%"><input type="checkbox" id="checkall"></th>
                            <th width="auto"><a href="<?php echo e(route('getProducts')); ?>?filter_column=item_code&sorting=<?php echo e((request()->get('filter_column')=='item_code' && request()->get('sorting')=='asc')?'desc':'asc'); ?>" title="Click to sort ascending">Item Code &nbsp; <i class="fa fa-sort"></i></a></th>
                            <th width="auto">Category</th>
                            <th width="auto">Supplier</th>
                            <th width="auto">Price</th>                     
                            <th width="auto" style="text-align:right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($rows) && count($rows)): ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><input type="checkbox" class="checkbox" name="checkbox[]" value="<?php echo e($data->id); ?>"></td>
                            <td><?php echo e($data->item_code); ?></td>
                            <td><?php echo e($data->category_name); ?></td>
                            <td><?php echo e($data->supplier_name); ?></td>
                            <td><?php echo e($data->rate); ?></td>
                            <td>
                                <div class="button_action" style="text-align:right">
                                <?php if(AdminHelper::isRead()): ?>
                                <a class="btn btn-sm btn-primary btn-detail" title="Detail Data" href="<?php echo e(route('getDetailProduct', $data->id)); ?>?return_url=<?php echo e(route('getProducts')); ?>"><i class="fa fa-eye"></i></a>
                                <?php endif; ?>
                                <?php if(AdminHelper::isUpdate()): ?>
                                <a class="btn btn-sm btn-success btn-edit" title="Edit Data" href="<?php echo e(route('getEditProduct', $data->id)); ?>?return_url=<?php echo e(route('getProducts')); ?>"><i class="fa fa-pencil"></i></a>
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
                                    t.isConfirmed?location.href='<?php echo e(route('deleteProduct', $data->id)); ?>':'' });">
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
<?php $__env->startPush('bottom'); ?>
<script type="text/javascript">
$(document).ready(function() {
    if (window.location.href.indexOf("#importModal") > -1) {
        var myModal = new bootstrap.Modal(document.getElementById("importModal"), {});
        document.onreadystatechange = function () {
          myModal.show();
        };
    }

    $("#importForm").submit( function(){
        $("#uploadBtn").attr('disabled', true);
        $("#uploadBtn").html('Uploading <i class="fa fa-spinner fa-spin"></i>');
    })
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/product/index.blade.php ENDPATH**/ ?>