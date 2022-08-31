<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();
    /**
     * Get all
     * @return mixed
     */
    public function getSome();

    public function newModel();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Update
     * @param $key
     * @param $value
     * @return mixed
     */
    public function pluck($key, $value);

    /**
     * Update
     * @param $email
    
     * @return mixed
     */
    public function login($email);

    /**
     * Update
     * @param $id
     * 
     * @return mixed
     */
    public function show_student($id);

}
