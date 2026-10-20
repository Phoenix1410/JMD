<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(url()->previous()); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Product</a></p>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div>

            <div class="card-body">                
                    <div class="row g-3">
                        <div class="table-responsive">
                            <table id="table-detail" class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Category</td>
                                        <td><?php echo e($row->category_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supplier</td>
                                        <td><?php echo e($row->supplier_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Item Code</td>
                                        <td><?php echo e($row->item_code); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><?php echo e($row->description); ?></td>
                                    </tr>
                                    <tr>
                                        <td>OUM</td>
                                        <td><?php echo e($row->oum); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Opening Quantity</td>
                                        <td><?php echo e($row->opening_qty); ?></td>
                                    </tr>                                    
                                    <tr>
                                        <td>Received Quantity</td>
                                        <td><?php echo e($row->received_qty); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Issued Quantity</td>
                                        <td><?php echo e($row->issued_qty); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Balance Quantity</td>
                                        <td><?php echo e($row->balance_qty); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><?php echo e($row->rate); ?></td>
                                    </tr>
                                    <tr>
                                        <td>GST</td>
                                        <td><?php echo e($row->gst); ?>%</td>
                                    </tr>
                                    <tr>
                                        <td>Taxable Amount</td>
                                        <td><?php echo e($row->taxable_amount); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td><?php echo e($row->total_amount); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Created At</td>
                                        <td><?php echo e(date('d-m-Y', strtotime($row->created_at))); ?></td>
                                    </tr>
                                    
                                                                       
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->                  

                </form>

            </div>
        </div>
    </div>
    <!--END AUTO MARGIN-->

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/product/detail.blade.php ENDPATH**/ ?>