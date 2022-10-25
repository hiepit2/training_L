@extends('layout.master')
@section('title',__('welcome.act-update'))
@section('content')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

{{ Form::model($student, ['route'=> ['students.update', $student], 'method' => 'put', 'enctype'=>'multipart/form-data'])}}
<div class="form-group">
    {{ Form::label('email', __('welcome.col-email')) }}
    {{ Form::text('email', $student->email, array('class' => 'form-control', 'readonly') )}}
</div>
<div class="form-group">
    {{ Form::label('name', __('welcome.col-name')) }}
    {{ Form::text('name', $student->name, ['class'=>'form-control']) }}

</div>
<!-- <div class="form-group">
    {{ Form::label('avatar', 'Avatar')}}
    {{ Form::file('avatar', array('class'=>'form-control')) }}
</div> -->
<!-- <div class="form-group">
    {{ Form::label('faculty', 'Faculty')}}
    {{ Form::select('faculty_id', $faculties, $student->faculty_id, ['class' => 'form-control']) }}
</div> -->
<div class="form-group">
    {{ Form::label('address', __('welcome.col-address'))}}
    {{ Form::text('address', $student->address, array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('birthday', __('welcome.col-birthday'))}}
    {{ Form::date('birthday', $student->birthday, array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('phone', __('welcome.col-phone'))}}
    {{ Form::text('phone', $student->phone, array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{ Form::label('gender', __('welcome.col-gender') )}}
    @lang('welcome.row-male'): {{ Form::radio('gender', '0')}}
    @lang('welcome.row-female'): {{ Form::radio('gender', '1')}}

</div>
<div>
    {{ Form::submit(__('welcome.act-submit'), ['class' => 'btn btn-primary'])}}
    <a href="{{route('students.index')}}" class="btn btn-success">@lang('welcome.act-back')</a>
</div>

{{ Form::close() }}
@endsection