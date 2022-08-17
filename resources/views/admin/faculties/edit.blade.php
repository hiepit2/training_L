@extends('layout.master')
@section('title','Cập nhật')
@section('content')
<form action="{{route('faculties.update',$faculty)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" class="form-control" value="{{$faculty->name}}">
    </div>
    <div>
        <button class="btn btn-primary">Update</button>
    </div>

</form>
@endsection