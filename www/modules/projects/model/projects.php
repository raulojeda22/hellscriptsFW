<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/backend/includes/autoload.php';
$method = $_SERVER['REQUEST_METHOD'];
$headers = apache_request_headers();
$object = Project::getInstance($headers['Authorization']);
include_once _PROJECT_PATH_.'/backend/controllers/ApiController.php';
echo json_encode($results);