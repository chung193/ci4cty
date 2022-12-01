<?php

namespace App\Controllers\manage;

use CodeIgniter\Controller;
use App\Models\manage\Category_model;
use App\Models\manage\Info_model;
use App\Models\manage\User_group_model;
use App\Models\manage\Permission_model;

class User_group extends BaseController
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
        $model = new User_group_model();
        $data['user_group'] = $model->getUserGroup();
        $session = session();
        $subview = '/manage/contents/user_group/user_group_view';

        $data['data'] = array(
            'site' => $this->site,
            'subview'   => $subview,
            'title'     => "Nhóm người dùng",
            'type' => 'table',
            'name'      => $session->get('user_name')
        );

        echo view('manage/layout', $data);
    }

    public function add()
    {
        $session = session();
        $model = new User_group_model();
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => '/manage/contents/user_group/add_user_group_view',
            'title'     => "Thêm nhóm người dùng",
            'type' => 'form',
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout', $data);
    }

    public function save()
    {
        $rules = [
            'name'      => ['label' => 'tên', 'rules' => 'required|max_length[255]'],
        ];

        if ($this->validate($rules)) {
            $model = new User_group_model();

            $data = array(
                'name'     => $this->request->getPost('name')
            );
            $model->saveUserGroup($data);
            $gr_id = $model->insertID();

            $db = db_connect();
            $tables = $db->listTables();
            $demo = array();
            foreach ($tables as $tb) {
                $demo[$tb] = array(
                    '0' => 0, 
                    '1' => 0, 
                    '2' => 0, 
                    '3' => 0
                );
            }
            $permission = json_encode($demo);
            $per_md = new Permission_model();
            $per = array(
                'group_id' => $gr_id,
                'permission' => $permission
            );
            $per_md->savePermission($per);

            $session = session();
            $session->setFlashdata('msg', "Thông tin đã được lưu lại");
            return redirect()->to('/manage/user-group');
        } else {
            $session = session();
            $session->setFlashdata('post', $_POST);
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/user-group/add/');
        }
    }

    public function edit($id = false)
    {
        $session = session();
        $model = new User_group_model();
        $data['user_group'] = $model->getUserGroup($id);


        $data['data'] = array(
            'site' => $this->site,
            'subview'   => '/manage/contents/user_group/edit_user_group_view',
            'title'     => "Sửa nhóm người dùng",
            'type' => 'form',
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout', $data);
    }

    public function update()
    {
        // print_r($_POST); die();
        $rules = [
            'name' => ['label' => 'tên', 'rules' => 'required|max_length[255]'],
        ];

        $id = $this->request->getPost('id');
        $session = session();
        if ($this->validate($rules)) {
            $model = new User_group_model();


            $data = array(
                'name'  => $this->request->getPost('name'),
            );
            $model->updateUserGroup($data, $id);

            $session->setFlashdata('msg', 'Nội dung đã được lưu lại');
            return redirect()->to('/manage/user-group');
        } else {
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/user-group/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $model = new User_group_model();
        $model->deleteUserGroup($id);
        $session = session();
        $session->setFlashdata('msg', "Lưu thay đổi");
        return redirect()->to('/manage/user-group');
    }
}
