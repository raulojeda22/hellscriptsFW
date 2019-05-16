<?php
$data=json_decode($_POST['data']);
if (filter_var($data->email,FILTER_VALIDATE_EMAIL)) {
    $config = array();
    $config['api_key'] = file_get_contents(dirname(__FILE__).'/../../../../mail_gun_api_key.txt'); //API Key
    $config['api_url'] = file_get_contents(dirname(__FILE__).'/../../../../mail_gun_api_url.txt'); //API Base URL

    $message = array();
    $message['from'] = "raulojeda10g@gmail.com";
    $message['to'] = "raulojeda10g@gmail.com";
    $message['h:Reply-To'] = $data->email;
    $message['subject'] = "Hellscripts contact email from ".$data->email;
    $message['html'] = "<h1>Message from ".$data->name." ".$data->surname."</h1><br/><p>".$data->message."</p>";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $config['api_url']);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
    $result = curl_exec($ch);
    return $result;
} else {
    header('HTTP/1.0 403 Forbidden');
    return false;
}
