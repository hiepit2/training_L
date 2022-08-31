<?php
namespace App\Repositories\Students;

use App\Repositories\BaseRepository;

use App\Repositories\Students\StudentRepositoryInterface;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function getStudent()
    {
        return $this->model->select('name','address','birthday','phone','gender','email','avatar','faculty_id')->take(5)->get();
    }
}