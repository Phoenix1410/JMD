@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ route('manage-banner.index') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage Banner</a></p>
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
                                    <td>Title</td>
                                    <td>{{ $row->title }}</td>
                                </tr>
                                <tr>
                                    <td>Sub Title</td>
                                    <td>{{ $row->sub_title }}</td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>
                                    <td>{{ $row->short_description??'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td>
                                        @if($row->image)
                                        <a data-fancybox="gallery" href="{{asset($row->image)}}">
                                        <img src="{{asset($row->image)}}" style="max-width: 50px; max-height: 100px;">
                                        </a>
                                        @else
                                        --
                                        @endif
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>Button Link</td>
                                    <td>{{ $row->url??'--' }}</td>
                                </tr> -->
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
                                    <td>{{ $row->updated_at?date('d-m-Y', strtotime($row->updated_at)):'N/A' }}</td>
                                </tr>
                                                                   
                            </tbody>
                            </table>
                        </div>
                    </div>               

                </form>

            </div>
        </div>
    </div>
</div>
@endsection