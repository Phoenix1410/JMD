@extends('admin::layouts.admin_template')
@section('content')
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit About Us</h4>
    </div>

    <div class="card-body">

        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('postUpdateaboutus', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Main Content -->
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content"  id="description_editor" class="form-control" rows="4">{{ $data->content }}</textarea>
            </div>

            <hr>

            <!-- Fleet Section -->
            <h5>Fleet Section</h5>

            <div class="mb-3">
                <label class="form-label">Fleet Icon</label>

                @if($data->fleet_icon)
                    <div class="mb-2">
                        <img src="{{ asset($data->fleet_icon) }}" width="80">
                    </div>
                @endif

                <input type="file" name="fleet_icon" class="form-control">
                <small class="text-muted">Leave empty to keep old image</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Fleet Name</label>
                <input type="text" name="fleet_name" class="form-control" value="{{ $data->fleet_name }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Fleet Content</label>
                <textarea name="fleet_content" class="form-control">{{ $data->fleet_content }}</textarea>
            </div>

            <hr>

            <!-- Network Section -->
            <h5>Network Section</h5>

            <div class="mb-3">
                <label class="form-label">Network Icon</label>

                @if($data->network_icon)
                    <div class="mb-2">
                        <img src="{{ asset($data->network_icon) }}" width="80">
                    </div>
                @endif

                <input type="file" name="network_icon" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Network Name</label>
                <input type="text" name="network_name" class="form-control" value="{{ $data->network_name }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Network Content</label>
                <textarea name="network_content" class="form-control">{{ $data->network_content }}</textarea>
            </div>

            <hr>

            <!-- Delivery Section -->
            <h5>Delivery Section</h5>

            <div class="mb-3">
                <label class="form-label">Delivery Icon</label>

                @if($data->delivery_icon)
                    <div class="mb-2">
                        <img src="{{ asset($data->delivery_icon) }}" width="80">
                    </div>
                @endif

                <input type="file" name="delivery_icon" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Name</label>
                <input type="text" name="delivery_name" class="form-control" value="{{ $data->delivery_name }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Content</label>
                <textarea name="delivery_content" class="form-control">{{ $data->delivery_content }}</textarea>
            </div>

            <hr>

            <!-- Stats -->
            <h5>Statistics</h5>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>States Covered</label>
                    <input type="text" name="states_covered" class="form-control" value="{{ $data->states_covered }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Branches</label>
                    <input type="text" name="branches" class="form-control" value="{{ $data->branches }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Daily Shipments</label>
                    <input type="text" name="daily_shipments" class="form-control" value="{{ $data->daily_shipments }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Years Experience</label>
                    <input type="text" name="years_experience" class="form-control" value="{{ $data->years_experience }}">
                </div>
            </div>

            <hr>

            <!-- Buttons -->
            <div class="text-end">
                <a href="{{ route('manageaboutus') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </form>
    </div>
</div>

@endsection
@push('bottom')
<script>
    CKEDITOR.replace('description_editor', {
        allowedContent: true,
        versionCheck: false,
        resize_enabled: false // ✅ IMPORTANT
    });
</script>
@endpush