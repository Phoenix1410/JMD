@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ url()->previous() }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Slider Images</a></p>

<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card">
			<div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            	<form action="{{ route('postUpdateSlider', $row->id) }}" method="post" enctype="multipart/form-data">
            	@csrf
            	<input type="hidden" name="return_url" value="{{ AdminHelper::adminpath() }}/slider">
            	<div class="row">
            		<div class="col-md-12">
            			<div class="mb-3 ">
					        <label for="title" class="form-label">Title <span class="text-danger" title="This field is required">*</span></label>
					        <input type="text" title="name" class="form-control" name="title" id="title" value="{{ (!empty(old('title'))?old('title'):$row->title) }}" placeholder="Enter Image Name" required>					        
					        @error('name')
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
                            <textarea title="name" class="form-control" name="short_description" id="short_description"  placeholder="Enter Image Description" required> {{ (!empty(old('short_description'))?old('short_description'):$row->short_description) }}</textarea>                          
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
                            <label for="title" class="form-label">Image</label>
                            <input type="file" title="image" class="form-control" name="image" id="image" accept="image/*"> 
                            @if($row->image)
                            <img src="{{ asset('/public/'.$row->image) }}" width="200px" height="100px">
                            @endif  
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
					        	<option value="1" @if($row->status==1) selected @endif >Active</option>
					        	<option value="0" @if($row->status==0) selected @endif >Inactive</option>
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
                            	<a href="{{ url()->previous() }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>                            	
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