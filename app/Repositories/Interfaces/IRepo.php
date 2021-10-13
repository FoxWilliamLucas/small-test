<?php

namespace App\Repositories\Interfaces;



interface IRepo {

    function model();

    /**
     * Set the repository model.
     *
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel();

    /**
     * @param array $columns
     * 
     * @return mixed
     */
    public function paginate($columns = ['*'], $query = null);

    /**
     * @param array $columns
     * 
     * @return mixed
     */
    public function get($columns = ['*'], $query = null);

    /**
     * @param array $data
     * 
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param mixed $id
     * @param string $attribute
     * 
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id');

    /**
     * @param mixed $id
     * 
     * @return mixed
     */
    public function delete($id);

    /**
     * @param mixed $id
     * @param array $columns
     * 
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param mixed $attribute
     * @param mixed $value
     * @param array $columns
     * 
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*']);
    
    /**
     * @param mixed $datas
     * 
     * @return mixed
     * 
     * insert multiple rows by one query
     */
    public function insert($data);

    /**
     * @param array $array
     * 
     * @return mixed
     */
    public function load($model, $array);
}