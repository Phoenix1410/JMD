<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getPrivilege')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="<?php echo e(route('postUpdatePrivilege', $row->id)); ?>" method="post" enctype="multipart/form-data"> 
        	<?php echo csrf_field(); ?>
        	<input type="hidden" name="return_url" value="<?php echo e(route('getPrivilege')); ?>">
        	<div class="mb-3 ">
                <label for="name" class="form-label">Privilege Name <span class="text-danger" title="This field is required">*</span></label>
                <input type="text" title="name" class="form-control" name="name" id="name" value="<?php echo e((old('name'))?old('name'):$row->name); ?>" placeholder="Enter Name" required>                          
                <?php $__errorArgs = ['name'];
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
            <div id="privileges_configuration" class="mb-3">
                <label class="form-label">Privileges Configuration</label>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr class="active">                            
                            <th width="60%">Module's Name</th>
                            <th>All</th>
                            <th>View</th>
                            <th>Create</th>
                            <th>Read</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        <tr class="active">                            
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <td align="center"><input title="Check all vertical" type="checkbox" id="is_visible"></td>
                            <td align="center"><input title="Check all vertical" type="checkbox" id="is_create"></td>
                            <td align="center"><input title="Check all vertical" type="checkbox" id="is_read"></td>
                            <td align="center"><input title="Check all vertical" type="checkbox" id="is_edit"></td>
                            <td align="center"><input title="Check all vertical" type="checkbox" id="is_delete"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($menus) && count($menus)): ?>
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $roles = \App\Models\AdminPrivilegeRole::where('id_admin_menus', $menu->id)->where('id_admin_privileges', $row->id)->first();
                        ?>
                        <tr>                            
                            <td><?php echo e($menu->name); ?></td>
                            <td class="active" align="center">
                                <input type="checkbox" title="Check All Horizontal" <?=(@$roles->is_visible && @$roles->is_create && @$roles->is_read && @$roles->is_edit && @$roles->is_delete) ? "checked" : ""?> class="select_horizontal">
                            </td>
                            <td align="center">
                                <input type="checkbox" class="is_visible" name="privileges[<?php echo e($menu->id); ?>][is_visible]"  <?=@$roles->is_visible ? "checked" : ""?> value="1">
                            </td>
                            <td class="warning" align="center">
                                <input type="checkbox" class="is_create" name="privileges[<?php echo e($menu->id); ?>][is_create]" <?=@$roles->is_create ? "checked" : ""?> value="1">
                            </td>
                            <td class="info" align="center">
                                <input type="checkbox" class="is_read" name="privileges[<?php echo e($menu->id); ?>][is_read]" <?=@$roles->is_read ? "checked" : ""?> value="1">
                            </td>
                            <td class="success" align="center">
                                <input type="checkbox" class="is_edit" name="privileges[<?php echo e($menu->id); ?>][is_edit]" <?=@$roles->is_edit ? "checked" : ""?> value="1">
                            </td>
                            <td class="danger" align="center">
                                <input type="checkbox" class="is_delete" name="privileges[<?php echo e($menu->id); ?>][is_delete]" <?=@$roles->is_delete ? "checked" : ""?> value="1">
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No records found!</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        	<div class="row g-3">
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                        	<a href="<?php echo e(route('getPrivilege')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        	<input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
        	</form>
            </div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script>
    $(function () {
        $("#is_visible").click(function () {
            var is_ch = $(this).prop('checked');
            console.log('is checked create ' + is_ch);
            $(".is_visible").prop("checked", is_ch);
            console.log('Create all');
        })
        $("#is_create").click(function () {
            var is_ch = $(this).prop('checked');
            console.log('is checked create ' + is_ch);
            $(".is_create").prop("checked", is_ch);
            console.log('Create all');
        })
        $("#is_read").click(function () {
            var is_ch = $(this).is(':checked');
            $(".is_read").prop("checked", is_ch);
        })
        $("#is_edit").click(function () {
            var is_ch = $(this).is(':checked');
            $(".is_edit").prop("checked", is_ch);
        })
        $("#is_delete").click(function () {
            var is_ch = $(this).is(':checked');
            $(".is_delete").prop("checked", is_ch);
        })
        $(".select_horizontal").click(function () {
            var p = $(this).parents('tr');
            var is_ch = $(this).is(':checked');
            p.find("input[type=checkbox]").prop("checked", is_ch);
        })
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/admin_privileges/edit.blade.php ENDPATH**/ ?>