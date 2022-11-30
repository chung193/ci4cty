<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class Page_model extends Model
{
    protected $table = 'page';
     
    public function getPage($id = false)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        if($id === false){
            $builder->select('page.*, user.nicename as username');
            $builder->join('user', 'user.id = page.authorid');
            $query = $builder->get();
            return $query->getResultArray();
        }else{
            $builder->select('page.*, user.nicename as username');
            $builder->join('user', 'user.id = page.authorid');
            $builder->where('page.id', $id);
            $query = $builder->get();
            return $query;
        }   
    }

    public function countWhere($slug){
        $query = $this->where(['slug' => $slug])->countAllResults();
        return $query;
    }

    public function countAll(){
        $query = $this->countAllResults();
        return $query;
    }

    public function getPageDraft(){
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('page.*, user.nicename as username');
        $builder->join('user', 'user.id = page.authorid');
        $builder->where('page.published', 0);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getCountPageDraft(){
        $query = $this->where(['published' => 0])->countAllResults();
        return $query;
    }

    public function getPagePublish(){
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('page.*,  user.nicename as username');
        $builder->join('user', 'user.id = page.authorid');
        $builder->where('page.published', 1);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getCountPagePublish(){
        $query = $this->where(['published' => 1])->countAllResults();
        return $query;
    }
 
    public function savePage($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePage($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deletePage($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}