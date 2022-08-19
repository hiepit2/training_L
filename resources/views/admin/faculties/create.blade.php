@extends('layout.master')
@section('title','Thêm mới')
@section('content')

@if(isset($id))
{{Form::model($faculty, array('route' => array('faculties.update', $faculty), 'method' => 'put'))}}
@else
{{ Form::model($faculty, array('route' => 'faculties.store', 'method' => 'post')) }}
@endif
<div class="form-group">
    {{Form::label('name', 'Faculty name', array('class' => 'faculties'))}}
    @if(isset($id))
    {{ Form::text('name', $faculty->name, array('class' => 'form-control')) }}
    @else
    {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Faculty name'))}}
    @endif
</div>
<div>
    @if(isset($id))
    {{ Form::submit('Update', array('class' => 'btn btn-primary'))}}
    @else
    {{Form::submit('Add', array('class' => 'btn btn-primary'))}}
    @endif
    <a href="{{route('faculties.index')}}" class="btn btn-success">Back</a>
</div>
{{ Form::close()}}

@endsection