<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            "name" => $row['name'],
            "email" => $row['email']
        ]);

        DB::table('students')->with('subjects')->get();
    }
}
