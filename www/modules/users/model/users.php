<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/backend/models/User.class.php';
$method = $_SERVER['REQUEST_METHOD'];
$headers = apache_request_headers();
if ($method=='POST'){
    $postParams=json_decode($_POST['data']);
}
if ($method=='POST' && property_exists($postParams,'password')
&& property_exists($postParams,'email') && !array_key_exists('Authorization',$headers)){
    $object = new User('');
    $results = $object->login($postParams->email,$postParams->password);
    if (!$results){
        header('HTTP/1.0 401 Unauthorized');
    }
    echo $results;
} else if ($method=='POST' && array_key_exists('Authorization',$headers)){
    $object = new User($headers['Authorization']);
    $authParams = new stdClass;
    $authParams->password = $postParams->password;
    $authParams->token = $headers['Authorization'];
    unset($postParams->password);
    $results = $object->register($postParams,$authParams);
    echo $headers['Authorization'];
} else {
    $object = new User($headers['Authorization']);
    include_once _PROJECT_PATH_.'/backend/controllers/ApiController.php';
    error_log(print_r(json_encode($results),1));
    echo json_encode($results);
    
}