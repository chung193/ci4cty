<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class Option_model extends Model
{
    protected $table = 'options';
    
    public function getOption($name = false)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        if($name === false){
            $builder->select('options.*');
            $query = $builder->get();
            return $query->getResultArray();
        }else{
            $builder->select('options.*');
            $builder->where('options.name', $name);
            $query = $builder->get();
            return $query->getResultArray();
        }   
    }

    public function updateOption($data)
    {
        foreach($data as $key){
            foreach($key as $k => $value){
                $data = array('value'=>$value);
                $this->db->table($this->table)->update($data, array('name' => str_replace("'","",$k)));
            }
        }
    }

    
}