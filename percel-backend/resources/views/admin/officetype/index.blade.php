@extends('admin::layouts.admin_template')
@section('content')

<div class="list-grid-nav hstack gap-1 mb-3">

    <a href="{{ route('addofficetype') }}" 
        class="btn btn-primary" title="Add Office Type">
        <i class="fa fa-plus-circle"></i> Add Office Type
    </a>

</div>

<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>

        <div class="box-tools pull-right">

            {{-- Search --}}
            <form method="get" style="display:inline-block;width: 250px;"
                action="{{ route('officetype') }}">

                <div class="input-group">
                    <input type="text" name="q" 
                        value="{{ request()->get('q') }}"
                        class="form-control rounded-0"
                        placeholder="Search Office Type">

                    <div class="input-group-btn">
                        @if(request()->get('q'))
                        <button type="button"
                            onclick="location.href='{{ route('officetype') }}'"
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
                action="{{ route('officetype') }}">

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
                        <th>Office Type</th>
                        <th>Status</th>
                        <th width="170">Action</th>
                    </tr>
                </thead>

                <tbody>
                @if($rows->count())
                    @foreach($rows as $key => $row)
                    <tr>
                        <td>{{ $rows->firstItem() + $key }}</td>

                        <td>{{ $row->type_name }}</td>

                        {{-- STATUS TOGGLE --}}
                        <td>
                            <form action="{{ route('postUpdateofficetype',$row->id) }}"
                                  method="POST">
                                @csrf

                                <input type="hidden" 
                                       name="type_name" 
                                       value="{{ $row->type_name }}">

                                <input type="hidden"
                                       name="status"
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
                                href="{{ route('getDetailofficetype',$row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-success"
                                href="{{ route('getEditofficetype',$row->id) }}">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <a class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure to delete?')"
                                href="{{ route('deleteManageofficetype',$row->id) }}">
                                <i class="fa fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">
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