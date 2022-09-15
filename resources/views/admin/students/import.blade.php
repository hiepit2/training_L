@extends('layout.master')
@section('title','Import')
@section('content')
<div>
    <form action="">
        <div class="form-group">
            <input type="file" class="form-control">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary">Push</button>
            <a href="{{route('export_students', $id)}}">
                <button type="button" class="btn btn-primary">Export</button>
            </a>
        </div>
    </form>
</div>
@endsection