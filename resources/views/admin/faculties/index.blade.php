@extends('layout.master')
@section('title','Faculty list')
@section('content')
<div>
    <a href="{{route('faculties.create')}}" class="btn btn-primary">Add</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($faculties as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td class="action">

                <a href="{{route('faculties.edit',$item->id)}}">
                    <button class="btn btn-warning">Update</button>
                </a>
                {{ Form::model($item, array('route' => array('faculties.destroy', $item->id), 'method' => 'delete')) }}
                {{Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"]) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
<style>
    .action {
        display: flex;
    }
</style>