<?php $__env->startSection('content'); ?>
<section>
<div class="row project-wrapper">
  <div class="col-xxl-12">
    <div class="row">
        <div class="col-12" >
            <div id="chart">
            </div>
        </div>

        <div class="col-12">
          <div class="admin-pnl-sec">
            <div class="row">
              <?php if(!empty(AdminHelper::sidebarMenu())): ?>
              <?php $__currentLoopData = AdminHelper::sidebarMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(empty($menu->children)): ?>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 dashcolumn">
                <a href="<?php echo e(($menu->is_broken)?"javascript:alert('Route Not Found')":((empty($menu->url) || $menu->url=='#')?'#sidebarAdmin'.str_replace(' ','', $menu->name):$menu->url)); ?>" class="dashboardbox dashbord-bg green">
                  <div class="dashboardicon">
                    <i class="<?php echo e(($menu->icon)?:'fa fa-th-list'); ?>"></i>
                  </div>
                  <div class="dashboardcontent">
                    <h4><?php echo e($menu->name); ?><span></span></h4>
                    <?php if(!empty($menu->sql_query)): ?>                    
                    <?php $db = DB::select($menu->sql_query); ?>    
                    <div class="num"><?php echo e($db[0]->total); ?></div>
                    <?php endif; ?>
                  </div>
                </a>
              </div>
              <?php else: ?>
              <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 dashcolumn">
              <a href="<?php echo e($child->url); ?>" class="dashboardbox dashbord-bg green">
                <div class="dashboardicon">
                  <i class="<?php echo e(($child->icon)?:'fa fa-th-list'); ?>"></i>
                </div>
                <div class="dashboardcontent">
                  <h4><?php echo e($child->name); ?><span></span></h4>
                  <?php if(!empty($child->sql_query)): ?>
                  <?php $db = DB::select($child->sql_query); ?>                  
                  <div class="num"><?php echo e($db[0]->total); ?></div>
                  <?php endif; ?>
                </div>
              </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>             
            </div>
          </div>
        </div>

    </div>
  </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/laravel_11_setup/resources/views/admin/home.blade.php ENDPATH**/ ?>