<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(url()->previous()); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Product</a></p>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="<?php echo e(route('postUpdateProduct', $row->id)); ?>" method="post" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
            	<input type="hidden" name="return_url" value="<?php echo e(route('getProducts')); ?>">
            	<div class="row">

                <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="Nameinput" class="form-label">Category<span class="text-danger" title="This field is required">*</span></label>
                            <select class="form-control" name="category" required>
                                <option value="">Select Category</option>
                                <?php if($categories->count() > 0): ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php if($value->id==$row->category_id): ?> selected <?php endif; ?>><?php echo e($value->category_name); ?></option>
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

                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="Nameinput" class="form-label">Supplier<span class="text-danger" title="This field is required">*</span></label>
                            <select class="form-control" name="supplier" required>
                                <option value="">Select Supplier</option>
                                <?php if(!empty($suppliers)): ?>
                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->id); ?>" <?php if($supplier->id==$row->supplier_id): ?> selected <?php endif; ?>><?php echo e($supplier->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>                       
                            <?php $__errorArgs = ['supplier'];
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
                            <label for="Food Item Name" class="form-label">Item Code <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="Item Code" class="form-control" name="item_code" id="item_code" value="<?php echo e((!empty(old('item_code'))?old('item_code'):$row->item_code)); ?>" placeholder="Enter Food Name" required>                          
                            <?php $__errorArgs = ['item_code'];
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
                            <label for="title" class="form-label">Description </label>
                            <textarea title="Description" class="form-control" name="description" id="description_fr"  placeholder="Enter Description" ><?php echo e((!empty(old('description'))?old('description'):$row->description)); ?></textarea>                        
                            <?php $__errorArgs = ['description'];
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
                            <label class="form-label">OUM <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="OUM" class="form-control" name="oum" id="oum" value="<?php echo e((!empty(old('oum'))?old('oum'):$row->oum)); ?>" placeholder="Enter Food Name" required>                          
                            <?php $__errorArgs = ['oum'];
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
                            <label for="title" class="form-label">Opening Quantity<span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" title="Price" class="form-control" name="opening_qty" id="opening_qty" value="<?php echo e((!empty(old('opening_qty'))?old('opening_qty'):$row->opening_qty)); ?>" readonly required>                            
                            <?php $__errorArgs = ['opening_qty'];
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
                        </div>                      
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Received Quantity<span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" class="form-control" name="received_qty" id="received_qty" value="<?php echo e((!empty(old('received_qty'))?old('received_qty'):$row->received_qty)); ?>" readonly required>                            
                            <?php $__errorArgs = ['received_qty'];
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
                        </div>                      
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Issued Quantity<span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" class="form-control" name="issued_qty" id="issued_qty" value="<?php echo e((!empty(old('issued_qty'))?old('issued_qty'):$row->issued_qty)); ?>" readonly required>                            
                            <?php $__errorArgs = ['issued_qty'];
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
                        </div>                      
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Balance Quantity<span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" class="form-control" name="balance_qty" id="balance_qty" value="<?php echo e((!empty(old('balance_qty'))?old('balance_qty'):$row->balance_qty)); ?>" readonly required>                            
                            <?php $__errorArgs = ['balance_qty'];
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
                        </div>                      
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Price<span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" title="Price" class="form-control" name="price" id="price" step="any" value="<?php echo e((!empty(old('price'))?old('price'):$row->rate)); ?>" required>                            
                            <?php $__errorArgs = ['price'];
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
                        </div>                      
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">GST(%)<span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" title="GST" class="form-control" name="gst" id="gst" value="<?php echo e((!empty(old('gst'))?old('gst'):$row->gst)); ?>" required>                            
                            <?php $__errorArgs = ['gst'];
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
                        </div>                      
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Taxable Amount<span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" title="Taxable Amount" class="form-control" name="taxable_amount" id="taxable_amount" value="<?php echo e((!empty(old('taxable_amount'))?old('taxable_amount'):$row->taxable_amount)); ?>" step="any" required>                            
                            <?php $__errorArgs = ['taxable_amount'];
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
                        </div>                      
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Total Amount<span class="text-danger" title="This field is required">*</span></label>
                            <input type="number" title="Total Amount" class="form-control" name="total_amount" id="total_amount" value="<?php echo e((!empty(old('total_amount'))?old('total_amount'):$row->total_amount)); ?>" step="any" required>                            
                            <?php $__errorArgs = ['total_amount'];
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
                        </div>                      
                    </div>
                </div>
            	<div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                            	<a href="<?php echo e(url()->previous()); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>                            	
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
        $("#opening_qty,#price,#gst").on('change', function(){
            calculateTotal();
        })
    });

    function calculateTotal()
    {
        var op_qty = $("#opening_qty").val();
        var price = $("#price").val();
        var gst = $("#gst").val();
        var taxable_amount=0;
        var total_amount=0;
        if(price>0)
        {
            if(gst>0)
            {
                taxable_amount = (parseFloat(price)*gst)/100;
                taxable_amount = taxable_amount*op_qty;
            }
            
            total_amount = (parseFloat(price)*op_qty)+taxable_amount;
        }

        $("#taxable_amount").val(taxable_amount);
        $("#total_amount").val(total_amount);
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/product/edit.blade.php ENDPATH**/ ?>