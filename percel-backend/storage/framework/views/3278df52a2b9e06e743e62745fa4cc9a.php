<?php $__env->startSection('content'); ?>
<p><a title="Main Module" href="<?php echo e(route('manage-testimonial.index')); ?>"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Testimonial</a></p>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($page_title); ?></h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="<?php echo e(route('manage-testimonial.store')); ?>" method="post" enctype="multipart/form-data" id="addUpdateForm"> 
                <?php echo csrf_field(); ?>
                <input type="hidden" name="return_url" value="<?php echo e(route('manage-testimonial.index')); ?>">
                <input type="file" name="image" id="finalImage" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="name" class="form-label">Name <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="name" class="form-control" name="name" id="name" value="<?php echo e(old('name')); ?>" placeholder="Enter Name" required>                          
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
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="designation" class="form-label">Designation <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="designation" id="designation" value="<?php echo e(old('designation')); ?>" placeholder="Enter Designation" required>                          
                            <?php $__errorArgs = ['designation'];
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
                            <label for="title" class="form-label">Image <span class="text-danger" title="This field is required">*</span></label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>                           
                            <span class="error-message text-danger"></span>
                            <div>
                                <img id="previewImage" style="max-width:100%;max-height: 150px; margin: 10px; display:none;">
                            </div>
                            <p class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 2MB.</p>
                        </div>                      
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="message" class="form-label">Message <span class="text-danger" title="This field is required">*</span></label>
                            <textarea name="message" class="form-control" rows="3" required><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
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
                                <option value="1" <?php echo e((old('status') && old('status')==1)?'selected':''); ?>>Active</option>
                                <option value="0" <?php echo e((old('status') && old('status')==0)?'selected':''); ?>>Inactive</option>
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
                                <a href="<?php echo e(route('manage-testimonial.index')); ?>" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                                <!-- <input type="submit" name="submit" value="Save & Add More" class="btn btn-primary"> -->
                                <input type="submit" name="submit" value="Save" class="btn btn-primary">                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- CROP MODAL (INSIDE SAME POPUP FLOW) -->
<div class="modal fade" id="cropModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Crop Image</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
              <div class="crop-container">
                <img id="cropImage">
              </div>              
            </div>
            <div class="modal-footer">                
                <button class="btn btn-primary" id="cropSave">Crop & Add</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('bottom'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
let cropper;
let selectImg=false;
const cropImg = document.getElementById('cropImage');

document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    selectImg = true;
    let $input = $(`[name="image"]`);
    $input.siblings('.error-message').text('');
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {            
        Swal.fire({
            icon: 'error',
            title: 'Invalid Image',
            text: 'Invalid file type. Only JPG, JPEG, PNG and WEBP are allowed.',
            timer: 2000,
            showConfirmButton: false
        });
        e.target.value = ''; // reset input
        return;
    }
    // Check file size (2MB = 2 * 1024 * 1024 bytes)
    const maxSize = 2 * 1024 * 1024;
    if (file.size > maxSize) { 
        Swal.fire({
            icon: 'error',
            title: 'Invalid Image',
            text: 'File is too large. Maximum allowed size is 5MB.',
            timer: 2000,
            showConfirmButton: false
        });
        e.target.value = ''; // reset the input
        return;
    }

    const reader = new FileReader();
    reader.onload = function(event) {
        $(".prev-img-thumb").hide();
        cropImg.src = event.target.result;

        // Destroy old cropper instance if exists
        if (cropper) {
            cropper.destroy();
        }

        let modalEl = document.getElementById('cropModal');
        let modal = new bootstrap.Modal(modalEl);
        modal.show();

        modalEl.addEventListener('shown.bs.modal', function () {
              // Initialize cropper NOW (correct size)
              cropper = new Cropper(cropImg, {
                  aspectRatio: 364 / 440,
                  viewMode: 1,
                  autoCropArea: 1,
                  responsive: true
              });

          }, { once: true });
    };
    reader.readAsDataURL(file);
});

/* Crop & add */
document.getElementById('cropSave').addEventListener('click', () => {
    const canvas = cropper.getCroppedCanvas({
        width: 364,
        height: 440
    });

    canvas.toBlob(function(blob) {
        const file = new File([blob], 'cropped.jpg', { type: 'image/jpeg' });

        // Put cropped file into hidden input
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        document.getElementById('finalImage').files = dataTransfer.files;

        // Preview
        const img = document.getElementById('previewImage');
        img.src = URL.createObjectURL(file);
        img.style.display = 'block';

        cropper.destroy();
        bootstrap.Modal.getInstance(
            document.getElementById('cropModal')
        ).hide();
    });
});

function dataURLtoBlob(dataurl) {
    const arr = dataurl.split(',');
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    let n = bstr.length;
    const u8 = new Uint8Array(n);
    while (n--) u8[n] = bstr.charCodeAt(n);
    return new Blob([u8], { type: mime });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/p7/parrcell_backend/resources/views/admin/manage_testimonial/create.blade.php ENDPATH**/ ?>