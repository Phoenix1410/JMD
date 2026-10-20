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

<div class="card-header">
    <h4 class="card-title">{{ $page_title }}</h4>
</div>

<div class="card-body">

<div class="row">

    <div class="col-md-6 mb-3">
        <label class="fw-bold">Office Type</label>
        <p>{{ $row->type_name ?? '-' }}</p>
    </div>

    <div class="col-md-6 mb-3">
        <label class="fw-bold">Office Name</label>
        <p>{{ $row->office_name ?? '-' }}</p>
    </div>

    <div class="col-md-12 mb-3">
        <label class="fw-bold">Address</label>
        <p>{{ $row->address ?? '-' }}</p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">State</label>
        <p>{{ $row->state_name ?? '-' }}</p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">City</label>
        <p>{{ $row->city_name ?? '-' }}</p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Pincode</label>
        <p>{{ $row->pincode ?? '-' }}</p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Phone</label>
        <p>{{ $row->phone ?? '-' }}</p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Email</label>
        <p>{{ $row->email ?? '-' }}</p>
    </div>

    <div class="col-md-2 mb-3">
        <label class="fw-bold">Sort Order</label>
        <p>{{ $row->sort ?? 0 }}</p>
    </div>

    <div class="col-md-2 mb-3">
        <label class="fw-bold">Status</label>
        <p>
            @if($row->status == 1)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Inactive</span>
            @endif
        </p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Created At</label>
        <p>{{ $row->created_at ?? '-' }}</p>
    </div>

    <div class="col-md-4 mb-3">
        <label class="fw-bold">Updated At</label>
        <p>{{ $row->updated_at ?? '-' }}</p>
    </div>

</div>

<div class="mt-3">
    <a href="{{ route('office') }}" class="btn btn-secondary">
        Back
    </a>

  
</div>

</div>
</div>
</div>
</div>

@endsection