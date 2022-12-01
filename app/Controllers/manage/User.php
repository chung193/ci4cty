<?php namespace App\Controllers\manage;
 
use CodeIgniter\Controller;
use App\Models\manage\User_model;
use CodeIgniter\Files\File;
use App\Models\manage\Info_model;
use App\Models\manage\User_group_model;

class User extends BaseController
{
    public $site;
    public function __construct()
    {
            $info_md = new Info_model();
            $this->site = array(
                'info' => $info_md->getInfo()
            );
    }

    public function index()
    {
        $model = new User_model();
        $data['user'] = $model->getUser();
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'table',
            'subview'   => '/manage/contents/user/user_view',
            'title'     => "Người dùng",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }

    public function add()
    {
        $session = session();
        $ugr = new User_group_model();
        $data['user_group'] = $ugr->getUserGroup();
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => '/manage/contents/user/add_user_view',
            'title'     => "Thêm người dùng",
            'type' => 'form',
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }

    public function save()
    {
        $validationRule = [
            'nicename'  => ['label'=>'tên hiển thị','rules'=>'required|max_length[55]'],
            'email'      => ['label'=>'email','rules'=>'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]'],
            'profile'=> ['label'=>'mô tả','rules'=>'min_length[6]|max_length[200]'],
            'password'      => ['label'=>'mật khẩu','rules'=>'required|min_length[6]|max_length[200]'],
            'confpassword'  => ['label'=>'xác nhận mật khẩu','rules'=>'matches[password]'],
            'userimage' => [
                'label' => 'Image File',
                'rules' => 'is_image[userimage]'
                    . '|mime_in[userimage,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[userimage,102400]'
                    . '|max_dims[userimage,204800, 204800]',
            ],
        ];

        if (! $this->validate($validationRule)) {
            $session = session();
            $session->setFlashdata('msgErr', "Đã có lỗi xảy ra");
            return redirect()->to('/manage/user/add/');
        }

        $img = $this->request->getFile('userimage');
        if($this->request->getFile('userimage') != ""){
            if ($img->isValid() && !$img->hasMoved()) {

                $img->move(ROOTPATH.'/public/uploads/user/');
                $basename = $img->getName();
                $model = new User_model();
                $data = array(
                    'group_id' => $this->request->getPost('group_id'),
                    'nicename' => $this->request->getPost('nicename'),
                    'email' => $this->request->getPost('email'),
                    'profile' => $this->request->getPost('profile'),
                    'group_id' => $this->request->getPost('group_id'),
                    'userimage' => $basename,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                );
                $model->saveUser($data);
                $session = session();
                $session->setFlashdata('msg', "Lưu thay đổi");
                return redirect()->to('/manage/user');
            } else {
                $data = ['errors' => 'The file has already been moved.'];
            }
        }else{
                $model = new User_model();
                $data = array(
                   
                    'nicename' => $this->request->getPost('nicename'),
                    'email' => $this->request->getPost('email'),
                    'profile' => $this->request->getPost('profile'),
                    'group_id' => $this->request->getPost('group_id'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                );
                $model->saveUser($data);
                $session = session();
                $session->setFlashdata('msg', "Lưu thay đổi");
                return redirect()->to('/manage/user');
        }
    }

    public function edit($id)
    {
        $model = new User_model();
        $data['user'] = $model->getUser($id)->getRow();
        $ugr = new User_group_model();
        $data['user_group'] = $ugr->getUserGroup();
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => '/manage/contents/user/edit_user_view',
            'title'     => "Sửa thông tin người dùng",
            'type' => 'form',
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function update()
    {
        $validationRule = [
            'nicename'  => ['label'=>'tên hiển thị','rules'=>'required|max_length[55]'],
            'email'      => ['label'=>'email','rules'=>'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]'],
            'profile'=> ['label'=>'mô tả','rules'=>'min_length[6]|max_length[200]'],
            'password'      => ['label'=>'mật khẩu','rules'=>'required|min_length[6]|max_length[200]'],
            'confpassword'  => ['label'=>'xác nhận mật khẩu','rules'=>'matches[password]'],
            'userimage' => [
                'label' => 'Image File',
                'rules' => 'is_image[userimage]'
                    . '|mime_in[userimage,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[userimage,102400]'
                    . '|max_dims[userimage,204800, 204800]',
            ],
        ];

        $id = $this->request->getPost('id');

        if (! $this->validate($validationRule)) {
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/user/edit/'.$id);
        }
        
        if($this->request->getFile('userimage') !== ""){
                
                $img = $this->request->getFile('userimage');

                if ($img->isValid() && !$img->hasMoved()) {
        
                    $img->move(ROOTPATH.'/public/uploads/user/');
                    $basename = $img->getName();

                    $model = new User_model();
                    $id = $this->request->getPost('id');
                    
                    $data = array(
                        
                        'email' => $this->request->getPost('email'),
                        'profile' => $this->request->getPost('profile'),
                        'nicename' => $this->request->getPost('nicename'),
                        'group_id' => $this->request->getPost('group_id'),
                        'userimage' => $basename,
                    );
                    if($this->request->getVar('password') !== '')
                    {
                        $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                    }
                    $model->updateUser($data, $id);
                    $session = session();
                    $session->setFlashdata('msg', "Lưu thay đổi");
                    return redirect()->to('/manage/user');
            }else{
                    $model = new User_model();                    
                    $data = array(
                       
                        'email' => $this->request->getPost('email'),
                        'group_id' => $this->request->getPost('group_id'),
                        'nicename' => $this->request->getPost('nicename'),
                        'profile' => $this->request->getPost('profile'),
                    );
                    if($this->request->getVar('password') !== '')
                    {
                        $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                    }
                    $model->updateUser($data, $id);
                    $session = session();
                    $session->setFlashdata('msg', "Lưu thay đổi");
                    return redirect()->to('/manage/user');
            }
        }
    }

    public function delete($id)
    {
        $model = new User_model();
        $model->deleteUser($id);
        $session = session();
        $session->setFlashdata('msg', "Lưu thay đổi");
        return redirect()->to('/manage/user');
    }

}