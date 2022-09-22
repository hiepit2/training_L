<?php
namespace App\Repositories\Students;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getStudent();

    public function search($data);

    public function show_student($id);

    public function findStudent($id);
}