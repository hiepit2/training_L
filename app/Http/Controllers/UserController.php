<?php

namespace App\Http\Controllers;

use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\Students\StudentRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\Repository
     */
    protected $studentRepo, $userRepo, $facultyRepo;

    public function __construct(UserRepositoryInterface $userRepo, StudentRepositoryInterface $studentRepo, FacultyRepositoryInterface $facultyRepo)
    {
        $this->studentRepo = $studentRepo;
        $this->userRepo = $userRepo;
        $this->facultyRepo = $facultyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faculties = $this->facultyRepo->getAll();
        return view('users.students.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login()
    {
        $users = $this->userRepo->newModel();
        return view('users.login.login', compact('users'));
    }
    public function check_login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ]))
            return view('admin.dashboard');
        // {
        // if (Auth::user()->roles[0]['name'] === 'teacher') {
        // } else {
        //     return redirect()->route('users.index');
        // }
        //} 
        else {
            return redirect()->route('users.login');
        };
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('users.login');
    }
}
