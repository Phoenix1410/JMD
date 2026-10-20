@extends('admin::layouts.admin_template')
@section('content')

<p>
    <a title="Back" href="{{ route('jobPosts') }}">
        <i class="fa fa-chevron-circle-left"></i>
        &nbsp; Back To Applications List
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
    <td width="200"><strong>Applicant Name</strong></td>
    <td>{{ $row->applicant_name }}</td>
</tr>

<tr>
    <td><strong>Email</strong></td>
    <td>{{ $row->email }}</td>
</tr>

<tr>
    <td><strong>Phone Number</strong></td>
    <td>{{ $row->phone_number }}</td>
</tr>

<tr>
    <td><strong>Description</strong></td>
    <td>{{ $row->description ?? '-' }}</td>
</tr>

<tr>
    <td><strong>CV</strong></td>
    <td>

        @if($row->cv)

        <a href="{{ asset($row->cv) }}" 
           class="btn btn-primary"
           download>

            <i class="fa fa-download"></i> Download CV

        </a>

        @else

        -

        @endif

    </td>
</tr>

<tr>
    <td><strong>Applied At</strong></td>
    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i A') }}</td>
</tr>

<tr>
    <td><strong>Updated At</strong></td>
    <td>{{ \Carbon\Carbon::parse($row->updated_at ?? '-' )->format('d-m-Y h:i A') }}</td>
</tr>

</tbody>
</table>
</div>

</div>
</div>
</div>
</div>

@endsection