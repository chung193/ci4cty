<?php

namespace App\Controllers\manage;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\manage\Seo_model;
use App\Models\manage\Permission_model;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['common', 'string'];
    protected $controllerList;
    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        // Preload any models, libraries, etc, here.
        // E.g.: $this->session = \Config\Services::session();
        $this->permission();
    }

    public function setSeoContent($data)
    {
        $seo_md = new seo_model();
        $seo_md->saveseo($data);
    }

    // public function dob(){
    //     $cus_md = new Shop_Customer_model();
    //     $cus = $cus_md->getDob();
    //     foreach($cus as $val){
    //         if(check_bd(date('d-m-Y',strtotime($val['dob'])))){
    //             echo 'Hôm nay là sinh nhật của '. $val['name'] .' mã kh '.$val['id'].' email '.$val['email'];
    //         };
    //     }
    // } 

    public function getSeoContent($content_id, $type)
    {
        $seo_md = new seo_model();
        $query = $seo_md->getseo($content_id, $type);
        return $query;
    }

    public function updateSeoContent($data, $id)
    {
        $seo_md = new seo_model();
        $seo_md->updateseo($data, $id);
    }

    public function permission()
    {
        $permission_md = new Permission_model();
        $session = session();
        if($session->get('user_is_superadmin')){
            // do nothing
            return true;
        }else{
            $group_id = $session->get('group_id');
            $permission = $permission_md->getPermission($group_id);
            // $permission = (array)$permission['permission'];
            $router = service('router');
            $controller = class_basename($router->controllerName());
            $method = $router->methodName();
    
            
            $controller =  strtolower($controller);
            $method = strtolower($method);
            if($controller == 'dashboard' || $controller == 'profile'){
                return true;
            }
            // echo $controller;
            $permission = (array)json_decode($permission->permission);
            // $role = array("edit", "add", "save", "update", "delete");
            // $temp = array("create", "index", "update", "delete");
            // print_r($permission[$controller]);
            $flag = false;
            if (isset($permission[$controller])) {
                switch ($method) {
                    case 'index':
                        if((int)$permission[$controller][1]) $flag = true;
                        break;
                    case 'edit':
                        if((int)$permission[$controller][2]) $flag = true;
                        break;
                    case 'add':
                        if((int)$permission[$controller][0]) $flag = true;
                        break;
                    case 'save':
                        if((int)$permission[$controller][0]) $flag = true;
                        break;
                    case 'update':
                        if((int)$permission[$controller][2]) $flag = true;
                        break;
                    case 'delete':
                        if((int)$permission[$controller][3]) $flag = true;
                        break;
                    default:
                        $flag = false;
                }
                
                if(!$flag){
                    echo view('errors/html/common_error');
                    die();
                }
                
            }else{
                echo view('errors/html/common_error');
                die();
            }
        }
    }
}
