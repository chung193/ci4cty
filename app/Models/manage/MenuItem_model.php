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
            $db      = \Config\Database::connect();
            $builder = $db->table($this->table);
            $builder->select('menu_item.*');
            $builder->join('menu', 'menu.id = menu_item.menu_id');
            $builder->where('menu_item.menu_id', $id);
            $query = $builder->get();
            return $query->getRow();
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