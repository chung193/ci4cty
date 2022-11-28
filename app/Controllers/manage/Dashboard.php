<?php 
namespace App\Controllers\manage; 

use CodeIgniter\Controller;
use App\Models\manage\Info_model;


class Dashboard extends BaseController
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
        $data['data'] = array(
            'site' => $this->site,
            'subview'   => 'manage/contents/dashboard/index',
            'title'     => "Bảng điều khiển",
            'name'      => $session->get('user_name')
        );
        
        echo view('manage/layout', $data);
    }
}