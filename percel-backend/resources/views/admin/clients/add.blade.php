@extends('admin::layouts.admin_template')
@section('content')

<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p>
    <a title="Back" href="{{ route('manageclient') }}">
        <i class="fa fa-chevron-circle-left"></i> Back To Clients
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
</div>

<div class="card-body">

<form action="{{ route('postAddclients') }}" method="post" enctype="multipart/form-data">
@csrf

<div class="row">

    {{-- Title --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Client Title <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="title"
                   value="{{ old('title') }}"
                   placeholder="Enter Client Title"
                   required>

            @error('title')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Location --}}
    <!-- <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Location <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="location"
                   value="{{ old('location') }}"
                   placeholder="Enter Client Location"
                   required>

            @error('location')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div> -->

    {{-- Image --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Client Image <span class="text-danger">*</span>
            </label>

            <input type="file"
                   class="form-control"
                   name="image"
                   accept="image/*"
                   required>

            <div class="text-muted">
                Allowed formats: JPG,WEBP, PNG, JPEG (Max 2MB)
            </div>

            @error('image')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Status --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Status <span class="text-danger">*</span>
            </label>

            <select class="form-control" name="status" required>
                <option value="">Select Status</option>
                <option value="1" >Active</option>
                <option value="0" >Inactive</option>
            </select>

            @error('status')
            <div class="text-danger mt-1">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
    </div>

    {{-- Description --}}
    <!-- <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">
                Description
            </label>

            <textarea name="description"
                      id="description_editor"
                      class="form-control"
                      rows="6">{!! old('description') !!}</textarea>

            @error('description')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div> -->

</div>

<div class="row">
<div class="col-md-12">

    <a href="{{ route('manageclient') }}"
       class="btn btn-secondary">
       Back
    </a>

    <button type="submit"
            class="btn btn-primary">
        Save
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