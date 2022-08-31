<?php
namespace App\Repositories\Faculties;

use App\Repositories\BaseRepository;

use App\Repositories\Faculties\FacultyRepositoryInterface;

class FacultyRepository extends BaseRepository implements FacultyRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Faculty::class;
    }

    public function getFaculty()
    {
        return $this->model->select('name')->take(5)->get();
    }
}