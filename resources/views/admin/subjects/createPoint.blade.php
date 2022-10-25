@extends('layout.master')
@section('title',__('welcome.list-point'))
@section('content')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<div class="container">
    <div class="form-group">
        <a href="{{route('import-subjects', $id)}}">
            <button type="button" class="btn btn-info">@lang('welcome.import')</button>
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">@lang('welcome.col-#')</th> 
                <th scope="col">@lang('welcome.col-name')</th>
                <th scope="col">@lang('welcome.col-point')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
          
                <td>{{$student->id}}</td>
                <td>{{$student->name}}</td>
                <td>
                    @foreach($student->subjects as $item)
                        @if($item->id == $id)
                            @if($item->pivot->point)
                                {{$item->pivot->point}}
                            @else
                                null
                            @endif
                        @endif
                    @endforeach
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
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