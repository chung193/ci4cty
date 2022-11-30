<?php 
namespace App\Controllers\auth;
 
use CodeIgniter\Controller;
use App\Models\manage\User_model;
 
class Login extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = array(
            'title' => 'Đăng nhập',
            'subview' => 'auth/contents/login'
        );
        echo view('auth/layout', $data);
    } 
 
    public function auth()
    {
        $session = session();
        $model = new User_model();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'user_id'       => $data['id'],
                    'user_name'     => $data['nicename'],
                    'user_email'    => $data['email'],
                    'user_img'      => $data['userimage'],
                    'group_id'     => $data['group_id'],
                    'user_is_superadmin'    => $data['is_superadmin'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                $now = date('Y-m-d H:i:s');
                $temp = array('lastlogin' => $now);
                $model->updateUser($temp, $data['id']);
                return redirect()->to('/manage/dashboard');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/auth/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/auth/login');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth/login');
    }
} 