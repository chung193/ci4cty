<?php

namespace App\Controllers\manage;

use CodeIgniter\Controller;
use App\Models\manage\Seo_model;
use App\Models\manage\Info_model;
use App\Models\manage\Page_model;
use App\Models\manage\Post_model;
use App\Models\manage\Category_model;

class Seo extends BaseController
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
        $model = new seo_model();
        $data['seo'] = $model->getseo();
        $session = session();
        $subview = '/manage/contents/seo/seo_view';

        $data['data'] = array(
            'site' => $this->site,
            'subview'   => $subview,
            'type' => 'table',
            'title'     => "SEO",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout', $data);
    }

    public function edit($id)
    {
        $model = new seo_model();
        $data['seo'] = $model->getseo($id)->getRow();
        $seo = $data['seo'];

        if ($seo->content_type == 'category') {
            $cat_md = new Category_model();
            $tem = $cat_md->getCategory($seo->content_id);
        }

        if ($seo->content_type == 'post') {
            $post_md = new Post_model();
            $tem = $post_md->getPost($seo->content_id);
        }

        if ($seo->content_type == 'page') {
            $page_md = new Page_model();
            $tem = $page_md->getPage($seo->content_id);
        }

        // echo ($seo->content_type); die();
        // print_r($tem); die();

        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'form',
            'content' => $tem,
            'subview'   => '/manage/contents/seo/edit_seo_view',
            'title'     => "Sửa nội dung seo",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout', $data);
    }

    public function update()
    {
        $rules = [
            'meta_title'      => ['label' => 'meta title', 'rules' => 'required|min_length[3]|max_length[600]'],
            'meta_description'      => ['label' => 'meta description', 'rules' => 'required|min_length[3]|max_length[600]'],
        ];
        $id = $this->request->getPost('id');
        if ($this->validate($rules)) {
            
            $model = new seo_model();
                        
            $data = array(
                'meta_title'  => $this->request->getPost('meta_title'),
                'meta_description' => $this->request->getPost('meta_description'),
            );
            $model->updateseo($data, $id);
            $session = session();
            $session->setFlashdata('msg', 'Dữ liệu đã được lưu lại');
            return redirect()->to('/manage/seo');
        } else {
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/seo/edit/' . $id);
        }
    }

}
