<?php

namespace App\Http\Controllers;

use App\Exports\SubjectsExport;
use App\Http\Requests\SubjectRequest;
use App\Imports\SubjectsImport;
use App\Mail\AutoMail;
use App\Mail\Mail_subject;
use App\Mail\RegistMail;
use App\Models\Student;
use App\Models\Student_subject;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

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
        $subjects = $this->subjectRepo->withStudent()->get();
        if (Auth::user()->roles[0]->name == 'teacher') {
            $subjects = $this->subjectRepo->withStudent()->paginate(3);
            return view('admin.subjects.index', compact('subjects'));
        }
        $student = Student::where('user_id', Auth::id())->first();
        // dd($student);
        $sum = $average = 0;
        $subject_point = $student->subjects;
        if (!isset($subject_point[0])) {
            $subjects = $this->subjectRepo->withStudent()->paginate(3);
            $subject_po = 1;
            return view('admin.subjects.index', compact('subjects', 'subject_po', 'student', 'average'));
        }

        if ($subject_point->count() == $subjects->count()) {
            foreach ($subject_point as $item) {
                if ($item->pivot->point) {
                    $sum += $item->pivot->point;
                } else {
                    $sum = 0;
                    break;
                }
            }
            $average = round($sum / $subject_point->count(), 2);
        }
        $subjects = $this->subjectRepo->withStudent()->paginate(3);
        return view('admin.subjects.index', compact('subjects', 'subject_point', 'student', 'average'));
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
        $subjects = $this->subjectRepo->withStudent();
        $student = $this->studentRepo->find($id);
        $subject_po = $student->subjects;
        $sum = 0;
        $average = 0;
        if ($subject_po->count() == $subjects->count()) {
            foreach ($subject_po as $item) {
                if ($item->pivot->point) {
                    $sum += $item->pivot->point;
                } else {
                    $sum = 0;
                    break;
                }
            }
            $average = round($sum / $subject_po->count(), 2);
        }
        $subject_point = $student->subjects()->paginate(3);
        return view('admin.subjects.show', compact('subject_point', 'student', 'average'));
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

    public function sub_subject(Request $request)
    {
        $students = $this->studentRepo->newModel();
        $studentId = Student::where('user_id', '=', Auth::user()->id)->first()->id;
        $subject = $students->subjects()->attach($request->subject_id, ['student_id' => $studentId]);
        return redirect()->route('subjects.index')->with('message', 'Successfully');
    }

    //send mail subjects to person
    public function mail_subjects($id)
    {
        $subs = Subject::all();
        $subjects = $this->subjectRepo->withStudent();
        $listSubject = [];
        $student = $this->studentRepo->find($id);
        $subject_point = $student->subjects;
        if ($subject_point->count() == 0) {
            $listSubject = $subs;
        } else {
            foreach ($subs as $sub) {
                for ($i = 0; $i < $subject_point->count(); $i++) {
                    if ($sub->id == $subject_point[$i]->id) {
                        break;
                    } elseif ($i == $subject_point->count() - 1) {
                        $listSubject[] =  $sub;
                    }
                }
            }
        }

        $mailable = new Mail_subject($listSubject);
        Mail::to($student->email)->send($mailable);
        return redirect()->route('students.index')->with('message', 'Successfully');
    }

    //send mail subjects to people
    public function mail_subjects_all()
    {
        $subs = Subject::all();
        $subjects = $this->subjectRepo->withStudent();
        $students = Student::all();
        foreach ($students as $student) {
            if ($student->subjects->count() !== $subs->count()) {
                $listIds[] = $student->id;
            }
        }

        foreach ($listIds as $value) {
            $listSubject = [];
            $student = $this->studentRepo->find($value);
            $subject_point = $student->subjects;
            if ($subject_point->count() == 0) {
                $listSubject = $subs;
            } else {
                foreach ($subs as $sub) {
                    for ($i = 0; $i < $subject_point->count(); $i++) {
                        if ($sub->id == $subject_point[$i]->id) {
                            break;
                        } elseif ($i == $subject_point->count() - 1) {
                            $listSubject[] =  $sub;
                        }
                    }
                }
            }
            $mailable = new Mail_subject($listSubject);
            Mail::to($student->email)->send($mailable);
        }
        return redirect()->route('students.index')->with('message', 'Successfully');
    }

    //create point
    public function create_point($id)
    {
        $student_all = Student::with('subjects')->get();
        // $count = $student_all->count();
        foreach ($student_all as $student) {
            foreach ($student->subjects as $item) {
                if ($item->pivot->subject_id == $id) {
                    $students[] = $student;
                }
            }
        }
        return view('admin.subjects.create_point', compact('students', 'id'));
    }

    //store_point
    public function store_point(Request $request, $id)
    {
        $student = $this->studentRepo->findStudent($id);
        for ($i = 0; $i < $student->subjects->count(); $i++) {
            if ($request['point'][$i] != 'null') {
                $student->subjects[$i]->pivot->update([
                    'point' => $request['point'][$i]
                ]);
            }
        }
        return redirect()->back();
    }

    public function impost_subjects($id)
    {
        $subject = $id;
        return view('admin.subjects.import', compact('id'));
    }

    public function upload_subjects(Request $request, $id)
    {
        $subject = $this->subjectRepo->withStudent()->find($id);
        $imports = Excel::toCollection(new SubjectsImport($id), request()->file('import_file'));
        foreach ($imports[0] as $import) {
            foreach ($subject->students as $student) {
                // dd($student->pivot->subject_id);
                if ($import['id'] == $student['id']) {
                    $student->pivot->where('subject_id', '=', $id)
                        ->where('student_id', '=', $student['id'])
                        ->update([
                            'point' => $import['point'],
                        ]);
                    // break;
                }
            }
        }
        // $subjects = Excel::import(new SubjectsImport($id), $file);
        return redirect()->route('subjects.index')->with('message', 'Subject Imported Successfully');
    }

    public function export_subjects($id)
    {
        return Excel::download(new SubjectsExport($id), 'subjects.xlsx');
    }

    public function mail_avg()
    {
        $subjects = $this->subjectRepo->newModel()->get();
        $students = $this->studentRepo->newModel()->with('subjects')->get();
        $listStudent = [];
        foreach ($students as $student) {
            if ($student->subjects->count() == $subjects->count()) {
                for ($i = 0; $i < $subjects->count(); $i++) {
                    if (!$student->subjects[$i]->pivot->point) {
                        break;
                    } elseif ($i == $subjects->count() - 1) {
                        $avg = $student->subjects->avg('pivot.point', 2);
                        if (!$student['status']) {
                            if ($avg < 5) {
                                $student['status'] = '1';
                                $student->update([
                                    'status' => $student['status']
                                ]);
                                $student['avg'] = $avg;
                                $mailable = new AutoMail($student);
                                Mail::to($student->email)->send($mailable);
                            }
                        }
                    }
                }
            }
        }

      
    }
}
