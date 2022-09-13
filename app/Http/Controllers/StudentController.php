<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Mail\RegistMail;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Subjects\SubjectRepositoryInterface;
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
    protected $studentRepo, $facultyRepo, $userRepo, $subjectRepo;

    public function __construct(
        StudentRepositoryInterface $studentRepo,
        FacultyRepositoryInterface $facultyRepo,
        UserRepositoryInterface $userRepo,
        SubjectRepositoryInterface $subjectRepo
    ) {
        $this->studentRepo = $studentRepo;
        $this->facultyRepo = $facultyRepo;
        $this->userRepo = $userRepo;
        $this->subjectRepo = $subjectRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count = $this->subjectRepo->getSubject()->count();
        $students = $this->studentRepo->search($request->all())->paginate(3);
        return view('admin.students.index', compact('students', 'count'));
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
        $code = $user_id;
        for ($i = 0; strlen($code) < 6; $i++) {
            $code = '0' . $code;
            $i++;
        }

        $request['code'] = $code;
        $data = $request->all();
        $data['avatar'] = $request->avatar;

        $student = $this->studentRepo->create($data);
        $user = $this->userRepo->find($user_id);
        $user->assignRole(2);
        $mailable = new RegistMail($user);
        Mail::to($request->email)->send($mailable);
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
        $student = $this->studentRepo->find($id);
        $user = $this->userRepo->find($student->user_id)->delete();
        $this->studentRepo->delete($student->id);
        return redirect()->route('students.index')->with('message', 'Successfully');
    }

    public function update_profile(Request $request, $id)
    {
        dd($request);
    }
}
