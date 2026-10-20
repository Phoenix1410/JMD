@extends('admin::layouts.admin_template')
@section('content')
<p><a title="Main Module" href="{{ route('testmodule.index') }}"><i class="fa fa-chevron-circle-left "></i> &nbsp; Back To List Data TestModule</a></p>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div> 

            <div class="card-body">
            <form action="{{ route('testmodule.update', $row->id) }}" method="post" enctype="multipart/form-data"> 
                @csrf
                <input type="hidden" name="return_url" value="{{ route('testmodule.index') }}">
                <div class="row">
                    <div class="col-md-12">
                                           
                    </div>
                </div>
                <div class="row g-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                                <a href="{{ route('testmodule.index') }}" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
                                <input type="submit" name="submit" value="Save" class="btn btn-primary">                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection