<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
      /**
     * @var SubjectRepositoryInterface|\App\Repositories\Repository
     */
    protected $subjectRepo;
    
    public function __construct(SubjectRepositoryInterface $subjectRepo)
    {
        $this->subjectRepo = $subjectRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = $this->subjectRepo->getAll();
        // $subjects = Subject::join('student_subject', 'subject.id', '=');
        return view('admin.subjects.index', compact('subjects'));
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
        $subject = $this->subjectRepo->find($id);
        return view('admin.subjects.form', compact('subject' ,'id'));
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
        $this->subjectRepo->delete($id);
        return redirect()->route('subjects.index')->with('message', 'Successfully');
    }
}
