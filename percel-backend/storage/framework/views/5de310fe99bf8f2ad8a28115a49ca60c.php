<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getFaqIndex')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage FAQ</a></p>

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
                                        <td>FAQ Title</td>
                                        <td><?php echo e($row->faq_title); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><?php echo $row->description; ?></td>
                                    </tr>
                                     <tr>
                                        <td>Status </td>
                                        <td><?php if($row->status==1): ?> <span class="badge bg-success">Active</span> <?php else: ?> <span class="badge bg-warning">Inactive</span><?php endif; ?></td>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/faq/detail.blade.php ENDPATH**/ ?>