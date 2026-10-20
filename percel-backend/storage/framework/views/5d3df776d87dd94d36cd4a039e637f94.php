
<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('getManageHowitworks')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data</a></p>
<div class="list-grid-nav hstack gap-1 mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
      <i class="fa fa-plus-circle"></i> Add Data
    </button>
    <!-- Modal -->
    <div class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add Steps</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo e(route('postAddStepHow', $id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                    <label class="label-setting">Title<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="<?php echo e(old('title')); ?>" required>
                    <?php $__errorArgs = ['title'];
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
                <div class="form-group mb-3">
                    <label class="label-setting">Sub Title<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sub_title" value="<?php echo e(old('sub_title')); ?>" required>
                    <?php $__errorArgs = ['sub_title'];
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
                <div class="form-group mb-3">
                    <label class="label-setting">Image</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                    <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
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
                </div>
                <div class="form-group">                    
                    <div class="col-sm-10">                        
                        <input type="submit" name="submit" value="Save" class="btn btn-success">
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>            
          </div>
        </div>
      </div>
    </div>
</div>
<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form id="form-table" method="post" action="<?php echo e(route('getManageHowitworks')); ?>/action-selected">
                <input type='hidden' name='button_name' value=''/>
                <?php echo csrf_field(); ?>                
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">                            
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Image</th>                            
                            <th width="auto" style="text-align:right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($rows) && count($rows)): ?>                        
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($row->title); ?></td>                           
                            <td><?php echo e($row->sub_title); ?></td>                           
                            <td><?php if($row->image!=''): ?><img src="<?php echo e(asset($row->image)); ?>" width="50px" height="50px" style="background-color: #b20d8d;"> <?php else: ?> N\A  <?php endif; ?></td>
                            <td>
                                <div class="button_action" style="text-align:right">
                                    <button type="button" class="btn btn-sm btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#editDataModal<?php echo e($row->id); ?>">
                                      <i class="fa fa-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>  
                        <!-- Modal -->
                        <div class="modal fade" id="editDataModal<?php echo e($row->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Steps</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo e(route('postUpdateStepHow', $row->id)); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group mb-3">
                                        <label class="label-setting">Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" value="<?php echo e($row->title); ?>" required>
                                        <?php $__errorArgs = ['title'];
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
                                    <div class="form-group mb-3">
                                        <label class="label-setting">Sub Title<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="sub_title" value="<?php echo e($row->sub_title); ?>" required>
                                        <?php $__errorArgs = ['sub_title'];
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
                                    <div class="form-group mb-3">
                                        <label class="label-setting">Image</label>
                                        <input type="file" name="image" accept="image/*" class="form-control">
                                        <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
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
                                        <?php if(!empty($row->image) && (Storage::exists($row->image) || file_exists(public_path($row->image)))): ?>
                                            <div class="prev-img-thumb"><img src="<?php echo e(asset($row->image)); ?>" style="background-color: #b20d8d;"></div>
                                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->image); ?>"><i class="fa fa-download"></i> Download </a>
                                            </p>
                                        <?php endif; ?> 
                                    </div>
                                    <div class="form-group">                    
                                        <div class="col-sm-10">                        
                                            <input type="submit" name="submit" value="Save" class="btn btn-success">
                                        </div>
                                    </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>            
                              </div>
                            </div>
                          </div>
                        </div>   
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                   
                        <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center"><i class="fa fa-search"></i> No Data Avaliable</td>
                        </tr>
                        <?php endif; ?>                        
                    </tbody>
                </table>

            </form>
            <!--END FORM TABLE-->           
            <!-- <div class="col-md-4"><span class="pull-right">Total rows
                    : 1 to 3 of 3</span></div> -->

        </div>
    </div>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/apperance/how_it_work_steps.blade.php ENDPATH**/ ?>