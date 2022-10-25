@extends('layout.master')
@section('title',__('welcome.list-student'))
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <!-- add student -->
                    <div class="add">

                        <!-- add student quick -->
                        <button type="button" class="btn btn-success addQuick" data-toggle="modal" data-target=".bd-example-modal-lg">@lang('welcome.act-add-quick')</button>

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="saveAdd">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">@lang('welcome.act-create')</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{ Form::model($students, ['route' => 'students.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                                        <label>@lang('welcome.col-name')</label>
                                        {!! Form::text('name', old('name'), ['class' => 'form-control',
                                        'placeholder' => __('welcome.col-name'),
                                        'id' => 'name']) !!}
                                        <div class="text-danger">
                                            <span class="error_name"></span>
                                        </div>

                                        <br />


                                        <label>@lang('welcome.col-email')</label>
                                        {!! Form::email('email', old('email'), [
                                        'class' => 'form-control',
                                        'placeholder' => __('welcome.col-email'),
                                        'id' => 'email',
                                        ]) !!}
                                        <div class="text-danger">
                                            <span class="error_email"></span>
                                        </div>

                                        <br />


                                        <label>@lang('welcome.col-phone')</label>
                                        {!! Form::text('phone', old('phone'), [
                                        'class' => 'form-control',
                                        'placeholder' => __('welcome.col-phone'),
                                        'id' => 'phone',
                                        ]) !!}
                                        <div class="text-danger">
                                            <span class="error_phone"></span>
                                        </div>

                                        <br />

                                        <label>@lang('welcome.col-address')</label>
                                        {!! Form::text('address', old('address'), [
                                        'class' => 'form-control',
                                        'placeholder' => __('welcome.col-address'),
                                        'id' => 'address',
                                        ]) !!}
                                        <div class="text-danger">
                                            <span class="error_address"></span>
                                        </div>

                                        <br />


                                        <label>@lang('welcome.col-birthday')</label>
                                        {!! Form::date('birthday', old('birthday'), ['class' => 'form-control', 'id' => 'birthday']) !!}
                                        <div class="text-danger">
                                            <span class="error_birthday"></span>
                                        </div>

                                        <br />
                                        <label> @lang('welcome.col-gender')</label>
                                        <div class="form-group">
                                            <div class="form-check">
                                                {!! Form::radio('gender', '1', true, ['id' => 'gender']) !!}
                                                <label class="form-check-label" for="exampleRadios1">
                                                    @lang('welcome.row-male')
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                {!! Form::radio('gender', '0', true, ['id' => 'gender']) !!}
                                                <label class="form-check-label" for="exampleRadios2">
                                                    @lang('welcome.row-female')

                                                </label>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('welcome.act-close')</button>
                                            <button type="button" id="saveAdd" class="btn btn-primary saveAdd">@lang('welcome.act-submit')</button>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end add student -->

                    <!-- form search -->
                    <div class="search">
                        <form action="{{route('students.index')}}" method="get">
                            @csrf
                            <br>
                            <div class="container">
                                <div class="row">
                                    <div class="container-fluid1">
                                        <div class="col-sm-3">
                                            <label for="">@lang('welcome.col-age-from')</label>
                                            <input type="text" class="form-control input-sm" id="fromOld" name="age_from" require>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="">@lang('welcome.col-age-to')</label>
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
                                            <label for="">@lang('welcome.col-point-from')</label>
                                            <input type="text" class="form-control input-sm" id="fromPoint" name="point_from" require>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="">@lang('welcome.col-point-to')</label>
                                            <input type="text" class="form-control input-sm" id="toPoint" name="point_to" require>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn" name="search">@lang('welcome.act-submit')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end form search -->
                </h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive l-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>@lang('welcome.col-#')</th>
                            <th>@lang('welcome.col-avatar')</th>
                            <th>@lang('welcome.col-name')</th>
                            <th>@lang('welcome.col-point')</th>
                            <th>@lang('welcome.subject')</th>
                            <th>@lang('welcome.col-act')</th>
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
                                <div>
                                    ...
                                </div>
                                @elseif($student->subjects->count() < $count) <div>
                                    @lang('welcome.row-studying')
            </div>
            @else
            @for($i=0; $i < $count; $i++) @if(!$student->subjects[$i]->pivot->point)
                <div>
                    @lang('welcome.row-studying')
                </div>
                @break
                @elseif($i == $count -1)
                @if(round($student->subjects->avg('pivot.point'), 2) < 5) <div class="text-danger">{{round($student->subjects->avg('pivot.point'), 2)}}
        </div>
        @else
        <div class="text-success">{{round($student->subjects->avg('pivot.point'), 2)}}</div>
        @endif
        @endif
        @endfor
        @endif
        </td>
        <td>{{$student->subjects->count()}} / {{$count}}</td>
        <td>
            <div class="btn-action">
                <!-- update student -->
                <a href="{{route('students.edit',$student->id)}}">
                    <button class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                    </button>
                </a>

                <!-- delete student -->
                {{ Form::model($students, array('route' => array('students.destroy',$student->id), 'method' => 'DELETE'))}}
                <div>
                    <button type="submit" onclick="return confirm(`@lang('welcome.confirm')`)" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                        </svg>
                    </button>
                </div>
                {{ Form::close()}}
                <!-- Modal show subjects of student -->
                <div>
                    <button class="btn btn-primary btnModal" id="modalPoint" data-toggle="modal" data-target="#exampleModal" data-id="{{$student->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                    </button>

                    <div class="modal fade" data-id="{{$student->id}}" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('welcome.list-subject-point')</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form method="post" id="form_update_point">
                                        @csrf
                                        @method('PUT')
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">@lang('welcome.col-#')</th>
                                                    <th scope="col">@lang('welcome.col-name')</th>
                                                    <th scope="col">@lang('welcome.col-point')</th>


                                                </tr>
                                            </thead>
                                            <tbody id="table-subject">
                                            </tbody>
                                        </table>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('welcome.act-close')</button>
                                            <button type="submit" class="btn btn-primary">@lang('welcome.act-submit')</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal show subjects of student -->


                @if($student->subjects->count() < $count) {{ Form::model($student, ['route' => ['mail-subjects', $student], 'method' => 'get'])}} <button class="btn btn-secondary" type="submit" onclick="return confirm(`@lang('welcome.send-mail')`)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                    </svg>
                    </button>
                    {{ Form::close()}}
                    @endif
            </div>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

