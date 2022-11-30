<?php

namespace App\Controllers\manage;

use CodeIgniter\Controller;
use CodeIgniter\Files\File;
use App\Models\manage\Info_model;
use App\Models\manage\Permission_model;

class Permission extends BaseController
{
    public $site;
    public function __construct()
    {
        if (!session()->get('user_is_superadmin')) {
            echo '<h1>Access denied</h1>';
            exit;
        } else {
            $info_md = new Info_model();
            $this->site = array(
                'info' => $info_md->getInfo()
            );
        }
    }

    public function index($id = false)
    {
        $model = new Permission_model();
        $data['permission'] = $model->getPermission($id);

        //print_r( $data['permission']); die();
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'table',
            'subview'   => '/manage/contents/permission/permission_view',
            'title'     => "Phân quyền",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout', $data);
    }

    public function savePermission(){
        $model = new Permission_model();
        // print_r($data['permission']); die();
        if ($this->request->getPost('data') !== null) {
            // print_r(json_encode($this->request->getPost('data')));
            // die();
            $per = array(
                'permission' => json_encode($this->request->getPost('data'))
            );
            $model->updatePermission($per, $this->request->getPost('id'));
            $session = session();
            $session->setFlashdata('msg', 'Thông tin đã được lưu lại');
            return redirect()->to('/manage/permission/'.$this->request->getPost('group_id'));
        }
    }
}
