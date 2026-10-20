@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ AdminHelper::adminpath() }}/slider"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Home Page Slider</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="{{ route('postAddSlider') }}" method="post" enctype="multipart/form-data">
            	@csrf
            	<input type="hidden" name="return_url" value="{{ AdminHelper::adminpath() }}/slider">
            	<div class="row">
            		<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="title" class="form-label">Title <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="name" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Enter Image Name" required>					        
					        @error('title')
		                        <div class="text-danger mt-1" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </div>
		                    @enderror
					        <p class="text-muted"></p>
					    </div>            			
            		</div>

                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Short Description <span class="text-danger" title="This field is required">*</span></label>
                            <textarea title="name" class="form-control" name="short_description" id="short_description"  placeholder="Enter Image Description" rows="3" required> {{ old('short_description') }}</textarea>                          
                            @error('short_description')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <p class="text-muted"></p>
                        </div>                      
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Image <span class="text-danger" title="This field is required">*</span></label>
                            <input type="file" title="image" class="form-control" name="image" id="image" accept="image/*" required>                            
                            @error('image')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <p class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 2MB. Please use 1920 × 760 px dimension for better view.</p>
                        </div>                      
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="Nameinput" class="form-label">Select Status<span class="text-danger" title="This field is required">*</span></label>
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>                       
                            @error('status')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <p class="text-muted"></p>
                        </div>                      
                    </div>
            		
            	</div>
            	<div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                            	<a href="{{ AdminHelper::adminpath() }}/slider" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                            	<input type="submit" name="submit" value="Save" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
            	</form>
            </div>
		</div>
	</div>
</div>
@endsection