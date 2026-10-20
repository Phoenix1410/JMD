@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ route('contact-address.index') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Contact Address</a></p>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="{{ route('contact-address.update', $row->id) }}" method="post" enctype="multipart/form-data"> 
                @csrf
                @method('PUT')
                <input type="hidden" name="return_url" value="{{ route('contact-address.index') }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="title" class="form-label">Title <span class="text-danger" title="This field is required">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ (!empty(old('title'))?old('title'):$row->title) }}" placeholder="Enter Title" required>                          
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
                            <label for="title" class="form-label">Address <span class="text-danger" title="This field is required">*</span></label>
                            <textarea name="address" class="form-control" rows="3" required>{{ (!empty(old('address'))?old('address'):$row->address) }}</textarea>                          
                            @error('address')
                                <div class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <p class="text-muted"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3 ">
                            <label for="Nameinput" class="form-label">Status<span class="text-danger" title="This field is required">*</span></label>
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
                                <a href="{{ route('contact-address.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
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