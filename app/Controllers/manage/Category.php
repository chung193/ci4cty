<?php namespace App\Controllers\manage;
 
use CodeIgniter\Controller;
use App\Models\manage\Category_model;
use App\Models\manage\Info_model;
use App\Models\manage\Seo_model;

class Category extends BaseController
{
    public $site;
    function __construct()
    {

        $info_md = new Info_model();
        $this->site = array(
            'info' => $info_md->getInfo()
        );
    }
    public function index()
    {
        $model = new Category_model();
        $data['category'] = $model->getCategory();
        $session = session();
        $subview = '/manage/contents/category/category_view';
    
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => $subview,
            'title'     => "Danh mục",
            'type' => 'table',
            'name'      => $session->get('user_name')
        );
        
        echo view('manage/layout',$data);
    }

    public function add()
    {
        $session = session();
        $model = new Category_model();
        $data['category'] = $model->getCategory();
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => '/manage/contents/category/add_category_view',
            'title'     => "Thêm danh mục",
            'type' => 'form',
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function save()
    {
        $rules = [
            'title'      => ['label' => 'tiêu đề','rules' =>'required|max_length[600]'],
        ];
         
        if($this->validate($rules)){
            $model = new Category_model();
            if($this->request->getPost('slug') == ""){
                $slug = create_slug($this->request->getPost('title'));
            }else{
                $slug = create_slug($this->request->getPost('slug'));
            }
            $count = $model->countWhere($slug);
            if($count){
                $slug=$slug.'-'.$count;
            }

            $data = array(
                'title'     => $this->request->getPost('title'),
                'slug' => $slug,
            );
            $model->saveCategory($data);
            // thêm mới data seo
            $id_inserted = $model->insertID();
            $seo = array(
                'meta_title' => $this->request->getPost('meta_title'),
                'meta_description' => $this->request->getPost('meta_description'),
                'content_type' => 'category',
                'content_id' => $id_inserted
            );

            $this->setSeoContent($seo);
            $session = session();
            $session->setFlashdata('msg', 'Dữ liệu cập nhật');
            return redirect()->to('/manage/category');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/category/add/');
        }
    }

    public function edit($id=false)
    {
        $model = new Category_model();
        $data['category_list'] = $model->getCategory();
        $data['category'] = $model->getCategory($id);
        $seo = $this->getSeoContent($id, 'category')->getRow();
        //print_r($seo);die();
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => '/manage/contents/category/edit_category_view',
            'title'     => "Sửa danh mục",
            'type' => 'form',
            'seo' => $seo,
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function update()
    {
        $rules = [
            'title' => ['label' => 'tiêu đề','rules' =>'required|max_length[600]'],
        ];

        $id = $this->request->getPost('id');
         
        if($this->validate($rules)){
            $model = new Category_model();

            if($this->request->getPost('slug') == ""){
                $slug = create_slug($this->request->getPost('title'));
            }else{
                $slug = create_slug($this->request->getPost('slug'));
            }
            $count = $model->countWhere($slug);
            if($count){
                $slug=$slug.'-'.$count;
            }
            $data = array(
                'title'  => $this->request->getPost('title'),
                'slug' => $this->request->getPost('slug'),
            );
            $model->updateCategory($data, $id);

             // cập nhật data seo
             $seo_model = new Seo_model();
             $seo_item = $seo_model->getseo($id, 'category')->getRow();
             $seo = array(
                 'meta_title' => $this->request->getPost('meta_title'),
                 'meta_description' => $this->request->getPost('meta_description'),
                 'content_type' => 'category',
                 'content_id' => $id
             );
             // print_r($seo);die();
            $this->updateSeoContent($seo, $seo_item->id);
            $session = session();
            $session->setFlashdata('msg', 'Dữ liệu cập nhật');
            return redirect()->to('/manage/category');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/category/edit/'.$id);
        }
    }

    public function delete($id)
    {
        $model = new Category_model();
        $model->deleteCategory($id);
        $session = session();
        $session->setFlashdata('msg', "Lưu thay đổi");
        return redirect()->to('/manage/category');
    }

}