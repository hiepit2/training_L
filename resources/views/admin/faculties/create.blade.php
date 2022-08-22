@extends('layout.master')
@section('title','Add new faculty')
@section('content')

@if(isset($id))
    {{ Form::model($faculty, array('route' => array('faculties.update', $faculty), 'method' => 'put'))}}
@else
    {{ Form::model($faculty, array('route' => 'faculties.store', 'method' => 'post')) }}
@endif

<div class="form-group">
    {{Form::label('name', 'Faculty name', array('class' => 'faculties'))}}
    {{ Form::text('name', $faculty->name, array('class' => 'form-control')) }}
</div>
<div>
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}  
    <a href="{{route('faculties.index')}}" class="btn btn-success">Back</a>
</div>
{{ Form::close()}}

@endsection