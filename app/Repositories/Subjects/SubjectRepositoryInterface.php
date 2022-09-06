<?php
namespace App\Repositories\Subjects;

use App\Repositories\RepositoryInterface;

interface SubjectRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getSubject();

    public function withStudent();

}