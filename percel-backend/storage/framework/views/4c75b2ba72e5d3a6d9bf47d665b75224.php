<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0"><?php echo e($page_title); ?></h4>
    </div>

    <div class="card-body">

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('postUpdatebranches', $row->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>
            <div class="row">
                  
                <div class="col-md-6 mb-3">
                    <label class="form-label">Branch Id <span class="text-danger">*</span></label>
                    <input type="text" name="branch_id"
                           class="form-control"
                           value="<?php echo e(old('branch_code',$row->branch_code)); ?>"
                           required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Branch Name <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="branch_name"
                           class="form-control"
                           value="<?php echo e(old('branch_name', $row->branch_name)); ?>"
                           required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Person <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="contactperson"
                           class="form-control"
                           value="<?php echo e(old('contactperson', $row->contact_person)); ?>"
                           required>
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">State <span class="text-danger">*</span></label>
                    <select name="state_id" class="form-control" required>
                        <option value="">-- Select State --</option>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($state->id); ?>"    
                                <?php echo e(old('state_id', $row->state) == $state->id ? 'selected' : ''); ?>>
                                <?php echo e($state->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tel" 
                           name="phone"
                           class="form-control"
                           maxlength="10"
                           value="<?php echo e(old('phone', $row->phone)); ?>">
                </div>
                 
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone(2)</label>
                    <input type="tel" name="phone2"
                           class="form-control"
                            maxlength=10
                           value="<?php echo e(old('phone2',$row->phone2)); ?>">
                </div>
                 
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone(3)</label>
                    <input type="tel" name="phone3"
                           class="form-control"
                            maxlength=10
                           value="<?php echo e(old('phone3',$row->phone3)); ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" 
                           name="email"
                           class="form-control"
                           value="<?php echo e(old('email', $row->email_address)); ?>">
                </div>
                <!-- branch type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Branch Type</label>
                    <input type="text" name="branch_type"
                           class="form-control"
                           value="<?php echo e(old('branch_type', $row->branch_type)); ?>">
                </div>
                 <div class="col-md-6 mb-3">
                    <label class="form-label">Google Map Link</label>
                    <input type="text" name="google_link"
                           class="form-control"
                           value="<?php echo e(old('google_link',$row->google_link)); ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="1" <?php echo e($row->status == 1 ? 'selected' : ''); ?>>Active</option>
                        <option value="0" <?php echo e($row->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                </div>

                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea name="address"
                              class="form-control"
                              rows="3"
                              required><?php echo e(old('address', $row->address)); ?></textarea>
                </div>

                

                
                <!-- <div class="col-md-6 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" 
                           name="sort"
                           class="form-control"
                           value="<?php echo e(old('sort', $row->sort ?? 0)); ?>">
                </div> -->

                <!-- 
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="1" <?php echo e(old('status', $row->status) == 1 ? 'selected' : ''); ?>>
                            Active
                        </option>
                        <option value="0" <?php echo e(old('status', $row->status) == 0 ? 'selected' : ''); ?>>
                            Inactive
                        </option>
                    </select>
                </div> -->
            </div>

            <div class="mt-3">
                <a href="<?php echo e(route('managebranches')); ?>"
                   class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i>Back
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Update Branch
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/admin/resources/views/admin/branches/edit.blade.php ENDPATH**/ ?>