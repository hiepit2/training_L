@extends('layout.master')
@section('title','Update point')
@section('content')
<div class="container">
    <div class="form-group">
        <a href="{{route('impost_subjects', $id)}}">
            <button type="button" class="btn btn-info">Import</button>
        </a>
    </div>
    {{ Form::model($students, ['route'=> ['store_point'], 'method' => 'put'])}}
    {{ csrf_field() }}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Point</th>

            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <!-- <td>{{$student->id}}</td> -->
                <td>{{$student->id}}</td>
                <td>{{$student->name}}</td>
                <td>
                    @foreach($student->subjects as $item)
                    @if($item->id == $id)
                    {{$item->pivot->point}}
                    @endif
                    @endforeach
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
        </div>
        <div class="input-group">
            <button type="submit" class="btn btn-outline-success">Success</button>
        </div>
    </div>
    {{ Form::close() }}
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