</div>
</div>

<!-- send mail all -->
{{ Form::model($student, ['route' => ['mail-subjects-all'], 'method' => 'get'])}}
<button class="btn btn-secondary" type="submit" onclick="return confirm(`@lang('welcome.send-mail')`)">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
    </svg>
</button>
{{ Form::close()}}
<!-- end send mail all -->

{{ $students->links() }}

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<script>
    // gọi button khi click thì mở modal + get url lấy data student qua var id = $(this).attr('data-id');
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });


    //show subjects of student
    $('.btnModal').on('click', function(e) {
        e.preventDefault();
        $('tbody').addClass('name');
        var id = $(this).attr('data-id');
        var href = '/subjects/store-point/' + id;
        // dd(href);
        $('#form_update_point').attr('action', href);
        console.log(id);
        var url = '/subjects/get-student/' + id;

        $.get('students/get-student/' + id, function(data) {
            var tr = '';

            data.subjects.forEach(element => {
                tr += `
                <tr>
                <td>${element.id}</td>
                <td><a type="button" class="btn btn-primary" href="subjects/create-point/${element.id}">${element.name}</a></td>
                <td><input type="text" class="form-control" name = "point[]" value = "${element.pivot.point}"></td>                            
                </tr>
                `;
            });

            $('#table-subject').html(tr);

        });
    })

    //quick add
    $('.saveAdd').on('click', function(e) {
        e.preventDefault();
        var gender = $('input[name="gender"]:checked').val();
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var birthday = $("#birthday").val();

        $.ajax({
            url: "{{route('students.store')}}",
            type: "POST",
            cache: false,
            data: {
                name: name,
                email: email,
                phone: phone,
                birthday: birthday,
                address: address,
                gender: gender
            },
            dataType: 'json',
            success: function(data) {
                Swal.fire(
                    'Successful!',
                    'Create student successfully!',
                    'success'
                )
                $('#create-bookmark').removeAttr('style');
                $('#edit-bookmark').css('padding-right', ' ');
                $('.modal-backdrop').removeClass('show');
                $('body').removeAttr("style");
                $('body').removeClass('modal-open');
            },

            error: function(data) {
                if (data.responseJSON.errors['name']) {
                    $('.error_name').text(data.responseJSON.errors['name']);
                } else {
                    $('.error_name').text('');
                }

                if (data.responseJSON.errors['email']) {
                    $('.error_email').html(data.responseJSON.errors['email']);
                } else {
                    $('.error_email').text('');
                }



                if (data.responseJSON.errors['phone']) {
                    $('.error_phone').html(data.responseJSON.errors['phone']);
                } else {
                    $('.error_phone').text('');
                }

                if (data.responseJSON.errors['address']) {
                    $('.error_address').html(data.responseJSON.errors['address']);
                } else {
                    $('.error_address').text('');
                }

                if (data.responseJSON.errors['birthday']) {
                    $('.error_birthday').html(data.responseJSON.errors['birthday']);
                } else {
                    $('.error_birthday').text('');
                }
            }
        })
    })
</script>
@endsection

<style>
    .container-fluid1 {
        display: flex;
    }

    .btn-action {
        column-gap: 5px;
        display: flex;
    }
</style>