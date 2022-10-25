@extends('layout.master')
@section('title',__('welcome.import-export'))
@section('content')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<div>
    <form action="{{route('upload-subjects', $id)}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <input type="file" class="form-control" name="import_file">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">@lang('welcome.act-submit')</button>
            <a href="{{route('export-subjects', $id)}}">
                <button type="button" class="btn btn-primary">@lang('welcome.export')</button>
            </a>
        </div>
    </form>
</div>
@endsection