@extends('admin::layouts.admin_template')
@section('content')

<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p>
    <a title="Back" href="{{ route('joblist') }}">
        <i class="fa fa-chevron-circle-left"></i> Back To Job Listings
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
</div>

<div class="card-body">

<form action="{{ route('postUpdatejoblist', $row->id) }}" method="post">
@csrf

<div class="row">

    {{-- Job Title --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Job Title <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="title"
                   value="{{ old('title', $row->title) }}"
                   placeholder="Enter Job Title"
                   required>

            @error('title')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Designation --}}
    <!-- <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Designation <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="designation"
                   value="{{ old('designation', $row->designation) }}"
                   placeholder="Enter Designation"
                   required>

            @error('designation')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div> -->

    {{-- Minimum Experience --}}
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">
                Minimum Experience (Years)
            </label>

            <input type="number"
                   class="form-control"
                   name="min_experience"
                   value="{{ old('min_experience', $row->min_experience) }}"
                   min="0">

            @error('min_experience')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Maximum Experience --}}
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">
                Maximum Experience (Years)
            </label>

            <input type="number"
                   class="form-control"
                   name="max_experience"
                   value="{{ old('max_experience', $row->max_experience) }}"
                   min="0">

            @error('max_experience')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Location --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Location
            </label>

            <input type="text"
                   class="form-control"
                   name="location"
                   value="{{ old('location', $row->location) }}"
                   placeholder="Enter Job Location">

            @error('location')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Description --}}
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">
                Job Description 
            </label>

            <textarea name="description"
                      id="description_editor"
                      class="form-control"
                      rows="6">{!! old('description', $row->description) !!}</textarea>

            @error('description')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
                            <div class="col-md-4">
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

</div>

<div class="row">
<div class="col-md-12">

    <a href="{{ route('joblist') }}"
       class="btn btn-secondary">
       Back
    </a>

    <button type="submit"
            class="btn btn-primary">
        Update Job
    </button>

</div>
</div>

</form>

</div>
</div>
</div>
</div>

@endsection


@push('bottom')
<script>
    CKEDITOR.replace('description_editor', {
        allowedContent: true,
        versionCheck: false
    });
</script>
@endpush