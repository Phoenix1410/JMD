@extends('admin::layouts.admin_template')
@section('content')

<p>
    <a title="Back" href="{{ route('office') }}">
        <i class="fa fa-chevron-circle-left"></i> Back To Office List
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
</div>

<div class="card-body">

<form action="{{ route('postoffice') }}" method="post">
@csrf

<div class="row">

    {{-- Office Type --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Office Type <span class="text-danger">*</span>
            </label>

            <select name="office_type_id" class="form-control" required>
                <option value="">-- Select Office Type --</option>
                @foreach($office_types as $type)
                    <option value="{{ $type->id }}"
                        {{ old('office_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->type_name }}
                    </option>
                @endforeach
            </select>

            @error('office_type_id')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Office Name --}}
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">
                Office Name <span class="text-danger">*</span>
            </label>

            <input type="text"
                   class="form-control"
                   name="office_name"
                   value="{{ old('office_name') }}"
                   placeholder="Enter Office Name"
                   required>

            @error('office_name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Address --}}
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">
                Address <span class="text-danger">*</span>
            </label>

            <textarea class="form-control"
                      name="address"
                      rows="2"
                      required>{{ old('address') }}</textarea>

            @error('address')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- State --}}
<div class="col-md-3">
    <div class="mb-3">
        <label class="form-label">State</label>

        <select name="state_id"
                id="state_id"
                class="form-control">

            <option value="">-- Select State --</option>

            @foreach($states as $state)
                <option value="{{ $state->id }}"
                    {{ old('state_id') == $state->id ? 'selected' : '' }}>
                    {{ $state->name }}
                </option>
            @endforeach

        </select>
    </div>
</div>

   {{-- City --}}
<div class="col-md-3">
    <div class="mb-3">
        <label class="form-label">City</label>
        <select name="city_id"
                id="city_id"
                class="form-control">
            <option value="">-- Select City --</option>
        </select>
    </div>
</div>





    {{-- Pincode --}}
    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Pincode</label>
            <input type="text"
                   class="form-control"
                   name="pincode"
                   value="{{ old('pincode') }}">
        </div>
    </div>

    {{-- Phone --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text"
                   class="form-control"
                   name="phone"
                   value="{{ old('phone') }}">
        </div>
    </div>

    {{-- Email --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   name="email"
                   value="{{ old('email') }}">
        </div>
    </div>

    {{-- Sort --}}
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number"
                   class="form-control"
                   name="sort"
                   value="{{ old('sort',0) }}">
        </div>
    </div>

    {{-- Status --}}
    <div class="col-md-2">
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

        <a href="{{ route('office') }}"
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
$(document).ready(function(){

    $("#state_id").change(function(){

        var state_val = $(this).val();
        var url_val = '{{ url('/') }}/city-by-states';

        $.ajax({
            type: 'POST',
            url: url_val,
            data: {
                state_id: state_val,
                _token: "{{ csrf_token() }}"
            },
            success: function(resultData) {
                $('#city_id').html(resultData);
            },
            error: function() {
                alert("Something went wrong");
            }
        });

    });

});
</script>
@endpush