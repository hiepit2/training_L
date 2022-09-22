<?php

namespace App\Repositories\Students;

use App\Repositories\BaseRepository;

use App\Repositories\Students\StudentRepositoryInterface;
use Carbon\Carbon;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function getStudent()
    {
        return $this->model->select()->take(5)->get();
    }

    public function search($data)
    {
        $students = $this->model->newQuery()->with('subjects')->orderby('updated_at','desc');

        if (isset($data['age_from'])) {
            $students->whereYear('birthday', '<=', Carbon::now()->subYear($data['age_from'])->format('Y'));
        }

        if (isset($data['age_to'])) {
            $students->whereYear('birthday', '>=', Carbon::now()->subYear($data['age_to'])->format('Y'));
        }
        
        // if (isset($data['point_from'])) {
        //     $students->has('subjects', function ($q) {
        //         $avg = round($q->subjects->avg('pivot.point', 2));
        //         $q->where($avg, '=', 5);
        //     });
        // }
        
        return $students;
    }

    public function show_student($id)
    {
        return $this->model->where('user_id', '=', $id)->first();
    }

    public function findStudent($id){
        return $this->model->where('id', '=', $id)->with('subjects')->first();
    }

}
