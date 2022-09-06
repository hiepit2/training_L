@extends('layout.master')
@section('title','Student List')
@section('content')
<div class="add">
    <a href="{{route('students.create')}}" class="btn btn-success">+</a>
</div>
<div class="search">
    <form action="{{route('students.index')}}" method="get">
        @csrf
        <br>
        <div class="container">
            <div class="row">
                <div class="container-fluid1">
                    <div class="col-sm-3">
                        <label for="">Age from</label>
                        <input type="text" class="form-control input-sm" id="fromOld" name="age_from" require>
                    </div>
                    <div class="col-sm-3">
                        <label for="">Age to</label>
                        <input type="text" class="form-control input-sm" id="toOld" name="age_to" require>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="container-fluid1">
                    <div class="col-sm-3">
                        <label for="">Point from</label>
                        <input type="text" class="form-control input-sm" id="fromPoint" name="point_from" require>
                    </div>
                    <div class="col-sm-3">
                        <label for="">Point to</label>
                        <input type="text" class="form-control input-sm" id="toPoint" name="point_to" require>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn" name="search">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Full name</th>
            <th scope="col">Avatar</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
      
        @foreach($students as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td style="width: 10%;"><img src="{{asset($item->avatar)}}" alt="" width="100%"></td>
            <td>{{$item->email}}</td>
            <td>
                <div>
                    <a href="{{route('students.edit',$item->id)}}">
                        <button class="btn btn-warning">Update</button>
                    </a>
                </div>
                <div>
                    {{ Form::model($students, array('route' => array('students.destroy',$item->id), 'method' => 'DELETE'))}}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
                    {{ Form::close() }}
                </div>

            </td>
        </tr>
        @endforeach
       
    </tbody>
</table>
{{ $students->links() }}

@endsection
<style>
    .container-fluid1 {
        display: flex;
    }
</style>