<?php namespace App\Controllers\manage;
 
use CodeIgniter\Controller;
use App\Models\manage\User_model;
use CodeIgniter\Files\File;
use App\Models\manage\Info_model;

class Profile extends BaseController
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
        $session = session();
        $model = new User_model();
        $data['user'] = $model->getUser($session->get('user_id'));
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'form',
            'subview'   => '/manage/contents/profile/edit_user_view',
            'title'     => "Sửa thông tin cá nhân",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function update()
    {
        $validationRule = [
            'nicename'      => ['label' => 'tên hiển thị','rules' =>'required|max_length[55]'],
            'email'      => ['label' => 'email','rules' =>'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email,id,{id}]'],
            'profile'=> ['label' => 'mô tả','rules' =>'required|min_length[6]|max_length[200]'],
            'confirmpassword'  =>  ['label' => 'Xác nhận mật khẩu','rules' =>'matches[password]'],
            'userimage' => [
                'label' => 'Image File',
                'rules' => 'mime_in[userimage,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[userimage,102400]'
                    . '|max_dims[userimage,2048, 2048]',
            ]
        ];

        $id = $this->request->getPost('id');

        if (! $this->validate($validationRule)) {
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/user/edit/'.$id);
        }

        if($this->request->getFile('userimage') != ""){
                
                $img = $this->request->getFile('userimage');
                
                if ($img->isValid() && !$img->hasMoved()) {
        
                    $img->move(ROOTPATH.'/public/uploads/user/');
                    $basename = $img->getName();

                    $model = new User_model();
                    $id = $this->request->getPost('id');
                    
                    $data = array(
                        'nicename' => $this->request->getPost('nicename'),
                        'email' => $this->request->getPost('email'),
                        'profile' => $this->request->getPost('profile'),
                        'userimage' => $basename,
                    );
                    if($this->request->getVar('password') !== '')
                    {
                        $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                    }
                    $model->updateUser($data, $id);
                    $session = session();
                    $session->setFlashdata('msg', 'Lưu thay đổi');
                    return redirect()->to('/manage/profile');
                }
        }else{
            $model = new User_model();                    
            $data = array(
                'nicename'  => $this->request->getPost('nicename'),
                'email' => $this->request->getPost('email'),
                'profile' => $this->request->getPost('profile'),
            );
            if($this->request->getVar('password') !== '')
            {
                $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            }
            $model->updateUser($data, $id);
            $session = session();
            $session->setFlashdata('msg', 'Cập nhật thành công');
            return redirect()->to('/manage/profile');
        }
    }

}