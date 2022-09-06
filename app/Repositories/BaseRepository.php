<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

   //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * lấy model tương ứng
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

        /**
     * Set model
     */
    public function newModel()
    {
        return new $this->model;
    }

    public function getAll()
    {
        return $this->model->select()->orderby('updated_at','desc')->paginate(3);
    }
    // public function getJoin()
    // {
    //     return $this->model->join('student_subject','stud')->orderby('updated_at','desc')->paginate(3);
    // }
    public function getSome()
    {
        return $this->model->select('id')->get();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function pluck($key, $value)
    {
        return $this->model->pluck($value, $key);
    }

    public function login($email){
        return $this->model->where('email', '=', $email)->get();
    }

  
}