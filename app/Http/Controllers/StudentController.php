<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use App\Repositories\Student\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @var StudentRepositoryInterface|\App\Repositories\Repository
     */
    protected $studentRepo, $facultyRepo;

    public function __construct(StudentRepositoryInterface $studentRepo,FacultyRepositoryInterface $facultyRepo)
    {
        $this->studentRepo = $studentRepo;
        $this->facultyRepo = $facultyRepo;
    }
    public function index()
    {
        $students = $this->studentRepo->getAll();
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

        return view('admin.students.create', compact('student','faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->name . '_' . $avatarName;
            $request->avatar = $avatar->storeAs('images/students', $avatarName);
            
        } else {
            $request->avatar = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSErd3GQcEwGOfzFCIS2BdXBdOHHPIFwTBdMg&usqp=CAU';
        }
        $data = $request->all();
        $data['avatar'] = $request->avatar;
        $student = $this->studentRepo->create($data);
        return redirect()->route('students.index')->with('message','Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentRepo->find($id);
        return view('admin.students.edit', compact('student','id'));
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
        $data = $request->all();
        $student = $this->studentRepo->update($id, $data);
        return redirect()->route('students.index')->with('message','Successfully');
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
        return redirect()->route('students.index')->with('message','Successfully');
    }
}
