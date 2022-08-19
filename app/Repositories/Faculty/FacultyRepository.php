<?php
namespace App\Repositories\Faculty;

use App\Repositories\BaseRepository;

use App\Repositories\Faculty\FacultyRepositoryInterface;

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