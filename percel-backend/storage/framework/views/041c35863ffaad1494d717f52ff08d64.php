<?php $__env->startSection('content'); ?>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<!-- <script type="text/javascript" src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script> -->
<p><a title="Main Module" href="<?php echo e(route('getStates')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage States</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="<?php echo e(route('postUpdateStates', $row->id)); ?>" method="post" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getStates')); ?>">
            	<div class="row">

               
                    



                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Name <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="name" class="form-control" name="name" id="name" value="<?php echo e((!empty(old('name'))?old('name'):$row->name)); ?>" placeholder="Enter Name" required>                          
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
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">State Image</label>
                            <input type="file" name="image" class="form-control">

                            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1">
                                    <strong><?php echo e($message); ?></strong>
                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <?php if(!empty($row->image)): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e(asset('uploads/states/'.$row->image)); ?>"
                                        width="120"
                                        class="img-thumbnail">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

            		<div class="col-md-6">
            			<div class="mb-3 ">
					        <label for="Nameinput" class="form-label">Select Status<span class="text-danger" title="This field is required">*</span></label>
					        <select class="form-control" name="status" required>
					        	<option value="">Select Status</option>
					        	<option value="1" <?php if($row->status==1): ?> selected <?php endif; ?> >Active</option>
					        	<option value="0" <?php if($row->status==0): ?> selected <?php endif; ?> >Inactive</option>
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
                            	<a href="<?php echo e(route('getStates')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>                            	
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
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/beta/admin/resources/views/admin/states/edit.blade.php ENDPATH**/ ?>