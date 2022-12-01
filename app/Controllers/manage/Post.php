<?php namespace App\Controllers\manage;
 
use CodeIgniter\Controller;
use App\Models\manage\Post_model;
use App\Models\manage\Category_model;
use App\Models\manage\Seo_model;
use App\Models\manage\Info_model;

class Post extends BaseController
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
        $model = new Post_model();
        $data['post'] = $model->getPost();
        $data['countpost'] = $model->countAll();
        $data['postpublic'] = $model->getPostPublish();
        $data['countpostpublic'] = $model->getCountPostPublish();
        $data['postdraft'] = $model->getPostDraft();
        $data['countpostdraft'] = $model->getCountPostDraft();
        $data['posttrash'] = $model->getPostTrash();
        $data['countposttrash'] = $model->getCountPostTrash();
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'table',
            'subview'   => '/manage/contents/post/post_view',
            'title'     => "Bài viết",
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
            'subview'   => '/manage/contents/post/add_post_view',
            'title'     => "Thêm bài viết",
            'type' => 'form',
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function save()
    {
        $rules = [
            'title'      => ['label' => 'Tiêu đề','rules' =>'required|max_length[600]'],
            'parentid'   => ['label' => 'Danh mục','rules' =>'required|numeric'],
            'slug'       => ['label' => 'Slug ','rules' => 'max_length[255]|is_unique[post.slug]'],
            'content'       => ['label' => 'Nội dung','rules' =>'required'],
            'img' => [
                'label' => 'Image File',
                'rules' => 'is_image[img]'
                    . '|mime_in[img,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[img,102400]'
                    . '|max_dims[img,204800, 204800]',
            ],
        ];
         
        if($this->validate($rules)){
            if($this->request->getPost('published')){
                $published = $this->request->getPost('published');
            }else{
                $published = 0;
            }

            if($this->request->getFile('img') !== ""){
                $img = $this->request->getFile('img');
                $basename = '';
                if ($img->isValid() && !$img->hasMoved()) {
                    $img->move(ROOTPATH.'/public/uploads/post/');
                    $basename = $img->getName();
                }
            }else{
                $basename = '';
            }
            $model = new Post_model();
            $now = date('Y-m-d H:i:s');
            $session = session();
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
                'parentid' => $this->request->getPost('parentid'),
                'authorid' => $session->get('user_id'),
                'description' => $this->request->getPost('description'),
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'trash' => 0,
                'img' => $basename,
                'published' => $published ,
                'publishat' => $published?$now:0,
                'createdat' => $now,
                'updateat' => $now,
            );
            $model->savePost($data);

            // thêm mới data seo
            $id_inserted = $model->insertID();
            $seo = array(
                'meta_title' => $this->request->getPost('meta_title'),
                'meta_description' => $this->request->getPost('meta_description'),
                'content_type' => 'post',
                'content_id' => $id_inserted
            );
            // print_r($seo);die();
            $this->setSeoContent($seo);
            $session = session();
            $session->setFlashdata('msg', 'Nội dung cập nhật');
            return redirect()->to('/manage/post');
        }else{
            $session = session();
            $session->setFlashdata('post', $_POST);
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/post/add/');
        }
    }

    public function edit($id)
    {
        
            $model = new Post_model();
            $seo_model = new Seo_model();
            $catmodel = new Category_model();
            $data['category'] = $catmodel->getCategory();
            $data['post'] = $model->getPost($id);
            $seo = $this->getSeoContent($id, 'post')->getRow();
            $session = session();
            $data['data'] = array(
                'site' => $this->site,
                'subview'   => '/manage/contents/post/edit_post_view',
                'title'     => "Sửa bài viết",
                'type' => 'form',
                'seo' => $seo,
                'name'      => $session->get('user_name')
            );
            echo view('manage/layout',$data);
    }
 
    public function update()
    {
        $rules = [
            'title'      => ['label' => 'tiêu đề','rules' =>'required|min_length[3]|max_length[600]'],
            'parentid'   => ['label' => 'danh mục','rules' =>'required|numeric'],
            'slug'       => ['label' => 'slug ','rules' => 'max_length[255]|is_unique[post.slug,id,{id}]'],
            'content'       => ['label' => 'nội dung','rules' =>'required'],
        ];
        $id = $this->request->getPost('id');
        if($this->validate($rules)){
            $model = new Post_model();
            
            if($this->request->getPost('published')){
                $published = $this->request->getPost('published');
            }else{
                $published = 0;
            }

            if($this->request->getFile('image') !== ""){
                $img = $this->request->getFile('image');
                $basename = '';
                if ($img->isValid() && !$img->hasMoved()) {
                    $img->move(ROOTPATH.'/public/uploads/post/');
                    $basename = $img->getName();
                }
            }else{
                $basename = '';
            }
            
            if($this->request->getPost('slug') == ""){
                $slug = create_slug($this->request->getPost('title'));
            }else{
                $slug = create_slug($this->request->getPost('slug'));
            }

            $count = $model->countWhere($slug);
            if($count){
                $slug=$slug.'-'.$count;
            }

            $now = date('Y-m-d H:i:s');
            $data = array(
                'title'  => $this->request->getPost('title'),
                'parentid' => $this->request->getPost('parentid'),
                'description' => $this->request->getPost('description'),
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'published' => $published ,
                'publishat' => $published?$now:0,
                'updateat' => $now,
            );

            if($basename != ''){
                $data['img'] = $basename;
            }

            $model->updatePost($data, $id);

            // cập nhật data seo
            $seo_model = new Seo_model();
            $seo_item = $seo_model->getseo($id, 'post')->getRow();
            $seo = array(
                'meta_title' => $this->request->getPost('meta_title'),
                'meta_description' => $this->request->getPost('meta_description'),
                'content_type' => 'post',
                'content_id' => $id
            );
            // print_r($seo);die();
            $this->updateSeoContent($seo, $seo_item->id);
            $session = session();
            $session->setFlashdata('msg', 'Nội dung cập nhật');
            return redirect()->to('/manage/post');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/post/edit/'.$id);
        }
    }

    public function delete($id)
    {
        $model = new Post_model();
        $model->moveTrash($id);
        $session = session();
        $session->setFlashdata('msg', 'Nội dung cập nhật');
        return redirect()->to('/manage/post');
    }

    public function restore($id)
    {
        $model = new Post_model();
        $model->Restore($id);
        $session = session();
        $session->setFlashdata('msg', 'Nội dung cập nhật');
        return redirect()->to('/manage/post');
    }

    public function delete_from_trash($id)
    {
        $model = new Post_model();
        $model->deletePost($id);
        $session = session();
        $session->setFlashdata('msg', 'Nội dung cập nhật');
        return redirect()->to('/manage/post');
    }

}