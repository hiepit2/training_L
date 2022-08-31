<?php
namespace App\Repositories\Students;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getStudent();
}