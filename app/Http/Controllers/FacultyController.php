<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRequest;
use App\Models\Faculty;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * @var FacultyRepositoryInterface|\App\Repositories\Repository
     */
    protected $facultyRepo;

    public function __construct(FacultyRepositoryInterface $facultyRepo)
    {
        $this->facultyRepo = $facultyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = $this->facultyRepo->getAll();
        return view('admin.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculty = new Faculty();
        return view('admin.faculties.create', compact('faculty'));
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
        return redirect()->route('faculties.index')->with('message','Successfully');
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
        return view('admin.faculties.create', compact('faculty','id'));
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
        $faculty = $this->facultyRepo->update($id, $data);
        return redirect()->route('faculties.index')->with('message','Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->facultyRepo->delete($id);
        return redirect()->route('faculties.index')->with('message','Successfully');
    }
}
