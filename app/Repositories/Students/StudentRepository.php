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
        return $this->model->select('name','address','birthday','phone','gender','email','avatar','faculty_id')->take(5)->get();
    }

    public function search($data)
    {
        $student = $this->model->newQuery();

        if(isset($data['age_from'])) {
            $student->whereYear('birthday', '<=', Carbon::now()->subYear($data['age_from'])->format('Y'));
        }

        if(isset($data['age_to'])) {
            $student->whereYear('birthday', '>=', Carbon::now()->subYear($data['age_to'])->format('Y'));
        }

//dd(        $student->first());
        return $student->paginate(3);
    }
}