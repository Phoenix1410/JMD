<?php $__env->startSection('content'); ?>
<div class="list-grid-nav hstack gap-1 mb-3">    
    <?php if(AdminHelper::isCreate()): ?>
    <a href="<?php echo e(route('manage-testimonial.create')); ?>?return_url=<?php echo e(route('manage-testimonial.index')); ?>"
        id="btn_add_new_data" class="btn btn-primary" title="Add Data">
        <i class="fa fa-plus-circle"></i> Add Data
    </a>
    <?php endif; ?>
</div>
<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
        <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">   
            <form method="get" style="display:inline-block;width: 290px;" action="<?php echo e(route('manage-testimonial.index')); ?>">
                <div class="input-group">
                    <input type="text" name="q" value="<?php echo e(request()->get('q')); ?>" class="form-control rounded-0 pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <?php if(!empty(request()->get('q'))): ?>
                        <button type="button" onclick="location.href='<?php echo e(route('manage-testimonial.index')); ?>'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                        <?php endif; ?>
                        <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>


            <form method="get" id="form-limit-paging" style="display:inline-block"
                action="<?php echo e(route('manage-testimonial.index')); ?>">
                <?php $limits =[5,10,20,25,50,100,200]; ?>
                <div class="input-group">
                    <select onchange="$('#form-limit-paging').submit()" name="limit" style="width: 56px;"
                        class="form-control input-sm">
                        <?php $__currentLoopData = $limits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lmt); ?>" <?php echo e(($lmt==$limit)?'selected':''); ?>><?php echo e($lmt); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </form>

        </div>

        <br style="clear:both">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                <thead class="table-blue">
                    <tr class="active">
                        <th>#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th width="auto" style="text-align:right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($rows) && count($rows)): ?>
                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                         <td><?php echo e($rows->firstItem() + $key); ?></td>
                        <td><?php echo e($data->name); ?></td>
                        <td><?php echo e($data->designation); ?></td>
                        <td>
                            <?php if($data->image): ?>
                            <a data-fancybox="gallery" href="<?php echo e(asset($data->image)); ?>">
                            <img src="<?php echo e(asset($data->image)); ?>" style="max-width: 50px; max-height: 100px;">
                            </a>
                            <?php else: ?>
                            --
                            <?php endif; ?>
                        </td>
                         <td>
                                <form action="<?php echo e(route('manage-testimonial.status')); ?>"  method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                                <input type="hidden"
                                    name="status"
                                    value="<?php echo e($data->status == '1' ? '0' : '1'); ?>">

                                <button type="submit"
                                        class="btn btn-sm <?php echo e($data->status == '1' ? 'btn-success' : 'btn-danger'); ?>">
                                    <?php echo e($data->status == '1' ? 'Active' : 'Inactive'); ?>

                                </button>

                                </form>
                            </td>
                        <td>
                            <div class="button_action" style="text-align:right">
                            <?php if(AdminHelper::isRead()): ?>
                            <a class="btn btn-sm btn-primary btn-detail" title="Detail Data" href="<?php echo e(route('manage-testimonial.show', $data->id)); ?>?return_url=<?php echo e(route('manage-testimonial.index')); ?>"><i class="fa fa-eye"></i></a>
                            <?php endif; ?>
                            <?php if(AdminHelper::isUpdate()): ?>
                            <a class="btn btn-sm btn-success btn-edit" title="Edit Data" href="<?php echo e(route('manage-testimonial.edit', $data->id)); ?>?return_url=<?php echo e(route('manage-testimonial.index')); ?>"><i class="fa fa-pencil"></i></a>
                            <?php endif; ?>           

                            <?php if(AdminHelper::isDelete()): ?>
                            <a href="javascript:void(0);"
                               class="btn btn-sm btn-warning btn-delete"
                               title="Delete"
                               data-id="<?php echo e($data->id); ?>">
                               <i class="fa fa-trash"></i>
                            </a>
                            <form id="delete-form-<?php echo e($data->id); ?>"
                                  action="<?php echo e(route('manage-testimonial.destroy', $data->id)); ?>"
                                  method="POST"
                                  style="display: none;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                            <?php endif; ?>

                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center"><i class="fa fa-search"></i> No Data Available</td>
                    </tr>
                    <?php endif; ?>                        
                </tbody>
            </table>
        </div>
         <div class="row m-3">
            <div class="col-md-10">
                <span>Total rows : <?php echo e($rows->total()); ?></span>
            </div>

            <div class="col-md-2 text-end">
                <?php echo $rows->withQueryString()->links('pagination::bootstrap-4'); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/admin/resources/views/admin/manage_testimonial/index.blade.php ENDPATH**/ ?>