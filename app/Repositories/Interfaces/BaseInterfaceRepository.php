<?php

namespace App\Repositories\Interfaces;

interface BaseInterfaceRepository
{
    function newQuery();
    function doQuery($query = null, $take = 15, $paginate = true, $with = []);
    public function model();
    public function with(array $with);
    public function all($take = 15, $paginate = true, $with = []);
    public function get();
    public function lists($column, $key = null);
    public function findById(int $id, bool $fail = true);
    public function findBySlug($slug);
    public function whereIn($field, array $values);
    public function whereNotIn($field, array $values);
    public function where($field, $value);
    public function create($data);
    public function update($id, $data);
    public function detach($model, $relation, $ids);
    public function updateBySlug($slug, $data);
    public function delete($id);
    public function deleteBySlug($slug);
}
