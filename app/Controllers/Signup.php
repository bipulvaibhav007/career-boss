<?php

namespace App\Controllers;

class Signup extends BaseController
{
    public function __construct()
    {
        $this->commonmodel = model('App\Models\Common_model', false);
    }
    public function bahamian()
    {
        $this->data = array('title'=>'Bahamian Signup');
        if ($this->request->getMethod() === 'post'){
            $validation = \Config\Services::validation();

            $validation->setRule('fname', 'First name', 'required');
            $validation->setRule('mname', 'Middle name', 'required');
            $validation->setRule('lname', 'Last name', 'required');
            $validation->setRule('country', 'Country', 'required');
            $validation->setRule('address', 'Address', 'required');
            $validation->setRule('dob', 'Birthday', 'required');
            $validation->setRule('gender', 'Gender', 'required');
            $validation->setRule('phone','CellPhone No','required|numeric');
            $validation->setRule('image','Image','max_size[image, 100]|ext_in[image, png,jpg,bmp,jpeg]');
            $validation->setRule('email','Email','required|valid_email|is_unique[tbl_users.email]');
            $validation->setRule('password','Password','required|min_length[5]|max_length[12]');
            $validation->setRule('cpassword','Confirm Password','required|matches[password]');
            $validation->setRule('tnc', 'Terms & Conditions', 'required');
           
          if(!$validation->withRequest($this->request)->run()){
              $this->data['validation'] = $validation->getErrors();
          }else{
              if($_FILES['image']['name'] != ''){
                  if($img = $this->request->getFile('image')){ 
                      $imgname = $img->getName();
                      if($img->isValid() && !$img->hasMoved()){
                          $ext = explode('.',$imgname);
                          $ext = end($ext);
                          $newName = 'u_'.time().'.'.$ext;
                          $img->move('./public/assets/upload/users/',$newName);
                      }
                  }
                  $data['image'] = $newName;
              }
              $data['fname'] = $_POST['fname'];
              $data['mname'] = $_POST['mname'];
              $data['lname'] = $_POST['lname'];
              $data['country'] = $_POST['country'];
              $data['address'] = $_POST['address'];
              $data['dob'] = $_POST['dob'];
              $data['gender'] = $_POST['gender'];
              $data['phone'] = $_POST['phone'];
              $data['email'] = $_POST['email'];
              $data['password'] = $_POST['password'];
              $data['ip_address'] = $this->request->getIPAddress();
              $data['created'] = date('Y-m-d H:i:s');
              $data['status'] = 0;
  
              $insertID = $this->commonmodel->insertRecord('tbl_users_temp', $data);
              if($insertID){
                  session()->setFlashdata(['message'=>'Bahamian Added Successfully','type'=>'success']);
                  //return redirect()->to(base_url('/admin/users'));
              }else{
                  session()->setFlashdata(['message'=>'Something went wrong. Please Try Again...','type'=>'danger']);
                  
              }
              return redirect()->to(base_url('/signup/bahamian'));
            } //request post close
        }
        $this->data['countries'] = $this->commonmodel->getAllRecord('tbl_countries', ['status'=>1]);
        echo view('include/header', $this->data);
        echo view('signup_bahamian', $this->data);
        echo view('include/footer', $this->data);
    }
    public function sendmail(){
        $email = \Config\Services::email();
        $message = 'Hi this is test mail';
        $email->setFrom('rajgudduara18@gmail.com', 'Test Mail');
        $email->setTo('test61@yopmail.com');
        $email->setSubject('Test Mail | MyGateway');
        $email->setMessage($message);//your message here
        
        //$email->setCC('another@emailHere');//CC
        //$email->setBCC('thirdEmail@emialHere');// and BCC
        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch 
        //$email->attach($filename);
            
        if($email->send()){
            echo 'mail sent';
        }else{
            echo 'not send';
        }
    }
}
