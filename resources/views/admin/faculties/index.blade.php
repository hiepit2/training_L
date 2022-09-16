@extends('layout.master')
@section('title','Faculty list')
@section('content')
<div class="container">
    @can('create')
    <div class="add">
        <a href="{{route('faculties.create')}}" class="btn btn-success">+</a>
    </div>
    @endcan
    <form action="{{route('updateFaculty')}}" method="post">
        @csrf
        @method('PUT')
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    @can('delete')
                    <th scope="col">Action</th>
                    @endcan
                    @can('show')
                    <th scope="col"></th>
                    @endcan

                </tr>
            </thead>
            <tbody>
                @foreach($faculties as $faculty)
                <tr>
                    <td>{{$faculty->id}}</td>
                    <td>{{$faculty->name}}</td>
                    @can('update')
                    <td class="action">
                        <a href="{{route('faculties.edit',$faculty->id)}}">
                            {{ Form::submit('Update', ['class' => 'btn btn-warning'])}}
                        </a>
                        @endcan
                        @can('delete')
                        <div>
                            {{ Form::model($faculty, array('route' => array('faculties.destroy', $faculty->id), 'method' => 'delete')) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"]) }}
                            {{ Form::close() }}
                        </div>
                    </td>
                    @endcan
                    @can('show')
                    @if($student->faculty_id)
                        @if($student->faculty_id == $faculty->id)
                        <td><input name="faculty_id" value="{{$faculty->id}}" type="radio" checked></td>
                        @else
                        <td><input name="faculty_id" value="{{$faculty->id}}" type="radio" disabled></td>
                        @endif
                    @else
                        <td><input name="faculty_id" value="{{$faculty->id}}" type="radio"></td>
                    @endif
                    @endcan

                </tr>

                @endforeach
            </tbody>
        </table>

        @can('show')
        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="First group">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('Are you sure?')">Success</button>
            </div>
        </div>
        @endcan
    </form>
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