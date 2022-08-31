<?php
namespace App\Repositories\Faculties;

use App\Repositories\RepositoryInterface;

interface FacultyRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getFaculty();
}