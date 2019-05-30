<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/backend/includes/autoload.php';
include_once dirname(__FILE__).'/activationEmail.php';
$method = $_SERVER['REQUEST_METHOD'];
$headers = apache_request_headers();
if ($method=='POST'){
    $postParams=json_decode($_POST['data']);
}
if ($method=='POST' && property_exists($postParams,'password')
&& property_exists($postParams,'email') && !array_key_exists('Authorization',$headers)){
    $object = User::getInstance('');
    $results = $object->login($postParams->email,$postParams->password);
    if (!$results){
        header('HTTP/1.0 401 Unauthorized');
    }
    echo $results;
} else if ($method=='POST' && array_key_exists('Authorization',$headers)){
    $object = User::getInstance($headers['Authorization']);
    $authParams = new stdClass;
    $authParams->password = $postParams->password;
    $authParams->token = $headers['Authorization'];
    unset($postParams->password);
    $results = $object->register($postParams,$authParams);
    $email = sendActivationEmail($postParams->email,$results);
    echo $results;
} else if ($method=='PUT'){
    $update=(array)json_decode($_POST['data']);
    error_log(print_r($_GET,1));
    error_log(print_r($update,1));    
    if (isset($_GET['token']) && isset($_GET['email']) && isset($update['password']) ){
        echo User::changePassword($_GET['email'],$_GET['token'],$update['password']);
    } else {
        //profile
        error_log('BAAAAAAAAAAAAAAAAAAAAAIA');
    }
} else {
    $object = User::getInstance($headers['Authorization']);
    include_once _PROJECT_PATH_.'/backend/controllers/ApiController.php';
    echo json_encode($results);
}