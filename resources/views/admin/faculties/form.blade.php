@extends('layout.master')
@section('title','Add new faculty')
@section('content')

@if(isset($id))
{{ Form::model($faculty, ['route' => ['faculties.update', $faculty], 'method' => 'put'])}}
@else
{{ Form::model($faculty, ['route' => 'faculties.store', 'method' => 'post']) }}
@endif

<div class="form-group">
    {{Form::label('name', 'Faculty name', ['class' => 'faculties']) }}
    {{ Form::text('name', $faculty->name, ['class' => 'form-control']) }}
</div>
<div>
    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    <a href="{{route('faculties.index')}}" class="btn btn-success">Back</a>
</div>
{{ Form::close()}}

@endsection