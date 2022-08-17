@extends('layout.master')
@section('title','Danh sách khoa')
@section('content')
<div>
    <a href="{{route('faculties.create')}}">Thêm mới</a>
</div>

    <table>
        <thead>
            <tr>
                <th>Mã</th>
                <th>Tên khóa</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faculty as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td style="display: flex;">
                
                <a href="{{route('faculties.edit',$item->id)}}">
                        <button class="btn btn-warning">Cập nhật</button>
                    </a>
                    <form action="{{route('faculties.delete',$item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Xóa</button>
                    </form>
               
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection