<?
function sendEmail($email,$subject,$html){
    try {
        $config = array();
        $config['api_key'] = file_get_contents(dirname(__FILE__).'/../../mail_gun_api_key.txt'); //API Key
        $config['api_url'] = file_get_contents(dirname(__FILE__).'/../../mail_gun_api_url.txt'); //API Base URL

        $message = array();
        $message['from'] = "raulojeda10g@gmail.com";
        $message['to'] = $email;
        $message['h:Reply-To'] = "raulojeda10g@gmail.com";
        $message['subject'] = $subject;
        $message['html'] = $html;
        
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
        error_log(print_r($result,1));
    } catch(Exception $e){
        error_Log(print_r($e,1));
    }
    
    return $result;
}