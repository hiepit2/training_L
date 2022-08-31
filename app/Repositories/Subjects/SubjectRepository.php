<?php
namespace App\Repositories\Subjects;

use App\Repositories\BaseRepository;

use App\Repositories\Subjects\SubjectRepositoryInterface;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    public function getSubject()
    {
        return $this->model->select('name')->take(5)->get();
    }
}