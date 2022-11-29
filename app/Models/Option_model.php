<?php namespace App\Models;
use CodeIgniter\Model;
 
class Option_model extends Model
{
    protected $table = 'options';
     
    public function getOptions($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
 
}