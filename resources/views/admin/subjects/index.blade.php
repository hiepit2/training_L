@extends('layout.master')
@section('title','Subject list')
@section('content')
<div class="container">
    @can('create')
    <div class="add">
        <a href="{{route('subjects.create')}}" class="btn btn-success">+</a>
    </div>
    @endcan
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                @can('update')
                <th scope="col">Action</th>
                @endcan
                @can('show')
                <th scope="col">Status</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td class="action">
                    @can('update')
                    <a href="{{route('subjects.edit',$item->id)}}">
                        {{ Form::submit('Update', ['class' => 'btn btn-warning'])}}
                    </a>
                    @endcan
                    @can('delete')
                    <div>
                        {{ Form::model($item, array('route' => array('subjects.destroy', $item->id), 'method' => 'delete')) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"]) }}
                        {{ Form::close() }}
                    </div>
                    @endcan
                    @can('show')
                    <div>
                        
                    </div>
                    @endcan
                </td>

            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $subjects->links() }}
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