<?
include_once dirname(__FILE__).'/../../../../backend/includes/constants.php';
include_once _PROJECT_PATH_.'/backend/models/Project.class.php';
$method = $_SERVER['REQUEST_METHOD'];
$headers = apache_request_headers();
$object = new Project($headers['Authorization']);
include_once _PROJECT_PATH_.'/backend/controllers/ApiController.php';
echo json_encode($results);
