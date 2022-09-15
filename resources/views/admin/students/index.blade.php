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
            <th scope="col">Avatar</th>
            <th scope="col">Full name</th>
            <th scope="col">Point</th>

            <th scope="col">Subjects</th>
            <th scope="col">Action</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{$student->id}}</td>
            <td style="width: 10%;">
                <img src="{{asset($student->avatar)}}" alt="" width="100%">
            </td>
            <td>{{$student->name}}</td>

            <td>
                @if($student->subjects->count() == 0)
                @elseif($student->subjects->count() < $count) Studing @else @for($i=0; $i < $count; $i++) @if(!$student->subjects[$i]->pivot->point)
                    Studing
                    @break
                    @elseif($i == $count -1)
                    {{round($student->subjects->avg('pivot.point'), 2)}}
                    @endif
                    @endfor
                    @endif
            </td>
            <td>{{$student->subjects->count()}} / {{$count}}</td>
            <td>
                <div>
                    <a href="{{route('students.edit',$student->id)}}">
                        <button class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                    </a>
                </div>
                <div>
                    {{ Form::model($students, array('route' => array('students.destroy',$student->id), 'method' => 'DELETE'))}}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete?')"])}}
                    {{ Form::close() }}
                </div>
            </td>
            <td>
                <a href="{{route('subjects.show',$student->id)}}">
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                        </svg>
                    </button>
                </a>
                @if($student->subjects->count() < $count) 
                    {{ Form::model($student, ['route' => ['mail_subjects', $student], 'method' => 'get'])}} 
                        <button class="btn btn-secondary" type="submit" onclick="return confirm('Do you want send to student?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                            </svg>
                        </button>
                    {{ Form::close()}}
                @endif

            </td>
        </tr>
        @endforeach

    </tbody>
</table>
{{ Form::model($student, ['route' => ['mail_subjects_all'], 'method' => 'get'])}}
<button type="submit" onclick="return confirm('Do you want send to student?')">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
    </svg>
</button>
{{ Form::close()}}
{{ $students->links() }}

@endsection
<style>
    .container-fluid1 {
        display: flex;
    }
</style>