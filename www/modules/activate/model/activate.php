<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/backend/includes/autoload.php';
$method = $_SERVER['REQUEST_METHOD'];
if ($method='GET'){
    $object = User::getInstance($_GET['token']);
    $user = $object->activate($_GET['token']);
    setcookie("token", $_GET['token'], time() + 3600, '/');
    setcookie("email", $user->email, time() + 3600, '/');
    setcookie("idUser", $user->id, time() + 3600, '/');
    header('Location: http://localhost/hellscriptsFW/#/');
}
