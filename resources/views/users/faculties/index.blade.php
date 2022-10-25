@extends('layout.master')
@section('title',__('welcome.list-faculty'))
@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<div class="container">
    @can('create')
    <div class="add">
        <a href="{{route('faculties.create')}}" class="btn btn-success">+</a>
    </div>
    @endcan

    <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('welcome.col-#')</th>
                <th scope="col">@lang('welcome.col-name')</th>
                @can('delete')
                <th scope="col">@lang('welcome.col-act')</th>
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
                        <button class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>

                    </a>
                    @endcan
                    @can('delete')
                    <div>
                        {{ Form::model($faculty, array('route' => array('faculties.destroy', $faculty->id), 'method' => 'delete')) }}

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @lang('welcome.confirm')
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('welcome.act-close')</button>
                                        <button type="submit" class="btn btn-danger">@lang('welcome.act-delete')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </td>
                @endcan

                <!-- form regis faculty of student -->
                <form action="{{route('updateFaculty')}}" method="post">
                    @csrf
                    @method('PUT')
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
                    @can('show')
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group" role="group" aria-label="First group">
                        </div>
                        @if(!$student->faculty_id)
                        <div class="input-group">
                            <button type="submit" class="btn btn-outline-success" onclick="return confirm('Are you sure?')">@lang('welcome.act-submit')</button>
                        </div>
                        @endif
                    </div>
                    @endcan
                </form>
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