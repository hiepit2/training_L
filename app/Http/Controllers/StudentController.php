<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Mail\RegistMail;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{

    /**
     * @var StudentRepositoryInterface|\App\Repositories\Repository
     */
    protected $studentRepo, $facultyRepo, $userRepo;

    public function __construct(StudentRepositoryInterface $studentRepo, FacultyRepositoryInterface $facultyRepo, UserRepositoryInterface $userRepo)
    {
        $this->studentRepo = $studentRepo;
        $this->facultyRepo = $facultyRepo;
        $this->userRepo = $userRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = $this->studentRepo->search($request->all());
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = $this->studentRepo->newModel();
        $faculties = $this->facultyRepo->pluck('id', 'name');

        return view('admin.students.create', compact('student', 'faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        if ($request['name'] == '') {
            $request['name'] = 'student';
        }
        if ($request['birthday'] == '') {
            $request['birthday'] = date('yy/m/d');
        }
        if ($request['address'] == '') {
            $request['address'] = '';
        }
        if ($request['phone'] == '') {
            $request['phone'] = '';
        }
        if ($request['gender'] == '') {
            $request['gender'] = '0';
        }

        $data_user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('12345678'),
        ];
        $user = $this->userRepo->create($data_user);
        $user_id = $user->id;

        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->name . '_' . $avatarName;
            $request->avatar = $avatar->storeAs('images/students', $avatarName);
        } else {
            $request->avatar = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSErd3GQcEwGOfzFCIS2BdXBdOHHPIFwTBdMg&usqp=CAU';
        }
        $request['user_id'] = $user_id;
        $data = $request->all();
        $data['avatar'] = $request->avatar;
        $student = $this->studentRepo->create($data);
        $user = $this->userRepo->find($user_id);
        $mailable = new RegistMail($user);
        Mail::to($request->email)->send($mailable);
        $user->assignRole(2);
        return redirect()->route('students.index')->with('message', 'Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = $this->studentRepo->show_student(Auth::user()->id);
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculties = $this->facultyRepo->pluck('id', 'name');
        $student = $this->studentRepo->find($id);
        return view('admin.students.edit', compact('student', 'faculties', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request['name'] == '') {
            $request['name'] = 'student';
        }
        if ($request['address'] == '') {
            $request['address'] = '';
        }
        if ($request['phone'] == '') {
            $request['phone'] = '';
        }
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->name . '_' . $avatarName;
            $request->avatar = $avatar->storeAs('images/students', $avatarName);
            $data['avatar'] = $request->avatar;
        }
        $student = $this->studentRepo->update($id, $data);
        return redirect()->route('students.index')->with('message', 'Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->studentRepo->delete($id);
        return redirect()->route('students.index')->with('message', 'Successfully');
    }

    public function search_old(Request $request)
    {
        $date = date('Y');
        $formOld = $request['fromOld'];
        $toOld = $request['toOld'];
        if ($formOld > $toOld) {
            $formOld = $request['toOld'];
            $toOld = $request['fromOld'];
        }
        // dd($request);
        $stu = Student::all();
        if ($formOld == '' && $toOld == '') {
            return redirect()->route('students.index');
        } elseif ($formOld == '' | $toOld == '') {
            foreach ($stu as $item) {
                $bits = explode('-', $item->birthday);
                $age = $date - $bits[0];
                if ($age == $toOld) {
                    $_SESSION['students'] = $item;
                    $students[] = $_SESSION['students'];
                }
                else{
                    $students = [];
                }
            }
            return view('admin.students.index', compact('students'));
        } else {
            foreach ($stu as $item) {
                $bits = explode('-', $item->birthday);
                $age = $date - $bits[0];
                
                if ($formOld <= $age && $age <= $toOld) {
                    $_SESSION['students'] = $item;
                    $students[] = $_SESSION['students'];
                }
                else{
                    $students = [];
                }
            }
            return view('admin.students.index', compact('students'));
        }
    }
    
    public function search_point(Request $request){
        $fromPoint = $request['fromPoint'];
        $toPoint = $request['toPoint'];
        if ($fromPoint > $toPoint) {
            $fromPoint = $request['toPoint'];
            $toPoint = $request['fromPoint'];
        }
        $stu = Student::join('student_subject', 'students.id', '=', 'student_subject.student_id')->get();
        if ($fromPoint == '' && $toPoint == '') {
            return redirect()->route('students.index');
        } elseif ($fromPoint == '' | $toPoint == '') {
            foreach ($stu as $item) {
                if ($item->point == $toPoint) {
                    $_SESSION['students'] = $item;
                    $students[] = $_SESSION['students'];
                }
            }
            return view('admin.students.index', compact('students'));
        } else {
            foreach ($stu as $item) {
                if ($fromPoint <= $item->point && $item->point <= $toPoint) {
                    $_SESSION['students'] = $item;
                    $students[] = $_SESSION['students'];
                }
            }
            return view('admin.students.index', compact('students'));
        }
        dd($stu);
    }
}
