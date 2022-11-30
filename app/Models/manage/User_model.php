<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class User_model extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['firstname','email','middlename','lastname', 'password','profile','lastlogin','registered','userimage', 'user_group', 'nicename'];

    public function getUser($id = false)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        if($id == 1){
            $builder->select('user.*');
            $builder->where('user.id', $id);
            $query = $builder->get();
            return $query->getRow();
        }

        if($id === false){
            $builder->select('user.*, user_group.name as grname');
            $builder->join('user_group', 'user_group.id = user.group_id');
            $builder->orderBy('id', 'DESC');
            $query = $builder->get();
            return $query->getResultArray();
        }else{
            $builder->select('user.*, user_group.name as grname');
            $builder->join('user_group', 'user_group.id = user.group_id');
            $builder->where('user.id', $id);
            $builder->orderBy('id', 'DESC');
            $query = $builder->get();
            return $query->getRow();
        }   
    }

    public function findById($id)
    {
        return $this->find($id);
    }

    public function getUserByEmail($email = false)
    {
        return $this->where('email', $email)->first();
    }

    public function saveUser($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateUser($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function findSuperAdmin()
    {
        return $this->getWhere(['is_superadmin' => 1]);
    }

    public function deleteUser($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}