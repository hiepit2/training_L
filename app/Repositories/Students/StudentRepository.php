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
        $student = $this->model->newQuery()->with('subjects');

        if (isset($data['age_from'])) {
            $student->whereYear('birthday', '<=', Carbon::now()->subYear($data['age_from'])->format('Y'));
        }

        if (isset($data['age_to'])) {
            $student->whereYear('birthday', '>=', Carbon::now()->subYear($data['age_to'])->format('Y'));
        }

        // if (isset($data['point_from']) && !isset($data['point_to'])) {
        //     $student->where('point', '>=', $data['point_from']);
        // }

        // if (isset($data['point_to']) && !isset($data['point_from'])) {
        //     $student->where('point', '<=', $data['point_to']);
        // }

        // if (isset($data['point_to']) && isset($data['point_from'])) {
        //     $student->where('point', '>=', $data['point_from']);
        //     $student->where('point', '<=', $data['point_to']);
        // }

        return $student->paginate(3)->withQueryString();
    }

    public function show_student($id){
        return $this->model->where('user_id', '=', $id)->first();
    }

}
