<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->data['title'] = 'Admin/Dashboard';
    }
    public function index()
    {
        //$this->data['segment'] = $this->request->uri->getSegment(1);
        return view("admin/dashboard",$this->data);
        
    }
    public function test($id=false){
        echo $id;
    }
    
}
?>