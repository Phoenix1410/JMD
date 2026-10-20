<?php $__env->startSection('content'); ?>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit About Us</h4>
    </div>

    <div class="card-body">

        <!-- Validation Errors -->
        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('postUpdateaboutus', $data->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <!-- Main Content -->
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content"  id="description_editor" class="form-control" rows="4"><?php echo e($data->content); ?></textarea>
            </div>

            <hr>

            <!-- Fleet Section -->
            <h5>Fleet Section</h5>

            <div class="mb-3">
                <label class="form-label">Fleet Icon</label>

                <?php if($data->fleet_icon): ?>
                    <div class="mb-2">
                        <img src="<?php echo e(asset($data->fleet_icon)); ?>" width="80">
                    </div>
                <?php endif; ?>

                <input type="file" name="fleet_icon" class="form-control">
                <small class="text-muted">Leave empty to keep old image</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Fleet Name</label>
                <input type="text" name="fleet_name" class="form-control" value="<?php echo e($data->fleet_name); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Fleet Content</label>
                <textarea name="fleet_content" class="form-control"><?php echo e($data->fleet_content); ?></textarea>
            </div>

            <hr>

            <!-- Network Section -->
            <h5>Network Section</h5>

            <div class="mb-3">
                <label class="form-label">Network Icon</label>

                <?php if($data->network_icon): ?>
                    <div class="mb-2">
                        <img src="<?php echo e(asset($data->network_icon)); ?>" width="80">
                    </div>
                <?php endif; ?>

                <input type="file" name="network_icon" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Network Name</label>
                <input type="text" name="network_name" class="form-control" value="<?php echo e($data->network_name); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Network Content</label>
                <textarea name="network_content" class="form-control"><?php echo e($data->network_content); ?></textarea>
            </div>

            <hr>

            <!-- Delivery Section -->
            <h5>Delivery Section</h5>

            <div class="mb-3">
                <label class="form-label">Delivery Icon</label>

                <?php if($data->delivery_icon): ?>
                    <div class="mb-2">
                        <img src="<?php echo e(asset($data->delivery_icon)); ?>" width="80">
                    </div>
                <?php endif; ?>

                <input type="file" name="delivery_icon" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Name</label>
                <input type="text" name="delivery_name" class="form-control" value="<?php echo e($data->delivery_name); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Content</label>
                <textarea name="delivery_content" class="form-control"><?php echo e($data->delivery_content); ?></textarea>
            </div>

            <hr>

            <!-- Stats -->
            <h5>Statistics</h5>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>States Covered</label>
                    <input type="text" name="states_covered" class="form-control" value="<?php echo e($data->states_covered); ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Branches</label>
                    <input type="text" name="branches" class="form-control" value="<?php echo e($data->branches); ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Daily Shipments</label>
                    <input type="text" name="daily_shipments" class="form-control" value="<?php echo e($data->daily_shipments); ?>">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Years Experience</label>
                    <input type="text" name="years_experience" class="form-control" value="<?php echo e($data->years_experience); ?>">
                </div>
            </div>

            <hr>

            <!-- Buttons -->
            <div class="text-end">
                <a href="<?php echo e(route('manageaboutus')); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<script>
    CKEDITOR.replace('description_editor', {
        allowedContent: true,
        versionCheck: false,
        resize_enabled: false // ✅ IMPORTANT
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/admin/resources/views/admin/aboutus/edit.blade.php ENDPATH**/ ?>