<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Menus</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<?php if(!empty($rows)): ?>
            	<ul class='draggable-menu draggable-menu-active'>
            	  <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            	 
				  <li data-id='<?php echo e($menu->id); ?>' data-name='<?php echo e($menu->name); ?>'>
					  <div <?php if($menu->is_active==0): ?> class="alert-danger" <?php endif; ?>>
                            <i class='<?php echo e($menu->icon); ?>'></i> <?php echo e($menu->name); ?> 
                            <span class='pull-right'>
                            	<a class='fa fa-pencil' title='Edit' href='<?php echo e(AdminHelper::adminpath("menu-management/edit/".$menu->id)); ?>'></a>
                            	<a title='Delete' class='fa fa-trash' onclick='return confirm("Are you sure to delete?")' href='<?php echo e(AdminHelper::adminpath("menu-management/delete/".$menu->id)); ?>'></a>
                            </span>                            
                        </div>                        
                        	<?php if(!empty($menu->children)): ?>
                        	<ul>
	                        	<?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        	<li data-id='<?php echo e($child->id); ?>' data-name='<?php echo e($child->name); ?>'>
                                    <div <?php if($child->is_active==0): ?> class="alert-danger" <?php endif; ?>><i class='<?php echo e($child->icon); ?>'></i> <?php echo e($child->name); ?>

                                        <span class='pull-right'>
                                        	<a class='fa fa-pencil' title='Edit' href='<?php echo e(AdminHelper::adminpath("menu-management/edit/".$child->id)); ?>'></a>
                                        	<a title="Delete" class='fa fa-trash' onclick='return confirm("Are you sure to delete?")' href='<?php echo e(AdminHelper::adminpath("menu-management/delete/".$child->id)); ?>'></a>
                                        </span>                                        
                                    </div>
                                </li>
	                        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        	</ul>
                        	<?php endif; ?>                        
				  </li>					  
				  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				  
				</ul>
				<?php endif; ?>
            </div>
		</div>
	</div>
	<div class="col-sm-6">
        <?php if(!empty($menu_item)): ?>
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit Menu</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
             <form action="<?php echo e(route('postUpdateMenu', $menu_item->id)); ?>" method="post"> 
                <?php echo csrf_field(); ?>
                <input type="hidden" name="return_url" value="<?php echo e(AdminHelper::adminpath()); ?>/menu-management">
                <div class="row">
                    <!-- <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="privileges" class="form-label">Privileges <span class="text-danger" title="This field is required">*</span></label>
                            <select name="privileges[]" class="form-control" id="privileges" multiple required>
                                <?php if(!empty($admin_privileges)): ?>
                                    <?php $__currentLoopData = $admin_privileges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privilege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($privilege->id); ?>"><?php echo e($privilege->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['privileges'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div> -->
                    <!-- <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="privileges_config" class="form-label">Privileges Configuration <span class="text-danger" title="This field is required">*</span></label>
                            <select name="privileges_config[]" class="form-control" id="privileges_config" multiple required>
                                <option value="is_visible">View</option>
                                <option value="is_create">Create</option>
                                <option value="is_read">Read</option>
                                <option value="is_edit">Update</option>
                                <option value="is_delete">Delete</option>
                            </select>
                            <?php $__errorArgs = ['privileges_config'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="privileges_config" class="form-label">Parent Menu</label>
                            <select name="parent_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php if(!empty($parent_menus)): ?>
                                <?php $__currentLoopData = $parent_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pmenu->id); ?>" <?php echo e(($menu_item->parent_id==$pmenu->id)?'selected':''); ?>><?php echo e($pmenu->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="menu_name" class="form-label">Menu Name <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Menu Name" class="form-control" name="menu_name" id="menu_name" value="<?php echo e((old('menu_name'))?old('menu_name'):$menu_item->name); ?>"required>                     
                            <?php $__errorArgs = ['menu_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>                      
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="type" class="form-label">Type <span class="text-danger" title="This field is required">*</span></label>
                            <select name="type" class="form-control" id="type" required>
                                <option value="URL" <?php echo e(($menu_item->type=='URL')?'selected':''); ?>>URL</option>
                                <option value="Route" <?php echo e(($menu_item->type=='Route')?'selected':''); ?>>Route</option>
                            </select>
                            <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="menu_path" class="form-label">Menu Path <span class="text-danger" title="This field is required">*</span></label>
                           <input type="text" title="Menu Path" class="form-control" name="menu_path" id="menu_path" value="<?php echo e((old('menu_path'))?old('menu_path'):$menu_item->path); ?>" required>
                            <?php $__errorArgs = ['menu_path'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="icon" class="form-label">Icon </label>
                            <input type="text" title="Icon" class="form-control" name="icon" id="icon" value="<?php echo e((old('icon'))?old('icon'):$menu_item->icon); ?>">
                            <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="sorting" class="form-label">Sorting <span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" title="Sorting" class="form-control" name="sorting" id="sorting" value="<?php echo e($menu_item->sorting); ?>" required>
                            <?php $__errorArgs = ['sorting'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="sql_query" class="form-label">Count (SQL QUERY)</label>
                            <input type="text" title="Database Table Name" class="form-control" name="sql_query" id="sql_query" placeholder="Ex: SELECT count(id) as total FROM table_name" value="<?php echo e($menu_item->sql_query); ?>">
                            <?php $__errorArgs = ['sql_query'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="status" class="form-label">Status <span class="text-danger" title="This field is required">*</span></label>
                            <select name="status" class="form-control">
                                <option value="1" <?php echo e(($menu_item->is_active==1)?'selected':''); ?>>Active</option>
                                <option value="0" <?php echo e(($menu_item->is_active==0)?'selected':''); ?>>Inctive</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="form-group">                            
                        <div class="col-sm-10">                             
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <?php else: ?>
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Add Menu</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
             <form action="<?php echo e(route('postAddMenu')); ?>" method="post"> 
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(AdminHelper::adminpath()); ?>/menu-management">
            	<div class="row">
                    <!-- <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="privileges" class="form-label">Privileges <span class="text-danger" title="This field is required">*</span></label>
                            <select name="privileges[]" class="form-control" id="privileges" multiple required>
                            	<?php if(!empty($admin_privileges)): ?>
                            		<?php $__currentLoopData = $admin_privileges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privilege): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            			<option value="<?php echo e($privilege->id); ?>"><?php echo e($privilege->name); ?></option>
                            		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            	<?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['privileges'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div> -->
                    <!-- <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="privileges_config" class="form-label">Privileges Configuration <span class="text-danger" title="This field is required">*</span></label>
                            <select name="privileges_config[]" class="form-control" id="privileges_config" multiple required>
                            	<option value="is_visible">View</option>
                            	<option value="is_create">Create</option>
                            	<option value="is_read">Read</option>
                            	<option value="is_edit">Update</option>
                            	<option value="is_delete">Delete</option>
                            </select>
                            <?php $__errorArgs = ['privileges_config'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="privileges_config" class="form-label">Parent Menu</label>
                            <select name="parent_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php if(!empty($parent_menus)): ?>
                                <?php $__currentLoopData = $parent_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($pmenu->id); ?>"><?php echo e($pmenu->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="menu_name" class="form-label">Menu Name <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Menu Name" class="form-control" name="menu_name" id="menu_name" value="<?php echo e(old('menu_name')); ?>"required>                     
                            <?php $__errorArgs = ['menu_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>                      
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="type" class="form-label">Type <span class="text-danger" title="This field is required">*</span></label>
                            <select name="type" class="form-control" id="type" required>
                            	<option value="URL">URL</option>
                            	<option value="Route">Route</option>
                            </select>
                            <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="menu_path" class="form-label">Menu Path <span class="text-danger" title="This field is required">*</span></label>
                           <input type="text" title="Menu Path" class="form-control" name="menu_path" id="menu_path" value="<?php echo e(old('menu_path')); ?>" required>
                            <?php $__errorArgs = ['menu_path'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="icon" class="form-label">Icon </label>
                            <input type="text" title="Icon" class="form-control" name="icon" id="icon" value="<?php echo e(old('icon')); ?>">
                            <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="sorting" class="form-label">Sorting <span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" title="Sorting" class="form-control" name="sorting" id="sorting" value="<?php echo e($last_sort+1); ?>" required>
                            <?php $__errorArgs = ['sorting'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="sql_query" class="form-label">Count (SQL QUERY)</label>
                            <input type="text" title="Database Table Name" class="form-control" name="sql_query" id="sql_query" placeholder="Ex: SELECT count(id) as total FROM table_name" value="<?php echo e(old('sql_query')); ?>">
                            <?php $__errorArgs = ['sql_query'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="status" class="form-label">Status <span class="text-danger" title="This field is required">*</span></label>
                            <select name="status" class="form-control">
                            	<option value="1">Active</option>
                            	<option value="0">Inctive</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="text-muted"></p>
                        </div>
                    </div>
            	</div>
            	<div class="row g-3">
                    <div class="form-group">                            
                        <div class="col-sm-10">                            	
                        	<input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            	</form>
            </div>
		</div>
        <?php endif; ?>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('bottom'); ?>
<script type="text/javascript">
   $(document).ready( function(){
   		$("#privileges").select2();
   		$("#privileges_config").select2();
   })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/menus_management.blade.php ENDPATH**/ ?>