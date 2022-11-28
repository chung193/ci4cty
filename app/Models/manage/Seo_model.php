<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class Seo_model extends Model
{
    protected $table = 'seo';
     
    public function getseo($id = false, $type = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['content_id' => $id, 'content_type' => $type]);
        }   
    }

    public function saveseo($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateseo($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteseo($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }

    
 
}