@extends('layout.master')
@section('title','Danh sách sinh viên')
@section('content')
{{Form::open(array('route'=>'students.store','method'=>'post','enctype'=>'multipart/form-data'))}}
@if(session('errors'))
<div class="alert alert-danger">{{$errors['store']->first('name')}}</div>
@endif
@csrf
<div class="form-group">
    {{Form::label('name','Tên học sinh',array('class'=>'students'))}}
    {{Form::text('name','',array('class'=>'form-control'))}}

</div>
<div class="form-group">
    {{Form::label('avatar','Ảnh đại diện',array('class'=>'students'))}}
    <input type="file" name="avatar" class="form-control">
</div>
<div class="form-group">
    <label for="">Email</label>
    <input type="text" name="email" class="form-control">
</div>
<div class="form-group">
    <label for="">Khoa</label>
    <select name="faculty_id" id="" class="form-control">
        @foreach($faculty as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>

</div>
<div class="form-group">
    <label for="">Địa chỉ</label>
    <input type="text" name="address" class="form-control">
</div>
<div class="form-group">
    <label for="">Năm sinh</label>
    <input type="date" name="birthday" class="form-control">
</div>
<div class="form-group">
    <label for="">Số điện thoại</label>
    <input type="text" name="phone" class="form-control">
</div>
<div class="form-group">
    <label for="">Giới tính</label>
    <input type="radio" name="gender" value="0">Nam
    <input type="radio" name="gender" value="1">Nữ
</div>
<div>
    <button class="btn btn-primary">Thêm</button>
</div>

{{Form::close()}}
@endsection