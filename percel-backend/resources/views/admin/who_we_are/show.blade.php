@extends('admin::layouts.admin_template')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header card-primary align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
                <div class="flex-shrink-0">
                </div>
            </div>

            <div class="card-body">                
                    <div class="row g-3">
                        <div class="table-responsive">
                            <table id="table-detail" class="table table-striped">
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>               

                </form>

            </div>
        </div>
    </div>
</div>
@endsection