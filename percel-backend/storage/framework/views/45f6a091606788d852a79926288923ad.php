
<?php $__env->startSection('content'); ?>

<div class="list-grid-nav hstack gap-1 mb-3">
    <div class="selected-action" style="display:inline-block;position:relative;">
    </div>
</div>



<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
        <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">   

            <form method="get" style="display:inline-block;width: 300px;" action="<?php echo e(route('user_reports_monthly')); ?>" id="filterReport">                
                <div class="input-group">
                    <!--  <input type="date" name="date_from" class="form-control" placeholder="Date From" value="<?php echo e(request()->get('date_from')); ?>">
                     <input type="date" name="date_to" class="form-control" placeholder="Date To" value="<?php echo e(request()->get('date_to')); ?>"> -->
                     <select name="month" class="form-control" id="monthList" onchange="$('#filterReport').submit()">
                        <option value="">Select Month</option>
                        <?php for($m=1; $m<=12; $m++): ?>            
                            <option value="<?php echo e($m); ?>" <?php echo e((($m==request()->get('month'))?"selected":"")); ?>><?php echo e(date("F", mktime(0, 0, 0, $m, 10))); ?></option>
                        <?php endfor; ?>
                    </select>
                     <select name="year" class="form-control" id="yearList" onchange="$('#filterReport').submit()">
                        <option value="">Select Year</option>
                        <?php for($y=$year_from; $y<=$year_to; $y++): ?>                
                            <option value="<?php echo e($y); ?>" <?php echo e((($y==request()->get('year'))?"selected":"")); ?>><?php echo e($y); ?></option>
                        <?php endfor; ?>
                    </select>                  
                    <!-- <input type="text" name="q" value="<?php echo e(request()->get('q')); ?>" class="form-control rounded-0 pull-right" placeholder="Search">                     -->
<!-- 
                    <div class="input-group-btn">
                        <?php if(!empty(request()->get('q')) || !empty(request()->get('date_from')) || !empty(request()->get('date_to')) || !empty(request()->get('payment_status'))): ?>
                        <button type="button" onclick="location.href='<?php echo e(AdminHelper::adminpath()); ?>/orders'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                        <?php endif; ?>
                        <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                    </div> -->
                </div>
            </form>


            <form method="get" id="form-limit-paging" style="display:inline-block"
                action="<?php echo e(route('user_reports_monthly')); ?>">
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
            <form id="form-table" method="post" action="<?php echo e(route('user_reports_monthly')); ?>/action-selected">
                <input type='hidden' name='button_name' value=''/>
                <?php echo csrf_field(); ?>                  
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">                            
                             <th width="auto" class="text-center">Month</th>
                             <th width="auto" class="text-center">Year</th>
                             <th width="auto" class="text-center">Total Users</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($rows) && count($rows)): ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>                            
                            <td class="text-center"><?php echo e(date('F', mktime(0, 0, 0, $data->month, 10))); ?> </td> 
                            <td class="text-center"><?php echo e($data->year); ?> </td> 
                            <td class="text-center"><?php echo e($data->customer); ?></td>  
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center"><i class="fa fa-search"></i> No Data Avaliable</td>
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/reports/user_report.blade.php ENDPATH**/ ?>