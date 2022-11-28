<?php namespace App\Controllers\auth;
 
use CodeIgniter\Controller;
use App\Models\manage\User_model;
 
class Register extends Controller
{
    function __construct() {
        $model = new User_model();
        $query = $model->findSuperAdmin();
        $temp = $query->getRow();
        if(gettype($temp) != NULL){
            return redirect()->route('login');
        }else{
            echo 'bla ble'; die();
        }
    }
    public function index()
    {
        //include helper form
        helper(['form']);
        $data = array(
            'title' => 'Đăng ký',
            'subview' => 'auth/contents/register'
        );
        echo view('auth/layout', $data);
    }
 
    public function save()
    {
        helper(['form']);
        $rules = [
            'nicename'      => 'required|max_length[20]',
            'lastname'      => 'max_length[20]',
            'firstname'      => 'max_length[20]',
            'middlename'      => 'max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

         
        if($this->validate($rules)){
            $now = date('Y-m-d H:i:s');
            $model = new User_model();
            $data = [
                'nicename'     => $this->request->getVar('nicename'),
                'lastname'     => $this->request->getVar('lastname'),
                'firstname'     => $this->request->getVar('firstname'),
                'middlename'     => $this->request->getVar('middlename'),
                'email'    => $this->request->getVar('email'),
                'is_superadmin' => 0,
                'role' => 'editor',
                'registered' => $now,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/auth/login');
        }else{
            $data['validation'] = $this->validator;
            echo view('/auth/register', $data);
        }
         
    }
}