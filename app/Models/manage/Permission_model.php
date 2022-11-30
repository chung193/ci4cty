<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class Permission_model extends Model
{
    protected $table = 'permission';
     
    public function getPermission($id = false)
    {
        if($id === false){
            $db      = \Config\Database::connect();
            $builder = $db->table($this->table);
            $builder->select('permission.*, user_group.name as grname');
            $builder->join('user_group','user_group.id = permission.group_id');
            $query = $builder->get();
            return $query->getResultArray();
        }else{
            $db      = \Config\Database::connect();
            $builder = $db->table($this->table);
            $builder->select('permission.*, user_group.name as grname');
            $builder->join('user_group','user_group.id = permission.group_id');
            $builder->where('user_group.id', $id);
            $query = $builder->get();
            return $query->getRow();
            // return $this->getWhere(['id' => $id]);
        }   
    }

    public function savePermission($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePermission($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deletePermission($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }

    public function countWhere($code){
        $query = $this->where(['code' => $code])->countAllResults();
        return $query;
    }
}