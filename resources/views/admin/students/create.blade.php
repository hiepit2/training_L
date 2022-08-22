@extends('layout.master')
@section('title','Add new student')
@section('content')
{{ Form::model($student, array('route'=>'students.store', 'method'=>'post', 'enctype'=>'multipart/form-data'))}}
<div class="form-group">
    {{ Form::label('name', 'Name sutdent') }}
    {{ Form::text('name', '', array('class'=>'form-control')) }}

</div>
<div class="form-group">
    {{ Form::label('avatar', 'Avatar')}}
    {{ Form::file('avatar', array('class'=>'form-control')) }}

</div>
<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', '', array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('faculty', 'Faculty')}}
    {{ Form::select('faculty_id', $faculties, $student->faculty_id, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('address', 'Address')}}
    {{ Form::text('address', '',array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('birthday', 'Birthday')}}
    {{ Form::date('birthday', '', array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('phone', 'Phone')}}
    {{ Form::text('phone', '', array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('gender', 'Gender')}}
    Nam: {{ Form::radio('gender', '0')}} 
    Nữ: {{ Form::radio('gender', '1')}}
    
</div>
<div>
    <button class="btn btn-primary">Thêm</button>
</div>

{{ Form::close() }}
@endsection