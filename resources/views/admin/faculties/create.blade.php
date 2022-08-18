@extends('layout.master')
@section('title','Thêm mới')
@section('content')
@if(session('errors'))
<div class="alert alert-danger">{{$errors['store']->first('name')}}</div>
@endif
{{ Form::open(array('route' => 'faculties.store', 'method' => 'post')) }}
@csrf
<div class="form-group">
    {{Form::label('name', 'Tên khoa', array('class' => 'faculties'))}}
    {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Tên khoa'))}}
</div>
<div>
    <button class="btn btn-primary">Thêm</button>
    <a href="{{route('faculties.list')}}" class="btn btn-success">Quay lại</a>
</div>
{{Form::close()}}
@endsection