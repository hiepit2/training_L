@extends('layout.master')
@section('title','Faculty list')
@section('content')
<div class="container">
    @can('create')
    <div class="add">
        <a href="{{route('faculties.create')}}" class="btn btn-success">+</a>
    </div>
    @endcan
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                @can('update | delete')
                <th scope="col">Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($faculties as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                @can('update')
                <td class="action">
                    <a href="{{route('faculties.edit',$item->id)}}">
                        {{ Form::submit('Update', ['class' => 'btn btn-warning'])}}
                    </a>
                    @endcan
                    @can('delete')
                    <div>
                        {{ Form::model($item, array('route' => array('faculties.destroy', $item->id), 'method' => 'delete')) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"]) }}
                        {{ Form::close() }}
                    </div>
                </td>
                @endcan

            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $faculties->links() }}
</div>


@endsection
<style>
    .action {
        display: flex;
        column-gap: 5%;
    }

    .add {
        margin-bottom: 1%;
    }
</style>