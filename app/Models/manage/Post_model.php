<?php namespace App\Models\manage;
use CodeIgniter\Model;
 
class Post_model extends Model
{
    protected $table = 'post';
    
     
    public function getPost($id = false)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        
        if($id === false){
            $builder->select('post.*, category.title as cattitle, user.nicename as username');
            $builder->join('category', 'category.id = post.parentid');
            $builder->join('user', 'user.id = post.authorid');
            $builder->orderBy('id', 'DESC');
            $query = $builder->get();
            return $query->getResultArray();
        }else{
            $builder->select('post.*, category.title as cattitle, user.nicename as username');
            $builder->join('category', 'category.id = post.parentid');
            $builder->join('user', 'user.id = post.authorid');
            $builder->where('post.id', $id);
            $query = $builder->get();
            return $query->getRow();
        }   
    }

    public function countAll(){
        $query = $this->db->table($this->table);
        return $query->countAll();
    }

    public function countWhere($slug){
        $query = $this->where(['slug' => $slug])->countAllResults();
        return $query;
    }

    public function getPostPublish(){
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('post.*, category.title as cattitle, user.nicename as username');
        $builder->join('category', 'category.id = post.parentid');
        $builder->join('user', 'user.id = post.authorid');
        $builder->where('post.published', 1);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getCountPostPublish(){
        $query = $this->where(['published' => 1])->countAllResults();
        return $query;
    }

    public function getPostTrash(){
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('post.*, category.title as cattitle, user.nicename as username');
        $builder->join('category', 'category.id = post.parentid');
        $builder->join('user', 'user.id = post.authorid');
        $builder->where('trash', 1);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getCountPostTrash(){
        $query = $this->where(['trash' => 1])->countAllResults();
        return $query;
    }

    public function getPostDraft(){
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select('post.*, category.title as cattitle, user.nicename as username');
        $builder->join('category', 'category.id = post.parentid');
        $builder->join('user', 'user.id = post.authorid');
        $builder->where('post.published', 0);
        $builder->where('post.trash', 0);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getCountPostDraft(){
        $query = $this->where(['published' => 0, 'trash' => 0])->countAllResults();
        return $query;
    }
 
    public function savePost($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePost($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function moveTrash($id)
    {
        $builder = $this->db->table($this->table);
        $data = [
            'trash'  => 1,
            'published' => 0
        ];
        
        $builder->where('id', $id);
        $builder->update($data);
    }

    public function Restore($id)
    {
        $builder = $this->db->table($this->table);
        $data = [
            'trash'  => 0,
            'published' => 1
        ];
        
        $builder->where('id', $id);
        $builder->update($data);
    }

    public function deletePost($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}