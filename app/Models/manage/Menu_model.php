<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class Menu_model extends Model
{
    protected $table = 'menu';
     
    public function getMenu($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            $db      = \Config\Database::connect();
            $builder = $db->table($this->table);
            $builder->select('menu.*');
            $builder->where('menu.id', $id);
            $query = $builder->get();
            return $query->getRow();
            // return $this->getWhere(['id' => $id]);
        }   
    }

    public function saveMenu($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateMenu($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteMenu($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }

    public function countWhere($code){
        $query = $this->where(['code' => $code])->countAllResults();
        return $query;
    }
}