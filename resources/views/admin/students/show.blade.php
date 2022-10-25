@extends('layout.master')
@section('title', __('welcome.profile'))
@section('content')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            {{ Form::model($student, ['route'=> ['update-profile', $student], 'method' => 'put', 'enctype'=>'multipart/form-data'])}}
        
            <img src="{{asset($student->avatar)}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            <input type="file" name="avatar">
            <h5 class="my-3">{{$student->name}}</h5>
            <div class="d-flex justify-content-center mb-2">
              <button type="submit" class="btn btn-outline-primary ms-1">@lang('welcome.act-submit')</button>
            </div>
           
            {{ Form::close() }}
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">@lang('welcome.col-name')</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$student->name}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">@lang('welcome.col-email')</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$student->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">@lang('welcome.col-code')</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">PH{{$student->code}} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">@lang('welcome.col-phone')</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$student->phone}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">@lang('welcome.col-birthday')</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$student->birthday}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">@lang('welcome.col-address')</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{$student->address}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">@lang('welcome.col-gender')</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">@if($student->gender == 0) @lang('welcome.row-male') @else @lang('welcome.row-female') @endif</p>
              </div>
            </div>
          </div>
        </div>
      
      </div>
    </div>
  </div>
</section>
@endsection