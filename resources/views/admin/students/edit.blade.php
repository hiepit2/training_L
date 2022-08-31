@extends('layout.master')
@section('title','Add new student')
@section('content')
{{ Form::model($student, ['route'=> ['students.update', $student], 'method'=>'put', 'enctype'=>'multipart/form-data'])}}
<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', $student->email, array('class' => 'form-control', 'readonly') )}}
</div>
<div class="form-group">
    {{ Form::label('name', 'Name sutdent') }}
    {{ Form::text('name', $student->name, ['class'=>'form-control']) }}

</div>
<div class="form-group">
    {{ Form::label('avatar', 'Avatar')}}
    {{ Form::file('avatar', array('class'=>'form-control')) }}

</div>
<div class="form-group">
    {{ Form::label('faculty', 'Faculty')}}
    {{ Form::select('faculty_id', $faculties, $student->faculty_id, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('address', 'Address')}}
    {{ Form::text('address', $student->address, array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('birthday', 'Birthday')}}
    {{ Form::date('birthday', $student->birthday, array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('phone', 'Phone')}}
    {{ Form::text('phone', $student->phone, array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('gender', 'Gender')}}
    Male: {{ Form::radio('gender', '0')}}
    Famale: {{ Form::radio('gender', '1')}}

</div>
<div>
    {{ Form::submit('Add', ['class' => 'btn btn-primary'])}}
    <a href="{{route('students.index')}}" class="btn btn-success">Back</a>
</div>

{{ Form::close() }}
@endsection