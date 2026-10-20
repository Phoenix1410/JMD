<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getManageCombos')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Combo Items</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="<?php echo e(route('postUpdateCombos', $row->id)); ?>" method="post" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getManageCombos')); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title_fr" class="form-label">Title(French) <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Combo Title" class="form-control" name="title_fr" id="title_fr" value="<?php echo e((!empty(old('title_fr'))?old('title_fr'):$row->title_fr)); ?>" placeholder="Enter Combo Name" required>                          
                            <?php $__errorArgs = ['title_fr'];
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
                        <div class="mb-3 ">
                            <label for="title_ar" class="form-label">Title(Arabic) <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Combo Title" class="form-control" name="title_ar" id="title_ar" value="<?php echo e((!empty(old('title_ar'))?old('title_ar'):$row->title_ar)); ?>" placeholder="Enter Combo Name" required>                          
                            <?php $__errorArgs = ['title_ar'];
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
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Image</label>
                            <input type="file" title="image" class="form-control" name="image" id="image" accept="image/*">                            
                            <?php if($row->image): ?>
                            <img src="<?php echo e(asset($row->image)); ?>" width="200px" height="100px">
                            <?php endif; ?>                          
                            <?php $__errorArgs = ['image'];
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
                             <p class="text-muted">The image size memory upto limit 500KB.Dimension:258x258 px</p> 
                        </div>                      
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="Nameinput" class="form-label">Status<span class="text-danger" title="This field is required">*</span></label>
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1" <?php if($row->status=='1'): ?> selected <?php endif; ?> >Active</option>
                                <option value="0" <?php if($row->status=='0'): ?> selected <?php endif; ?> >Inactive</option>
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
                <div id="item_sel_list">
                    <div class="row item_box" id="item_1">
                        <div class="col-md-5">
                            <div class="mb-3 ">
                                <label for="Nameinput" class="form-label">Category</label>
                                <select class="form-control sel_category" name="category[]">
                                    <option value="">Select Category</option>
                                    <?php if($categories->count() > 0): ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->category_name_fr); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>                       
                                <?php $__errorArgs = ['category'];
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
                        <div class="col-md-5">
                            <div class="mb-3 ">
                                <label for="Nameinput" class="form-label">Item</label>
                                <select class="form-control sel_item" name="item[]">
                                    <option value="">Select Item</option>                                    
                                </select>
                                <?php $__errorArgs = ['item'];
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
                        <div class="col-md-2 text-center">
                            <label for="Nameinput" class="form-label">Add</label><br>
                            <button type="button" class="btn btn-primary btn-sm addMore">+</button>
                        </div>
                    </div>
                    <?php $__currentLoopData = $row->combo_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$combo_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                    
                    <div class="row item_box" id="item_<?php echo e($key+2); ?>">
                        <div class="col-md-5">
                            <div class="mb-3 ">
                                <input type="hidden" name="combo_item_id[]" value="<?php echo e($combo_item->id); ?>">
                                <label for="Nameinput" class="form-label">Category<span class="text-danger" title="This field is required">*</span></label>
                                <select class="form-control sel_category" name="sel_category[]" required>
                                    <option value="">Select Category</option>
                                    <?php if($categories->count() > 0): ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e(($combo_item->category_id==$value->id)?'selected':''); ?>><?php echo e($value->category_name_fr); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>                       
                                <?php $__errorArgs = ['category'];
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
                        <div class="col-md-5">
                            <div class="mb-3 ">
                                <label for="Nameinput" class="form-label">Item<span class="text-danger" title="This field is required">*</span></label>
                                <input type="hidden" class="sel_item_id" value="<?php echo e($combo_item->food_item_id); ?>">
                                <select class="form-control sel_item" name="sel_item[]" required>
                                    <option value="">Select Item</option>                                    
                                </select>
                                <?php $__errorArgs = ['item'];
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
                        <div class="col-md-2 text-center">
                            <label for="Nameinput" class="form-label">Remove</label><br>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeBox('<?php echo e($key+2); ?>')">-</button>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="row g-3">
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                            <a href="<?php echo e(route('getManageCombos')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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
    
      // CKEDITOR.replace( 'description_fr',{
      //   allowedContent : true,
      //   versionCheck: false
      // });
      // CKEDITOR.replace( 'description_ar',{
      //   allowedContent : true,
      //   versionCheck: false
      // });

      var item=0;
      $(".addMore").click( function(){
        var item = $(".item_box").length;
        var addBox = `<div class="row item_box" id="item_${parseInt(item)+1}">
                        <div class="col-md-5">
                            <div class="mb-3 ">
                                <label for="Nameinput" class="form-label">Category<span class="text-danger" title="This field is required">*</span></label>
                                <select class="form-control sel_category" name="category[]" required>
                                    <option value="">Select Category</option>
                                    <?php if($categories->count() > 0): ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->category_name_fr); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>                       
                                <?php $__errorArgs = ['category'];
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
                        <div class="col-md-5">
                            <div class="mb-3 ">
                                <label for="Nameinput" class="form-label">Item<span class="text-danger" title="This field is required">*</span></label>
                                <select class="form-control sel_item" name="item[]" required>
                                    <option value="">Select Item</option>                                    
                                </select>                       
                                <?php $__errorArgs = ['item'];
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
                        <div class="col-md-2 text-center">
                            <label for="Nameinput" class="form-label">Remove</label><br>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeBox('${parseInt(item)+1}')">-</button>
                        </div>
                    </div>`;

        $("#item_sel_list").append(addBox);
      });

    });

    $(document).on('change', '.sel_category', function(){
        var cat_id = $(this).val();        
        var row_id = $(this).parent().closest('.row').attr('id');
        var options='<option value="">Loading...</option>';
        $("#"+row_id).find('select.sel_item').html(options);
        $.get("<?php echo e(url('ajax/get-food-items/')); ?>/"+cat_id, function(resp){
            options='<option value="">Select Food Item</option>';
            if(resp.length>0)
            {                    
                $.each(resp, function(index, item) {                            
                    options+=`<option value="${item.id}">${item.item_name_fr}</option>`;
                });                    
            }

            $("#"+row_id).find('select.sel_item').html(options);
        })
    })

    function removeBox(item)
    {
        $("#item_"+item).remove();
    }

    $(".sel_category option:selected").each( function(){
        var cat_id = $(this).val();
        var row_id = $(this).parent().closest('.row').attr('id');
        if(cat_id!='')
        {
            getItems(row_id, cat_id);
        }        
    })

    function getItems(row_id, cat_id)
    {                
        var sel_item_id = $("#"+row_id).find('input.sel_item_id').val();
        var options='<option value="">Loading...</option>';
        $("#"+row_id).find('select.sel_item').html(options);
        $.get("<?php echo e(url('ajax/get-food-items/')); ?>/"+cat_id, function(resp){
            options='<option value="">Select Food Item</option>';
            if(resp.length>0)
            {                    
                $.each(resp, function(index, item) {                            
                    options+=`<option value="${item.id}">${item.item_name_fr}</option>`;
                });                    
            }

            $("#"+row_id).find('select.sel_item').html(options);
            $("#"+row_id).find('select.sel_item').val(sel_item_id).change();
        })
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/combos/edit.blade.php ENDPATH**/ ?>