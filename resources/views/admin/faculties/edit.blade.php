@extends('layout.master')
@section('title','Cập nhật')
@section('content')
@if(session('errors'))
<div class="alert alert-danger">{{$errors->first('name')}}</div>
@endif
{{Form::open(array('route' => array('faculties.update', $faculty), 'method' => 'post'))}}
@csrf
@method('PUT')
<div class="form-group">
    {{Form::label('name', 'Tên khoa', array('class' => 'faculties'))}}
    {{Form::text('name' ,$faculty->name,array('class'=>'form-control'))}}

</div>
<div>
    <button class="btn btn-primary">Update</button>
    <a href="{{route('faculties.list')}}" class="btn btn-success">Quay về</a>
</div>
{{Form::close()}}
</form>
@endsection