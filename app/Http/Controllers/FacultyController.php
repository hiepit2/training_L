<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function list()
    {
        $faculty = Faculty::all();

        return view('admin.faculties.list', [
            'faculty' => $faculty,
        ]);
    }
    public function create()
    {
        return view('admin.faculties.create');
    }
    public function store(Request $request)
    {
        $faculty = new Faculty();
        $faculty->fill($request->all());
        $faculty->save();
        return redirect()->route('faculties.list');
    }
    public function edit(Faculty $faculty)
    {
        return view('admin.faculties.edit',[
            'faculty'=>$faculty
        ]);
    }
    public function update(Request $request,Faculty $faculty){
        $faculty->name = $request->name;
        $faculty->save();
        return redirect()->route('faculties.list');
        
    }
    public function delete($id){
        $faculty = Faculty::find($id);
        $faculty->delete();
        return redirect()->back();
    }
}
