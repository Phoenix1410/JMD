
<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getManageUser')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Customer</a></p>
<style type="text/css">
    .img-thumb{
        height: 240px;
        width: 240px;
        border: 1px solid grey;
        padding: 10px;
        margin: 10px;
    }
</style>
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
                                        <td>Email</td>
                                       <td><a href="mailto:<?php echo e($row->email); ?>"><?php echo e($row->email); ?></a></td>
                                    </tr>
                                    <tr>
                                        <td>Contact Number</td>
                                       <td><a href="tel:<?php echo e($row->c_code.$row->phone_number); ?>"><?php echo e($row->phone_number); ?></a></td>
                                    </tr>                                 
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo e($row->country->country_name); ?></td>
                                    </tr> 
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo e($row->city->city_name); ?></td>
                                    </tr>    
                                    <tr>
                                        <td>Company</td>
                                        <td><?php echo e($row->company->company_name); ?></td>
                                    </tr>                              
                                    <tr>
                                        <td>Status</td>
                                        <td><?php echo e(($row->status==1)?'Active':'Inactive'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Created At</td>
                                        <td><?php echo e($row->created_at); ?></td>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/user/detail.blade.php ENDPATH**/ ?>