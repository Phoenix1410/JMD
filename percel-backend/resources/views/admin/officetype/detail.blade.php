@extends('admin::layouts.admin_template')
@section('content')

<p>
    <a title="Back" href="{{ route('officetype') }}">
        <i class="fa fa-chevron-circle-left"></i>
        &nbsp; Back To Office Type List
    </a>
</p>

<div class="row">
<div class="col-lg-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
</div>

<div class="card-body">

<div class="table-responsive">
<table class="table table-striped table-bordered">

<tbody>

    <tr>
        <td width="200"><strong>Office Type Name</strong></td>
        <td>{{ $row->type_name }}</td>
    </tr>

    <tr>
        <td><strong>Status</strong></td>
        <td>
            @if($row->status == 1)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Inactive</span>
            @endif
        </td>
    </tr>

    <tr>
        <td><strong>Created At</strong></td>
        <td>{{ $row->created_at }}</td>
    </tr>

    <tr>
        <td><strong>Updated At</strong></td>
        <td>{{ $row->updated_at }}</td>
    </tr>

</tbody>
</table>
</div>

<div class="mt-3">
    <a href="{{ route('officetype') }}"
       class="btn btn-secondary">
       Back
    </a>

    <a href="{{ route('getEditofficetype', $row->id) }}"
       class="btn btn-primary">
       Edit
    </a>
</div>

</div>
</div>
</div>
</div>

@endsection