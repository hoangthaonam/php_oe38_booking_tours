<?php

namespace App\Repositories;
use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface{
    
    protected $model;

    public function __construct(){
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel();

    public function getAll(){
        return $this->model->all();
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function create($data = []){
        $this->model::create($data);
        return true;
    }

    public function update($id, $data = []){
        $result = $this->model::find($id);
        if($result){
            $result->update($data);
            return true;
        }
        return false;
    }

    public function delete($id){
        $result = $this->model::find($id);
        if($result){
            $result->delete($id);
            return true;
        }
        return false;
    }
}
?>