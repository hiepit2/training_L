@extends('layout.master')
@if(isset($id))
    @section('title',__('welcome.act-update'))
@else
    @section('title',__('welcome.act-create'))
@endif
@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

@if(isset($id))
{{ Form::model($faculty, ['route' => ['faculties.update', $faculty], 'method' => 'put'])}}
@else
{{ Form::model($faculty, ['route' => 'faculties.store', 'method' => 'post']) }}
@endif

<div class="form-group">

    {{Form::label('name', __('welcome.col-name'), ['class' => 'faculties']) }}
    {{ Form::text('name', $faculty->name, ['class' => 'form-control']) }}
</div>
<div>
    {{ Form::submit(__('welcome.act-submit'), ['class' => 'btn btn-primary']) }}
    <a href="{{route('faculties.index')}}" class="btn btn-success">@lang('welcome.act-back')</a>
</div>
{{ Form::close()}}

@endsection