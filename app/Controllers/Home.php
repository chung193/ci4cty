<?php

namespace App\Controllers;
use App\Models\Option_model;

class Home extends BaseController
{
    function __construct()
    {

        $option_md = new Option_model();
        $site = $option_md->getOptions();
        foreach($site as $key => $value){
                if($value['name'] == 'site_status')
                    $status = $value['value'];
        }
        if(!$status){
            $this->offline();
        }
    }

    public function offline(){
        echo view('errors/html/common_error');
    }

    public function index()
    {
        $data['data'] = array(
            'subview' => 'frontend/contents/home/index'
        );
       echo view('frontend/layout', $data);
    }
}
