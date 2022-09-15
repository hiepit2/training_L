<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectsImport implements ToModel, WithHeadingRow
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $subject = Subject::with('students')->whereHas('students', function ($q) {
            $q->where('subject_id', $this->id);
        })->get();
        // dd($subject[0]);
        $data = ['1'];
        
        dd($subject[0]->students);
        foreach ($subject[0]->students as $student) {
            if ($student->id == $row['id']) {
                // return new Subject([
                //     ]);
                $data[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'point' => $row['point']

                ];
            }
        }
    }
}
