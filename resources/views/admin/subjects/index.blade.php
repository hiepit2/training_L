@extends('layout.master')
@section('title',__('welcome.list-subject'))
@section('content')

<div class="container">
    @can('create')
    <div class="add">
        <a href="{{route('subjects.create')}}" class="btn btn-success">+</a>
    </div>
    @endcan
    @can('show')
    <form action="{{route('sub-subject')}}" method="post">
        @csrf
        @endcan
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">@lang('welcome.col-#')</th>
                    <th scope="col">@lang('welcome.col-name')</th>
                    @can('update')
                    <th scope="col">@lang('welcome.col-act')</th>

                    @endcan
                    @can('show')
                    <th scope="col">@lang('welcome.col-point')</th>
                    <th scope="col">@lang('welcome.col-status')</th>
                    <th scope="col"></th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{$subject->id}}</td>
                    <td>{{$subject->name}}</td>
                    @can('update')
                    <td class="action">
                        <a href="{{route('subjects.edit',$subject->id)}}">
                            <button class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>

                        </a>
                        <a href="{{route('create-point',$subject->id)}}">
                            <button class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </button>
                        </a>
                        @endcan
                        @can('delete')
                        <div>
                            {{Form::model($subjects, ['route' => ['subjects.destroy', $subject->id], 'method' => 'delete' ])}}
                            <button type="submit" onclick="return confirm(`@lang('welcome.confirm')`)" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </button>
                            {{Form::close()}}

                        </div>
                    </td>
                    @endcan
                    @can('show')
                    <div>
                        @if(isset($subject_po))
                        <td>
                        </td>
                        <td class="not_study">
                            @lang('welcome.row-register-subject')
                        </td>
                        <td>
                            <input name="subject_id[]" value="{{$subject->id}}" type="checkbox">
                        </td>
                        @else

                        @for($i = 0; $i < $subject_point->count(); $i++)
                            @if($subject->id == $subject_point[$i]->id)
                            @if(!$subject_point[$i]->pivot->point)
                            <td>
                                null
                            </td>
                            <td class="study">
                                @lang('welcome.row-studying')
                            </td>
                            <td> </td>
                            @else
                            <td>
                                {{$subject_point[$i]->pivot->point}}
                            </td>
                            <td class="study">
                                @lang('welcome.row-learned')
                            </td>
                            <td> </td>
                            @endif
                            @break
                            @elseif($i == $subject_point->count() - 1)
                            <td>
                            </td>
                            <td class="not_study">
                                @lang('welcome.row-register-subject')
                            </td>
                            <td><input name="subject_id[]" value="{{$subject->id}}" type="checkbox"></td>
                            @endif
                            @endfor

                            @endif
                    </div>
                    @endcan
                </tr>
                @endforeach

            </tbody>
        </table>
        @can('show')
        <table class="table table-bordered" style="margin-bottom: 50px;">
            <thead>
                @if($average != 0)
                <tr>
                    <th scope="col">@lang('welcome.row-avg')</th>
                    <th scope="col">{{$average}}</th>

                </tr>
                @endif
            </thead>
        </table>
        @can('show')
        @if($student->subjects->count() != $subjects->count())
        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="First group">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-outline-success">@lang('welcome.act-submit')</button>
            </div>
        </div>
        @endif
        @endcan
    </form>
    @endcan
    {{ $subjects->links() }}
</div>

@endsection
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<style>
    .action {
        display: flex;
        column-gap: 5%;
    }

    .add {
        margin-bottom: 1%;
    }

    .study {
        color: #008000;
    }

    .not_study {
        color: #FF9900;
    }
</style>