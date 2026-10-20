@extends('admin::layouts.admin_template')
@section('content')

<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<p>
    <a title="Back" href="{{ route('managenewsroll') }}">
        <i class="fa fa-chevron-circle-left"></i> Back To News List
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
</div>

<div class="card-body">

<form action="{{ route('postAddnewsroll') }}" method="post" enctype="multipart/form-data">
@csrf

<div class="row">

    {{-- Heading --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Heading <span class="text-danger">*</span>
            </label>
            <input type="text"
                   class="form-control"
                   name="heading"
                   value="{{ old('heading') }}"
                   placeholder="Enter News Heading"
                   required>

            @error('heading')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Author Name --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Author Name <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control"
                   name="author_name"
                   value="{{ old('author_name') }}"
                   placeholder="Author Name"
                   required
                   >

            @error('author_name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Meta Title --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Meta Title (SEO)</label>
            <input type="text"
                   class="form-control"
                   name="meta_title"
                   value="{{ old('meta_title') }}"
                   placeholder="Meta Title">

            @error('meta_title')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Sort Order --}}
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number"
                   class="form-control"
                   name="sort"
                   value="{{ old('sort',0) }}"
                   min="0">

            @error('sort')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Status --}}
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">
                Status <span class="text-danger">*</span>
            </label>

            <select name="status" class="form-control" required>
                <option value="1" >Active</option>
                <option value="0" >Inactive</option>
            </select>

            @error('status')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

	{{-- Image --}}
	<div class="col-md-6">
        <div class="mb-3 ">
			<label class="form-label"> Image<span class="text-danger">*</span></label>
			<input type="file" class="form-control" name="image" accept="image/*" required>					        
				@error('image')
		                <div class="text-danger mt-1" role="alert">
		                    <strong>{{ $message }}</strong>
		                </div>
		        @enderror
				<p class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 5MB.</p>
		</div>            			
    </div>

    {{-- Content --}}
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">
                Content <span class="text-danger">*</span>
            </label>

            <textarea name="content"
                      id="content_editor"
                      class="form-control"
                      rows="6">{!! old('content') !!}</textarea>

            @error('content')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">

        <a href="{{ route('managenewsroll') }}"
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
    CKEDITOR.replace('content_editor', {
        allowedContent: true,
        versionCheck: false
    });
</script>
@endpush