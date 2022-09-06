<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Student;
use App\Models\Student_subject;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * @var SubjectRepositoryInterface|\App\Repositories\Repository
     */
    protected $subjectRepo, $studentRepo;

    public function __construct(SubjectRepositoryInterface $subjectRepo, StudentRepositoryInterface $studentRepo)
    {
        $this->subjectRepo = $subjectRepo;
        $this->studentRepo = $studentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->roles[0]->name);
        $subjects = $this->subjectRepo->withStudent()->paginate(3);
        if (Auth::user()->roles[0]->name == 'teacher') {
            return view('admin.subjects.index', compact('subjects'));
        }
        $student = Student::where('user_id', Auth::id())->first();
        $subject_point = $student->subjects;
       
        if(!isset($subject_point[0])){
            $subject_po = 1;
            return view('admin.subjects.index', compact('subjects', 'subject_po', 'student'));
        }
        return view('admin.subjects.index', compact('subjects', 'subject_point', 'student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = $this->subjectRepo->newModel();
        return view('admin.subjects.form', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $data = $request->all();
        $subject = $this->subjectRepo->create($data);
        return redirect()->route('subjects.index')->with('message', 'Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->subjectRepo->find($id);
        return view('admin.subjects.form', compact('subject', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, $id)
    {
        $data = $request->all();
        $subject = $this->subjectRepo->update($id, $data);
        return redirect()->route('subjects.index')->with('message', 'Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subjects = $this->subjectRepo->withStudent()->find($id);

        if (isset($subjects->students[0])) {
            return redirect()->route('subjects.index')->with('error', 'Unsuccessfully');
        } else {
            $this->subjectRepo->delete($id);
            return redirect()->route('subjects.index')->with('message', 'Successfully');
        }
    }

    public function sub_subject(Request $request, $id){
        dd($request);
    }
}
