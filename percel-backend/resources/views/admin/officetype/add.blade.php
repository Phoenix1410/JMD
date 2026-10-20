@extends('admin::layouts.admin_template')
@section('content')

<p>
    <a title="Back" href="{{ route('officetype') }}">
        <i class="fa fa-chevron-circle-left"></i> Back To Office Type List
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
</div>

<div class="card-body">

<form action="{{ route('postofficetype') }}" method="post">
@csrf

<div class="row">

    {{-- Office Type Name --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Office Type Name <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="type_name"
                   value="{{ old('type_name') }}"
                   placeholder="Enter Office Type (e.g. Registered Office)"
                   required>

            @error('type_name')
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
                <option value="1" {{ old('status',1) == 1 ? 'selected' : '' }}>
                    Active
                </option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            @error('status')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">

        <a href="{{ route('officetype') }}"
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