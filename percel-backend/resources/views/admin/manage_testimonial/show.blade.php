@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ route('manage-testimonial.index') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Testimonial</a></p>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div>

            <div class="card-body">                
                <div class="row g-3">
                    <div class="table-responsive">
                        <table id="table-detail" class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $row->name }}</td>
                                </tr>
                                <tr>
                                    <td>Designation</td>
                                    <td>{{ $row->designation }}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td>
                                        @if($row->image)
                                        <a data-fancybox="gallery" href="{{asset($row->image)}}">
                                        <img src="{{asset($row->image)}}" style="max-width: 100px; max-height: 100px;">
                                         </a>
                                        @else
                                        --
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Message</td>
                                    <td>{{ $row->message }}</td>
                                </tr>
                                 <tr>
                                    <td>Status </td>
                                    <td>@if($row->status==1) <span class="badge bg-success">Active</span> @else <span class="badge bg-warning">Inactive</span>  @endif</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $row->updated_at?date('d-m-Y', strtotime($row->updated_at)):'--' }}</td>
                                </tr>
                                                                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection