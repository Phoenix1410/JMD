@extends('admin::layouts.admin_template')
@section('content')

<p>
    <a title="Back" href="{{ route('managenewsroll') }}">
        <i class="fa fa-chevron-circle-left"></i>
        &nbsp; Back To News List
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
        <td width="200"><strong>Heading</strong></td>
        <td>{{ $row->heading }}</td>
    </tr>

    <tr>
        <td><strong>Author Name</strong></td>
        <td>{{ $row->author_name ?? '-' }}</td>
    </tr>

    <tr>
        <td><strong>Meta Title</strong></td>
        <td>{{ $row->meta_title ?? '-' }}</td>
    </tr>

    <tr>
        <td><strong>Sort Order</strong></td>
        <td>{{ $row->sort }}</td>
    </tr>
    <tr>
        <td><strong>Images</strong></td>
        <td><a href="{{asset($row->image) }}" data-fancybox="gallery" ><img src="{{asset($row->image) }}" alt=""></a></td>
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
        <td><strong>Content</strong></td>
        <td>{!! $row->content !!}</td>
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

</div>
</div>
</div>
</div>

@endsection