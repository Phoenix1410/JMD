@extends('admin::layouts.admin_template')
@section('content')



<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">{{ $page_title }}</h4>
    </div>

    <div class="card-body">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('postbranches') }}" method="POST">
            @csrf

            <div class="row">
                 {{-- Branch Id --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Branch Id <span class="text-danger">*</span></label>
                    <input type="number" name="branch_id"
                           class="form-control"
                           value="{{ old('branch_code') }}"
                           required>
                </div>

                {{-- Branch Name --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Branch Name <span class="text-danger">*</span></label>
                    <input type="text" name="branch_name"
                           class="form-control"
                           value="{{ old('branch_name') }}"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Person <span class="text-danger">*</span></label>
                    <input type="text" name="contactperson"
                           class="form-control"
                           value="{{ old('branch_name') }}"
                           required>
                </div>
                {{-- State --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">State <span class="text-danger">*</span></label>
                    <select name="state_id" class="form-control" required>
                        <option value="">-- Select State --</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                  {{-- Phone --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tel" name="phone"
                           class="form-control"
                            maxlength=10
                           value="{{ old('phone') }}">
                </div>
                {{-- Email --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control"
                           value="{{ old('email') }}">
                </div>
                <!-- branch type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Branch Type</label>
                    <input type="text" name="branch_type"
                           class="form-control"
                           value="{{ old('branch_type') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Google Map Link</label>
                    <input type="text" name="google_link"
                           class="form-control"
                           value="{{ old('google_link') }}">
                </div>
                {{-- Status --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                </div>

                {{-- Address --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea name="address"
                              class="form-control"
                              rows="3"
                              required>{{ old('address') }}</textarea>
                </div>
                {{-- Sort --}}
                <!-- <div class="col-md-6 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort"
                           class="form-control"
                           value="{{ old('sort',0) }}">
                </div> -->

                

            </div>
          
            <div class="mt-3">
                <a href="{{ route('managebranches') }}"
                    class="btn btn-secondary">
                      <i class="fa fa-arrow-left"></i> Back
                </a>
               
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Save Branch
                </button>
            </div>

        </form>

    </div>
</div>

@endsection