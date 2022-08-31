<?php
namespace App\Repositories\Users;

use App\Repositories\BaseRepository;

use App\Repositories\Users\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUser()
    {
        return $this->model->select('email')->take(5)->get();
    }
}