@extends('admin::layouts.admin_template')
@section('content')

<p>
    <a title="Back" href="{{ route('joblist') }}">
        <i class="fa fa-chevron-circle-left"></i>
        &nbsp; Back To Job Listings
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
        <td width="200"><strong>Job Title</strong></td>
        <td>{{ $row->title }}</td>
    </tr>

    <tr>
        <td><strong>Designation</strong></td>
        <td>{{ $row->designation }}</td>
    </tr>

    <tr>
        <td><strong>Experience</strong></td>
        <td>
            {{ $row->min_experience }} - {{ $row->max_experience }} Years
        </td>
    </tr>

    <tr>
        <td><strong>Location</strong></td>
        <td>{{ $row->location }}</td>
    </tr>

    <tr>
        <td><strong>Description</strong></td>
        <td>{!! $row->description !!}</td>
    </tr>

    <tr>
        <td><strong>Created At</strong></td>
        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i A') }}</td>
    </tr>

   

</tbody>

</table>
</div>

</div>
</div>
</div>
</div>

@endsection