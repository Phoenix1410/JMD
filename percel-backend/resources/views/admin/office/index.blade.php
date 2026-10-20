@extends('admin::layouts.admin_template')
@section('content')

<div class="list-grid-nav hstack gap-1 mb-3">

    <a href="{{ route('addoffice') }}" 
        class="btn btn-primary" title="Add Office">
        <i class="fa fa-plus-circle"></i> Add Office
    </a>

</div>

<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>

        <div class="box-tools pull-right">

            {{-- Search --}}
            <form method="get" style="display:inline-block;width: 250px;"
                action="{{ route('office') }}">

                <div class="input-group">
                    <input type="text" name="q" 
                        value="{{ request()->get('q') }}"
                        class="form-control rounded-0"
                        placeholder="Search Office">

                    <div class="input-group-btn">
                        @if(request()->get('q'))
                        <button type="button"
                            onclick="location.href='{{ route('office') }}'"
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
                action="{{ route('office') }}">

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
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Office Name</th>
                        <th>Office Type</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th width="170">Action</th>
                    </tr>
                </thead>

                <tbody>
                @if($rows->count())
                    @foreach($rows as $key => $row)
                    <tr>
                        <td>{{ $rows->firstItem() + $key }}</td>

                        <td>{{ $row->office_name }}</td>
                        <td>{{ $row->type_name }}</td>
                        <td>{{$row->state}}</td>
                        <td>{{ $row->city }}</td>
                        <td>{{ $row->phone }}</td>

                        {{-- STATUS TOGGLE --}}
                        <td>
                            <form action="{{ route('postUpdateoffice',$row->id) }}"
                                  method="POST">
                                @csrf

                                {{-- keep required fields for validation --}}
                                <input type="hidden" name="office_type_id" value="{{ $row->office_type_id }}">
                                <input type="hidden" name="office_name" value="{{ $row->office_name }}">
                                <input type="hidden" name="address" value="{{ $row->address }}">
                                <input type="hidden" name="status"
                                       value="{{ $row->status == 1 ? 0 : 1 }}">

                                <span type="submit"
                                    class="btn btn-sm 
                                    {{ $row->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                    {{ $row->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </form>
                        </td>

                        <td>

                            <a class="btn btn-sm btn-primary"
                                href="{{ route('getDetailoffice',$row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-success"
                                href="{{ route('getEditoffice',$row->id) }}">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <a class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure to delete?')"
                                href="{{ route('deleteManageoffice',$row->id) }}">
                                <i class="fa fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">
                            No Data Available
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <span>Total rows : {{ $rows->total() }}</span>
            </div>

            <div class="col-md-8 text-end">
                {!! $rows->withQueryString()->links('pagination::bootstrap-4') !!}
            </div>
        </div>

    </div>
</div>

@endsection