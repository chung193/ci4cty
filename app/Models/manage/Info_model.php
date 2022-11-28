<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class Info_model extends Model
{
    protected $table = 'info';
    
     
    public function getInfo($id = 1)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->where('info.id', $id);
        $query   = $builder->get(); 
        return $query->getRow();
    }

    public function updateInfo($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }
}