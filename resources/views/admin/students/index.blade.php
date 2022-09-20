@extends('layout.master')
@section('title','Student List')
@section('content')


<!-- add student -->
<div class="add">
    <a href="{{route('students.create')}}" class="btn btn-success">+</a>

    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Quick Add</button>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="saveAdd">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::model($students, ['route' => 'students.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

                    <label> Name Student</label>
                    {!! Form::text('name', old('name'), ['class' => 'form-control',
                    'placeholder' => 'Enter Name',
                    'id' => 'name']) !!}
                    <br />


                    <label> Email Student</label>
                    {!! Form::text('email', old('email'), [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Email',
                    'id' => 'email',
                    ]) !!}
                    <br />


                    <div class="form-group">
                        <label> Avatar Student</label>
                        {!! Form::file('avatar', old('avatar'), [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Avatar',
                        'id' => 'avatar',
                        ]) !!}
                        <br />
                    </div>

                    <label> Phone Student</label>
                    {!! Form::text('phone', old('phone'), [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Phone',
                    'id' => 'phone',
                    ]) !!}
                    <br />

                    <label> Address Student</label>
                    {!! Form::text('address', old('address'), [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Address',
                    'id' => 'address',
                    ]) !!}
                    <br />
                    <label> BirthDay Student</label>
                    {!! Form::date('birthday', old('birthday'), ['class' => 'form-control', 'id' => 'birthday']) !!}
                    <br />
                    <label> Gender Student</label>
                    <div class="form-group">
                        <div class="form-check">
                            {!! Form::radio('gender', '1', true, ['id' => 'gender']) !!}
                            <label class="form-check-label" for="exampleRadios1">
                                Nam
                            </label>
                        </div>
                        <div class="form-check">
                            {!! Form::radio('gender', '0', true, ['id' => 'gender']) !!}
                            <label class="form-check-label" for="exampleRadios2">
                                Nữ
                            </label>
                        </div>
                    </div>
                    <br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="saveAdd" id="saveAdd" class="btn btn-primary">Save changes</button>
                        <!-- <input type="button" name="saveAdd" id="saveAdd" value="Save" class="btn btn-success" /> -->
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
<!-- end form search -->


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
                <div>
                    <button class="btn btn-primary btnModal" id="modalPoint" data-toggle="modal" data-target="#exampleModal" data-id="{{$student->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                        </svg>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" data-id="{{$student->id}}" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-subject">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a href="{{route('subjects.show',$student->id)}}">
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                        </svg>
                    </button>
                </a> -->
                @if($student->subjects->count() < $count) {{ Form::model($student, ['route' => ['mail_subjects', $student], 'method' => 'get'])}} <button class="btn btn-secondary" type="submit" onclick="return confirm('Do you want send to student?')">
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


<!-- send mail all -->
{{ Form::model($student, ['route' => ['mail_subjects_all'], 'method' => 'get'])}}
<button type="submit" onclick="return confirm('Do you want send to student?')">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
    </svg>
</button>
{{ Form::close()}}
<!-- end send mail all -->



{{ $students->links() }}

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    // gọi button khi click thì mở modal + get url lấy data student qua var id = $(this).attr('data-id');


    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.btnModal').on('click', function(e) {
            e.preventDefault();
            $('tbody').addClass('name');
            var id = $(this).attr('data-id');
            var url = '/get_student/' + id;
            console.log(id);
            $.get('/get_student/' + id , function(data) {
                var tr = '';
                data.subjects.forEach(element => {
                    // var tr = $('<tr>');
                    tr += `
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.name}</td>
                            <td>1</td>
                        </tr>
                    `;
                });
                $('#table-subject').html(tr);
            });
        })
    });



    $('#saveAdd').submit(function(e) {
        console.log('1');
        var genders = $('[name="gender"]')
        for (var i = 0; i < genders.length; i++) {
            if (genders[i].checked) {
                selectedGender = genders[i].value;
            }
        }
        e.preventDefault();
        $.ajax({
            url: 'students',
            type: 'POST',
            dataType: 'json',
            data: {
                _method: 'POST',
                name: $("#name").val(),
                email: $("#email").val(),
                phone: $("#phone").val(),
                address: $("#address").val(),
                birthday: $("#birthday").val(),
                gender: selectedGender,
            },

            success: function(response) {
                console.log(response);
                $('#edit_data_Modal').modal('hide');
                Swal.fire(
                    'Updated!',
                    'Update Successfully',
                    'success'
                )
                $('#data-gender-' + response.studentid).text(selectedGender == 1 ?
                    "Nam" : "Nữ")
                $('#data-name-' + response.studentid).text(response.student.name)
            }
        })
    })
</script>
@endsection

<style>
    .container-fluid1 {
        display: flex;
    }
</style>