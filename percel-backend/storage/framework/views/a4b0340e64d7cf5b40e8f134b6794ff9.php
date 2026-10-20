<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getStates')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage States</a></p>

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
                                        <td>Country Name</td>
                                        <td><?php echo e($country->name); ?></td>
                                    </tr>

                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo e($row->name); ?></td>
                                    </tr>
                                    <tr>
                                    <td>Image</td>
                                    <td>
                                        <?php if(!empty($row->image)): ?>
                                        <a data-fancybox="gallery" href="<?php echo e(asset('uploads/states/'.$row->image)); ?>">
                                            <img src="<?php echo e(asset('uploads/states/'.$row->image)); ?>" 
                                                alt="State Image" 
                                                width="120" 
                                                class="img-thumbnail">
                                        </a>
                                        <?php else: ?>
                                            <span class="text-muted">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><?php if($row->status==1): ?> <span class="badge bg-success">Active</span><?php else: ?><span class="badge bg-danger">Inactive</span><?php endif; ?></td>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/states/detail.blade.php ENDPATH**/ ?>