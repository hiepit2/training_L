@extends('layout.master')
@section('title','Add new subject')
@section('content')

@if(isset($id))
{{ Form::model($subject, ['route' => ['subjects.update', $subject], 'method' => 'put'])}}
@else
{{ Form::model($subject, ['route' => 'subjects.store', 'method' => 'post']) }}
@endif

<div class="form-group">
    {{Form::label('name', 'subject name', ['class' => 'subjects']) }}
    {{ Form::text('name', $subject->name, ['class' => 'form-control']) }}
</div>
<div>
    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    <a href="{{route('subjects.index')}}" class="btn btn-success">Back</a>
</div>
{{ Form::close()}}

@endsection