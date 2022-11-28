<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class MenuItem_model extends Model
{
    protected $table = 'menu_item';
     
    public function getMenuItem($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }


    public function saveMenuItem($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateMenuItem($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteMenuItem($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}