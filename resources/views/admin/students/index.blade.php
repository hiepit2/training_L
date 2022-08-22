@extends('layout.master')
@section('title','Danh sách sinh viên')
@section('content')
<div>
    <a href="{{route('students.create')}}">Thêm mới</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Mã</th>
            <th scope="col">Tên</th>
            <th scope="col">Ảnh đại diện</th>
            <th scope="col">Email</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td style="width: 10%;"><img src="{{asset($item->avatar)}}" alt="" width="100%"></td>
            <td>{{$item->email}}</td>
            <td style="display: flex;">

                <a href="{{route('students.edit',$item->id)}}">
                    <button class="btn btn-warning">Cập nhật</button>
                </a>
                {{ Form::model($students, array('route' => array('students.destroy',$item->id), 'method' => 'DELETE'))}}
                {{ Form::submit('Xóa', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Bạn có chắc chắn muốn xóa không?')"])}}
                {{ Form::close() }}


            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection