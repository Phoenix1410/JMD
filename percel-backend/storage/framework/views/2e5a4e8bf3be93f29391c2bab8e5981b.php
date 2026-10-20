<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getManageCompany')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Company</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="<?php echo e(route('postUpdateCompany', $row->id)); ?>" method="post" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getManageCompany')); ?>">
            	<div class="row">

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Company Name <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Title" class="form-control" name="company_name" id="company_name" value="<?php echo e((!empty(old('company_name'))?old('company_name'):$row->company_name)); ?>" required>                          
                            <?php $__errorArgs = ['company_name'];
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
                            <label for="title" class="form-label">Company Email <span class="text-danger" title="This field is required">*</span></label>
                            <input type="email" title="Title" class="form-control" name="company_email" id="company_email" value="<?php echo e((!empty(old('company_email'))?old('company_email'):$row->company_email)); ?>" required>                          
                            <?php $__errorArgs = ['company_email'];
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
                            <label for="title" class="form-label">Contact Number <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Title" class="form-control" name="contact_no" id="contact_no" value="<?php echo e((!empty(old('contact_no'))?old('contact_no'):$row->contact_no)); ?>" required>                          
                            <?php $__errorArgs = ['contact_no'];
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
                            <label for="title" class="form-label">Company Address <span class="text-danger" title="This field is required">*</span></label>
                            <textarea name="company_address" class="form-control" rows="3" required><?php echo e((!empty(old('company_address'))?old('company_address'):$row->company_address)); ?></textarea>                          
                            <?php $__errorArgs = ['company_address'];
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
                            <label for="title" class="form-label">Country <span class="text-danger" title="This field is required">*</span></label>
                            <select name="country_id" class="form-control" required>
                                <option value="">Select Country</option>
                                <?php if(!empty($countries)): ?>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>" <?php echo e(($row->country_id==$country->id)?'selected':''); ?>><?php echo e($country->country_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>                          
                            <?php $__errorArgs = ['country_id'];
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
                            <label for="title" class="form-label">City <span class="text-danger" title="This field is required">*</span></label>
                            <input type="hidden" name="selected_city" value="<?php echo e($row->city_id); ?>">
                            <select name="city_id" class="form-control" required>
                                <option value="">Select City</option>                                
                            </select>                          
                            <?php $__errorArgs = ['city_id'];
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
                            <label for="title" class="form-label">Zipcode <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Zipcode" class="form-control" name="zipcode" id="zipcode" value="<?php echo e((!empty(old('zipcode'))?old('zipcode'):$row->zipcode)); ?>" required>                          
                            <?php $__errorArgs = ['zipcode'];
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
					        	<option value="1" <?php if($row->company_status==1): ?> selected <?php endif; ?> >Active</option>
					        	<option value="0" <?php if($row->company_status==0): ?> selected <?php endif; ?> >Inactive</option>
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
                            	<a href="<?php echo e(route('getManageCompany')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>                            	
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
    var city = $("input[name='selected_city']").val();
    $(document).ready( function(){        
        var country_id = $("select[name='country_id'] :selected").val();
        getCities(country_id);

        $("select[name='country_id']").on('change', function(){
            var country_id = $(this).val();
            getCities(country_id);
        })
    })

    function getCities(country_id)
    {
        if(country_id>0)
        {
            var options='<option value="">Loading...</option>';
            $("select[name='city_id']").html(options);
            $.get("<?php echo e(url('ajax/get-cities/')); ?>/"+country_id, function(resp){
                options='<option value="">Select City</option>';
                if(resp.length>0)
                {                    
                    $.each(resp, function(index, item) {                            
                        options+=`<option value="${item.id}">${item.city_name}</option>`;
                    });                    
                }

                $("select[name='city_id']").html(options);
                if(city>0)
                {
                    $("select[name='city_id']").val(city).change();
                }
            })
        }else{
            $("select[name='city_id']").html('<option value="">Select City</option>');
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/company/edit.blade.php ENDPATH**/ ?>