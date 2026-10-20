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

<form action="{{ route('postUpdatenewsroll', $row->id) }}" method="post" enctype="multipart/form-data">
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
                   value="{{ old('heading', $row->heading) }}"
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
            <label class="form-label">Author Name</label>
            <input type="text"
                   class="form-control"
                   name="author_name"
                   value="{{ old('author_name', $row->author_name) }}"
                   placeholder="Author Name">

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
                   value="{{ old('meta_title', $row->meta_title) }}"
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
                   value="{{ old('sort', $row->sort) }}"
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
                <option value="1" {{ old('status', $row->status) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $row->status) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>

            @error('status')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

	<div class="col-md-6">			
		<div class="form-group mb-3">
                   <label class="label-setting">Featured Image</label>                            
                   @if(!empty($row->image) && (Storage::exists($row->image) || file_exists(public_path($row->image))))
                   <div class="prev-img-thumb"><img src="{{ asset($row->image) }}"></div>
                   <p class="text-muted"><em>* If you want to upload other image, please first delete the image.</em></p>
                   <p><a class="btn btn-danger btn-primary btn-sm" href="{{AdminHelper::adminpath()}}/download-file?image={{$row->image}}"><i class="fa fa-download"></i> Download </a>
                   <a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{AdminHelper::adminpath()}}/delete-image?image={{$row->image}}&&id={{$row->id}}&&column=image&table=news"><i class="fa fa-ban"></i> Delete </a></p>
                @else
                <input type="file" name="image" id="image" accept="image/*" class="form-control" >
                <div class="text-muted">The image should be JPG/JPEG/PNG/GIF/SVG type and the image size should not above 2MB.</div>  
                @error('image')
                    <div class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
               @enderror       
            @endif                   
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
                      rows="6">{!! old('content', $row->content) !!}</textarea>

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
            Update
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