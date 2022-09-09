<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
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
        //
        $subjects = $this->subjectRepo->withStudent()->get();
        if (Auth::user()->roles[0]->name == 'teacher') {
            return view('admin.subjects.index', compact('subjects'));
        }
        $student = Student::where('user_id', Auth::id())->first();
        
        $subject_point = $student->subjects;
        if (!isset($subject_point[0])) {
            $subject_po = 1;
            return view('admin.subjects.index', compact('subjects', 'subject_po', 'student'));
        }
        
        $sum = $average = 0;
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
                    if ($sub->id != $subject_point[$i]->id) {
                        $listSubject[] =  $sub;
                    }
                }
            }
        }
        $mailable = new Mail_subject($listSubject);
        Mail::to($student->email)->send($mailable);
        return redirect()->route('subjects.index')->with('message', 'Successfully');
    }

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
                        if ($sub->id != $subject_point[$i]->id) {
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
}
