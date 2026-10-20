@extends('admin::layouts.admin_template')
@section('content')
<div class="list-grid-nav hstack gap-1 mb-3">    
    @if(AdminHelper::isCreate())
    <a href="{{ route('manage-services.create') }}?return_url={{ route('manage-services.index') }}"
        id="btn_add_new_data" class="btn btn-primary" title="Add Data">
        <i class="fa fa-plus-circle"></i> Add Data
    </a>
    @endif
</div>
<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
        <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">   
            <form method="get" style="display:inline-block;width: 290px;" action="{{ route('manage-services.index') }}">
                <div class="input-group">
                    <input type="text" name="q" value="{{ request()->get('q') }}" class="form-control rounded-0 pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        @if(!empty(request()->get('q')))
                        <button type="button" onclick="location.href='{{ route('manage-services.index') }}'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                        @endif
                        <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>


            <form method="get" id="form-limit-paging" style="display:inline-block"
                action="{{ route('manage-services.index') }}">
                @php $limits =[5,10,20,25,50,100,200]; @endphp
                <div class="input-group">
                    <select onchange="$('#form-limit-paging').submit()" name="limit" style="width: 56px;"
                        class="form-control input-sm">
                        @foreach($limits as $lmt)
                            <option value="{{ $lmt }}" {{ ($lmt==$limit)?'selected':'' }}>{{$lmt}}</option>
                        @endforeach
                    </select>
                </div>
            </form>

        </div>

        <br style="clear:both">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                <thead class="table-blue">
                    <tr class="active">
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th width="auto" style="text-align:center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($rows) && count($rows))
                    @foreach($rows as $key=>$data)
                    <tr>
                        <td>{{ $rows->firstItem() + $key }}</td>
                        <td>{{ $data->title }}</td>
                        <td>
                            @if($data->image)
                            <a data-fancybox="gallery" href="{{asset($data->image)}}">
                            <img src="{{asset($data->image)}}" style="max-width: 50px; max-height: 100px;">
                            </a>
                            @else
                            --
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('manage-services.status',$data->id) }}"
                                  method="get">
                                @csrf
                                {{-- Required fields for validation --}}
                                
                                <input type="hidden" name="status"
                                       value="{{ $data->status == 1 ? 0 : 1 }}">

                                <button type="submit"
                                    class="btn btn-sm 
                                    {{ $data->status == 1 ? 'btn-success' : 'btn-danger' }}">
                                    {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="button_action" style="text-align:center">
                            @if(AdminHelper::isRead())
                            <a class="btn btn-sm btn-primary btn-detail" title="Detail Data" href="{{ route('manage-services.show', $data->id) }}?return_url={{ route('manage-services.index') }}"><i class="fa fa-eye"></i></a>
                            @endif
                            @if(AdminHelper::isUpdate())
                            <a class="btn btn-sm btn-success btn-edit" title="Edit Data" href="{{ route('manage-services.edit', $data->id) }}?return_url={{ route('manage-services.index') }}"><i class="fa fa-pencil"></i></a>
                            @endif           

                            @if(AdminHelper::isDelete())
                            <a href="javascript:void(0);"
                               class="btn btn-sm btn-warning btn-delete"
                               title="Delete"
                               data-id="{{ $data->id }}">
                               <i class="fa fa-trash"></i>
                            </a>
                            <form id="delete-form-{{ $data->id }}"
                                  action="{{ route('manage-services.destroy', $data->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif

                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8" style="text-align:center"><i class="fa fa-search"></i> No Data Available</td>
                    </tr>
                    @endif                        
                </tbody>
            </table>
        </div>
    </div>
    <div class="row m-3">
            <div class="col-md-10">
                <span>Total rows : {{ $rows->total() }}</span>
            </div>

            <div class="col-md-2 text-end">
                {!! $rows->withQueryString()->links('pagination::bootstrap-4') !!}
            </div>
        </div>
</div>
@endsection