<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function list()
    {
        $students = Student::all();
        $faculty = Faculty::all();
        return view('admin.students.list', [
            'students' => $students,
            'faculty' => $faculty
        ]);
    }
    public function create()
    {
        $faculty = Faculty::all();
        return view('admin.students.create',[
            'faculty' => $faculty
        ]);
    }
    public function store(Request $request)
    {
        $students = new Student();
        $students->fill($request->all());
      
        if ($request->hasFile('avatar')) {

            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->name . '_' . $avatarName;
            $students->avatar = $avatar->storeAs('images/students', $avatarName);
        } else {
            $students->avatar = 'https://static2.yan.vn/YanNews/2167221/202102/facebook-cap-nhat-avatar-doi-voi-tai-khoan-khong-su-dung-anh-dai-dien-e4abd14d.jpg';
        }
        $students->save();
        return redirect()->route('students.list');
    }

    public function search_old(Request $request){
        if($request->first_old < $request->second_old){
            $first = $request->first_old;
            $second = $request->second_old;
        }
        else{
            $first = $request->second_old;
            $second = $request->first_old;
        }
        $search_old = Student::all();
        $date = date('m-d-yy');
        return redirect()->route('students.list',[
            'first'=>$first,
            'second'=>$second,
            'search_old'=>$search_old,
            'date'=>$date
        ]);
    }
}
