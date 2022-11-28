<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class User_model extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['firstname','email','middlename','lastname', 'password','profile','lastlogin','registered','userimage', 'role', 'nicename', 'is_superadmin'];

    public function getUser($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
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