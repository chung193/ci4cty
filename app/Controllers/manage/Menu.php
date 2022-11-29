<?php namespace App\Controllers\manage;
 
use CodeIgniter\Controller;
use App\Models\manage\Menu_model;
use App\Models\manage\MenuItem_model;
use App\Models\manage\Info_model;

class Menu extends BaseController
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
        $model = new Menu_model();
        $data['menu'] = $model->getMenu();
        $session = session();
        $subview = '/manage/contents/menu/menu_view';
    
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'table',
            'subview'   => $subview,
            'title'     => "Menu",
            'name'      => $session->get('user_name')
        );
        
        echo view('manage/layout',$data);
    }

    public function add()
    {
        $session = session();
        $model = new Menu_model();
        $data['menu'] = $model->getMenu();
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'form',
            'subview'   => '/manage/contents/menu/add_menu_view',
            'title'     => "Thêm danh mục",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function save()
    {
        $rules = [
            'name' => ['label' => 'tên menu','rules' =>'required|max_length[255]'],
        ];
         
        if($this->validate($rules)){
            $model = new Menu_model();
            
            $code = create_slug($this->request->getPost('code'));
            
            $count = $model->countWhere($code);
            if($count){
                $code = $code.'-'.$count;
            }

            $data = array(
                'name'     => $this->request->getPost('name'),
                'code' => $code,
            );
            $model->saveMenu($data);

            $session = session();
            $session->setFlashdata('msg', 'Thông tin đã được lưu lại');
            return redirect()->to('/manage/menu');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/menu/add/');
        }
    }

    public function edit($id=false)
    {
        $model = new Menu_model();
        $data['menu_list'] = $model->getMenu();
        $data['menu'] = $model->getMenu($id)->getRow();
        // $seo = $this->getSeoContent($id, 'Menu')->getRow();
        //print_r($seo);die();
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => '/manage/contents/menu/edit_menu_view',
            'title'     => "Sửa menu",
            'type' => 'form',
            // 'seo' => $seo,
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function update()
    {
        $rules = [
            'name' => ['label' => 'tên menu','rules' =>'required|max_length[255]'],
        ];

        $id = $this->request->getPost('id');
         
        if($this->validate($rules)){
            $model = new Menu_model();

            $code = create_slug($this->request->getPost('code'));
            
            $count = $model->countWhere($code);
            if($count){
                $code=$code.'-'.$count;
            }
            $data = array(
                'name'  => $this->request->getPost('name'),
                'code' => $code,
            );
            $model->updateMenu($data, $id);
            $session = session();
            $session->setFlashdata('msg', 'Thông tin đã được lưu lại');
            return redirect()->to('/manage/menu');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/menu/edit/'.$id);
        }
    }

    public function delete($id)
    {
        $model = new Menu_model();
        $model->deleteMenu($id);
        $session = session();
        $session->setFlashdata('msg', 'Thông tin đã được lưu lại');
        return redirect()->to('/manage/menu');
    }

    public function item($id){
        // echo $id; die();
        $model = new Menu_model();
        $item = new MenuItem_model();
        $data['menu'] = $model->getMenu($id);
        $data['menuitem'] = $item->getMenuItem($id);
        $session = session();
        $subview = '/manage/contents/menu/item';
    
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => $subview,
            'title'     => "Menu",
            'type' => '',
            'name'      => $session->get('user_name')
        );
        //print_r($data['menuitem']); 
        //print_r($data['menuitem']); 
        //die();
        echo view('manage/layout', $data);
    }

    public function saveitem(){
        // echo $id; die();
        $model = new Menu_model();
        $item = new MenuItem_model();
        
        $data['menuitem'] = $item->getMenuItem($this->request->getPost('menu_id'));
        $obj = $data['menuitem'];
        $arr = (array)$data['menuitem'];
        $data = array(
            'menu_id'   => $this->request->getPost('menu_id'),
            'json'   => $this->request->getPost('json'),
        );
        if(!count($arr)){
            $item->saveMenuItem($data);
        }else{
            $item->updateMenuItem($data, $obj->id);
        }
        $session = session();
        $session->setFlashdata('msg', 'Thông tin đã được lưu lại');
        return redirect()->to('/manage/menu/item/'.$this->request->getPost('menu_id'));
        echo view('manage/layout', $data);
    }
}