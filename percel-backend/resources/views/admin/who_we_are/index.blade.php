@extends('admin::layouts.admin_template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="{{ route('who-we-are.store') }}" method="post" enctype="multipart/form-data" id="addUpdateForm"> 
                @csrf
                <input type="hidden" name="return_url" value="{{ route('who-we-are.index') }}">
                <input type="file" name="image" id="finalImage" hidden>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Title <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" title="name" class="form-control" name="title" id="title" value="{{ (!empty(old('title'))?old('title'):$row->title) }}" placeholder="Enter Title" required>
                            <p class="text-muted">The title should not exceed 50 characters.</p>
                            @error('title')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description">{{ (!empty(old('description'))?old('description'):$row->description) }}</textarea>                      
                            @error('description')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <p class="text-muted"></p>
                        </div>                      
                    </div>
                     <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="vision_statement_title" class="form-label">Vision Statement Title<span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="vision_statement_title" id="vision_statement_title" value="{{ (!empty(old('vision_statement_title'))?old('vision_statement_title'):$row->vision_statement_title) }}" placeholder="vision statement title" required>
                            <p class="text-muted">The vision statement should not exceed 300 characters.</p>
                            @error('vision_statement_title')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="vision_statement" class="form-label">Vision Statement <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="vision_statement" id="vision_statement" value="{{ (!empty(old('vision_statement'))?old('vision_statement'):$row->vision_statement_content) }}" placeholder="Vision Statement" required>
                            <p class="text-muted">The vision statement should not exceed 300 characters.</p>
                            @error('vision_statement')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror                            
                        </div>
                    </div>
                   
                     <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="our_value_title" class="form-label">Our Value Title<span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="our_value_title" id="our_value_title" value="{{ (!empty(old('our_value_title'))?old('our_value_title'):$row->our_value_title) }}" placeholder="our value title" required>
                            <p class="text-muted">The vision statement should not exceed 300 characters.</p>
                            @error('our_value_title')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror                            
                        </div>
                    </div>
                     
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="our_value" class="form-label">Our Value <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="our_value" id="our_value" value="{{ (!empty(old('our_value'))?old('our_value'):$row->our_value_content) }}" placeholder="Our Value" required>
                            <p class="text-muted">The our value should not exceed 300 characters.</p>
                            @error('our_value')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="quality_policy_title" class="form-label">Quality policy title<span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="quality_policy_title" id="quality_policy_title" value="{{ (!empty(old('quality_policy_title'))?old('quality_policy_title'):$row->quality_policy_title) }}" placeholder="quality policy title" required>
                            <p class="text-muted">The vision statement should not exceed 300 characters.</p>
                            @error('quality_policy_title')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="quality_policy" class="form-label">Quality Policy <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="quality_policy" id="quality_policy" value="{{ (!empty(old('quality_policy'))?old('quality_policy'):$row->quality_policy_content) }}" placeholder="Quality Policy" required>   
                            <p class="text-muted">The quality policy should not exceed 300 characters.</p>                       
                            @error('quality_policy')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror                            
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                                <!-- <a href="{{ route('who-we-are.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a> -->
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
@push('bottom')
<script type="text/javascript" src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    

      CKEDITOR.replace( 'description',{
        allowedContent : true,
        versionCheck: false,
         resize_enabled: false 
      });

    
    });
</script>
@endpush