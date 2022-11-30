<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class Category_model extends Model
{
    protected $table = 'category';
     
    public function getCategory($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            $db      = \Config\Database::connect();
            $builder = $db->table($this->table);
            $builder->where('id', $id);
            $query = $builder->get();
            return $query->getRow();
        }   
    }

    public function defaultcat(){
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->set('is_default', 0);
        $builder->update();
    }

    public function saveCategory($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateCategory($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteCategory($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }

    public function countWhere($slug){
        $query = $this->where(['slug' => $slug])->countAllResults();
        return $query;
    }
 
}