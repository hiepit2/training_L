@extends('layout.master')
@section('title','Import')
@section('content')
<div>
    <form action="{{route('upload_subjects', $id)}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <input type="file" class="form-control" name="import_file">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Push</button>
            <a href="{{route('export_subjects', $id)}}">
                <button type="button" class="btn btn-primary">Export</button>
            </a>
        </div>
    </form>
</div>
@endsection