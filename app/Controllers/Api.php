<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
//use CodeIgniter\HTTP\Response;
//use CodeIgniter\HTTP\ResponseInterface;
//use CodeIgniter\Controller;
//use Exception;
class Api extends ResourceController
{
    use ResponseTrait;
    public $commonmodel;
    public $session;
    public function __construct()
    {
        date_default_timezone_set('Asia/Calcutta');
        $this->commonmodel = model('App\Models\Common_model', false);
    }
    public function webhook(){
        $verify_token = (isset($_GET['hub_verify_token']))?$_GET['hub_verify_token']:'';
        $challenge = (isset($_GET['hub_challenge']))?$_GET['hub_challenge']:'';
        if($verify_token == WEBHOOK_VERIFY_TOKEN){
            return $this->respond($challenge);
        }else{
            return $this->respond(200);
        }
    }
    public function webhookpost(){
        $post = file_get_contents("php://input");
        $event = json_decode($post);
        $data = array();
        if(isset($event->entry[0]->changes[0]->value->statuses[0]->status) && $event->entry[0]->changes[0]->value->statuses[0]->status == 'read'){
            $data['phone1'] = substr($event->entry[0]->changes[0]->value->statuses[0]->recipient_id, -10);
            $data['status'] = 1;
            $data['added_at'] = date('Y-m-d H:i:s', $event->entry[0]->changes[0]->value->statuses[0]->timestamp);
        }else if(isset($event->entry[0]->changes[0]->value->messages[0]->type) && $event->entry[0]->changes[0]->value->messages[0]->type == 'text'){
            $data['phone1'] = substr($event->entry[0]->changes[0]->value->messages[0]->from, -10);
            $data['message'] = $event->entry[0]->changes[0]->value->messages[0]->text->body;
            $data['status'] = 2;
            $data['added_at'] = date('Y-m-d H:i:s', $event->entry[0]->changes[0]->value->messages[0]->timestamp);
        }else if(isset($event->entry[0]->changes[0]->value->statuses[0]->status) && $event->entry[0]->changes[0]->value->statuses[0]->status == 'delivered'){
            $data['phone1'] = substr($event->entry[0]->changes[0]->value->statuses[0]->recipient_id, -10);
            $data['status'] = 3;
            $data['added_at'] = date('Y-m-d H:i:s', $event->entry[0]->changes[0]->value->statuses[0]->timestamp);
        }else if(isset($event->entry[0]->changes[0]->value->statuses[0]->status) && $event->entry[0]->changes[0]->value->statuses[0]->status == 'sent'){
            $data['phone1'] = substr($event->entry[0]->changes[0]->value->statuses[0]->recipient_id, -10);
            $data['status'] = 4;
            $data['added_at'] = date('Y-m-d H:i:s', $event->entry[0]->changes[0]->value->statuses[0]->timestamp);
        }

        if(!empty($data)){
            $this->commonmodel->insertRecord('tbl_whatsapp_reply_log', $data);
        }
        return $this->respond(200);
        // return $this->failNotFound('Api Failed');
        
    }
    public function hash(){
        echo md5("5A5&Y6GT9DYY87KL4XZHGAX");
    }
}