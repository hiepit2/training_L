@extends('layout.master')
@section('title','Subject list')
@section('content')
<div class="container">
    @can('create')
    <div class="add">
        <a href="{{route('subjects.create')}}" class="btn btn-success">+</a>
    </div>
    @endcan
    @can('show')
    <div class="add">
        <a href="{{route('subjects.create')}}" class="btn btn-success">
            <button type="button" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                </svg>
            </button>

        </a>
    </div>
    <form action="{{route('sub_subject')}}" method="get">
        @csrf
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
                    <th scope="col">Point</th>
                    <th scope="col">Status</th>
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
                            {{ Form::submit('Update', ['class' => 'btn btn-warning'])}}
                        </a>
                        @endcan
                        @can('delete')
                        <div>
                            {{ Form::model($subject, array('route' => array('subjects.destroy', $subject->id), 'method' => 'delete')) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"]) }}
                            {{ Form::close() }}
                        </div>
                    </td>
                    @endcan
                    @can('show')
                    <div>
                        @if(isset($subject_po))
                        <td>
                        </td>
                        <td class="not_study">
                            Haven't studied yet
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
                                Have learned
                            </td>
                            <td> </td>
                            @else
                            <td>
                                {{$subject_point[$i]->pivot->point}}
                            </td>
                            <td class="study">
                                Have learned
                            </td>
                            <td> </td>
                            @endif
                            @break
                            @elseif($i == $subject_point->count() - 1)
                            <td>
                            </td>
                            <td class="not_study">
                                Haven't studied yet
                            </td>
                            <td><input name="subject_id[]" value="{{$subject->id}}" type="checkbox"></td>
                            <!-- <td><input type="checkbox" onclick="btn" name="subject_id" value="{{$subject->id}}"></td> -->
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
                    <th scope="col">Average:</th>
                    <th scope="col">{{$average}}</th>
                    
                </tr>
                @endif
            </thead>
        </table>
        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="First group">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-outline-success">Success</button>
            </div>
        </div>
    </form>
    @endcan
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

    .study {
        color: #008000;
    }

    .not_study {
        color: #FF9900;
    }
</style>