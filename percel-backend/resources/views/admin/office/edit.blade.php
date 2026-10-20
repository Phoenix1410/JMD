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

<form action="{{ route('postUpdateoffice', $row->id) }}" method="post">
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
                        {{ old('office_type_id', $row->office_type_id) == $type->id ? 'selected' : '' }}>
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
                   value="{{ old('office_name', $row->office_name) }}"
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
                      required>{{ old('address', $row->address) }}</textarea>

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
                        {{ old('state', $row->state) == $state->id ? 'selected' : '' }}>
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

                @foreach($cities as $city)
                    <option value="{{ $city->id }}"
                        {{ old('city', $row->city) == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach

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
                   value="{{ old('pincode', $row->pincode) }}">
        </div>
    </div>

    {{-- Phone --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Phone</label>

            <input type="text"
                   class="form-control"
                   name="phone"
                   value="{{ old('phone', $row->phone) }}">
        </div>
    </div>

    {{-- Email --}}
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Email</label>

            <input type="email"
                   class="form-control"
                   name="email"
                   value="{{ old('email', $row->email) }}">
        </div>
    </div>

    {{-- Sort --}}
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label">Sort Order</label>

            <input type="number"
                   class="form-control"
                   name="sort"
                   value="{{ old('sort', $row->sort) }}">
        </div>
    </div>

    {{-- Status --}}
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label">
                Status <span class="text-danger">*</span>
            </label>

            <select name="status" class="form-control" required>
                <option value="1"
                    {{ old('status', $row->status) == 1 ? 'selected' : '' }}>
                    Active
                </option>
                <option value="0"
                    {{ old('status', $row->status) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            @error('status')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>

<div class="row mt-3">
    <div class="col-md-12">

        <a href="{{ route('office') }}"
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
$(document).on('change', '#state_id', function(){

    let state_val = $(this).val();

    if(state_val == ''){
        $('#city_id').html('<option value="">-- Select City --</option>');
        return;
    }

    $.ajax({
        type: "POST",
        url: "{{ url('/city-by-states') }}",
        data: {
            state_id: state_val,
            _token: "{{ csrf_token() }}"
        },
        success: function(response){
            $('#city_id').html(response);
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });

});
</script>
@endpush