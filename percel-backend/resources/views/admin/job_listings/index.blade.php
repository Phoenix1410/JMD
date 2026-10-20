@extends('admin::layouts.admin_template')
@section('content')

<div class="list-grid-nav hstack gap-1 mb-3">

    <a href="{{ route('addnewsroll') }}" 
        class="btn btn-primary" title="Add News">
        <i class="fa fa-plus-circle"></i> Add News
    </a>

</div>

<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>

        <div class="box-tools pull-right">

            {{-- Search --}}
            <form method="get" style="display:inline-block;width: 250px;"
                action="{{ route('managenewsroll') }}">

                <div class="input-group">
                    <input type="text" name="q" 
                        value="{{ request()->get('q') }}"
                        class="form-control rounded-0"
                        placeholder="Search Heading / Author">

                    <div class="input-group-btn">
                        @if(request()->get('q'))
                        <button type="button"
                            onclick="location.href='{{ route('managenewsroll') }}'"
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
                action="{{ route('managenewsroll') }}">

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
                <thead  class="table-blue">
                    <tr>
                        <th>#</th>

                        <th>
                            <a href="{{ route('managenewsroll') }}?filter_column=heading&sorting={{ request()->get('sorting')=='asc'?'desc':'asc' }}">
                                Heading <i class="fa fa-sort"></i>
                            </a>
                        </th>

                        <th>Author</th>
                        <th>Meta Title</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                @if($rows->count())
                    @foreach($rows as $key => $row)
                    <tr>
                        <td>{{ $rows->firstItem() + $key }}</td>
                        <td>{{ $row->heading }}</td>
                        <td>{{ $row->author_name ?? '-' }}</td>
                        <td>{{ $row->meta_title ?? '-' }}</td>
                        <td>{{ $row->sort }}</td>

                        <td>
                                <form action="{{ route('manage-newsrolls.status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$row->id}}">
                                <input type="hidden"
                                    name="status"
                                    value="{{ $row->status == '1' ? '0' : '1' }}">

                                <button type="submit"
                                        class="btn btn-sm {{ $row->status == '1' ? 'btn-success' : 'btn-danger' }}">
                                    {{ $row->status == '1' ? 'Active' : 'Inactive' }}
                                </button>

                                </form>
                            </td>

                        <td>

                            <a class="btn btn-sm btn-primary"
                                href="{{ route('getDetailnewsroll',$row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-success"
                                href="{{ route('getEditnewsroll',$row->id) }}">
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
                                href="{{ route('deleteManagenewsroll',$row->id) }}">
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