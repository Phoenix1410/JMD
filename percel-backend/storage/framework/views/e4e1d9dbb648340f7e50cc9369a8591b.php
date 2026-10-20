<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getManageCombos')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Combo Items</a></p>

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
                                        <td>Title(French)</td>
                                        <td><?php echo e($row->title_fr); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Title(Arabic)</td>
                                        <td><?php echo e($row->title_ar); ?></td>
                                    </tr>                                    
                                    <tr>
                                        <td>Image</td>
                                        <td>
                                            <?php if(!empty($row->image) ): ?>
                                            <div class="prev-img-thumb"><img src="<?php echo e(asset('/public/'.$row->image)); ?>"></div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>Status </td>
                                        <td><?php if($row->status==1): ?> <span class="badge bg-success">Active</span> <?php else: ?> <span class="badge bg-warning">Inactive</span>  <?php endif; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Created At</td>
                                        <td><?php echo e(date('d-m-Y', strtotime($row->created_at))); ?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Items</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table class="table">
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Item</th>
                                                    <th>Image</th>
                                                    <th>Price</th>
                                                </tr>
                                                <?php $__currentLoopData = $row->combo_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($combo_item->category->category_name_fr); ?></td>
                                                    <td><?php echo e($combo_item->item->item_name_fr); ?></td>
                                                    <td>
                                                        <?php if(!empty($combo_item->item->image)): ?>
                                                        <div class="prev-img-thumb"><img src="<?php echo e(asset($combo_item->item->image)); ?>"></div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>CHF <?php echo e($combo_item->item->price_chf); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/combos/detail.blade.php ENDPATH**/ ?>