<?php

namespace App\Exports;

use App\Models\Student;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    private $id;

    public function __construct($id) 
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $student = Student::where('id', $this->id)->get();
        dd($student);
        // return Student::all();
    }
}
