<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(url()->previous()); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Email Templates</a></p>

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
                                        <td>Name</td>
                                        <td><?php echo e($row->name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>template Slug</td>
                                        <td>
                                            <?php echo e($row->slug); ?>

                                        </td>
                                    </tr>
                                     <tr>
                                        <td>Subject</td>
                                        <td><?php echo e($row->subject); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Content</td>
                                        <td><?php echo $row->content; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><?php echo e($row->description); ?></td>
                                    </tr>
                                    <tr>
                                        <td>From Email</td>
                                        <td><?php echo e($row->from_email); ?></td>
                                    </tr>
                                     <tr>
                                        <td>From Name</td>
                                        <td><?php echo e($row->from_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>CC Email</td>
                                        <td><?php echo e($row->cc_email); ?></td>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/email_tempate_manage/detail.blade.php ENDPATH**/ ?>