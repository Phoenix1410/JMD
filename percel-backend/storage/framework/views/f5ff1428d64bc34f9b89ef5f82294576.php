<?php $__env->startSection('content'); ?>

<p><a title="Main Module" href="<?php echo e(route('getProducts')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Product</a></p>

<div class="card">    
    <div class="card-body">
        <div class="table-responsive">
            <form id="form-table" method="post" action="<?php echo e(route('updateStock')); ?>">
                <input type='hidden' name='button_name' value=''/>
                <?php echo csrf_field(); ?>                
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">                            
                            <th width="auto">Item Code</th>
                            <th width="auto">Balance Qty</th>
                            <th width="auto">Type</th>
                            <th width="auto">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($rows) && count($rows)): ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>                            
                            <td><?php echo e($data->item_code); ?></td>
                            <td><?php echo e($data->balance_qty); ?></td>
                            <td>
                                <select name="type[<?php echo e($data->id); ?>]" class="form-control" style="width:30%;">
                                    <option value="+">+</option>
                                    <option value="-">-</option>
                                </select>
                            </td>
                            <td><input type="number" name="qty[<?php echo e($data->id); ?>]" class="form-control" value="0" style="width:20%;"></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center"><i class="fa fa-search"></i> No Data Avaliable</td>
                        </tr>
                        <?php endif; ?>                        
                    </tbody>
                </table>
                <br>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
            <!--END FORM TABLE-->           
            <!-- <div class="col-md-4"><span class="pull-right">Total rows
                    : 1 to 3 of 3</span></div> -->

        </div>
    </div>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/product/update_stock.blade.php ENDPATH**/ ?>