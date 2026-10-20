@extends('admin::layouts.admin_template')
@section('content')
<section>
<div class="row project-wrapper">
  <div class="col-xxl-12">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="fw-bold">Welcome {{ AdminHelper::myName() }}</h3>
                <h6 class="fw-normal mb-0">All systems are running smoothly!</h6>
              </div>
              <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white" type="button">
                      <i class="mdi mdi-calendar"></i> Today ({{date('d M Y')}})
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="col-12" >
            <div id="chart">
            </div>
        </div>

        <div class="col-12">
          <div class="admin-pnl-sec">
            <div class="row">
              @if(!empty(AdminHelper::sidebarMenu()))
              @foreach(AdminHelper::sidebarMenu() as $menu)
              @if(empty($menu->children))
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 dashcolumn">
                <a href="{{ ($menu->is_broken)?"javascript:alert('Route Not Found')":((empty($menu->url) || $menu->url=='#')?'#sidebarAdmin'.str_replace(' ','', $menu->name):$menu->url) }}" class="dashboardbox dashbord-bg green">
                  <div class="dashboardicon">
                    <i class="{{($menu->icon)?:'fa fa-th-list'}}"></i>
                  </div>
                  <div class="dashboardcontent">
                    <h4>{{ $menu->name }}<span></span></h4>
                    @if(!empty($menu->sql_query))                    
                    @php $db = DB::select($menu->sql_query); @endphp    
                    <div class="num">{{$db[0]->total}}</div>
                    @endif
                  </div>
                </a>
              </div>
              @else
              @foreach($menu->children as $child)  
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 dashcolumn">
              <a href="{{ $child->url }}" class="dashboardbox dashbord-bg green">
                <div class="dashboardicon">
                  <i class="{{($child->icon)?:'fa fa-th-list'}}"></i>
                </div>
                <div class="dashboardcontent">
                  <h4>{{ $child->name }}<span></span></h4>
                  @if(!empty($child->sql_query))
                  @php $db = DB::select($child->sql_query); @endphp                  
                  <div class="num">{{$db[0]->total}}</div>
                  @endif
                </div>
              </a>
            </div>
            @endforeach
            @endif
            @endforeach
            @endif             
            </div>
          </div>
        </div>

    </div>
  </div>
</div>
</section>
@endsection