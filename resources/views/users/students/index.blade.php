@extends('layout.master')
@section('title','Faculty list')
@section('content')
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faculties as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>  
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