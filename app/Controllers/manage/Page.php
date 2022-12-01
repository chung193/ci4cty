<?php namespace App\Controllers\manage;
 
use CodeIgniter\Controller;
use App\Models\manage\Page_model;
use App\Models\manage\Seo_model;
use App\Models\manage\Info_model;

class Page extends BaseController
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
        $model = new Page_model();
        $data['page'] = $model->getPage();
        $data['countall'] = $model->countAll();
        $data['pagePublic'] = $model->getPagePublish();
        $data['countpagepublic'] = $model->getCountPagePublish();
        $data['pagedraft'] = $model->getPageDraft();
        $data['countpagedraft'] = $model->getCountPageDraft();
        $session = session();
        $subview = '/manage/contents/page/page_view';
        
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => $subview,
            'type' => 'table',
            'title'     => "Trang",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }

    public function add()
    {
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => '/manage/contents/page/add_page_view',
            'title'     => "Thêm trang",
            'type' => 'form',
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function save()
    {
        $rules = [
            'title'      => ['label' => 'tiêu đề','rules' =>'required|max_length[600]'],
            'description'=> ['label' => 'nội dung', 'rules' => 'required|max_length[200]'],
            'img' => [
                'label' => 'file ảnh',
                'rules' => 'is_image[img]'
                    . '|mime_in[img,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[img,102400]'
                    . '|max_dims[img,204800, 204800]',
            ],
        ];
         
        // print_r($this->request); die();
        if($this->validate($rules)){
            if($this->request->getFile('img') !== ""){
                $img = $this->request->getFile('img');
                $basename = 'default.jpg';
                if ($img->isValid() && !$img->hasMoved()) {
                    $img->move(ROOTPATH.'/public/uploads/page/');
                    $basename = $img->getName();
                }
            }else{
                $basename = 'default.jpg';
            }
            $model = new Page_model();
            $now = date('Y-m-d H:i:s');
            $session = session();
            if($this->request->getPost('published')){
                $published = $this->request->getPost('published');
            }else{
                $published = 0;
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


            $data = array(
                'title'  => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'authorid' => $session->get('user_id'),
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'published' => $published ,
                'publishat' => $published?$now:0,
                'createdat' => $now,
                'updateat' => $now,
                'img' => $basename
            );
            $model->savePage($data);
            // thêm mới data seo
            $id_inserted = $model->insertID();
            $seo = array(
                'meta_title' => $this->request->getPost('meta_title'),
                'meta_description' => $this->request->getPost('meta_description'),
                'content_type' => 'page',
                'content_id' => $id_inserted
            );
            $this->setSeoContent($seo);
            $session = session();
            $session->setFlashdata('post', $_POST);
            $session->setFlashdata('msg', "Những thay đổi của bạn đã được lưu lại");
            return redirect()->to('/manage/page');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/page/add/');
        }
    }

    public function edit($id)
    {
        $model = new Page_model();
        $data['page'] = $model->getPage($id)->getRow();
        $seo = $this->getSeoContent($id, 'page')->getRow();
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'form',
            'subview'   => '/manage/contents/page/edit_page_view',
            'title'     => "Sửa trang",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function update()
    {
        $rules = [
            'title'      => ['label' => 'tiêu đề','rules' =>'required|min_length[3]|max_length[600]'],
        ];
        $id = $this->request->getPost('id');
        if($this->validate($rules)){

            if($this->request->getFile('image') !== ""){
                $img = $this->request->getFile('image');
                $basename = 'default.jpg';
                if ($img->isValid() && !$img->hasMoved()) {
                    $img->move(ROOTPATH.'/public/uploads/page/');
                    $basename = $img->getName();
                }
            }else{
                $basename = 'default.jpg';
            }
            $model = new Page_model();
            $now = date('Y-m-d H:i:s');
            $session = session();
            if($this->request->getPost('published')){
                $published = $this->request->getPost('published');
            }else{
                $published = 0;
            }
            if($this->request->getPost('slug') == ""){
                $slug = create_slug($this->request->getPost('title'));
            }else{
                $slug = create_slug($this->request->getPost('slug'));
            }
            
            $data = array(
                'title'  => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'published' => $published ,
                'publishat' => $published?$now:0,
                'createdat' => $now,
                'updateat' => $now,
                'img' => $basename
            );
            $model->updatePage($data, $id);

             // cập nhật data seo
             $seo_model = new Seo_model();
             $seo_item = $seo_model->getseo($id,'page')->getRow();
             $seo = array(
                 'meta_title' => $this->request->getPost('meta_title'),
                 'meta_description' => $this->request->getPost('meta_description'),
                 'content_type' => 'page',
                 'content_id' => $id
             );
             // print_r($seo);die();
             $this->updateSeoContent($seo, $seo_item->id);
            $session = session();
            $session->setFlashdata('msg', "Những thay đổi của bạn đã được lưu lại");
            return redirect()->to('/manage/page');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/page/edit/'.$id);
        }
    }

    public function delete($id)
    {
        $model = new Page_model();
        $model->deletePage($id);
        $session = session();
        $session->setFlashdata('msg', "Những thay đổi của bạn đã được lưu lại");
        return redirect()->to('/manage/page');
    }

}