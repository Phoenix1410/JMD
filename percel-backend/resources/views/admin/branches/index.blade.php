@extends('admin::layouts.admin_template')
@section('content')

<div class="list-grid-nav hstack gap-1 mb-3">

    <a href="{{ route('addbranches') }}" 
        class="btn btn-primary" title="Add Branch">
        <i class="fa fa-plus-circle"></i> Add Branch
    </a>

</div>
<div class="card mb-3">
    <div class="card-header">
        <b>Upload Branch CSV</b>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('uploadBranchCsv') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label>Select State</label>
                    <select name="state_id" class="form-control" required>
                        <option value="">--Select State--</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Upload CSV</label>
                    <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                </div>
                <div class="col-md-4 mt-4">
                    <button class="btn btn-success">
                        Upload CSV
                    </button>
                    <a href="{{ route('downloadBranchSample') }}"
                       class="btn btn-info">
                        Download Sample
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
        <div class="box-tools pull-right">
            {{-- Search --}}
            <form method="get" style="display:inline-block;width: 515px;"
                action="{{ route('managebranches') }}">
                <input type="hidden" name="limit" value="{{request()->get('limit')}}">
                <div class="input-group">
                   <div class="select-box mx-2">
                    <select name="state_id" class="form-control custom-select" >
                        <option value="">--Select State--</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}"
                            {{ $selectedstate && $state->id == $selectedstate->id ? 'selected' : '' }}>
                            {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                    <input type="text" name="q" 
                        value="{{ request()->get('q') }}"
                        class="form-control rounded-0"
                        placeholder="Search Branch">
                    <div class="input-group-btn">
                        @if(request()->get('q') ||request()->get('state_id'))
                        <button type="button"
                            onclick="location.href='{{ route('managebranches') }}'"
                            class="btn btn-warning rounded-0">
                            <i class="fa fa-ban"></i>
                        </button>
                        @endif

                        <button type="submit"
                            class="btn btn-primary rounded-0">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            {{-- Limit --}}
            <form method="get" id="form-limit-paging"
                style="display:inline-block"
                action="{{ route('managebranches') }}">
               
                <input type="hidden" name="state_id" value="{{ request()->get('state_id') }}">
                 <input type="hidden" name="q" value="{{ request()->get('q') }}">
                @php $limits =[5,10,20,25,50,100]; @endphp
                <select onchange="$('#form-limit-paging').submit()"
                        name="limit"
                        class="form-control input-sm"
                        style="width:80px; display:inline-block;">

                    @foreach($limits as $lmt)
                        <option value="{{ $lmt }}"
                            {{ ($lmt==$limit)?'selected':'' }}>
                            {{ $lmt }}
                        </option>
                    @endforeach
                </select>

            </form>

        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table align-middle table-bordered table-hover">
              <thead class="table-blue">
                 <tr>
                    <th>#</th>
                    <th >
                    <a href="{{ request()->fullUrlWithQuery([
                    'filter_column'=>'b.branch_code',
                    'sorting'=> (request('filter_column')=='b.branch_code' && request('sorting')=='asc')?'desc':'asc'
                    ]) }}">
                    Branch Code
                    <i class="fa {{ (request('filter_column')=='b.branch_code' && request('sorting')=='asc') ? 'fa-sort-up' : 'fa-sort-down' }}"></i>
                    </a>
                    </th>

                    <th>
                    Branch Name
                    </th>

                    <th>
                    State
                    </th>

                    <th>
                    Phone
                    </th>

                    <th>Address</th>

                    <th>
                    Email
                    </th>
                    <th>Status</th>
                    <th width="170">Action</th>
                 </tr>
                </thead>

                <tbody>
                @if($rows->count())
                    @foreach($rows as $key => $row)
                    <tr>
                        <td>{{ $rows->firstItem() + $key }}</td>
                        <td >{{ $row->branch_code }}</td>
                        <td>{{ $row->branch_name }}</td>
                        <td>{{ $row->state_name ?? '-' }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{$row->address}}</td>
                        <td>{{ $row->email_address }}</td>
                        {{-- STATUS TOGGLE --}}
                        <td>
                            <form action="{{ route('manage-branches.status') }}"
                                  method="POST">
                                @csrf

                                {{-- Required fields for validation --}}
                                <input type="hidden" name="id" value="{{ $row->id}}">
                                <input type="hidden" name="status"
                                       value="{{ $row->status == 1 ? 0 : 1 }}">

                                <button type="submit"
                                    class="btn btn-sm 
                                    {{ $row->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                    {{ $row->status == 1 ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>

                        <td>

                            <a class="btn btn-sm btn-primary"
                                href="{{ route('getDetailbranches',$row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-success"
                                href="{{ route('getEditbranches',$row->id) }}">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <a class="btn btn-sm btn-danger"
                                onclick="event.preventDefault(); 
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: 'You will not be able to recover this record!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, delete it!',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location.href = this.href;
                                    }
                                });"
                                href="{{ route('deleteManagebranches',$row->id) }}">
                                <i class="fa fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center">
                            No Data Available
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>

        <div class="row mt-3">
            <div class="col-md-9">
                <span>Total rows : {{ $rows->total() }}</span>
            </div>

            <div class="col-md-3 text-end">
                {!! $rows->withQueryString()->links('pagination::bootstrap-4') !!}
            </div>
        </div>

    </div>
</div>

@endsection