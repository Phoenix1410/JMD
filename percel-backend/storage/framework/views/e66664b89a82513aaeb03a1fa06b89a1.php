<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getManageCountry')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Country</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="<?php echo e(route('postUpdateCountry', $row->id)); ?>" method="post" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getManageCountry')); ?>">
            	<div class="row">

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Country Name <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Title" class="form-control" name="country_name" id="country_name" value="<?php echo e((!empty(old('country_name'))?old('country_name'):$row->country_name)); ?>" placeholder="Enter Country Name" required>                          
                            <?php $__errorArgs = ['country_name'];
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
                            <label for="title" class="form-label">Currency <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Currency" class="form-control" name="currency" id="currency" value="<?php echo e((!empty(old('currency'))?old('currency'):$row->currency)); ?>" placeholder="Ex: USD" required>                          
                            <?php $__errorArgs = ['currency'];
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
                            <label for="title" class="form-label">Currency Symbol <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Currency" class="form-control" name="currency_symbol" id="currency_symbol" value="<?php echo e((!empty(old('currency_symbol'))?old('currency_symbol'):$row->currency_symbol)); ?>" placeholder="Ex: $" required>                          
                            <?php $__errorArgs = ['currency_symbol'];
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
					        <label for="Nameinput" class="form-label">Status<span class="text-danger" title="This field is required">*</span></label>
					        <select class="form-control" name="status" required>
					        	<option value="">Select Status</option>
					        	<option value="1" <?php if($row->country_status==1): ?> selected <?php endif; ?> >Active</option>
					        	<option value="0" <?php if($row->country_status==0): ?> selected <?php endif; ?> >Inactive</option>
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
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                            	<a href="<?php echo e(route('getManageCountry')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>                            	
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
<script type="text/javascript">
    $(document).ready(function() {
     


     $("#country_id").change(function(){
    var country_val = $("#country_id").val();
    var url_val = '<?php echo e(url('/')); ?>'+'/admin/states-by-country';
    var myKeyVals = $(this).val();
    var getData = $.ajax({
        type: 'POST',
        url: url_val,
        data: { country_id:country_val,"_token": "<?php echo e(csrf_token()); ?>"},
        dataType: "html",
        success: function(resultData) { $('#state_id').html(resultData); }
  });
    //getData.error(function() { alert("Something went wrong"); });
  });

  $("#state_id").change(function(){
    var state_val = $("#state_id").val();
    var url_val = '<?php echo e(url('/')); ?>'+'/admin/city-by-states';
    var myKeyVals = $(this).val();
    var getData = $.ajax({
        type: 'POST',
        url: url_val,
        data: { state_id:state_val,"_token": "<?php echo e(csrf_token()); ?>"},
        dataType: "html",
        success: function(resultData) { $('#city_id').html(resultData); }
  });
    //getData.error(function() { alert("Something went wrong"); });
  });


    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/country/edit.blade.php ENDPATH**/ ?>