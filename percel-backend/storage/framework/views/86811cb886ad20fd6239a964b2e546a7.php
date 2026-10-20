<?php $__env->startSection('content'); ?>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
            <div class="card-header card-primary">
                <i class="fa fa-cog"></i> <?php echo e($page_title); ?>

            </div>
            <div class="card-body">
                <form method="post" id="form" enctype="multipart/form-data" action="<?php echo e(route('postSaveEmailSettings')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group mb-3">
                            <label class="label-setting">Email Sender<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email_sender" value="<?php echo e((old('email_sender')?old('email_sender'):(!empty($row)?$row->email_sender:''))); ?>" required>
                            <?php $__errorArgs = ['email_sender'];
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
                            <label class="label-setting">Mail Driver<span class="text-danger">*</span></label>
                            <select name="mail_driver" class="form-control" required>
                                <option value="smtp" <?php echo e((old('mail_driver')=='smtp')?'selected':(((!empty($row) && $row->mail_driver=='smtp'))?'selected':'')); ?>>smtp</option>
                                <option value="mail" <?php echo e((old('mail_driver')=='mail')?'selected':(((!empty($row) && $row->mail_driver=='mail'))?'selected':'')); ?>>mail</option>
                                <option value="sendmail" <?php echo e((old('mail_driver')=='sendmail')?'selected':(((!empty($row) && $row->mail_driver=='sendmail'))?'selected':'')); ?>>sendmail</option>
                            </select>
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['mail_driver'];
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
                            <label class="label-setting">SMTP Host<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="smtp_host" value="<?php echo e((old('smtp_host')?old('smtp_host'):(!empty($row)?$row->smtp_host:''))); ?>" required>
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['smtp_host'];
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
                            <label class="label-setting">SMTP Port</label>
                            <input type="text" class="form-control" name="smtp_port" value="<?php echo e((old('smtp_port')?old('smtp_port'):(!empty($row)?$row->smtp_port:''))); ?>">
                            <div class="text-muted">default 25</div>
                            <?php $__errorArgs = ['smtp_port'];
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
                            <label class="label-setting">SMTP Username<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="smtp_username" value="<?php echo e((old('smtp_username')?old('smtp_username'):(!empty($row)?$row->smtp_username:''))); ?>" required>
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['smtp_username'];
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
                            <label class="label-setting">SMTP Password<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="smtp_password" value="<?php echo e((old('smtp_password')?old('smtp_password'):(!empty($row)?$row->smtp_password:''))); ?>" required>
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['smtp_password'];
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
                        
                    </div><!-- /.box-body -->
                    <div class="card-footer">
                        <div class="pull-right">
                            <input type="submit" name="submit" value="Save" class="btn btn-success">
                        </div>
                    </div><!-- /.box-footer-->
                </form>
            </div>
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/rmm_food_products/resources/views/admin/settings/email.blade.php ENDPATH**/ ?>