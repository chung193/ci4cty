<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class User_group_model extends Model
{
    protected $table = 'user_group';
     
    public function getUserGroup($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            $db      = \Config\Database::connect();
            $builder = $db->table($this->table);
            $builder->select('user_group.*');
            $builder->where('id', $id);
            $query = $builder->get();
            return $query->getRow();
        }   
    }

    public function saveUserGroup($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateUserGroup($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteUserGroup($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
 
}