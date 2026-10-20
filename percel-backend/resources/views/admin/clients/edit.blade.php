@extends('admin::layouts.admin_template')
@section('content')

<p>
    <a title="Back" href="{{ route('manageclient') }}">
        <i class="fa fa-chevron-circle-left"></i> Back To Clients
    </a>
</p>

<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-header align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">{{ $page_title }}</h4>
</div>

<div class="card-body">

<form action="{{ route('postUpdateclients',$row->id) }}"  method="post" enctype="multipart/form-data">
@csrf

<input type="hidden" name="id" value="{{ $row->id }}">

<div class="row">

{{-- Title --}}
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">
Client Title <span class="text-danger">*</span>
</label>

<input type="text"
class="form-control"
name="title"
value="{{ old('title',$row->title) }}"
required>

</div>
</div>


{{-- Image --}}
<div class="col-md-6">
<div class="mb-3">
<label class="form-label">
Client Image
</label>

<input type="file"
class="form-control"
name="image"
accept="image/*">

<br>

@if($row->image)
<img src="{{ asset($row->image) }}" width="120">
@endif

</div>
</div>


{{-- Status --}}
<div class="col-md-6">
<div class="mb-3">

<label class="form-label">
Status
</label>

<select class="form-control" name="status">

<option value="1" {{ $row->status==1 ? 'selected':'' }}>
Active
</option>

<option value="0" {{ $row->status==0 ? 'selected':'' }}>
Inactive
</option>

</select>

</div>
</div>

</div>

<div class="row">
<div class="col-md-12">

<a href="{{ route('manageclient') }}" class="btn btn-secondary">
Back
</a>

<button type="submit" class="btn btn-primary">
Update
</button>

</div>
</div>

</form>

</div>
</div>
</div>
</div>

@endsection