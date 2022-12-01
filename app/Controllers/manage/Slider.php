<?php namespace App\Controllers\manage;
 
use CodeIgniter\Controller;
use App\Models\manage\Slider_model;
use App\Models\manage\Info_model;

class Slider extends BaseController
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
        $model = new Slider_model();
        $data['slider'] = $model->getSlider();

        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'table',
            'subview'   => '/manage/contents/slider/slider_view',
            'title'     => "Slider",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }

    public function add()
    {
        $session = session();
        $data['data'] = array(
            'site' => $this->site,
            'type' => 'form',
            'subview'   => '/manage/contents/slider/add_slider_view',
            'title'     => "Thêm Slider",
            'name'      => $session->get('user_name')
        );
        echo view('manage/layout',$data);
    }
 
    public function save()
    {
        $rules = [
            'main_title'      => ['label'=>'Tiêu đề chính','rules'=>'required|min_length[3]|max_length[600]'],
            'sub_title'  => ['label'=>'Tiêu đề phụ','rules'=>'min_length[3]|max_length[2000]'],
            'url'   => ['label'=>'URL','rules'=>'min_length[3]|max_length[2000]'],
            'img' => [
                'label' => 'Image File',
                'rules' => 'is_image[img]'
                    . '|mime_in[img,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[img,102400]'
                    . '|max_dims[img,204800, 204800]',
            ],
        ];
         
        if($this->validate($rules)){
           

            if($this->request->getFile('img') !== ""){
                $img = $this->request->getFile('img');
                $basename = '';
                if ($img->isValid() && !$img->hasMoved()) {
                    $img->move(ROOTPATH.'/public/uploads/slider/');
                    $basename = $img->getName();
                }
            }else{
                $basename = '';
            }

            $model = new Slider_model();

            $session = session();

            $data = array(
                'main_title'  => $this->request->getPost('main_title'),
                'sub_title' => $this->request->getPost('sub_title'),
                'url' => $this->request->getPost('url'),

                'img' => $basename,
            );
            $model->saveSlider($data);
            $session = session();
            $session->setFlashdata('msg','Thông tin đã được lưu lại');
            return redirect()->to('/manage/slider');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/slider/add/');
        }
    }

    public function edit($id)
    {
        
            $model = new Slider_model();
            $data['slider'] = $model->getSlider($id)->getRow();
            $session = session();
            $data['data'] = array(
                'site' => $this->site,
                'type' => 'form',
                'subview'   => '/manage/contents/slider/edit_slider_view',
                'title'     => "Sửa Slider",
                'name'      => $session->get('user_name')
            );
            echo view('manage/layout',$data);
    }
 
    public function update()
    {
        $rules = [
            'main_title'      => ['label'=>'Tiêu đề chính','rules'=>'required|min_length[3]|max_length[600]'],
            'sub_title'  => ['label'=>'Tiêu đề phụ','rules'=>'min_length[3]|max_length[2000]'],
            'url'   => ['label'=>'URL','rules'=>'min_length[3]|max_length[2000]'],
            'img' => [
                'label' => 'Image File',
                'rules' => 'is_image[img]'
                    . '|mime_in[img,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[img,102400]'
                    . '|max_dims[img,204800, 204800]',
            ],
        ];

        $id = $this->request->getPost('id');
        if($this->validate($rules)){

            $model = new Slider_model();

            if($this->request->getFile('image') !== ""){
                $img = $this->request->getFile('img');
                $basename = '';
                if ($img->isValid() && !$img->hasMoved()) {
                    $img->move(ROOTPATH.'/public/uploads/slider/');
                    $basename = $img->getName();
                }
            }else{
                $basename = $this->request->getPost('old_img');
            }
            

            if ($basename  == ''){
                $basename = $this->request->getPost('old_img');
            }
            
            $data = array(
                'main_title'  => $this->request->getPost('main_title'),
                'sub_title' => $this->request->getPost('sub_title'),
                'url' => $this->request->getPost('url'),
                'img' => $basename,
            );


            $model->updateSlider($data, $id);
            $session = session();
            $session->setFlashdata('msg', 'Thông tin đã được lưu lại');
            return redirect()->to('/manage/slider');
        }else{
            $session = session();
            $session->setFlashdata('msgErr', $this->validator->listErrors());
            return redirect()->to('/manage/slider/edit/'.$id);
        }
    }

    public function delete($id)
    {
        $model = new Slider_model();
        $model->deleteSlider($id);
        $session = session();
        $session->setFlashdata('msg', 'Thông tin đã được lưu lại');
        return redirect()->to('/manage/slider');
    }

}