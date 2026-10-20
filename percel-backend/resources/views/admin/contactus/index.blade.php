@extends('admin::layouts.admin_template')

@section('content')

<div class="card">

<div class="card-header align-items-center d-flex">

    <h4 class="card-title mb-0 flex-grow-1">
        {{ $page_title }}
    </h4>

    <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">

        {{-- SEARCH --}}
        <form method="get"
              style="display:inline-block;width: 290px;"
              action="{{ route('managecontactus') }}">

            <div class="input-group">

                <input type="text"
                       name="q"
                       value="{{ request()->get('q') }}"
                       class="form-control rounded-0 pull-right"
                       placeholder="Search name, email or phone">

                <div class="input-group-btn">

                    @if(!empty(request()->get('q')))
                    <button type="button"
                            onclick="location.href='{{ route('managecontactus') }}'"
                            title="Reset"
                            class="btn rounded-0 btn-warning">
                        <i class="fa fa-ban"></i>
                    </button>
                    @endif

                    <button type="submit"
                            class="btn rounded-0 btn-primary me-2">
                        <i class="fa fa-search"></i>
                    </button>

                </div>

            </div>

        </form>

        {{-- LIMIT --}}
        <form method="get"
              id="form-limit-paging"
              style="display:inline-block"
              action="{{ route('managecontactus') }}">

            @php $limits =[5,10,20,25,50,100,200]; @endphp

            <div class="input-group">

                <select onchange="$('#form-limit-paging').submit()"
                        name="limit"
                        style="width:56px;"
                        class="form-control input-sm">

                    @foreach($limits as $lmt)
                        <option value="{{ $lmt }}" {{ ($lmt==$limit)?'selected':'' }}>
                            {{ $lmt }}
                        </option>
                    @endforeach

                </select>

            </div>

        </form>

    </div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table align-middle table-nowrap table-hover mb-0">

<thead class="table-blue">

<tr>
    <th width="5%">#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Submitted at</th>
    <th width="10%">Status</th>
    <th width="10%" style="text-align:right">Action</th>
</tr>

</thead>

<tbody>

@if(!empty($rows) && count($rows))

@foreach($rows as $key => $row)

<tr>

<td>
    {{ $rows->firstItem() + $key }}
</td>

<td>
    {{ $row->name }}
</td>

<td>
    {{ $row->email }}
</td>

<td>
    {{ $row->phone }}
</td>
<td>
{{ \Carbon\Carbon::parse($row->created_at)->timezone('Asia/Kolkata')->format('d-m-Y h:i A') }}
</td>

{{-- STATUS --}}
<td>

<form action="{{ route('postUpdatecontactus',$row->id) }}" method="POST">
@csrf

<input type="hidden"
       name="status"
       value="{{ $row->status == '1' ? '0' : '1' }}">

<button type="submit"
        class="btn btn-sm {{ $row->status == '1' ? 'btn-success' : 'btn-danger' }}">
    {{ $row->status == '1' ? 'Active' : 'Inactive' }}
</button>

</form>

</td>

<td style="text-align:right">

<a href="{{ route('managecontactusdetails',$row->id) }}"
   class="btn btn-sm btn-primary"
   title="View">
    <i class="fa fa-eye"></i>
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

<div class="row m-3">

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