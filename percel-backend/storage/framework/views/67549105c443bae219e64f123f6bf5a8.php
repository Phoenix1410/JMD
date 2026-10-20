<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(AdminHelper::adminPath()); ?>/dashboard" class="logo logo-dark">
            <?php if(!empty(AdminHelper::getSetting('logo'))): ?>
            <span class="logo-sm">
                <img src="<?php echo e(asset(AdminHelper::getSetting('logo'))); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset(AdminHelper::getSetting('logo'))); ?>" alt="" height="50">
            </span>
            <?php else: ?>
            <span class="logo-sm"><?php echo e(AdminHelper::getSetting('appname')); ?></span>
            <span class="logo-lg">
                <?php echo e(AdminHelper::getSetting('appname')); ?>

            </span>
            <?php endif; ?>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(AdminHelper::adminPath()); ?>/dashboard" class="logo logo-light">
            <?php if(!empty(AdminHelper::getSetting('logo'))): ?>
            <span class="logo-sm">
                <img src="<?php echo e(asset(AdminHelper::getSetting('logo'))); ?>" alt="" > 
                <!-- <img src="https://png.pngtree.com/element_pic/16/11/03/dda587d35b48fd01947cf38931323161.jpg" alt="company logo" height="22"> -->
            </span>
            <span class="logo-lg">
                <!-- <img src="https://png.pngtree.com/element_pic/16/11/03/dda587d35b48fd01947cf38931323161.jpg" alt="company logo" height="50"> -->
                <img src="<?php echo e(asset(AdminHelper::getSetting('logo'))); ?>" alt="" >
            </span>
            <?php else: ?>
            <span class="logo-sm"><?php echo e(AdminHelper::getSetting('appname')); ?></span>
            <span class="logo-lg">
                <?php echo e(AdminHelper::getSetting('appname')); ?>

            </span>
            <?php endif; ?>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e((Request::is('/')) ? 'active' : ''); ?>" href="<?php echo e(AdminHelper::adminPath()); ?>/dashboard">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>


   

                <?php if(!empty(AdminHelper::sidebarMenu())): ?>
                    <?php $__currentLoopData = AdminHelper::sidebarMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e((Request::is($menu->url_path.'*'))?'active':''); ?>" data-path="<?php echo e($menu->url_path); ?>" href='<?php echo e(($menu->is_broken)?"javascript:alert('Route Not Found')":((empty($menu->url) || $menu->url=='#')?'#sidebarAdmin'.str_replace(' ','', $menu->name):$menu->url)); ?>' <?php if(!empty($menu->children)): ?> data-bs-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::is($menu->path.'*'))? 'true' : 'false'); ?>" aria-controls="sidebarAdmin<?php echo e(str_replace(' ','', $menu->name)); ?>" <?php endif; ?>>
                            <i class='<?php echo e($menu->icon); ?>'></i> <span><?php echo e($menu->name); ?></span>
                        </a>
                        <?php if(!empty($menu->children)): ?>
                        <div class="collapse <?php echo e((Request::is($menu->url_path.'*'))? 'show' : ''); ?> menu-dropdown" id="sidebarAdmin<?php echo e(str_replace(' ','', $menu->name)); ?>">
                            <ul class="nav nav-sm flex-column">
                            <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                              
                                <li class="nav-item <?php echo e((Request::is($child->url_path.'*'))?'active-child':''); ?>">
                                    <a href='<?php echo e($child->url); ?>' class="nav-link <?php echo e((Request::is($child->url_path.'*'))?'active':''); ?>">
                                        <?php if(!empty($child->icon)): ?><i class='<?php echo e($child->icon); ?>'></i> <?php endif; ?> <?php echo e($child->name); ?></a>
                                </li>        
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                  
                            </ul>
                        </div>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              
               
               <?php if(AdminHelper::isSuperadmin() && AdminHelper::myId()==1): ?>
                <li class="menu-title"><span data-key="t-menu">SUPERADMIN</span></li>               

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e((Request::path()=='admin/menu-management') ? 'active' : ''); ?>" href="<?php echo e(route('getMenus')); ?>">
                        <i class="fa fa-bars"></i> <span>Menu Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e((Request::path()=='admin/privileges') ? 'active' : ''); ?>" href="<?php echo e(route('getPrivilege')); ?>">
                        <i class="fa fa-key"></i> <span>Privileges</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e((Request::path()=='admin/admin-users') ? 'active' : ''); ?>" href="<?php echo e(route('getAdminUsers')); ?>">
                        <i class="fa fa-users"></i> <span>Admin Users</span>
                    </a>
                </li>
                <?php endif; ?>
              
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/beta/admin/app/Providers/../../resources/views/admin/partial/sidebar.blade.php ENDPATH**/ ?>