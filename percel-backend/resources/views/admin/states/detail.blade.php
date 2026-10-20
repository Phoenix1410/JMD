@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ route('getStates') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data Manage States</a></p>

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
                                        <td>Country Name</td>
                                        <td>{{ $country->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $row->name }}</td>
                                    </tr>
                                    <tr>
                                    <td>Image</td>
                                    <td>
                                        @if(!empty($row->image))
                                        <a data-fancybox="gallery" href="{{asset('uploads/states/'.$row->image)}}">
                                            <img src="{{ asset('uploads/states/'.$row->image) }}" 
                                                alt="State Image" 
                                                width="120" 
                                                class="img-thumbnail">
                                        </a>
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>@if($row->status==1) <span class="badge bg-success">Active</span>@else<span class="badge bg-danger">Inactive</span>@endif</td>
                                    </tr>  
                                                                       
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->                  

                </form>

            </div>
        </div>
    </div>
    <!--END AUTO MARGIN-->

</div>
@endsection