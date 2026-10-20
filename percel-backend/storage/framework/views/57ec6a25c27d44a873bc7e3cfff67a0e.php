<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Add About Us</h4>
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

        <form action="<?php echo e(route('postaboutus')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <!-- Main Content -->
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="4"></textarea>
            </div>

            <hr>

            <!-- Fleet Section -->
            <h5>Fleet Section</h5>

            <div class="mb-3">
                <label class="form-label">Fleet Icon</label>
                <input type="file" name="fleet_icon" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Fleet Name</label>
                <input type="text" name="fleet_name" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Fleet Content</label>
                <textarea name="fleet_content" class="form-control"></textarea>
            </div>

            <hr>

            <!-- Network Section -->
            <h5>Network Section</h5>

            <div class="mb-3">
                <label class="form-label">Network Icon</label>
                <input type="file" name="network_icon" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Network Name</label>
                <input type="text" name="network_name" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Network Content</label>
                <textarea name="network_content" class="form-control"></textarea>
            </div>

            <hr>

            <!-- Delivery Section -->
            <h5>Delivery Section</h5>

            <div class="mb-3">
                <label class="form-label">Delivery Icon</label>
                <input type="file" name="delivery_icon" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Name</label>
                <input type="text" name="delivery_name" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Content</label>
                <textarea name="delivery_content" class="form-control"></textarea>
            </div>

            <hr>

            <!-- Stats -->
            <h5>Statistics</h5>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>States Covered</label>
                    <input type="text" name="states_covered" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Branches</label>
                    <input type="text" name="branches" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Daily Shipments</label>
                    <input type="text" name="daily_shipments" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Years Experience</label>
                    <input type="text" name="years_experience" class="form-control">
                </div>
            </div>

            <hr>

            <div class="text-end">
                <a href="<?php echo e(route('manageaboutus')); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/aboutus/add.blade.php ENDPATH**/ ?>