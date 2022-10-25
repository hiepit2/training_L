<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use App\Models\User;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role_has_permissions;

class FacultyController extends Controller
{
    /**
     * @var FacultyRepositoryInterface|\App\Repositories\Repository
     */
    protected $facultyRepo;
    protected $studentRepo;
    protected $subjectRepo;

    public function __construct(
        FacultyRepositoryInterface $facultyRepo,
        StudentRepositoryInterface $studentRepo,
        SubjectRepositoryInterface $subjectRepo,
    ) {
        $this->facultyRepo = $facultyRepo;
        $this->studentRepo = $studentRepo;
        $this->subjectRepo = $subjectRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locale = App::currentLocale();
        // dd($locale);
        $student = $this->studentRepo->show_student(Auth::user()->id);
        $faculties = $this->facultyRepo->getAll();
        return view('admin.faculties.index', compact('faculties', 'student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculty = $this->facultyRepo->newModel();
        return view('admin.faculties.form', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRequest $request)
    {
        $data = $request->all();
        $faculty = $this->facultyRepo->create($data);
        return redirect()->route('faculties.index')->with('message', __('welcome.succesfully'));
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
        $faculty = $this->facultyRepo->find($id);
        return view('admin.faculties.form', compact('faculty', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyRequest $request, $id)
    {
        $data = $request->all();
        $this->facultyRepo->update($id, $data);
        return redirect()->route('faculties.index')->with('message', __('welcome.succesfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $this->facultyRepo->delete($id);
        return redirect()->route('faculties.index')->with('message', __('welcome.succesfully'));
    }

    public function updateFaculty(Request $request)
    {
        $student = $this->studentRepo->show_student(Auth::user()->id);
        $subjects = $this->subjectRepo->getSubject();
        if (!$student->faculty_id) {
            if ($student->subjects->count() != $subjects->count()) {
                return redirect()->back()->with('error', __('welcome.register-faculty-dont-subjects'));
            } else {
                for ($i = 0; $i < $student->subjects->count(); $i++) {
                    if (!$student->subjects[$i]->pivot->point) {
                        return redirect()->back()->with('error', __('welcome.register-faculty-dont-avg'));
                    } elseif ($i == $student->subjects->count() - 1) {
                        $avg = round($student->subjects->avg('pivot.point', 2));
                        if ($avg < 5) {
                            return redirect()->back()->with('error', __('welcome.register-faculty-avg') . ' ' . $avg .'. ' . __('welcome.register-faculty-not'));
                        } else {
                            $data = [
                                'faculty_id' => $request->faculty_id,
                            ];
                            $this->studentRepo->update($student->id, $data);
                            return redirect()->back()->with('message', __('welcome.succesfully'));
                        }
                    }
                }
            }
        }
    }
}
