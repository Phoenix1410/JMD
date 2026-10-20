@extends('admin::layouts.admin_template')
@section('content')

<!-- <div class="list-grid-nav hstack gap-1 mb-3">
    <div class="selected-action" style="display:inline-block;position:relative;">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fa fa-check-square-o"></i> Bulk Actions
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="active">
                <i class="fa fa-check"></i> Active Selected</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="inactive">
                <i class="fa fa-times"></i> Inactive Selected</a></li>
        </ul>
    </div>

    <a href="{{ route('addaboutus') }}" class="btn btn-primary">
        <i class="fa fa-plus-circle"></i> Add About Us
    </a>
</div> -->


<div class="card">
    <div class="card-header d-flex">
        <h4 class="card-title mb-0 flex-grow-1">About Us List</h4>

        <div style="position: relative;margin-top: -5px;margin-right: -10px">   

            <!-- Search -->
            <form method="get" style="display:inline-block;width: 290px;"
                action="{{ route('manageaboutus') }}">
                <div class="input-group">
                    <input type="text" name="q" value="{{ request()->get('q') }}"
                        class="form-control rounded-0" placeholder="Search content">

                    <div class="input-group-btn">
                        @if(!empty(request()->get('q')))
                        <button type="button"
                            onclick="location.href='{{ route('manageaboutus') }}'"
                            class="btn btn-warning">
                            <i class="fa fa-ban"></i>
                        </button>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-hover">
                <thead class="table-blue">
                    <tr>
                        <!-- <th width="3%"><input type="checkbox" id="checkall"></th>
                        <th></th> -->
                        <!-- <th>Content</th> -->
                        <th>Fleet</th>
                        <th>Network</th>
                        <th>Delivery</th>
                        <th style="text-align:right">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(!empty($data) && count($data))
                        @foreach($data as $row)
                        <tr>
                            <!-- <td>
                                <input type="checkbox" value="{{ $row->id }}">
                            </td>

                            <td>{{ \Illuminate\Support\Str::limit($row->content, 50) }}</td> -->

                            <td>{{ $row->fleet_name }}</td>
                            <td>{{ $row->network_name }}</td>
                            <td>{{ $row->delivery_name }}</td>

                            <td style="text-align:right">
                                <a class="btn btn-sm btn-info"
                                   href="{{ route('getDetailaboutus', $row->id) }}">
                                   <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-sm btn-success"
                                   href="{{ route('getEditaboutus', $row->id) }}">
                                   <i class="fa fa-pencil"></i>
                                </a>

                                <a class="btn btn-sm btn-danger"
                                   href="javascript:;"
                                   onclick="Swal.fire({
                                        title: 'Are you sure?',
                                        text: 'This will delete the record!',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes, delete it!'
                                   }).then((result) => {
                                        if(result.isConfirmed){
                                            window.location.href='{{ route('deleteManageaboutus', $row->id) }}';
                                        }
                                   });">
                                   <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" style="text-align:center">
                                <i class="fa fa-search"></i> No Data Available
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>

        <!-- Pagination -->
        <div class="row mt-3">
            <div class="col-md-4">
                <span>Total rows : {{ count($data) }}</span>
            </div>
        </div>

    </div>
</div>

@endsection