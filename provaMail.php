<?php
//https://github.com/mailgun/mailgun-php
if(php_sapi_name()!='cli')die();
function send_mailgun($email){
    $config = array();
    $config['api_key'] = _MAIL_GUN_API_KEY_; //API Key
    $config['api_url'] = _MAIL_GUN_API_URL_; //API Base URL

    $message = array();
    $message['from'] = "raulojeda10g@gmail.com";
    $message['to'] = $email;
    $message['h:Reply-To'] = "raulojeda10g@gmail.com";
    $message['subject'] = "Hello, this is a test";
    $message['html'] = 'Hello ' . $email . ',</br></br> This is a test';
    
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
    curl_close($ch);
    return $result;
}

$json = send_mailgun('raulojeda10g@gmail.com');
print_r($json);