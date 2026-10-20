@extends('admin::layouts.admin_template')
@section('content')

<div class="list-grid-nav hstack gap-1 mb-3">
    <div class="selected-action" style="display:inline-block;position:relative;">
        <!-- <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-check-square-o"></i> Bulk Actions</button> -->
        <ul class="dropdown-menu">
            <!-- <li><a class="dropdown-item" href="javascript:void(0)" data-name="delete" title="Delete Selected"><i
                        class="fa fa-trash"></i> Delete Selected</a></li> -->
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="active" title="Active Selected"><i
                        class="fa fa-check"></i> Active Selected</a></li>
            <li><a class="dropdown-item" href="javascript:void(0)" data-name="inactive" title="Inactive Selected"><i
                        class="fa fa-times"></i> Inactive Selected</a></li>

        </ul>
    </div>
    <!-- @if(AdminHelper::isCreate())
    <a href="{{ route('getAddStates') }}?return_url={{ route('getStates') }}"
        id="btn_add_new_data" class="btn btn-primary" title="Add Data">
        <i class="fa fa-plus-circle"></i> Add Data
    </a>
    @endif -->
</div>



<div class="card">
    <div class="card-header align-items-center d-flex">
        <div class="p-0 w-100">
            <div class="row align-items-center">
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                    <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="box-tools pull-right w-100">
                        <div class="row justify-content-end">
                            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
                                <form method="get" style="display:inline-block;width: 100%;" action="{{ route('getStates') }}">
                                    <div class="row">

                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="input-group">
                                                <!-- <select name="country" id="country" class="form-control">
                                                    <option value="">Country</option>
                                                    @foreach($countries as $cnt)
                                                    <option value="{{$cnt->id}}" @if(request()->get('country')==$cnt->id) {{'selected'}} @endif>{{$cnt->name}}</option>
                                                    @endforeach


                                                </select> -->

                                            </div>
                                        </div>


                                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                            <div class="input-group">
                                                <input type="text" name="q" value="{{ request()->get('q') }}" class="form-control rounded-0 pull-right" placeholder="State Name">
                                                <input type="hidden" name="limit" value="@if(request()->get('limit')>0){{request()->get('limit')}}@else{{$limit}}@endif">
                                                <div class="input-group-btn">
                                                    @if(!empty(request()->get('q'))||!empty(request()->get('country')))
                                                    <button type="button" onclick="location.href='{{ route('getStates') }}'" title="Reset" class="btn rounded-0 btn-warning"><i class="fa fa-ban"></i></button>
                                                    @endif
                                                    <button type="submit" class="btn rounded-0 btn-primary me-2"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12">
                                <form method="get" id="form-limit-paging" style="display:inline-block"
                                    action="{{ route('getStates') }}">
                                    @php $limis =[5,10,20,25,50,100,200]; @endphp
                                    <div class="input-group">
                                        <select onchange="$('#form-limit-paging').submit()" name="limit" style="width: 56px;"
                                            class="form-control input-sm">
                                            @foreach($limis as $lmt)
                                            <option value="{{ $lmt }}" {{ ($lmt==$limit)?'selected':'' }}>{{$lmt}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <br style="clear:both">

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- <form id="form-table" method="post" action="{{ route('getStates') }}/action-selected"> -->
                <input type='hidden' name='button_name' value='' />
                @csrf
                <table id="table_dashboard" class="table align-middle table-nowrap table-hover mb-0">
                    <thead class="table-blue">
                        <tr class="active">
                            <th >#</th>
                            <th ><a href="{{ AdminHelper::adminpath()}}/manage-states?filter_column=name&sorting={{(request()->get('filter_column')=='name' && request()->get('sorting')=='asc')?'desc':'asc'}}" title="Click to sort ascending">Name &nbsp; <i class="fa fa-sort"></i></a></th>
                          
                            <th >Status</th>
                            <th>Images</th>
                            <th style="text-align:right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($rows) && count($rows))
                        @foreach($rows as $key=>$data)
                        <tr>
                            <td>{{ $rows->firstItem() + $key }}</td>
                            <td>{{ $data->name }}</td>
                            
                           <td>
                                <form action="{{ route('manage-states.status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="hidden"
                                    name="status"
                                    value="{{ $data->status == '1' ? '0' : '1' }}">

                                <button type="submit"
                                        class="btn btn-sm {{ $data->status == '1' ? 'btn-success' : 'btn-danger' }}">
                                    {{ $data->status == '1' ? 'Active' : 'Inactive' }}
                                </button>
                                </form>
                            </td>
                             <td>
                                @if(!empty($data->image))
                                  <img src="{{ asset('uploads/states/'.$data->image) }}" width="80" />
                                @else
                                    
                                     <img src="https://cdn-icons-png.flaticon.com/512/97/97706.png" width="80" />
                                @endif
                            </td>
                            <td>
                                <div class="button_action" style="text-align:right">
                                    @if(AdminHelper::isRead())
                                    <a class="btn btn-sm btn-primary btn-detail" title="Detail Data" href="{{ route('getStates') }}/detail/{{$data->id}}?return_url={{ AdminHelper::adminpath()}}/states"><i class="fa fa-eye"></i></a>
                                    @endif
                                    @if(AdminHelper::isUpdate())
                                    <a class="btn btn-sm btn-success btn-edit" title="Edit Data" href="{{ route('getStates') }}/edit/{{$data->id}}?return_url={{ AdminHelper::adminpath()}}/states"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    @if(AdminHelper::isDelete())
                                    <a class="btn btn-sm btn-warning btn-delete" title="Delete" href="javascript:;" onclick="Swal.fire({
                                    title: 'Are you sure ?',   
                                    text: 'You will not be able to recover this record data!',  
                                    icon: 'warning',
                                    showCancelButton: !0,
                                    confirmButtonText: 'Yes, delete it!',
                                    cancelButtonText: 'No, cancel!',
                                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                                    buttonsStyling: !1,
                                    showCloseButton: !0,
                                }).then(function (t) {
                                    t.isConfirmed?location.href='{{ route('getStates') }}/delete/{{$data->id}}':'' });">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" style="text-align:center"><i class="fa fa-search"></i> No Data Avaliable</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

            <!-- </form> -->
            <!--END FORM TABLE-->
            <!-- <div class="col-md-4"><span class="pull-right">Total rows
                    : 1 to 3 of 3</span></div> -->

        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <span>Total rows : {{ $rows->total() }}</span>
            </div>
            <div class="col-md-8">
                <div class="pull-right">{!! $rows->withQueryString()->links('pagination::bootstrap-4') !!} </div>
            </div>
        </div>
    </div>


</div>

@endsection

@push('bottom')
<script type="text/javascript">
    $(document).ready(function() {
        $('#country').select2();


    });
</script>
@endpush