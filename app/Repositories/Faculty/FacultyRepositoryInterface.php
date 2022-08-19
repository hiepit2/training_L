<?php
namespace App\Repositories\Faculty;

use App\Repositories\RepositoryInterface;

interface FacultyRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getFaculty();
}