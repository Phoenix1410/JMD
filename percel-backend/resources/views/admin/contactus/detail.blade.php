@extends('admin::layouts.admin_template')
@section('content')

<p>
    <a title="Back" href="{{ route('managecontactus') }}">
        <i class="fa fa-chevron-circle-left"></i> Back To Contact List
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header d-flex align-items-center">
    <h4 class="card-title mb-0 flex-grow-1">
        {{ $page_title }}
    </h4>
</div>

<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered table-striped">
    <tbody>

        <tr>
            <th width="20%">Name</th>
            <td>{{ $row->name }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $row->email }}</td>
        </tr>

        <tr>
            <th>Phone</th>
            <td>{{ $row->phone }}</td>
        </tr>

        <tr>
            <th>Message</th>
            <td style="white-space: pre-line;">
                {{ $row->message }}
            </td>
        </tr>

        <tr>
            <th>Status</th>
            <td>
                @if($row->status == '1')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Submitted At</th>
            <td>{{ \Carbon\Carbon::parse($row->created_at)->timezone('Asia/Kolkata')->format('d-m-Y h:i A') }}</td>
        </tr>

    </tbody>
</table>
</div>

<div class="mt-3">
    <a href="{{ route('managecontactus') }}"
       class="btn btn-secondary">
        Back
    </a>
</div>

</div>
</div>
</div>
</div>

@endsection