@extends('layout.master')
@section('title','List of registered subjects')
@section('content')
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subject_point as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>
                    @if($item->pivot->point)
                    {{$item->pivot->point}}
                    @else
                    null
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
    {{ $subject_point->links() }}
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