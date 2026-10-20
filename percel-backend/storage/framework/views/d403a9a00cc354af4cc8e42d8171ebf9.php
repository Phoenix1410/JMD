<?php $__env->startSection('content'); ?>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
            <div class="card-header card-primary">
                <i class="fa fa-cog"></i> <?php echo e($page_title); ?>

            </div>
            <div class="card-body">
                <form method="post" id="form" enctype="multipart/form-data" action="<?php echo e(route('postSaveGeneralSettings')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="box-body">
                        <div class="form-group mb-3">
                            <label class="label-setting">Site Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="site_title" value="<?php echo e((old('site_title')?old('site_title'):(!empty($row)?$row->appname:''))); ?>" required>
                            <?php $__errorArgs = ['site_title'];
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
                            <label class="label-setting">Company Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="company_name" value="<?php echo e((old('company_name')?old('company_name'):(!empty($row)?$row->company:''))); ?>" required>
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
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="label-setting">Logo</label>
                            <input type="file" name="logo" accept="image/*" class="form-control">
                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                            <?php $__errorArgs = ['logo'];
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
                            <?php if(!empty($row->logo) && (Storage::exists($row->logo) || file_exists(public_path($row->logo)))): ?>
                            <div class="prev-img-thumb"><img  src="<?php echo e(asset($row->logo)); ?>"></div>
                            <!-- <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p> -->
                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->logo); ?>"><i class="fa fa-download"></i> Download </a>
                            <!-- <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="<?php echo e(AdminHelper::adminpath()); ?>/delete-image?image=<?php echo e($row->logo); ?>&&id=<?php echo e($row->id); ?>&&column=logo&table=admin_settings"><i class="fa fa-ban"></i> Delete </a> -->
                            </p>
                            <?php endif; ?>                   
                        </div>
                        <div class="form-group mb-3">
                            <label class="label-setting">Favicon</label>
                            <input type="file" name="favicon" accept="image/*" class="form-control">
                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                            <?php $__errorArgs = ['favicon'];
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
                            <?php if(!empty($row->favicon) && (Storage::exists($row->favicon) || file_exists(public_path($row->favicon)))): ?>
                            <div class="prev-img-thumb" style="width:30px;height: auto;"><img src="<?php echo e(asset($row->favicon)); ?>"></div>
                            <!-- <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p> -->
                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->favicon); ?>"><i class="fa fa-download"></i> Download </a>
                            <!-- <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="<?php echo e(AdminHelper::adminpath()); ?>/delete-image?image=<?php echo e($row->favicon); ?>&&id=<?php echo e($row->id); ?>&&column=favicon&table=admin_settings"><i class="fa fa-ban"></i> Delete </a> -->
                            </p>
                            <?php endif; ?>                           
                        </div>
                        <div class="form-group mb-3">
                            <label class="label-setting">Footer Logo</label>
                            <input type="file" name="footer_logo" accept="image/*" class="form-control">
                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                            <?php $__errorArgs = ['footer_logo'];
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
                            <?php if(!empty($row->footer_logo) && (Storage::exists($row->footer_logo) || file_exists(public_path($row->footer_logo)))): ?>
                            <div class="prev-img-thumb"><img style="background:#ded5bf" src="<?php echo e(asset($row->footer_logo)); ?>"></div>
                            <!-- <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p> -->
                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->footer_logo); ?>"><i class="fa fa-download"></i> Download </a>
                            <!-- <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="<?php echo e(AdminHelper::adminpath()); ?>/delete-image?image=<?php echo e($row->footer_logo); ?>&&id=<?php echo e($row->id); ?>&&column=footer_logo&table=admin_settings"><i class="fa fa-ban"></i> Delete </a> -->
                            </p>
                            <?php endif; ?>                   
                        </div>
                       <!--  <div class="form-group mb-3">
                            <label class="label-setting">Homepage Banner</label>                            
                            <?php if(!empty($row->home_banner) && (Storage::exists($row->home_banner) || file_exists(public_path($row->home_banner)))): ?>
                            <div class="prev-img-thumb"><img src="<?php echo e(asset($row->home_banner)); ?>"></div>
                            <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                            <p><a class="btn btn-danger btn-primary btn-sm" href="<?php echo e(AdminHelper::adminpath()); ?>/download-file?image=<?php echo e($row->home_banner); ?>"><i class="fa fa-download"></i> Download </a>
                            <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="<?php echo e(AdminHelper::adminpath()); ?>/delete-image?image=<?php echo e($row->home_banner); ?>&&id=<?php echo e($row->id); ?>&&column=home_banner&table=admin_settings"><i class="fa fa-ban"></i> Delete </a></p>
                            <?php else: ?>
                            <input type="file" name="home_banner" accept="image/*" class="form-control">
                            <div class="text-muted">File support only jpg,png,gif, Max 2 MB</div>  
                            <?php $__errorArgs = ['home_banner'];
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
                            <?php endif; ?>                   
                        </div> -->
                        <div class="form-group mb-3">
                            <label class="label-setting">Notice</label>
                            <!-- <input type="text" class="form-control" name="notice" value="<?php echo e((old('notice')?old('notice'):(!empty($row)?$row->notice:''))); ?>"> -->
                            <textarea name="notice"  id="content_editor" class="form-control" rows="3" maxlength="300"><?php echo e((old('notice')?old('notice'):(!empty($row)?$row->notice:''))); ?></textarea>
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['notice'];
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
                            <label class="label-setting">Email</label>
                            <input type="email" class="form-control" name="site_email" value="<?php echo e((old('site_email')?old('site_email'):(!empty($row)?$row->site_email:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['site_email'];
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
                            <label class="label-setting">Admin Inquiry Email</label>
                            <input type="email" class="form-control" name="admin_inquiry_email" value="<?php echo e((old('admin_inquiry_email')?old('admin_inquiry_email'):(!empty($row)?$row->admin_inquiry_email:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['admin_inquiry_email'];
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
                            <label class="label-setting">Contact Number</label>
                            <input type="text" class="form-control" name="site_phone_number" value="<?php echo e((old('site_phone_number')?old('site_phone_number'):(!empty($row)?$row->site_phone_number:''))); ?>" maxlength="15">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['site_phone_number'];
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
                            <label class="label-setting">Whatsapp Number</label>
                            <input type="text" class="form-control" name="additional_number" value="<?php echo e((old('additional_number')?old('additional_number'):(!empty($row)?$row->additional_number:''))); ?>" maxlength="15">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['additional_number'];
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

                        <!-- <div class="form-group mb-3">
                            <label class="label-setting">Address</label>
                            <textarea class="form-control" name="site_address" rows="3"><?php echo e((old('site_address')?old('site_address'):(!empty($row)?$row->site_address:''))); ?></textarea>
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['site_address'];
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
                        </div> -->

                       <!--  <div class="form-group mb-3">
                            <label class="label-setting">Google Map Link</label>
                            <textarea class="form-control" name="map_link"><?php echo e((old('map_link')?old('map_link'):(!empty($row)?$row->map_link:''))); ?></textarea>
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['map_link'];
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
                        </div> -->

                        <div class="form-group mb-3">
                            <label class="label-setting">Facebook</label>
                            <input type="text" class="form-control" name="facebook_link" value="<?php echo e((old('facebook_link')?old('facebook_link'):(!empty($row)?$row->facebook_link:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['facebook_link'];
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
                            <label class="label-setting">Instagram</label>
                            <input type="text" class="form-control" name="instagram_link" value="<?php echo e((old('instagram_link')?old('instagram_link'):(!empty($row)?$row->instagram_link:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['instagram_link'];
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
                            <label class="label-setting">Twitter</label>
                            <input type="text" class="form-control" name="twitter_link" value="<?php echo e((old('twitter_link')?old('twitter_link'):(!empty($row)?$row->twitter_link:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['twitter_link'];
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
                            <label class="label-setting">Play Store Link</label>
                            <input type="text" class="form-control" name="playstorelink" value="<?php echo e((old('playstorelink')?old('playstorelink'):(!empty($row)?$row->playstorelink:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['playstorelink'];
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
                            <label class="label-setting">Apple Store Link</label>
                            <input type="text" class="form-control" name="apllestorelink" value="<?php echo e((old('apllestorelink')?old('apllestorelink'):(!empty($row)?$row->apllestorelink:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['apllestorelink'];
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
                            <label class="label-setting">Linkedin</label>
                            <input type="text" class="form-control" name="linkedin_link" value="<?php echo e((old('linkedin_link')?old('linkedin_link'):(!empty($row)?$row->linkedin_link:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['linkedin_link'];
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
                            <label class="label-setting">Youtube</label>
                            <input type="text" class="form-control" name="youtube_link" value="<?php echo e((old('youtube_link')?old('youtube_link'):(!empty($row)?$row->youtube_link:''))); ?>">
                            <div class="text-muted"></div>
                            <?php $__errorArgs = ['youtube_link'];
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
<?php $__env->startPush('bottom'); ?>
<script>
    CKEDITOR.replace('content_editor', {
        allowedContent: true,
        versionCheck: false
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/jmdtsmkd7k/paarcel3u.in/beta/admin/resources/views/admin/settings/general.blade.php ENDPATH**/ ?>