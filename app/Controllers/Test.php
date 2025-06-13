<?php

namespace App\Controllers;

class Test extends BaseController
{
    public $session;
    public $commonmodel;
    public function __construct()
    {
        $this->commonmodel = model('App\Models\Common_model', false);
    }
    public function index(){
        //echo 'test mail';
       $to_numbers = ['+919162925142', '+918010250556'];
        //$to_numbers = ['9162925142'];
        foreach($to_numbers as $to_number){
            $messageBody = array();
             //message for template
            /*$messageBody = [
                "messaging_product"=>"whatsapp",
                //"recipient_type" => "individual",
                "to" => "$to_number",
                "type" => "template",
                "template" => [
                    "name" => "happy_new_year_2024",
                    // "name" => "cb_introduction",
                    //"name" => "diwali_offer",
                    "language" => [
                        'code' => "en_US"
                    ],
                ]
            ];*/ 
            /*$messageBody = [
                "messaging_product"=>"whatsapp",
                "recipient_type" => "individual",
                "to" => "$to_number",
                "type" => "image",
                "image" => [
                    "link" => "https://globalphotoedit.com/wp-content/themes/globalphotoedit/assets/images/price-boximg-baby.png",
                ],
            ];*/

            $messageBody = [
                "messaging_product"=>"whatsapp",
                "preview_url" => true,
                "recipient_type" => "individual",
                "to" => "$to_number",
                "type" => "text",
                "text" => [
                    "body" => "Hi this a cloud api message",
                ],
            ];
            $curl = curl_init();
            //$from_phone_number_id = 174421629079556;
            //$from_phone_number_id = 169426479586602;
            //$WHATSAPP_ACCESS_TOKEN = "EAADjTjNOf98BO1h2FuvkuoJnngDNSllJQEj9wU6QhOchnu6m5j7T9tQsbsXGH5m8cDB8e73FkyLT40sCxoElCMvr5F57J7SxGccGfrDb91x2cftMQcul14Rzd8zdQWQ923il97UeIkWMAxjsGrBghiZAzyMNUPCoin4xVWzZBNkhyFe75MbygQ7GjLbkJEnXAAtnoYi5Sf73oDDv5a";
            //$WHATSAPP_ACCESS_TOKEN = "EAADjTjNOf98BO5NDw8SxgB8AuSC79Pr30TshV9Qv8bZAO5LN0JonpuapOpNpTuMylXN6CHKuppp99GJJuQbQD24XOCXmozztVhgtuOTslvI5lncWlbSTUt03EpOIUukiyBmQVN99F9p2a6EdlIfknkJo0Vn15nZBqSi5X2pildZA7wZCgxFFci42eEdoh5XzxXR6QZASIxwGoFQjz7PEZD";
            //$WHATSAPP_ACCESS_TOKEN = "EAADjTjNOf98BOyYlOBHG8RKWmrtPgf3ez1SZCjs0lZABS7sVFeEqs9RlHNoTHHVZCt7aOpMqhrQt1ebYVRhBfahSisPKy9Ctq3dZBqPjUB9Xn7qHHpuEWr3WIFLB7X5oEw3tu6y0Rinr2nP658xKrhbwB0sgEjASIGOHTPd1FxjXuulZAtjDGOhMo2c3M38OtAfOeUba73haE2IJbZCcW0QhGkyKoowzhQXtyKfnYZD";
            curl_setopt_array($curl, array(
            //CURLOPT_URL => 'https://graph.facebook.com/v13.0/FROM_PHONE_NUMBER_ID/messages',
                CURLOPT_URL => 'https://graph.facebook.com/v18.0/'.FROM_PHONE_NUMBER.'/messages',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($messageBody),
                // CURLOPT_POSTFIELDS => $messageBody,
                CURLOPT_HTTPHEADER => array(
                    "Authorization:Bearer ".WHATSAPP_ACCESS_TOKEN,
                    'Content-Type: application/json',

                ),
            ));
            $response = json_decode(curl_exec($curl), true);
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            echo '<pre>'; print_r($response);
            echo '<br>'.date('Y-m-d H:i:s');
            sleep(2);
        }
    }
    public function getWebhook(){
        //$data =  $this->commonmodel->getLastRecord('tbl_users_temp', 'user_id');
        $data =  $this->commonmodel->getAllRecordOrderByDesc('tbl_users_temp','', ['user_id','DESC']);
        foreach($data as $list){
            $webhookArr[]= json_decode($list->webhook);

        }
        //$from = $webhookArr
        
        echo '<pre>'; print_r($webhookArr);
        //echo $webhookArr->entry[0]->changes[0]->value->messages[0]->from.'<br>';
        //echo $webhookArr->entry[0]->changes[0]->value->messages[0]->text->body.'<br>';
        //echo $webhookArr->entry[0]->changes[0]->value->messages[0]->type;
    }
    public function getNewEnq(){
        //$data =  $this->commonmodel->getNewEnq();
        // $deleted = $this->commonmodel->deleteRecord('tbl_contact_us', ['course_id'=>1, 'YEAR(added_at)'=>2024,'MONTH(added_at)'=>03,'DAY(added_at) >='=>6,'DAY(added_at) <='=>8, 'id !='=>1071]);
        $data =  $this->commonmodel->getAllRecordOrderByDesc('tbl_contact_us',['course_id'=>1, 'YEAR(added_at)'=>2024,'MONTH(added_at)'=>03,'DAY(added_at) >='=>21,'DAY(added_at) <='=>31], ['id','ASC']);
        
        echo '<pre>';print_r($data);
    }
    public function test_mail(){
        $setting = $this->commonmodel->get_setting(1);
        $msg = '
        <p><strong>Full Name: </strong>Md Raj Guddu</br>
        <strong>Email: </strong>test182@yopmail.com</br>
        <strong>Phone: </strong>9162925142</br>
        <strong>Message: </strong>Hi this is test mail</p>';
        $mailData['name'] = 'Md Raj Guddu';
        $mailData['message'] = $msg;
        // $msg = view('emailer/thanks', $mailData);
        // echo $msg; exit;
        
        $email = \Config\Services::email();
        $email->setFrom($setting->email, 'Career-Boss');
        $email->setTo('test182@yopmail.com');
        $email->setSubject('Contact us');
        $email->setMessage($msg);
        if($email->send()){
            echo 'send';
        }else{
            echo 'not send';
        }
    }
    
}