@extends('layout.master')
@section('title','Add new student')
@section('content')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

{{ Form::model($student, array('route'=>'students.store', 'method'=>'post', 'enctype'=>'multipart/form-data'))}}
<div class="form-group">
    {{ Form::label('name', 'Name sutdent') }}
    {{ Form::text('name', '', array('class'=>'form-control')) }}

</div>

<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', '', array('class' => 'form-control')) }}
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
    Male: {{ Form::radio('gender', '1')}}
    Female: {{ Form::radio('gender', '0')}}

</div>
<div>
    {{ Form::submit('Add', ['class' => 'btn btn-primary'])}}
    <a href="{{route('students.index')}}" class="btn btn-success">Back</a>
</div>

{{ Form::close() }}
@endsection