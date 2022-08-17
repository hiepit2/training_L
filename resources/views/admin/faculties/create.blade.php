@extends('layout.master')
@section('title','Thêm mới')
@section('content')
<form action="{{route('faculties.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div>
        <button class="btn btn-primary">Thêm</button>
    </div>

</form>
@endsection
