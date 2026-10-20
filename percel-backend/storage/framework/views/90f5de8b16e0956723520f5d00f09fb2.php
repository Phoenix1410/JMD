<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('manage-banner.index')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Banner</a></p>
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
                                    <td>Title</td>
                                    <td><?php echo e($row->title); ?></td>
                                </tr>
                                <tr>
                                    <td>Sub Title</td>
                                    <td><?php echo e($row->sub_title); ?></td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>
                                    <td><?php echo e($row->short_description??'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td>
                                        <?php if($row->image): ?>
                                        <a data-fancybox="gallery" href="<?php echo e(asset($row->image)); ?>">
                                        <img src="<?php echo e(asset($row->image)); ?>" style="max-width: 50px; max-height: 100px;">
                                        </a>
                                        <?php else: ?>
                                        --
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>Button Link</td>
                                    <td><?php echo e($row->url??'--'); ?></td>
                                </tr> -->
                                 <tr>
                                    <td>Status </td>
                                    <td><?php if($row->status==1): ?> <span class="badge bg-success">Active</span> <?php else: ?> <span class="badge bg-warning">Inactive</span>  <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td><?php echo e(date('d-m-Y', strtotime($row->created_at))); ?></td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td><?php echo e($row->updated_at?date('d-m-Y', strtotime($row->updated_at)):'N/A'); ?></td>
                                </tr>
                                                                   
                            </tbody>
                            </table>
                        </div>
                    </div>               

                </form>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/manage_banner/show.blade.php ENDPATH**/ ?>