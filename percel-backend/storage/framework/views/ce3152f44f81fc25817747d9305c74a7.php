<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(url()->previous()); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage CMS</a></p>

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
                                        <td>Page</td>
                                        <td><?php echo e($row->page_title); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Featured Image</td>
                                        <td>
                                            <?php if(!empty($row->featured_image) ): ?>
                                            <div class="prev-img-thumb"><img src="<?php echo e(asset('/public/'.$row->featured_image)); ?>"></div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td>Page Content</td>
                                        <td><?php echo $row->page_content; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Meta Title</td>
                                        <td><?php echo e($row->meta_title); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Meta Keywords</td>
                                        <td><?php echo e($row->meta_keywords); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Meta Description</td>
                                        <td><?php echo e($row->meta_keywords); ?></td>
                                    </tr>      
                                    <tr>
                                        <td>Last Updated</td>
                                        <td><?php echo e(\Carbon\Carbon::parse($row->updated_at)->timezone('Asia/Kolkata')->format('d-m-Y h:i A')); ?></td>
                                    </tr>                              
                                    <!-- <tr>
                                        <td>Status</td>
                                        <td><?php if($row->status==1): ?> <span class="badge bg-success">Active</span><?php else: ?><span class="badge bg-danger"><?php endif; ?></td>
                                    </tr>     -->                                
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/admin/resources/views/admin/cms_management/detail.blade.php ENDPATH**/ ?>