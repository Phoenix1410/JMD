<?php $__env->startSection('content'); ?>

<p>
    <a title="Back" href="<?php echo e(route('office')); ?>">
        <i class="fa fa-chevron-circle-left"></i> Back To Office List
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
</div>

<div class="card-body">

<form action="<?php echo e(route('postUpdateoffice', $row->id)); ?>" method="post">
<?php echo csrf_field(); ?>

<div class="row">

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Office Type <span class="text-danger">*</span>
            </label>

            <select name="office_type_id" class="form-control" required>
                <option value="">-- Select Office Type --</option>

                <?php $__currentLoopData = $office_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->id); ?>"
                        <?php echo e(old('office_type_id', $row->office_type_id) == $type->id ? 'selected' : ''); ?>>
                        <?php echo e($type->type_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <?php $__errorArgs = ['office_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Office Name <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="office_name"
                   value="<?php echo e(old('office_name', $row->office_name)); ?>"
                   required>

            <?php $__errorArgs = ['office_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">
                Address <span class="text-danger">*</span>
            </label>

            <textarea class="form-control"
                      name="address"
                      rows="2"
                      required><?php echo e(old('address', $row->address)); ?></textarea>

            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">State</label>

            <select name="state_id"
                    id="state_id"
                    class="form-control">

                <option value="">-- Select State --</option>

                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($state->id); ?>"
                        <?php echo e(old('state', $row->state) == $state->id ? 'selected' : ''); ?>>
                        <?php echo e($state->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>
        </div>
    </div>

    
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">City</label>

            <select name="city_id"
                    id="city_id"
                    class="form-control">

                <option value="">-- Select City --</option>

                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($city->id); ?>"
                        <?php echo e(old('city', $row->city) == $city->id ? 'selected' : ''); ?>>
                        <?php echo e($city->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>
        </div>
    </div>

    
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Pincode</label>

            <input type="text"
                   class="form-control"
                   name="pincode"
                   value="<?php echo e(old('pincode', $row->pincode)); ?>">
        </div>
    </div>

    
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Phone</label>

            <input type="text"
                   class="form-control"
                   name="phone"
                   value="<?php echo e(old('phone', $row->phone)); ?>">
        </div>
    </div>

    
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   class="form-control"
                   name="email"
                   value="<?php echo e(old('email', $row->email)); ?>">
        </div>
    </div>

    
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label">Sort Order</label>

            <input type="number"
                   class="form-control"
                   name="sort"
                   value="<?php echo e(old('sort', $row->sort)); ?>">
        </div>
    </div>

    
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label">
                Status <span class="text-danger">*</span>
            </label>

            <select name="status" class="form-control" required>
                <option value="1"
                    <?php echo e(old('status', $row->status) == 1 ? 'selected' : ''); ?>>
                    Active
                </option>
                <option value="0"
                    <?php echo e(old('status', $row->status) == 0 ? 'selected' : ''); ?>>
                    Inactive
                </option>
            </select>

            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

</div>

<div class="row mt-3">
    <div class="col-md-12">

        <a href="<?php echo e(route('office')); ?>"
           class="btn btn-secondary">
           Back
        </a>

        <button type="submit"
                class="btn btn-primary">
            Update
        </button>

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
$(document).on('change', '#state_id', function(){

    let state_val = $(this).val();

    if(state_val == ''){
        $('#city_id').html('<option value="">-- Select City --</option>');
        return;
    }

    $.ajax({
        type: "POST",
        url: "<?php echo e(url('/city-by-states')); ?>",
        data: {
            state_id: state_val,
            _token: "<?php echo e(csrf_token()); ?>"
        },
        success: function(response){
            $('#city_id').html(response);
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });

});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/office/edit.blade.php ENDPATH**/ ?>