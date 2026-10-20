@extends('admin::layouts.admin_template')
@section('content')

<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>

        <div class="box-tools pull-right">

            {{-- Search --}}
            <form method="get" style="display:inline-block;width: 250px;"
                action="{{ route('jobPosts') }}">

                <div class="input-group">
                    <input type="text" name="q" 
                        value="{{ request()->get('q') }}"
                        class="form-control rounded-0"
                        placeholder="Search Applicant / Email">

                    <div class="input-group-btn">
                        @if(request()->get('q'))
                        <button type="button"
                            onclick="location.href='{{ route('jobPosts') }}'"
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
                action="{{ route('jobPosts') }}">

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

                        <th>
                            <a href="{{ route('jobPosts') }}?filter_column=applicant_name&sorting={{ request()->get('sorting')=='asc'?'desc':'asc' }}">
                                Applicant Name <i class="fa fa-sort"></i>
                            </a>
                        </th>

                        <th>Email</th>
                        <th>Phone</th>
                        <th>Description</th>
                        <th>CV</th>

                        <th>
                            <a href="{{ route('jobPosts') }}?filter_column=created_at&sorting={{ request()->get('sorting')=='asc'?'desc':'asc' }}">
                                Applied At <i class="fa fa-sort"></i>
                            </a>
                        </th>
                        <th width="120">Action</th>

                    </tr>
                </thead>

                <tbody>

                @if($rows->count())

                    @foreach($rows as $key => $row)

                    <tr>

                        <td>{{ $rows->firstItem() + $key }}</td>

                        <td>{{ $row->applicant_name }}</td>

                        <td>{{ $row->email }}</td>

                        <td>{{ $row->phone_number }}</td>

                       <td>{{ $row->description ? Str::limit($row->description,50) : '--' }}</td>

                        {{-- CV Download --}}
                        <td>

                            @if($row->cv)

                                <a href="{{ asset($row->cv) }}" 
                                   class="btn btn-sm btn-primary"
                                   download>

                                   <i class="fa fa-download"></i> Download

                                </a>

                            @else

                                -

                            @endif

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y h:i A') }}

                        </td>
                        <td>
                            <a href="{{ route('getDetailjobPosts',$row->id) }}"
                            class="btn btn-sm btn-info">
                            <i class="fa fa-eye"></i> View
                            </a>
                        </td>
                    </tr>

                    @endforeach

                @else

                    <tr>
                        <td colspan="7" class="text-center">
                            No Applications Found
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